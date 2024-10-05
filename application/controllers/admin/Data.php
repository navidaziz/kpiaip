<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data extends Admin_Controller
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
    public function s_e_3()
    {
        //$where=" payment_count=2 and scheme_status='Need-Process' ";
        $where=" payment_count=3 and scheme_status='Need-Process' ";
        $query="SELECT wua_name FROM `scheme_lists` 
                WHERE ".$where."
                GROUP BY wua_name;";
        $wuas = $this->db->query($query)->result();
        foreach($wuas as $wua){
            $query="SELECT * FROM scheme_lists 
            WHERE ".$where."
            AND wua_name LIKE ".$this->db->escape($wua->wua_name)."";
            $wua->schemes = $this->db->query($query)->result();
        }
        $this->data['wuas'] = $wuas;
        $this->load->view(ADMIN_DIR . "data/scheme", $this->data);


}

public function payees(){
    $query='SELECT payee_name FROM expenses 
    WHERE component_category_id IN (1,2,3,4,5,6,7,8,9,11) 
    GROUP BY payee_name ORDER BY payee_name ASC LIMIT 500';
    $this->data['payees'] = $this->db->query($query)->result();
    $this->load->view(ADMIN_DIR . "data/expenses", $this->data);
}

}