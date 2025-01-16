<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Expenses extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/expense_model");
        $this->load->model("admin/scheme_model");

        $this->load->model("admin/water_user_association_model");
        $this->lang->load("water_user_associations", 'english');
        $this->lang->load("wua_members", 'english');
        $this->lang->load("schemes", 'english');
        $this->lang->load("system", 'english');
        // $this->load->library('Php_Excel.php');     
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------


    /**
     * Default action to be called
     */
    public function index($financial_year_id = 0)
    {
        ini_set('memory_limit', '1G');
        $financial_year_id = (int) $financial_year_id;

        if ($financial_year_id != 0) {
            $financial_year_id = (int) $financial_year_id;
            $query = "SELECT * FROM financial_years 
                      WHERE financial_year_id=" . $financial_year_id;
            $financial_year = $this->db->query($query)->row();
        } else {
            $query = "SELECT * FROM financial_years WHERE status=1";
            $financial_year = $this->db->query($query)->row();
        }

        $this->data["financial_year"] = $financial_year;
        $filter_date = $this->input->get('date');
        if ($this->input->get('date')) {
            $filter_date = $filter_date;
        } else {
            $filter_date = date('y-m-d');
        }

        $this->data['filter_date'] = $filter_date;

        $filter_month = $this->db->escape(date('m', strtotime($filter_date)));
        $filter_year = $this->db->escape(date('Y', strtotime($filter_date)));

        $query = "SELECT  
    e.*, 
    fy.financial_year, 
    cc.category, 
    cc.category_detail, 
    s.scheme_name,
    s.scheme_code,
    wua.wua_registration_no,
    wua.wua_name,
    d.district_name, 
    d.region  
FROM 
    expenses AS e
INNER JOIN 
    financial_years AS fy ON fy.financial_year_id = e.financial_year_id
INNER JOIN 
    districts AS d ON d.district_id = e.district_id
LEFT JOIN 
    component_categories AS cc ON cc.component_category_id = e.component_category_id
    LEFT JOIN schemes AS s ON(s.scheme_id = e.scheme_id)
    LEFT JOIN water_user_associations as wua on(wua.water_user_association_id = s.water_user_association_id)";

        if ($this->input->get('fy')) {
            if ($this->input->get('fy') == 'fy') {
                $query .= " WHERE e.financial_year_id = $financial_year->financial_year_id";
            }
        } else {
            $query .= " WHERE MONTH(`e`.`date`) = $filter_month AND YEAR(`e`.`date`) = $filter_year ";
        }

        $expenses = $this->db->query($query)->result();
        $this->data["expenses"] = $expenses;

        $query = "SELECT SUM(gross_pay) as gross_pay,
        SUM(whit_tax) as whit_tax,
        SUM(whst_tax) as whst_tax,
        SUM(st_duty_tax) as st_duty_tax,
        SUM(rdp_tax) as rdp_tax,
        SUM(kpra_tax) as kpra_tax,
        SUM(gur_ret) as gur_ret,
        SUM(misc_deduction) as misc_deduction,
        SUM(net_pay) as net_pay
        FROM expenses as e 
        INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
        INNER JOIN districts as d ON(d.district_id = e.district_id) ";
        if ($this->input->get('fy')) {
            if ($this->input->get('fy') == 'fy') {
                $query .= " WHERE e.financial_year_id = $financial_year->financial_year_id";
            }
        } else {
            $query .= " AND MONTH(`e`.`date`) = $filter_month AND YEAR(`e`.`date`) = $filter_year ";
        }
        $expense_summary = $this->db->query($query)->row();
        $this->data["expense_summary"] = $expense_summary;

        $query = "SELECT component_category_id, category FROM `component_categories` where sub_component_id=22;";
        $taxes = $this->db->query($query)->result();
        $tax_paid = array();
        $taxes_ids = array();
        foreach ($taxes as $tax) {
            $taxes_ids[] = $tax->component_category_id;
            $query = "SELECT 
            SUM(net_pay) as net_pay
            FROM expenses as e 
            INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
            INNER JOIN districts as d ON(d.district_id = e.district_id)
            WHERE e.component_category_id= '" . $tax->component_category_id . "' ";

            if ($this->input->get('fy')) {
                if ($this->input->get('fy') == 'fy') {
                    $query .= " AND e.financial_year_id = $financial_year->financial_year_id";
                }
            } else {
                $query .= " AND MONTH(`e`.`date`) = $filter_month AND YEAR(`e`.`date`) = $filter_year ";
            }


            if ($this->db->query($query)->row()->net_pay) {
                $tax_paid[$tax->category] = $this->db->query($query)->row()->net_pay;
            } else {
                $tax_paid[$tax->category] = 0;
            }
        }
        $this->data["taxes_ids"] = $taxes_ids;
        $this->data["tax_paid"] = $tax_paid;
        $this->data["title"] = "Expenses Dashboard";
        $this->data["description"] = "All Expenses List";
        $this->data["view"] = ADMIN_DIR . "expenses/expenses_list";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function expense_form()
    {

        $expense_id = (int) $this->input->post('expense_id');
        if ($expense_id == 0) {
            $expense['voucher_number'] = '';
            $expense['expense_id'] = 0;
            $expense['scheme_id'] = 0;
            $expense['purpose'] = "";
            $expense['category'] = "";
            $expense['district_id'] = 0;
            $expense['component_category_id'] = 0;
            $expense['payee_name'] = "";
            $expense['cheque'] = "";
            $expense['date'] = "";
            $expense['gross_pay'] = 0.00;
            $expense['whit_tax'] = 0.00;
            $expense['whst_tax'] = 0.00;
            $expense['rdp_tax'] = 0.00;
            $expense['kpra_tax'] = 0.00;
            $expense['gur_ret'] = 0.00;
            $expense['st_duty_tax'] = 0.00;
            $expense['misc_deduction'] = 0.00;
            $expense['net_pay'] = 0.00;
            $expense['installment'] = 'N/A';
            //scheme fields are required
            $expense =  (object) $expense;
            $this->data['installments'] = NULL;
            $query = "select cc.*, sc.sub_component_name, c.component_name FROM component_categories as cc
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
        INNER JOIN components as c ON(c.component_id = sc.component_id)
        AND cc.status=1
        
        ORDER BY c.component_id ASC, sc.sub_component_name ASC, cc.category ASC;";
            //AND c.component_id NOT IN(1,2,7)
            $this->data['component_catagories'] = $this->db->query($query)->result();
        } else {
            $query = "SELECT * FROM expenses WHERE expense_id = $expense_id";
            $expense = $this->db->query($query)->row();
            $query = "select cc.*, sc.sub_component_name, c.component_name FROM component_categories as cc
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
        INNER JOIN components as c ON(c.component_id = sc.component_id)
        AND cc.status=1
        ORDER BY c.component_id ASC, sc.sub_component_name ASC, cc.category ASC;";

            $this->data['component_catagories'] = $this->db->query($query)->result();
        }
        $this->data['installments'] = NULL;
        $this->data['expense'] = $expense;
        $this->data['districts'] = $this->db->query('SELECT district_id, district_name, region FROM districts ORDER BY district_name ASC')->result();


        $this->load->view(ADMIN_DIR . "expenses/expense_form", $this->data);
    }


    public function add_expense()
    {
        if ($this->expense_model->validate_form_data() === TRUE) {
            $expense_id = (int) $this->input->post('expense_id');
            if ($expense_id == 0) {
                $expense_id = $this->expense_model->save_data();
            } else {
                $expense_id = $this->expense_model->update_data($expense_id);
            }
            if ($this->input->post("installment") and $this->input->post('scheme_id')) {
                $scheme_id = (int) $this->input->post('scheme_id');
                if ($this->input->post("installment") == '1st') {
                    $status['scheme_status'] = 'ICR-II';
                    if ($this->scheme_model->save($status, $scheme_id)) {
                        $log_inputs['operation'] = 'Payment 1st';
                        $log_inputs['scheme_id'] = $scheme_id;
                        $log_inputs['scheme_status'] = 'ICR-II';
                        $log_inputs['detail'] = 'On 1st Payment Status Change';
                        $log_inputs['remarks'] = 'On 1st Payment Status Change';
                        $log_inputs["created_by"] = $this->session->userdata("userId");
                        $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                        $this->db->insert('scheme_logs', $log_inputs);
                    }
                }
                if ($this->input->post("installment") == '2nd') {
                    $status['scheme_status'] = 'FCR';
                    if ($this->scheme_model->save($status, $scheme_id)) {
                        $log_inputs['operation'] = 'Payment 2nd';
                        $log_inputs['scheme_id'] = $scheme_id;
                        $log_inputs['scheme_status'] = 'FCR';
                        $log_inputs['detail'] = 'On 2nd Payment Status Change';
                        $log_inputs['remarks'] = 'On 2nd Payment Status Change';
                        $log_inputs["created_by"] = $this->session->userdata("userId");
                        $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                        $this->db->insert('scheme_logs', $log_inputs);
                    }
                }
                if ($this->input->post("installment") == '1st_2nd') {
                    $status['scheme_status'] = 'FCR';
                    if ($this->scheme_model->save($status, $scheme_id)) {
                        $log_inputs['operation'] = 'Payment 1st_2nd';
                        $log_inputs['scheme_id'] = $scheme_id;
                        $log_inputs['scheme_status'] = 'FCR';
                        $log_inputs['detail'] = 'On 1st_2nd Payment Status Change';
                        $log_inputs['remarks'] = 'On 1st_2nd Payment Status Change';
                        $log_inputs["created_by"] = $this->session->userdata("userId");
                        $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                        $this->db->insert('scheme_logs', $log_inputs);
                    }
                }
                if ($this->input->post("installment") == 'Final') {
                    $status['scheme_status'] = 'Completed';
                    if ($this->scheme_model->save($status, $scheme_id)) {
                        $log_inputs['operation'] = 'Payment Final';
                        $log_inputs['scheme_id'] = $scheme_id;
                        $log_inputs['scheme_status'] = 'FCR';
                        $log_inputs['detail'] = 'On Final Payment Scheme Complete';
                        $log_inputs['remarks'] = 'On  FinalPayment Scheme Complete';
                        $log_inputs["created_by"] = $this->session->userdata("userId");
                        $log_inputs["last_updated"] = date('Y-m-d H:i:s');
                        $this->db->insert('scheme_logs', $log_inputs);
                    }
                }
            }
            if ($expense_id) {
                echo "success";
            } else {
                echo  "Error While Adding or Updating the record.";
            }
        } else {

            echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
        }
    }

    public function tax_expense_form()
    {


        $expense_id = (int) $this->input->post('expense_id');
        if ($expense_id == 0) {
            $expense['voucher_number'] = '';
            $expense['expense_id'] = 0;
            $expense['scheme_id'] = 0;
            $expense['purpose'] = "Operation Cost";
            $expense['district_id'] = 0;
            $expense['component_category_id'] = 0;
            $expense['payee_name'] = "";
            $expense['cheque'] = "";
            $expense['date'] = "";
            $expense['category'] = "";
            $expense['gross_pay'] = 0.00;
            $expense['whit_tax'] = 0.00;
            $expense['whst_tax'] = 0.00;
            $expense['rdp_tax'] = 0.00;
            $expense['gur_ret'] = 0.00;
            $expense['kpra_tax'] = 0.00;
            $expense['st_duty_tax'] = 0.00;
            $expense['misc_deduction'] = 0.00;
            $expense['net_pay'] = 0.00;
            //scheme fields are required
            $expense =  (object) $expense;
        } else {
            $query = "SELECT * FROM expenses WHERE expense_id = $expense_id";
            $expense = $this->db->query($query)->row();
        }
        $this->data['expense'] = $expense;
        $this->data['districts'] = $this->db->query('SELECT district_id, district_name, region FROM districts')->result();
        // $query = "SELECT cc.component_category_id,
        // cc.category,
        // sc.sub_component_name,
        // s.component_name
        // FROM component_categories as cc
        // INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.component_category_id)
        // INNER JOIN components as s ON(s.component_id = sc.component_id)
        // WHERE s.components_id NOT IN(8)";
        // $this->data['component_catagories'] = $this->db->query($query)->result();

        $this->load->view(ADMIN_DIR . "expenses/tax_expense_form", $this->data);
    }

    public function schemes()
    {
        $scheme_status = 'Ongoing';
        if ($this->input->get('scheme_status')) {
            $scheme_status = $this->input->get('scheme_status');
        }
        //$this->data['s_status'] = $scheme_status;
        $this->data['schemestatus'] = $scheme_status;
        $query = "SELECT * FROM schemes 
        WHERE scheme_status = " . $this->db->escape($scheme_status) . "";
        $schemes = $this->db->query($query)->result();
        $this->data["schemes"] = $schemes;
        $this->data["title"] = "Schemes Dashboard";
        $this->data["description"] = "Schemes List " . "<i>(" . $scheme_status . ")</i>";
        $this->data["view"] = ADMIN_DIR . "expenses/schemes_list";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function view_scheme_detail($scheme_id)
    {

        $scheme_id = (int) $scheme_id;


        $query = "SELECT * FROM schemes WHERE scheme_id = $scheme_id";
        //$scheme = $this->scheme_model->get_scheme($scheme_id)[0];
        $scheme = $this->db->query($query)->row();
        $this->data["scheme"] = $scheme;

        $this->data["water_user_association"] = $this->water_user_association_model->get_water_user_association($scheme->water_user_association_id)[0];
        $this->data["title"] = $scheme->scheme_name . " (" . $scheme->scheme_code . ")";
        $this->data["description"] = $this->data["water_user_association"]->wua_registration_no . " - " . $this->data["water_user_association"]->wua_name;
        $this->data["view"] = ADMIN_DIR . "expenses/view_scheme_detail";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function scheme_expense_form()
    {

        $purpose = $this->input->post('purpose');
        $expense_id = (int) $this->input->post('expense_id');
        $scheme_id = (int) $this->input->post('scheme_id');
        $query = "SELECT * FROM schemes WHERE scheme_id = '" . $scheme_id . "'";
        $scheme = $this->db->query($query)->row();

        if ($expense_id == 0) {
            $expense['voucher_number'] = '';
            $expense['expense_id'] = 0;
            $expense['scheme_id'] = $scheme_id;
            $expense['purpose'] = $purpose;
            $expense['category'] = 'Scheme';
            $expense['project_id'] = $scheme->project_id;
            $expense['district_id'] = $scheme->district_id;
            $expense['component_category_id'] = $scheme->component_category_id;
            $expense['payee_name'] = "";
            $expense['cheque'] = "";
            $expense['date'] = "";
            $expense['gross_pay'] = 0.00;
            $expense['whit_tax'] = 0.00;
            $expense['whst_tax'] = 0.00;
            $expense['rdp_tax'] = 0.00;
            $expense['kpra_tax'] = 0.00;
            $expense['gur_ret'] = 0.00;
            $expense['st_duty_tax'] = 0.00;
            $expense['misc_deduction'] = 0.00;
            $expense['net_pay'] = 0.00;
            $expense['installment'] = "";
            //scheme fields are required
            $expense =  (object) $expense;
        } else {
            $query = "SELECT * FROM expenses WHERE expense_id = $expense_id";
            $expense = $this->db->query($query)->row();
        }
        $this->data['expense'] = $expense;


        $this->data['districts'] = $this->db->query('SELECT district_id, district_name, region FROM districts')->result();
        $query = "SELECT cc.component_category_id,
        cc.category,
        cc.category_detail,
        cc.main_heading,
        sc.sub_component_name,
        s.component_name
        FROM component_categories as cc
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.component_category_id)
        INNER JOIN components as s ON(s.component_id = cc.component_id)";
        $this->data['component_catagories'] = $this->db->query($query)->result();

        $installments['1st'] = '1st';
        $installments['2nd'] = '2nd';
        $installments['1st_2nd'] = '1st_2nd';
        $installments['Final'] = 'Final';
        $this->data['installments'] = $installments;


        $this->load->view(ADMIN_DIR . "expenses/expense_form", $this->data);
    }

    public function scheme_expense_form2()
    {

        $purpose = $this->input->post('purpose');
        $expense_id = (int) $this->input->post('expense_id');
        $scheme_id = (int) $this->input->post('scheme_id');
        $query = "SELECT * FROM schemes WHERE scheme_id = '" . $scheme_id . "'";
        $scheme = $this->db->query($query)->row();
        $this->data['scheme'] = $scheme;
        if ($expense_id == 0) {
            $expense['voucher_number'] = '';
            $expense['expense_id'] = 0;
            $expense['scheme_id'] = $scheme_id;
            $expense['purpose'] = $purpose;
            $expense['category'] = 'Scheme';
            $expense['project_id'] = $scheme->project_id;
            $expense['district_id'] = $scheme->district_id;
            $expense['component_category_id'] = $scheme->component_category_id;
            $expense['payee_name'] = "";
            $expense['cheque'] = "";
            $expense['date'] = "";
            $expense['gross_pay'] = 0.00;
            $expense['whit_tax'] = 0.00;
            $expense['whst_tax'] = 0.00;
            $expense['rdp_tax'] = 0.00;
            $expense['kpra_tax'] = 0.00;

            $expense['st_duty_tax'] = 0.00;
            $expense['gur_ret'] = 0.00;

            $expense['misc_deduction'] = 0.00;
            $expense['net_pay'] = 0.00;
            //scheme fields are required
            $expense =  (object) $expense;
        } else {
            $query = "SELECT * FROM expenses WHERE expense_id = $expense_id";
            $expense = $this->db->query($query)->row();
        }
        $this->data['expense'] = $expense;


        $this->data['districts'] = $this->db->query('SELECT district_id, district_name, region FROM districts')->result();
        $query = "SELECT cc.component_category_id,
        cc.category,
        cc.category_detail,
        cc.main_heading,
        cc.material_share,
        cc.farmer_share,
        sc.sub_component_name,
        s.component_name
        FROM component_categories as cc
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.component_category_id)
        INNER JOIN components as s ON(s.component_id = cc.component_id)
        WHERE cc.component_category_id = $scheme->component_category_id";
        $this->data['component_catagory'] = $this->db->query($query)->row();

        $this->load->view(ADMIN_DIR . "expenses/expense_form2", $this->data);
    }

    public function schemes_data()
    {
        $query = "SELECT * FROM expenses where wus_reg !='' and scheme_name !='' GROUP BY scheme_name ASC";
        $schemes = $this->db->query($query)->result();
        $count = 1;

        foreach ($schemes as $scheme) {
            echo $count++;
            echo "-" . $scheme->wus_reg;
            echo "-" . $scheme->scheme_name;
            echo "<br />";

            $query = "SELECT COUNT(*) as total FROM schemes 
            WHERE wus_reg = '" . $scheme->wus_reg . "'
            AND scheme_name = '" . $scheme->scheme_name . "'";
            $scheme_count = $this->db->query($query)->row()->total;

            if ($scheme_count == 0) {
                $query = "INSERT INTO `schemes` (`district_id`, `category`, `wus_reg`,  `payee_name`, `scheme_name`) 
                              VALUES ('" . $scheme->district_id . "', '" . $scheme->category . "', '" . $scheme->wus_reg . "', '" . $scheme->payee_name . "', '" . $scheme->scheme_name . "')";
                if ($this->db->query($query)) {
                    $scheme_id = $this->db->insert_id();
                }
            } else {
                $query = "SELECT * FROM schemes WHERE scheme_name = '" . $scheme->scheme_name . "'";
                $scheme_id = $this->db->query($query)->row()->scheme_id;
            }

            $query = "UPDATE `expenses` SET `scheme_id`='" . $scheme_id . "' 
            WHERE wus_reg = '" . $scheme->wus_reg . "'
            AND scheme_name = '" . $scheme->scheme_name . "'";
            $this->db->query($query);
        }
    }

    public function wuas()
    {
        $query = "SELECT * FROM schemes GROUP BY wus_reg ASC";
        $wuas = $this->db->query($query)->result();
        $count = 1;

        foreach ($wuas as $wua) {
            echo $count++;
            echo $wua->wus_reg;
            echo $wua->payee_name;
            echo "<br />";
            //insert the WUA in water user association 
            $query = "SELECT COUNT(*) as total FROM water_user_associations 
            WHERE wua_registration_no = '" . $wua->wus_reg . "'";
            $wua_count = $this->db->query($query)->row()->total;

            if ($wua_count == 0) {
                $query = "INSERT INTO `water_user_associations`(`wua_registration_no`, `wua_name`, project_id, district_id) 
                              VALUES ('" . $wua->wus_reg . "', '" . $wua->payee_name . "', '1', '" . $wua->district_id . "')";
                if ($this->db->query($query)) {
                    $water_user_association_id = $this->db->insert_id();
                }
            } else {
                $query = "SELECT * FROM water_user_associations 
                WHERE wua_registration_no = '" . $wua->wus_reg . "'";
                $water_user_association_id = $this->db->query($query)->row()->water_user_association_id;
            }

            $query = "UPDATE `schemes` SET `water_user_association_id`='" . $water_user_association_id . "' 
            WHERE wus_reg = '" . $wua->wus_reg . "'";
            $this->db->query($query);
        }
    }

    public function section_cost()
    {
        $query = "SELECT * FROM schemes";
        $schemes = $this->db->query($query)->result();
        foreach ($schemes as $scheme) {
            $query = "SELECT section_cost FROM expenses 
            WHERE section_cost != ''
            AND scheme_id = '" . $scheme->scheme_id . "'";
            $scheme_cost = $this->db->query($query)->row();
            if ($scheme_cost) {
                $query = "UPDATE `schemes` SET `sanctioned_cost`='" . $scheme_cost->section_cost  . "' 
                          WHERE scheme_id = '" . $scheme->scheme_id . "'";
                $this->db->query($query);
            }
        }
    }

    public function scheme_status()
    {
        $query = "SELECT * FROM schemes";
        $schemes = $this->db->query($query)->result();
        foreach ($schemes as $scheme) {
            $query = "SELECT `status` FROM expenses 
            WHERE `status` = 'Final'
            AND scheme_id = '" . $scheme->scheme_id . "'";
            $staus = $this->db->query($query)->row();
            if ($staus) {
                $query = "UPDATE `schemes` SET `scheme_status`='Completed' 
                          WHERE scheme_id = '" . $scheme->scheme_id . "'";
                $this->db->query($query);
            }
        }
    }

    public function scheme_category()
    {
        $query = "SELECT * FROM schemes";
        $schemes = $this->db->query($query)->result();
        foreach ($schemes as $scheme) {
            $query = "
            SELECT * FROM `component_categories` 
            WHERE `category` = '" . $scheme->category . "'";
            $component_category = $this->db->query($query)->row();
            if ($component_category) {
                $query = "UPDATE `schemes` SET `component_category_id`='" . $component_category->component_category_id . "' 
                          WHERE scheme_id = '" . $scheme->scheme_id . "'";
                $this->db->query($query);
            }
        }
    }

    public function employee_data()
    {
        $query = "SELECT * FROM expenses where category='Remuneration' GROUP BY payee_name ASC";
        $employees = $this->db->query($query)->result();
        $count = 1;

        foreach ($employees as $employee) {
            $payee_name = ucwords(strtolower($employee->payee_name));
            echo $count++;
            echo "-" . $payee_name;
            echo "<br />";

            $query = "SELECT COUNT(*) as total FROM employees 
                WHERE name = '" . $payee_name . "'";
            $employee_count = $this->db->query($query)->row()->total;

            if ($employee_count == 0) {
                $query = "INSERT INTO `employees`(`name`, `designation`, `gross_pay`, `whit_tax`, `whst_tax`, `st_duty_tax`, `rdp_tax`, `kpra_tax`, `misc_deduction`, `net_pay`) 
                VALUES ('" . trim($payee_name) . "', '" . trim($employee->scheme_name) . "', '" . $employee->gross_pay . "', '" . $employee->whit_tax . "', '" . $employee->whst_tax . "', 
                '" . $employee->st_duty_tax . "', '" . $employee->rdp_tax . "', '" . $employee->kpra_tax . "',
                '" . $employee->misc_deduction . "', '" . $employee->net_pay . "')";
                if ($this->db->query($query)) {
                    $employee_id = $this->db->insert_id();
                }
            } else {
                $query = "SELECT * FROM employees WHERE employees.name = '" . $payee_name . "'";
                $employee_id = $this->db->query($query)->row()->employee_id;
            }

            $query = "UPDATE `expenses` SET `employee_id`= '" . $employee_id . "' 
                    WHERE `payee_name` = '" . $employee->payee_name . "'
                    AND category='Remuneration'";
            $this->db->query($query);
        }
    }
    public function salaries($financial_year_id = 0)
    {
        $financial_year_id = (int) $financial_year_id;

        if ($financial_year_id != 0) {
            $financial_year_id = (int) $financial_year_id;
            $query = "SELECT * FROM financial_years 
                      WHERE financial_year_id=" . $financial_year_id;
            $financial_year = $this->db->query($query)->row();
        } else {
            $query = "SELECT * FROM financial_years WHERE status=1";
            $financial_year = $this->db->query($query)->row();
        }

        $this->data["financial_year"] = $financial_year;
        $filter_date = $this->input->get('date');
        if ($this->input->get('date')) {
            $filter_date = $filter_date;
        } else {
            $filter_date = date('y-m-d');
        }

        $this->data['filter_date'] = $filter_date;

        $filter_month = $this->db->escape(date('m', strtotime($filter_date)));
        $filter_year = $this->db->escape(date('Y', strtotime($filter_date)));

        $query = "SELECT e.*,fy.financial_year, d.district_name, d.region  FROM expenses as e 
        INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
        INNER JOIN districts as d ON(d.district_id = e.district_id)
        WHERE MONTH(`e`.`date`) = $filter_month
        AND YEAR(`e`.`date`) = $filter_year
        AND category = 'Remuneration'";
        $expenses = $this->db->query($query)->result();
        $this->data["expenses"] = $expenses;

        $query = "SELECT SUM(gross_pay) as gross_pay,
        SUM(whit_tax) as whit_tax,
        SUM(whst_tax) as whst_tax,
        SUM(st_duty_tax) as st_duty_tax,
        SUM(rdp_tax) as rdp_tax,
        SUM(kpra_tax) as kpra_tax,
        SUM(misc_deduction) as misc_deduction,
        SUM(net_pay) as net_pay
        FROM expenses as e 
        INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
        INNER JOIN districts as d ON(d.district_id = e.district_id)
        WHERE MONTH(`e`.`date`) = $filter_month
        AND YEAR(`e`.`date`) = $filter_year";
        $expense_summary = $this->db->query($query)->row();
        $this->data["expense_summary"] = $expense_summary;

        $taxes = array('WHIT', 'WHST', 'St. Duty', 'RDP', 'KPRA', 'MISC.DEDU');
        $tax_paid = array();
        foreach ($taxes as $tax) {
            $query = "SELECT 
            SUM(net_pay) as net_pay
            FROM expenses as e 
            INNER JOIN financial_years as fy ON(fy.financial_year_id = e.financial_year_id)
            INNER JOIN districts as d ON(d.district_id = e.district_id)
            WHERE e.category = '" . $tax . "'
            AND MONTH(`e`.`date`) = $filter_month
            AND YEAR(`e`.`date`) = $filter_year";
            if ($this->db->query($query)->row()->net_pay) {
                $tax_paid[$tax] = $this->db->query($query)->row()->net_pay;
            } else {
                $tax_paid[$tax] = 0;
            }
        }
        $this->data["tax_paid"] = $tax_paid;
        $this->data["title"] = "Salaries Expenses Dashboard";
        $this->data["description"] = "Salaries Expenses";
        $this->data["view"] = ADMIN_DIR . "expenses/salaries_list";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function salaries_expense_form()
    {

        $expense_id = (int) $this->input->post('expense_id');
        if ($expense_id == 0) {
            $expense['voucher_number'] = '';
            $expense['expense_id'] = 0;
            $expense['scheme_id'] = 0;
            $expense['purpose'] = "Operation Cost";
            $expense['district_id'] = 0;
            $expense['component_category_id'] = 0;
            $expense['payee_name'] = "";
            $expense['cheque'] = "";
            $expense['date'] = "";
            $expense['category'] = "";
            $expense['gross_pay'] = 0.00;
            $expense['whit_tax'] = 0.00;
            $expense['whst_tax'] = 0.00;
            $expense['rdp_tax'] = 0.00;
            $expense['st_duty_tax'] = 0.00;
            $expense['kpra_tax'] = 0.00;
            $expense['misc_deduction'] = 0.00;
            $expense['net_pay'] = 0.00;
            //scheme fields are required
            $expense =  (object) $expense;
        } else {
            $query = "SELECT * FROM expenses WHERE expense_id = $expense_id";
            $expense = $this->db->query($query)->row();
        }
        $this->data['expense'] = $expense;
        $this->data['districts'] = $this->db->query('SELECT district_id, district_name, region FROM districts')->result();
        $query = "SELECT cc.component_category_id,
        cc.category,
        sc.sub_component_name,
        s.component_name
        FROM component_categories as cc
        INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.component_category_id)
        INNER JOIN components as s ON(s.component_id = cc.component_id)";
        $this->data['component_catagories'] = $this->db->query($query)->result();

        $this->load->view(ADMIN_DIR . "expenses/salaries_expense_form", $this->data);
    }

    public function add_monthly_salaries()
    {


        $employees_salaries = $this->input->post('employees');

        $check_error_list = NULL;
        foreach ($employees_salaries as $employee_id => $salary_detail) {
            $cheque = (int) $salary_detail['cheque'];
            $query = "SELECT count(cheque) as total FROM expenses WHERE cheque = '" . $cheque . "'";
            $check_count = $this->db->query($query)->row()->total;
            if ($check_count > 0) {
                $check_error_list .= 'Cheque No. <strong>' . $cheque . '</strong> has already been used. <br />';
            }
        }
        if ($check_error_list) {
            echo $check_error_list;
        } else {
            foreach ($employees_salaries as $employee_id => $salary_detail) {
                $_POST['employee_id'] = (int) $employee_id;
                $_POST['voucher_number'] = $salary_detail['voucher_number'];
                $_POST['payee_name'] = $salary_detail['payee_name'];
                $_POST['cheque'] = $salary_detail['cheque'];
                $_POST['date'] = $salary_detail['date'];
                $_POST['gross_pay'] = $salary_detail['gross_pay'];
                $_POST['whit_tax'] = $salary_detail['whit_tax'];
                $_POST['whst_tax'] = $salary_detail['whst_tax'];
                $_POST['st_duty_tax'] = $salary_detail['st_duty_tax'];
                $_POST['rdp_tax'] = $salary_detail['rdp_tax'];
                $_POST['kpra_tax'] = $salary_detail['kpra_tax'];
                $_POST['misc_deduction'] = $salary_detail['misc_deduction'];
                $_POST['net_pay'] = $salary_detail['net_pay'];

                if ($this->expense_model->validate_form_data() === TRUE) {
                    $expense_id = $this->expense_model->save_data();
                } else {

                    echo '<div class="alert alert-danger"> ' . validation_errors() . "<div>";
                }
            }

            if ($expense_id) {
                echo "success";
            } else {
                echo  "Error While Adding or Updating the record.";
            }
        }
    }

    public function delete_expense_record($expense_id)
    {
        $expense_id = (int) $expense_id;
        $this->db->where("expense_id", $expense_id);
        $this->db->delete("expenses");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }

    public function fetch_data()
    {
        $columns = array('scheme_name', 'category'); // Define columns to search
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $search = $this->input->post('search')['value'];

        $this->db->select('*');
        $this->db->from('schemes');

        // Searching
        if (!empty($search)) {
            $this->db->group_start();
            foreach ($columns as $column) {
                $this->db->or_like($column, $search);
            }
            $this->db->group_end();
        }

        // Ordering
        $this->db->order_by($order, $dir);

        // Pagination
        $this->db->limit($limit, $start);

        $query = $this->db->get();
        $data = $query->result();

        // Total records count
        $total_records = $this->db->count_all_results('schemes');

        $output = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        );

        echo json_encode($output);
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


        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        $search = $this->db->escape("%" . $this->input->post("search")["value"], "%");
        // Manual SQL query building
        $scheme_status = $this->db->escape($this->input->post('scheme_status'));
        $sql = "SELECT * FROM scheme_lists WHERE scheme_status = $scheme_status ";



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
            $sql .= " ORDER BY $order $dir";
        }

        // Pagination
        if ($limit != -1) {
            $sql .= " LIMIT $limit OFFSET $start";
        }

        $query = $this->db->query($sql);
        $data = $query->result();

        // Total records count
        $total_records = $this->db->query("SELECT COUNT(*) as count FROM scheme_lists WHERE scheme_status = $scheme_status ")->row()->count;

        $output = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        );

        echo json_encode($output);
    }


    public function get_vendor_taxe_form()
    {
        $id = (int) $this->input->post("id");
        if ($id == 0) {

            $input = $this->get_vendor_tax_inputs();
        } else {
            $query = "SELECT * FROM 
            vendors_taxes 
            WHERE id = $id";
            $input = $this->db->query($query)->row();
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "expenses/get_vendor_invoice_form", $this->data);
    }


    private function get_vendor_tax_inputs()
    {
        $input["id"] = $this->input->post("id");
        $input["scheme_id"] = $this->input->post("scheme_id");
        $input["vendor_id"] = $this->input->post("vendor_id");
        $input["voucher_id"] = $this->input->post("voucher_id");
        $input["invoice_id"] = $this->input->post("invoice_id");
        $input["invoice_date"] = $this->input->post("invoice_date");
        $input["nature_of_payment"] = $this->input->post("nature_of_payment");
        $input["payment_section_code"] = $this->input->post("payment_section_code");
        $input["invoice_gross_total"] = $this->input->post("invoice_gross_total");
        // $input["whit_tax"] = $this->input->post("whit_tax") ?? 0;
        // $input["whst_tax"] = $this->input->post("whst_tax") ?? 0;
        // $input["st_charged"] = $this->input->post("st_charged") ?? 0;
        // $input["st_duty_tax"] = $this->input->post("st_duty_tax") ?? 0;
        // $input["kpra_tax"] = $this->input->post("kpra_tax") ?? 0;
        // $input["rdp_tax"] = $this->input->post("rdp_tax") ?? 0;
        // $input["total_deduction"] = $this->input->post("total_deduction") ?? 0;
        // $input["misc_deduction"] = $this->input->post("misc_deduction") ?? 0;

        if ($this->input->post("whit_tax") !== null) {
            $input["whit_tax"] = $this->input->post("whit_tax");
        } else {
            $input["whit_tax"] = 0;
        }

        if ($this->input->post("whst_tax") !== null) {
            $input["whst_tax"] = $this->input->post("whst_tax");
        } else {
            $input["whst_tax"] = 0;
        }

        if ($this->input->post("st_charged") !== null) {
            $input["st_charged"] = $this->input->post("st_charged");
        } else {
            $input["st_charged"] = 0;
        }

        if ($this->input->post("st_duty_tax") !== null) {
            $input["st_duty_tax"] = $this->input->post("st_duty_tax");
        } else {
            $input["st_duty_tax"] = 0;
        }

        if ($this->input->post("kpra_tax") !== null) {
            $input["kpra_tax"] = $this->input->post("kpra_tax");
        } else {
            $input["kpra_tax"] = 0;
        }

        if ($this->input->post("rdp_tax") !== null) {
            $input["rdp_tax"] = $this->input->post("rdp_tax");
        } else {
            $input["rdp_tax"] = 0;
        }

        if ($this->input->post("total_deduction") !== null) {
            $input["total_deduction"] = $this->input->post("total_deduction");
        } else {
            $input["total_deduction"] = 0;
        }

        if ($this->input->post("misc_deduction") !== null) {
            $input["misc_deduction"] = $this->input->post("misc_deduction");
        } else {
            $input["misc_deduction"] = 0;
        }

        $inputs =  (object) $input;
        return $inputs;
    }

    public function add_vendor_invoice()
    {
        //$this->form_validation->set_rules("scheme_id", "Scheme Id", "required");
        $this->form_validation->set_rules("vendor_id", "Vendor Id", "required");
        $this->form_validation->set_rules("voucher_id", "Voucher Id", "required");
        $this->form_validation->set_rules("invoice_id", "Invoice Id", "required");
        $this->form_validation->set_rules("invoice_date", "Invoice Date", "required");
        $this->form_validation->set_rules("nature_of_payment", "Nature Of Payment", "required");
        $this->form_validation->set_rules("payment_section_code", "Payment Section Code", "required");
        $this->form_validation->set_rules("invoice_gross_total", "Invoice Gross Total", "required");
        $this->form_validation->set_rules("whit_tax", "Whit Tax", "required");
        $this->form_validation->set_rules("st_charged", "ST Charged", "required");
        $this->form_validation->set_rules("whst_tax", "Whst Tax", "required");
        $this->form_validation->set_rules("st_duty_tax", "St Duty Tax", "required");
        $this->form_validation->set_rules("kpra_tax", "Kpra Tax", "required");
        $this->form_validation->set_rules("rdp_tax", "Rdp Tax", "required");
        $this->form_validation->set_rules("total_deduction", "Total Deduction", "required");
        $this->form_validation->set_rules("misc_deduction", "Misc Deduction", "required");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {
            $inputs = $this->get_vendor_tax_inputs();
            $inputs->created_by = $this->session->userdata("userId");
            $id = (int) $this->input->post("id");
            if ($id == 0) {
                $this->db->insert("vendors_taxes", $inputs);
            } else {
                $this->db->where("id", $id);
                $inputs->last_updated = date('Y-m-d H:i:s');
                $this->db->update("vendors_taxes", $inputs);
            }
            echo "success";
        }
    }


    public function delete_vendors_invoice($id)
    {
        $id = (int) $id;
        $this->db->where("id", $id);
        $this->db->delete("vendors_taxes");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }

    // public function export_all_expense_data()
    // {
    //         $query = "SELECT  
    //         e.*, 
    //         fy.financial_year, 
    //         cc.category, 
    //         cc.category_detail, 
    //         s.scheme_name,
    //         s.scheme_code,
    //         wua.wua_registration_no,
    //         wua.wua_name,
    //         d.district_name, 
    //         d.region  
    //         FROM 
    //             expenses AS e
    //         INNER JOIN 
    //             financial_years AS fy ON fy.financial_year_id = e.financial_year_id
    //         INNER JOIN 
    //             districts AS d ON d.district_id = e.district_id
    //         LEFT JOIN 
    //             component_categories AS cc ON cc.component_category_id = e.component_category_id
    //             LEFT JOIN schemes AS s ON(s.scheme_id = e.scheme_id)
    //             LEFT JOIN water_user_associations as wua on(wua.water_user_association_id = s.water_user_association_id)";


    //             $expenses = $this->db->query($query)->result();

    //             $objPHPExcel = new PHPExcel();
    //             $objPHPExcel->setActiveSheetIndex(0);
    //             // set Header
    //             $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'S:NO');
    //             $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Employee Name.');   
    //             // set Row
    //             $rowCount = 2;
    //             $serial_counter=1;
    //             foreach ($expenses as $val) 
    //             {
    //                 $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $serial_counter);
    //                 $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val->region);

    //                 $rowCount++;
    //                 $serial_counter++;
    //             }

    //         $file_name="abde".time();
    //             header('Content-Type: application/vnd.ms-excel'); //mime type
    //             header('Content-Disposition: attachment;filename="'.$file_name.'"'); //tell browser what's the file name
    //             header('Cache-Control: max-age=0'); //no cache
    //             $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
    //             $objWriter->save('php://output'); 
    //  }



    public function search_expenses()
    {
        $search = $this->input->post('search');
        $search_param = "%{$search}%";  // Adding wildcards for LIKE search

        $query = "SELECT  
    e.*, 
    fy.financial_year, 
    cc.category, 
    cc.category_detail, 
    s.scheme_name,
    s.scheme_code,
    wua.wua_registration_no,
    wua.wua_name,
    d.district_name, 
    d.region  
FROM 
    expenses AS e
INNER JOIN 
    financial_years AS fy ON fy.financial_year_id = e.financial_year_id
INNER JOIN 
    districts AS d ON d.district_id = e.district_id
LEFT JOIN 
    component_categories AS cc ON cc.component_category_id = e.component_category_id
LEFT JOIN 
    schemes AS s ON s.scheme_id = e.scheme_id
LEFT JOIN 
    water_user_associations AS wua ON wua.water_user_association_id = s.water_user_association_id
WHERE 
    e.cheque = ? OR e.payee_name LIKE ? LIMIT 100";

        $expenses = $this->db->query($query, [$search, $search_param])->result();
        $this->data["expenses"] = $expenses;
        $this->load->view(ADMIN_DIR . "expenses/expense_search_list", $this->data);
    }


    public function get_district_by_region()
    {
        $regions = $this->input->post('region'); // Expecting an array of regions
        if (!is_array($regions)) {
            $regions = [$regions]; // Ensure it's an array
        }

        // Escape and prepare the placeholders for the IN clause
        $placeholders = implode(',', array_fill(0, count($regions), '?'));
        $query = "SELECT d.district_id, d.district_name 
              FROM districts as d 
              WHERE d.region IN ($placeholders)";

        $districts = $this->db->query($query, $regions)->result();
        echo json_encode($districts);
    }

    public function get_sub_components_by_component()
    {
        $components = $this->input->post('components'); // Expecting an array of regions
        if (!is_array($components)) {
            $components = [$components]; // Ensure it's an array
        }

        // Escape and prepare the placeholders for the IN clause
        $placeholders = implode(',', array_fill(0, count($components), '?'));
        $query = "SELECT sc.sub_component_id, sc.sub_component_name 
              FROM sub_components as sc
              WHERE sc.component_id IN ($placeholders)";

        $sub_compoments = $this->db->query($query, $components)->result();
        echo json_encode($sub_compoments);
    }

    public function get_component_categories_by_sub_component()
    {
        $sub_components = $this->input->post('sub_components'); // Expecting an array of regions
        if (!is_array($sub_components)) {
            $sub_components = [$sub_components]; // Ensure it's an array
        }

        // Escape and prepare the placeholders for the IN clause
        $placeholders = implode(',', array_fill(0, count($sub_components), '?'));
        $query = "SELECT c.component_category_id, c.category 
              FROM component_categories as c
              WHERE c.sub_component_id IN ($placeholders)";

        $component_categories = $this->db->query($query, $sub_components)->result();
        echo json_encode($component_categories);
    }

    // public function filter_expenses()
    // {
    //     // $component_id = $this->input->post('components');
    //     // if (!is_array($component_id)) {
    //     //     $component_id = [$component_id];
    //     // }

    //     // $sub_component_id = $this->input->post('sub_components');
    //     // if (!is_array($sub_component_id)) {
    //     //     $sub_component_id = [$sub_component_id];
    //     // }


    //     $query = "SELECT  
    //     e.*, 
    //     fy.financial_year, 
    //     cc.category, 
    //     cc.category_detail, 
    //     s.scheme_name,
    //     s.scheme_code,
    //     wua.wua_registration_no,
    //     wua.wua_name,
    //     d.district_name, 
    //     d.region  
    //     FROM 
    //     expenses AS e
    //     INNER JOIN financial_years AS fy ON fy.financial_year_id = e.financial_year_id
    //     INNER JOIN districts AS d ON d.district_id = e.district_id
    //     LEFT JOIN  component_categories AS cc ON cc.component_category_id = e.component_category_id
    //     LEFT JOIN schemes AS s ON(s.scheme_id = e.scheme_id)
    //     LEFT JOIN water_user_associations as wua on(wua.water_user_association_id = s.water_user_association_id)
    //     WHERE 1=1 ";

    //     if ($this->input->post('financial_year_ids')) {
    //         $financial_year_id = $this->input->post('financial_year_ids');
    //         if (!is_array($financial_year_id)) {
    //             $financial_year_id = [$financial_year_id];
    //         }
    //         $placeholders = implode(',', array_fill(0, count($financial_year_id), '?'));
    //         $query .= " AND e.financial_year_id IN ($placeholders)";
    //     }

    //     $query .= " LIMIT 10 ";

    //     $expenses = $this->db->query($query)->result();
    //     echo json_encode($expenses);
    //     exit();
    //     $this->data["expenses"] = $expenses;
    // }

    public function filter_expenses()
    {
        // Build the base query
        $query = "
    SELECT  
        e.*,
        DATE_FORMAT(e.date, '%e %b, %Y') as date,
        fy.financial_year, 
        cc.category, 
        cc.category_detail, 
        sc.sub_component_name,
        c.component_name,
        s.scheme_name,
        s.scheme_code,
        s.sanctioned_cost,
        wua.wua_registration_no,
        wua.wua_name,
        d.district_name, 
        d.region,
        ((whit_tax+whst_tax+st_duty_tax+rdp_tax+kpra_tax+gur_ret+misc_deduction+net_pay)-gross_pay) as reconcilation,
        (whit_tax+whst_tax+st_duty_tax+rdp_tax+kpra_tax+gur_ret+misc_deduction) as taxable,
        IF(s.sanctioned_cost > 0, ROUND((gross_pay * 100) / s.sanctioned_cost, 2), 0) AS paid_percentage
    FROM 
        expenses AS e
    INNER JOIN financial_years AS fy ON fy.financial_year_id = e.financial_year_id
    INNER JOIN districts AS d ON d.district_id = e.district_id
    LEFT JOIN component_categories AS cc ON cc.component_category_id = e.component_category_id
    INNER JOIN sub_components as sc ON(sc.sub_component_id = cc.sub_component_id)
    INNER JOIN components as c ON(c.component_id = sc.component_id)
    LEFT JOIN schemes AS s ON s.scheme_id = e.scheme_id
    LEFT JOIN water_user_associations AS wua ON wua.water_user_association_id = s.water_user_association_id
    WHERE 1=1
    ";

        $params = [];

        // Helper function to handle filter inputs and SQL placeholders
        $addFilter = function ($field, $inputKey, &$query, &$params) {
            $values = $this->input->post($inputKey);
            if ($values) {
                if (!is_array($values)) {
                    $values = [$values];
                }
                $placeholders = implode(',', array_fill(0, count($values), '?'));
                $query .= " AND $field IN ($placeholders)";
                $params = array_merge($params, $values);
            }
        };

        // Add filters dynamically
        $addFilter('e.financial_year_id', 'financial_year_ids', $query, $params);
        $addFilter('e.district_id', 'district_ids', $query, $params);
        $addFilter('d.region', 'regions', $query, $params);
        $addFilter('e.purpose', 'purposes', $query, $params);
        $addFilter('e.component_category_id', 'component_category_ids', $query, $params);
        $addFilter('cc.sub_component_id', 'sub_component_ids', $query, $params);
        $addFilter('sc.component_id', 'component_ids', $query, $params);

        // Add date range filters
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        if ($start_date && !$end_date) {
            $query .= " AND DATE(e.date) >= ?";
            $params[] = $start_date;
        } elseif (!$start_date && $end_date) {
            $query .= " AND DATE(e.date) <= ?";
            $params[] = $end_date;
        } elseif ($start_date && $end_date) {
            $query .= " AND DATE(e.date) BETWEEN ? AND ?";
            $params[] = $start_date;
            $params[] = $end_date;
        }

        // Add a LIMIT clause for pagination or performance optimization
        //$query .= " LIMIT 100";

        try {
            // Execute the query with parameters to avoid SQL injection
            $expenses = $this->db->query($query, $params)->result();

            // Return JSON response
            echo json_encode([
                'success' => true,
                'data' => $expenses
            ]);
        } catch (Exception $e) {
            // Handle query errors
            echo json_encode([
                'success' => false,
                'message' => 'Error fetching expenses. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
        exit();
    }

    public function filter_scheme_search()
    {
        $search = trim($this->input->post('search', true)); // Trim and XSS filtering for input
        $search_param = "%{$search}%";

        // Start buffering output
        ob_start();



        $query = "
        SELECT 
            schemes.scheme_id,
            schemes.scheme_name,
            schemes.scheme_code,
            schemes.scheme_status,
            wua.wua_name,
            wua.wua_registration_no,
            fy.financial_year,
            d.district_name,
            sc.category
        FROM schemes
        INNER JOIN districts AS d ON d.district_id = schemes.district_id
        INNER JOIN water_user_associations AS wua ON wua.water_user_association_id = schemes.water_user_association_id
        INNER JOIN financial_years AS fy ON fy.financial_year_id = schemes.financial_year_id
        INNER JOIN component_categories AS sc ON sc.component_category_id = schemes.component_category_id
        WHERE (schemes.scheme_name LIKE ? 
        OR schemes.scheme_code LIKE ? 
        OR wua.wua_name LIKE ? 
        OR wua.wua_registration_no LIKE ? )";

        $params = [$search_param, $search_param, $search_param, $search_param];

        // Helper function for dynamic filtering
        $addFilter = function ($field, $inputKey, &$query, &$params) {
            $values = $this->input->post($inputKey);
            if ($values) {
                if (!is_array($values)) {
                    $values = [$values];
                }
                $placeholders = implode(',', array_fill(0, count($values), '?'));
                $query .= " AND $field IN ($placeholders)";
                $params = array_merge($params, $values);
            }
        };

        $addFilter('schemes.district_id', 'district_ids', $query, $params);
        $addFilter('schemes.component_category_id', 'component_category_ids', $query, $params);

        $query .= " LIMIT 20"; // Limiting to top 20 records for performance

        $schemes = $this->db->query($query, $params)->result();

        echo '<small>Search Result (Top ' . count($schemes) . ' Records)</small>
            <table class="table table-bordered table-striped table_small">
            <thead>
            <tr>
                <th>#</th>
                <th>Scheme Name</th>
                <th>Scheme Code</th>
                <th>WUA Name</th>
                <th>WUA Code</th>
                <th>FY</th>
                <th>District</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>';

        if ($schemes) {
            $count = 1;
            foreach ($schemes as $scheme) {
                echo '<tr>
                <td>' . $count++ . '</td>
                <td>' . htmlspecialchars($scheme->scheme_name, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($scheme->scheme_code, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($scheme->wua_name, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($scheme->wua_registration_no, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($scheme->financial_year, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($scheme->district_name, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($scheme->category, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($scheme->scheme_status, ENT_QUOTES, 'UTF-8') . '</td>
                <td><a target="_blank" href="' . site_url(ADMIN_DIR . "expenses/view_scheme_detail/" . $scheme->scheme_id) . '">View Detail</a></td>
            </tr>';
            }
        } else {
            echo '<tr><td colspan="10">No records found</td></tr>';
        }

        echo '</tbody>
         </table>';

        // End buffering and output the content
        $output = ob_get_clean();
        echo $output;
    }


    public function print_scheme_detail($scheme_id)
    {

        $scheme_id = (int) $scheme_id;
        $this->data["scheme_id"] = $scheme_id;

        $this->load->view(ADMIN_DIR . "expenses/print_scheme_detail", $this->data);
    }

    public function print_cheque()
    {
        $this->load->view(ADMIN_DIR . "expenses/print_cheque", $this->data);
    }
}
