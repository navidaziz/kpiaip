<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Direct_payments extends Admin_Controller
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

    public function index() {}

    private function get_inputs()
    {
        $input["id"] = $this->input->post("id");
        $input["payee_name"] = $this->input->post("payee_name");
        $input["iban_no"] = $this->input->post("iban_no");
        $input["bank_name"] = $this->input->post("bank_name");
        $input["branch_code"] = $this->input->post("branch_code");
        $input["address"] = $this->input->post("address");
        $input["country_state"] = $this->input->post("country_state");
        $input["mode_of_payment"] = $this->input->post("mode_of_payment");
        $input["wa_ref_no"] = $this->input->post("wa_ref_no");
        $input["purpose_of_payment"] = $this->input->post("purpose_of_payment");
        $input["currency"] = $this->input->post("currency");
        $input["forex"] = $this->input->post("forex");
        $input["component_category_id"] = $this->input->post("component_category_id");
        $input["amount_usd"] = $this->input->post("amount_usd");
        $input["amount_pkr"] = $this->input->post("amount_pkr");
        $input["amount_other"] = $this->input->post("amount_other");
        $input["payment_date"] = $this->input->post("payment_date");
        $inputs =  (object) $input;
        return $inputs;
    }

    public function get_direct_payment_form()
    {
        $id = (int) $this->input->post("id");
        if ($id == 0) {

            $input = $this->get_inputs();
        } else {
            $query = "SELECT * FROM 
            direct_payments 
            WHERE id = $id";
            $input = $this->db->query($query)->row();
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "direct_payments/get_direct_payment_form", $this->data);
    }
    public function add_direct_payment()
    {
        $this->form_validation->set_rules("payee_name", "Payee Name", "required");
        $this->form_validation->set_rules("iban_no", "Iban No", "required");
        $this->form_validation->set_rules("bank_name", "Bank Name", "required");
        $this->form_validation->set_rules("branch_code", "Branch Code", "required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules("country_state", "Country State", "required");
        $this->form_validation->set_rules("mode_of_payment", "Mode Of Payment", "required");
        $this->form_validation->set_rules("wa_ref_no", "WA Ref No", "required");
        $this->form_validation->set_rules("purpose_of_payment", "Purpose Of Payment", "required");
        $this->form_validation->set_rules("currency", "Currency", "required");
        $this->form_validation->set_rules("component_category_id", "Component Category", "required");
        $this->form_validation->set_rules("amount_usd", "Amount Usd", "required");
        $this->form_validation->set_rules("amount_pkr", "Amount Pkr", "required");
        $this->form_validation->set_rules("amount_other", "Amount Other", "required");
        $this->form_validation->set_rules("payment_date", "Payment Date", "required");


        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {
            // Validation passed, insert data into database
            $date = $this->db->escape($this->input->post('payment_date'));
            $query = "SELECT financial_year_id
            FROM financial_years
            WHERE " . $date . " BETWEEN start_date AND end_date;";
            $finacial_year = $this->db->query($query)->row();
            if ($finacial_year) {
                $financial_year_id = $finacial_year->financial_year_id;
            } else {
                $financial_year_id  = 0;
            }
            $inputs = $this->get_inputs();
            $inputs->financial_year_id = $financial_year_id;
            $inputs->created_by = $this->session->userdata("userId");
            $id = (int) $this->input->post("id");
            if ($id == 0) {
                $this->db->insert("direct_payments", $inputs);
            } else {
                $this->db->where("id", $id);
                $inputs->last_updated = date('Y-m-d H:i:s');
                $this->db->update("direct_payments", $inputs);
            }
            echo "success";
        }
    }
    public function delete_direct_payment($id)
    {
        $id = (int) $id;
        $this->db->where("id", $id);
        $this->db->delete("direct_payments");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }
}
