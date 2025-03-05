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
        $query = "SELECT s.*, d.district_name as district, d.region FROM schemes as s 
        INNER JOIN districts as d ON(d.district_id = s.district_id)
        WHERE s.scheme_id = ?";
        $this->data['scheme'] = $this->db->query($query, [$scheme_id])->row();
        $this->load->view(ADMIN_DIR . "sft/sft_review_form", $this->data);
    }
}
