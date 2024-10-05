<?php if (!defined('BASEPATH')) exit('Direct access not allowed!');

class Component_category_model extends MY_Model
{

    public function __construct()
    {

        parent::__construct();
        $this->table = "component_categories";
        $this->pk = "component_category_id";
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
                "field"  =>  "component_id",
                "label"  =>  "Component Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "sub_component_id",
                "label"  =>  "Sub Component Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "category",
                "label"  =>  "Category",
                "rules"  =>  "required"
            ),

            // array(
            //     "field"  =>  "category_detail",
            //     "label"  =>  "Category Detail",
            //     "rules"  =>  "required"
            // ),

            array(
                "field"  =>  "target_unit",
                "label"  =>  "Target Unit",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "account_code",
                "label"  =>  "Account Code",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "main_heading",
                "label"  =>  "Category Type",
                "rules"  =>  "required"
            ),

            // array(
            //     "field"  =>  "target",
            //     "label"  =>  "Target",
            //     "rules"  =>  "required"
            // ),

            // array(
            //     "field"  =>  "material_cost",
            //     "label"  =>  "Material",
            //     "rules"  =>  "required"
            // ),

            // array(
            //     "field"  =>  "labor_cost",
            //     "label"  =>  "Labor Cost",
            //     "rules"  =>  "required"
            // ),

            array(
                "field"  =>  "farmer_share",
                "label"  =>  "Farmer Share",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "material_share",
                "label"  =>  "Material Share",
                "rules"  =>  "required"
            ),
            // array(
            //     "field"  =>  "total_cost",
            //     "label"  =>  "Total Cost",
            //     "rules"  =>  "required"
            // ),

        );
        //set and run the validation
        $this->form_validation->set_rules($validation_config);
        return $this->form_validation->run();
    }

    public function save_data($image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");

        $inputs["sub_component_id"]  =  $sub_component_id = (int) $this->input->post("sub_component_id");
        $query = "SELECT component_id FROM sub_components WHERE sub_component_id = ?";
        $result = $this->db->query($query, [$sub_component_id])->row();
        $inputs["component_id"]  =  $result->component_id;

        $inputs["category"]  =  $this->input->post("category");

        $inputs["category_detail"]  =  $this->input->post("category_detail");

        $inputs["target_unit"]  =  $this->input->post("target_unit");

        $inputs["account_code"]  =  $this->input->post("account_code");

        $inputs["main_heading"]  =  $this->input->post("main_heading");

        // $inputs["target"]  =  $this->input->post("target");

        // $inputs["material_cost"]  =  $this->input->post("material_cost");

        // $inputs["labor_cost"]  =  $this->input->post("labor_cost");

        $inputs["farmer_share"]  =  $this->input->post("farmer_share");
        $inputs["material_share"]  =  $this->input->post("material_share");

        // $inputs["total_cost"]  =  $this->input->post("total_cost");

        return $this->component_category_model->save($inputs);
    }

    public function update_data($component_category_id, $image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");

        

        $inputs["sub_component_id"]  =  $sub_component_id = (int) $this->input->post("sub_component_id");
        $query = "SELECT component_id FROM sub_components WHERE sub_component_id = ?";
        $result = $this->db->query($query, [$sub_component_id])->row();
        $inputs["component_id"]  =  $result->component_id;

        $inputs["category"]  =  $this->input->post("category");

        $inputs["category_detail"]  =  $this->input->post("category_detail");

        $inputs["target_unit"]  =  $this->input->post("target_unit");

        $inputs["account_code"]  =  $this->input->post("account_code");

        $inputs["main_heading"]  =  $this->input->post("main_heading");


        // $inputs["target"]  =  $this->input->post("target");

        // $inputs["material_cost"]  =  $this->input->post("material_cost");

        // $inputs["labor_cost"]  =  $this->input->post("labor_cost");

        $inputs["farmer_share"]  =  $this->input->post("farmer_share");
        $inputs["material_share"]  =  $this->input->post("material_share");

        // $inputs["total_cost"]  =  $this->input->post("total_cost");

        return $this->component_category_model->save($inputs, $component_category_id);
    }

    //----------------------------------------------------------------
    public function get_component_category_list($where_condition = NULL, $pagination = TRUE, $public = FALSE)
    {
        $data = (object) array();
        $fields = array(
            "component_categories.*", "projects.project_name", "components.component_name", "sub_components.sub_component_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = component_categories.project_id",

            "components" => "components.component_id = component_categories.component_id",

            "sub_components" => "sub_components.sub_component_id = component_categories.sub_component_id",
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
                $this->component_category_model->uri_segment = $this->uri->segment(3);
                $config["base_url"]  = base_url($this->uri->segment(1) . "/" . $this->uri->segment(2));
            } else {
                $this->component_category_model->uri_segment = $this->uri->segment(4);
                $config["base_url"]  = base_url(ADMIN_DIR . $this->uri->segment(2) . "/" . $this->uri->segment(3));
            }
            $config["total_rows"] = $this->component_category_model->joinGet($fields, "component_categories", $join_table, $where, true);
            $this->pagination->initialize($config);
            $data->pagination = $this->pagination->create_links();
            $data->component_categories = $this->component_category_model->joinGet($fields, "component_categories", $join_table, $where);
            return $data;
        } else {
            return $this->component_category_model->joinGet($fields, "component_categories", $join_table, $where, FALSE, TRUE);
        }
    }

    public function get_component_category($component_category_id)
    {

        $fields = array(
            "component_categories.*",
            "projects.project_name",
            "components.component_name",
            "sub_components.sub_component_name",

        );
        $join_table = array(
            "projects" => "projects.project_id = component_categories.project_id",

            "components" => "components.component_id = component_categories.component_id",

            "sub_components" => "sub_components.sub_component_id = component_categories.sub_component_id",
        );
        $where = "component_categories.component_category_id = $component_category_id";

        return $this->component_category_model->joinGet($fields, "component_categories", $join_table, $where, FALSE, TRUE);
    }
}