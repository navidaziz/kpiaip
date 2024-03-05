<?php if (!defined('BASEPATH')) exit('Direct access not allowed!');

class Wua_member_model extends MY_Model
{

    public function __construct()
    {

        parent::__construct();
        $this->table = "wua_members";
        $this->pk = "wua_member_id";
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
                "field"  =>  "water_user_association_id",
                "label"  =>  "Water User Association Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "member_type",
                "label"  =>  "Member Type",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "member_name",
                "label"  =>  "Member Name",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "member_father_name",
                "label"  =>  "Member Father Name",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "member_gender",
                "label"  =>  "Member Gender",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "member_cnic",
                "label"  =>  "Member Cnic",
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


        $inputs["water_user_association_id"]  =  $this->input->post("water_user_association_id");

        $inputs["member_type"]  =  $this->input->post("member_type");

        $inputs["member_name"]  =  $this->input->post("member_name");

        $inputs["member_father_name"]  =  $this->input->post("member_father_name");

        $inputs["member_gender"]  =  $this->input->post("member_gender");

        $inputs["member_cnic"]  =  $this->input->post("member_cnic");
        $inputs["contact_no"]  =  $this->input->post("contact_no");

        if ($_FILES["attachment"]["size"] > 0) {
            $inputs["attachment"]  =  $this->router->fetch_class() . "/" . $this->input->post("attachment");
        }

        return $this->wua_member_model->save($inputs);
    }

    public function update_data($wua_member_id, $image_field = NULL)
    {
        $inputs = array();

        $inputs["project_id"]  =  $this->input->post("project_id");

        $inputs["district_id"]  =  $this->input->post("district_id");


        $inputs["water_user_association_id"]  =  $this->input->post("water_user_association_id");

        $inputs["member_type"]  =  $this->input->post("member_type");

        $inputs["member_name"]  =  $this->input->post("member_name");

        $inputs["member_father_name"]  =  $this->input->post("member_father_name");

        $inputs["member_gender"]  =  $this->input->post("member_gender");

        $inputs["member_cnic"]  =  $this->input->post("member_cnic");
        $inputs["contact_no"]  =  $this->input->post("contact_no");



        if ($_FILES["attachment"]["size"] > 0) {
            //remove previous file....
            $wua_members = $this->get_wua_member($wua_member_id);
            $file_path = $wua_members[0]->attachment;
            $this->delete_file($file_path);
            $inputs["attachment"]  =  $this->router->fetch_class() . "/" . $this->input->post("attachment");
        }

        return $this->wua_member_model->save($inputs, $wua_member_id);
    }

    //----------------------------------------------------------------
    public function get_wua_member_list($where_condition = NULL, $pagination = TRUE, $public = FALSE)
    {
        $data = (object) array();
        $fields = array(
            "wua_members.*", "projects.project_name", "districts.district_name",
            "water_user_associations.wua_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = wua_members.project_id",

            "districts" => "districts.district_id = wua_members.district_id",

            "water_user_associations" => "water_user_associations.water_user_association_id = wua_members.water_user_association_id",
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
                $this->wua_member_model->uri_segment = $this->uri->segment(3);
                $config["base_url"]  = base_url($this->uri->segment(1) . "/" . $this->uri->segment(2));
            } else {
                $this->wua_member_model->uri_segment = $this->uri->segment(4);
                $config["base_url"]  = base_url(ADMIN_DIR . $this->uri->segment(2) . "/" . $this->uri->segment(3));
            }
            $config["total_rows"] = $this->wua_member_model->joinGet($fields, "wua_members", $join_table, $where, true);
            $this->pagination->initialize($config);
            $data->pagination = $this->pagination->create_links();
            $data->wua_members = $this->wua_member_model->joinGet($fields, "wua_members", $join_table, $where);
            return $data;
        } else {
            return $this->wua_member_model->joinGet($fields, "wua_members", $join_table, $where, FALSE, TRUE);
        }
    }

    public function get_wua_member($wua_member_id)
    {

        $fields = array(
            "wua_members.*", "projects.project_name", "districts.district_name", "water_user_associations.wua_name"
        );
        $join_table = array(
            "projects" => "projects.project_id = wua_members.project_id",

            "districts" => "districts.district_id = wua_members.district_id",

            "water_user_associations" => "water_user_associations.water_user_association_id = wua_members.water_user_association_id",
        );
        $where = "wua_members.wua_member_id = $wua_member_id";

        return $this->wua_member_model->joinGet($fields, "wua_members", $join_table, $where, FALSE, TRUE);
    }
}
