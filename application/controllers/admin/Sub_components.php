<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sub_components extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/sub_component_model");
        $this->load->model("admin/component_category_model");

        $this->lang->load("sub_components", 'english');
        $this->lang->load("component_categories", 'english');
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

        $where = "`sub_components`.`status` IN (0, 1) ";
        $data = $this->sub_component_model->get_sub_component_list($where, false);
        // $this->data["sub_components"] = $data->sub_components;
        $this->data["sub_components"] = $this->sub_component_model->get_sub_component_list($where, false);
        //$this->data["pagination"] = $data->pagination;
        $this->data["title"] = "Project Compoments";
        $this->data["description"] = "Project Sub Compoments / Categories";
        $this->data["view"] = ADMIN_DIR . "sub_components/sub_components";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get single record by id
     */
    public function view_sub_component($sub_component_id)
    {

        $sub_component_id = (int) $sub_component_id;

        $this->data["sub_component"] = $this->sub_component_model->get_sub_component($sub_component_id)[0];
        $this->data["title"] = $this->lang->line('Sub Component Details');
        $this->data["view"] = ADMIN_DIR . "sub_components/view_sub_component";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get a list of all trashed items
     */
    public function trashed()
    {

        $where = "`sub_components`.`status` IN (2) ";
        $data = $this->sub_component_model->get_sub_component_list($where);
        $this->data["sub_components"] = $data->sub_components;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Trashed Sub Components');
        $this->data["view"] = ADMIN_DIR . "sub_components/trashed_sub_components";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * function to send a user to trash
     */
    public function trash($sub_component_id, $page_id = NULL)
    {

        $sub_component_id = (int) $sub_component_id;


        $this->sub_component_model->changeStatus($sub_component_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR . "sub_components/view/" . $page_id);
    }

    /**
     * function to restor sub_component from trash
     * @param $sub_component_id integer
     */
    public function restore($sub_component_id, $page_id = NULL)
    {

        $sub_component_id = (int) $sub_component_id;


        $this->sub_component_model->changeStatus($sub_component_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR . "sub_components/trashed/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to draft sub_component from trash
     * @param $sub_component_id integer
     */
    public function draft($sub_component_id, $page_id = NULL)
    {

        $sub_component_id = (int) $sub_component_id;


        $this->sub_component_model->changeStatus($sub_component_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR . "sub_components/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to publish sub_component from trash
     * @param $sub_component_id integer
     */
    public function publish($sub_component_id, $page_id = NULL)
    {

        $sub_component_id = (int) $sub_component_id;


        $this->sub_component_model->changeStatus($sub_component_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR . "sub_components/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to permanently delete a Sub_component
     * @param $sub_component_id integer
     */
    public function delete($sub_component_id, $page_id = NULL)
    {

        $sub_component_id = (int) $sub_component_id;
        //$this->sub_component_model->changeStatus($sub_component_id, "3");

        $this->sub_component_model->delete(array('sub_component_id' => $sub_component_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR . "sub_components/trashed/" . $page_id);
    }
    //----------------------------------------------------



    /**
     * function to add new Sub_component
     */
    public function add()
    {

        $this->data["projects"] = $this->sub_component_model->getList("projects", "project_id", "project_name", $where = "`projects`.`status` IN (1) ");

        $this->data["components"] = $this->sub_component_model->getList("components", "component_id", "component_name", $where = "`components`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Add New Sub Component');
        $this->data["view"] = ADMIN_DIR . "sub_components/add_sub_component";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------
    public function save_data()
    {
        if ($this->sub_component_model->validate_form_data() === TRUE) {

            $sub_component_id = $this->sub_component_model->save_data();
            if ($sub_component_id) {
                $this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR . "sub_components/edit/$sub_component_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "sub_components/add");
            }
        } else {
            $this->add();
        }
    }


    /**
     * function to edit a Sub_component
     */
    public function edit($sub_component_id)
    {
        $sub_component_id = (int) $sub_component_id;
        $this->data["sub_component"] = $this->sub_component_model->get($sub_component_id);

        $this->data["projects"] = $this->sub_component_model->getList("projects", "project_id", "project_name", $where = "`projects`.`status` IN (1) ");

        $this->data["components"] = $this->sub_component_model->getList("components", "component_id", "component_name", $where = "`components`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Edit Sub Component');
        $this->data["view"] = ADMIN_DIR . "sub_components/edit_sub_component";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------

    public function update_data($sub_component_id)
    {

        $sub_component_id = (int) $sub_component_id;

        if ($this->sub_component_model->validate_form_data() === TRUE) {

            $sub_component_id = $this->sub_component_model->update_data($sub_component_id);
            if ($sub_component_id) {

                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR . "sub_components/edit/$sub_component_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "sub_components/edit/$sub_component_id");
            }
        } else {
            $this->edit($sub_component_id);
        }
    }


    /**
     * get data as a json array 
     */
    public function get_json()
    {
        $where = array("status" => 1);
        $where[$this->uri->segment(3)] = $this->uri->segment(4);
        $data["sub_components"] = $this->sub_component_model->getBy($where, false, "sub_component_id");
        $j_array[] = array("id" => "", "value" => "sub_component");
        foreach ($data["sub_components"] as $sub_component) {
            $j_array[] = array("id" => $sub_component->sub_component_id, "value" => "");
        }
        echo json_encode($j_array);
    }
    //-----------------------------------------------------

    public function sub_component_category_form()
    {

        $component_category_id = $this->input->post('component_category_id');
        if ($component_category_id == 0) {
            $this->data['title'] = "Add New Category";
            $component_category['component_category_id'] = 0;
            $component_category['project_id'] = (int) $this->input->post('project_id');
            $component_category['component_id'] = (int) $this->input->post('component_id');
            $component_category['sub_component_id'] = (int) $this->input->post('sub_component_id');
            $component_category['category'] = '';
            $component_category['category_detail'] = '';
            $component_category['target_unit'] = '';
            $component_category['target'] = 0; // Looks like this line is duplicated
            $component_category['material_cost'] = 0; // Typo in 'material'
            $component_category['labor_cost'] = 0;
            $component_category['farmer_share'] = 0;
            $component_category['total_cost'] = 0;
            $component_category =  (object) $component_category;
        } else {
            $this->data['title'] = "Update Category Detail";
            $component_category = $this->component_category_model->get_component_category($component_category_id)[0];
        }
        $this->data['component_category'] = $component_category;
        $this->load->view(ADMIN_DIR . "sub_components/sub_component_category_form", $this->data);
    }

    public function add_component_category()
    {
        if ($this->component_category_model->validate_form_data() === TRUE) {
            $component_category_id = (int) $this->input->post('component_category_id');
            if ($component_category_id == 0) {
                $component_category_id = $this->component_category_model->save_data();
            } else {
                $component_category_id = $this->component_category_model->update_data($component_category_id);
            }




            if ($component_category_id) {
                echo "success";
            } else {
                echo  "Error While Adding or Updating the record.";
            }
        } else {

            echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
        }
    }
}
