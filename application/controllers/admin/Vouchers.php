<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vouchers extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->lang->load("system", 'english');
        $this->load->model("admin/water_user_association_model");

        //$this->output->enable_profiler(TRUE);
    }

    function index()
    {
        $this->data["title"] = "Vouchers";
        $this->data["view"] = ADMIN_DIR . "vouchers/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function vouchers()
    {


        $columns[] = "voucher_id";
        $columns[] = "voucher_no";
        $columns[] = "voucher_type";
        $columns[] = "scheme_id";
        $columns[] = "voucher_detail";
        $columns[] = "invoice_count";
        $columns[] = "invoice_total";
        $columns[] = "invoice_deduction";





        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        $search = $this->db->escape("%" . $this->input->post("search")["value"] . "%");
        // Manual SQL query building
        $sql = "SELECT *,
        ( SELECT COUNT(*)  FROM vendors_taxes as i WHERE i.voucher_id = vouchers.voucher_id )  as invoice_count,
        ( SELECT SUM(invoice_gross_total)  FROM vendors_taxes as i WHERE i.voucher_id = vouchers.voucher_id )  as invoice_total,
        ROUND(( SELECT SUM(total_deduction)  FROM vendors_taxes as i WHERE i.voucher_id = vouchers.voucher_id ),2)  as invoice_deduction
        FROM vouchers";

        // Searching
        if (!empty($this->input->post("search")["value"])) {
            $sql .= " WHERE ";
            foreach ($columns as $column) {
                $sql .= "$column LIKE $search OR ";
            }
            $sql = rtrim($sql, "OR "); // Remove the last "OR"
        }

        // Ordering
        $sql .= " ORDER BY $order $dir";

        // Pagination
        if ($limit != -1) {
            $sql .= " LIMIT $limit OFFSET $start";
        }

        $query = $this->db->query($sql);
        $data = $query->result();

        // Total records count
        $total_records = $this->db->query("SELECT COUNT(*) as count FROM vouchers")->row()->count;

        $output = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        );

        echo json_encode($output);
    }

    private function get_inputs()
    {
        $input["voucher_id"] = $this->input->post("voucher_id");
        $input["scheme_id"] = $this->input->post("scheme_id");
        //$input["voucher_no"] = $this->input->post("voucher_no");
        $input["voucher_type"] = $this->input->post("voucher_type");
        $input["voucher_detail"] = $this->input->post("voucher_detail");
        $inputs =  (object) $input;
        return $inputs;
    }

    public function get_voucher_form()
    {
        $voucher_id = (int) $this->input->post("voucher_id");
        if ($voucher_id == 0) {

            $input = $this->get_inputs();
        } else {
            $query = "SELECT * FROM 
            vouchers 
            WHERE voucher_id = $voucher_id";
            $input = $this->db->query($query)->row();
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "vouchers/get_voucher_form", $this->data);
    }

    public function add_voucher()
    {
        //$this->form_validation->set_rules("voucher_no", "Voucher No", "required");
        $this->form_validation->set_rules("voucher_type", "Voucher Type", "required");
        //$this->form_validation->set_rules("voucher_detail", "Voucher Detail", "required");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {


            // $query = "SELECT COUNT(*) as total FROM vouchers WHERE voucher_no = ?";
            // $total_count = $this->db->query($query, [$this->input->post('voucher_no')])->row()->total;
            // if ($total_count > 0) {
            //     echo '<div class="alert alert-danger">Dulicate Voucher No. Try with different Voucher No.</div>';
            //     exit();
            // }


            $inputs = $this->get_inputs();
            $inputs->created_by = $this->session->userdata("userId");
            $voucher_id = (int) $this->input->post("voucher_id");
            if ($voucher_id == 0) {
                $this->db->insert("vouchers", $inputs);
                $voucher_id = $this->db->insert_id();
                $this->db->where("voucher_id", $voucher_id);
                $voucher_no['voucher_no'] = ($voucher_id);
                $this->db->update("vouchers", $voucher_no);
            } else {
                $this->db->where("voucher_id", $voucher_id);
                $inputs->last_updated = date('Y-m-d H:i:s');
                $this->db->update("vouchers", $inputs);
            }
            echo "success";
        }
    }

    public function view_voucher($voucher_id)
    {
        $voucher_id = (int) $voucher_id;
        $query = "SELECT * FROM vouchers WHERE voucher_id = ?";
        $this->data['voucher'] = $this->db->query($query, [$voucher_id])->row();
        $this->data["title"] = "Voucher View";
        $this->data["view"] = ADMIN_DIR . "vouchers/view_voucher";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }



    public function get_vendor_taxe_form()
    {
        $id = (int) $this->input->post("id");
        if ($id == 0) {

            $input = $this->get_vendor_tax_inputs();
        } else {
            $query = "SELECT * FROM 
            vendors_taxes 
            WHERE id = $id";
            $input = $this->db->query($query)->row();
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "vouchers/get_vendor_invoice_form", $this->data);
    }


    private function get_vendor_tax_inputs()
    {
        $input["id"] = $this->input->post("id");
        $input["scheme_id"] = $this->input->post("scheme_id");
        $input["vendor_id"] = $this->input->post("vendor_id");
        $input["voucher_id"] = $this->input->post("voucher_id");
        $input["invoice_id"] = $this->input->post("invoice_id");
        $input["invoice_date"] = $this->input->post("invoice_date");
        $input["nature_of_payment"] = $this->input->post("nature_of_payment");
        $input["payment_section_code"] = $this->input->post("payment_section_code");
        $input["invoice_gross_total"] = $this->input->post("invoice_gross_total");
        // $input["whit_tax"] = $this->input->post("whit_tax") ?? 0;
        // $input["whst_tax"] = $this->input->post("whst_tax") ?? 0;
        // $input["st_charged"] = $this->input->post("st_charged") ?? 0;
        // $input["st_duty_tax"] = $this->input->post("st_duty_tax") ?? 0;
        // $input["kpra_tax"] = $this->input->post("kpra_tax") ?? 0;
        // $input["rdp_tax"] = $this->input->post("rdp_tax") ?? 0;
        // $input["total_deduction"] = $this->input->post("total_deduction") ?? 0;
        // $input["misc_deduction"] = $this->input->post("misc_deduction") ?? 0;

        if ($this->input->post("whit_tax") !== null) {
            $input["whit_tax"] = $this->input->post("whit_tax");
        } else {
            $input["whit_tax"] = 0;
        }

        if ($this->input->post("whst_tax") !== null) {
            $input["whst_tax"] = $this->input->post("whst_tax");
        } else {
            $input["whst_tax"] = 0;
        }

        if ($this->input->post("st_charged") !== null) {
            $input["st_charged"] = $this->input->post("st_charged");
        } else {
            $input["st_charged"] = 0;
        }
        if ($this->input->post("sst_charged") !== null) {
            $input["sst_charged"] = $this->input->post("sst_charged");
        } else {
            $input["sst_charged"] = 0;
        }

        if ($this->input->post("st_duty_tax") !== null) {
            $input["st_duty_tax"] = $this->input->post("st_duty_tax");
        } else {
            $input["st_duty_tax"] = 0;
        }

        if ($this->input->post("kpra_tax") !== null) {
            $input["kpra_tax"] = $this->input->post("kpra_tax");
        } else {
            $input["kpra_tax"] = 0;
        }

        if ($this->input->post("rdp_tax") !== null) {
            $input["rdp_tax"] = $this->input->post("rdp_tax");
        } else {
            $input["rdp_tax"] = 0;
        }

        if ($this->input->post("total_deduction") !== null) {
            $input["total_deduction"] = $this->input->post("total_deduction");
        } else {
            $input["total_deduction"] = 0;
        }

        if ($this->input->post("misc_deduction") !== null) {
            $input["misc_deduction"] = $this->input->post("misc_deduction");
        } else {
            $input["misc_deduction"] = 0;
        }

        $inputs =  (object) $input;
        return $inputs;
    }

    public function add_vendor_invoice()
    {
        //$this->form_validation->set_rules("scheme_id", "Scheme Id", "required");
        $this->form_validation->set_rules("vendor_id", "Vendor Id", "required");
        $this->form_validation->set_rules("voucher_id", "Voucher Id", "required");
        $this->form_validation->set_rules("invoice_id", "Invoice Id", "required");
        $this->form_validation->set_rules("invoice_date", "Invoice Date", "required");
        $this->form_validation->set_rules("nature_of_payment", "Nature Of Payment", "required");
        $this->form_validation->set_rules("payment_section_code", "Payment Section Code", "required");
        $this->form_validation->set_rules("invoice_gross_total", "Invoice Gross Total", "required");
        $this->form_validation->set_rules("whit_tax", "Whit Tax", "required");
        $this->form_validation->set_rules("st_charged", "ST Charged", "required");
        $this->form_validation->set_rules("sst_charged", "ST Charged", "required");
        $this->form_validation->set_rules("whst_tax", "Whst Tax", "required");
        $this->form_validation->set_rules("st_duty_tax", "St Duty Tax", "required");
        $this->form_validation->set_rules("kpra_tax", "Kpra Tax", "required");
        $this->form_validation->set_rules("rdp_tax", "Rdp Tax", "required");
        $this->form_validation->set_rules("total_deduction", "Total Deduction", "required");
        $this->form_validation->set_rules("misc_deduction", "Misc Deduction", "required");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {
            $inputs = $this->get_vendor_tax_inputs();
            $inputs->created_by = $this->session->userdata("userId");
            $id = (int) $this->input->post("id");
            if ($id == 0) {
                $this->db->insert("vendors_taxes", $inputs);
            } else {
                $this->db->where("id", $id);
                $inputs->last_updated = date('Y-m-d H:i:s');
                $this->db->update("vendors_taxes", $inputs);
            }
            echo "success";
        }
    }


    public function delete_vendors_invoice($id)
    {
        $id = (int) $id;
        $this->db->where("id", $id);
        $this->db->delete("vendors_taxes");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }


    public function print_scheme_detail($scheme_id)
    {

        $scheme_id = (int) $scheme_id;
        $this->data["scheme_id"] = $scheme_id;
        $this->load->view(ADMIN_DIR . "expenses/print_scheme_detail", $this->data);
    }
}
