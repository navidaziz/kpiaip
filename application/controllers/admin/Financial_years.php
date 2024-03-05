<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Financial_years extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/financial_year_model");
		$this->lang->load("financial_years", 'english');
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
		
        $where = "`financial_years`.`status` IN (0, 1) ";
		$data = $this->financial_year_model->get_financial_year_list($where);
		 $this->data["financial_years"] = $data->financial_years;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Financial Years');
		$this->data["view"] = ADMIN_DIR."financial_years/financial_years";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_financial_year($financial_year_id){
        
        $financial_year_id = (int) $financial_year_id;
        
        $this->data["financial_years"] = $this->financial_year_model->get_financial_year($financial_year_id);
        $this->data["title"] = $this->lang->line('Financial Year Details');
		$this->data["view"] = ADMIN_DIR."financial_years/view_financial_year";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`financial_years`.`status` IN (2) ";
		$data = $this->financial_year_model->get_financial_year_list($where);
		 $this->data["financial_years"] = $data->financial_years;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Financial Years');
		$this->data["view"] = ADMIN_DIR."financial_years/trashed_financial_years";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($financial_year_id, $page_id = NULL){
        
        $financial_year_id = (int) $financial_year_id;
        
        
        $this->financial_year_model->changeStatus($financial_year_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."financial_years/view/".$page_id);
    }
    
    /**
      * function to restor financial_year from trash
      * @param $financial_year_id integer
      */
     public function restore($financial_year_id, $page_id = NULL){
        
        $financial_year_id = (int) $financial_year_id;
        
        
        $this->financial_year_model->changeStatus($financial_year_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."financial_years/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft financial_year from trash
      * @param $financial_year_id integer
      */
     public function draft($financial_year_id, $page_id = NULL){
        
        $financial_year_id = (int) $financial_year_id;
        
        
        $this->financial_year_model->changeStatus($financial_year_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."financial_years/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish financial_year from trash
      * @param $financial_year_id integer
      */
     public function publish($financial_year_id, $page_id = NULL){
        
        $financial_year_id = (int) $financial_year_id;
        
        
        $this->financial_year_model->changeStatus($financial_year_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."financial_years/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Financial_year
      * @param $financial_year_id integer
      */
     public function delete($financial_year_id, $page_id = NULL){
        
        $financial_year_id = (int) $financial_year_id;
        //$this->financial_year_model->changeStatus($financial_year_id, "3");
        
		$this->financial_year_model->delete(array( 'financial_year_id' => $financial_year_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."financial_years/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Financial_year
      */
     public function add(){
		
    $this->data["projects"] = $this->financial_year_model->getList("projects", "project_id", "project_name", $where ="`projects`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Add New Financial Year');$this->data["view"] = ADMIN_DIR."financial_years/add_financial_year";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->financial_year_model->validate_form_data() === TRUE){
		  
		  $financial_year_id = $this->financial_year_model->save_data();
          if($financial_year_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."financial_years/edit/$financial_year_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."financial_years/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Financial_year
      */
     public function edit($financial_year_id){
		 $financial_year_id = (int) $financial_year_id;
        $this->data["financial_year"] = $this->financial_year_model->get($financial_year_id);
		  
    $this->data["projects"] = $this->financial_year_model->getList("projects", "project_id", "project_name", $where ="`projects`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Edit Financial Year');$this->data["view"] = ADMIN_DIR."financial_years/edit_financial_year";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($financial_year_id){
		 
		 $financial_year_id = (int) $financial_year_id;
       
	   if($this->financial_year_model->validate_form_data() === TRUE){
		  
		  $financial_year_id = $this->financial_year_model->update_data($financial_year_id);
          if($financial_year_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."financial_years/edit/$financial_year_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."financial_years/edit/$financial_year_id");
            }
        }else{
			$this->edit($financial_year_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["financial_years"] = $this->financial_year_model->getBy($where, false, "financial_year_id" );
				$j_array[]=array("id" => "", "value" => "financial_year");
				foreach($data["financial_years"] as $financial_year ){
					$j_array[]=array("id" => $financial_year->financial_year_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
