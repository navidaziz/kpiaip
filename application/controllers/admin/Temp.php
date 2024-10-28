<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Temp extends Admin_Controller
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

    public function search_cheques(){
            $scheme_id = (int) $this->input->post('scheme_id');
            $query="SELECT * FROM schemes as s WHERE s.scheme_id = ?";
            $scheme = $this->db->query($query, $scheme_id)->row();
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
            (e.cheque = ? OR e.payee_name LIKE ? OR e.schemeName LIKE ? ) 
            AND e.district_id = ".$scheme->district_id."
            AND e.component_category_id = ".$scheme->component_category_id."
            LIMIT 200";


            $expenses = $this->db->query($query, [$search, $search_param, $search_param])->result();
            $this->data["expenses"] = $expenses;
            $this->data["scheme_id"] = $scheme_id;
            $this->data["scheme"] = $scheme;
            
            $this->load->view(ADMIN_DIR . "temp/expense_search_list", $this->data);
        }



        public function change_cheque_scheme()  {
                $expense_id = (int) $this->input->post('expense_id');
                $query="SELECT *, s.scheme_name,
                s.scheme_code, cc.category, d.district_name FROM expenses as e 
                INNER JOIN component_categories as cc ON (cc.component_category_id = e.component_category_id)
                INNER JOIN districts as d ON(d.district_id = e.district_id)
                LEFT JOIN 
                schemes AS s ON s.scheme_id = e.scheme_id
                WHERE e.expense_id = ?";
                $this->data['expense'] = $cheque =  $this->db->query($query,[$expense_id])->row();
                $scheme_id = (int) $this->input->post('scheme_id');
                 $query="SELECT s.*, cc.category, d.district_name,
                 wua.wua_name,
                 wua.cm_name
                 FROM schemes as s 
                 INNER JOIN component_categories as cc ON (cc.component_category_id = s.component_category_id)
                 INNER JOIN districts as d ON(d.district_id = s.district_id)
                 INNER JOIN water_user_associations as wua ON(wua.water_user_association_id = s.water_user_association_id)
                 WHERE s.scheme_id = ?";
                $this->data['scheme'] = $this->db->query($query, $scheme_id)->row();
                $wua_id = (int) $this->input->post('wua_id');

                
                $this->load->view(ADMIN_DIR . "temp/change_cheque_scheme", $this->data);
  } 

   public function  update_cheque_scheme()
    {
        $scheme_id = (int) $this->input->post('scheme_id');
        $expense_id = (int) $this->input->post('expense_id');
        $installment = $this->input->post('installment');
        $remarks = $this->input->post('remarks');
        $data = array(
            'scheme_id' => $scheme_id,
            'installment' => $installment,
            'remarks' => $remarks,
            'last_updated' => $remarks,
            'updated_by' =>  $this->session->userdata("userId"),
            'last_updated' => date('Y-m-d H:i:s')
        );
        $this->db->where('expense_id', $expense_id);
        if ($this->db->update('expenses', $data)) {
        echo "success";
        } else {
        echo  '<div class="alert alert-danger">Error while updating the record.<div>';
        }

    }

     public function  remove_cheque_scheme()
    {
        
        $scheme_id = (int) $this->input->post('scheme_id');
        $scheme_data = array(
            'scheme_status' => 'Par-Completed',
            'updated_by' =>  $this->session->userdata("userId"),
            'last_updated' => date('Y-m-d H:i:s')
        );
        $this->db->where('scheme_id', $scheme_id);
        $this->db->update('schemes', $scheme_data);

        $expense_id = (int) $this->input->post('expense_id');
        $data = array(
            'scheme_id' => NULl,
            'updated_by' =>  $this->session->userdata("userId"),
            'last_updated' => date('Y-m-d H:i:s')
        );
        $this->db->where('expense_id', $expense_id);
        if ($this->db->update('expenses', $data)) {
        echo "success";
        } else {
        echo  '<div class="alert alert-danger">Error while updating the record.<div>';
        }

    }

    public function add_scheme_note(){
         $scheme_id = (int) $this->input->post('scheme_id');
         $this->db->where('scheme_id', $scheme_id);
         $input['scheme_note'] = $this->input->post('scheme_note');
         if($this->db->update('schemes', $input)){
            echo 'scheme note update';
         }else{
            echo 'Error while updating';
         }


    }


    }