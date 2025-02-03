<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Brs extends Admin_Controller
{


    public function __construct()
    {

        parent::__construct();
        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    public function index()
    {
        $this->data["title"] = 'Reconciled Cheques List';
        $this->data["description"] = 'Bank Reconciliation Statement';
        $this->data["view"] = ADMIN_DIR . "brs/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function search_cheque()
    {
        $this->data['cheque_no'] = $this->input->post('cheque_no');
        $this->load->view(ADMIN_DIR . "brs/cheque_detail", $this->data);
    }

    public function change_cheque_status()
    {
        $expense_id = $this->input->post('expense_id');
        $brs = $this->input->post('brs');

        if (!empty($expense_id)) {
            // Update the expense record
            $this->db->where('expense_id', $expense_id);
            $this->db->update('expenses', ['brs' => $brs]);
        }

        // Redirect to index page
        redirect(ADMIN_DIR . 'brs/index');
    }
}
