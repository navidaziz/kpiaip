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
        // Load the DB utility class
        $this->load->dbutil();

        // Set backup preferences
        $prefs = array(
            'database' => $this->db->database, // database name
            'format'      => 'txt',      // backup file format - txt or gzip (CI gzips it internally)
            'filename'    => 'backup.sql', // used only with gzip
            'add_drop'    => TRUE,       // add DROP TABLE statements
            'add_insert'  => TRUE,       // add INSERT data
            'newline'     => "\n",       // newline format
            'foreign_key_checks' => FALSE,
        );

        // Generate the backup
        $backup = $this->dbutil->backup($prefs);

        // Gzip it
        $gz_data = gzencode($backup, 9);

        // Set file name
        $filename = 'db_backup_' . date('Y-m-d_H-i-s') . '.sql.gz';

        // Force download
        header('Content-Type: application/x-gzip');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($gz_data));
        echo $gz_data;
        exit;
    }
}
