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
}
