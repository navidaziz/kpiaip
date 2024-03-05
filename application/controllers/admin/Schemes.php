<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Schemes extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/scheme_model");
		$this->lang->load("schemes", 'english');
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
		
        $where = "`schemes`.`status` IN (0, 1) ";
		$data = $this->scheme_model->get_scheme_list($where);
		 $this->data["schemes"] = $data->schemes;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Schemes');
		$this->data["view"] = ADMIN_DIR."schemes/schemes";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_scheme($scheme_id){
        
        $scheme_id = (int) $scheme_id;
        
        $this->data["schemes"] = $this->scheme_model->get_scheme($scheme_id);
        $this->data["title"] = $this->lang->line('Scheme Details');
		$this->data["view"] = ADMIN_DIR."schemes/view_scheme";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`schemes`.`status` IN (2) ";
		$data = $this->scheme_model->get_scheme_list($where);
		 $this->data["schemes"] = $data->schemes;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Schemes');
		$this->data["view"] = ADMIN_DIR."schemes/trashed_schemes";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($scheme_id, $page_id = NULL){
        
        $scheme_id = (int) $scheme_id;
        
        
        $this->scheme_model->changeStatus($scheme_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."schemes/view/".$page_id);
    }
    
    /**
      * function to restor scheme from trash
      * @param $scheme_id integer
      */
     public function restore($scheme_id, $page_id = NULL){
        
        $scheme_id = (int) $scheme_id;
        
        
        $this->scheme_model->changeStatus($scheme_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."schemes/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft scheme from trash
      * @param $scheme_id integer
      */
     public function draft($scheme_id, $page_id = NULL){
        
        $scheme_id = (int) $scheme_id;
        
        
        $this->scheme_model->changeStatus($scheme_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."schemes/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish scheme from trash
      * @param $scheme_id integer
      */
     public function publish($scheme_id, $page_id = NULL){
        
        $scheme_id = (int) $scheme_id;
        
        
        $this->scheme_model->changeStatus($scheme_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."schemes/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Scheme
      * @param $scheme_id integer
      */
     public function delete($scheme_id, $page_id = NULL){
        
        $scheme_id = (int) $scheme_id;
        //$this->scheme_model->changeStatus($scheme_id, "3");
        
		$this->scheme_model->delete(array( 'scheme_id' => $scheme_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."schemes/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Scheme
      */
     public function add(){
		
    $this->data["projects"] = $this->scheme_model->getList("projects", "project_id", "project_name", $where ="`projects`.`status` IN (1) ");
    
    $this->data["districts"] = $this->scheme_model->getList("districts", "district_id", "district_name", $where ="`districts`.`status` IN (1) ");
    
    $this->data["component_categories"] = $this->scheme_model->getList("component_categories", "component_category_id", "category", $where ="`component_categories`.`status` IN (1) ");
    
    $this->data["water_user_associations"] = $this->scheme_model->getList("water_user_associations", "water_user_association_id", "wua_name", $where ="`water_user_associations`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Add New Scheme');$this->data["view"] = ADMIN_DIR."schemes/add_scheme";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->scheme_model->validate_form_data() === TRUE){
		  
		  $scheme_id = $this->scheme_model->save_data();
          if($scheme_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."schemes/edit/$scheme_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."schemes/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Scheme
      */
     public function edit($scheme_id){
		 $scheme_id = (int) $scheme_id;
        $this->data["scheme"] = $this->scheme_model->get($scheme_id);
		  
    $this->data["projects"] = $this->scheme_model->getList("projects", "project_id", "project_name", $where ="`projects`.`status` IN (1) ");
    
    $this->data["districts"] = $this->scheme_model->getList("districts", "district_id", "district_name", $where ="`districts`.`status` IN (1) ");
    
    $this->data["component_categories"] = $this->scheme_model->getList("component_categories", "component_category_id", "category", $where ="`component_categories`.`status` IN (1) ");
    
    $this->data["water_user_associations"] = $this->scheme_model->getList("water_user_associations", "water_user_association_id", "wua_name", $where ="`water_user_associations`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Edit Scheme');$this->data["view"] = ADMIN_DIR."schemes/edit_scheme";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($scheme_id){
		 
		 $scheme_id = (int) $scheme_id;
       
	   if($this->scheme_model->validate_form_data() === TRUE){
		  
		  $scheme_id = $this->scheme_model->update_data($scheme_id);
          if($scheme_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."schemes/edit/$scheme_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."schemes/edit/$scheme_id");
            }
        }else{
			$this->edit($scheme_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["schemes"] = $this->scheme_model->getBy($where, false, "scheme_id" );
				$j_array[]=array("id" => "", "value" => "scheme");
				foreach($data["schemes"] as $scheme ){
					$j_array[]=array("id" => $scheme->scheme_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
