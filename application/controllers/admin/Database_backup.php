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
        $backupDir = APPPATH . 'backups/';
        $backups = [];

        if (is_dir($backupDir)) {
            $files = scandir($backupDir, SCANDIR_SORT_DESCENDING);
            foreach ($files as $file) {
                if (preg_match('/\.sql$/', $file)) {
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



    public function backup()
    {
        // Load the database utility class
        $this->load->dbutil();

        // Create a backup (as a zip containing an .sql file)
        $prefs = array(
            'format'      => 'zip',
            'filename'    => 'db_backup_' . date('Y-m-d_H-i-s') . '.sql'
        );

        $backup = $this->dbutil->backup($prefs);

        // Backup directory (application path, not web-accessible)
        $backupDir = APPPATH . 'backups/';
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        // Full file path
        $backupFile = $backupDir . 'db_backup_' . date('Y-m-d_H-i-s') . '.zip';

        // Load helper and write file
        $this->load->helper('file');
        if (write_file($backupFile, $backup)) {
            $this->session->set_flashdata('success', 'Backup created successfully: ' . basename($backupFile));
        } else {
            $this->session->set_flashdata('error', 'Failed to write backup file.');
        }

        // Redirect after backup
        redirect('admin/database_backup');
    }



    // Optional: List all backups
    public function list_backups()
    {
        $backupDir = APPPATH . 'backups/';
        $backups = [];

        if (is_dir($backupDir)) {
            $files = scandir($backupDir, SCANDIR_SORT_DESCENDING);
            foreach ($files as $file) {
                if (preg_match('/\.sql$/', $file)) {
                    $backups[] = [
                        'name' => $file,
                        'size' => filesize($backupDir . $file),
                        'date' => date("F d Y H:i:s", filemtime($backupDir . $file))
                    ];
                }
            }
        }

        $data['backups'] = $backups;
        $this->load->view('admin/backup_list', $data);
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
            redirect('databasebackup/list_backups');
        }
    }
}
