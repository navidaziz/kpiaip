<?php if (!defined('BASEPATH')) exit('Direct access not allowed!');

class Sub_component_model extends MY_Model
{

    public function __construct()
    {

        parent::__construct();
        $this->table = "sub_components";
        $this->pk = "sub_component_id";
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
                "field"  =>  "sub_component_name",
                "label"  =>  "Sub Component Name",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "sub_component_detail",
                "label"  =>  "Sub Component Detail",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "main_heading",
                "label"  =>  "Main Heading",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "account_code",
                "label"  =>  "Account Code",
                "rules"  =>  "required"
            ),

            // array(
            //     "field"  =>  "target_unit",
            //     "label"  =>  "Target Unit",
            //     "rules"  =>  "required"
            // ),

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

            // array(
            //     "field"  =>  "farmer_share",
            //     "label"  =>  "Farmer Share",
            //     "rules"  =>  "required"
            // ),

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

        $inputs["component_id"]  =  $this->input->post("component_id");

        $inputs["sub_component_name"]  =  $this->input->post("sub_component_name");

        $inputs["sub_component_detail"]  =  $this->input->post("sub_component_detail");

        $inputs["account_code"]  =  $this->input->post("account_code");
        $inputs["main_heading"]  =  $this->input->post("main_heading");

        // $inputs["target_unit"]  =  $this->input->post("target_unit");

        // $inputs["target"]  =  $this->input->post("target");

        // $inputs["material_cost"]  =  $this->input->post("material_cost");

        // $inputs["labor_cost"]  =  $this->input->post("labor_cost");

        // $inputs["farmer_share"]  =  $this->input->post("farmer_share");

        // $inputs["total_cost"]  =  $this->input->post("total_cost");

        return $this->sub_component_model->save($inputs);
    }

    public function update_data($sub_component_id, $image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");

        $inputs["component_id"]  =  $this->input->post("component_id");

        $inputs["sub_component_name"]  =  $this->input->post("sub_component_name");

        $inputs["sub_component_detail"]  =  $this->input->post("sub_component_detail");

        $inputs["account_code"]  =  $this->input->post("account_code");
        $inputs["main_heading"]  =  $this->input->post("main_heading");


        // $inputs["target_unit"]  =  $this->input->post("target_unit");

        // $inputs["target"]  =  $this->input->post("target");

        // $inputs["material_cost"]  =  $this->input->post("material_cost");

        // $inputs["labor_cost"]  =  $this->input->post("labor_cost");

        // $inputs["farmer_share"]  =  $this->input->post("farmer_share");

        // $inputs["total_cost"]  =  $this->input->post("total_cost");

        return $this->sub_component_model->save($inputs, $sub_component_id);
    }

    //----------------------------------------------------------------
    public function get_sub_component_list($where_condition = NULL, $pagination = TRUE, $public = FALSE)
    {
        $data = (object) array();
        $fields = array(
            "sub_components.*", "projects.project_name", "components.component_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = sub_components.project_id",

            "components" => "components.component_id = sub_components.component_id",
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
                $this->sub_component_model->uri_segment = $this->uri->segment(3);
                $config["base_url"]  = base_url($this->uri->segment(1) . "/" . $this->uri->segment(2));
            } else {
                $this->sub_component_model->uri_segment = $this->uri->segment(4);
                $config["base_url"]  = base_url(ADMIN_DIR . $this->uri->segment(2) . "/" . $this->uri->segment(3));
            }
            $config["total_rows"] = $this->sub_component_model->joinGet($fields, "sub_components", $join_table, $where, true);
            $this->pagination->initialize($config);
            $data->pagination = $this->pagination->create_links();
            $data->sub_components = $this->sub_component_model->joinGet($fields, "sub_components", $join_table, $where);
            return $data;
        } else {
            return $this->sub_component_model->joinGet($fields, "sub_components", $join_table, $where, FALSE, TRUE);
        }
    }

    public function get_sub_component($sub_component_id)
    {

        $fields = array(
            "sub_components.*", "projects.project_name", "components.component_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = sub_components.project_id",

            "components" => "components.component_id = sub_components.component_id",
        );
        $where = "sub_components.sub_component_id = $sub_component_id";

        return $this->sub_component_model->joinGet($fields, "sub_components", $join_table, $where, FALSE, TRUE);
    }
}
