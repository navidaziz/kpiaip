<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Verification extends Admin_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }


    public function index()
    {
        $this->data["title"] = 'Cheque Verification';
        $this->data["description"] = 'Cheque Verification and Conformation Dashboard';
        $this->data["view"] = ADMIN_DIR . "verification/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function search_cheque()
    {
        $this->data['cheque_no'] = $this->input->post('cheque_no');
        $this->load->view(ADMIN_DIR . "verification/cheque_detail", $this->data);
    }
}
