<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        // $this->load->library('tank_auth');
        $this->load->library('AdminLib');
    }

    function index() {
		// die;
		// redirect('School/HM_Dashboard');
		redirect('ml/Home/');
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */