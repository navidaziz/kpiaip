<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "/third_party/phpexcel/PHPExcel.php";
class Php_Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
?>