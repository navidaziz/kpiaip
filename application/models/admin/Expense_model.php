<?php if (!defined('BASEPATH')) exit('Direct access not allowed!');

class Expense_model extends MY_Model
{

    public function __construct()
    {

        parent::__construct();
        $this->table = "expenses";
        $this->pk = "expense_id";
        $this->status = "status";
        $this->order = "order";
    }

    public function validate_form_data()
    {


        $expense_id = (int) $this->input->post('expense_id');
        $cheque = (int) $this->input->post('cheque');
        $query = $this->db->where('cheque', $cheque)
            ->where('expense_id !=', $expense_id)
            ->get('expenses');
        if ($query->num_rows() > 0) {
            //$query->num_rows();
            echo "Cheque number has already been used. Please attempt the transaction again with a different cheque number.";
            exit();
        }


        $validation_config = array(

            array(
                "field"  =>  "voucher_number",
                "label"  =>  "Voucher Number",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "district_id",
                "label"  =>  "District",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "purpose",
                "label"  =>  "Purpose",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "district_id",
                "label"  =>  "District",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "component_category_id",
                "label"  =>  "Component Category",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "payee_name",
                "label"  =>  "Payee Name",
                "rules"  =>  "required"
            ),



            array(
                "field"  =>  "date",
                "label"  =>  "date",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "gross_pay",
                "label"  =>  "Gross Pay",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "gross_pay",
                "label"  =>  "Gross Pay",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "whit_tax",
                "label"  =>  "WHIT Tax",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "whst_tax",
                "label"  =>  "WHST Tax",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "st_duty_tax",
                "label"  =>  "ST. Duty Tax",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "kpra_tax",
                "label"  =>  "KPRA Tax",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "rdp_tax",
                "label"  =>  "RDP Tax",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "gur_ret",
                "label"  =>  "Retention Money Guarantee",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "misc_deduction",
                "label"  =>  "Misc.Dedu. Tax",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "net_pay",
                "label"  =>  "Met Pay",
                "rules"  =>  "required"
            ),
            array(
                "field"  =>  "cheque",
                "label"  =>  "Cheque",
                "rules"  =>  "required"
            )

        );



        //set and run the validation
        $this->form_validation->set_rules($validation_config);
        return $this->form_validation->run();
    }

    public function save_data($image_field = NULL)
    {


        $inputs = $this->inputs();

        return $this->expense_model->save($inputs);
    }

    public function update_data($sub_component_id, $image_field = NULL)
    {
        $inputs = $this->inputs();

        return $this->expense_model->save($inputs, $sub_component_id);
    }

    private function inputs()
    {
        $inputs = array();
        $inputs["voucher_number"]  =  $this->input->post("voucher_number");
        $inputs["expense_id"]  =  $this->input->post("expense_id");
        $inputs["purpose"]  =  $this->input->post("purpose");
        $inputs["district_id"]  =  $this->input->post("district_id");
        $inputs["component_category_id"]  = $component_category_id =  $this->input->post("component_category_id");
        // $query = "SELECT * FROM component_categories 
        //           WHERE component_category_id = '" . $component_category_id . "'";
        // $component = $this->db->query($query)->row();

        // $inputs["project_id"]  =  $component->project_id;
        // $inputs["component_id"]  =  $component->component_id;
        // $inputs["sub_component_id"]  =  $component->sub_component_id;
        if ($this->input->post("scheme_id")) {
            $inputs["scheme_id"]  = $this->input->post("scheme_id");
            $inputs["category"]  = 'Scheme';
        } else {
            $inputs["scheme_id"]  = 0;
            $inputs["category"]  = $this->input->post("category");
        }

        $inputs["date"]  =  $this->input->post("date");
        $date = $this->db->escape($this->input->post("date"));
        //get date by session.....
        $query = "SELECT financial_year_id
        FROM financial_years
        WHERE " . $date . " BETWEEN start_date AND end_date;";
        $finacial_year = $this->db->query($query)->row();
        if ($finacial_year) {
            $inputs["financial_year_id"] = $finacial_year->financial_year_id;
        } else {
            $inputs["financial_year_id"]  = 0;
        }

        $inputs["payee_name"]  =  $this->input->post("payee_name");
        $inputs["cheque"]  =  $this->input->post("cheque");
        $inputs["employee_id"]  =  $this->input->post("employee_id");
        $inputs["gross_pay"]  =  $this->input->post("gross_pay");
        $inputs["whit_tax"]  =  $this->input->post("whit_tax");
        $inputs["whst_tax"]  =  $this->input->post("whst_tax");
        $inputs["rdp_tax"]  =  $this->input->post("rdp_tax");
        $inputs["st_duty_tax"]  =  $this->input->post("st_duty_tax");
        $inputs["kpra_tax"]  =  $this->input->post("kpra_tax");
        $inputs["gur_ret"]  =  $this->input->post("gur_ret");
        $inputs["misc_deduction"]  =  $this->input->post("misc_deduction");
        $inputs["net_pay"]  =  $this->input->post("net_pay");
        $inputs["created_by"] = $this->session->userdata("userId");
        $inputs["last_updated"] = date('Y-m-d H:i:s');

        return $inputs;
    }
}