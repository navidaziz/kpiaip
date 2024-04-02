<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------


    /**
     * Default action to be called
     */
    public function index()
    {

        $this->data["title"] = 'KP-IAIP Reports';
        $this->data["description"] = 'Report Dashboard';
        $this->data["view"] = ADMIN_DIR . "reports/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    // public function region_district_wise_expense_report()
    // {
    //     $this->data["title"] = 'Region / District Wise Expense Report';
    //     $this->data["description"] = 'Filter By: ';
    //     $this->data['f_regions_array'] = NULL;
    //     $this->data['f_financial_years_array'] = NULL;
    //     $this->data['f_purpose_array'] = NULL;
    //     $purpose_query = '';
    //     if ($this->input->post('purpose')) {
    //         $this->data['f_purpose_array'] = $f_purpose = $this->input->post('purpose'); // Assuming regions is an array
    //         $pupose = implode("','", $f_purpose);
    //         $purpose_query = " AND e.purpose IN('$pupose') ";
    //     }

    //     $fy_query = '';
    //     if ($this->input->post('financial_years')) {
    //         $this->data['f_financial_years_array'] = $f_fy = $this->input->post('financial_years'); // Assuming regions is an array
    //         $ffy = implode("','", $f_fy);
    //         $fy_query = " AND e.financial_year IN('$ffy') ";
    //     }

    //     if ($this->input->post('regions')) {
    //         $this->data['f_regions_array'] = $f_regions = $this->input->post('regions'); // Assuming regions is an array
    //         $regions = implode("','", $f_regions); // Surround each region with quotes and comma separated
    //         $query = "SELECT region FROM districts WHERE region IN ('$regions') GROUP BY region";
    //     } else {
    //         $query = "SELECT region FROM districts GROUP BY region";
    //     }
    //     $regions = $this->db->query($query)->result();

    //     foreach ($regions as $region) {
    //         $query = "SELECT 
    //         COUNT(0) as total,
    //         SUM(gross_pay) as gross_pay,
    //         SUM(whit_tax) as whit_tax,
    //         SUM(whst_tax) as whst_tax,
    //         SUM(st_duty_tax) as st_duty_tax,
    //         SUM(rdp_tax) as rdp_tax,
    //         SUM(kpra_tax) as kpra_tax,
    //         SUM(misc_deduction) as misc_deduction,
    //         SUM(net_pay) as net_pay
    //         FROM expenses as e 
    //         INNER JOIN districts as d ON (d.district_id = e.district_id)
    //         WHERE d.region = '" . $region->region . "'
    //         " . $purpose_query . "
    //         " . $fy_query . " ";
    //         $region->expenses = $this->db->query($query)->row();
    //         //get district 
    //         $query = "SELECT district_name, 
    //         COUNT(0) as total,
    //         SUM(gross_pay) as gross_pay,
    //         SUM(whit_tax) as whit_tax,
    //         SUM(whst_tax) as whst_tax,
    //         SUM(st_duty_tax) as st_duty_tax,
    //         SUM(rdp_tax) as rdp_tax,
    //         SUM(kpra_tax) as kpra_tax,
    //         SUM(misc_deduction) as misc_deduction,
    //         SUM(net_pay) as net_pay
    //         FROM expenses as e 
    //         INNER JOIN districts as d ON (d.district_id = e.district_id)
    //         WHERE d.region = '" . $region->region . "'
    //         " . $purpose_query . "
    //         " . $fy_query . "
    //         GROUP BY d.district_id
    //         ORDER BY d.district_name";
    //         $region->districts = $this->db->query($query)->result();
    //     }
    //     $this->data['regions'] = $regions;
    //     $this->data["view"] = ADMIN_DIR . "reports/region_district_wise_expense_report";
    //     $this->load->view(ADMIN_DIR . "layout", $this->data);
    // }

    public function region_district_wise_expense_report()
    {
        $this->data["title"] = 'Region / District Wise Expense Report';
        $this->data["description"] = 'Filter By: ';
        $this->data['f_regions_array'] = NULL;
        $this->data['f_financial_years_array'] = NULL;
        $this->data['f_purpose_array'] = NULL;
        $this->data['f_start_date'] = NULL;
        $this->data['f_end_date'] = NULL;

        // Handling Purpose
        if ($this->input->post('purpose')) {
            $this->data['f_purpose_array'] = $this->input->post('purpose');
            $purpose_query = "AND e.purpose IN ('" . implode("','", $this->data['f_purpose_array']) . "') ";
        } else {
            $purpose_query = '';
        }




        //Hadling By Start and end date
        $fy_query = '';
        if ($this->input->post('start_date') and $this->input->post('end_date')) {
            $this->data['f_start_date'] = $start_date =  $this->input->post('start_date');
            $this->data['f_end_date'] = $end_date = $this->input->post('end_date');

            $fy_query = "AND e.date BETWEEN " . $this->db->escape($start_date) . " AND " . $this->db->escape($end_date);
        } else {
            // Handling Financial Years
            if ($this->input->post('financial_years')) {
                $this->data['f_financial_years_array'] = $this->input->post('financial_years');
                $fy_query = "AND e.financial_year IN ('" . implode("','", $this->data['f_financial_years_array']) . "') ";
            } else {
                $fy_query = '';
            }
        }


        // Handling Regions
        if ($this->input->post('regions')) {
            $this->data['f_regions_array'] = $this->input->post('regions');
            $regions = implode("','", $this->data['f_regions_array']);
            $query = "SELECT region FROM districts WHERE region IN ('$regions') GROUP BY region";
        } else {
            $query = "SELECT region FROM districts GROUP BY region";
        }

        $regions = $this->db->query($query)->result();

        foreach ($regions as $region) {
            $query = "SELECT 
            COUNT(0) as total,
            SUM(gross_pay) as gross_pay,
            SUM(whit_tax) as whit_tax,
            SUM(whst_tax) as whst_tax,
            SUM(st_duty_tax) as st_duty_tax,
            SUM(rdp_tax) as rdp_tax,
            SUM(kpra_tax) as kpra_tax,
            SUM(misc_deduction) as misc_deduction,
            SUM(net_pay) as net_pay
            FROM expenses as e 
            INNER JOIN districts as d ON (d.district_id = e.district_id)
            WHERE d.region = '" . $region->region . "'
            $purpose_query
            $fy_query";
            $region->expenses = $this->db->query($query)->row();



            $query = "SELECT * FROM districts as d WHERE d.region = '" . $region->region . "'";
            $districts = $this->db->query($query)->result();
            foreach ($districts as $district) {
                $query = "SELECT COUNT(0) as total,
            SUM(gross_pay) as gross_pay,
            SUM(whit_tax) as whit_tax,
            SUM(whst_tax) as whst_tax,
            SUM(st_duty_tax) as st_duty_tax,
            SUM(rdp_tax) as rdp_tax,
            SUM(kpra_tax) as kpra_tax,
            SUM(misc_deduction) as misc_deduction,
            SUM(net_pay) as net_pay
            FROM expenses as e 
            WHERE e.district_id = '" . $district->district_id . "'
            $purpose_query
            $fy_query";
                $district->expenses = $this->db->query($query)->row();
            }
            $region->districts = $districts;
        }

        $this->data['regions'] = $regions;
        $this->data["view"] = ADMIN_DIR . "reports/region_district_wise_expense_report";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function region_district_wise_component_expense_report()
    {
        $this->data["title"] = 'Region / District Compnents Wise Expense Report';
        $this->data["description"] = 'Filter By: ';
        $this->data['f_regions_array'] = NULL;
        $this->data['f_financial_years_array'] = NULL;
        $this->data['f_purpose_array'] = NULL;
        $this->data['f_start_date'] = NULL;
        $this->data['f_end_date'] = NULL;
        $purpose_query = '';
        $fy_query = '';

        // Get component categories
        $query = "SELECT component_category_id, category FROM component_categories";
        $this->data['component_categories'] = $component_categories = $this->db->query($query)->result();

        if ($this->input->post('regions')) {
            $regions = $this->input->post('regions');
            $placeholders = rtrim(str_repeat('?, ', count($regions)), ', '); // Prepare placeholders for parameterized query
            $query = "SELECT region FROM districts WHERE region IN ($placeholders) GROUP BY region";
            $regions = $this->db->query($query, $regions)->result();
        } else {
            $query = "SELECT region FROM districts GROUP BY region";
            $regions = $this->db->query($query)->result();
        }

        foreach ($regions as $region) {
            // Get component categories for the region
            $query = "SELECT component_category_id, category FROM component_categories";
            $component_categories = $this->db->query($query)->result();
            foreach ($component_categories as $component_category) {
                $query = "SELECT COUNT(0) as total,
            SUM(net_pay) as net_pay
            FROM expenses as e 
            INNER JOIN districts as d ON (d.district_id = e.district_id)
            WHERE d.region = ? 
            AND e.component_category_id = ?
            $purpose_query
            $fy_query";
                $expense_result = $this->db->query($query, array($region->region, $component_category->component_category_id))->row();
                $component_category->expenses = $expense_result;
            }
            $region->component_categories = $component_categories;

            // Get districts for the region
            $query = "SELECT * FROM districts as d WHERE d.region = ?";
            $districts = $this->db->query($query, $region->region)->result();
            foreach ($districts as $district) {
                // Get component categories for the district
                $query = "SELECT component_category_id, category FROM component_categories";
                $component_categories = $this->db->query($query)->result();
                foreach ($component_categories as $component_category) {
                    $query = "SELECT COUNT(0) as total,
                SUM(net_pay) as net_pay
                FROM expenses as e 
                WHERE e.component_category_id = ? 
                AND e.district_id = ?
                $purpose_query
                $fy_query";
                    $expense_result = $this->db->query($query, array($component_category->component_category_id, $district->district_id))->row();
                    $component_category->expenses = $expense_result;
                }
                $district->component_categories = $component_categories;
            }
            $region->districts = $districts;
        }

        $this->data['regions'] = $regions;


        $this->data["view"] = ADMIN_DIR . "reports/region_district_wise_component_expense_report";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
}