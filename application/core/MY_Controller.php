<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
}

class MY_Auth extends CI_Controller {

    function __construct() {
        parent::__construct();

        // $this->load->model('Publics');

        /** session checking */
        $this->load->library('tank_auth');
        if (!$this->tank_auth->is_logged_in()) {
            // echo '<pre>';print_r($this->session->userdata());die;
            if($this->session->userdata('user_type')!=5){
                    if ($this->input->is_ajax_request()) {
//                        $status = "stat:307";
//                        echo $status;
//                        return;
                    }
                // redirect('auth/login');
            }else if($this->session->userdata('user_type')==5 && $this->session->userdata('status')!=1){
                    if ($this->input->is_ajax_request()) {
//                        $status = "stat:307";
//                        echo $status;
//                        return;
                    }
                // redirect('auth/login');
            }
        }
        /** session checking */

        //List Menu Items
        $left['menu'] = $this->General->getdata('cp_menu');
        $left['submenu'] = $this->General->getdata('cp_submenu');

        //Set Home Page Template
        $this->template->set_master_template('home/template');

        //Get News Items
        $left['news'] = $this->General->getdata('cp_news', '*', '', 'priority');

        //Set Regions Default
        $this->template->write_view('header', 'home/header');
        $this->template->write_view('left_panel', 'home/left_panel', $left);
    }

}
class MY_Home extends MY_Controller {

    function __construct() {
        parent::__construct();

        // $this->load->model('Publics');

        /** session checking */
        
        /** session checking */

        //List Menu Items
        $left['menu'] = $this->General->getdata('cp_menu');
        $left['submenu'] = $this->General->getdata('cp_submenu');

        //Set Home Page Template
        $this->template->set_master_template('home/template');

        //Get News Items
        $left['news'] = $this->General->getdata('cp_news', '*', '', 'priority');

        //Set Regions Default
        $this->template->write_view('header', 'home/header');
        $this->template->write_view('left_panel', 'home/left_panel', $left);
    }

}

class MY_User extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        
        /** session checking */

        $this->load->model('General');
        $this->load->library('AdminLib');
        $this->load->library('encryption');
        $this->encryption->initialize(
                    array(
                        'cipher' => 'aes-256',
                        'mode' => 'ctr',
                        'key' => 'fixation'
                    )
            );
        $this->encryption->initialize(array('driver' => 'mcrypt'));
        $data['offices'] = $this->General->getdata('master_offices','*',array('office_id>'=>'1000'));
        $data['officeSettingsMenuPermission']=0;
        $permit_desig=array($this->adminlib->get_deo_id(),$this->adminlib->get_dde_id(),$this->adminlib->get_aeo_id(),$this->adminlib->get_sco_id(),$this->adminlib->get_dge_id(),$this->adminlib->get_jd_id(),$this->adminlib->get_unit_officer_id(),$this->adminlib->get_pa_full_addition_id(),$this->adminlib->get_ss_full_addition_id(),$this->adminlib->get_aeo_full_addition_id());
        if (in_array($this->session->userdata('designation_id'), $permit_desig)) {
           $data['officeSettingsMenuPermission']=1;
        }
        $switch_data = array();
        $switch_data['other_accounts'] = $this->General->getdata('full_addition_service_history','id,master_office_id,office_id,office_block_id,role_id',array('user_id'=>$this->session->userdata('user_id'),'is_active'=>1,'is_delete'=>0));
        //Set Regions Default

        $this->template->write_view('sidebar', 'secured_user/default/sidebar');
    }

}

class School_User extends  MY_Controller {

    function __construct() {
        parent::__construct();
       
//        if($this->session->userdata('user_type')!=5 && $this->session->userdata('status')==1){
//            redirect('auth/login');
//        }
        
        /** session checking */
     
        if(!check_user()){
            redirect('auth/login');
        }
        $this->template->write_view('header', 'School/default/header');
        $this->template->write_view('menu', 'School/default/menu');
    }

}

class School_Common extends  MY_Controller {

    function __construct() {
        parent::__construct();
       
        // if($this->session->userdata('user_type')!=5 && $this->session->userdata('status')==1){
        // if (!$this->tank_auth->is_logged_in() ) {
        if(!$this->session->userdata('status')){
            redirect('auth/login');
        }
        
        /** session checking */
        /*
        if(!check_user()){
            redirect('auth/login');
        }*/
        $this->template->write_view('header', 'School/default/header');
        $this->template->write_view('menu', 'School/default/menu');
    }

}

class Common_User extends  MY_Controller {
    function __construct() {
        parent::__construct();
        /** session checking */
       
        
        /** session checking */
        /*
        if(!check_user()){
            redirect('auth/login');
        }*/
        
        $this->load->library('encryption');
        $this->encryption->initialize(
                    array(
                        'cipher' => 'aes-256',
                        'mode' => 'ctr',
                        'key' => 'fixation'
                    )
            );
        $this->encryption->initialize(array('driver' => 'mcrypt'));
        $this->load->library('AdminLib');
        $data['officeSettingsMenuPermission']=0;
        $permit_desig=array($this->adminlib->get_deo_id(),$this->adminlib->get_dde_id(),$this->adminlib->get_aeo_id(),$this->adminlib->get_suprd_id(),$this->adminlib->get_dge_id(),$this->adminlib->get_jd_id(),$this->adminlib->get_unit_officer_id(),$this->adminlib->get_pa_full_addition_id(),$this->adminlib->get_ss_full_addition_id(),$this->adminlib->get_aeo_full_addition_id());
        if (in_array($this->session->userdata('designation_id'), $permit_desig)) {
           $data['officeSettingsMenuPermission']=1;
        }
        if(check_user()==5){
            $this->template->write_view('header', 'School/default/header');
            $this->template->write_view('menu', 'School/default/menu');
        }else{
                $this->load->model('General');
                $data['offices'] = $this->General->getdata('master_offices','*',array('office_id>'=>'1000'));

            //Set Regions Default
            $this->template->write_view('header', 'secured_user/default/header');
            $this->template->write_view('menu', 'secured_user/default/menu', $data);
            $this->template->write_view('sidebar', 'secured_user/default/sidebar');
        }
    }
}
?>

