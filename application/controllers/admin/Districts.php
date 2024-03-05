<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Districts extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/district_model");
		$this->lang->load("districts", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
        $main_page=base_url().ADMIN_DIR.$this->router->fetch_class()."/view";
  		redirect($main_page); 
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`districts`.`status` IN (0, 1) ";
		$data = $this->district_model->get_district_list($where);
		 $this->data["districts"] = $data->districts;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Districts');
		$this->data["view"] = ADMIN_DIR."districts/districts";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_district($district_id){
        
        $district_id = (int) $district_id;
        
        $this->data["districts"] = $this->district_model->get_district($district_id);
        $this->data["title"] = $this->lang->line('District Details');
		$this->data["view"] = ADMIN_DIR."districts/view_district";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`districts`.`status` IN (2) ";
		$data = $this->district_model->get_district_list($where);
		 $this->data["districts"] = $data->districts;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Districts');
		$this->data["view"] = ADMIN_DIR."districts/trashed_districts";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($district_id, $page_id = NULL){
        
        $district_id = (int) $district_id;
        
        
        $this->district_model->changeStatus($district_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."districts/view/".$page_id);
    }
    
    /**
      * function to restor district from trash
      * @param $district_id integer
      */
     public function restore($district_id, $page_id = NULL){
        
        $district_id = (int) $district_id;
        
        
        $this->district_model->changeStatus($district_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."districts/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft district from trash
      * @param $district_id integer
      */
     public function draft($district_id, $page_id = NULL){
        
        $district_id = (int) $district_id;
        
        
        $this->district_model->changeStatus($district_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."districts/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish district from trash
      * @param $district_id integer
      */
     public function publish($district_id, $page_id = NULL){
        
        $district_id = (int) $district_id;
        
        
        $this->district_model->changeStatus($district_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."districts/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a District
      * @param $district_id integer
      */
     public function delete($district_id, $page_id = NULL){
        
        $district_id = (int) $district_id;
        //$this->district_model->changeStatus($district_id, "3");
        
		$this->district_model->delete(array( 'district_id' => $district_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."districts/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new District
      */
     public function add(){
		
        $this->data["title"] = $this->lang->line('Add New District');$this->data["view"] = ADMIN_DIR."districts/add_district";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->district_model->validate_form_data() === TRUE){
		  
		  $district_id = $this->district_model->save_data();
          if($district_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."districts/edit/$district_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."districts/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a District
      */
     public function edit($district_id){
		 $district_id = (int) $district_id;
        $this->data["district"] = $this->district_model->get($district_id);
		  
        $this->data["title"] = $this->lang->line('Edit District');$this->data["view"] = ADMIN_DIR."districts/edit_district";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($district_id){
		 
		 $district_id = (int) $district_id;
       
	   if($this->district_model->validate_form_data() === TRUE){
		  
		  $district_id = $this->district_model->update_data($district_id);
          if($district_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."districts/edit/$district_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."districts/edit/$district_id");
            }
        }else{
			$this->edit($district_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["districts"] = $this->district_model->getBy($where, false, "district_id" );
				$j_array[]=array("id" => "", "value" => "district");
				foreach($data["districts"] as $district ){
					$j_array[]=array("id" => $district->district_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
