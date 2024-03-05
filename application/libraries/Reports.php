<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports {

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('Reports_Model', 'rm');
      // $this->error = array();
    }
    function getList($district_id,$educationtional_district,$schoolmanagement,$applicantName) {
	      $dataList = 1;
	   
	     return $dataList;
	
	//	return  $this->rm->getList($district_id,$educationtional_district,$schoolmanagement,$applicantName);
    }
 }
 ?>
