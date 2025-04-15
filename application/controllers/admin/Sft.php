<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sft extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/water_user_association_model");
        $this->load->model("admin/scheme_model");
        //$this->lang->load("sft_correction", 'english');
        $this->lang->load("wua_members", 'english');
        $this->lang->load("schemes", 'english');
        $this->load->model("admin/wua_member_model");

        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }

    public function index($tab = 'correction')
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
        $this->data["title"] = 'SFT Correction Dashboard';
        $this->data["description"] = 'List of Completed Schemes (' . $district_name . ')';
        $this->data['schemestatus'] = $tab;
        $this->data["view"] = ADMIN_DIR . "sft/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function scheme_lists()
    {
        $columns[] = "scheme_id";
        $columns[] = "district_name";
        $columns[] = "wua_reg_code";
        $columns[] = "financial_year";
        $columns[] = "scheme_code";
        $columns[] = "scheme_name";
        $columns[] = "component_category";
        $columns[] = "sanctioned_cost";
        $columns[] = "total_paid";
        $columns[] = "deduction";
        $columns[] = "net_paid";
        $columns[] = "remaining";
        //$columns[] = "payment_count";
        //$columns[] = "first";
        //$columns[] = "second";
        //$columns[] = "first_second";
        //$columns[] = "other";
        //$columns[] = "final";
        //$columns[] = "scheme_note";


        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        $search = $this->db->escape("%" . $this->input->post("search")["value"], "%");
        // Manual SQL query building
        $scheme_status = $this->db->escape($this->input->post('scheme_status'));
        $sft_reviewed = $this->db->escape($this->input->post('sft_reviewed'));
        $sql = "SELECT * FROM scheme_lists WHERE scheme_status = $scheme_status AND sft_reviewed = $sft_reviewed ";

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
        WHERE scheme_status = $scheme_status 
        AND sft_reviewed = $sft_reviewed ";
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

    public function review_sft_data()
    {
        $scheme_id = (int) $this->input->post('scheme_id');
        $query = "SELECT s.*, d.district_name as district, d.region, cc.category, cc.category_detail
        FROM schemes as s 
        INNER JOIN districts as d ON(d.district_id = s.district_id)
        INNER JOIN component_categories as cc ON(cc.component_category_id = s.component_category_id)
        WHERE s.scheme_id = ?";
        $this->data['scheme'] = $scheme = $this->db->query($query, [$scheme_id])->row();
        $query = "SELECT * FROM water_user_associations WHERE water_user_associations.water_user_association_id = ?";
        $this->data['wua'] = $this->db->query($query, [$scheme->water_user_association_id])->row();
        if ($scheme->component_category_id == 12) {
            $this->load->view(ADMIN_DIR . "sft/b3_sft_review_form", $this->data);
        } else {
            if ($scheme->component_category_id == 10) {
                $this->load->view(ADMIN_DIR . "sft/b1_sft_review_form", $this->data);
            } else {
                $this->load->view(ADMIN_DIR . "sft/sft_review_form", $this->data);
            }
        }
    }

    public function update_scheme_sft_data()
    {
        //echo var_dump($_POST);
        //foreach ($_POST as $index => $value) {
        // echo '$this->form_validation->set_rules("' . $index . '", "' . ucwords(str_replace('_', ' ', $index)) . '", "required"); <br />';
        //echo '$input["' . $index . '"] = $this->input->post("' . $index . '");<br />';
        //}

        $this->form_validation->set_rules("scheme_id", "Scheme Id", "required");
        $this->form_validation->set_rules("wua_name", "Wua Name", "required");
        $this->form_validation->set_rules("file_number", "File Number", "required");
        $this->form_validation->set_rules("wua_registration_no", "Wua Registration No", "required");
        $this->form_validation->set_rules("wua_registration_date", "Wua Registration Date", "required");
        $this->form_validation->set_rules("male_members", "Male Members", "required");
        $this->form_validation->set_rules("female_members", "Female Members", "required");
        $this->form_validation->set_rules("tehsil_name", "Tehsil Name", "required");
        $this->form_validation->set_rules("union_council", "Union Council", "required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules("cm_name", "CM Name", "required");

        $this->form_validation->set_rules("cm_father_name", "CM Father Name", "required");
        $this->form_validation->set_rules("cm_gender", "CM Gender Name", "required");
        $this->form_validation->set_rules("cm_cnic", "CM Cnic", "required");
        $this->form_validation->set_rules("cm_contact_no", "CM Contact No", "required");
        $this->form_validation->set_rules("bank_account_title", "Bank Account Title", "required");
        $this->form_validation->set_rules("bank_account_number", "Bank Account Number", "required");
        $this->form_validation->set_rules("bank_name", "Bank Name", "required");
        $this->form_validation->set_rules("bank_branch_code", "Bank Branch Code", "required");
        $this->form_validation->set_rules("tehsil", "Tehsil", "required");
        $this->form_validation->set_rules("uc", "UC", "required");
        $this->form_validation->set_rules("villege", "Villege", "required");
        $this->form_validation->set_rules("na", "NA", "required");
        $this->form_validation->set_rules("pk", "PK", "required");
        $this->form_validation->set_rules("latitude", "Latitude", "required");
        $this->form_validation->set_rules("longitude", "Longitude", "required");
        $this->form_validation->set_rules("male_beneficiaries", "Male Beneficiaries", "required");
        $this->form_validation->set_rules("female_beneficiaries", "Female Beneficiaries", "required");
        $this->form_validation->set_rules("registration_date", "Registration Date", "required");


        $this->form_validation->set_rules("survey_date", "Survey Date", "required");
        $this->form_validation->set_rules("design_date", "Design Date", "required");
        $this->form_validation->set_rules("feasibility_date", "Feasibility Date", "required");
        $this->form_validation->set_rules("work_order_date", "Work Order Date", "required");
        $this->form_validation->set_rules("scheme_initiation_date", "Scheme Initiation Date", "required");
        $this->form_validation->set_rules("technical_sanction_date", "Technical Sanction Date", "required");

        if ($this->input->post("verified_by_tpv") == 'Yes') {
            $this->form_validation->set_rules("verification_by_tpv_date", "Top Date", "required");
        }

        $this->form_validation->set_rules("estimated_cost", "Estimated Cost", "required");
        $this->form_validation->set_rules("estimated_cost_date", "Estimated Cost Date", "required");
        $this->form_validation->set_rules("approved_cost", "Approved Cost", "required");
        $this->form_validation->set_rules("approval_date", "Approval Date", "required");
        $this->form_validation->set_rules("revised_cost", "Revised Cost", "required");
        if ($this->input->post("revised_cost") > 0) {
            $this->form_validation->set_rules("revised_cost_date", "Revised Cost Date", "required");
        }

        $this->form_validation->set_rules("completion_cost", "Completion Cost", "required");
        $this->form_validation->set_rules("completion_date", "Completion Date", "required");
        $this->form_validation->set_rules("funding_source", "Funding Source", "required");
        $this->form_validation->set_rules("water_source", "Water Source", "required");
        $this->form_validation->set_rules("cca", "Cca", "required");
        $this->form_validation->set_rules("gca", "Gca", "required");
        $this->form_validation->set_rules("acca", "Acca", "required");
        //$this->form_validation->set_rules("pre_additional", "Pre Additional", "required");
        $this->form_validation->set_rules("pre_water_losses", "Pre Water Losses", "required");
        $this->form_validation->set_rules("post_water_losses", "Post Water Losses", "required");
        //$this->form_validation->set_rules("saving_water_losses", "Saving Water Losses", "required");

        if ($this->input->post("component_category_id") <= 9) {
            $this->form_validation->set_rules("total_lenght", "Total Lenght", "required");
            $this->form_validation->set_rules("lining_length", "Lining Length", "required");
            $this->form_validation->set_rules("type_of_lining", "Type Of Lining", "required");
            $this->form_validation->set_rules("design_discharge", "Design Discharge", "required");
            $this->form_validation->set_rules("nacca_pannel", "Nacca Pannel", "required");
            $this->form_validation->set_rules("culvert", "Culvert", "required");
            $this->form_validation->set_rules("risers_pipe", "Risers Pipe", "required");
            $this->form_validation->set_rules("risers_pond", "Risers Pond", "required");
            $this->form_validation->set_rules("others", "Others", "required");
        }
        if ($this->input->post("component_category_id") == 11) {
            $this->form_validation->set_rules("length", "Length", "required");
            $this->form_validation->set_rules("width", "Width", "required");
            $this->form_validation->set_rules("height", "Height", "required");
        }
        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {

            // Water User Assosiation 
            $water_user_association_id = $this->input->post("water_user_association_id");
            $wua["wua_name"] = $this->input->post("wua_name");
            $wua["file_number"] = $this->input->post("file_number");
            $wua["wua_registration_no"] = $this->input->post("wua_registration_no");
            $wua["wua_registration_date"] = $this->input->post("wua_registration_date");


            $wua["male_members"] = $this->input->post("male_members");
            $wua["female_members"] = $this->input->post("female_members");

            $wua["tehsil_name"] = $this->input->post("tehsil_name");
            $wua["union_council"] = $this->input->post("union_council");
            $wua["address"] = $this->input->post("address");
            $wua["cm_name"] = $this->input->post("cm_name");
            $wua["cm_father_name"] = $this->input->post("cm_father_name");
            $wua["cm_gender"] = $this->input->post("cm_gender");
            $wua["cm_cnic"] = $this->input->post("cm_cnic");
            $wua["cm_contact_no"] = $this->input->post("cm_contact_no");
            $wua["bank_account_title"] = $this->input->post("bank_account_title");
            $wua["bank_account_number"] = $this->input->post("bank_account_number");
            $wua["bank_name"] = $this->input->post("bank_name");
            $wua["bank_branch_code"] = $this->input->post("bank_branch_code");

            $this->db->where("water_user_association_id", $water_user_association_id);
            $this->db->update("water_user_associations", $wua);

            //scheme SFT

            $scheme_id = $this->input->post("scheme_id");
            $input["tehsil"] = $this->input->post("tehsil");
            $input["uc"] = $this->input->post("uc");
            $input["villege"] = $this->input->post("villege");
            $input["na"] = $this->input->post("na");
            $input["pk"] = $this->input->post("pk");
            $input["latitude"] = $this->input->post("latitude");
            $input["longitude"] = $this->input->post("longitude");
            $input["male_beneficiaries"] = $this->input->post("male_beneficiaries");
            $input["female_beneficiaries"] = $this->input->post("female_beneficiaries");
            $input["registration_date"] = $this->input->post("registration_date");
            $input["top_date"] = $this->input->post("top_date");
            $input["survey_date"] = $this->input->post("survey_date");
            $input["design_date"] = $this->input->post("design_date");
            $input["feasibility_date"] = $this->input->post("feasibility_date");
            $input["work_order_date"] = $this->input->post("work_order_date");
            $input["scheme_initiation_date"] = $this->input->post("scheme_initiation_date");
            $input["technical_sanction_date"] = $this->input->post("technical_sanction_date");
            if ($this->input->post("verified_by_tpv") == 'Yes') {
                $input["verification_by_tpv_date"] = $this->input->post("verification_by_tpv_date");
            } else {
                $input["verification_by_tpv_date"] = NULL;
            }
            $input["verified_by_tpv"] = $this->input->post("verified_by_tpv");
            $input["estimated_cost"] = $this->input->post("estimated_cost");
            $input["estimated_cost_date"] = $this->input->post("estimated_cost_date");
            $input["approved_cost"] = $this->input->post("approved_cost");
            $input["approval_date"] = $this->input->post("approval_date");
            $input["revised_cost"] = $this->input->post("revised_cost");
            $input["completion_cost"] = $this->input->post("completion_cost");
            $input["completion_date"] = $this->input->post("completion_date");
            $input["funding_source"] = $this->input->post("funding_source");
            $input["water_source"] = $this->input->post("water_source");
            $input["cca"] = $this->input->post("cca");
            $input["gca"] = $this->input->post("gca");
            $input["acca"] = $this->input->post("acca");
            //$input["pre_additional"] = $this->input->post("pre_additional");
            $input["pre_water_losses"] = $this->input->post("pre_water_losses");
            $input["post_water_losses"] = $this->input->post("post_water_losses");
            if ($this->input->post("pre_water_losses") > 0) {
                $input["saving_water_losses"] = round((($this->input->post("pre_water_losses") - $this->input->post("post_water_losses")) * 100) / $this->input->post("pre_water_losses"), 2);
            } else {
                $input["saving_water_losses"] = 0;
            }
            if ($this->input->post("component_category_id") <= 9) {
                $input["total_lenght"] = $this->input->post("total_lenght");
                $input["lining_length"] = $this->input->post("lining_length");
                $input["type_of_lining"] = $this->input->post("type_of_lining");
                $input["design_discharge"] = $this->input->post("design_discharge");
                $input["nacca_pannel"] = $this->input->post("nacca_pannel");
                $input["culvert"] = $this->input->post("culvert");
                $input["risers_pipe"] = $this->input->post("risers_pipe");
                $input["risers_pond"] = $this->input->post("risers_pond");
                $input["others"] = $this->input->post("others");
            } else {
                $input["total_lenght"] = NULL;
                $input["lining_length"] = NULL;
                $input["type_of_lining"] = NULL;
                $input["design_discharge"] = NULL;
                $input["nacca_pannel"] = NULL;
                $input["culvert"] = NULL;
                $input["risers_pipe"] = NULL;
                $input["risers_pond"] = NULL;
                $input["others"] = NULL;
            }
            if ($this->input->post("component_category_id") == 9) {
                $input["length"] = $this->input->post("length");
                $input["width"] = $this->input->post("width");
                $input["height"] = $this->input->post("height");
                $input["lwh"] = $this->input->post("length") . " X " . $this->input->post("width") . " X " . $this->input->post("height");
            } else {
                $input["length"] = NULL;
                $input["width"] = NULL;
                $input["height"] = NULL;
                $input["lwh"] = NULL;
            }

            $pre_water_losses = (float) $this->input->post("pre_water_losses");
            $post_water_losses = (float) $this->input->post("post_water_losses");
            if ($pre_water_losses < $post_water_losses) {
                echo '<div class="alert alert-danger">Post Water losses should be less than to Pre Water Losses</div>';
                exit();
            }


            $completion_cost = (float) $this->input->post("completion_cost");
            $approved_cost = (float) $this->input->post("approved_cost");
            $revised_cost = (float) $this->input->post("revised_cost");


            if ($revised_cost <= 0 and $completion_cost > $approved_cost) {
                echo '<div class="alert alert-danger">Completion Cost should be less than or equal to Approved Cost</div>';
                exit();
            }

            if ($revised_cost > 0  and $completion_cost > $revised_cost) {
                echo '<div class="alert alert-danger">Completion Cost should be less than or equal to Revised Cost</div>';
                exit();
            }

            if ($revised_cost > 0  and $approved_cost > $revised_cost) {
                echo '<div class="alert alert-danger">Approved Cost should be less than or equal to Revised Cost</div>';
                exit();
            }




            $input["estimated_cost"] = $this->input->post("estimated_cost");
            $input["approved_cost"] = $this->input->post("approved_cost");
            if ($this->input->post("revised_cost") > 0) {
                $input["revised_cost"] = $this->input->post("revised_cost");
                $input["revised_cost_date"] = $this->input->post("revised_cost_date");
            } else {
                $input["revised_cost"] = 0;
                $input["revised_cost_date"] = NULL;
            }
            $input["completion_cost"] = $this->input->post("completion_cost");
            $input["sanctioned_cost"] = $this->input->post("completion_cost");


            $input["estimated_cost_date"] = $this->input->post("estimated_cost_date");
            $input["approval_date"] = $this->input->post("approval_date");

            $input["completion_date"] = $this->input->post("completion_date");

            $input["phy_completion"] = 'Yes';
            $input["phy_completion_date"] = $this->input->post("completion_date");
            $input["sft_reviewed"] = 1;

            $this->db->where("scheme_id", $scheme_id);
            $this->db->update("schemes", $input);
            echo 'success';
        }
    }
    public function update_b3_scheme_sft_data()
    {
        // //echo var_dump($_POST);
        // foreach ($_POST as $index => $value) {
        //     echo '$this->form_validation->set_rules("' . $index . '", "' . ucwords(str_replace('_', ' ', $index)) . '", "required"); <br />';
        //     // echo '$input["' . $index . '"] = $this->input->post("' . $index . '");<br />';
        // }

        // foreach ($_POST as $index => $value) {
        //     //echo '$this->form_validation->set_rules("' . $index . '", "' . ucwords(str_replace('_', ' ', $index)) . '", "required"); <br />';
        //     echo '$input["' . $index . '"] = $this->input->post("' . $index . '");<br />';
        // }

        // exit();


        $this->form_validation->set_rules("scheme_id", "Scheme Id", "required");
        $this->form_validation->set_rules("water_user_association_id", "Water User Association Id", "required");
        $this->form_validation->set_rules("component_category_id", "Component Category Id", "required");
        $this->form_validation->set_rules("tehsil", "Tehsil", "required");
        $this->form_validation->set_rules("uc", "Uc", "required");
        $this->form_validation->set_rules("villege", "Villege", "required");
        $this->form_validation->set_rules("na", "Na", "required");
        $this->form_validation->set_rules("pk", "Pk", "required");
        $this->form_validation->set_rules("approved_cost", "Approved Cost", "required");
        $this->form_validation->set_rules("approval_date", "Approval Date", "required");
        if ($this->input->post("revised_cost") > 0) {
            $this->form_validation->set_rules("revised_cost", "Revised Cost", "required");
            $this->form_validation->set_rules("revised_cost_date", "Revised Cost Date", "required");
        }
        $this->form_validation->set_rules("completion_cost", "Completion Cost", "required");
        $this->form_validation->set_rules("completion_date", "Completion Date", "required");
        $this->form_validation->set_rules("farmer_name", "Farmer Name", "required");
        $this->form_validation->set_rules("contact_no", "Contact No", "required");
        $this->form_validation->set_rules("nic_no", "Nic No", "required");
        $this->form_validation->set_rules("government_share", "Government Share", "required");
        $this->form_validation->set_rules("farmer_share", "Farmer Share", "required");
        $this->form_validation->set_rules("ssc", "Ssc", "required");
        $this->form_validation->set_rules("ssc_category", "Ssc Category", "required");
        $this->form_validation->set_rules("transmitter_make", "Transmitter Make", "required");
        $this->form_validation->set_rules("transmitter_model", "Transmitter Model", "required");
        $this->form_validation->set_rules("transmitter_sr_no", "Transmitter Sr No", "required");
        $this->form_validation->set_rules("receiver_make", "Receiver Make", "required");
        $this->form_validation->set_rules("receiver_model", "Receiver Model", "required");
        $this->form_validation->set_rules("receiver_sr_no", "Receiver Sr No", "required");
        $this->form_validation->set_rules("control_box_make", "Control Box Make", "required");
        $this->form_validation->set_rules("control_box_model", "Control Box Model", "required");
        $this->form_validation->set_rules("control_box_sr_no", "Control Box Sr No", "required");
        $this->form_validation->set_rules("scrapper_sr_no", "Scrapper Sr No", "required");
        $this->form_validation->set_rules("scrapper_blade_width", "Scrapper Blade Width", "required");
        $this->form_validation->set_rules("scrapper_weight", "Scrapper Weight", "required");
        $this->form_validation->set_rules("fcr_approving_expert", "Fcr Approving Expert", "required");
        $this->form_validation->set_rules("distribution_date", "Distribution Date", "required");


        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {



            $input["scheme_id"] = $this->input->post("scheme_id");
            $input["water_user_association_id"] = $this->input->post("water_user_association_id");
            $input["component_category_id"] = $this->input->post("component_category_id");
            $input["tehsil"] = $this->input->post("tehsil");
            $input["uc"] = $this->input->post("uc");
            $input["villege"] = $this->input->post("villege");
            $input["na"] = $this->input->post("na");
            $input["pk"] = $this->input->post("pk");
            $input["approved_cost"] = $this->input->post("approved_cost");
            $input["approval_date"] = $this->input->post("approval_date");
            $input["revised_cost"] = $this->input->post("revised_cost");
            $input["revised_cost_date"] = $this->input->post("revised_cost_date");
            $input["completion_cost"] = $this->input->post("completion_cost");
            $input["completion_date"] = $this->input->post("completion_date");
            $input["farmer_name"] = $this->input->post("farmer_name");
            $input["contact_no"] = $this->input->post("contact_no");
            $input["nic_no"] = $this->input->post("nic_no");
            $input["government_share"] = $this->input->post("government_share");
            $input["farmer_share"] = $this->input->post("farmer_share");
            $input["ssc"] = $this->input->post("ssc");
            $input["ssc_category"] = $this->input->post("ssc_category");
            $input["transmitter_make"] = $this->input->post("transmitter_make");
            $input["transmitter_model"] = $this->input->post("transmitter_model");
            $input["transmitter_sr_no"] = $this->input->post("transmitter_sr_no");
            $input["receiver_make"] = $this->input->post("receiver_make");
            $input["receiver_model"] = $this->input->post("receiver_model");
            $input["receiver_sr_no"] = $this->input->post("receiver_sr_no");
            $input["control_box_make"] = $this->input->post("control_box_make");
            $input["control_box_model"] = $this->input->post("control_box_model");
            $input["control_box_sr_no"] = $this->input->post("control_box_sr_no");
            $input["scrapper_sr_no"] = $this->input->post("scrapper_sr_no");
            $input["scrapper_blade_width"] = $this->input->post("scrapper_blade_width");
            $input["scrapper_weight"] = $this->input->post("scrapper_weight");
            $input["fcr_approving_expert"] = $this->input->post("fcr_approving_expert");
            $input["distribution_date"] = $this->input->post("distribution_date");




            $completion_cost = (float) $this->input->post("completion_cost");
            $approved_cost = (float) $this->input->post("approved_cost");
            $revised_cost = (float) $this->input->post("revised_cost");


            if ($revised_cost <= 0 and $completion_cost > $approved_cost) {
                echo '<div class="alert alert-danger">Completion Cost should be less than or equal to Approved Cost</div>';
                exit();
            }

            if ($revised_cost > 0  and $completion_cost > $revised_cost) {
                echo '<div class="alert alert-danger">Completion Cost should be less than or equal to Revised Cost</div>';
                exit();
            }

            if ($revised_cost > 0  and $approved_cost > $revised_cost) {
                echo '<div class="alert alert-danger">Approved Cost should be less than or equal to Revised Cost</div>';
                exit();
            }




            $input["estimated_cost"] = 0;
            $input["approved_cost"] = $this->input->post("approved_cost");
            if ($this->input->post("revised_cost") > 0) {
                $input["revised_cost"] = $this->input->post("revised_cost");
                $input["revised_cost_date"] = $this->input->post("revised_cost_date");
            } else {
                $input["revised_cost"] = 0;
                $input["revised_cost_date"] = NULL;
            }
            $input["completion_cost"] = $this->input->post("completion_cost");
            $input["sanctioned_cost"] = $this->input->post("completion_cost");


            $input["estimated_cost_date"] = 0;
            $input["approval_date"] = $this->input->post("approval_date");

            $input["completion_date"] = $this->input->post("completion_date");

            $input["phy_completion"] = 'Yes';
            $input["phy_completion_date"] = $this->input->post("completion_date");
            $input["sft_reviewed"] = 1;

            $scheme_id = (int) $this->input->post('scheme_id');

            $this->db->where("scheme_id", $scheme_id);
            $this->db->update("schemes", $input);
            echo 'success';
        }
    }

    public function update_b1_scheme_sft_data()
    {
        // //echo var_dump($_POST);
        // foreach ($_POST as $index => $value) {
        //     echo '$this->form_validation->set_rules("' . $index . '", "' . ucwords(str_replace('_', ' ', $index)) . '", "required"); <br />';
        //     // echo '$input["' . $index . '"] = $this->input->post("' . $index . '");<br />';
        // }

        // foreach ($_POST as $index => $value) {
        //     //echo '$this->form_validation->set_rules("' . $index . '", "' . ucwords(str_replace('_', ' ', $index)) . '", "required"); <br />';
        //     echo '$input["' . $index . '"] = $this->input->post("' . $index . '");<br />';
        // }

        // exit();


        if ($this->input->post("revised_cost") > 0) {
            $this->form_validation->set_rules("revised_cost", "Revised Cost", "required");
            $this->form_validation->set_rules("revised_cost_date", "Revised Cost Date", "required");
        }


        $this->form_validation->set_rules("scheme_id", "Scheme Id", "required");
        $this->form_validation->set_rules("water_user_association_id", "Water User Association Id", "required");
        $this->form_validation->set_rules("component_category_id", "Component Category Id", "required");
        $this->form_validation->set_rules("farmer_name", "Farmer Name", "required");
        $this->form_validation->set_rules("contact_no", "Contact No", "required");
        $this->form_validation->set_rules("nic_no", "Nic No", "required");
        $this->form_validation->set_rules("tehsil", "Tehsil", "required");
        $this->form_validation->set_rules("uc", "Uc", "required");
        $this->form_validation->set_rules("villege", "Villege", "required");
        $this->form_validation->set_rules("na", "Na", "required");
        $this->form_validation->set_rules("pk", "Pk", "required");
        $this->form_validation->set_rules("latitude", "Latitude", "required");
        $this->form_validation->set_rules("longitude", "Longitude", "required");
        $this->form_validation->set_rules("registration_date", "Registration Date", "required");
        $this->form_validation->set_rules("survey_date", "Survey Date", "required");
        $this->form_validation->set_rules("design_referred_date", "Design Referred Date", "required");
        $this->form_validation->set_rules("desing_referred_by", "Desing Referred By", "required");
        $this->form_validation->set_rules("design_approved_by", "Design Approved By", "required");
        $this->form_validation->set_rules("feasibility_checked_by", "Feasibility Checked By", "required");
        $this->form_validation->set_rules("feasibility_date", "Feasibility Date", "required");
        $this->form_validation->set_rules("work_order_date", "Work Order Date", "required");
        $this->form_validation->set_rules("scheme_initiation_date", "Scheme Initiation Date", "required");
        $this->form_validation->set_rules("technical_sanction_date", "Technical Sanction Date", "required");
        $this->form_validation->set_rules("estimated_cost", "Estimated Cost", "required");
        $this->form_validation->set_rules("estimated_cost_date", "Estimated Cost Date", "required");
        $this->form_validation->set_rules("approved_cost", "Approved Cost", "required");
        $this->form_validation->set_rules("approval_date", "Approval Date", "required");

        $this->form_validation->set_rules("completion_cost", "Completion Cost", "required");
        $this->form_validation->set_rules("completion_date", "Completion Date", "required");
        $this->form_validation->set_rules("funding_source", "Funding Source", "required");
        $this->form_validation->set_rules("water_source", "Water Source", "required");
        $this->form_validation->set_rules("government_share", "Government Share", "required");
        $this->form_validation->set_rules("farmer_share", "Farmer Share", "required");
        $this->form_validation->set_rules("per_acre_cost", "Per Acre Cost", "required");
        $this->form_validation->set_rules("ssc", "Ssc", "required");
        $this->form_validation->set_rules("scheme_area", "Scheme Area", "required");
        $this->form_validation->set_rules("crop", "Crop", "required");
        $this->form_validation->set_rules("crop_category", "Crop Category", "required");
        $this->form_validation->set_rules("system_type", "System Type", "required");
        $this->form_validation->set_rules("soil_type", "Soil Type", "required");
        $this->form_validation->set_rules("power_source", "Power Source", "required");
        $this->form_validation->set_rules("agreement_signed_date", "Agreement Signed Date", "required");



        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {


            $input["scheme_id"] = $this->input->post("scheme_id");
            $input["water_user_association_id"] = $this->input->post("water_user_association_id");
            $input["component_category_id"] = $this->input->post("component_category_id");
            $input["farmer_name"] = $this->input->post("farmer_name");
            $input["contact_no"] = $this->input->post("contact_no");
            $input["nic_no"] = $this->input->post("nic_no");
            $input["tehsil"] = $this->input->post("tehsil");
            $input["uc"] = $this->input->post("uc");
            $input["villege"] = $this->input->post("villege");
            $input["na"] = $this->input->post("na");
            $input["pk"] = $this->input->post("pk");
            $input["latitude"] = $this->input->post("latitude");
            $input["longitude"] = $this->input->post("longitude");
            $input["registration_date"] = $this->input->post("registration_date");
            $input["survey_date"] = $this->input->post("survey_date");
            $input["design_referred_date"] = $this->input->post("design_referred_date");
            $input["desing_referred_by"] = $this->input->post("desing_referred_by");
            $input["design_approved_by"] = $this->input->post("design_approved_by");
            $input["feasibility_checked_by"] = $this->input->post("feasibility_checked_by");
            $input["feasibility_date"] = $this->input->post("feasibility_date");
            $input["work_order_date"] = $this->input->post("work_order_date");
            $input["scheme_initiation_date"] = $this->input->post("scheme_initiation_date");
            $input["technical_sanction_date"] = $this->input->post("technical_sanction_date");
            $input["estimated_cost"] = $this->input->post("estimated_cost");
            $input["estimated_cost_date"] = $this->input->post("estimated_cost_date");
            $input["approved_cost"] = $this->input->post("approved_cost");
            $input["approval_date"] = $this->input->post("approval_date");
            if ($this->input->post("revised_cost") > 0) {
                $input["revised_cost"] = $this->input->post("revised_cost");
                $input["revised_cost_date"] = $this->input->post("revised_cost_date");
            }
            $input["completion_cost"] = $this->input->post("completion_cost");
            $input["completion_date"] = $this->input->post("completion_date");
            $input["funding_source"] = $this->input->post("funding_source");
            $input["water_source"] = $this->input->post("water_source");
            $input["government_share"] = $this->input->post("government_share");
            $input["farmer_share"] = $this->input->post("farmer_share");
            $input["per_acre_cost"] = $this->input->post("per_acre_cost");
            $input["ssc"] = $this->input->post("ssc");
            $input["scheme_area"] = $this->input->post("scheme_area");
            $input["crop"] = $this->input->post("crop");
            $input["crop_category"] = $this->input->post("crop_category");
            $input["system_type"] = $this->input->post("system_type");
            $input["soil_type"] = $this->input->post("soil_type");
            $input["power_source"] = $this->input->post("power_source");
            $input["agreement_signed_date"] = $this->input->post("agreement_signed_date");




            $completion_cost = (float) $this->input->post("completion_cost");
            $approved_cost = (float) $this->input->post("approved_cost");
            $revised_cost = (float) $this->input->post("revised_cost");


            if ($revised_cost <= 0 and $completion_cost > $approved_cost) {
                echo '<div class="alert alert-danger">Completion Cost should be less than or equal to Approved Cost</div>';
                exit();
            }

            if ($revised_cost > 0  and $completion_cost > $revised_cost) {
                echo '<div class="alert alert-danger">Completion Cost should be less than or equal to Revised Cost</div>';
                exit();
            }

            if ($revised_cost > 0  and $approved_cost > $revised_cost) {
                echo '<div class="alert alert-danger">Approved Cost should be less than or equal to Revised Cost</div>';
                exit();
            }




            $input["estimated_cost"] = 0;
            $input["approved_cost"] = $this->input->post("approved_cost");
            if ($this->input->post("revised_cost") > 0) {
                $input["revised_cost"] = $this->input->post("revised_cost");
                $input["revised_cost_date"] = $this->input->post("revised_cost_date");
            } else {
                $input["revised_cost"] = 0;
                $input["revised_cost_date"] = NULL;
            }
            $input["completion_cost"] = $this->input->post("completion_cost");
            $input["sanctioned_cost"] = $this->input->post("completion_cost");


            $input["estimated_cost_date"] = 0;
            $input["approval_date"] = $this->input->post("approval_date");

            $input["completion_date"] = $this->input->post("completion_date");

            $input["phy_completion"] = 'Yes';
            $input["phy_completion_date"] = $this->input->post("completion_date");
            $input["sft_reviewed"] = 1;

            $scheme_id = (int) $this->input->post('scheme_id');

            $this->db->where("scheme_id", $scheme_id);
            $this->db->update("schemes", $input);
            echo 'success';
        }
    }
}
