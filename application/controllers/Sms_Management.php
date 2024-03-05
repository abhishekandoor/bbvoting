<?php

/**
 * controller for general repeated functions
 */
class Sms_Management extends MY_User {
    function __construct() {
        parent::__construct();
        //load models
        $this->load->library('tank_auth');
        $this->load->library('AdminLib');
        $this->load->library('itschool_rbac');
        $this->lang->load('tank_auth');
        $this->load->model('General');
        $this->load->model('CommonModel','CM');
        $this->load->model('tank_auth/login_attempts','LA');//added for loging IP
    }

    function sendMessageBySMS(){
        $master_sms_id        = $this->input->post('master_sms_id');
        $phone                = $this->input->post('phone');
        $user_id              = $this->input->post('user_id');
        if($master_sms_id == FORGOT_SMS_TYPE){
            if(isSampoornaUser()){
                $data   = array("status" => "not_active", "message"=> "Failed ");
                echo json_encode($data);
                return;
            }
        }
        $result = $this->adminlib->sendMessageBySMS($master_sms_id,$phone,$user_id);
        return $result;
    }

}