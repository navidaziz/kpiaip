<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Verification extends Admin_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->lang->load("system", 'english');
        $this->load->model("admin/water_user_association_model");
        //$this->output->enable_profiler(TRUE);
    }


    public function index()
    {
        $this->data["title"] = 'Cheque and Scheme Verification';
        $this->data["description"] = 'Cheque and Scheme Verification and Conformation Dashboard';
        $this->data["view"] = ADMIN_DIR . "verification/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function search_cheque()
    {
        $this->data['cheque_no'] = $this->input->post('cheque_no');
        $this->load->view(ADMIN_DIR . "verification/cheque_detail", $this->data);
    }
    public function search_scheme()
    {
        $this->data['scheme_code'] = $this->input->post('scheme_code');
        $this->load->view(ADMIN_DIR . "verification/schem_detail", $this->data);
    }

    public function print_scheme_detail($scheme_id)
    {

        $scheme_id = (int) $scheme_id;
        $this->data["scheme_id"] = $scheme_id;
        $this->load->view(ADMIN_DIR . "expenses/print_scheme_detail", $this->data);
    }
}
