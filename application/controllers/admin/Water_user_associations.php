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
    public function view($tab = 'wua')
    {
        $user_id = $this->session->userdata("userId");
        $query = "SELECT district as district_id FROM users WHERE user_id = '" . $user_id . "'";
        $user = $this->db->query($query)->row();
        //var_dump($user);
        $district_name = 'All District';
        $district_id = 0;
        if (!is_null($user)) {
            if ($user->district_id == '0') {
                $district = "All Districts";
            } else {
                $query = "SELECT district_id,  district_name FROM districts WHERE district_id = '" . $user->district_id . "'";
                $district = $this->db->query($query)->row();
                if ($district) {
                    $district_name = $district->district_name;
                    $district_id = $district->district_id;
                }
            }
        }

        $this->data['district_id'] = $district_id;
        $this->data['tab'] = $tab;
        if ($tab == 'wua') {
            $this->data["title"] = $district_name;
            $this->data["description"] = 'List of Water User Association';
        } else {
            $this->data["title"] = 'Schemes Dashboard';
            $this->data["description"] = 'List of Schemes (' . $district_name . ')';
            $this->data['schemestatus'] = $tab;
        }
        $this->data["view"] = ADMIN_DIR . "water_user_associations/wua_scheme_dashbaord";
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
        $this->data["title"] = "WUA: " . $this->data["water_user_association"]->wua_name;
        $this->data["description"] = "WUA REG NO: " . $this->data["water_user_association"]->wua_registration_no;
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

        $user_id = $this->session->userdata("userId");
        $query = "SELECT district as district_ids FROM users WHERE user_id = '" . $user_id . "'";
        $district_ids = $this->db->query($query)->row();
        if ($district_ids->district_ids) {
            $this->data["districts"] = $this->water_user_association_model->getList("districts", "district_id", "district_name", $where = "`districts`.`status` IN (1) and is_district = 1 and district_id =  $district_ids->district_ids");
        } else {
            $this->data["districts"] = $this->water_user_association_model->getList("districts", "district_id", "district_name", $where = "`districts`.`status` IN (1) and is_district = 1 ");
        }

        //$this->data["tehsils"] = $this->water_user_association_model->getList("tehsils", "tehsil_id", "tehsil_name", $where = "`tehsils`.`status` IN (1) ");

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
        $user_id = $this->session->userdata("userId");
        $query = "SELECT district as district_ids FROM users WHERE user_id = '" . $user_id . "'";
        $district_ids = $this->db->query($query)->row();

        if ($district_ids->district_ids) {
            $this->data["districts"] = $this->water_user_association_model->getList("districts", "district_id", "district_name", $where = "`districts`.`status` IN (1) and is_district = 1 and district_id =  $district_ids->district_ids");
        } else {
            $this->data["districts"] = $this->water_user_association_model->getList("districts", "district_id", "district_name", $where = "`districts`.`status` IN (1) and is_district = 1 ");
        }

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
            if ($this->input->post('attachment')) {
                if ($this->upload_file("attachment")) {
                    $_POST['attachment'] = $this->data["upload_data"]["file_name"];
                } else {
                    echo '<div class="alert alert-danger"> ' . $this->upload->display_errors() . "</div>";
                    exit();
                }
            }
            if ($wua_member_id == 0) {
                $wua_member_id = $this->wua_member_model->save_data();
            } else {
                $wua_member_id = $this->wua_member_model->update_data($wua_member_id);
            }
            if ($wua_member_id) {
                echo "success";
            } else {
                echo  '<div class="alert alert-danger">Error While Adding or Updating the record.<div>';
            }
        } else {

            echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
        }
    }


    public function scheme_form()
    {

        $scheme_id = (int) $this->input->post('scheme_id');
        $water_user_association_id = (int) $this->input->post('water_user_association_id');
        $this->data['water_user_association'] = $water_user_association = $this->water_user_association_model->get_water_user_association($water_user_association_id)[0];
        if ($scheme_id == 0) {

            $query = "SELECT * FROM water_user_associations WHERE water_user_association_id = ?";
            $wua = $this->db->query($query, [$water_user_association_id])->row();


            $scheme["scheme_id"]  =  0;
            $scheme["project_id"]  =  $water_user_association->project_id;
            $scheme["district_id"]  =  $water_user_association->district_id;
            $scheme["water_user_association_id"]  =  $water_user_association_id;
            $scheme["tehsil"] = $wua->tehsil_name;
            $scheme["uc"] = $wua->union_council;
            $scheme["villege"] = $wua->address;
            $scheme["na"] = "";
            $scheme["pk"] = "";
            $scheme["sanctioned_cost"]  =  0;
            $scheme["top_date"]  =  0;
            $scheme["revised_cost"]  =  0;
            $scheme["approved_cost"]  =  0;
            $scheme["estimated_cost"]  =  0;
            $scheme["female_beneficiaries"]  =  0;
            $scheme["male_beneficiaries"]  =  0;
            $scheme["beneficiaries"]  =  0;
            $scheme["longitude"]  =  0;
            $scheme["latitude"]  =  0;
            $scheme["water_source"]  =  "";
            $scheme["scheme_name"]  =  $wua->wua_name;
            $scheme["scheme_code"]  =  "";
            $scheme["component_category_id"]  = 0;
            $scheme["registration_date"]  = '';
            $scheme["financial_year_id"]  = '';

            $scheme =  (object) $scheme;
        } else {
            $query = "SELECT * FROM schemes WHERE scheme_id = $scheme_id";
            $scheme = $this->db->query($query)->row();
        }
        $this->data['scheme'] = $scheme;
        $this->data["component_categories"] = $this->scheme_model->getList("component_categories", "component_category_id", "category", $where = "`component_categories`.`status` IN (1) and component_categories`.`component_category_id` IN (1,2,3,4,5,6,7,8,9,10,11,12) ");
        $this->data["financial_years"] = $this->scheme_model->getList("financial_years", "financial_year_id", "financial_year", $where = "`financial_years`.`status` IN (1,0)");



        $this->load->view(ADMIN_DIR . "water_user_associations/scheme_form", $this->data);
    }

    public function add_scheme()
    {

        $_POST['approved_cost'] = 0;
        $_POST['revised_cost'] = 0;
        $_POST['sanctioned_cost'] = 0;
        $_POST['estimated_cost'] = 0;
        $_POST['scheme_status'] = 'Registered';



        if ($this->scheme_model->validate_form_data() === TRUE) {
            $scheme_id = (int) $this->input->post('scheme_id');

            if ($scheme_id == 0) {

                $district_id = $this->input->post('district_id');

                $query = "SELECT count(*) as total FROM schemes WHERE scheme_name = ? and district_id = ?";
                $scheme = $this->db->query($query, [$_POST['scheme_name'], $district_id])->row();
                if ($scheme->total > 0) {
                    echo '<div class="alert alert-danger">Scheme Duplicate Try With Different Name<div>';
                    exit();
                }

                $scheme_id = $this->scheme_model->save_data();
                $log_inputs['operation'] = 'insert';
                $log_inputs['scheme_id'] = $scheme_id;
                $log_inputs['scheme_status'] = 'Registered';
                $log_inputs['remarks'] = 'Insert';
                $log_inputs['detail'] = "S_Name:" . $_POST['scheme_name'] . ", C_CAT_ID: " . $_POST['component_category_id'] . ", Estimated Cost:" . $_POST['estimated_cost'];
                $log_inputs["created_by"] = $this->session->userdata("userId");
                $log_inputs["last_updated"] = date('Y-m-d H:i:s');


                $this->db->insert('scheme_logs', $log_inputs);
            } else {
                $district_id = $this->input->post('district_id');
                $query = "SELECT count(*) as total, scheme_status FROM schemes WHERE scheme_name = ? and scheme_id != ? and district_id = ?";
                $scheme = $this->db->query($query, [$_POST['scheme_name'], $scheme_id, $district_id])->row();
                //var_dump($scheme);
                if ($scheme->total > 0) {
                    echo '<div class="alert alert-danger">Scheme Duplicate Try With Different Name<div>';
                    exit();
                }

                $scheme_id = $this->scheme_model->update_data($scheme_id);
                $log_inputs['operation'] = 'Update';
                $log_inputs['scheme_id'] = $scheme_id;
                $log_inputs['scheme_status'] = $scheme->scheme_status;
                $log_inputs['remarks'] = 'Update';
                $log_inputs['detail'] = "S_Name:" . $_POST['scheme_name'] . ", C_CAT_ID: " . $_POST['component_category_id'] . ", Estimated Cost:" . $_POST['estimated_cost'];
                $log_inputs["created_by"] = $this->session->userdata("userId");
                $log_inputs["last_updated"] = date('Y-m-d H:i:s');


                $this->db->insert('scheme_logs', $log_inputs);
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
        $this->data["title"] = "Scheme: " . $scheme->scheme_name;
        $this->data["description"] = "Scheme Code: " . $scheme->scheme_code;
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


    public function fetch_wua_list()
    {
        $columns = [
            "water_user_association_id",
            "district_name",
            "tehsil_name",
            "union_council",
            "address",
            "file_number",
            "wua_registration_no",
            "wua_name",
            "cm_name",
            "cm_father_name",
            "cm_gender",
            "cm_cnic",
            "cm_contact_no",
            "bank_account_title",
            "bank_branch_code",
            "bank_account_number",
            "total_schemes",
            "total_cheques"
        ];

        // Sanitize and validate inputs
        $limit = (int) $this->input->post("length");
        $start = (int) $this->input->post("start");
        $order_column_index = (int) $this->input->post("order")[0]["column"];

        // Check if the order_column_index exists in columns array, otherwise set default
        if (isset($columns[$order_column_index])) {
            $order_column = $columns[$order_column_index];
        } else {
            $order_column = "water_user_association_id"; // Default column
        }

        // Validate direction, default to 'desc' if invalid
        $dir = ($this->input->post("order")[0]["dir"] === 'asc') ? 'asc' : 'desc';

        $search_value = $this->input->post("search")["value"];

        // Ensure reasonable limits on the pagination
        if ($limit < 1 || $limit > 100) {
            $limit = 10; // Set a reasonable default
        }

        // Ensure valid start index
        if ($start < 0) {
            $start = 0;
        }

        // Prepare the base query
        $sql = "SELECT * FROM `wua_list`";
        $params = [];
        $user_id = $this->session->userdata("userId");
        $query = "SELECT district as district_ids FROM users WHERE user_id = '" . $user_id . "'";
        $district_ids = $this->db->query($query)->row();
        if ($district_ids->district_ids) {
            $sql .= " WHERE district_id IN (" . $district_ids->district_ids . ")";
        } else {
            $sql .= " WHERE 1=1  ";
        }
        // Searching
        if (!empty($search_value)) {
            $sql .= " AND (";
            foreach ($columns as $column) {
                $sql .= "$column LIKE ? OR ";
                $params[] = "%" . $search_value . "%";
            }
            $sql = rtrim($sql, "OR ");
            $sql .= " ) ";
        }



        // Ordering
        $sql .= " ORDER BY $order_column $dir";
        if ($this->input->post("length") > 0) {
            // Pagination
            $sql .= " LIMIT ? OFFSET ?";
            $params[] = $limit;
            $params[] = $start;
        }

        // Execute the query securely using parameterized binding
        $query = $this->db->query($sql, $params);
        $data = $query->result();



        // Filtered records count
        $filterQuery = "SELECT COUNT(*) as count FROM `wua_list` ";
        if ($district_ids->district_ids) {
            $filterQuery .= " WHERE district_id IN (" . $district_ids->district_ids . ")";
        } else {
            $filterQuery .= " WHERE 1=1 ";
        }
        $filterQuery .= " AND " . implode(" LIKE ? OR ", $columns) . " LIKE ? ";
        $filtered_query = $this->db->query($filterQuery, array_fill(0, count($columns), "%$search_value%"));
        $recordsFiltered = $filtered_query->row()->count ? $filtered_query->row()->count : 0;




        // Total records count
        $total_count_query = "SELECT COUNT(*) as count FROM `wua_list`";
        if ($district_ids->district_ids) {
            $total_count_query .= " WHERE district_id IN (" . $district_ids->district_ids . ")";
        } else {
            $total_count_query .= " WHERE 1=1 ";
        }
        $total_records_query = $this->db->query($total_count_query);
        $total_records = $total_records_query->row()->count ? $total_records_query->row()->count : 0;

        // Output result
        $output = [
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $total_records,
            "recordsFiltered" => !empty($search_value) ? $recordsFiltered : $total_records,
            "data" => $data
        ];

        echo json_encode($output);
    }


    function chanage_status_form()
    {
        $scheme_id =  (int) $this->input->post('scheme_id');
        $query = "SELECT * FROM schemes WHERE scheme_id = $scheme_id";
        $this->data['scheme'] = $this->db->query($query)->row();
        $status_form =  $this->input->post('status_form');
        $this->data['scheme_id'] = $scheme_id;
        $this->data['status_form'] = $status_form;
        $this->load->view(ADMIN_DIR . "water_user_associations/chanage_status_form", $this->data);
    }

    function update_scheme_status()
    {
        $scheme_id =  (int) $this->input->post('scheme_id');
        $status_form = $this->input->post('status_form');
        $query = "SELECT * FROM schemes WHERE scheme_id = ?";
        $s = $this->db->query($query, $scheme_id)->row();


        if ($status_form == 'Complete') {
            $inputs["remarks"] = $remarks = '';
            $inputs["scheme_status"]  =  'Completed';
            $inputs["completion_date"] = $this->input->post('completion_date');
            $inputs["last_updated"] = date('Y-m-d H:i:s');
            if ($this->scheme_model->save($inputs, $scheme_id)) {
                $log_inputs['operation'] = 'insert';
                $log_inputs['scheme_id'] = $scheme_id;
                $log_inputs['scheme_status'] = 'Completed';
                $log_inputs['remarks'] = $remarks;
                $log_inputs["created_by"] = $this->session->userdata("userId");
                $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                $this->db->insert('scheme_logs', $log_inputs);
                echo "success";
            } else {
                echo  '<div class="alert alert-danger">Error While Adding or Updating the record.<div>';
            }
        }

        if ($status_form == 'Ongoing') {
            $inputs["remarks"] = $remarks = '';
            $inputs["scheme_status"]  =  'Ongoing';
            $inputs["last_updated"] = date('Y-m-d H:i:s');
            if ($this->scheme_model->save($inputs, $scheme_id)) {
                $log_inputs['operation'] = 'insert';
                $log_inputs['scheme_id'] = $scheme_id;
                $log_inputs['scheme_status'] = 'Ongoing';
                $log_inputs['remarks'] = $remarks;
                $log_inputs["created_by"] = $this->session->userdata("userId");
                $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                $this->db->insert('scheme_logs', $log_inputs);
                echo "success";
            } else {
                echo  '<div class="alert alert-danger">Error While Adding or Updating the record.<div>';
            }
        }
        if ($status_form == 'Dispute') {
            $inputs["remarks"] = $remarks = $this->input->post('remarks');
            $inputs["scheme_status"]  =  'Disputed';
            $inputs["last_updated"] = date('Y-m-d H:i:s');
            if ($this->scheme_model->save($inputs, $scheme_id)) {
                $log_inputs['operation'] = 'insert';
                $log_inputs['scheme_id'] = $scheme_id;
                $log_inputs['scheme_status'] = 'Disputed';
                $log_inputs['remarks'] = $remarks;
                $log_inputs["created_by"] = $this->session->userdata("userId");
                $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                $this->db->insert('scheme_logs', $log_inputs);
                echo "success";
            } else {
                echo  '<div class="alert alert-danger">Error While Adding or Updating the record.<div>';
            }
        }

        if ($status_form == 'Not Approve') {
            $inputs["approved_cost"]  =  0;
            $inputs["sanctioned_cost"]  =  0;
            $inputs["approval_date"]  =  NULL;
            $inputs["last_updated"] = date('Y-m-d H:i:s');
            $inputs["remarks"] = $remarks = $this->input->post('remarks');
            $inputs["scheme_status"]  =  'Not Approved';
            if ($this->scheme_model->save($inputs, $scheme_id)) {
                $log_inputs['operation'] = 'insert';
                $log_inputs['scheme_id'] = $scheme_id;
                $log_inputs['scheme_status'] = 'Not Approved';
                $log_inputs['remarks'] = $remarks;
                $log_inputs["created_by"] = $this->session->userdata("userId");
                $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                $this->db->insert('scheme_logs', $log_inputs);
                echo "success";
            } else {
                echo  '<div class="alert alert-danger">Error While Adding or Updating the record.<div>';
            }
        }

        if ($status_form == 'Approval') {
            $inputs["approved_cost"]  =  $this->input->post("approved_cost");
            $inputs["revised_cost"]  =  0;
            $inputs["sanctioned_cost"] = $this->input->post("approved_cost");
            $inputs["approval_date"]  =  $this->input->post("approval_date");
            $inputs["scheme_status"]  =  'Ongoing';
            $inputs["last_updated"] = date('Y-m-d H:i:s');
            if ($this->scheme_model->save($inputs, $scheme_id)) {
                $log_inputs['operation'] = 'insert';
                $log_inputs['scheme_id'] = $scheme_id;
                $log_inputs['scheme_status'] = 'Ongoing';
                $log_inputs['remarks'] = 'Approved ' . (date("Y-m-d H:i:s"));
                $log_inputs['detail'] =  "Approved Cost:" . $inputs["approved_cost"];
                $log_inputs["created_by"] = $this->session->userdata("userId");
                $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                $this->db->insert('scheme_logs', $log_inputs);
                echo "success";
            } else {
                echo  '<div class="alert alert-danger">Error While Adding or Updating the record.<div>';
            }
        }
    }

    function revise_cost()
    {
        $scheme_id =  (int) $this->input->post('scheme_id');
        $revise_cost_id =  (int) $this->input->post('revise_cost_id');

        if ($revise_cost_id == 0) {
            $inputs['revise_cost_id'] = 0;
            $inputs['revised_cost'] = 0;
            $inputs['date'] = NULL;
            $inputs['detail'] = NULL;
            $revised_cost = (object) $inputs;
        } else {
            $query = "SELECT * FROM revised_costs 
            WHERE revise_cost_id = $revise_cost_id 
            AND scheme_id = $scheme_id";
            $revised_cost = $this->db->query($query)->row();
        }
        $this->data['revised_cost'] = $revised_cost;

        $query = "SELECT * FROM schemes WHERE scheme_id = $scheme_id";
        $this->data['scheme'] = $this->db->query($query)->row();
        $status_form =  $this->input->post('status_form');
        $this->data['scheme_id'] = $scheme_id;
        $this->data['status_form'] = $status_form;
        $this->load->view(ADMIN_DIR . "water_user_associations/revise_cost", $this->data);
    }

    public function  update_revised_cost()
    {
        $scheme_id =  (int) $this->input->post('scheme_id');

        $inputs["revised_cost"]  = $revised_cost =  $this->input->post("revised_cost");
        $inputs["sanctioned_cost"] = $revised_cost;
        $inputs["revised_cost_date"] = $this->input->post("date");
        $inputs["last_updated"] = date('Y-m-d H:i:s');
        if ($this->scheme_model->save($inputs, $scheme_id)) {
            $log_inputs['operation'] = 'insert';
            $log_inputs['scheme_id'] = $scheme_id;
            $log_inputs['scheme_status'] = 'Revised';
            $log_inputs['detail'] = $this->input->post("detail");
            $log_inputs['remarks'] = 'Cost Revised: ' . $revised_cost . ' Date: ' . $this->input->post("date");
            $log_inputs["created_by"] = $this->session->userdata("userId");
            $log_inputs["last_updated"] = date('Y-m-d H:i:s');
            $this->db->insert('scheme_logs', $log_inputs);
            echo "success";
        } else {
            echo  '<div class="alert alert-danger">Error While Adding or Updating the record.<div>';
        }
    }

    public function scheme_logs()
    {
        $scheme_id =  (int) $this->input->post('scheme_id');
        $this->data['scheme_id'] = $scheme_id;
        $this->load->view(ADMIN_DIR . "water_user_associations/scheme_logs", $this->data);
    }

    public function get_water_user_association_form()
    {


        $user_id = $this->session->userdata('userId');
        $query = "SELECT district as user_district_id, role_id FROM users WHERE user_id = $user_id";
        $user = $this->db->query($query)->row();
        $this->data['user_district_id'] = $user->user_district_id;
        if ($user->role_id != 28) {
            echo '<div class="alert alert-danger">You are not allowed to add Water User Assosiation. 
            Only District Office can add Water User Assosiation. </div>';
            return;
        }


        $water_user_association_id = (int) $this->input->post("water_user_association_id");
        if ($water_user_association_id == 0) {

            $input = $this->get_wua_inputs();
        } else {
            $query = "SELECT * FROM 
            water_user_associations 
            WHERE water_user_association_id = $water_user_association_id";
            $input = $this->db->query($query)->row();

            $this->data["water_user_association"] = $this->water_user_association_model->get_water_user_association($water_user_association_id)[0];
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "water_user_associations/wua_form", $this->data);
    }

    private function get_wua_inputs()
    {

        $input["water_user_association_id"] = $this->input->post("water_user_association_id");
        //$input["project_id"] = $this->input->post("project_id");
        $input["district_id"] = $this->input->post("district_id");
        $input["tehsil_name"] = $this->input->post("tehsil_name");
        $input["union_council"] = $this->input->post("union_council");
        $input["address"] = $this->input->post("address");
        $input["file_number"] = $this->input->post("file_number");
        $input["wua_registration_no"] = $this->input->post("wua_registration_no");
        $input["wua_registration_date"] = $this->input->post("wua_registration_date");
        $input["wua_name"] = $this->input->post("wua_name");
        $input["cm_name"] = $this->input->post("cm_name");
        $input["cm_father_name"] = $this->input->post("cm_father_name");
        $input["cm_gender"] = $this->input->post("cm_gender");
        $input["cm_cnic"] = $this->input->post("cm_cnic");
        $input["cm_contact_no"] = $this->input->post("cm_contact_no");
        $input["bank_account_title"] = $this->input->post("bank_account_title");
        $input["bank_account_number"] = $this->input->post("bank_account_number");
        $input["bank_name"] = $this->input->post("bank_name");
        $input["bank_branch_code"] = $this->input->post("bank_branch_code");
        $input["attachement"] = $this->input->post("attachement");
        $inputs =  (object) $input;
        return $inputs;
    }

    public function add_water_user_association()
    {
        //$this->form_validation->set_rules("project_id", "Project Id", "required");
        $this->form_validation->set_rules("district_id", "District Id", "required");
        $this->form_validation->set_rules("tehsil_name", "Tehsil Name", "required");
        $this->form_validation->set_rules("union_council", "Union Council", "required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules("file_number", "File Number", "required");
        $this->form_validation->set_rules("wua_registration_no", "Wua Registration No", "required");
        $this->form_validation->set_rules("wua_registration_date", "Wua Registration Date", "required");
        $this->form_validation->set_rules("wua_name", "Wua Name", "required");
        $this->form_validation->set_rules("cm_name", "Cm Name", "required");
        $this->form_validation->set_rules("cm_father_name", "Cm Father Name", "required");
        $this->form_validation->set_rules("cm_gender", "Cm Gender", "required");
        $this->form_validation->set_rules("cm_cnic", "Cm Cnic", "required");
        $this->form_validation->set_rules("cm_contact_no", "Cm Contact No", "required");
        $this->form_validation->set_rules("bank_account_title", "Bank Account Title", "required");
        $this->form_validation->set_rules("bank_account_number", "Bank Account Number", "required");
        $this->form_validation->set_rules("bank_name", "Bank Name", "required");
        $this->form_validation->set_rules("bank_branch_code", "Bank Branch Code", "required");
        // $this->form_validation->set_rules("attachement", "Attachement", "required");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {
            $inputs = $this->get_wua_inputs();
            $inputs->created_by = $this->session->userdata("userId");
            $water_user_association_id = (int) $this->input->post("water_user_association_id");
            if ($water_user_association_id == 0) {
                $this->db->insert("water_user_associations", $inputs);
            } else {
                $this->db->where("water_user_association_id", $water_user_association_id);
                $inputs->last_updated = date('Y-m-d H:i:s');
                $this->db->update("water_user_associations", $inputs);
            }
            echo "success";
        }
    }





    public function change_scheme_status()
    {
        $this->data['scheme_id'] = $scheme_id =  (int) $this->input->post('scheme_id');
        $this->data['wua_id'] = $wua_id =  (int) $this->input->post('water_user_association_id');
        $query = "SELECT scheme_status FROM schemes GROUP BY scheme_status";
        $this->data['scheme_statues'] = $this->db->query($query)->result();
        $this->load->view(ADMIN_DIR . "water_user_associations/change_scheme_status", $this->data);
    }

    function update_scheme_statu2()
    {
        $scheme_id =  (int) $this->input->post('scheme_id');
        $scheme_status = $this->input->post('scheme_status');

        $remarkrs = 'Manual Change';
        $inputs["remarks"] = $remarkrs;
        $inputs["scheme_status"]  =  $scheme_status;
        $inputs["scheme_note"]  =  NULL;
        $inputs["last_updated"] = date('Y-m-d H:i:s');
        if ($this->scheme_model->save($inputs, $scheme_id)) {
            $log_inputs['operation'] = 'insert';
            $log_inputs['scheme_id'] = $scheme_id;
            $log_inputs['scheme_status'] = $scheme_status;
            $log_inputs['remarks'] = $remarkrs;
            $log_inputs["created_by"] = $this->session->userdata("userId");
            $log_inputs["last_updated"] = date('Y-m-d H:i:s');
            $this->db->insert('scheme_logs', $log_inputs);
            echo "success";
        } else {
            echo  '<div class="alert alert-danger">Error While Adding or Updating the record.<div>';
        }
    }

    function add_scheme_and_cheque()
    {


        $query = "SELECT count(*) as total FROM schemes WHERE scheme_name = ?";
        $scheme = $this->db->query($query, [$_POST['scheme_name']])->row();
        if ($scheme->total > 0) {
            echo '<div class="alert alert-danger">Scheme Duplicate Try With Different Name<div>';
            exit();
        }


        $inputs["project_id"]  =  1;

        $inputs["district_id"]  =  $this->input->post("district_id");

        $inputs["component_category_id"]  = $component_category_id =   (int) $this->input->post("component_category_id");

        $query = "SELECT category FROM component_categories WHERE component_category_id = $component_category_id";
        $component_category = $this->db->query($query)->row()->category;
        $input['category'] = $component_category;

        $inputs["scheme_code"]  =  $this->input->post("scheme_code");

        $inputs["scheme_name"]  =  $this->input->post("scheme_name");

        $inputs["water_source"]  =  0;

        $inputs["latitude"]  =  0;

        $inputs["longitude"]  =  0;

        $inputs["male_beneficiaries"]  =  0;

        $inputs["female_beneficiaries"]  =  0;

        $inputs["beneficiaries"] = $inputs["male_beneficiaries"] + $inputs["female_beneficiaries"];


        $inputs["estimated_cost"]  =  0;

        $inputs["approved_cost"]  =  0;

        $inputs["revised_cost"]  =  0;

        $inputs["sanctioned_cost"]  =  $this->input->post("sanctioned_cost");
        $inputs["registration_date"]  =  $this->input->post("registration_date");
        $inputs["completion_date"]  =  $this->input->post("completion_date");
        $inputs["financial_year_id"]  =  $this->input->post("financial_year_id");

        $inputs["water_user_association_id"]  =  $this->input->post("water_user_association_id");
        $inputs["scheme_status"]  =  'Completed-AI';
        $inputs["remarks"]  =  'On Script Schemes';
        $inputs["created_by"] = $this->session->userdata("userId");
        $inputs["last_updated"] = date('Y-m-d H:i:s');
        $scheme_id = $this->scheme_model->save($inputs);

        if ($scheme_id) {

            $cheques = $_POST['cheques'];

            $query = "UPDATE expenses SET scheme_id = '" . $scheme_id . "' WHERE cheque IN (" . $cheques . ")";
            if ($this->db->query($query)) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                echo  '<div class="alert alert-danger">Error while updating the record.<div>';
            }
        }
    }

    public function change_wua_reg_no()
    {
        $expense_id =  (int) $this->input->post('expense_id');
        $query = "SELECT * FROM all_expenses_backup2 WHERE expense_id = $expense_id";
        $this->data['expense'] = $this->db->query($query)->row();
        $this->load->view(ADMIN_DIR . "water_user_associations/change_wua_reg_no", $this->data);
    }

    public function update_wua_reg_no()
    {
        $expense_id =  (int) $this->input->post('expense_id');
        $scheme_code = $this->input->post('scheme_code');
        $query = "UPDATE all_expenses_backup2 SET wua = ? WHERE expense_id = ?";
        if ($this->db->query($query, [$scheme_code, $expense_id])) {
            echo 'success';
        } else {
            echo  '<div class="alert alert-danger">Error while updating the record.<div>';
        }
    }

    public function scheme_initiate_form()
    {
        $scheme_id = (int) $this->input->post('scheme_id');
        $query = "SELECT * FROM 
            schemes 
            WHERE scheme_id = $scheme_id";
        $input = $this->db->query($query)->row();
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "water_user_associations/scheme_initiate_form", $this->data);
    }

    public function initiate_scheme()
    {

        $this->form_validation->set_rules("survey_date", "Survey Date", "required");
        $this->form_validation->set_rules("design_date", "Design Date", "required");
        $this->form_validation->set_rules("feasibility_date", "Feasibility Date", "required");
        $this->form_validation->set_rules("work_order_date", "Work Order Date", "required");
        $this->form_validation->set_rules("scheme_initiation_date", "Scheme Initiation Date", "required");
        $this->form_validation->set_rules("estimated_cost", "Estimated Cost", "required");
        $this->form_validation->set_rules("estimated_cost_date", "Estimated Cost Date", "required");
        $this->form_validation->set_rules("technical_sanction_date", "Technical Sanction Date", "required");
        $this->form_validation->set_rules("verified_by_tpv", "Verified By Tpv", "required");
        $this->form_validation->set_rules("funding_source", "Funding Source", "required");
        $this->form_validation->set_rules("water_source", "Water Source", "required");
        $this->form_validation->set_rules("cca", "Cca", "required");
        $this->form_validation->set_rules("gca", "Gca", "required");
        $this->form_validation->set_rules("pre", "Pre", "required");
        $this->form_validation->set_rules("pre_additional", "Pre Additional", "required");
        $this->form_validation->set_rules("post", "Post", "required");
        $this->form_validation->set_rules("saving", "Saving", "required");
        $this->form_validation->set_rules("saving_utilisation_to_intensity", "Saving Utilisation To Intensity", "required");
        $this->form_validation->set_rules("saving_utilization_to_change_in_cropping_pattern", "Saving Utilization To Change In Cropping Pattern", "required");
        $this->form_validation->set_rules("water_productivity_for_wheat_and_maize", "Water Productivity For Wheat And Maize", "required");
        $this->form_validation->set_rules("any_increase_in_productivity_after_the_list_crop_cycle", "Any Increase In Productivity After The List Crop Cycle", "required");
        $this->form_validation->set_rules("total", "Total", "required");
        $this->form_validation->set_rules("lining", "Lining", "required");
        $this->form_validation->set_rules("lwh", "Lwh", "required");
        $this->form_validation->set_rules("type_of_lining", "Type Of Lining", "required");
        $this->form_validation->set_rules("nacca_pannel", "Nacca Pannel", "required");
        $this->form_validation->set_rules("culvert", "Culvert", "required");
        $this->form_validation->set_rules("risers_pipe", "Risers Pipe", "required");
        $this->form_validation->set_rules("risers_pond", "Risers Pond", "required");
        $this->form_validation->set_rules("others", "Others", "required");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {

            $input["survey_date"] = $this->input->post("survey_date");
            $input["design_date"] = $this->input->post("design_date");
            $input["feasibility_date"] = $this->input->post("feasibility_date");
            $input["work_order_date"] = $this->input->post("work_order_date");
            $input["scheme_initiation_date"] = $this->input->post("scheme_initiation_date");
            $input["estimated_cost"] = $this->input->post("estimated_cost");
            $input["estimated_cost_date"] = $this->input->post("estimated_cost_date");
            $input["technical_sanction_date"] = $this->input->post("technical_sanction_date");
            $input["verified_by_tpv"] = $this->input->post("verified_by_tpv");
            $input["funding_source"] = $this->input->post("funding_source");
            $input["water_source"] = $this->input->post("water_source");
            $input["cca"] = $this->input->post("cca");
            $input["gca"] = $this->input->post("gca");
            $input["pre"] = $this->input->post("pre");
            $input["pre_additional"] = $this->input->post("pre_additional");
            $input["post"] = $this->input->post("post");
            $input["saving"] = $this->input->post("saving");
            $input["saving_utilisation_to_intensity"] = $this->input->post("saving_utilisation_to_intensity");
            $input["saving_utilization_to_change_in_cropping_pattern"] = $this->input->post("saving_utilization_to_change_in_cropping_pattern");
            $input["water_productivity_for_wheat_and_maize"] = $this->input->post("water_productivity_for_wheat_and_maize");
            $input["any_increase_in_productivity_after_the_list_crop_cycle"] = $this->input->post("any_increase_in_productivity_after_the_list_crop_cycle");
            $input["total"] = $this->input->post("total");
            $input["lining"] = $this->input->post("lining");
            $input["lwh"] = $this->input->post("lwh");
            $input["type_of_lining"] = $this->input->post("type_of_lining");
            $input["nacca_pannel"] = $this->input->post("nacca_pannel");
            $input["culvert"] = $this->input->post("culvert");
            $input["risers_pipe"] = $this->input->post("risers_pipe");
            $input["risers_pond"] = $this->input->post("risers_pond");
            $input["others"] = $this->input->post("others");
            $input["last_updated"] = date('Y-m-d H:i:s');
            $input["scheme_status"] = 'Initiated';
            $scheme_id = (int) $this->input->post("scheme_id");
            $this->db->where("scheme_id", $scheme_id);
            $this->db->update("schemes", $input);
            $log_inputs['operation'] = 'Update';
            $log_inputs['scheme_id'] = $scheme_id;
            $log_inputs['scheme_status'] = 'Initiated';
            $log_inputs['remarks'] = 'Record Update';
            $log_inputs['detail'] = 'Scheme Technical Detail Updated';
            $log_inputs["created_by"] = $this->session->userdata("userId");
            $log_inputs["last_updated"] = date('Y-m-d H:i:s');
            $this->db->insert('scheme_logs', $log_inputs);
        }
        echo "success";
    }

    public function scheme_lists()
    {
        $columns[] = "scheme_id";
        $columns[] = "district_name";
        $columns[] = "wua_reg_code";
        $columns[] = "wua_name";
        $columns[] = "financial_year";
        $columns[] = "scheme_code";
        $columns[] = "scheme_name";
        $columns[] = "component_category";
        $columns[] = "sanctioned_cost";
        $columns[] = "paid";
        $columns[] = "paid_percentage";
        $columns[] = "remaining";
        $columns[] = "payment_count";
        $columns[] = "scheme_note";


        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        $search = $this->db->escape("%" . $this->input->post("search")["value"], "%");
        // Manual SQL query building
        $scheme_status = $this->db->escape($this->input->post('scheme_status'));
        $sql = "SELECT * FROM scheme_lists WHERE scheme_status = $scheme_status ";

        $user_id = $this->session->userdata("userId");
        $query = "SELECT district as district_ids FROM users WHERE user_id = '" . $user_id . "'";
        $district_ids = $this->db->query($query)->row();
        if ($district_ids->district_ids) {
            $sql .= " AND district_id IN (" . $district_ids->district_ids . ") ";
        }


        // Searching
        if (!empty($this->input->post("search")["value"])) {
            $search = $this->input->post("search")["value"];
            $sql .= " AND (";
            foreach ($columns as $column) {
                $sql .= "$column LIKE '%$search%' OR ";
            }
            $sql = rtrim($sql, "OR ") . ')'; // Remove the last "OR " and close the parenthesis
        }

        // Ordering
        if ($order) {
            $sql .= " ORDER BY  $order $dir";
        } else {
            $sql .= " ORDER BY scheme_name ASC";
        }

        // Pagination
        if ($limit != -1) {
            $sql .= " LIMIT $limit OFFSET $start";
        }

        $query = $this->db->query($sql);
        $data = $query->result();

        // Total records count
        $countQuery = "SELECT COUNT(*) as count FROM scheme_lists 
        WHERE scheme_status = $scheme_status ";
        if ($district_ids->district_ids) {
            $countQuery .= " AND district_id IN (" . $district_ids->district_ids . ") ";
        }

        $total_records = $this->db->query($countQuery)->row()->count;

        $output = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        );

        echo json_encode($output);
    }

    public function get_google_map()
    {
        $this->data['lat'] = $this->input->post('lat');
        $this->data['long'] = $this->input->post('long');
        $scheme_id = (int) $this->input->post('scheme_id');
        $query = "SELECT s.*, d.district_name, cc.category, cc.category_detail FROM schemes as s 
        INNER JOIN districts as d ON(d.district_id = s.district_id) 
        INNER JOIN component_categories as cc ON(cc.component_category_id = s.component_category_id)
        WHERE s.scheme_id = ?";
        $this->data['scheme'] = $this->db->query($query, [$scheme_id])->row();
        $this->load->view(ADMIN_DIR . "water_user_associations/google_map", $this->data);
    }


    public function reports()
    {
        $user_id = $this->session->userdata("userId");
        $query = "SELECT district as district_id FROM users WHERE user_id = '" . $user_id . "'";
        $user = $this->db->query($query)->row();
        //var_dump($user);
        $district_name = 'All Districts';
        $district_id = 0;
        if (!is_null($user)) {
            if ($user->district_id == '0') {
                $district = "All Districts";
            } else {
                $query = "SELECT district_id,  district_name FROM districts WHERE district_id = '" . $user->district_id . "'";
                $district = $this->db->query($query)->row();
                $district_name = $district->district_name;
                $district_id = $district->district_id;
            }
        }

        $this->data['district_id'] = $district_id;

        $this->data["title"] = 'Schemes Dashboard';
        $this->data["description"] = 'List of Schemes (' . $district_name . ')';


        $this->data["view"] = ADMIN_DIR . "water_user_associations/reports/report";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
}
