<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Home {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('tank_auth');
        $this->load->library('AdminLib');
        
    }

    function index() {
        // echo 'jjj'; die;
		// die;
		// redirect('School/HM_Dashboard');
		redirect('ml/Home/');
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */