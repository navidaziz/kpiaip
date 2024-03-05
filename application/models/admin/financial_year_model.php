<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Financial_year_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "financial_years";
        $this->pk = "financial_year_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "project_id",
                            "label"  =>  "Project Id",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "start_date",
                            "label"  =>  "Start Date",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "end_date",
                            "label"  =>  "End Date",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "financial_year",
                            "label"  =>  "Financial Year",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["project_id"]  =  $this->input->post("project_id");
                    
                    $inputs["start_date"]  =  $this->input->post("start_date");
                    
                    $inputs["end_date"]  =  $this->input->post("end_date");
                    
                    $inputs["financial_year"]  =  $this->input->post("financial_year");
                    
	return $this->financial_year_model->save($inputs);
	}	 	

public function update_data($financial_year_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["project_id"]  =  $this->input->post("project_id");
                    
                    $inputs["start_date"]  =  $this->input->post("start_date");
                    
                    $inputs["end_date"]  =  $this->input->post("end_date");
                    
                    $inputs["financial_year"]  =  $this->input->post("financial_year");
                    
	return $this->financial_year_model->save($inputs, $financial_year_id);
	}	
	
    //----------------------------------------------------------------
 public function get_financial_year_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("financial_years.*"
                , "projects.project_name"
            );
		$join_table = array(
            "projects" => "projects.project_id = financial_years.project_id",
        );
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->financial_year_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->financial_year_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->financial_year_model->joinGet($fields, "financial_years", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->financial_years = $this->financial_year_model->joinGet($fields, "financial_years", $join_table, $where);
			return $data;
		}else{
			return $this->financial_year_model->joinGet($fields, "financial_years", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_financial_year($financial_year_id){
	
		$fields = array("financial_years.*"
                , "projects.project_name"
            );
		$join_table = array(
            "projects" => "projects.project_id = financial_years.project_id",
        );
		$where = "financial_years.financial_year_id = $financial_year_id";
		
		return $this->financial_year_model->joinGet($fields, "financial_years", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

