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

    public function data_correction()
    {
        // $query="SELECT * FROM scheme_lists
        // WHERE scheme_status = 'Par-Completed'
        // AND scheme_name IN (SELECT payee_name FROM expenses) 
        // ORDER BY scheme_name ASC LIMIT 1000;";
        // $schemes = $this->db->query($query)->result();

        // $query="SELECT scheme_lists.*, 
        // (SELECT COUNT(*) 
        // FROM all_expenses 
        // WHERE scheme_name = scheme_lists.scheme_name 
        // AND district_id = scheme_lists.district_id 
        // AND component_category_id = scheme_lists.component_category_id
        // AND all_expenses.status IN('1st & 2nd', 'Final')
        // AND all_expenses.status != '1st') AS expense_count
        // FROM scheme_lists
        // WHERE scheme_status = 'Par-Completed'
        // HAVING expense_count IN(2) LIMIT 1000";

        $query = "SELECT scheme_lists.* 
        FROM scheme_lists 
        INNER JOIN all_expenses 
        ON scheme_lists.scheme_name = all_expenses.scheme_name 
        AND scheme_lists.district_id = all_expenses.district_id 
        AND scheme_lists.component_category_id = all_expenses.category_id 
        WHERE all_expenses.status IN ('1st & 2nd', 'Final') 
        AND scheme_lists.scheme_status = 'Par-Completed' 
        LIMIT 1000";


        $schemes = $this->db->query($query)->result();
            
        $this->data['schemes'] = $schemes;
        $this->load->view(ADMIN_DIR . "data/par_schemes", $this->data);


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