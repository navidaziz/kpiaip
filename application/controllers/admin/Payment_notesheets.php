<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment_notesheets extends Admin_Controller
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

    public function index()
    {
        $this->data["title"] = "Payment Note Sheets";
        $this->data["description"] = "Payment Note Sheets List";
        $this->data["view"] = ADMIN_DIR . "payment_notesheets/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }



    private function get_inputs()
    {
        $input["id"] = $this->input->post("id");
        // $input["payment_notesheet_code"] = $this->input->post("payment_notesheet_code");
        $input["puc_tracking_id"] = $this->input->post("puc_tracking_id");
        $input["district_id"] = $this->input->post("district_id");
        $input["puc_title"] = $this->input->post("puc_title");
        $input["puc_detail"] = $this->input->post("puc_detail");
        $input["puc_date"] = $this->input->post("puc_date");
        $inputs =  (object) $input;
        return $inputs;
    }

    public function get_payment_notesheet_form()
    {
        $id = (int) $this->input->post("id");
        if ($id == 0) {

            $input = $this->get_inputs();
        } else {
            $query = "SELECT * FROM 
            payment_notesheets 
            WHERE id = $id";
            $input = $this->db->query($query)->row();
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "payment_notesheets/get_payment_notesheet_form", $this->data);
    }
    public function add_payment_notesheet()
    {
        // $this->form_validation->set_rules("payment_notesheet_code", "Payment Notesheet Code", "required");
        $this->form_validation->set_rules("puc_tracking_id", "Puc Tracking Id", "required");
        $this->form_validation->set_rules("district_id", "District Id", "required");
        $this->form_validation->set_rules("puc_title", "Puc Title", "required");
        // $this->form_validation->set_rules("puc_detail", "Puc Detail", "required");
        $this->form_validation->set_rules("puc_date", "Puc Date", "required");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {
            $inputs = $this->get_inputs();
            $inputs->created_by = $this->session->userdata("userId");

            $id = (int) $this->input->post("id");
            if ($id == 0) {
                $this->db->insert("payment_notesheets", $inputs);

                $id = $this->db->insert_id();
                $this->db->where("id", $id);
                $voucher_no['payment_notesheet_code'] = $id . "-" . $this->input->post('district_id') . "-" . date('Y');
                $this->db->update("payment_notesheets", $voucher_no);
            } else {
                $this->db->where("id", $id);
                $inputs->last_updated = date('Y-m-d H:i:s');
                $this->db->update("payment_notesheets", $inputs);
            }
            echo "success";
        }
    }
    public function delete_payment_notesheet($id)
    {
        $id = (int) $id;
        $this->db->where("id", $id);
        $this->db->delete("payment_notesheets");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }



    // public function fetch_data()
    // {
    //     $columns[] = "payment_notesheet_code";
    //     $columns[] = "puc_tracking_id";
    //     $columns[] = "district_id";
    //     $columns[] = "puc_title";
    //     $columns[] = "puc_detail";
    //     $columns[] = "puc_date";


    //     $limit = $this->input->post("length");
    //     $start = $this->input->post("start");
    //     $order = $columns[$this->input->post("order")[0]["column"]];
    //     $dir = $this->input->post("order")[0]["dir"];

    //     $this->db->select("*");
    //     $this->db->from("payment_notesheets");

    //     $search = $this->db->escape("%" . $this->input->post("search")["value"] . "%");
    //     if (!empty($this->input->post("search")["value"])) {
    //         $this->db->group_start();
    //         foreach ($columns as $column) {
    //             $this->db->or_like($column, $search);
    //         }
    //         $this->db->group_end();
    //     }

    //     // Ordering
    //     $this->db->order_by($order, $dir);

    //     // Pagination
    //     if ($limit != -1) {
    //         $sql .= " LIMIT $limit OFFSET $start";
    //     }
    //     $query = $this->db->get();
    //     $data = $query->result();

    //     // Total records count
    //     $total_records = $this->db->count_all_results("payment_notesheets");

    //     $output = array(
    //         "draw" => intval($this->input->post("draw")),
    //         "recordsTotal" => $total_records,
    //         "recordsFiltered" => $total_records,
    //         "data" => $data
    //     );

    //     echo json_encode($output);
    // }

    public function payment_notesheets()
    {
        $columns[] = "payment_notesheet_code";
        $columns[] = "puc_tracking_id";
        $columns[] = "district_name";
        //$columns[] = "puc_title";
        //$columns[] = "puc_detail";
        $columns[] = "puc_date";


        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        $search = $this->db->escape("%" . $this->input->post("search")["value"] . "%");
        // Manual SQL query building
        $sql = "SELECT *, d.district_name FROM payment_notesheets
        INNER JOIN districts as d ON(d.district_id = payment_notesheets.district_id)
        ";

        // Searching
        if (!empty($this->input->post("search")["value"])) {
            $sql .= " WHERE ";
            foreach ($columns as $column) {
                $sql .= "$column LIKE $search OR ";
            }
            $sql = rtrim($sql, "OR "); // Remove the last "OR"
        }

        // Ordering
        $sql .= " ORDER BY id DESC";

        // Pagination
        if ($limit != -1) {
            $sql .= " LIMIT $limit OFFSET $start";
        }

        $query = $this->db->query($sql);
        $data = $query->result();

        // Total records count
        $total_records = $this->db->query("SELECT COUNT(*) as count FROM payment_notesheets")->row()->count;

        $output = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        );

        echo json_encode($output);
    }

    public function view_payment_notesheets($payment_notesheet_id)
    {

        $payment_notesheet_id = (int) $payment_notesheet_id;
        $query = "SELECT payment_notesheets.*, districts.district_name FROM payment_notesheets 
        INNER JOIN districts ON payment_notesheets.district_id = districts.district_id
        WHERE id = $payment_notesheet_id";
        $payment_notesheet = $this->db->query($query)->row();
        $this->data["payment_notesheet"] = $payment_notesheet;


        $this->data["title"] = $payment_notesheet->payment_notesheet_code;
        $this->data["description"] = "Detail of Payment Note Sheet";
        $this->data["view"] = ADMIN_DIR . "payment_notesheets/view_payment_notesheets";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function seacrch_by_scheme_id()
    {
        $scheme_id = (int) $this->input->post('scheme_id');
        $payment_notesheet_id = (int) $this->input->post('payment_notesheet_id');

        $query = "SELECT district_id FROM `payment_notesheets` WHERE id= ?";
        $payment_notesheet = $this->db->query($query, [$payment_notesheet_id])->row();

        // Check if the scheme exists
        $query = "SELECT COUNT(*) as total FROM schemes WHERE scheme_id = ?";
        $scheme = $this->db->query($query, [$scheme_id])->row();



        if ($scheme && $scheme->total > 0) {
            // Check if the scheme is already linked to the payment notesheet
            $query = "SELECT scheme_status, district_id FROM schemes WHERE scheme_id = ?";
            $scheme = $this->db->query($query, [$scheme_id])->row();
            if ($scheme->district_id != $payment_notesheet->district_id) {
                echo '<span class="alert alert-danger">The scheme belongs to a different district. Please try again with a Valid Scheme Code.</span>';
                exit();
            }
            if ($scheme->scheme_status == 'Completed') {
                echo '<span class="alert alert-danger">Scheme is Completed</span>';
                exit();
            }




            $query = "SELECT COUNT(*) as total FROM payment_notesheet_schemes 
                  WHERE scheme_id = ? AND payment_notesheet_id = ?";
            $scheme_exists = $this->db->query($query, [$scheme_id, $payment_notesheet_id])->row();

            if ($scheme_exists && $scheme_exists->total == 0) {
                // Insert the new link
                $query = "INSERT INTO payment_notesheet_schemes (payment_notesheet_id, scheme_id) VALUES (?, ?)";
                if ($this->db->query($query, [$payment_notesheet_id, $scheme_id])) {
                    echo "success";
                } else {
                    echo "An error occurred while saving to the database.";
                }
            } else {
                echo "The scheme already exists in this list.";
            }
        } else {
            echo "The scheme was not found.";
        }
    }

    public function get_payment_notesheet_list()
    {
        $this->data['payment_notesheet_id'] = $payment_notesheet_id = (int) $this->input->post("payment_notesheet_id");
        $query = "SELECT payment_notesheets.*, districts.district_name FROM payment_notesheets 
        INNER JOIN districts ON payment_notesheets.district_id = districts.district_id
        WHERE id = $payment_notesheet_id";
        $payment_notesheet = $this->db->query($query)->row();
        $this->data["payment_notesheet"] = $payment_notesheet;


        $this->load->view(ADMIN_DIR . "payment_notesheets/payment_notesheet_list", $this->data);
    }

    public function remove($id, $payment_notesheet_id)
    {

        $id = (int) $id;
        $payment_notesheet_id =  (int) $payment_notesheet_id;
        $query = "DELETE FROM `payment_notesheet_schemes` WHERE id = $id";
        $this->db->query($query);

        redirect(ADMIN_DIR . "payment_notesheets/view_payment_notesheets/" . $payment_notesheet_id);
    }

    public function trash($payment_notesheet_id)
    {

        $payment_notesheet_id =  (int) $payment_notesheet_id;
        $query = "DELETE FROM `payment_notesheet_schemes` WHERE id = $payment_notesheet_id";
        $this->db->query($query);
        $payment_notesheet_id =  (int) $payment_notesheet_id;
        $query = "DELETE FROM `payment_notesheets` WHERE id = $payment_notesheet_id";
        $this->db->query($query);

        redirect(ADMIN_DIR . "payment_notesheets/index/");
    }



    public function get_payment_update_form()
    {
        $id = (int) $this->input->post("id");
        $query = "SELECT * FROM 
            payment_notesheet_schemes 
            WHERE id = $id";
        $this->data["input"] = $this->db->query($query)->row();
        $this->load->view(ADMIN_DIR . "payment_notesheets/get_payment_update_form", $this->data);
    }



    public function add_payment_amount()
    {
        $this->form_validation->set_rules("payment_amount", "Payment Amount", "required");
        $this->form_validation->set_rules("whit", "Whit", "required");
        $this->form_validation->set_rules("whst", "Whst", "required");
        $this->form_validation->set_rules("net_pay", "Net Pay", "required");
        $this->form_validation->set_rules("payment_type", "Payment Type", "required");
        if ($this->input->post("payment_type") == 'FINAL') {
            $this->form_validation->set_rules("completion_cost", "Completaion Cost", "required");
        }

        $completion_cost = $this->input->post("completion_cost");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {
            if ($this->input->post("payment_type") == 'FINAL') {

                $id = $this->input->post("id");
                $query = "SELECT scheme_id FROM `payment_notesheet_schemes` WHERE id = ?";
                $payment_scheme_id = $this->db->query($query, [$id])->row()->scheme_id;
                $query = "SELECT * FROM schemes WHERE scheme_id = ?";
                $scheme = $this->db->query($query, [$payment_scheme_id])->row();
                if ($completion_cost == '' or $completion_cost == NULL or $completion_cost == 0 or $completion_cost > $scheme->sanctioned_cost) {
                    echo '<div class="alert alert-danger">Scheme Completion Cost must be less than or equal to Scheme Sanctioned Cost.</div>';
                    exit();
                }
            }


            $s_inputs["sanctioned_cost"] = $completion_cost;
            $s_inputs["completion_cost"] = $completion_cost;
            $this->db->where("scheme_id", $payment_scheme_id);
            $this->db->update("schemes", $s_inputs);

            $inputs["payment_amount"] = $this->input->post("payment_amount");
            $inputs["whit"] = $this->input->post("whit");
            $inputs["whst"] = $this->input->post("whst");
            $inputs["net_pay"] = $this->input->post("net_pay");
            $inputs["payment_type"] = $this->input->post("payment_type");

            $inputs["last_updated"] = date('Y-m-d H:i:s');
            $id = $this->input->post("id");
            $this->db->where("id", $id);
            $this->db->update("payment_notesheet_schemes", $inputs);
            echo "success";
        }
    }

    public function print_payment_notesheet($payment_notesheet_id)
    {

        $payment_notesheet_id = (int) $payment_notesheet_id;
        $this->data["payment_notesheet_id"] = $payment_notesheet_id;
        $query = "SELECT payment_notesheets.*, districts.district_name FROM payment_notesheets 
        INNER JOIN districts ON payment_notesheets.district_id = districts.district_id
        WHERE id = $payment_notesheet_id";
        $payment_notesheet = $this->db->query($query)->row();
        $this->data["payment_notesheet"] = $payment_notesheet;

        $this->load->view(ADMIN_DIR . "payment_notesheets/print_payment_notesheet", $this->data);
    }
}
