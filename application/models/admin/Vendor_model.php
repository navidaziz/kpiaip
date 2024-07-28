<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Vendor_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "vendors";
        $this->pk = "vendor_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "Vendor_Type",
                            "label"  =>  "Vendor Type",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "TaxPayer_NTN",
                            "label"  =>  "TaxPayer NTN",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "TaxPayer_CNIC",
                            "label"  =>  "TaxPayer CNIC",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "TaxPayer_Name",
                            "label"  =>  "TaxPayer Name",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "TaxPayer_City",
                            "label"  =>  "TaxPayer City",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "TaxPayer_Address",
                            "label"  =>  "TaxPayer Address",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "TaxPayer_Status",
                            "label"  =>  "TaxPayer Status",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "TaxPayer_Business_Name",
                            "label"  =>  "TaxPayer Business Name",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "Focal_Person",
                            "label"  =>  "Focal Person",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "Contact_No",
                            "label"  =>  "Contact No",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "industery",
                            "label"  =>  "Industery",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "business_category",
                            "label"  =>  "Business Category",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "nature_of_business",
                            "label"  =>  "Nature Of Business",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "registration_no",
                            "label"  =>  "Registration No",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "registration_date",
                            "label"  =>  "Registration Date",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "year_of_active",
                            "label"  =>  "Year Of Active",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "fee",
                            "label"  =>  "Fee",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["Vendor_Type"]  =  $this->input->post("Vendor_Type");
                    
                    $inputs["TaxPayer_NTN"]  =  $this->input->post("TaxPayer_NTN");
                    
                    $inputs["TaxPayer_CNIC"]  =  $this->input->post("TaxPayer_CNIC");
                    
                    $inputs["TaxPayer_Name"]  =  $this->input->post("TaxPayer_Name");
                    
                    $inputs["TaxPayer_City"]  =  $this->input->post("TaxPayer_City");
                    
                    $inputs["TaxPayer_Address"]  =  $this->input->post("TaxPayer_Address");
                    
                    $inputs["TaxPayer_Status"]  =  $this->input->post("TaxPayer_Status");
                    
                    $inputs["TaxPayer_Business_Name"]  =  $this->input->post("TaxPayer_Business_Name");
                    
                    $inputs["Focal_Person"]  =  $this->input->post("Focal_Person");
                    
                    $inputs["Contact_No"]  =  $this->input->post("Contact_No");
                    
                    $inputs["industery"]  =  $this->input->post("industery");
                    
                    $inputs["business_category"]  =  $this->input->post("business_category");
                    
                    $inputs["nature_of_business"]  =  $this->input->post("nature_of_business");
                    
                    $inputs["registration_no"]  =  $this->input->post("registration_no");
                    
                    $inputs["registration_date"]  =  $this->input->post("registration_date");
                    
                    $inputs["year_of_active"]  =  $this->input->post("year_of_active");
                    
                    $inputs["fee"]  =  $this->input->post("fee");
                    
	return $this->vendor_model->save($inputs);
	}	 	

public function update_data($vendor_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["Vendor_Type"]  =  $this->input->post("Vendor_Type");
                    
                    $inputs["TaxPayer_NTN"]  =  $this->input->post("TaxPayer_NTN");
                    
                    $inputs["TaxPayer_CNIC"]  =  $this->input->post("TaxPayer_CNIC");
                    
                    $inputs["TaxPayer_Name"]  =  $this->input->post("TaxPayer_Name");
                    
                    $inputs["TaxPayer_City"]  =  $this->input->post("TaxPayer_City");
                    
                    $inputs["TaxPayer_Address"]  =  $this->input->post("TaxPayer_Address");
                    
                    $inputs["TaxPayer_Status"]  =  $this->input->post("TaxPayer_Status");
                    
                    $inputs["TaxPayer_Business_Name"]  =  $this->input->post("TaxPayer_Business_Name");
                    
                    $inputs["Focal_Person"]  =  $this->input->post("Focal_Person");
                    
                    $inputs["Contact_No"]  =  $this->input->post("Contact_No");
                    
                    $inputs["industery"]  =  $this->input->post("industery");
                    
                    $inputs["business_category"]  =  $this->input->post("business_category");
                    
                    $inputs["nature_of_business"]  =  $this->input->post("nature_of_business");
                    
                    $inputs["registration_no"]  =  $this->input->post("registration_no");
                    
                    $inputs["registration_date"]  =  $this->input->post("registration_date");
                    
                    $inputs["year_of_active"]  =  $this->input->post("year_of_active");
                    
                    $inputs["fee"]  =  $this->input->post("fee");
                    
	return $this->vendor_model->save($inputs, $vendor_id);
	}	
	
    //----------------------------------------------------------------
 public function get_vendor_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("vendors.*");
		$join_table = array();
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->vendor_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->vendor_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->vendor_model->joinGet($fields, "vendors", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->vendors = $this->vendor_model->joinGet($fields, "vendors", $join_table, $where);
			return $data;
		}else{
			return $this->vendor_model->joinGet($fields, "vendors", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_vendor($vendor_id){
	
		$fields = array("vendors.*");
		$join_table = array();
		$where = "vendors.vendor_id = $vendor_id";
		
		return $this->vendor_model->joinGet($fields, "vendors", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

