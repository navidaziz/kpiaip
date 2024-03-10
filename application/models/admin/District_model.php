<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class District_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "districts";
        $this->pk = "district_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "district_name",
                            "label"  =>  "District Name",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "division",
                            "label"  =>  "Division",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "region",
                            "label"  =>  "Region",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "district_latitude",
                            "label"  =>  "District Latitude",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "district_logitude",
                            "label"  =>  "District Logitude",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["district_name"]  =  $this->input->post("district_name");
                    
                    $inputs["division"]  =  $this->input->post("division");
                    
                    $inputs["region"]  =  $this->input->post("region");
                    
                    $inputs["district_latitude"]  =  $this->input->post("district_latitude");
                    
                    $inputs["district_logitude"]  =  $this->input->post("district_logitude");
                    
	return $this->district_model->save($inputs);
	}	 	

public function update_data($district_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["district_name"]  =  $this->input->post("district_name");
                    
                    $inputs["division"]  =  $this->input->post("division");
                    
                    $inputs["region"]  =  $this->input->post("region");
                    
                    $inputs["district_latitude"]  =  $this->input->post("district_latitude");
                    
                    $inputs["district_logitude"]  =  $this->input->post("district_logitude");
                    
	return $this->district_model->save($inputs, $district_id);
	}	
	
    //----------------------------------------------------------------
 public function get_district_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("districts.*");
		$join_table = array();
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->district_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->district_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->district_model->joinGet($fields, "districts", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->districts = $this->district_model->joinGet($fields, "districts", $join_table, $where);
			return $data;
		}else{
			return $this->district_model->joinGet($fields, "districts", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_district($district_id){
	
		$fields = array("districts.*");
		$join_table = array();
		$where = "districts.district_id = $district_id";
		
		return $this->district_model->joinGet($fields, "districts", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

