<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Project_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "projects";
        $this->pk = "project_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "project_name",
                            "label"  =>  "Project Name",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "cost",
                            "label"  =>  "Cost",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "project_detail",
                            "label"  =>  "Project Detail",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["project_name"]  =  $this->input->post("project_name");
                    
                    $inputs["cost"]  =  $this->input->post("cost");
                    
                    $inputs["project_detail"]  =  $this->input->post("project_detail");
                    
	return $this->project_model->save($inputs);
	}	 	

public function update_data($project_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["project_name"]  =  $this->input->post("project_name");
                    
                    $inputs["cost"]  =  $this->input->post("cost");
                    
                    $inputs["project_detail"]  =  $this->input->post("project_detail");
                    
	return $this->project_model->save($inputs, $project_id);
	}	
	
    //----------------------------------------------------------------
 public function get_project_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("projects.*");
		$join_table = array();
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->project_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->project_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->project_model->joinGet($fields, "projects", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->projects = $this->project_model->joinGet($fields, "projects", $join_table, $where);
			return $data;
		}else{
			return $this->project_model->joinGet($fields, "projects", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_project($project_id){
	
		$fields = array("projects.*");
		$join_table = array();
		$where = "projects.project_id = $project_id";
		
		return $this->project_model->joinGet($fields, "projects", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

