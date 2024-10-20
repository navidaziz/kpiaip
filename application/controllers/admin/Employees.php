<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employees extends Admin_Controller
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

        $this->data["title"] = 'KP-IAIP Employees';
        $this->data["description"] = 'Employees Dashboard';
        $this->data["view"] = ADMIN_DIR . "employees/employees_dashboard";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }


    public function get_employee_form()
    {
        $employee_id = (int) $this->input->post("employee_id");
        if ($employee_id == 0) {
            $input["employee_id"] = $this->input->post("employee_id");
            $input["name"] = $this->input->post("name");
            $input["father_name"] = $this->input->post("father_name");
            $input["gender"] = $this->input->post("gender");
            $input["cnic"] = $this->input->post("cnic");
            $input["personal_no"] = $this->input->post("personal_no");
            $input["mobile_no"] = $this->input->post("mobile_no");
            $input["employee_type"] = $this->input->post("employee_type");
            $input["designation"] = $this->input->post("designation");
            $input["basi_pay_scale"] = $this->input->post("basi_pay_scale");
            $input["joining_date"] = $this->input->post("joining_date");
            $input["leaved_date"] = $this->input->post("leaved_date");
            $input["gross_pay"] = $this->input->post("gross_pay");
            $input["whit_tax"] = $this->input->post("whit_tax");
            $input["whst_tax"] = $this->input->post("whst_tax");
            $input["st_duty_tax"] = $this->input->post("st_duty_tax");
            $input["rdp_tax"] = $this->input->post("rdp_tax");
            $input["kpra_tax"] = $this->input->post("kpra_tax");
            $input["misc_deduction"] = $this->input->post("misc_deduction");
            $input["net_pay"] = $this->input->post("net_pay");

            $input =  (object) $input;
        } else {
            $query = "SELECT * FROM 
            employees 
            WHERE employee_id = $employee_id";
            $input = $this->db->query($query)->row();
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "employees/get_employee_form", $this->data);
    }
    public function add_employee()
    {
        $this->form_validation->set_rules("name", "Name", "required");
        $this->form_validation->set_rules("father_name", "Father Name", "required");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("cnic", "Cnic", "required");
        $this->form_validation->set_rules("personal_no", "Personal No", "required");
        $this->form_validation->set_rules("mobile_no", "Mobile No", "required");
        $this->form_validation->set_rules("employee_type", "Employee Type", "required");
        $this->form_validation->set_rules("designation", "Designation", "required");
        $this->form_validation->set_rules("basi_pay_scale", "Basi Pay Scale", "required");
        $this->form_validation->set_rules("joining_date", "Joining Date", "required");
        //$this->form_validation->set_rules("leaved_date", "Leaved Date", "required");
        $this->form_validation->set_rules("gross_pay", "Gross Paid", "required");
        $this->form_validation->set_rules("whit_tax", "Whit Tax", "required");
        $this->form_validation->set_rules("whst_tax", "Whst Tax", "required");
        $this->form_validation->set_rules("st_duty_tax", "St Duty Tax", "required");
        $this->form_validation->set_rules("rdp_tax", "Rdp Tax", "required");
        $this->form_validation->set_rules("kpra_tax", "Kpra Tax", "required");
        $this->form_validation->set_rules("misc_deduction", "Misc Deduction", "required");
        $this->form_validation->set_rules("net_pay", "Net Paid", "required");

        if ($this->form_validation->run() == FALSE) {
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        } else {
            $inputs = array(
                "name" => $this->input->post("name"),
                "father_name" => $this->input->post("father_name"),
                "gender" => $this->input->post("gender"),
                "cnic" => $this->input->post("cnic"),
                "personal_no" => $this->input->post("personal_no"),
                "mobile_no" => $this->input->post("mobile_no"),
                "employee_type" => $this->input->post("employee_type"),
                "designation" => $this->input->post("designation"),
                "basi_pay_scale" => $this->input->post("basi_pay_scale"),
                "joining_date" => $this->input->post("joining_date"),
                "gross_pay" => $this->input->post("gross_pay"),
                "whit_tax" => $this->input->post("whit_tax"),
                "whst_tax" => $this->input->post("whst_tax"),
                "st_duty_tax" => $this->input->post("st_duty_tax"),
                "rdp_tax" => $this->input->post("rdp_tax"),
                "kpra_tax" => $this->input->post("kpra_tax"),
                "misc_deduction" => $this->input->post("misc_deduction"),
                "net_pay" => $this->input->post("net_pay"),
            );
            
            
            $inputs["created_by"] = $this->session->userdata("userId");
            $employee_id = (int) $this->input->post("employee_id");
            if ($employee_id == 0) {
                $this->db->insert("employees", $inputs);
            } else {
                if($this->input->post("status") == 0){
                 $inputs["leaved_date"] = $this->input->post("leaved_date");
                 $inputs["status"] = 0;
                }else{
                    $inputs["leaved_date"] = '';
                    $inputs["status"] = 1; 
                }
                $this->db->where("employee_id", $employee_id);
                $inputs["last_updated"] = date('Y-m-d H:i:s');
                $this->db->update("employees", $inputs);
            }
            echo "success";
        }
    }
    public function delete_employee($employee_id)
    {
        $employee_id = (int) $employee_id;
        $this->db->where("employee_id", $employee_id);
        $this->db->delete("employees");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }
}
