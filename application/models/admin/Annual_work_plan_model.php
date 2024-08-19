<?php if (!defined('BASEPATH')) exit('Direct access not allowed!');

class Annual_work_plan_model extends MY_Model
{

    public function __construct()
    {

        parent::__construct();
        $this->table = "annual_work_plans";
        $this->pk = "annual_work_plan_id";
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
                "field"  =>  "component_category_id",
                "label"  =>  "Component Category Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "financial_year_id",
                "label"  =>  "Financial Year Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "anual_target",
                "label"  =>  "Anual Target",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "material_cost",
                "label"  =>  "Material",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "labor_cost",
                "label"  =>  "Labor Cost",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "farmer_share",
                "label"  =>  "Farmer Share",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "total_cost",
                "label"  =>  "Total Cost",
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

        $inputs["component_id"]  =  $this->input->post("component_id");

        $inputs["sub_component_id"]  =  $this->input->post("sub_component_id");

        $inputs["component_category_id"]  =  $this->input->post("component_category_id");

        $inputs["financial_year_id"]  =  $this->input->post("financial_year_id");

        $inputs["anual_target"]  =  $this->input->post("anual_target");

        $inputs["material_cost"]  =  $this->input->post("material_cost");

        $inputs["labor_cost"]  =  $this->input->post("labor_cost");

        $inputs["farmer_share"]  =  $this->input->post("farmer_share");

        $inputs["total_cost"]  =  $this->input->post("total_cost");

        return $this->annual_work_plan_model->save($inputs);
    }

    public function update_data($annual_work_plan_id, $image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");

        $inputs["component_id"]  =  $this->input->post("component_id");

        $inputs["sub_component_id"]  =  $this->input->post("sub_component_id");

        $inputs["component_category_id"]  =  $this->input->post("component_category_id");

        $inputs["financial_year_id"]  =  $this->input->post("financial_year_id");

        $inputs["anual_target"]  =  $this->input->post("anual_target");

        $inputs["material_cost"]  =  $this->input->post("material_cost");

        $inputs["labor_cost"]  =  $this->input->post("labor_cost");

        $inputs["farmer_share"]  =  $this->input->post("farmer_share");

        $inputs["total_cost"]  =  $this->input->post("total_cost");

        return $this->annual_work_plan_model->save($inputs, $annual_work_plan_id);
    }

    //----------------------------------------------------------------
    public function get_annual_work_plan_list($where_condition = NULL, $pagination = TRUE, $public = FALSE)
    {
        $data = (object) array();
        $fields = array(
            "annual_work_plans.*", "projects.project_name", "components.component_name", "sub_components.sub_component_name", "component_categories.category", "financial_years.financial_year"
        );
        $join_table = array(
            "projects" => "projects.project_id = annual_work_plans.project_id",

            "components" => "components.component_id = annual_work_plans.component_id",

            "sub_components" => "sub_components.sub_component_id = annual_work_plans.sub_component_id",

            "component_categories" => "component_categories.component_category_id = annual_work_plans.component_category_id",

            "financial_years" => "financial_years.financial_year_id = annual_work_plans.financial_year_id",
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
                $this->annual_work_plan_model->uri_segment = $this->uri->segment(3);
                $config["base_url"]  = base_url($this->uri->segment(1) . "/" . $this->uri->segment(2));
            } else {
                $this->annual_work_plan_model->uri_segment = $this->uri->segment(4);
                $config["base_url"]  = base_url(ADMIN_DIR . $this->uri->segment(2) . "/" . $this->uri->segment(3));
            }
            $config["total_rows"] = $this->annual_work_plan_model->joinGet($fields, "annual_work_plans", $join_table, $where, true);
            $this->pagination->initialize($config);
            $data->pagination = $this->pagination->create_links();
            $data->annual_work_plans = $this->annual_work_plan_model->joinGet($fields, "annual_work_plans", $join_table, $where);
            return $data;
        } else {
            return $this->annual_work_plan_model->joinGet($fields, "annual_work_plans", $join_table, $where, FALSE, TRUE);
        }
    }

    public function get_annual_work_plan($annual_work_plan_id)
    {

        $fields = array(
            "annual_work_plans.*", "projects.project_name", "components.component_name", "sub_components.sub_component_name", "component_categories.category", "financial_years.financial_year"
        );
        $join_table = array(
            "projects" => "projects.project_id = annual_work_plans.project_id",

            "components" => "components.component_id = annual_work_plans.component_id",

            "sub_components" => "sub_components.sub_component_id = annual_work_plans.sub_component_id",

            "component_categories" => "component_categories.component_category_id = annual_work_plans.component_category_id",

            "financial_years" => "financial_years.financial_year_id = annual_work_plans.financial_year_id",
        );
        $where = "annual_work_plans.annual_work_plan_id = $annual_work_plan_id";

        return $this->annual_work_plan_model->joinGet($fields, "annual_work_plans", $join_table, $where, FALSE, TRUE);
    }
}