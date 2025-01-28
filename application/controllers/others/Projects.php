<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Projects extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/project_model");
		$this->lang->load("projects", 'english');
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
		
        $where = "`projects`.`status` IN (0, 1) ";
		$data = $this->project_model->get_project_list($where);
		 $this->data["projects"] = $data->projects;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Projects');
		$this->data["view"] = ADMIN_DIR."projects/projects";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_project($project_id){
        
        $project_id = (int) $project_id;
        
        $this->data["projects"] = $this->project_model->get_project($project_id);
        $this->data["title"] = $this->lang->line('Project Details');
		$this->data["view"] = ADMIN_DIR."projects/view_project";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`projects`.`status` IN (2) ";
		$data = $this->project_model->get_project_list($where);
		 $this->data["projects"] = $data->projects;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Projects');
		$this->data["view"] = ADMIN_DIR."projects/trashed_projects";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($project_id, $page_id = NULL){
        
        $project_id = (int) $project_id;
        
        
        $this->project_model->changeStatus($project_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."projects/view/".$page_id);
    }
    
    /**
      * function to restor project from trash
      * @param $project_id integer
      */
     public function restore($project_id, $page_id = NULL){
        
        $project_id = (int) $project_id;
        
        
        $this->project_model->changeStatus($project_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."projects/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft project from trash
      * @param $project_id integer
      */
     public function draft($project_id, $page_id = NULL){
        
        $project_id = (int) $project_id;
        
        
        $this->project_model->changeStatus($project_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."projects/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish project from trash
      * @param $project_id integer
      */
     public function publish($project_id, $page_id = NULL){
        
        $project_id = (int) $project_id;
        
        
        $this->project_model->changeStatus($project_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."projects/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Project
      * @param $project_id integer
      */
     public function delete($project_id, $page_id = NULL){
        
        $project_id = (int) $project_id;
        //$this->project_model->changeStatus($project_id, "3");
        
		$this->project_model->delete(array( 'project_id' => $project_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."projects/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Project
      */
     public function add(){
		
        $this->data["title"] = $this->lang->line('Add New Project');$this->data["view"] = ADMIN_DIR."projects/add_project";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->project_model->validate_form_data() === TRUE){
		  
		  $project_id = $this->project_model->save_data();
          if($project_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."projects/edit/$project_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."projects/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Project
      */
     public function edit($project_id){
		 $project_id = (int) $project_id;
        $this->data["project"] = $this->project_model->get($project_id);
		  
        $this->data["title"] = $this->lang->line('Edit Project');$this->data["view"] = ADMIN_DIR."projects/edit_project";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($project_id){
		 
		 $project_id = (int) $project_id;
       
	   if($this->project_model->validate_form_data() === TRUE){
		  
		  $project_id = $this->project_model->update_data($project_id);
          if($project_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."projects/edit/$project_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."projects/edit/$project_id");
            }
        }else{
			$this->edit($project_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["projects"] = $this->project_model->getBy($where, false, "project_id" );
				$j_array[]=array("id" => "", "value" => "project");
				foreach($data["projects"] as $project ){
					$j_array[]=array("id" => $project->project_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
