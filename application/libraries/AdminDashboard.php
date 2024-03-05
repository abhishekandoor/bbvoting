<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminDashboard {
	
	  
      function __construct() {
        $this->ci = & get_instance();
        $this->load->model('AdminDashboard_Model', 'ADM'); 
        $this->error = array();
      }
      function getStateWideAppointmentApprovalDetails(){
		  
		     $districtList  =  $this->ADM->getDistrictList();
		     return $districtList;
      }
}
?>
