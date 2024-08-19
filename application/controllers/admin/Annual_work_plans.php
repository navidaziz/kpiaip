<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Annual_work_plans extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/annual_work_plan_model");
        $this->load->model("admin/district_annual_work_plan_model");
        $this->lang->load("annual_work_plans", 'english');
        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------


    /**
     * Default action to be called
     */
    public function index()
    {
        $main_page = base_url() . ADMIN_DIR . $this->router->fetch_class() . "/view";
        redirect($main_page);
    }
    //---------------------------------------------------------------



    /**
     * get a list of all items that are not trashed
     */
    public function view()
    {

        $filter = $this->input->get('filter');
        if (!is_null($filter)) {
            $filter = $filter;
        } else {
            $filter = 'categories';
        }
        $this->data['filter'] = $filter;
        //$where = "`annual_work_plans`.`status` IN (0, 1) ";
        //$data = $this->annual_work_plan_model->get_annual_work_plan_list($where);
        //$this->data["annual_work_plans"] = $data->annual_work_plans;
        //$this->data["pagination"] = $data->pagination;
        if ($filter == 'categories') {
            $this->data["title"] = 'Components Categories Wise Annual Work Plans';
        }
        if ($filter == 'sub_components') {
            $this->data["title"] = 'Sub Components Wise Annual Work Plans';
        }
        if ($filter == 'components') {
            $this->data["title"] = 'Components Wise Annual Work Plans';
        }

        $this->data["view"] = ADMIN_DIR . "annual_work_plans/annual_work_plans";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get single record by id
     */
    public function view_annual_work_plan($annual_work_plan_id)
    {

        $annual_work_plan_id = (int) $annual_work_plan_id;

        $this->data["annual_work_plans"] = $this->annual_work_plan_model->get_annual_work_plan($annual_work_plan_id);
        $this->data["title"] = $this->lang->line('Annual Work Plan Details');
        $this->data["view"] = ADMIN_DIR . "annual_work_plans/view_annual_work_plan";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get a list of all trashed items
     */
    public function trashed()
    {

        $where = "`annual_work_plans`.`status` IN (2) ";
        $data = $this->annual_work_plan_model->get_annual_work_plan_list($where);
        $this->data["annual_work_plans"] = $data->annual_work_plans;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Trashed Annual Work Plans');
        $this->data["view"] = ADMIN_DIR . "annual_work_plans/trashed_annual_work_plans";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * function to send a user to trash
     */
    public function trash($annual_work_plan_id, $page_id = NULL)
    {

        $annual_work_plan_id = (int) $annual_work_plan_id;


        $this->annual_work_plan_model->changeStatus($annual_work_plan_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR . "annual_work_plans/view/" . $page_id);
    }

    /**
     * function to restor annual_work_plan from trash
     * @param $annual_work_plan_id integer
     */
    public function restore($annual_work_plan_id, $page_id = NULL)
    {

        $annual_work_plan_id = (int) $annual_work_plan_id;


        $this->annual_work_plan_model->changeStatus($annual_work_plan_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR . "annual_work_plans/trashed/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to draft annual_work_plan from trash
     * @param $annual_work_plan_id integer
     */
    public function draft($annual_work_plan_id, $page_id = NULL)
    {

        $annual_work_plan_id = (int) $annual_work_plan_id;


        $this->annual_work_plan_model->changeStatus($annual_work_plan_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR . "annual_work_plans/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to publish annual_work_plan from trash
     * @param $annual_work_plan_id integer
     */
    public function publish($annual_work_plan_id, $page_id = NULL)
    {

        $annual_work_plan_id = (int) $annual_work_plan_id;


        $this->annual_work_plan_model->changeStatus($annual_work_plan_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR . "annual_work_plans/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to permanently delete a Annual_work_plan
     * @param $annual_work_plan_id integer
     */
    public function delete($annual_work_plan_id, $page_id = NULL)
    {

        $annual_work_plan_id = (int) $annual_work_plan_id;
        //$this->annual_work_plan_model->changeStatus($annual_work_plan_id, "3");

        $this->annual_work_plan_model->delete(array('annual_work_plan_id' => $annual_work_plan_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR . "annual_work_plans/trashed/" . $page_id);
    }
    //----------------------------------------------------



    /**
     * function to add new Annual_work_plan
     */
    public function add()
    {

        $this->data["projects"] = $this->annual_work_plan_model->getList("projects", "project_id", "project_name", $where = "`projects`.`status` IN (1) ");

        $this->data["components"] = $this->annual_work_plan_model->getList("components", "component_id", "component_name", $where = "`components`.`status` IN (1) ");

        $this->data["sub_components"] = $this->annual_work_plan_model->getList("sub_components", "sub_component_id", "sub_component_name", $where = "`sub_components`.`status` IN (1) ");

        $this->data["component_categories"] = $this->annual_work_plan_model->getList("component_categories", "component_category_id", "category", $where = "`component_categories`.`status` IN (1) ");

        $this->data["financial_years"] = $this->annual_work_plan_model->getList("financial_years", "financial_year_id", "financial_year", $where = "`financial_years`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Add New Annual Work Plan');
        $this->data["view"] = ADMIN_DIR . "annual_work_plans/add_annual_work_plan";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------
    public function save_data()
    {
        if ($this->annual_work_plan_model->validate_form_data() === TRUE) {

            $annual_work_plan_id = $this->annual_work_plan_model->save_data();
            if ($annual_work_plan_id) {
                $this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR . "annual_work_plans/edit/$annual_work_plan_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "annual_work_plans/add");
            }
        } else {
            $this->add();
        }
    }


    /**
     * function to edit a Annual_work_plan
     */
    public function edit($annual_work_plan_id)
    {
        $annual_work_plan_id = (int) $annual_work_plan_id;
        $this->data["annual_work_plan"] = $this->annual_work_plan_model->get($annual_work_plan_id);

        $this->data["projects"] = $this->annual_work_plan_model->getList("projects", "project_id", "project_name", $where = "`projects`.`status` IN (1) ");

        $this->data["components"] = $this->annual_work_plan_model->getList("components", "component_id", "component_name", $where = "`components`.`status` IN (1) ");

        $this->data["sub_components"] = $this->annual_work_plan_model->getList("sub_components", "sub_component_id", "sub_component_name", $where = "`sub_components`.`status` IN (1) ");

        $this->data["component_categories"] = $this->annual_work_plan_model->getList("component_categories", "component_category_id", "category", $where = "`component_categories`.`status` IN (1) ");

        $this->data["financial_years"] = $this->annual_work_plan_model->getList("financial_years", "financial_year_id", "financial_year", $where = "`financial_years`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Edit Annual Work Plan');
        $this->data["view"] = ADMIN_DIR . "annual_work_plans/edit_annual_work_plan";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------

    public function update_data($annual_work_plan_id)
    {

        $annual_work_plan_id = (int) $annual_work_plan_id;

        if ($this->annual_work_plan_model->validate_form_data() === TRUE) {

            $annual_work_plan_id = $this->annual_work_plan_model->update_data($annual_work_plan_id);
            if ($annual_work_plan_id) {

                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR . "annual_work_plans/edit/$annual_work_plan_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "annual_work_plans/edit/$annual_work_plan_id");
            }
        } else {
            $this->edit($annual_work_plan_id);
        }
    }


    /**
     * get data as a json array 
     */
    public function get_json()
    {
        $where = array("status" => 1);
        $where[$this->uri->segment(3)] = $this->uri->segment(4);
        $data["annual_work_plans"] = $this->annual_work_plan_model->getBy($where, false, "annual_work_plan_id");
        $j_array[] = array("id" => "", "value" => "annual_work_plan");
        foreach ($data["annual_work_plans"] as $annual_work_plan) {
            $j_array[] = array("id" => $annual_work_plan->annual_work_plan_id, "value" => "");
        }
        echo json_encode($j_array);
    }
    //-----------------------------------------------------

    public function view_component_category($component_category_id)
    {
        $component_category_id = (int) $component_category_id;
        $query = "SELECT cs.*,  
        c.component_name,
        sc.sub_component_name,
        sc.sub_component_detail
        FROM component_categories  as cs
        INNER JOIN components as c ON(c.component_id = cs.component_id)
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cs.component_id)
        WHERE cs.component_category_id = '" . $component_category_id . "'";
        $component_category = $this->db->query($query)->row();

        $this->data['title'] = $component_category->category . ': ' . $component_category->category_detail . '';
        $this->data['description'] = $component_category->component_name . " / " . $component_category->sub_component_name . ': ' . $component_category->sub_component_detail . '';
        $this->data["component_category"] =  $component_category;
        $this->data["view"] = ADMIN_DIR . "annual_work_plans/component_category_awp";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function district_annual_work_plan($annual_work_plan_id)
    {
        $annual_work_plan_id = (int) $annual_work_plan_id;
        $query = "SELECT * FROM `annual_work_plans` WHERE annual_work_plan_id = '" . $annual_work_plan_id . "'";
        $this->data['annual_work_plan'] = $annual_work_plan = $this->db->query($query)->row();

        $component_category_id = $annual_work_plan->component_category_id;
        $query = "SELECT cs.*,  
        c.component_name,
        sc.sub_component_name,
        sc.sub_component_detail
        FROM component_categories  as cs
        INNER JOIN components as c ON(c.component_id = cs.component_id)
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cs.component_id)
        WHERE cs.component_category_id = '" . $component_category_id . "'";
        $component_category = $this->db->query($query)->row();
        $this->data['component_category'] = $component_category;
        $query = "SELECT * FROM financial_years WHERE financial_year_id='" . $annual_work_plan->financial_year_id . "'";
        $f_year = $this->db->query($query)->row();

        $this->data['title'] = $component_category->category . ' District Wise AWP For Financial Year: ' . $f_year->financial_year;
        $this->data['description'] = $component_category->category . ': ' . $component_category->category_detail . '<br />' . $component_category->component_name . " / " . $component_category->sub_component_name . ': ' . $component_category->sub_component_detail . '';
        $this->data["component_category"] =  $component_category;
        $this->data["view"] = ADMIN_DIR . "annual_work_plans/district_annual_work_plan";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function district_awp_form()
    {

        $annual_work_plan_id = $this->input->post('annual_work_plan_id');
        $district_annual_work_plan_id = $this->input->post('district_annual_work_plan_id');
        $query = "SELECT * FROM `annual_work_plans` WHERE annual_work_plan_id = '" . $annual_work_plan_id . "'";
        $this->data['annual_work_plan'] = $annual_work_plan = $this->db->query($query)->row();
        $query = "SELECT * FROM districts";
        $this->data['districts'] = $this->db->query($query)->result();


        $query = "SELECT * FROM financial_years WHERE financial_year_id='" . $annual_work_plan->financial_year_id . "'";
        $f_year = $this->db->query($query)->row();

        if ($district_annual_work_plan_id == 0) {
            $this->data['title'] = "Add District Annual Work Plan Detail For Financial Year  $f_year->financial_year";

            $d_annual_work_plan['district_annual_work_plan_id'] = $district_annual_work_plan_id;
            $d_annual_work_plan['annual_work_plan_id'] = $annual_work_plan->annual_work_plan_id;
            $d_annual_work_plan['component_category_id'] = $annual_work_plan->component_category_id;
            $d_annual_work_plan['project_id'] = $annual_work_plan->project_id;
            $d_annual_work_plan['component_id'] = $annual_work_plan->component_id;
            $d_annual_work_plan['sub_component_id'] = $annual_work_plan->sub_component_id;
            $d_annual_work_plan['financial_year_id'] = $annual_work_plan->financial_year_id;
            $d_annual_work_plan['district_id'] = 0;
            $d_annual_work_plan['anual_target'] = 0;
            $d_annual_work_plan['material_cost'] = 0; // Typo in 'material'
            $d_annual_work_plan['labor_cost'] = 0;
            $d_annual_work_plan['farmer_share'] = 0;
            $d_annual_work_plan['total_cost'] = 0;
            $d_annual_work_plan =  (object) $d_annual_work_plan;
        } else {
            $this->data['title'] = "Update Annual Work Plan Detail For Financial Year  $f_year->financial_year";
            $query = "SELECT * FROM district_annual_work_plans WHERE district_annual_work_plan_id = '" . $district_annual_work_plan_id . "'";
            $d_annual_work_plan = $this->db->query($query)->row();
        }
        $this->data['d_annual_work_plan'] = $d_annual_work_plan;
        $this->load->view(ADMIN_DIR . "annual_work_plans/district_awp_form", $this->data);
    }
    public function awp_form()
    {

        $annual_work_plan_id = $this->input->post('annual_work_plan_id');
        $financial_year_id = $this->input->post('financial_year_id');
        $query = "SELECT * FROM financial_years WHERE financial_year_id='" . $financial_year_id . "'";
        $f_year = $this->db->query($query)->row();

        if ($annual_work_plan_id == 0) {
            $this->data['title'] = "Add Annual Work Plan Detail For Financial Year  $f_year->financial_year";
            $annual_work_plan['annual_work_plan_id'] = 0;
            $annual_work_plan['component_category_id'] = (int) $this->input->post('component_category_id');
            $annual_work_plan['project_id'] = (int) $this->input->post('project_id');
            $annual_work_plan['component_id'] = (int) $this->input->post('component_id');
            $annual_work_plan['sub_component_id'] = (int) $this->input->post('sub_component_id');
            $annual_work_plan['financial_year_id'] = (int) $this->input->post('financial_year_id');
            $annual_work_plan['component_category_id'] = (int) $this->input->post('component_category_id');
            $annual_work_plan['anual_target'] = 0;
            $annual_work_plan['material_cost'] = 0; // Typo in 'material'
            $annual_work_plan['labor_cost'] = 0;
            $annual_work_plan['farmer_share'] = 0;
            $annual_work_plan['total_cost'] = 0;
            $annual_work_plan =  (object) $annual_work_plan;
        } else {
            $this->data['title'] = "Update Annual Work Plan Detail For Financial Year  $f_year->financial_year";
            $annual_work_plan = $this->annual_work_plan_model->get_annual_work_plan($annual_work_plan_id)[0];
        }
        $this->data['annual_work_plan'] = $annual_work_plan;
        $this->load->view(ADMIN_DIR . "annual_work_plans/awp_form", $this->data);
    }

    public function add_awp()
    {



        

        if ($this->annual_work_plan_model->validate_form_data() === TRUE) {
            $annual_work_plan_id = (int) $this->input->post('annual_work_plan_id');
            if ($annual_work_plan_id == 0) {

                $component_category_id = $this->input->post('component_category_id');
                $financial_year_id = $this->input->post('financial_year_id');

                $query="SELECT COUNT(*) as total FROM annual_work_plans 
                        WHERE component_category_id = ? 
                        AND financial_year_id = ?";
                $total = $this->db->query($query, array($component_category_id,$financial_year_id))->row()->total;        
if($total==0){

                $annual_work_plan_id = $this->annual_work_plan_model->save_data();
}else{
    echo '<div class="alert alert-danger"> Duplicate Entry<div>';
    exit();
}
            } else {
                $annual_work_plan_id = $this->annual_work_plan_model->update_data($annual_work_plan_id);
            }




            if ($annual_work_plan_id) {
                echo "success";
            } else {
                echo  "Error While Adding or Updating the record.";
            }
        } else {

            echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
        }
    }

    public function add_district_awp()
    {
        if ($this->district_annual_work_plan_model->validate_form_data() === TRUE) {
            $district_annual_work_plan_id = (int) $this->input->post('district_annual_work_plan_id');
            if ($district_annual_work_plan_id == 0) {
                $district_annual_work_plan_id = $this->district_annual_work_plan_model->save_data();
            } else {
                $district_annual_work_plan_id = $this->district_annual_work_plan_model->update_data($district_annual_work_plan_id);
            }




            if ($district_annual_work_plan_id) {
                echo "success";
            } else {
                echo  "Error While Adding or Updating the record.";
            }
        } else {

            echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
        }
    }
    public function district_annual_work_plan_report()
    {
        $fy = $this->input->get('fy');
        if (!is_null($fy)) {
            $financial_year_id = $fy;
        } else {
            $query = "SELECT financial_year_id FROM financial_years WHERE status=1";
            $f_years = $this->db->query($query)->row();
            $financial_year_id = $f_years->financial_year_id;
        }

        $query = "SELECT * FROM financial_years WHERE financial_year_id=?";
        $fy = $this->db->query($query, array($financial_year_id))->row();
        $this->data['fy'] = $fy;

        $this->data["title"] = 'Districts and Category Wise Annual Work Plan Report';
        $this->data["description"] = 'For FY: ' . $fy->financial_year;
        $this->data["view"] = ADMIN_DIR . "annual_work_plans/district_annual_work_plan_report";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
}