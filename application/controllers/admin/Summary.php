<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends Admin_Controller
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

        $this->data["title"] = 'Summary Dashboard';
        $this->data["description"] = 'Summary Dashboard';
        $this->data["view"] = ADMIN_DIR . "summary/home_index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }


    public function remaining_cheques()
    {
        $this->data["title"] = 'Remaining Cheques';
        $this->data["description"] = 'Remaining Cheques';
        $this->data["view"] = ADMIN_DIR . "summary/remaining_cheques";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function get_cheque_detail()
    {
        $cheque_no = $this->input->post('cheque_no');

        $query = "SELECT * FROM expenses WHERE cheque = ? AND (scheme_id IS NULL OR scheme_id = 0)";

        $cheque_detail = $this->db->query($query, [$cheque_no])->row();

        if ($cheque_detail) {
            var_dump($cheque_detail);

            $district_id = $cheque_detail->district_id;
            //get water user association
            $query = "SELECT water_user_association_id FROM `water_user_associations` 
            WHERE wua_name LIKE '%B1&B3%' AND district_id = ? ;";
            $wua = $this->db->query($query, [$district_id])->row();
            if ($wua) {
                $wua_id = $wua->water_user_association_id;
            } else {
                echo "water user assosiation id not found.";
                exit();
            }
            $component_category_id = $cheque_detail->component_category_id;
            $scheme_name = $cheque_detail->payee_name;
            $financial_year_id = $cheque_detail->financial_year_id;

            $inputs = array();

            $inputs["project_id"]  =  1;
            $inputs["district_id"]  =  $district_id;
            $inputs["component_category_id"]  = $component_category_id;
            $inputs["scheme_name"]  =  $scheme_name;
            $inputs["water_source"]  =  "";
            $inputs["tehsil"]  =  "";
            $inputs["uc"]  =  "";
            $inputs["villege"]  =  "";
            $inputs["na"]  =  "";
            $inputs["pk"]  =  "";
            $inputs["latitude"]  =  0;
            $inputs["longitude"]  =  0;
            $inputs["male_beneficiaries"]  =  0;
            $inputs["female_beneficiaries"]  = 0;
            $inputs["beneficiaries"] = 0;

            $inputs["estimated_cost"]  =  0;

            $inputs["approved_cost"]  =  $this->input->post("approved_cost");

            $inputs["revised_cost"]  =  0;

            $inputs["sanctioned_cost"]  =  $cheque_detail->gross_pay;
            $inputs["completion_cost"]  =  $cheque_detail->gross_pay;
            $inputs["completion_date"] = $cheque_detail->date;

            $inputs["registration_date"]  =  NULL;
            $inputs["financial_year_id"]  =  $financial_year_id;
            $inputs["phy_completion"] = 'Yes';
            $inputs["phy_completion_date"] = $cheque_detail->date;

            $inputs["water_user_association_id"]  =  $wua_id;
            $inputs["scheme_status"]  =  'Completed';
            $inputs["created_by"] = $this->session->userdata("userId");
            $inputs["last_updated"] = date('Y-m-d H:i:s');
            var_dump($inputs);

            // $scheme_id = $this->scheme_model->save($inputs);
            // $scheme_code["scheme_code"]  =  str_pad($scheme_id, 4, '0', STR_PAD_LEFT);;
            // $this->scheme_model->save($scheme_code, $scheme_id);
            // return $scheme_id;
        } else {
            echo "Cheque Detail Not Found.";
        }
    }
}
