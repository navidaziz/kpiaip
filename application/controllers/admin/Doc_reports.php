<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Doc_reports extends Admin_Controller
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

        $this->data["title"] = "Analysis Reports";
        $this->data["view"] = ADMIN_DIR . "doc_reports/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function get_doc_report_form()
    {
        $id = (int) $this->input->post("id");
        if ($id == 0) {

            $input = $this->get_inputs();
        } else {
            $query = "SELECT * FROM 
        doc_reports 
        WHERE id = $id";
            $input = $this->db->query($query)->row();
        }
        $this->data["input"] = $input;
        $this->load->view(ADMIN_DIR . "doc_reports/get_doc_report_form", $this->data);
    }

    private function get_inputs()
    {
        $input["id"] = $this->input->post("id");
        $input["source"] = $this->input->post("source");
        $input["type"] = $this->input->post("type");
        $input["title"] = $this->input->post("title");
        $input["detail"] = $this->input->post("detail");
        $input["attachment"] = $this->input->post("attachment");
        $input["date"] = $this->input->post("date");
        $inputs =  (object) $input;
        return $inputs;
    }

    public function add_doc_report()
    {
        // Set form validation rules
        $this->form_validation->set_rules("source", "Source", "required");
        $this->form_validation->set_rules("type", "Type", "required");
        $this->form_validation->set_rules("title", "Title", "required");
        $this->form_validation->set_rules("detail", "Detail", "required");
        //$this->form_validation->set_rules('attachment', 'Attachment', 'required|callback_pdf_check');
        $this->form_validation->set_rules("date", "Date", "required");

        // Run the form validation
        if ($this->form_validation->run() === FALSE) {
            // If validation fails, return the errors
            echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
            exit();
        }


        // Prepare the data for insertion/update
        $inputs = $this->get_inputs();  // Assuming get_inputs() returns an object or array with data
        // Add created_by field from session data
        $inputs->created_by  = $this->session->userdata("userId");


        // File upload configuration
        $config = array(
            "upload_path" => "./assets/uploads/" . $this->router->fetch_class() . "/",
            "allowed_types" => "pdf",
            "max_size" => 10000,  // Max file size in KB
            "max_width" => 0,  // No width restriction
            "max_height" => 0,  // No height restriction
            "remove_spaces" => true,
            "encrypt_name" => true
        );

        // Set upload path and create directory if it does not exist
        $dir = $config["upload_path"];
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);  // Use true to allow recursive directory creation
        }

        // Load the upload library
        $this->load->library("upload", $config);
        // Get the ID from POST (0 for new, existing ID for update)
        $id = (int) $this->input->post("id");

        if ($id == 0) {
            if (!empty($_FILES['attachment']['name'])) {
                if (!$this->upload->do_upload('attachment')) {
                    // If upload fails, show errors
                    echo $this->upload->display_errors();
                    exit();
                } else {
                    $upload_data = $this->upload->data();
                    $inputs->attachment = $dir . $upload_data['file_name'];
                }
            } else {
                echo "PDF File Required";
                exit();
            }
            // Insert new record if ID is 0
            $this->db->insert("doc_reports", $inputs);
        } else {
            //var_dump($_FILES['attachment']['size']);
            //exit();

            if ($_FILES['attachment']['size']) {


                if (!$this->upload->do_upload('attachment')) {
                    // If upload fails, show errors
                    echo $this->upload->display_errors();
                    exit();
                } else {
                    $upload_data = $this->upload->data();
                    $inputs->attachment = $dir . $upload_data['file_name'];
                    $query = "SELECT * FROM doc_reports WHERE id = ?";
                    $doc_report = $this->db->query($query, array($id))->row();
                    $file_path = FCPATH . $doc_report->attachment; // FCPATH is the full server path to the root of the CodeIgniter project

                    // Check if the file exists and then delete it
                    if (file_exists($file_path)) {
                        unlink($file_path); // Delete the file
                    } else {
                        echo "File does not exist.";
                    }
                }
            } else {
                unset($inputs->attachment);
            }


            // Update existing record if ID is non-zero
            $inputs->last_updated = date('Y-m-d H:i:s');  // Set the last updated timestamp
            $this->db->where("id", $id);  // Specify the record to update
            $this->db->update("doc_reports", $inputs);
        }

        // Return success response
        echo "success";
    }

    public function delete_doc_reports($id)
    {
        $id = (int) $id;
        $query = "SELECT * FROM doc_reports WHERE id = ?";
        $doc_report = $this->db->query($query, array($id))->row();
        $file_path = FCPATH . $doc_report->attachment; // FCPATH is the full server path to the root of the CodeIgniter project

        // Check if the file exists and then delete it
        if (file_exists($file_path)) {
            unlink($file_path); // Delete the file
        }
        $this->db->where("id", $id);
        $this->db->delete("doc_reports");
        $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($requested_url);
    }
}
