<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Water_user_associations extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/water_user_association_model");
        $this->load->model("admin/scheme_model");
        $this->lang->load("water_user_associations", 'english');
        $this->lang->load("wua_members", 'english');
        $this->lang->load("schemes", 'english');
        $this->load->model("admin/wua_member_model");

        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------


    /**
     * Default action to be called
     */
    public function index()
    {
        $main_page = base_url() . ADMIN_DIR . $this->router->fetch_class() . "/view";
        redirect($main_page);
    }
    //---------------------------------------------------------------



    /**
     * get a list of all items that are not trashed
     */
    public function view()
    {

        $where = "`water_user_associations`.`status` IN (0, 1) ";
        //$data = $this->water_user_association_model->get_water_user_association_list($where);
        $this->data["water_user_associations"] = $this->water_user_association_model->get_water_user_association_list($where, false);
        $this->data["title"] = 'Water User Associations';
        $this->data["description"] = 'Water User Associations List';
        $this->data["view"] = ADMIN_DIR . "water_user_associations/water_user_associations";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get single record by id
     */
    public function view_water_user_association($water_user_association_id)
    {

        $water_user_association_id = (int) $water_user_association_id;

        $this->data["water_user_association"] = $this->water_user_association_model->get_water_user_association($water_user_association_id)[0];
        $this->data["title"] = $this->data["water_user_association"]->wua_registration_no;
        $this->data["description"] = $this->data["water_user_association"]->wua_name;
        $this->data["view"] = ADMIN_DIR . "water_user_associations/view_water_user_association";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get a list of all trashed items
     */
    public function trashed()
    {

        $where = "`water_user_associations`.`status` IN (2) ";
        $data = $this->water_user_association_model->get_water_user_association_list($where);
        $this->data["water_user_associations"] = $data->water_user_associations;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Trashed Water User Associations');
        $this->data["view"] = ADMIN_DIR . "water_user_associations/trashed_water_user_associations";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * function to send a user to trash
     */
    public function trash($water_user_association_id, $page_id = NULL)
    {

        $water_user_association_id = (int) $water_user_association_id;


        $this->water_user_association_model->changeStatus($water_user_association_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR . "water_user_associations/view/" . $page_id);
    }

    /**
     * function to restor water_user_association from trash
     * @param $water_user_association_id integer
     */
    public function restore($water_user_association_id, $page_id = NULL)
    {

        $water_user_association_id = (int) $water_user_association_id;


        $this->water_user_association_model->changeStatus($water_user_association_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR . "water_user_associations/trashed/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to draft water_user_association from trash
     * @param $water_user_association_id integer
     */
    public function draft($water_user_association_id, $page_id = NULL)
    {

        $water_user_association_id = (int) $water_user_association_id;


        $this->water_user_association_model->changeStatus($water_user_association_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR . "water_user_associations/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to publish water_user_association from trash
     * @param $water_user_association_id integer
     */
    public function publish($water_user_association_id, $page_id = NULL)
    {

        $water_user_association_id = (int) $water_user_association_id;


        $this->water_user_association_model->changeStatus($water_user_association_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR . "water_user_associations/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to permanently delete a Water_user_association
     * @param $water_user_association_id integer
     */
    public function delete($water_user_association_id, $page_id = NULL)
    {

        $water_user_association_id = (int) $water_user_association_id;
        //$this->water_user_association_model->changeStatus($water_user_association_id, "3");
        //Remove file....
        $water_user_associations = $this->water_user_association_model->get_water_user_association($water_user_association_id);
        $file_path = $water_user_associations[0]->attachement;
        $this->water_user_association_model->delete_file($file_path);
        $this->water_user_association_model->delete(array('water_user_association_id' => $water_user_association_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR . "water_user_associations/trashed/" . $page_id);
    }
    //----------------------------------------------------



    /**
     * function to add new Water_user_association
     */
    public function add()
    {

        $this->data["projects"] = $this->water_user_association_model->getList("projects", "project_id", "project_name", $where = "`projects`.`status` IN (1) ");

        $this->data["districts"] = $this->water_user_association_model->getList("districts", "district_id", "district_name", $where = "`districts`.`status` IN (1) ");

        $this->data["tehsils"] = $this->water_user_association_model->getList("tehsils", "tehsil_id", "tehsil_name", $where = "`tehsils`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Add New Water User Association');
        $this->data["view"] = ADMIN_DIR . "water_user_associations/add_water_user_association";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------
    public function save_data()
    {
        if ($this->water_user_association_model->validate_form_data() === TRUE) {

            if ($this->upload_file("attachement")) {
                $_POST['attachement'] = $this->data["upload_data"]["file_name"];
            }

            $water_user_association_id = $this->water_user_association_model->save_data();
            if ($water_user_association_id) {
                $this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR . "water_user_associations/edit/$water_user_association_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "water_user_associations/add");
            }
        } else {
            $this->add();
        }
    }


    /**
     * function to edit a Water_user_association
     */
    public function edit($water_user_association_id)
    {
        $water_user_association_id = (int) $water_user_association_id;
        $this->data["water_user_association"] = $this->water_user_association_model->get($water_user_association_id);

        $this->data["projects"] = $this->water_user_association_model->getList("projects", "project_id", "project_name", $where = "`projects`.`status` IN (1) ");

        $this->data["districts"] = $this->water_user_association_model->getList("districts", "district_id", "district_name", $where = "`districts`.`status` IN (1) ");

        $this->data["tehsils"] = $this->water_user_association_model->getList("tehsils", "tehsil_id", "tehsil_name", $where = "`tehsils`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Edit Water User Association');
        $this->data["view"] = ADMIN_DIR . "water_user_associations/edit_water_user_association";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------

    public function update_data($water_user_association_id)
    {

        $water_user_association_id = (int) $water_user_association_id;

        if ($this->water_user_association_model->validate_form_data() === TRUE) {

            if ($this->upload_file("attachement")) {
                $_POST["attachement"] = $this->data["upload_data"]["file_name"];
            }

            $water_user_association_id = $this->water_user_association_model->update_data($water_user_association_id);
            if ($water_user_association_id) {

                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR . "water_user_associations/edit/$water_user_association_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "water_user_associations/edit/$water_user_association_id");
            }
        } else {
            $this->edit($water_user_association_id);
        }
    }


    /**
     * get data as a json array 
     */
    public function get_json()
    {
        $where = array("status" => 1);
        $where[$this->uri->segment(3)] = $this->uri->segment(4);
        $data["water_user_associations"] = $this->water_user_association_model->getBy($where, false, "water_user_association_id");
        $j_array[] = array("id" => "", "value" => "water_user_association");
        foreach ($data["water_user_associations"] as $water_user_association) {
            $j_array[] = array("id" => $water_user_association->water_user_association_id, "value" => "");
        }
        echo json_encode($j_array);
    }
    //-----------------------------------------------------



    public function awa_member_form()
    {

        $water_user_association_id = (int) $this->input->post('water_user_association_id');
        $wua_member_id = (int) $this->input->post('wua_member_id');
        $water_user_association = $this->water_user_association_model->get_water_user_association($water_user_association_id)[0];
        if ($wua_member_id == 0) {
            $wua_member["wua_member_id"]  =  0;
            $wua_member["project_id"]  =  $water_user_association->project_id;
            $wua_member["district_id"]  =  $water_user_association->district_id;
            $wua_member["water_user_association_id"]  =  $water_user_association_id;
            $wua_member["member_type"]  =  "";
            $wua_member["member_name"]  =  "";
            $wua_member["member_father_name"]  =  "";
            $wua_member["member_gender"]  =  "";
            $wua_member["member_cnic"]  =  "";
            $wua_member["attachment"]  =  "";
            $wua_member["contact_no"]  =  "";


            $wua_member =  (object) $wua_member;
        } else {
            $query = "SELECT * FROM wua_members WHERE wua_member_id = $wua_member_id";
            $wua_member = $this->db->query($query)->row();
        }
        $this->data['wua_member'] = $wua_member;

        $this->load->view(ADMIN_DIR . "water_user_associations/awa_member_form", $this->data);
    }

    public function add_wua_member()
    {

        if ($this->wua_member_model->validate_form_data() === TRUE) {
            $wua_member_id = (int) $this->input->post('wua_member_id');
            if ($this->upload_file("attachment")) {
                $_POST['attachment'] = $this->data["upload_data"]["file_name"];
            } else {
                echo '<div class="alert alert-danger"> ' . $this->upload->display_errors() . "</div>";
                exit();
            }
            if ($wua_member_id == 0) {
                $wua_member_id = $this->wua_member_model->save_data();
            } else {
                $wua_member_id = $this->wua_member_model->update_data($wua_member_id);
            }
            if ($wua_member_id) {
                echo "success";
            } else {
                echo  "Error While Adding or Updating the record.";
            }
        } else {

            echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
        }
    }


    public function scheme_form()
    {

        $scheme_id = (int) $this->input->post('scheme_id');
        $water_user_association_id = (int) $this->input->post('water_user_association_id');
        $water_user_association = $this->water_user_association_model->get_water_user_association($water_user_association_id)[0];
        if ($scheme_id == 0) {
            $scheme["scheme_id"]  =  0;
            $scheme["project_id"]  =  $water_user_association->project_id;
            $scheme["district_id"]  =  $water_user_association->district_id;
            $scheme["water_user_association_id"]  =  $water_user_association_id;
            $scheme["sanctioned_cost"]  =  0;
            $scheme["revised_cost"]  =  0;
            $scheme["approved_cost"]  =  0;
            $scheme["estimated_cost"]  =  0;
            $scheme["female_beneficiaries"]  =  0;
            $scheme["male_beneficiaries"]  =  0;
            $scheme["beneficiaries"]  =  0;
            $scheme["longitude"]  =  0;
            $scheme["latitude"]  =  0;
            $scheme["water_source"]  =  "";
            $scheme["scheme_name"]  =  "";
            $scheme["scheme_code"]  =  "";
            $scheme["component_category_id"]  = 0;
            $scheme =  (object) $scheme;
        } else {
            $query = "SELECT * FROM schemes WHERE scheme_id = $scheme_id";
            $scheme = $this->db->query($query)->row();
        }
        $this->data['scheme'] = $scheme;
        $this->data["component_categories"] = $this->scheme_model->getList("component_categories", "component_category_id", "category", $where = "`component_categories`.`status` IN (1) ");



        $this->load->view(ADMIN_DIR . "water_user_associations/scheme_form", $this->data);
    }

    public function add_scheme()
    {

        if ($this->scheme_model->validate_form_data() === TRUE) {
            $scheme_id = (int) $this->input->post('scheme_id');

            if ($scheme_id == 0) {
                $scheme_id = $this->scheme_model->save_data();
            } else {
                $scheme_id = $this->scheme_model->update_data($scheme_id);
            }
            if ($scheme_id) {
                echo "success";
            } else {
                echo  "Error While Adding or Updating the record.";
            }
        } else {

            echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
        }
    }

    public function view_scheme_detail($water_user_association_id, $scheme_id)
    {

        $water_user_association_id = (int) $water_user_association_id;
        $scheme_id = (int) $scheme_id;

        $this->data["water_user_association"] = $this->water_user_association_model->get_water_user_association($water_user_association_id)[0];
        $query = "SELECT * FROM schemes WHERE scheme_id = $scheme_id";
        //$scheme = $this->scheme_model->get_scheme($scheme_id)[0];
        $scheme = $this->db->query($query)->row();
        $this->data["scheme"] = $scheme;
        $this->data["title"] = $scheme->scheme_name . " (" . $scheme->scheme_code . ")";
        $this->data["description"] = $this->data["water_user_association"]->wua_registration_no . " - " . $this->data["water_user_association"]->wua_name;
        $this->data["view"] = ADMIN_DIR . "water_user_associations/view_scheme_detail";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    // public function scheme_expense_form()
    // {

    //     $purpose = $this->input->post('purpose');
    //     $expense_id = (int) $this->input->post('purpose');
    //     $scheme_id = (int) $this->input->post('scheme_id');
    //     $query = "SELECT * FROM schemes WHERE scheme_id = '" . $scheme_id . "'";
    //     $scheme = $this->db->query($query)->row();

    //     if ($expense_id == 0) {
    //         $expense['expense_id'] = 0;
    //         $expense['scheme_id'] = $scheme_id;
    //         $expense['purpose'] = $purpose;
    //         $expense['project_id'] = $scheme->project_id;
    //         $expense['district_id'] = $scheme->district_id;
    //         $expense['component_category_id'] = $scheme->component_category_id;
    //         $expense['payee_name'] = "";
    //         $expense['cheque'] = "";
    //         $expense['date'] = "";
    //         $expense['gross_pay'] = 0.00;
    //         $expense['whit_tax'] = 0.00;
    //         $expense['whst_tax'] = 0.00;
    //         $expense['rdp_tax'] = 0.00;
    //         $expense['st_duty_tax'] = 0.00;
    //         $expense['misc_deduction'] = 0.00;
    //         $expense['net_pay'] = 0.00;
    //         //scheme fields are required
    //         $expense =  (object) $expense;
    //     } else {
    //         $query = "SELECT * FROM expense WHERE expense_id = $expense_id";
    //         $expense = $this->db->query($query)->result();
    //     }
    //     $this->data['expense'] = $expense;


    //     $this->data['districts'] = $this->db->query('SELECT district_id, district_name, region FROM districts')->result();
    //     $query = "SELECT cc.component_category_id,
    //     cc.category,
    //     sc.sub_component_name,
    //     s.component_name
    //     FROM component_categories as cc
    //     INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.component_category_id)
    //     INNER JOIN components as s ON(s.component_id = cc.component_id)";
    //     $this->data['component_catagories'] = $this->db->query($query)->result();

    //     $this->load->view(ADMIN_DIR . "expenses/expense_form", $this->data);
    // }


    // public function add_expense()
    // {
    //     if ($this->expense_model->validate_form_data() === TRUE) {
    //         $expense_id = (int) $this->input->post('expense_id');
    //         if ($expense_id) {
    //             $expense_id = $this->expense_model->save_data();
    //         } else {
    //             $expense_id = $this->expense_model->update_data($expense_id);
    //         }
    //         if ($expense_id) {
    //             echo "success";
    //         } else {
    //             echo  "Error While Adding or Updating the record.";
    //         }
    //     } else {

    //         echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
    //     }
    // }


    public function delete_member($wua_member_id, $water_user_association)
    {
        $wua_member_id = (int) $wua_member_id;
        $wua_members = $this->wua_member_model->get_wua_member($wua_member_id);
        $file_path = $wua_members[0]->attachment;
        $this->wua_member_model->delete_file($file_path);
        $this->wua_member_model->delete(array('wua_member_id' => $wua_member_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR . "water_user_associations/view_water_user_association/" . $water_user_association);
    }
}
