<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/mpdf/mpdf.php";

class M_pdf extends mPDF {

    public function __construct() {
        $this->ci = & get_instance();
    }
}
