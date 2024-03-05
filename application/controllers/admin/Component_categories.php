<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Component_categories extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/component_category_model");
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

        $where = "`component_categories`.`status` IN (0, 1) ";
        $data = $this->component_category_model->get_component_category_list($where);
        $this->data["component_categories"] = $data->component_categories;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Component Categories');
        $this->data["view"] = ADMIN_DIR . "component_categories/component_categories";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get single record by id
     */
    public function view_component_category($component_category_id)
    {

        $component_category_id = (int) $component_category_id;

        $this->data["component_categories"] = $this->component_category_model->get_component_category($component_category_id);
        $this->data["title"] = $this->lang->line('Component Category Details');
        $this->data["view"] = ADMIN_DIR . "component_categories/view_component_category";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get a list of all trashed items
     */
    public function trashed()
    {

        $where = "`component_categories`.`status` IN (2) ";
        $data = $this->component_category_model->get_component_category_list($where);
        $this->data["component_categories"] = $data->component_categories;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Trashed Component Categories');
        $this->data["view"] = ADMIN_DIR . "component_categories/trashed_component_categories";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * function to send a user to trash
     */
    public function trash($component_category_id, $page_id = NULL)
    {

        $component_category_id = (int) $component_category_id;


        $this->component_category_model->changeStatus($component_category_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        $previous_page = $this->input->server('HTTP_REFERER');
        redirect($previous_page);
    }

    /**
     * function to restor component_category from trash
     * @param $component_category_id integer
     */
    public function restore($component_category_id, $page_id = NULL)
    {

        $component_category_id = (int) $component_category_id;


        $this->component_category_model->changeStatus($component_category_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR . "component_categories/trashed/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to draft component_category from trash
     * @param $component_category_id integer
     */
    public function draft($component_category_id, $page_id = NULL)
    {

        $component_category_id = (int) $component_category_id;


        $this->component_category_model->changeStatus($component_category_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        $previous_page = $this->input->server('HTTP_REFERER');
        redirect($previous_page);
    }
    //---------------------------------------------------------------------------

    /**
     * function to publish component_category from trash
     * @param $component_category_id integer
     */
    public function publish($component_category_id, $page_id = NULL)
    {

        $component_category_id = (int) $component_category_id;


        $this->component_category_model->changeStatus($component_category_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR . "component_categories/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to permanently delete a Component_category
     * @param $component_category_id integer
     */
    public function delete($component_category_id, $page_id = NULL)
    {

        $component_category_id = (int) $component_category_id;
        //$this->component_category_model->changeStatus($component_category_id, "3");

        $this->component_category_model->delete(array('component_category_id' => $component_category_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR . "component_categories/trashed/" . $page_id);
    }
    //----------------------------------------------------



    /**
     * function to add new Component_category
     */
    public function add()
    {

        $this->data["projects"] = $this->component_category_model->getList("projects", "project_id", "project_name", $where = "`projects`.`status` IN (1) ");

        $this->data["components"] = $this->component_category_model->getList("components", "component_id", "component_name", $where = "`components`.`status` IN (1) ");

        $this->data["sub_components"] = $this->component_category_model->getList("sub_components", "sub_component_id", "sub_component_name", $where = "`sub_components`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Add New Component Category');
        $this->data["view"] = ADMIN_DIR . "component_categories/add_component_category";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------
    public function save_data()
    {
        if ($this->component_category_model->validate_form_data() === TRUE) {

            $component_category_id = $this->component_category_model->save_data();
            if ($component_category_id) {
                $this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR . "component_categories/edit/$component_category_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "component_categories/add");
            }
        } else {
            $this->add();
        }
    }


    /**
     * function to edit a Component_category
     */
    public function edit($component_category_id)
    {
        $component_category_id = (int) $component_category_id;
        $this->data["component_category"] = $this->component_category_model->get($component_category_id);

        $this->data["projects"] = $this->component_category_model->getList("projects", "project_id", "project_name", $where = "`projects`.`status` IN (1) ");

        $this->data["components"] = $this->component_category_model->getList("components", "component_id", "component_name", $where = "`components`.`status` IN (1) ");

        $this->data["sub_components"] = $this->component_category_model->getList("sub_components", "sub_component_id", "sub_component_name", $where = "`sub_components`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Edit Component Category');
        $this->data["view"] = ADMIN_DIR . "component_categories/edit_component_category";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------

    public function update_data($component_category_id)
    {

        $component_category_id = (int) $component_category_id;

        if ($this->component_category_model->validate_form_data() === TRUE) {

            $component_category_id = $this->component_category_model->update_data($component_category_id);
            if ($component_category_id) {

                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR . "component_categories/edit/$component_category_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "component_categories/edit/$component_category_id");
            }
        } else {
            $this->edit($component_category_id);
        }
    }


    /**
     * get data as a json array 
     */
    public function get_json()
    {
        $where = array("status" => 1);
        $where[$this->uri->segment(3)] = $this->uri->segment(4);
        $data["component_categories"] = $this->component_category_model->getBy($where, false, "component_category_id");
        $j_array[] = array("id" => "", "value" => "component_category");
        foreach ($data["component_categories"] as $component_category) {
            $j_array[] = array("id" => $component_category->component_category_id, "value" => "");
        }
        echo json_encode($j_array);
    }
    //-----------------------------------------------------

}
