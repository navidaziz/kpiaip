<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Advices extends CI_Controller
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
    public function index()
    {
        $this->data["title"] = 'Advices';
        $this->data["description"] = 'Advices Dashboard';
        $this->data["view"] = ADMIN_DIR . "advices/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
}
