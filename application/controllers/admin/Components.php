<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Components extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/component_model");
		$this->lang->load("components", 'english');
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
		
        $where = "`components`.`status` IN (0, 1) ";
		$data = $this->component_model->get_component_list($where);
		 $this->data["components"] = $data->components;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Components');
		$this->data["view"] = ADMIN_DIR."components/components";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_component($component_id){
        
        $component_id = (int) $component_id;
        
        $this->data["components"] = $this->component_model->get_component($component_id);
        $this->data["title"] = $this->lang->line('Component Details');
		$this->data["view"] = ADMIN_DIR."components/view_component";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`components`.`status` IN (2) ";
		$data = $this->component_model->get_component_list($where);
		 $this->data["components"] = $data->components;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Components');
		$this->data["view"] = ADMIN_DIR."components/trashed_components";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($component_id, $page_id = NULL){
        
        $component_id = (int) $component_id;
        
        
        $this->component_model->changeStatus($component_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."components/view/".$page_id);
    }
    
    /**
      * function to restor component from trash
      * @param $component_id integer
      */
     public function restore($component_id, $page_id = NULL){
        
        $component_id = (int) $component_id;
        
        
        $this->component_model->changeStatus($component_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."components/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft component from trash
      * @param $component_id integer
      */
     public function draft($component_id, $page_id = NULL){
        
        $component_id = (int) $component_id;
        
        
        $this->component_model->changeStatus($component_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."components/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish component from trash
      * @param $component_id integer
      */
     public function publish($component_id, $page_id = NULL){
        
        $component_id = (int) $component_id;
        
        
        $this->component_model->changeStatus($component_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."components/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Component
      * @param $component_id integer
      */
     public function delete($component_id, $page_id = NULL){
        
        $component_id = (int) $component_id;
        //$this->component_model->changeStatus($component_id, "3");
        
		$this->component_model->delete(array( 'component_id' => $component_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."components/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Component
      */
     public function add(){
		
    $this->data["projects"] = $this->component_model->getList("projects", "project_id", "project_name", $where ="`projects`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Add New Component');$this->data["view"] = ADMIN_DIR."components/add_component";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->component_model->validate_form_data() === TRUE){
		  
		  $component_id = $this->component_model->save_data();
          if($component_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."components/edit/$component_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."components/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Component
      */
     public function edit($component_id){
		 $component_id = (int) $component_id;
        $this->data["component"] = $this->component_model->get($component_id);
		  
    $this->data["projects"] = $this->component_model->getList("projects", "project_id", "project_name", $where ="`projects`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Edit Component');$this->data["view"] = ADMIN_DIR."components/edit_component";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($component_id){
		 
		 $component_id = (int) $component_id;
       
	   if($this->component_model->validate_form_data() === TRUE){
		  
		  $component_id = $this->component_model->update_data($component_id);
          if($component_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."components/edit/$component_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."components/edit/$component_id");
            }
        }else{
			$this->edit($component_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["components"] = $this->component_model->getBy($where, false, "component_id" );
				$j_array[]=array("id" => "", "value" => "component");
				foreach($data["components"] as $component ){
					$j_array[]=array("id" => $component->component_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
