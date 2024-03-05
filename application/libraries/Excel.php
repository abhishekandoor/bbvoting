<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 //include_once "vendor/phpoffice/phpexcel/Classes/PHPExcel.php";
require_once APPPATH . "/third_party/Classes/PHPExcel.php";
class Excel extends PHPExcel {

    public function __construct() {
        parent::__construct();
    }

}
