<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Funds extends Admin_Controller
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
    //---------------------------------------------------------------


    /**
     * Default action to be called
     */
    public function index()
    {

        $this->data["title"] = 'KP-IAIP FINANCIAL PROGRESS';
        $this->data["description"] = 'REALTIME Dashboard';
        $this->data["view"] = ADMIN_DIR . "funds/funds_dashboard";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function add_word_bank_funds()
    {

        // Form validation rules
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('forex', 'Forex', 'required|numeric');
        $this->form_validation->set_rules('dollar_total', 'Dollar Total', 'required|numeric');
        //$this->form_validation->set_rules('rs_total', 'RS Total', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show errors or redirect to form page
            $this->load->view('add_release_form');
        } else {
            // Validation passed, insert data into database
            $date = $this->db->escape($this->input->post('date'));
            $query = "SELECT financial_year_id
            FROM financial_years
            WHERE " . $date . " BETWEEN start_date AND end_date;";
            $finacial_year = $this->db->query($query)->row();
            if ($finacial_year) {
                $financial_year_id = $finacial_year->financial_year_id;
            } else {
                $financial_year_id  = 0;
            }
            $inputs = array(
                'financial_year_id' => $financial_year_id,
                'date' => $this->input->post('date'),
                'forex' => $this->input->post('forex'),
                'dollar_total' => $this->input->post('dollar_total'),
                'rs_total' => ($this->input->post('dollar_total') * $this->input->post('forex'))
            );
            $this->db->insert('donor_funds_released', $inputs);
            $this->session->set_flashdata("msg_success", 'Donar Funds Release Add Successfully.');
            redirect(ADMIN_DIR . "funds");
        }
    }

    public function get_donor_funds_release_form()
    {
        $id = (int) $this->input->post('id');
        if ($id == 0) {
            $input['id'] = $id;
            $input['date'] = '';
            $input['forex'] = 1;
            $input['dollar_total'] = 0;
            $input['rs_total'] = 0;
            $input =  (object) $input;
        } else {
            $query = "SELECT * FROM donor_funds_released WHERE id = $id";
            $input = $this->db->query($query)->row();
        }
        $this->data['input'] = $input;
        $this->load->view(ADMIN_DIR . "funds/get_donor_funds_release_form", $this->data);
    }
    public function add_donor_funds_release()
    {

        // Form validation rules
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('forex', 'Forex', 'required|numeric');
        $this->form_validation->set_rules('dollar_total', 'Dollar Total', 'required|numeric');
        //$this->form_validation->set_rules('rs_total', 'RS Total', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger"> ' . validation_errors() . "</div>";
            exit();
        } else {
            // Validation passed, insert data into database
            $date = $this->db->escape($this->input->post('date'));
            $query = "SELECT financial_year_id
            FROM financial_years
            WHERE " . $date . " BETWEEN start_date AND end_date;";
            $finacial_year = $this->db->query($query)->row();
            if ($finacial_year) {
                $financial_year_id = $finacial_year->financial_year_id;
            } else {
                $financial_year_id  = 0;
            }
            if ($financial_year_id == 0) {
                echo '<div class="alert alert-danger">Please verify the date as there may be an error.</div>';
                exit();
            }
            $inputs = array(
                'financial_year_id' => $financial_year_id,
                'date' => $this->input->post('date'),
                'forex' => $this->input->post('forex'),
                'dollar_total' => $this->input->post('dollar_total'),
                'rs_total' => ($this->input->post('dollar_total') * $this->input->post('forex'))
            );
            $id = (int) $this->input->post('id');
            if ($id == 0) {
                $this->db->insert('donor_funds_released', $inputs);
            } else {
                $this->db->where('id', $id); // Assuming 'id' is the primary key of the table
                $this->db->update('donor_funds_released', $inputs);
            }
            echo "success";
        }
    }

    public function delete_donor_fund_released($id)
    {
        $id = (int) $id;
        $this->db->where("id", $id);
        $this->db->delete("donor_funds_released");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }

    public function get_budget_released_form()
    {
        $budget_released_id = (int) $this->input->post("budget_released_id");
        if ($budget_released_id == 0) {
            $input["budget_released_id"] = $this->input->post("budget_released_id");
            $input["date"] = $this->input->post("date");
            $input["rs_total"] = $this->input->post("rs_total");
            $input["remarks"] = $this->input->post("remarks");
            $input =  (object) $input;
        } else {
            $query = "SELECT * FROM 
            budget_released 
            WHERE budget_released_id = $budget_released_id";
            $input = $this->db->query($query)->row();
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "funds/get_budget_released_form", $this->data);
    }

    public function add_budget_released()
    {
        $this->form_validation->set_rules("date", "Date", "required");
        $this->form_validation->set_rules("rs_total", "Rs Total", "required");
        //$this->form_validation->set_rules("remarks", "Remarks", "required");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "<div>";
            exit();
        } else {
            $date = $this->db->escape($this->input->post('date'));
            $query = "SELECT financial_year_id
            FROM financial_years
            WHERE " . $date . " BETWEEN start_date AND end_date;";
            $finacial_year = $this->db->query($query)->row();
            if ($finacial_year) {
                $financial_year_id = $finacial_year->financial_year_id;
            } else {
                $financial_year_id  = 0;
            }
            $inputs = array(
                'financial_year_id' => $financial_year_id,
                "date" => $this->input->post("date"),
                "rs_total" => $this->input->post("rs_total"),
                "remarks" => $this->input->post("remarks"),
            );
            $budget_released_id = (int) $this->input->post("budget_released_id");
            if ($budget_released_id == 0) {
                $this->db->insert("budget_released", $inputs);
            } else {
                $this->db->where("budget_released_id", $budget_released_id);
                $this->db->update("budget_released", $inputs);
            }
            echo "success";
        }
    }

    public function delete_budget_released($budget_released_id)
    {
        $budget_released_id = (int) $budget_released_id;
        $this->db->where("budget_released_id", $budget_released_id);
        $this->db->delete("budget_released");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }

    public function dollar_current_price()
    {

        // Your API key from Open Exchange Rates
        $api_key = '184e5814fdfb404238b2f275';

        // Base currency (PKR in this case)
        $base_currency = 'USD';

        // Target currency (USD in this case)
        $target_currency = 'PKR';

        // Amount to convert
        $amount_in_pkr = 1; // Change this to the amount you want to convert
        // API endpoint URL
        $api_url = "https://v6.exchangerate-api.com/v6/184e5814fdfb404238b2f275/latest/$base_currency";

        // Fetching data from the API
        $response = file_get_contents($api_url);

        // Decode JSON response
        $data = json_decode($response, true);
        //var_dump($data);

        // Check if API request was successful
        if ($data && isset($data['conversion_rates'][$target_currency])) {
            // Extract the exchange rate
            $exchange_rate = $data['conversion_rates'][$target_currency];
            echo $exchange_rate;
            echo '<br />';
            echo 171000000 * $exchange_rate;
        } else {
            // If API request fails or data is not in the expected format
            echo "Failed to retrieve exchange rate data.";
        }
    }
}
