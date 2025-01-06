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
}
