<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Expenses extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/expense_model");
        $this->load->model("admin/water_user_association_model");
        $this->lang->load("water_user_associations", 'english');
        $this->lang->load("wua_members", 'english');
        $this->lang->load("schemes", 'english');
        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------


    /**
     * Default action to be called
     */
    public function index()
    {
        $this->data["title"] = "Expenses Dashboard";
        $this->data["description"] = "All Expenses List";
        $this->data["view"] = ADMIN_DIR . "expenses/expenses_list";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function expense_form()
    {

        $expense_id = (int) $this->input->post('expense_id');
        if ($expense_id == 0) {
            $expense['expense_id'] = 0;
            $expense['scheme_id'] = 0;
            $expense['purpose'] = "";
            $expense['category'] = "";
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
            $query = "SELECT * FROM expenses WHERE expense_id = $expense_id";
            $expense = $this->db->query($query)->row();
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
            if ($expense_id == 0) {
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

    public function tax_expense_form()
    {


        $expense_id = (int) $this->input->post('expense_id');
        if ($expense_id == 0) {
            $expense['expense_id'] = 0;
            $expense['scheme_id'] = 0;
            $expense['purpose'] = "Operation Cost";
            $expense['district_id'] = 0;
            $expense['component_category_id'] = 0;
            $expense['payee_name'] = "";
            $expense['cheque'] = "";
            $expense['date'] = "";
            $expense['category'] = "";
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
            $query = "SELECT * FROM expenses WHERE expense_id = $expense_id";
            $expense = $this->db->query($query)->row();
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

        $this->load->view(ADMIN_DIR . "expenses/tax_expense_form", $this->data);
    }

    public function schemes()
    {
        $this->data["title"] = "Schemes Expense's Dashboard";
        $this->data["description"] = "Approved Schemes List";
        $this->data["view"] = ADMIN_DIR . "expenses/schemes_list";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function view_scheme_detail($scheme_id)
    {

        $scheme_id = (int) $scheme_id;


        $query = "SELECT * FROM schemes WHERE scheme_id = $scheme_id";
        //$scheme = $this->scheme_model->get_scheme($scheme_id)[0];
        $scheme = $this->db->query($query)->row();
        $this->data["scheme"] = $scheme;

        $this->data["water_user_association"] = $this->water_user_association_model->get_water_user_association($scheme->water_user_association_id)[0];
        $this->data["title"] = $scheme->scheme_name . " (" . $scheme->scheme_code . ")";
        $this->data["description"] = $this->data["water_user_association"]->wua_registration_no . " - " . $this->data["water_user_association"]->wua_name;
        $this->data["view"] = ADMIN_DIR . "expenses/view_scheme_detail";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function scheme_expense_form()
    {

        $purpose = $this->input->post('purpose');
        $expense_id = (int) $this->input->post('purpose');
        $scheme_id = (int) $this->input->post('scheme_id');
        $query = "SELECT * FROM schemes WHERE scheme_id = '" . $scheme_id . "'";
        $scheme = $this->db->query($query)->row();

        if ($expense_id == 0) {
            $expense['expense_id'] = 0;
            $expense['scheme_id'] = $scheme_id;
            $expense['purpose'] = $purpose;
            $expense['category'] = 'Scheme';
            $expense['project_id'] = $scheme->project_id;
            $expense['district_id'] = $scheme->district_id;
            $expense['component_category_id'] = $scheme->component_category_id;
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
}
