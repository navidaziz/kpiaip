<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends Admin_Controller
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




        $this->data["title"] = 'Backup';
        $this->data["description"] = 'Database Backup';
        $this->data["view"] = ADMIN_DIR . "backup/backup_index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }


    public function backup_gz()
    {
        // Load DB utility
        $this->load->dbutil();

        // Base config for new DB connection
        $new_db_config = array(
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'chitralcom_kpiaip',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => TRUE,
            'cache_on' => FALSE,
            'cachedir' => '',
            'swap_pre' => '',
            'encrypt'  => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );

        // Load specific DB connection
        $specific_db = $this->load->database($new_db_config, TRUE);

        // Load dbutil for the specific DB
        $this->load->dbutil();
        $this->dbutil->db = $specific_db;

        // Backup preferences
        $prefs = array(
            'format'             => 'txt',
            'add_drop'           => TRUE,
            'add_insert'         => TRUE,
            'newline'            => "\n",
            'foreign_key_checks' => FALSE
        );

        // Generate backup
        $backup = $this->dbutil->backup($prefs);

        // Gzip it
        $gz_data = gzencode($backup, 9);

        // File name
        $filename = $db_name . '_backup_' . date('Y-m-d_H-i-s') . '.sql.gz';

        // Force download
        header('Content-Type: application/x-gzip');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($gz_data));
        echo $gz_data;
        exit;
    }
}
