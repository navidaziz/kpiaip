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

    public function index()
    {

        $this->data["title"] = 'Reporting Dashbaord';
        $this->data["description"] = 'KP-IAIP  Reporting Dashbaord';
        $this->data["view"] = ADMIN_DIR . "reports/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }



    public function schemes_summary_report()
    {
        $this->data["title"] = 'Ongoing / Completed Summary Dashboard';
        $this->data["description"] = 'Schemes Summary Report';
        $this->data["view"] = ADMIN_DIR . "reports/schemes/schemes_summary_report";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function completed_intervention_summary()
    {
        $this->data["title"] = 'Completed Schemes';
        $this->data["description"] = 'Completed Intervention Summary Report';
        $this->data["view"] = ADMIN_DIR . "reports/schemes/completed_intervention_summary";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function district_fy_wise_completed_schemes()
    {
        $this->data["title"] = 'Completed Schemes';
        $this->data["description"] = 'District and FY Wise Completed Schemes';
        $this->data["view"] = ADMIN_DIR . "reports/schemes/district_fy_wise_completed_schemes";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function get_district_categories_fy_avg()
    {
        $this->data['district_id'] = $district_id = $this->input->post('district_id');
        $this->data["title"] = 'AVG Cost';
        $query = "SELECT district_name FROM districts WHERE district_id = ?";
        $district = $this->db->query($query, [$district_id])->row();
        $this->data["description"] = 'District ' . $district->district_name . ' Categories and Financial Year Wise AVG Cost';
        $this->load->view(ADMIN_DIR . "reports/schemes/get_district_categories_fy_avg", $this->data);
    }

    public function category_fy_avg_cost()
    {

        $this->data["title"] = 'AVG Cost';
        $this->data["description"] = 'Category and Financial Year Wise AVG Cost';
        $this->data["view"] = ADMIN_DIR . "reports/schemes/category_fy_avg_cost";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function district_components_avg_cost()
    {

        $this->data["title"] = 'AVG Cost';
        $this->data["description"] = 'District Wise Components AVG Cost';
        $this->data["view"] = ADMIN_DIR . "reports/schemes/district_components_avg_cost";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function district_sub_components_avg_cost()
    {

        $this->data["title"] = 'AVG Cost';
        $this->data["description"] = 'District Wise Sub Components AVG Cost';
        $this->data["view"] = ADMIN_DIR . "reports/schemes/district_sub_components_avg_cost";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function district_categories_avg_cost()
    {

        $this->data["title"] = 'AVG Cost';
        $this->data["description"] = 'District Wise Categories AVG Cost';
        $this->data["view"] = ADMIN_DIR . "reports/schemes/district_categories_avg_cost";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }


    public function export_filter_expenses()
    {

        $this->data["title"] = 'Custom Financial Report';
        $this->data["description"] = 'Custom Financial With Different Filter Option';
        $this->data["view"] = ADMIN_DIR . "reports/export_filter_expenses";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function district_wise_taxes()
    {
        $this->data["title"] = 'District Wise Taxes';
        $this->data["description"] = 'District Wise Taxes';
        $this->data["view"] = ADMIN_DIR . "reports/district_wise_taxes";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function ledger($fy_id)
    {

        $this->data['fy_id'] = (int) $fy_id;
        $this->data["title"] = 'Ledger Report';
        $this->data["description"] = 'Financial Year Wise ledger';
        $this->data["view"] = ADMIN_DIR . "reports/ledger/ledger";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function ledger_combined()
    {
        $this->data["title"] = 'Ledger Report';
        $this->data["description"] = 'Financial Year Wise ledger';
        $this->data["view"] = ADMIN_DIR . "reports/ledger/ledger_combined";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }




    public function cc_q_f_targe_and_expense_report()
    {

        $this->data["title"] = 'Annual Budget and Expense';
        $this->data["description"] = 'Annual Budget and Expense Breakdown by Component Category';
        $this->data["view"] = ADMIN_DIR . "reports/chart_of_accounts/cc_q_f_targe_and_expense_report";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }



    public function fy_w_expense_summary()
    {

        $this->data["title"] = 'FY Wise Expense Summary';
        $this->data["description"] = 'Upto Now';
        $this->data["view"] = ADMIN_DIR . "reports/fund_utilization/fy_w_expense_summary";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function budget_u_summary()
    {

        $this->data["title"] = 'Budget Utilization Summary';
        $this->data["description"] = 'Upto Now';
        $this->data["view"] = ADMIN_DIR . "reports/fund_utilization/budget_u_summary";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }


    public function f_released_by_wb()
    {

        $this->data["title"] = 'Funds Released By World Bank';
        $this->data["description"] = 'Upto Now';
        $this->data["view"] = ADMIN_DIR . "reports/fund_utilization/f_released_by_wb";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function f_released_by_fd()
    {

        $this->data["title"] = 'Funds Released By Finance Department';
        $this->data["description"] = 'Upto Now';
        $this->data["view"] = ADMIN_DIR . "reports/fund_utilization/f_released_by_fd";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function real_time_financial_proress_reprot()
    {

        $this->data["title"] = 'Financial Progress - Realtime';
        $this->data["description"] = 'Realtime Financial Progress Summary Report';
        $this->data["view"] = ADMIN_DIR . "reports/fund_utilization/real_time_financial_proress_reprot";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function financial_summary_report()
    {

        $this->data["title"] = 'Financial Reconciliation Summary Report';
        $this->data["description"] = 'Over All Financial Years';
        $this->data["view"] = ADMIN_DIR . "reports/fund_utilization/financial_summary_report";
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
    //         SUM(gross_pay) as gross_pay
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
    //         SUM(gross_pay) as gross_pay
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
        $this->data["title"] = 'Region / District Components Wise Expense Report';
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
            SUM(gross_pay) as gross_pay
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
                SUM(gross_pay) as gross_pay
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

    public function financial_statement()
    {
        $this->data["title"] = 'Financial Statement';
        $this->data["description"] = 'Filter By: ';
        $this->data['f_regions_array'] = NULL;
        $this->data['f_financial_years_array'] = NULL;
        $this->data['f_purpose_array'] = NULL;
        $this->data['f_start_date'] = NULL;
        $this->data['f_end_date'] = NULL;
        $purpose_query = '';
        $fy_query = '';

        // Fetch all financial years
        $query = "SELECT * FROM `financial_years`";
        $this->data['financial_years']  = $financial_years = $this->db->query($query)->result();

        // Fetch all components
        $query = "SELECT * FROM components";
        $components = $this->db->query($query)->result();

        foreach ($components as $component) {
            // Fetch component categories for the current component
            $query = "SELECT * FROM `component_categories` WHERE component_id = ?";
            $component_categories = $this->db->query($query, array($component->component_id))->result();

            foreach ($component_categories as $component_category) {
                foreach ($financial_years as $financial_year) {
                    // Fetch the total expenses for the current component category and financial year
                    $query = "SELECT SUM(net_pay) as total
                      FROM expenses
                      WHERE component_category_id = ? 
                      AND financial_year_id = ?";
                    $expenses = $this->db->query($query, array($component_category->component_category_id, $financial_year->financial_year_id))->row();

                    // If expenses are found, assign the total to the financial year, otherwise set it to 0
                    $component_category->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
                }

                // Assign the component categories to the component's sub_components property
                if (!isset($component->sub_components)) {
                    $component->sub_components = array();
                }
                $component->sub_components[] = $component_category;
            }
            foreach ($financial_years as $financial_year) {
                // Fetch the total expenses for the current component category and financial year
                $query = "SELECT SUM(net_pay) as total
                  FROM expenses
                  INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                  WHERE financial_year_id = ?
                  AND cc.component_id = ?";
                $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id))->row();

                // If expenses are found, assign the total to the financial year, otherwise set it to 0
                $component->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
            }
        }

        $this->data['components'] = $components;


        $this->data["view"] = ADMIN_DIR . "reports/chart_of_accounts/financial_statement";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function components_wise_financial_statement()
    {
        $this->data["title"] = 'Components Wise Financial Statement';
        $this->data["description"] = 'Chart of Account';
        // Fetch all financial years
        $query = "SELECT * FROM `financial_years`";
        $this->data['financial_years']  = $financial_years = $this->db->query($query)->result();
        // Fetch all components
        $query = "SELECT * FROM components";
        $components = $this->db->query($query)->result();
        foreach ($components as $component) {
            foreach ($financial_years as $financial_year) {
                // Fetch the total expenses for the current component category and financial year
                $query = "SELECT SUM(gross_pay) as total
                        FROM expenses
                        INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                        WHERE expenses.financial_year_id = ?
                        AND c.component_id = ? ";
                $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id))->row();

                // If expenses are found, assign the total to the financial year, otherwise set it to 0
                $component->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
            }
        }
        $this->data['components'] = $components;
        $this->data["view"] = ADMIN_DIR . "reports/chart_of_accounts/components_wise_financial_statement";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function sub_financial_statement()
    {
        $this->data["title"] = 'Sub Components Wise Financial Statement';
        $this->data["description"] = 'Chart of Account';
        // Fetch all financial years
        $query = "SELECT * FROM `financial_years`";
        $this->data['financial_years']  = $financial_years = $this->db->query($query)->result();
        // Fetch all components
        $query = "SELECT * FROM components";
        $components = $this->db->query($query)->result();
        foreach ($components as $component) {
            // Fetch component categories for the current component
            $query = "SELECT * FROM `sub_components` WHERE component_id = ?";
            $sub_components = $this->db->query($query, array($component->component_id))->result();

            foreach ($sub_components as $sub_component) {
                foreach ($financial_years as $financial_year) {
                    // Fetch the total expenses for the current component category and financial year

                    $query = "SELECT SUM(gross_pay) as total
                        FROM expenses
                        INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                        WHERE expenses.financial_year_id = ?
                        AND c.component_id = ?
                        AND sc.sub_component_id = ? ";
                    $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id, $sub_component->sub_component_id))->row();

                    // If expenses are found, assign the total to the financial year, otherwise set it to 0
                    $sub_component->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
                }

                // Assign the component categories to the component's sub_components property
                if (!isset($component->sub_components)) {
                    $component->sub_components = array();
                }
                $component->sub_components[] = $sub_component;
            }
            foreach ($financial_years as $financial_year) {
                // Fetch the total expenses for the current component category and financial year
                $query = "SELECT SUM(gross_pay) as total
                        FROM expenses
                        INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                        WHERE expenses.financial_year_id = ?
                        AND c.component_id = ? ";
                $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id))->row();

                // If expenses are found, assign the total to the financial year, otherwise set it to 0
                $component->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
            }
        }

        $this->data['components'] = $components;
        $this->data["view"] = ADMIN_DIR . "reports/chart_of_accounts/sub_components_financial_statement";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }


    public function component_cetrgory_statment()
    {
        $this->data["title"] = 'Sub Components Wise Financial Statement';
        $this->data["description"] = 'Chart of Account';
        // Fetch all financial years
        $query = "SELECT * FROM `financial_years`";
        $this->data['financial_years']  = $financial_years = $this->db->query($query)->result();
        // Fetch all components
        $query = "SELECT * FROM components";
        $components = $this->db->query($query)->result();
        foreach ($components as $component) {
            // Fetch component categories for the current component
            $query = "SELECT * FROM `sub_components` WHERE component_id = ?";
            $sub_components = $this->db->query($query, array($component->component_id))->result();

            foreach ($sub_components as $sub_component) {

                //get components categories ....

                $query = "SELECT * FROM `component_categories` WHERE sub_component_id = ?";
                $component_categories = $this->db->query($query, array($sub_component->sub_component_id))->result();
                foreach ($component_categories as $component_category) {
                    foreach ($financial_years as $financial_year) {
                        // Fetch the total expenses for the current component category and financial year
                        $query = "SELECT SUM(gross_pay) as total
                            FROM expenses
                            INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                            INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                            INNER JOIN components as c ON(c.component_id = sc.component_id)
                            WHERE expenses.financial_year_id = ?
                            AND c.component_id = ?
                            AND sc.sub_component_id = ?
                            AND cc.component_category_id = ? ";
                        $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id, $sub_component->sub_component_id, $component_category->component_category_id))->row();
                        $component_category->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
                    }
                    if (!isset($sub_component->component_categories)) {
                        $sub_component->component_categories = array();
                    }
                    $sub_component->component_categories[] = $component_category;
                }


                // components categories end here .......
                foreach ($financial_years as $financial_year) {
                    // Fetch the total expenses for the current component category and financial year

                    $query = "SELECT SUM(gross_pay) as total
                        FROM expenses
                        INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                        WHERE expenses.financial_year_id = ?
                        AND c.component_id = ?
                        AND sc.sub_component_id = ? ";
                    $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id, $sub_component->sub_component_id))->row();

                    // If expenses are found, assign the total to the financial year, otherwise set it to 0
                    $sub_component->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
                }

                // Assign the component categories to the component's sub_components property
                if (!isset($component->sub_components)) {
                    $component->sub_components = array();
                }
                $component->sub_components[] = $sub_component;
            }

            //for components only......
            foreach ($financial_years as $financial_year) {
                // Fetch the total expenses for the current component category and financial year
                $query = "SELECT SUM(gross_pay) as total
                        FROM expenses
                        INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                        WHERE expenses.financial_year_id = ?
                        AND c.component_id = ? ";
                $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id))->row();

                // If expenses are found, assign the total to the financial year, otherwise set it to 0
                $component->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
            }
        }

        $this->data['components'] = $components;
        $this->data["view"] = ADMIN_DIR . "reports/chart_of_accounts/category_financial_statement";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function test_component_cetrgory_statment()
    {
        $this->data["title"] = 'Component Category Wise Financial Statement';
        $this->data["description"] = 'Chart of Accounts';
        // Fetch all financial years
        $query = "SELECT * FROM `financial_years`";
        $this->data['financial_years']  = $financial_years = $this->db->query($query)->result();
        // Fetch all components
        $query = "SELECT * FROM components";
        $components = $this->db->query($query)->result();
        // Fetch component categories for the current component
        $query = "SELECT * FROM `sub_components` WHERE component_id = ?";
        $sub_components = $this->db->query($query, array($component->component_id))->result();

        foreach ($sub_components as $sub_component) {
            foreach ($financial_years as $financial_year) {
                // Fetch the total expenses for the current component category and financial year
                $query = "SELECT SUM(gross_pay) as total
                        FROM expenses
                        INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                        INNER JOIN components as c ON(c.component_id = sc.component_id)
                        WHERE expenses.financial_year_id = ?
                        AND c.component_id = ?
                        AND sc.sub_component_id = ? ";
                $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id, $sub_component->sub_component_id))->row();

                // If expenses are found, assign the total to the financial year, otherwise set it to 0
                $sub_component->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
            }

            $query = "SELECT * FROM `component_categories` WHERE sub_component_id = ?";
            $component_categories = $this->db->query($query, array($sub_component->sub_component_id))->result();
            foreach ($component_categories as $component_category) {
                foreach ($financial_years as $financial_year) {
                    // Fetch the total expenses for the current component category and financial year
                    $query = "SELECT SUM(gross_pay) as total
                            FROM expenses
                            INNER JOIN component_categories as cc ON(cc.component_category_id = expenses.component_category_id)
                            INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
                            INNER JOIN components as c ON(c.component_id = sc.component_id)
                            WHERE expenses.financial_year_id = ?
                            AND c.component_id = ?
                            AND sc.sub_component_id = ?
                            AND cc.component_category_id = ? ";
                    $expenses = $this->db->query($query, array($financial_year->financial_year_id, $component->component_id, $sub_component->sub_component_id, $component_category->component_category_id))->row();
                    $component_category->financial_years[$financial_year->financial_year_id] = $expenses->total > 0 ? $expenses->total : '0.0';
                }
                if (!isset($sub_component->component_categories)) {
                    $sub_component->component_categories = array();
                }
                $sub_component->component_categories[] = $component_category;
            }
            // Assign the component categories to the component's sub_components property
            if (!isset($component->sub_components)) {
                $component->sub_components = array();
            }
            $component->sub_components[] = $sub_component;
        }



        $this->data['components'] = $components;


        $this->data["view"] = ADMIN_DIR . "reports/category_financial_statement";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }



    public function export_expenses()
    {
        // Define your query
        $query = "SELECT
            e.expense_id as EXPENSE_ID,
            fy.financial_year as FY, 
            d.region as REGION,
            d.district_name as DISTRICT,
            e.purpose as PURPOSE, 
            cc.category as CATEGORY,
            cc.category_detail as CATEGORY_DETAIL, 
            s.scheme_name as SCHEME_NAME,
            s.scheme_code as SCHEME_CODE,
            wua.wua_registration_no as WUA_REG_NO,
            wua.wua_name as WUA_NAME,
            e.voucher_number as VOUCHER_NO,
            e.cheque as CHEQUE,   
            e.date as `DATE`,
            e.payee_name as PAYEE_NAME,
            e.gross_pay as GROSS_PAY,
            e.whit_tax as WHIT_TAX,
            e.whst_tax as WHST_TAX,
            e.st_duty_tax as ST_DUTY_TAX,
            e.rdp_tax as RDP_TAX,
            e.kpra_tax as KPRA_TAX,
            e.gur_ret as GUR_RET,
            e.misc_deduction as MISC_DEDUCTION,
            e.net_pay as NET_PAY
            FROM 
                expenses AS e
            INNER JOIN 
                financial_years AS fy ON fy.financial_year_id = e.financial_year_id
            INNER JOIN 
                districts AS d ON d.district_id = e.district_id
            LEFT JOIN 
                component_categories AS cc ON cc.component_category_id = e.component_category_id
            LEFT JOIN 
                schemes AS s ON(s.scheme_id = e.scheme_id)
            LEFT JOIN 
                water_user_associations as wua on(wua.water_user_association_id = s.water_user_association_id)";

        // Execute the query
        $result = $this->db->query($query)->result_array();

        // Set CSV filename
        $filename = time() . 'exported_data.csv';

        // Set headers to download the file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Write column headers
        if (!empty($result)) {
            // Get headers from the first row
            fputcsv($output, array_keys($result[0]));
            foreach ($result as $row) {
                fputcsv($output, $row);
            }
        }

        // Close the output stream
        fclose($output);
    }

    public function export_wua_data()
    {
        // Define your query
        $query = "SELECT 
        `water_user_association_id` AS `WUA_ID`,
        `wua_name` AS `WUA_NAME`, 
        `wua_registration_no` AS `WUA_REG_NO`, 
        `wua_registration_date` AS `WUA_REG_DATE`, 
        `file_number` AS `FILE_NUMBER`,
        d.district_name AS `DISTRICT_NAME`, 
        `tehsil_name` AS `TEHSIL_NAME`, 
        `union_council` AS `UNION_COUNCIL`, 
        `address` AS `ADDRESS`,
        `cm_name` AS `CM_NAME`, 
        `cm_father_name` AS `CM_FATHER_NAME`, 
        `cm_gender` AS `CM_GENDER`, 
        `cm_cnic` AS `CM_CNIC`, 
        `cm_contact_no` AS `CM_CONTACT_NO`, 
        `bank_account_title` AS `BANK_ACCOUNT_TITLE`, 
        `bank_account_number` AS `BANK_ACCOUNT_NUMBER`, 
        `bank_name` AS `BANK_NAME`, 
        `bank_branch_code` AS `BANK_BRANCH_CODE` 
        FROM 
        `water_user_associations` 
        INNER JOIN 
        districts AS d 
        ON 
        (d.district_id = water_user_associations.district_id);
        ";

        // Execute the query
        $result = $this->db->query($query)->result_array();

        // Set CSV filename
        $filename = "WUA-data-" . time() . '.csv';

        // Set headers to download the file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Write column headers
        if (!empty($result)) {
            // Get headers from the first row
            fputcsv($output, array_keys($result[0]));
            foreach ($result as $row) {
                fputcsv($output, $row);
            }
        }

        // Close the output stream
        fclose($output);
    }

    public function export_scheme_data()
    {
        // Define your query
        $query = "
        SELECT 
        s.scheme_id AS `SCHEME_ID`, 
        s.scheme_code AS `SCHEME_CODE`, 
        s.scheme_name AS `SCHEME_NAME`, 
        s.scheme_status AS `SCHEME_STATUS`,
        fy.financial_year AS `FINANCIAL_YEAR`, 
        wua.wua_name AS `WUA_NAME`, 
        wua.wua_registration_no AS `WUA_REGISTRATION_NO`,
        cc.category AS `CATEGORY`, 
        cc.category_detail AS `CATEGORY_DETAIL`, 
        sc.sub_component_name AS `SUB_COMPONENT_NAME`, 
        sc.sub_component_detail AS `SUB_COMPONENT_DETAIL`, 
        c.component_name AS `COMPONENT_NAME`, 
        c.component_detail AS `COMPONENT_DETAIL`, 
        d.district_name AS `DISTRICT_NAME`, 
        d.region AS `REGION`, 
        s.tehsil AS `TEHSIL`, 
        s.uc AS `UC`, 
        s.villege AS `VILLAGE`, 
        s.na AS `NA`, 
        s.pk AS `PK`, 
        s.latitude AS `LATITUDE`, 
        s.longitude AS `LONGITUDE`, 
        s.beneficiaries AS `BENEFICIARIES`, 
        s.male_beneficiaries AS `MALE_BENEFICIARIES`, 
        s.female_beneficiaries AS `FEMALE_BENEFICIARIES`, 
        s.registration_date AS `REGISTRATION_DATE`, 
        s.top_date AS `TOP_DATE`, 
        s.survey_date AS `SURVEY_DATE`, 
        s.design_date AS `DESIGN_DATE`, 
        s.feasibility_date AS `FEASIBILITY_DATE`, 
        s.work_order_date AS `WORK_ORDER_DATE`, 
        s.scheme_initiation_date AS `SCHEME_INITIATION_DATE`, 
        s.estimated_cost_date AS `ESTIMATED_COST_DATE`,
        s.approval_date AS `APPROVAL_DATE`, 
        s.revised_cost_date AS `REVISED_COST_DATE`, 
        s.technical_sanction_date AS `TECHNICAL_SANCTION_DATE`, 
        s.completion_date AS `COMPLETION_DATE`, 
        s.verified_by_tpv AS `VERIFIED_BY_TPV`, 
        s.verification_by_tpv_date AS `VERIFICATION_BY_TPV_DATE`, 
        s.funding_source AS `FUNDING_SOURCE`, 
        s.water_source AS `WATER_SOURCE`, 
        s.cca AS `CCA`, 
        s.acca AS `ACCA`, 
        s.gca AS `GCA`, 
        s.pre_water_losses AS `PRE_WATER_LOSSES`, 
        s.pre_additional AS `PRE_ADDITIONAL`, 
        s.post_water_losses AS `POST_WATER_LOSSES`, 
        s.saving_water_losses AS `SAVING_WATER_LOSSES`, 
        s.total_lenght AS `TOTAL_LENGTH`, 
        s.lining_length AS `LINING_LENGTH`, 
        s.lwh AS `LWH`, 
        s.length AS `LENGTH`, 
        s.width AS `WIDTH`, 
        s.height AS `HEIGHT`, 
        s.type_of_lining AS `TYPE_OF_LINING`, 
        s.nacca_pannel AS `NACCA_PANEL`, 
        s.culvert AS `CULVERT`, 
        s.risers_pipe AS `RISERS_PIPE`, 
        s.risers_pond AS `RISERS_POND`, 
        s.design_discharge AS `DESIGN_DISCHARGE`, 
        s.others AS `OTHERS`,
        s.estimated_cost AS `ESTIMATED_COST`,
        s.approved_cost AS `APPROVED_COST`, 
        s.revised_cost AS `REVISED_COST`,
        s.completion_cost AS `COMPLETION_COST`,  
        s.sanctioned_cost AS `SANCTIONED_COST`, 
        SUM(e.gross_pay) as `TOTAL_PAID`,
         SUM(e.gross_pay-e.net_pay) as `DEDUCTION`,
        SUM(e.net_pay) as `NET_PAID`,
        COUNT(e.expense_id) as `PAYMENT_COUNT`,
        GROUP_CONCAT(e.cheque ORDER BY e.installment SEPARATOR ', ') AS `cheques`,
        SUM(CASE WHEN e.installment = '1st' THEN e.gross_pay END) AS `1st`,
        SUM(CASE WHEN e.installment = '2nd' THEN e.gross_pay END) AS `2nd`,
        SUM(CASE WHEN e.installment = '1st_2nd' THEN e.gross_pay END) AS `1st_2nd`,
        SUM(CASE WHEN e.installment NOT IN ('1st', '2nd', '1st_2nd', 'Final' ) THEN e.gross_pay END) AS `OTHER`,
        SUM(CASE WHEN e.installment = 'Final' THEN e.gross_pay END) AS `FINAL`
        FROM schemes AS s
        INNER JOIN districts AS d ON(d.district_id = s.district_id)
        INNER JOIN financial_years AS fy ON(fy.financial_year_id = s.financial_year_id)
        INNER JOIN component_categories AS cc ON(cc.component_category_id = s.component_category_id)
        INNER JOIN sub_components AS sc ON(sc.sub_component_id = cc.sub_component_id)
        INNER JOIN components AS c ON(c.component_id = sc.component_id)
        INNER JOIN water_user_associations AS wua ON(wua.water_user_association_id = s.water_user_association_id)
        LEFT JOIN expenses e ON s.scheme_id = e.scheme_id  
        GROUP BY s.scheme_id
        ORDER BY `SCHEME_ID` ASC";

        // Execute the query
        $result = $this->db->query($query)->result_array();

        // Set CSV filename
        $filename = "Schemes-data-" . time() . '.csv';

        // Set headers to download the file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Write column headers
        if (!empty($result)) {
            // Get headers from the first row
            fputcsv($output, array_keys($result[0]));
            foreach ($result as $row) {
                fputcsv($output, $row);
            }
        }

        // Close the output stream
        fclose($output);
    }


    public function export_scheme_list_by_status($scheme_status = NULL)
    {
        // Define your query
        $query = "SELECT 
        `region` as REGION, 
        `district_name` as DISTRICT, 
        `financial_year` as FY,
        `scheme_code` as SCHEME_CODE,
        `scheme_name` as SCHEME_NAME,
        `component_category` as CATEGORY,
        `scheme_status` as STATUS, 
        `approvel_date` as APPROVEL_DATE,
        `sanctioned_cost` as SANCTIONED_COST, 
        `payment_count` as PAYMENT_COUNT,
        `cheques` as CHEQUES,
        `total_paid` as TOTAL_PAID, 
        `deduction` as DEDUCTION,
        `net_paid` as NET_PAID, 
        `first` as `ICR-I`, 
        `second` as `ICR-II`,
        `first_second` as  `ICR-I&II`, 
        `other` as `other`, 
        `final` as `FCR`, 
        `remaining` as `BALANCE`
        FROM `scheme_lists` ";
        if ($scheme_status) {
            $query .= " WHERE `scheme_lists`.`scheme_status` IN (?)";
            // Execute the query
            $result = $this->db->query($query, [$scheme_status])->result_array();
        } else {
            $result = $this->db->query($query)->result_array();
        }

        // Set CSV filename
        $filename = "Schemes-data-" . time() . '.csv';

        // Set headers to download the file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Write column headers
        if (!empty($result)) {
            // Get headers from the first row
            fputcsv($output, array_keys($result[0]));
            foreach ($result as $row) {
                fputcsv($output, $row);
            }
        }

        // Close the output stream
        fclose($output);
    }

    public function export_scheme_list_ongoing()
    {
        // Define your query
        $query = "SELECT 
        `region` as REGION, 
        `district_name` as DISTRICT, 
        `financial_year` as FY,
        `scheme_code` as SCHEME_CODE,
        `scheme_name` as SCHEME_NAME,
        `component_category` as CATEGORY,
        `scheme_status` as STATUS, 
        `approvel_date` as APPROVEL_DATE,
        `sanctioned_cost` as SANCTIONED_COST, 
        `payment_count` as PAYMENT_COUNT,
        `cheques` as CHEQUES,
        `total_paid` as TOTAL_PAID, 
        `deduction` as DEDUCTION,
        `net_paid` as NET_PAID, 
        `first` as `ICR-I`, 
        `second` as `ICR-II`,
        `first_second` as  `ICR-I&II`, 
        `other` as `other`, 
        `final` as `FCR`, 
        `remaining` as `BALANCE`
        FROM `scheme_lists`
        WHERE `scheme_lists`.`scheme_status` IN ('Ongoing', 'ICR-I', 'ICR-II', 'ICR-I&II')";
        $result = $this->db->query($query)->result_array();
        // Set CSV filename
        $filename = "Schemes-data-" . time() . '.csv';

        // Set headers to download the file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $filename);

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Write column headers
        if (!empty($result)) {
            // Get headers from the first row
            fputcsv($output, array_keys($result[0]));
            foreach ($result as $row) {
                fputcsv($output, $row);
            }
        }

        // Close the output stream
        fclose($output);
    }
}
