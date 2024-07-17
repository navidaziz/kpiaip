<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Vendors extends Public_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
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
    public function index(){
        $this->view();
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`status` IN (1) ";
		$data = $this->vendor_model->get_vendor_list($where,TRUE, TRUE);
		 $this->data["vendors"] = $data->vendors;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Vendors";
         $this->data["view"] = PUBLIC_DIR."vendors/vendors";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_vendor($vendor_id){
        
        $vendor_id = (int) $vendor_id;
        
        $this->data["vendors"] = $this->vendor_model->get_vendor($vendor_id);
        $this->data["title"] = "Vendors Details";
        $this->data["view"] = PUBLIC_DIR."vendors/view_vendor";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        
