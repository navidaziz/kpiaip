<?php if (!defined('BASEPATH')) exit('Direct access not allowed!');

class Scheme_model extends MY_Model
{

    public function __construct()
    {

        parent::__construct();
        $this->table = "schemes";
        $this->pk = "scheme_id";
        $this->status = "status";
        $this->order = "order";
    }

    public function validate_form_data()
    {
        $validation_config = array(

            array(
                "field"  =>  "project_id",
                "label"  =>  "Project Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "district_id",
                "label"  =>  "District Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "component_category_id",
                "label"  =>  "Component Category Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "scheme_code",
                "label"  =>  "Scheme Code",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "scheme_name",
                "label"  =>  "Scheme Name",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "water_source",
                "label"  =>  "Water Source",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "latitude",
                "label"  =>  "Latitude",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "longitude",
                "label"  =>  "Longitude",
                "rules"  =>  "required"
            ),


            array(
                "field"  =>  "male_beneficiaries",
                "label"  =>  "Male Beneficiaries",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "female_beneficiaries",
                "label"  =>  "Female Beneficiaries",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "estimated_cost",
                "label"  =>  "Estimated Cost",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "approved_cost",
                "label"  =>  "Approved Cost",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "revised_cost",
                "label"  =>  "Revised Cost",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "sanctioned_cost",
                "label"  =>  "Sanctioned Cost",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "water_user_association_id",
                "label"  =>  "Water User Association Id",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "financial_year_id",
                "label"  =>  "Financial Year",
                "rules"  =>  "required"
            ),


        );
        //set and run the validation
        $this->form_validation->set_rules($validation_config);
        return $this->form_validation->run();
    }

    public function save_data($image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");

        $inputs["district_id"]  =  $this->input->post("district_id");

        $inputs["component_category_id"]  = $component_category_id =   (int) $this->input->post("component_category_id");

        $query = "SELECT category FROM component_categories WHERE component_category_id = $component_category_id";
        $component_category = $this->db->query($query)->row()->category;
        $input['category'] = $component_category;

        $inputs["scheme_code"]  =  $this->input->post("scheme_code");

        $inputs["scheme_name"]  =  $this->input->post("scheme_name");

        $inputs["water_source"]  =  $this->input->post("water_source");

        $inputs["latitude"]  =  $this->input->post("latitude");

        $inputs["longitude"]  =  $this->input->post("longitude");

        $inputs["male_beneficiaries"]  =  $this->input->post("male_beneficiaries");

        $inputs["female_beneficiaries"]  =  $this->input->post("female_beneficiaries");

        $inputs["beneficiaries"] = $inputs["male_beneficiaries"] + $inputs["female_beneficiaries"];


        $inputs["estimated_cost"]  =  $this->input->post("estimated_cost");

        $inputs["approved_cost"]  =  $this->input->post("approved_cost");

        $inputs["revised_cost"]  =  $this->input->post("revised_cost");

        $inputs["sanctioned_cost"]  =  $this->input->post("sanctioned_cost");
        $inputs["registration_date"]  =  $this->input->post("registration_date");
        $inputs["financial_year_id"]  =  $this->input->post("financial_year_id");

        $inputs["water_user_association_id"]  =  $this->input->post("water_user_association_id");
        $inputs["scheme_status"]  =  $this->input->post("scheme_status");
        $inputs["created_by"] = $this->session->userdata("userId");
        $inputs["last_updated"] = date('Y-m-d H:i:s');


        return $this->scheme_model->save($inputs);
    }

    public function update_data($scheme_id, $image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");

        $inputs["district_id"]  =  $this->input->post("district_id");

        $inputs["component_category_id"]  = $component_category_id =   (int) $this->input->post("component_category_id");

        $query = "SELECT category FROM component_categories WHERE component_category_id = $component_category_id";
        $component_category = $this->db->query($query)->row()->category;
        $input['category'] = $component_category;

        $inputs["scheme_code"]  =  $this->input->post("scheme_code");

        $inputs["scheme_name"]  =  $this->input->post("scheme_name");

        $inputs["water_source"]  =  $this->input->post("water_source");

        $inputs["latitude"]  =  $this->input->post("latitude");

        $inputs["longitude"]  =  $this->input->post("longitude");

        $inputs["male_beneficiaries"]  =  $this->input->post("male_beneficiaries");

        $inputs["female_beneficiaries"]  =  $this->input->post("female_beneficiaries");

        $inputs["beneficiaries"] = $inputs["male_beneficiaries"] + $inputs["female_beneficiaries"];

        $inputs["estimated_cost"]  =  $this->input->post("estimated_cost");

        $inputs["approved_cost"]  =  $this->input->post("approved_cost");

        $inputs["revised_cost"]  =  $this->input->post("revised_cost");

        $inputs["sanctioned_cost"]  =  $this->input->post("sanctioned_cost");
        $inputs["registration_date"]  =  $this->input->post("registration_date");
        $inputs["financial_year_id"]  =  $this->input->post("financial_year_id");

        $inputs["water_user_association_id"]  =  $this->input->post("water_user_association_id");
        //$inputs["scheme_status"]  =  $this->input->post("scheme_status");
        $inputs["created_by"] = $this->session->userdata("userId");
        $inputs["last_updated"] = date('Y-m-d H:i:s');




        return $this->scheme_model->save($inputs, $scheme_id);
    }

    //----------------------------------------------------------------
    public function get_scheme_list($where_condition = NULL, $pagination = TRUE, $public = FALSE)
    {
        $data = (object) array();
        $fields = array(
            "schemes.*", "projects.project_name", "districts.district_name", "component_categories.category", "water_user_associations.wua_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = schemes.project_id",

            "districts" => "districts.district_id = schemes.district_id",

            "component_categories" => "component_categories.component_category_id = schemes.component_category_id",

            "water_user_associations" => "water_user_associations.water_user_association_id = schemes.water_user_association_id",
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
                $this->scheme_model->uri_segment = $this->uri->segment(3);
                $config["base_url"]  = base_url($this->uri->segment(1) . "/" . $this->uri->segment(2));
            } else {
                $this->scheme_model->uri_segment = $this->uri->segment(4);
                $config["base_url"]  = base_url(ADMIN_DIR . $this->uri->segment(2) . "/" . $this->uri->segment(3));
            }
            $config["total_rows"] = $this->scheme_model->joinGet($fields, "schemes", $join_table, $where, true);
            $this->pagination->initialize($config);
            $data->pagination = $this->pagination->create_links();
            $data->schemes = $this->scheme_model->joinGet($fields, "schemes", $join_table, $where);
            return $data;
        } else {
            return $this->scheme_model->joinGet($fields, "schemes", $join_table, $where, FALSE, TRUE);
        }
    }

    public function get_scheme($scheme_id)
    {

        $fields = array(
            "schemes.*", "projects.project_name", "districts.district_name", "component_categories.category", "water_user_associations.wua_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = schemes.project_id",

            "districts" => "districts.district_id = schemes.district_id",

            "component_categories" => "component_categories.component_category_id = schemes.component_category_id",

            "water_user_associations" => "water_user_associations.water_user_association_id = schemes.water_user_association_id",
        );
        $where = "schemes.scheme_id = $scheme_id";

        return $this->scheme_model->joinGet($fields, "schemes", $join_table, $where, FALSE, TRUE);
    }
}
