<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Departments extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/department_model");
		$this->lang->load("departments", 'english');
		$this->lang->load("system", 'english');
        $this->lang->load("users", 'english');
        $this->load->model("admin/user_model");
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
		
        $where = "`departments`.`status` IN (0, 1) ";
		$data = $this->department_model->get_department_list($where);
		 $this->data["departments"] = $data->departments;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Departments');
		$this->data["view"] = ADMIN_DIR."departments/departments";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_department($department_id){
        
        $department_id = (int) $department_id;

        $query="SELECT user_id FROM users WHERE department_id = $department_id";
        $user_id = $this->db->query($query)->row()->user_id;
        $this->data["user"] = $this->user_model->get($user_id);
        
        $this->data["departments"] = $this->department_model->get_department($department_id);
        $this->data["title"] = $this->lang->line('Department Details');
		$this->data["view"] = ADMIN_DIR."departments/view_department";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`departments`.`status` IN (2) ";
		$data = $this->department_model->get_department_list($where);
		 $this->data["departments"] = $data->departments;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Departments');
		$this->data["view"] = ADMIN_DIR."departments/trashed_departments";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($department_id, $page_id = NULL){
        
        $department_id = (int) $department_id;
        
        
        $this->department_model->changeStatus($department_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."departments/view/".$page_id);
    }
    
    /**
      * function to restor department from trash
      * @param $department_id integer
      */
     public function restore($department_id, $page_id = NULL){
        
        $department_id = (int) $department_id;
        
        
        $this->department_model->changeStatus($department_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."departments/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft department from trash
      * @param $department_id integer
      */
     public function draft($department_id, $page_id = NULL){
        
        $department_id = (int) $department_id;
        
        
        $this->department_model->changeStatus($department_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."departments/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish department from trash
      * @param $department_id integer
      */
     public function publish($department_id, $page_id = NULL){
        
        $department_id = (int) $department_id;
        
        
        $this->department_model->changeStatus($department_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."departments/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Department
      * @param $department_id integer
      */
     public function delete($department_id, $page_id = NULL){
        
        $department_id = (int) $department_id;
        //$this->department_model->changeStatus($department_id, "3");
        
		$this->department_model->delete(array( 'department_id' => $department_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."departments/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Department
      */
     public function add(){
		
        $this->data["title"] = $this->lang->line('Add New Department');$this->data["view"] = ADMIN_DIR."departments/add_department";
        $this->data["roles"] = $this->user_model->getList("roles", "role_id", "role_title", $where = "`role_id` = 5");

        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->department_model->validate_form_data() === TRUE and $this->user_model->validate_form_data() === TRUE){
		  
		  $department_id = $this->department_model->save_data();
          $_POST['department_id'] = $department_id;
          if($department_id){
            $user_id = $this->user_model->save_data();
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."departments/edit/$department_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."departments/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Department
      */
     public function edit($department_id){
		 $department_id = (int) $department_id;
        $this->data["department"] = $this->department_model->get($department_id);
        $query="SELECT user_id FROM users WHERE department_id = $department_id";
        $user_id = $this->db->query($query)->row()->user_id;
        $this->data["user"] = $this->user_model->get($user_id);
        $this->data["roles"] = $this->user_model->getList("roles", "role_id", "role_title", $where = "`role_id` = 5");

		  
        $this->data["title"] = $this->lang->line('Edit Department');$this->data["view"] = ADMIN_DIR."departments/edit_department";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($department_id){
		 
		 $department_id = (int) $department_id;
       
	   if($this->department_model->validate_form_data() === TRUE and $this->user_model->validate_form_data() === TRUE){
		  
		  $department_id = $this->department_model->update_data($department_id);
          if($department_id){
            $_POST['department_id'] = $department_id;
            $user_id = $this->user_model->update_data();
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."departments/edit/$department_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."departments/edit/$department_id");
            }
        }else{
			$this->edit($department_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["departments"] = $this->department_model->getBy($where, false, "department_id" );
				$j_array[]=array("id" => "", "value" => "department");
				foreach($data["departments"] as $department ){
					$j_array[]=array("id" => $department->department_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
