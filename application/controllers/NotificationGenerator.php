<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class NotificationGenerator extends MY_Auth{

    function __construct() {
        parent::__construct();
        $this->load->library('tank_auth');
        $this->load->library('AdminLib');
        $this->load->library('itschool_rbac');
        $this->load->model('General','GM');
        $this->load->model('DraftNotesModel','DM');
        $this->load->model('NotificationsModel','NM');
    }
    function index(){
        $date = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime($date . ' +1 day'));
        $yesterday = date('Y-m-d', strtotime($date . ' -1 day'));
        $day_after_tomorrow = date('Y-m-d', strtotime($date . ' +2 day'));
        $week_after_tomorrow = date('Y-m-d', strtotime($date . ' +7 day'));
        $days = array($tomorrow,$day_after_tomorrow,$week_after_tomorrow);
        $is_exist = $this->General->is_record_exists('notification_recipients','created_at ="'.$date.'"');
        if($is_exist == 0){
            $this->db->trans_start();
            $this->General->delete('notification_recipients',array('created_at'=>$yesterday));
            $this->NM->generateHearingNotification($days,REQ_TYPE_APL);//SF Appeal
            $this->NM->generateHearingNotification($days,REQ_TYPE_APL_AA);//AA Appeal
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                // $data['error']=1;
                // $data['msg'] = 'Error while Saving.!';
                echo 'Error';
            }else{
                // $data['success']=1;
                // $data['msg'] = 'Saved Successfully!';
                echo 'Success';
            }
        }else{
            echo 'Already updated';
        }
    }


}
 



?>