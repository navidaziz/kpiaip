<?php if (!defined('BASEPATH')) exit('Direct access not allowed!');

class Water_user_association_model extends MY_Model
{

    public function __construct()
    {

        parent::__construct();
        $this->table = "water_user_associations";
        $this->pk = "water_user_association_id";
        $this->status = "status";
        $this->order = "order";
    }




    public function validate_form_data()
    {
        // Basic validation rules for the form
        $validation_config = array(

            array(
                "field"  => "project_id",
                "label"  => "Project Id",
                "rules"  => "required"
            ),
            array(
                "field"  => "district_id",
                "label"  => "District Id",
                "rules"  => "required"
            ),
            array(
                "field"  => "tehsil_name",
                "label"  => "Tehsil Name",
                "rules"  => "required"
            ),
            array(
                "field"  => "union_council",
                "label"  => "Union Council",
                "rules"  => "required"
            ),
            array(
                "field"  => "address",
                "label"  => "Address",
                "rules"  => "required"
            ),
            array(
                "field"  => "wua_name",
                "label"  => "Wua Name",
                "rules"  => "required"
            ),
            array(
                "field"  => "bank_account_title",
                "label"  => "Bank Account Title",
                "rules"  => "required"
            ),

            array(
                "field"  => "bank_branch_code",
                "label"  => "Bank Branch Code",
                "rules"  => "required"
            ),
            array(
                "field"  => "bank_name",
                "label"  => "Bank Name",
                "rules"  => "required"
            ),
            array(
                "field"  => "cm_name",
                "label"  => "Chairman Name",
                "rules"  => "required"
            ),
            array(
                "field"  => "cm_father_name",
                "label"  => "Father Name",
                "rules"  => "required"
            ),
            array(
                "field"  => "cm_gender",
                "label"  => "Gender",
                "rules"  => "required"
            ),
            array(
                "field"  => "cm_cnic",
                "label"  => "Chairman CNIC",
                "rules"  => "required|regex_match[/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/]"
            ),
            array(
                "field"  => "cm_contact_no",
                "label"  => "Contact No.",
                "rules"  => "required|regex_match[/^[\+\d\-\(\)\s]*$/]"
            ),
            array(
                "field"  => "wua_registration_date",
                "label"  => "WUA Registration Date",
                "rules"  => "required"
            )
        );

        // // water_user_association_id == 0 means add a new record


        // $wua_registration_no = $this->input->post('wua_registration_no');
        // $district_id = $this->input->post('district_id');
        // $water_user_association_id = (int)$this->input->post('water_user_association_id');
        // // Check if registration number already exists for another record
        // $this->db->where('wua_registration_no', $wua_registration_no);
        // if ($this->input->post('water_user_association_id') > 0) {
        //     $this->db->where('water_user_association_id !=', $water_user_association_id);
        // }
        // $this->db->where('district_id =', $district_id);
        // $query = $this->db->get('water_user_associations');

        // if ($query->num_rows() > 0) {
        //     // Set flashdata for the error message

        //     $this->session->set_flashdata('wua_registration_no', 'The Water User Association Registration No is already registered. Please use a different WUA Registration No.');

        //     // Redirect back to the update form
        //     if ($this->input->post('water_user_association_id') > 0) {
        //         redirect(ADMIN_DIR . 'water_user_associations/edit/' . $water_user_association_id);
        //     } else {
        //         redirect(ADMIN_DIR . 'water_user_associations/add');
        //     }
        //     return; // Return to avoid further processing
        // }

        // $bank_account_number = $this->input->post('bank_account_number');

        // // Check if registration number already exists for another record
        // $this->db->where('bank_account_number', $bank_account_number);
        // $this->db->where('water_user_association_id !=', $water_user_association_id);
        // $query = $this->db->get('water_user_associations');

        // if ($query->num_rows() > 0) {
        //     // Set flashdata for the error message
        //     $this->session->set_flashdata('bank_account_number', 'The Water User Association Account No is already registered. Please use a different WUA Account No.');

        //     if ($this->input->post('water_user_association_id') > 0) {
        //         redirect(ADMIN_DIR . 'water_user_associations/edit/' . $water_user_association_id);
        //     } else {
        //         redirect(ADMIN_DIR . 'water_user_associations/add');
        //     }
        //     return; // Return to avoid further processing
        // }





        // Set validation rules
        $this->form_validation->set_rules($validation_config);

        // Run validation
        return $this->form_validation->run();
    }








    public function save_data($image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");
        $inputs["file_number"]  =  $this->input->post("file_number");
        $inputs["district_id"]  =  $this->input->post("district_id");

        $inputs["tehsil_name"]  =  $this->input->post("tehsil_name");

        $inputs["union_council"]  =  $this->input->post("union_council");

        $inputs["address"]  =  $this->input->post("address");

        $inputs["wua_registration_no"]  =  $this->input->post("wua_registration_no");

        $inputs["wua_name"]  =  $this->input->post("wua_name");

        $inputs["bank_account_title"]  =  $this->input->post("bank_account_title");

        $inputs["bank_account_number"]  =  $this->input->post("bank_account_number");

        $inputs["bank_branch_code"]  =  $this->input->post("bank_branch_code");
        $inputs["bank_name"]  =  $this->input->post("bank_name");


        $inputs["cm_name"]  =  $this->input->post("cm_name");
        $inputs["cm_father_name"]  =  $this->input->post("cm_father_name");
        $inputs["cm_gender"]  =  $this->input->post("cm_gender");
        $inputs["cm_cnic"]  =  $this->input->post("cm_cnic");
        $inputs["cm_contact_no"]  =  $this->input->post("cm_contact_no");
        $inputs["wua_registration_date"]  =  $this->input->post("wua_registration_date");

        $inputs["created_by"] = $this->session->userdata("userId");

        if ($_FILES["attachement"]["size"] > 0) {
            $inputs["attachement"]  =  $this->router->fetch_class() . "/" . $this->input->post("attachement");
        }

        return $this->water_user_association_model->save($inputs);
    }

    public function update_data($water_user_association_id, $image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");
        $inputs["file_number"]  =  $this->input->post("file_number");
        $inputs["district_id"]  =  $this->input->post("district_id");

        $inputs["tehsil_name"]  =  $this->input->post("tehsil_name");

        $inputs["union_council"]  =  $this->input->post("union_council");

        $inputs["address"]  =  $this->input->post("address");

        $inputs["wua_registration_no"]  =  $this->input->post("wua_registration_no");

        $inputs["wua_name"]  =  $this->input->post("wua_name");

        $inputs["bank_account_title"]  =  $this->input->post("bank_account_title");

        $inputs["bank_account_number"]  =  $this->input->post("bank_account_number");

        $inputs["bank_branch_code"]  =  $this->input->post("bank_branch_code");
        $inputs["bank_name"]  =  $this->input->post("bank_name");

        $inputs["cm_name"]  =  $this->input->post("cm_name");
        $inputs["cm_father_name"]  =  $this->input->post("cm_father_name");
        $inputs["cm_gender"]  =  $this->input->post("cm_gender");
        $inputs["cm_cnic"]  =  $this->input->post("cm_cnic");
        $inputs["cm_contact_no"]  =  $this->input->post("cm_contact_no");
        $inputs["wua_registration_date"]  =  $this->input->post("wua_registration_date");

        $inputs["created_by"] = $this->session->userdata("userId");
        $inputs["last_updated"] = date('Y-m-d H:i:s');

        if ($_FILES["attachement"]["size"] > 0) {
            //remove previous file....
            $water_user_associations = $this->get_water_user_association($water_user_association_id);
            $file_path = $water_user_associations[0]->attachement;
            $this->delete_file($file_path);
            $inputs["attachement"]  =  $this->router->fetch_class() . "/" . $this->input->post("attachement");
        }

        return $this->water_user_association_model->save($inputs, $water_user_association_id);
    }

    //----------------------------------------------------------------
    public function get_water_user_association_list($where_condition = NULL, $pagination = TRUE, $public = FALSE)
    {
        $data = (object) array();
        $fields = array(
            "water_user_associations.*",
            "projects.project_name",
            "districts.district_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = water_user_associations.project_id",

            "districts" => "districts.district_id = water_user_associations.district_id"
        );
        if (!is_null($where_condition)) {
            $where = $where_condition;
        } else {
            $where = "";
        }

        if ($pagination) {
            //configure the pagination
            $this->load->library("pagination");

            if ($public) {
                $config['per_page'] = 10;
                $config['uri_segment'] = 3;
                $this->water_user_association_model->uri_segment = $this->uri->segment(3);
                $config["base_url"]  = base_url($this->uri->segment(1) . "/" . $this->uri->segment(2));
            } else {
                $this->water_user_association_model->uri_segment = $this->uri->segment(4);
                $config["base_url"]  = base_url(ADMIN_DIR . $this->uri->segment(2) . "/" . $this->uri->segment(3));
            }
            $config["total_rows"] = $this->water_user_association_model->joinGet($fields, "water_user_associations", $join_table, $where, true);
            $this->pagination->initialize($config);
            $data->pagination = $this->pagination->create_links();
            $data->water_user_associations = $this->water_user_association_model->joinGet($fields, "water_user_associations", $join_table, $where);
            return $data;
        } else {
            return $this->water_user_association_model->joinGet($fields, "water_user_associations", $join_table, $where, FALSE, TRUE);
        }
    }

    public function get_water_user_association($water_user_association_id)
    {

        $fields = array(
            "water_user_associations.*",
            "projects.project_name",
            "districts.district_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = water_user_associations.project_id",

            "districts" => "districts.district_id = water_user_associations.district_id",
        );
        $where = "water_user_associations.water_user_association_id = $water_user_association_id";

        return $this->water_user_association_model->joinGet($fields, "water_user_associations", $join_table, $where, FALSE, TRUE);
    }
}
