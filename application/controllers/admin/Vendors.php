<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vendors extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/vendor_model");
        $this->lang->load("vendors", 'english');
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

        $where = "`vendors`.`status` IN (0, 1) ";
        $this->data["vendors"] = $this->vendor_model->get_vendor_list($where, false);
        //$this->data["vendors"] = $data->vendors;
        //$this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Vendors');
        $this->data["view"] = ADMIN_DIR . "vendors/vendors";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get single record by id
     */
    public function view_vendor($vendor_id)
    {

        $vendor_id = (int) $vendor_id;

        $this->data["vendors"] = $this->vendor_model->get_vendor($vendor_id);
        $this->data["title"] = $this->lang->line('Vendor Details');
        $this->data["view"] = ADMIN_DIR . "vendors/view_vendor";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get a list of all trashed items
     */
    public function trashed()
    {

        $where = "`vendors`.`status` IN (2) ";
        $data = $this->vendor_model->get_vendor_list($where);
        $this->data["vendors"] = $data->vendors;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Trashed Vendors');
        $this->data["view"] = ADMIN_DIR . "vendors/trashed_vendors";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * function to send a user to trash
     */
    public function trash($vendor_id, $page_id = NULL)
    {

        $vendor_id = (int) $vendor_id;


        $this->vendor_model->changeStatus($vendor_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR . "vendors/view/" . $page_id);
    }

    /**
     * function to restor vendor from trash
     * @param $vendor_id integer
     */
    public function restore($vendor_id, $page_id = NULL)
    {

        $vendor_id = (int) $vendor_id;


        $this->vendor_model->changeStatus($vendor_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR . "vendors/trashed/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to draft vendor from trash
     * @param $vendor_id integer
     */
    public function draft($vendor_id, $page_id = NULL)
    {

        $vendor_id = (int) $vendor_id;


        $this->vendor_model->changeStatus($vendor_id, "0");
        $this->session->set_flashdata("msg_success", 'Dormant Successfully');
        redirect(ADMIN_DIR . "vendors/view_vendor/$vendor_id/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to publish vendor from trash
     * @param $vendor_id integer
     */
    public function publish($vendor_id, $page_id = NULL)
    {

        $vendor_id = (int) $vendor_id;


        $this->vendor_model->changeStatus($vendor_id, "1");
        $this->session->set_flashdata("msg_success", 'Active Successfully');
        redirect(ADMIN_DIR . "vendors/view_vendor/$vendor_id/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to permanently delete a Vendor
     * @param $vendor_id integer
     */
    public function delete($vendor_id, $page_id = NULL)
    {

        $vendor_id = (int) $vendor_id;
        //$this->vendor_model->changeStatus($vendor_id, "3");

        $this->vendor_model->delete(array('vendor_id' => $vendor_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR . "vendors/trashed/" . $page_id);
    }
    //----------------------------------------------------



    /**
     * function to add new Vendor
     */
    public function add()
    {

        $this->data["title"] = $this->lang->line('Add New Vendor');
        $this->data["view"] = ADMIN_DIR . "vendors/add_vendor";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------
    public function save_data()
    {
        if ($this->vendor_model->validate_form_data() === TRUE) {

            $vendor_id = $this->vendor_model->save_data();
            if ($vendor_id) {
                $this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR . "vendors/edit/$vendor_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "vendors/add");
            }
        } else {
            $this->add();
        }
    }


    /**
     * function to edit a Vendor
     */
    public function edit($vendor_id)
    {
        $vendor_id = (int) $vendor_id;
        $this->data["vendor"] = $this->vendor_model->get($vendor_id);

        $this->data["title"] = $this->lang->line('Edit Vendor');
        $this->data["view"] = ADMIN_DIR . "vendors/edit_vendor";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------

    public function update_data($vendor_id)
    {

        $vendor_id = (int) $vendor_id;

        if ($this->vendor_model->validate_form_data() === TRUE) {

            $vendor_id = $this->vendor_model->update_data($vendor_id);
            if ($vendor_id) {

                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR . "vendors/edit/$vendor_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "vendors/edit/$vendor_id");
            }
        } else {
            $this->edit($vendor_id);
        }
    }


    /**
     * get data as a json array 
     */
    public function get_json()
    {
        $where = array("status" => 1);
        $where[$this->uri->segment(3)] = $this->uri->segment(4);
        $data["vendors"] = $this->vendor_model->getBy($where, false, "vendor_id");
        $j_array[] = array("id" => "", "value" => "vendor");
        foreach ($data["vendors"] as $vendor) {
            $j_array[] = array("id" => $vendor->vendor_id, "value" => "");
        }
        echo json_encode($j_array);
    }
    //-----------------------------------------------------

}
