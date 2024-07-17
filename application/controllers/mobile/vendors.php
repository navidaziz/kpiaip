<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Vendors extends Admin_Controller_Mobile{
    
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
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`vendors`.`status` IN (0, 1) ";
		$data = $this->vendor_model->get_vendor_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_vendor($vendor_id){
        
        $vendor_id = (int) $vendor_id;
		$data = $this->vendor_model->get_vendor($vendor_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`vendors`.`status` IN (2) ";
		$data = $this->vendor_model->get_vendor_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($vendor_id){
        
        $vendor_id = (int) $vendor_id;
		$this->vendor_model->changeStatus($vendor_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor vendor from trash
      * @param $vendor_id integer
      */
     public function restore($vendor_id){
        
        $vendor_id = (int) $vendor_id;
		$this->vendor_model->changeStatus($vendor_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft vendor from trash
      * @param $vendor_id integer
      */
     public function draft($vendor_id){
        
        $vendor_id = (int) $vendor_id;
		$this->vendor_model->changeStatus($vendor_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish vendor from trash
      * @param $vendor_id integer
      */
     public function publish($vendor_id){
        
        $vendor_id = (int) $vendor_id;
		$this->vendor_model->changeStatus($vendor_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Vendor
      * @param $vendor_id integer
      */
     public function delete($vendor_id, $page_id = NULL){
        
        $vendor_id = (int) $vendor_id;
        //$this->vendor_model->changeStatus($vendor_id, "3");
        $this->vendor_model->delete(array( 'vendor_id' => $vendor_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$vendor_id = $this->vendor_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($vendor_id){
		$vendor_id = $this->vendor_model->update_data($vendor_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        
