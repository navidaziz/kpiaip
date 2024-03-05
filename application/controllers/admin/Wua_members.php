<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Wua_members extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/wua_member_model");
		$this->lang->load("wua_members", 'english');
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
		
        $where = "`wua_members`.`status` IN (0, 1) ";
		$data = $this->wua_member_model->get_wua_member_list($where);
		 $this->data["wua_members"] = $data->wua_members;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Wua Members');
		$this->data["view"] = ADMIN_DIR."wua_members/wua_members";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_wua_member($wua_member_id){
        
        $wua_member_id = (int) $wua_member_id;
        
        $this->data["wua_members"] = $this->wua_member_model->get_wua_member($wua_member_id);
        $this->data["title"] = $this->lang->line('Wua Member Details');
		$this->data["view"] = ADMIN_DIR."wua_members/view_wua_member";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`wua_members`.`status` IN (2) ";
		$data = $this->wua_member_model->get_wua_member_list($where);
		 $this->data["wua_members"] = $data->wua_members;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Wua Members');
		$this->data["view"] = ADMIN_DIR."wua_members/trashed_wua_members";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($wua_member_id, $page_id = NULL){
        
        $wua_member_id = (int) $wua_member_id;
        
        
        $this->wua_member_model->changeStatus($wua_member_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."wua_members/view/".$page_id);
    }
    
    /**
      * function to restor wua_member from trash
      * @param $wua_member_id integer
      */
     public function restore($wua_member_id, $page_id = NULL){
        
        $wua_member_id = (int) $wua_member_id;
        
        
        $this->wua_member_model->changeStatus($wua_member_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."wua_members/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft wua_member from trash
      * @param $wua_member_id integer
      */
     public function draft($wua_member_id, $page_id = NULL){
        
        $wua_member_id = (int) $wua_member_id;
        
        
        $this->wua_member_model->changeStatus($wua_member_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."wua_members/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish wua_member from trash
      * @param $wua_member_id integer
      */
     public function publish($wua_member_id, $page_id = NULL){
        
        $wua_member_id = (int) $wua_member_id;
        
        
        $this->wua_member_model->changeStatus($wua_member_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."wua_members/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Wua_member
      * @param $wua_member_id integer
      */
     public function delete($wua_member_id, $page_id = NULL){
        
        $wua_member_id = (int) $wua_member_id;
        //$this->wua_member_model->changeStatus($wua_member_id, "3");
        //Remove file....
						$wua_members = $this->wua_member_model->get_wua_member($wua_member_id);
						$file_path = $wua_members[0]->attachment;
						$this->wua_member_model->delete_file($file_path);
		$this->wua_member_model->delete(array( 'wua_member_id' => $wua_member_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."wua_members/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Wua_member
      */
     public function add(){
		
    $this->data["projects"] = $this->wua_member_model->getList("projects", "project_id", "project_name", $where ="`projects`.`status` IN (1) ");
    
    $this->data["districts"] = $this->wua_member_model->getList("districts", "district_id", "district_name", $where ="`districts`.`status` IN (1) ");
    
    $this->data["tehsils"] = $this->wua_member_model->getList("tehsils", "tehsil_id", "tehsil_name", $where ="`tehsils`.`status` IN (1) ");
    
    $this->data["water_user_associations"] = $this->wua_member_model->getList("water_user_associations", "water_user_association_id", "wua_name", $where ="`water_user_associations`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Add New Wua Member');$this->data["view"] = ADMIN_DIR."wua_members/add_wua_member";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->wua_member_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("attachment")){
                       $_POST['attachment'] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $wua_member_id = $this->wua_member_model->save_data();
          if($wua_member_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."wua_members/edit/$wua_member_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."wua_members/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Wua_member
      */
     public function edit($wua_member_id){
		 $wua_member_id = (int) $wua_member_id;
        $this->data["wua_member"] = $this->wua_member_model->get($wua_member_id);
		  
    $this->data["projects"] = $this->wua_member_model->getList("projects", "project_id", "project_name", $where ="`projects`.`status` IN (1) ");
    
    $this->data["districts"] = $this->wua_member_model->getList("districts", "district_id", "district_name", $where ="`districts`.`status` IN (1) ");
    
    $this->data["tehsils"] = $this->wua_member_model->getList("tehsils", "tehsil_id", "tehsil_name", $where ="`tehsils`.`status` IN (1) ");
    
    $this->data["water_user_associations"] = $this->wua_member_model->getList("water_user_associations", "water_user_association_id", "wua_name", $where ="`water_user_associations`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Edit Wua Member');$this->data["view"] = ADMIN_DIR."wua_members/edit_wua_member";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($wua_member_id){
		 
		 $wua_member_id = (int) $wua_member_id;
       
	   if($this->wua_member_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("attachment")){
                         $_POST["attachment"] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $wua_member_id = $this->wua_member_model->update_data($wua_member_id);
          if($wua_member_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."wua_members/edit/$wua_member_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."wua_members/edit/$wua_member_id");
            }
        }else{
			$this->edit($wua_member_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["wua_members"] = $this->wua_member_model->getBy($where, false, "wua_member_id" );
				$j_array[]=array("id" => "", "value" => "wua_member");
				foreach($data["wua_members"] as $wua_member ){
					$j_array[]=array("id" => $wua_member->wua_member_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
