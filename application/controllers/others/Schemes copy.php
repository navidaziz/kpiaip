<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Schemes extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/scheme_model");
        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------


    /**
     * Default action to be called
     */
    public function index()
    {
        $this->data["title"] = "Water Users Association";
        $this->data["description"] = "Water User Association Schemes List";
        $this->data["view"] = ADMIN_DIR . "scheme/schemes_list";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function expense_form()
    {

        $purpose = $this->input->post('purpose');
        $expense_id = (int) $this->input->post('purpose');
        if ($expense_id == 0) {
            $expense['expense_id'] = 0;
            $expense['purpose'] = $purpose;
            $expense['district_id'] = 0;
            $expense['component_category_id'] = 0;
            $expense['payee_name'] = "";
            $expense['cheque'] = "";
            $expense['date'] = "";
            $expense['gross_pay'] = 0.00;
            $expense['whit_tax'] = 0.00;
            $expense['whst_tax'] = 0.00;
            $expense['rdp_tax'] = 0.00;
            $expense['st_duty_tax'] = 0.00;
            $expense['misc_deduction'] = 0.00;
            $expense['net_pay'] = 0.00;
            //scheme fields are required
            $expense =  (object) $expense;
        } else {
            $query = "SELECT * FROM expense WHERE expense_id = $expense_id";
            $expense = $this->db->query($query)->result();
        }
        $this->data['expense'] = $expense;
        $this->data['districts'] = $this->db->query('SELECT district_id, district_name, region FROM districts')->result();
        $query = "SELECT cc.component_category_id,
        cc.category,
        sc.sub_component_name,
        s.component_name
        FROM component_categories as cc
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.component_category_id)
        INNER JOIN components as s ON(s.component_id = cc.component_id)";
        $this->data['component_catagories'] = $this->db->query($query)->result();

        $this->load->view(ADMIN_DIR . "expenses/expense_form", $this->data);
    }


    public function add_expense()
    {
        if ($this->expense_model->validate_form_data() === TRUE) {
            $expense_id = (int) $this->input->post('expense_id');
            if ($expense_id) {
                $expense_id = $this->expense_model->save_data();
            } else {
                $expense_id = $this->expense_model->update_data($expense_id);
            }
            if ($expense_id) {
                echo "success";
            } else {
                echo  "Error While Adding or Updating the record.";
            }
        } else {

            echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
        }
    }
}
