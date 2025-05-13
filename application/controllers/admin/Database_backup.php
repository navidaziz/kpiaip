<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Database_backup extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Restrict access to authorized users only
        $this->load->library('session');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }


    public function index()
    {
        echo $backupDir = APPPATH . 'backups/';
        $backups = [];

        if (is_dir($backupDir)) {
            $files = scandir($backupDir, SCANDIR_SORT_DESCENDING);
            var_dump($files);
            foreach ($files as $file) {
                if (preg_match('/\.gz$/', $file)) {
                    $backups[] = [
                        'name' => $file,
                        'size' => filesize($backupDir . $file),
                        'date' => date("F d Y H:i:s", filemtime($backupDir . $file))
                    ];
                }
            }
        }

        $this->data['backups'] = $backups;
        $this->data["title"] = 'Advices';
        $this->data["description"] = 'Advices Dashboard';
        //$this->data["view"] = ADMIN_DIR . "databaes_backup/backup_list";
        $this->data["view"] = ADMIN_DIR . "databaes_backup/backup_list";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }


    // Optional: Download backup
    public function download($filename)
    {
        $backupDir = APPPATH . 'backups/';
        $filepath = $backupDir . $filename;

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        } else {
            $this->session->set_flashdata('error', 'File not found');
            redirect('databasebackup/database_backup');
        }
    }
}
