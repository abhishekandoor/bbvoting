<?php
// die;
define("APPEAL_INVALID_ENTRY_QN_ID", 14);
define("APPEAL_CLERK_QN_TIMEFRAME", 12);
define("APPEAL_CLERK_QN_PURPOSE", 13);
// ITADMIN ids - change these values when id's of itadmin changes
define("ITADMIN_USER_ID", 1);
define("ITADMIN_USER_GROUP_ID", 1);
// ITADMIN ids ends
define("FORGOT_PASS_SMS_OTP",' is your Samanwaya OTP, please login with this code and reset your password. DO NOT share this OTP with anyone.');//Forgot password otp message via sms
define("SMS_OTP_LIMIT",3);//forgot password sms LIMIT
define("FORGOT_SMS_TYPE",1);//forgot password sms type
define("APL_HEARING_SMS_TYPE",2);//appeal hearing sms type
define("REV_HEARING_SMS_TYPE",3);//review hearing sms type
define("GET_REMARKS_SMS_TYPE",4);//review hearing sms type
define("GET_AUDIT_SMS_TYPE",5);//review hearing sms type
define("GET_IOC_SMS_TYPE",6);//IOC message sms type
define("AUDIT_REQ_SMS_TYPE",7);//audit request sms type

// file active types
define("ACTIVE_BY_INITIAL", 0);
define("ACTIVE_BY_APPEAL", 1);
define("ACTIVE_BY_REVIEW", 2);
define("ACTIVE_BY_MODIFICATIONS", 3);
define("ACTIVE_BY_AUDIT", 4);

// file reopen types
define("RE_OPEN_BY_APPEAL", 1);
define("RE_OPEN_BY_REVIEW", 2);
define("RE_OPEN_BY_MODIFICATIONS", 3);
define("RE_OPEN_BY_AUDIT", 4);


// office id's
define("DEO_OFFICE", 1006);
define("AEO_OFFICE", 1007);
define("DDE_OFFICE", 1002);
define("DGE_OFFICE", 1001);
define("ADMIN_OFFICE", 1013);
define("ITADMIN_OFFICE", 1000);
define("MANAGER_OFFICE", 1012);
define("SUPER_CHECK_OFFICE", 1014);
define("LAW_OFFICE", 1015);
define("SEC_OFFICE", 1016);
define("HSE_OFFICE", 1017);
define("VHSE_OFFICE", 1018);

define("REQ_TYPE_AA", 1);// Appointment Approval Request Type
define("REQ_TYPE_SF", 2);// Staff Fixation Request Type
define("REQ_TYPE_APL", 3);// SF Appeal Request Type
define("REQ_TYPE_REV", 4);// SF Review Request Type
define("REQ_TYPE_APL_AA", 5);// AA Appeal Request Type
define("REQ_TYPE_AUD", 6);// AA Audit Request Type
define("REQ_TYPE_PA", 7);// Personal Audit Request Type
define("REQ_TYPE_TBANK", 8);// Personal Audit Request Type
define("REQ_TYPE_ADDL_POST_PROPOSAL", 9);// IOC Request Type
define("REQ_TYPE_SENIORTY_LIST",30 );// Seniority Rank List Request Type

define("REQ_TYPE_MODIFICATION", 15);// SF Modification Request Type

define("REQ_TYPE_APL_REMARK", 10);// Appeal remarks Request Type
define("REQ_TYPE_REV_REMARK", 11);// Review remarks Request Type
define("REQ_TYPE_REAPL_REMARK_AEO_DEO", 12);// Revision Appeal remarks in AEO/DEO Request Type
define("REQ_TYPE_REAPL_REMARK_DDE", 13);// Revision Appeal remarks in DDE Request Type

define("REQ_TYPE_REAPL_REMARK_H_SECTION", 17);// Review remarks in H Section Request Type
define("REQ_TYPE_REAPL_REMARK_SUPERCHECKCELL", 18);// Review remarks in Super check cell Request Type
define("REQ_TYPE_REAPL_REMARK_LAW_OFFICE", 19);// Review remarks in Law Office Request Type
define("REQ_TYPE_COMMUNICATION", 20);// Communication Request Type
define("REQ_TYPE_AUDIT_REMARK", 25);// DDE Audit remarks Request Type in AEO/DEO
define("REQ_TYPE_GOV_REMARK", 26);// Govt remarks Request Type in AEO/DEO
define("REQ_TYPE_TBANK_REMARK", 27);// Teachers bank Request Type in AEO/DEO

define("REQ_TYPE_ADDLPOST_REMARK", 28);// Teachers bank Request Type in AEO/DEO

// define("REVISION_APPEAL_TYPE", 18);//Revision Appeal remarks request type in super check cell
// define("APPEAL_REMARK_TYPE", 10);//Appeal remarks request type
// define("REVIEW_REMARK_TYPE", 11);//Review remarks request type
// define("REV_APPL_H_BLOCK",17);
define("REV_APPL_ATTACHMENT_TYPE_H", 10);

// office block id's
define("NO_BLOCK", 0);
define("RA_BLOCK", 1);
define("H_BLOCK", 2);
define("F_BLOCK", 4); 
define("G_BLOCK", 3);
define("EC_BLOCK", 5);
define("ET_BLOCK", 6);
define("EM_BLOCK", 7);
define("AUDIT_BLOCK", 8);
define("TAPAL_BLOCK", 9);       
define("AUDIT_BLOCK_DGE", 10);
define("TAPAL_BLOCK_SEC", 11);
define("M_BLOCK", 12);
define("E_BLOCK", 13);

define("REVISION_APPEAL_ATTACHMENT_TYPE", 7);

define("APPEAL_ATTACHMENT_TYPE", 4);

define("HEARING_LETTER_TYPE", 4);

define("APPT_NATURE_DAILY_WAGES", 4);

define("APL_MODULE_SF", 1);
define("APL_MODULE_AA", 2);

define("APL_PROCESSING_OFFICE_DEO", 1);
define("APL_PROCESSING_OFFICE_DDE", 2);
define("APL_PROCESSING_OFFICE_DGE", 3);
define("APL_PROCESSING_OFFICE_GOVT", 4);

define("REV_APL_OFFICE_DGE", 1);
define("REV_APL_OFFICE_GOVT", 2);
// draft template types
define("DRAFT_TYPE_BLANK", 1);
define("DRAFT_TYPE_LETTER", 2);
define("DRAFT_TYPE_BLANK_PROCEEDINGS", 3);
define("DRAFT_TYPE_HEARING_LETTER", 4);
define("DRAFT_TYPE_PROCEEDINGS_AA_APPROVE", 5);
define("DRAFT_TYPE_PROCEEDINGS_AA_REJECT", 6);

//OUTWARD_TYPE

define("OUTWARD_TYPE_SMS", 1);
define("OUTWARD_TYPE_MAIL", 2);
define("OUTWARD_TYPE_FILE_DOWNLOAD", 3);


/*USER GROUP*/
define("AEO_USER_GROUP", 107);
define("DEO_USER_GROUP", 106);
define("DDE_USER_GROUP", 105);

define('PROCEEDING_HEAD', '<!DOCTYPE definition [
        <!ENTITY zwnj "&#8204;">
        <!ENTITY zwj "&#8205;">
        <!ENTITY nbsp "&#160;">
        ]>');

//D-Sign Constants
define("APPLICATION_NAME", "samanwaya");
define("DSIGN_EMAIL","samanwaya@kite.kerala.gov.in");

define("TAG_IMAGE",'<image src="'.base_url()."assets/images/label_small.png".'" style="height:15px;"></image>');

define('DSG_TICK','https://samanwaya.kite.kerala.gov.in/assets/images/green_tick_dsg.jpg');
// define("DSIGN_PASS","samanwaya@2020");
// define("DSIGN_URL","https://127.0.0.1/dsign/api/nicd-sign/");

// define("DSIGN_PASS","samanwaya@2021");
// define("DSIGN_URL","https://api.kite.kerala.gov.in/nicd-sign/");


////////////////////////// SITE SETTINGS //////////////////////////
function isSampoornnaEnabled(){
    $CI = & get_instance();
    return $CI->config->item('SAMPOORNNA_LOGIN_ENABLED');
}

function isApptApplicationResubmitEnabled(){
    $CI = & get_instance();
    return $CI->config->item('AA_APPLICATION_RESUBMIT_ENABLED');
}

function isSFAppealApplicationEnabled(){
    $CI = & get_instance();
    return $CI->config->item('APPEAL_SF_APPLICATION_ENABLED');
}

function isSFReAppealApplicationEnabled(){
    $CI = & get_instance();
    return $CI->config->item('RE_APPEAL_SF_APPLICATION_ENABLED');
}

function isSFReAppealOnlyEnabled(){
    $CI = & get_instance();
    return $CI->config->item('APPEAL_SF_RE_APPEAL_ONLY');
}

function isApptAppealApplicationEnabled(){
    $CI = & get_instance();
    return $CI->config->item('APPEAL_AA_APPLICATION_ENABLED');
}

function isApptReAppealApplicationEnabled(){
    $CI = & get_instance();
    return $CI->config->item('RE_APPEAL_AA_APPLICATION_ENABLED');
}

function isApptReAppealOnlyEnabled(){
    $CI = & get_instance();
    return $CI->config->item('APPEAL_AA_RE_APPEAL_ONLY');
}

function isSFAppealEnabledInOffice(){
    $CI = & get_instance();
    return $CI->config->item('SF_APPEAL_ENABLED_OFFICE');
}

function isApptAppealEnabledInOffice(){
    $CI = & get_instance();
    return $CI->config->item('AA_APPEAL_ENABLED_OFFICE');
}

function isCaptchaEnabled(){
    $CI = & get_instance();
    return $CI->config->item('CAPTCHA_LOGIN_ENABLED');
}

function isAuditEnabled(){
    $CI = & get_instance();
    return $CI->config->item('AUDIT_ENABLED');
}

function isPersonalAuditEnabled(){
    $CI = & get_instance();
    return $CI->config->item('PERSONAL_AUDIT_ENABLED');
}

function isLiabilityRefixEnabled(){
    $CI = & get_instance();
    return $CI->config->item('LIABILITY_REFIX_ENABLED');
}

function isIOCEnabled(){
    $CI = & get_instance();
    return $CI->config->item('IOC_ENABLED');
}

function isForcePwdChangeEnabledOnResetPwd(){
    $CI = & get_instance();
    return $CI->config->item('ENABLE_FORCE_PASSWORD_CHANGE_ON_RESET_PASSWORD');
}


function isApptApprovalActionDisabled(){
    $CI = & get_instance();
    return $CI->config->item('APPOINTMENT_APPROVAL_ACTION_DISABLED');
}

function isApptAppealApprovalActionDisabled(){
    $CI = & get_instance();
    return $CI->config->item('AA_APPEAL_APPROVAL_ACTION_DISABLED');
}

function isApptAndApptAppealApprovalProceedingsActionDisabled(){
    $CI = & get_instance();
    return $CI->config->item('AA_N_APPEAL_PROCEEDINGS_APPROVAL_ACTION_DISABLED');
}

function isManagerApplicationEnabled(){
    $CI = & get_instance();
    return $CI->config->item('MANAGER_APPLICATION_ENABLED');
}

function isManagerTenureEnabled(){
    $CI = & get_instance();
    return $CI->config->item('MANAGER_TENURE_ENABLED');
}

function isApptRevAppealRedirectEnabledInOffice(){
    $CI = & get_instance();
    return $CI->config->item('AA_REV_APPEAL_REDIRECT_ENABLED_IN_OFFICE');
}
function isSendAnywhereEnabled(){
    $CI = & get_instance();
    return $CI->config->item('DGE_SEND_ANYWHERE_ENABLED');
}

function isRPWDEnabled(){
    $CI = & get_instance();
    return $CI->config->item('RPWD_DATA_COLLECTION_ENABLED');
}


////////////////////////// SITE SETTINGS //////////////////////////

function array_remove($arr, $value) {
    return array_values(array_diff($arr, array($value)));
}

function dateFormat_Ymd($date) {
    list($d, $m, $y) = explode('/', $date);
    return $y . '-' . $m . '-' . $d;
}

function dateFormat_Ymd1($date) {
    list($d, $m, $y) = explode('-', $date);
    return $y . '-' . $m . '-' . $d;
}

function dateFormat_dmY($date) {
    list($y, $m, $d) = explode('-', $date);
    return $d . '/' . $m . '/' . $y;
}

function dateFormat_dmY1($date) {
    list($y, $m, $d) = explode('-', $date);
    return $d . '-' . $m . '-' . $y;
}

function get_time_format($minute) {
    $time_format = '';
    $hour = floor((int) $minute / 60);
    $minutes = (int) $minute % 60;
    $time_format .= ((int) $hour != 0) ? (int) $hour . ' Hours ' : '';
    $time_format .= ((int) $minutes != 0) ? (int) $minutes . ' Minutes ' : '';
    return $time_format;
}

//define('__NO_PERMISSION__', 'Sorry %s, you don\'t have enough permission to do this operation. If you want to know more about, please contact your administrator. <a href="%s" style="text-decoration:underline">Click Here</a> to go back. <br><br>');
//define('__NO_PERMISSION_AJAX__', 'Sorry %s, you don\'t have enough permission to do this operation. If you want to know more about, please contact your administrator.<br><br>');
function permission_warning($is_ajax_call = false) {
    /* $CI =& get_instance();
      if($is_ajax_call){
      return sprintf(__NO_PERMISSION_AJAX__, $CI->session->userdata("FIRSTNAME"));
      }else{
      return sprintf(__NO_PERMISSION__, $CI->session->userdata("FIRSTNAME"), @$_SERVER['HTTP_REFERER']);
      }
     */
    //return 'Sorry, you don\'t have enough permission to do this operation. If you want to know more about, please contact your administrator. <a href="'.@$_SERVER['HTTP_REFERER'].'" style="text-decoration:underline">Click Here</a> to go back. <br><br>';
    return 'Sorry, you don\'t have enough permission to do this operation. If you want to know more about, please contact your administrator. <br><br>';
}

function get_array_val_count($array, $key, $val) {
    $total_records = count($array);
    $count = 0;
    for ($i = 0; $i < $total_records; $i++) {
        if ($array[$i][$key] == $val)
            $count++;
    }
    return $count;
}

function get_array_double_val_count($array, $key1, $val1, $key2, $val2) {
    $total_records = count($array);
    $count = 0;
    for ($i = 0; $i < $total_records; $i++) {
        if ($array[$i][$key1] == $val1 and $array[$i][$key2] == $val2)
            $count++;
    }
    return $count;
}

function fncUuid() {
    return sprintf(
            '%08x-%04x-%04x-%02x%02x-%012x', mt_rand(), mt_rand(0, 65535), bindec(substr_replace(sprintf('%016b', mt_rand(0, 65535)), '0100', 11, 4)), bindec(substr_replace(sprintf('%08b', mt_rand(0, 255)), '01', 5, 2)), mt_rand(0, 255), mt_rand()
    );
}

function error_box($error) {
    ?>
    <div style="margin:5px;" align="center">
        <?php box_top(); ?>
        <div class="error_image" style="padding:10px;">
            <div style="margin:10px;margin-bottom:0px; font-size:16px" id="error_display" class="alert_display"><?php echo @$error; ?></div>
        </div>
        <?php box_bottom(); ?>
    </div>
    <?php
}

function get_sub_dist_name($sub_dist_code) {
    $CI = & get_instance();
    $CI->db->where('sub_district_code', $sub_dist_code);
    $sub_district_master = $CI->db->get('sub_district_master');
    if ($sub_district_master->num_rows() > 0) {
        $sub_district = $sub_district_master->result_array();
        return $sub_district[0]['sub_district_name'];
    }
}

function get_dist_name($dist_code) {
    $CI = & get_instance();
    $CI->db->where('rev_district_code', $dist_code);
    $district_master = $CI->db->get('tbl_rev_district_master');
    if ($district_master->num_rows() > 0) {
        $district = $district_master->result_array();
        return $district[0]['rev_district_name'];
    }
}

function datetophpmodel($date) {
    if ($date)
        return date('d M Y', strtotime($date));
    else
        return '';
}

function timephpmodel($date) {
    if ($date)
        return date('h:i A', strtotime($date));
    else
        return '';
}

/**
 * shows message as error text
 * @author Mohamed Rashid C <https://twitter.com/rashivkp>
 * @param string $message
 * @return string
 */
function error_message($message = '') {
    return '<div class="text-error"> <i class="icon-warning-sign"></i><strong> ' . $message . '</strong></div>';
}

/**
 * shows message as alert
 * @author Mohamed Rashid C <https://twitter.com/rashivkp>
 * @param string $message
 * @param string $css_class
 * @return string
 */
function set_message($message, $css_class) {
    get_instance()->session->set_flashdata('message', '
        <div class="alert ' . $css_class . '">
                            <button data-dismiss="alert" class="close" type="button">&times;</button>
                            <h4>' . $message . '</h4>
                        </div>');
}

function check_user() {
    $user = get_instance()->session->userdata('user_type');
    return $user;
}

function check_hm() {
    if(get_instance()->session->userdata('user_type')!=5 && get_instance()->session->userdata('status')==1){
        redirect('auth/login');
    }
}

function check_desig() {
//100	IT ADMIN
//101	DPI
//110	CLERK
//112	DDE
//115	DEO
//116	AEO
//117	School Manager
//118	PA to DEO
//119	JUNIOR SUPERIENDANT
//120	SENIOR SUPERIENDANT
    $desig = get_instance()->session->userdata('designation_id');
    return $desig;
}

function getApiUrl() {
    return 'https://sampoornaapi.kite.kerala.gov.in";';
//    return 'http://192.168.1.107/sampoornaapi';
}
/*
function check_access($id) {

    $CI = &get_instance();
    $data = $CI->db->where('school_id', get_instance()->session->userdata('SCHOOL_ID'))
                    ->where('id', $id)
                    ->get("AASF_SF_Teacher_Dtls")->row();
    if (count((array)$data) > 0) {
        return 1;
    } else {
        redirect('School/List_Staff/deny');
    }
}
*/
function check_access_modified($id) {

    // $CI = &get_instance();
    // $data = $CI->db->where('school_id', get_instance()->session->userdata('SCHOOL_ID'))
    //                 ->where('staff_id', $id)
    //                 ->get("staff_master")->row();
    // if (count((array)$data) > 0) {
    //     return 1;
    // } else {
    //     redirect('School/List_Staff/deny');
    // }
    return 1;
}

function check_confirm($type, $school_id = NULL) { // $school_code
    $CI = &get_instance();
    if($school_id == NULL)
        $school_id = get_instance()->session->userdata('SCHOOL_ID');
    $where_condition = " year in (select id from AASF_Academic_Year where  is_current= 1)";
    $data = $CI->db->where('school_id', $school_id)
                    ->where('report_type', $type)
                    ->where($where_condition)
                    ->where('confirm_flag','1')
                    ->get("z_AASF_Data_Confirms")->row();
    $s = (array)$data;
    if (count($s) > 0) {
        return 1;
    } else {
        return 0;
    }
}

function school_name_byid($schoolid) {
    if ($schoolid) {
        $CI = &get_instance();
        $data = $CI->db->where('id', $schoolid)
                        ->get('schools')->row("school_name");
        return $data;
    }
}
function hss_vhss_school_name_byid($schoolid){
    if ($schoolid) {
        $CI = &get_instance();
        $data = $CI->db->where('id', $schoolid)
                        ->get('higher_schools')->row("school_name");
        return $data;
    }
}

function get_hash($id) {
    return md5($id . "SF@2019");
}

/* deepa---------------------- start  */
// type = 1 is IOC and 2 is Bond attachment 
function get_document_upload_path($requestId=NULL,$is_pa=NULL,$type=NULL) {//is_pa denotes personal audit file
    $CI = & get_instance();
    if($requestId == NULL)
    {
        $uploadpath = 'uploads/msg_attachments/';
        if (!is_dir($uploadpath)) {
                mkdir($uploadpath, 0777, TRUE);
            }
        return $uploadpath;
    }elseif($is_pa == 1){
        $result = $CI->db->select('district_id,user_id,academic_year_id');
        $CI->db->where('PA.id', $requestId);
        $result = $CI->db->get('AASF_Request_Personal_Audit PA');
        if ($result->num_rows() > 0) {
            $results = $result->result_array();
            $uploadpath = './documentum/' . $results[0]['district_id'] . '/' . $results[0]['academic_year_id'] . '/' . $results[0]['user_id'] . '/'  . $requestId;
            if (!is_dir($uploadpath)) {
                mkdir($uploadpath, 0777, TRUE);
            }
            return $uploadpath;
        }
    }else if($type == 1){ //IOC
             $uploadpath = './documentum/IOC/'.$CI->session->userdata('user_id').'/'.$requestId;
             if (!is_dir($uploadpath)) {
                mkdir($uploadpath, 0777, TRUE);
            }
            return $uploadpath;
    }else if($type == 2){//Bond Attachment
        $bond_id = $requestId;
        $uploadpath = './documentum/Bonds/'.$CI->session->userdata('user_id').'/'.$bond_id;
        if (!is_dir($uploadpath)) {
            mkdir($uploadpath, 0777, TRUE);
        }
        return $uploadpath;
    }else{
        $result = $CI->db->select('S.revenue_district_id,S.edu_district_id,S.sub_district_id,S.id as school_id');
        $CI->db->join('schools as S', 'S.id = AR.school_id');
        $CI->db->where('AR.id', $requestId);
        $result = $CI->db->get('AASF_Request_Head AR');
        if ($result->num_rows() > 0) {
            $results = $result->result_array();
            $uploadpath = './documentum/' . $results[0]['revenue_district_id'] . '/' . $results[0]['edu_district_id'] . '/' . $results[0]['sub_district_id'] . '/' . $results[0]['school_id'] . '/' . $requestId;
            if (!is_dir($uploadpath)) {
                mkdir($uploadpath, 0777, TRUE);
            }
            return $uploadpath;
        }

    }
   
}

// type = 1 is IOC and 2 is Bond attachment 
function get_document_file_path($requestId=NULL,$is_pa=NULL,$type=NULL) {//is_pa denotes Personal Audit File
    $CI = & get_instance();
    if($requestId == NULL)
    {
        $uploadpath = 'uploads/msg_attachments/';
        return $uploadpath;
    }elseif($is_pa == 1){
        $result = $CI->db->select('district_id,user_id,academic_year_id');
        $CI->db->where('PA.id', $requestId);
        $result = $CI->db->get('AASF_Request_Personal_Audit PA');
        if ($result->num_rows() > 0) {
            $results = $result->result_array();
            $uploadpath = './documentum/' . $results[0]['district_id'] . '/' . $results[0]['academic_year_id'] . '/' . $results[0]['user_id'] . '/'  . $requestId.'/';
            return $uploadpath;
        }
    }else if($type == 1){
             $uploadpath = 'documentum/IOC/'.$CI->session->userdata('user_id').'/'.$requestId.'/';
             return $uploadpath;
    }else if($type == 2){
            $bond_id = $requestId;
            $uploadpath = '/documentum/Bonds/'.$CI->session->userdata('user_id').'/'.$bond_id.'/';
            return $uploadpath;
    }else{
            $result = $CI->db->select('S.revenue_district_id,S.edu_district_id,S.sub_district_id,S.id as school_id');
            $CI->db->join('schools as S', 'S.id = AR.school_id');
            $CI->db->where('AR.id', $requestId);
            $result = $CI->db->get('AASF_Request_Head AR');
            if ($result->num_rows() > 0) {
                $results = $result->result_array();
                $uploadpath = 'documentum/' . $results[0]['revenue_district_id'] . '/' . $results[0]['edu_district_id'] . '/' . $results[0]['sub_district_id'] . '/' . $results[0]['school_id'] . '/' . $requestId . '/';
                return $uploadpath;
            }
    }

}
    function checkFileType() {
        $file_nameF = $_FILES['userfile']['name'];
        $temp = explode(".", $file_nameF);
        return end($temp);
    }


/* deepa---------------------end  */

/**
 * For unlink file
 * @param type $unWantedFileUrl
 * @return boolean
 */
function unlinkfile($unWantedFileUrl) {
    $unWantedFile = base_path() . $unWantedFileUrl;
    if ((is_file($unWantedFile))) {
        if (unlink($unWantedFile))
            return true;
    } else
        return false;
}

function findElapsedTime($msgTime) {
    $datetime1 = new DateTime();
    $datetime2 = new DateTime($msgTime);
    $interval = $datetime1->diff($datetime2);
    $elapsed = 'Just now';
    if ($interval->y > 0) {
        $elapsed = $interval->format('%y years') . ' ago';
    } elseif ($interval->m > 0) {
        $elapsed = $interval->format('%m months') . ' ago';
    } elseif ($interval->d > 0) {
        $elapsed = $interval->format('%a days') . ' ago';
    } elseif ($interval->h > 0) {
        $elapsed = $interval->format('%h hours') . ' ago';
    } elseif ($interval->i > 0) {
        $elapsed = $interval->format('%i minutes') . ' ago';
    } elseif ($interval->s > 0) {
        $elapsed = $interval->format('%s seconds') . ' ago';
    }
    return $elapsed;
}

function get_unread_messages($userId) {
    //$msgData = $this->MM->get_threads($userId, 0); // fetching unread messages - 0 for unread
    //$msgCount = count($msgData);

    $CI = &get_instance();
    $CI->load->model('Mahana_model', 'MM');
    $CI->load->library('Mahana_messaging');
    $msgData = $CI->MM->get_threads($userId, 0); // fetching unread messages - 0 for unread
    return $msgData;
}

function get_notifications($userId) {
    $CI = &get_instance();
    $CI->load->model('NotificationsModel', 'NM');
    $notificationData = $CI->NM->get_notifications($userId, 0); // fetching unread messages - 0 for unseen
    return $notificationData;
}

function write_notification($user_id, $recipients, $notification_type, $addl_info=NULL,$requestID=NULL) { // type: 1-New file on desk; 2-file upload request; 3-delayed documents; 4-go; 5-link; 6-attachment; 7-draft; 8-proceedings ; 10- hearing; 24- adut request reset
    
    $content   = '';
    $file_type = '';
    $fileNo    = '';
    if($requestID){
       $file_type = getRequestTypeAsString($requestID);
       $fileNo    = getfileno_byRequestID($requestID);
    }
    
    if ($notification_type == 1) {
        if($file_type != ""){
            $content = 'You have a New '.$file_type.' File';
            if($fileNo != ""){
                $content .= ' '.$fileNo;
            }
            $content .= ' on your Desk';
        }else{
            $content = 'You have a New File on your Desk';
        }
    } else if ($notification_type == 2) {
        $content = 'You have a Document upload request';
    } else if ($notification_type == 3) {
        $content = 'New Document uploaded';
    } else if ($notification_type == 21) {
        $content = 'Profile Tab is now open for editing';
    } else if ($notification_type == 22) {
        $content = 'Qualification Tab is now open for uploading';
    } else if ($notification_type == 23) {
        $content = 'Gen.Documents Tab is now open for uploading';
    } else if ($notification_type == 10) {
        $content = 'Hearing Notice in Mailbox - '.$addl_info;
    } else if ($notification_type == 11) {
        $content = 'Appeal Filed - Add Remarks ';
    } else if ($notification_type == 24) {
        $content = 'Request for Audit is Reverted';
    }else if ($notification_type == 12){
        $content = 'You have a New Message in Mailbox';
    }else if ($notification_type == 13){
        $content = 'You have changed your password on '.date("d/m/Y H:i A");
    }else if($notification_type == 14){
        $content = $addl_info.' has changed your password on '.date("d/m/Y H:i A");
    }else if($notification_type == 15){
        $content = 'You have created '.$addl_info;
    }elseif($notification_type == 16){
        $content = 'You have updated '.$addl_info;
    }
    
    // remaining - to add in else-if's
    $CI = &get_instance();
    $CI->load->model('NotificationsModel', 'NM');
    $notificationData = $CI->NM->save_notifications($user_id, $recipients, $content);
    return $notificationData;
}

function get_edu_dist_name_by_id($edu_dist_code) {
    $CI = & get_instance();
    $CI->db->where('id', $edu_dist_code);
    $edu_district_master = $CI->db->get('master_edudistricts');
    if ($edu_district_master->num_rows() > 0) {
        $edu_district = $edu_district_master->result_array();
        return $edu_district[0]['edu_district_name'];
    }
}

function get_sub_dist_name_by_id($sub_dist_code) {
    $CI = & get_instance();
    $CI->db->where('id', $sub_dist_code);
    $sub_district_master = $CI->db->get('master_subdistricts');
    if ($sub_district_master->num_rows() > 0) {
        $sub_district = $sub_district_master->result_array();
        return $sub_district[0]['sub_district_name'];
    }
}

function get_dist_name_by_id($dist_code) {
    $CI = & get_instance();
    $CI->db->where('district_code', $dist_code);
    $district_master = $CI->db->get('master_district');
    if ($district_master->num_rows() > 0) {
        $district = $district_master->result_array();
        return $district[0]['district_name'];
    }
}

function get_name_of_user_by_id($user_id) {
    $CI = & get_instance();
    $CI->db->where('user_id', $user_id);
    $user_profiles = $CI->db->get('user_profiles');
    if ($user_profiles->num_rows() > 0) {
        $user_profile = $user_profiles->result_array();
        return $user_profile[0]['name'] . " " . $user_profile[0]['middle_name'] . " " . $user_profile[0]['last_name'];
    }
}

function get_usergroup_name_by_id($user_group_id) {
    $CI = & get_instance();
    $CI->db->where('id', $user_group_id);
    $rbac_group = $CI->db->get('rbac_group');
    if ($rbac_group->num_rows() > 0) {
        $user_group = $rbac_group->result_array();
        return $user_group[0]['usergroup'];
    }
}

function get_designation_name_by_id($designation_id) {
    $CI = & get_instance();
    $CI->db->where('desig_id', $designation_id);
    $role_data = $CI->db->get('master_designation');
    if ($role_data->num_rows() > 0) {
        $user_designation = $role_data->result_array();
        return $user_designation[0]['designation_name'];
    }
}

function get_current_office_id($master_office_id) {
    $CI = & get_instance();
    switch($master_office_id){
        case DEO_OFFICE : $office_id = $CI->session->userdata('edudistrict_id'); break;
        case AEO_OFFICE : $office_id = $CI->session->userdata('subdistrict_id'); break;
        case DDE_OFFICE : $office_id = $CI->session->userdata('district_id'); break;
        case DGE_OFFICE : $office_id = $CI->session->userdata('district_id'); break;
        case SEC_OFFICE : $office_id = $CI->session->userdata('district_id'); break;
    }
    return $office_id;
}

function get_supercheck_office_id($user_id){
    $CI = &get_instance();
    $CI->db->select('zone_id');
    $CI->db->where(array('id' => $user_id));
    $office_id = $CI->db->get('users')->row('zone_id');
    return $office_id;
}

function get_supercheck_office_name($office_id){
    $CI = &get_instance();
    $CI->db->select('zone_name');
    $CI->db->where(array('master_zone_id' => $office_id));
    $office_name = $CI->db->get('master_zones')->row('zone_name');
    return $office_name;
}

function get_office_block_name($office_block_id){
    $CI = &get_instance();
    $CI->db->select('block_name');
    $CI->db->where(array('office_block_id' => $office_block_id));
    $block_name = $CI->db->get('master_office_block')->row('block_name');
    return $block_name;
}

function get_current_user_in_section($master_office_id, $office_id, $role, $section) {
    // get currently active user in a section in office
    $CI = & get_instance();

    switch($master_office_id){
        case DEO_OFFICE : $user_office = "edudistrict_id"; $user_office_id = $CI->session->userdata('edudistrict_id'); break;
        case AEO_OFFICE : $user_office = "subdistrict_id"; $user_office_id = $CI->session->userdata('subdistrict_id'); break;
        case DDE_OFFICE : $user_office = "district_id"; $user_office_id = $CI->session->userdata('district_id'); break;
        case DGE_OFFICE : $user_office = "district_id"; $user_office_id = $CI->session->userdata('district_id'); break;
        case SUPER_CHECK_OFFICE : $user_office = "zone_id"; $user_office_id = $CI->session->userdata('zone_id'); break;
        case LAW_OFFICE : $user_office = "district_id"; $user_office_id = $CI->session->userdata('district_id'); break;
        case SEC_OFFICE : $user_office = "district_id"; $user_office_id = $CI->session->userdata('district_id'); break;
    }
    $eq_roles = getEquivalentRoles($role,$master_office_id);
    $CI->db->where('office_id', $master_office_id);
    $CI->db->where($user_office, $office_id);
    $CI->db->where('designation_id', $role);
    $CI->db->where('user_group_id', $section);
    $CI->db->where('activated', 1); // active user
    $CI->db->where('is_transfered', 0); // user not in the transfer list
    $usr = $CI->db->get('users')->result_array();
    $user_id = $usr[0]['id'];
    if($user_id == NULL){
        $CI->db->where('master_office_id', $master_office_id);
        $CI->db->where($user_office, $office_id);
        if($eq_roles != NULL)
            $CI->db->where_in('role_id', $eq_roles);
        else
            $CI->db->where_in('role_id', $role);
        $CI->db->where('user_group_id', $section);
        $CI->db->where('is_active', 1); // active user
        $CI->db->where('is_delete', 0); // user not in the transfer list
            $usr = $CI->db->get('full_addition_service_history')->result_array();
        $user_id = $usr[0]['user_id'];
    }
    return $user_id; 
}

function get_current_user_data($user_id = '',$master_office=NULL,$office_id=NULL,$revise_proceedings=NULL) {
    $CI = & get_instance();
    $CI->load->library('adminlib');
    $user_data = array();
    $uid = 0;
    $is_full_addition = 0;
    if ($user_id == '') {
        if($CI->session->userdata('user_type')!=5){ // not hm
            // echo '<pre>'; print_r($CI->session->userdata()); die;
            $user_data['user_id'] = $user_id = $CI->session->userdata('user_id');
            $user_data['designation_id'] = $CI->session->userdata('designation_id');
            $user_data['usergroup_id'] = $user_group_id =  $CI->session->userdata('usergroup_id');
            $user_data['master_office_id'] = $master_office_id = $CI->session->userdata('office_id');
            $user_data['office_block_id'] = $office_block_id = $CI->session->userdata('office_block_id');
            $user_data['zone_id'] = $zone_id = $CI->session->userdata('zone_id');

            $user_data['district_id'] =  $CI->session->userdata('district_id');
            $user_data['edudistrict_id'] =  $CI->session->userdata('edudistrict_id');
            $user_data['subdistrict_id'] =  $CI->session->userdata('subdistrict_id');

            $user_data['designation_name'] = $designation_name = $CI->session->userdata('designation_name');
            if($master_office_id == MANAGER_OFFICE){
                $user_data['mgmt_id'] = $mgmt_id = $CI->session->userdata('school_management_id');
            }
        }else{ // is hm
            $user_data['user_id'] = $user_id = $CI->session->userdata('user_id');
            //
            $CI->db->select('office_id, office_block_id, zone_id, district_id, subdistrict_id, edudistrict_id, designation_id, user_group_id');
            $CI->db->where(array('id' => $user_id));
            $hm_data = $CI->db->get('users')->row();
            //
            $user_data['designation_id'] = $hm_data->designation_id;
            $user_data['usergroup_id'] = $user_group_id =  $hm_data->usergroup_id;
            $user_data['master_office_id'] = $master_office_id = $hm_data->office_id;
            $user_data['office_block_id'] = $office_block_id = $hm_data->office_block_id;
            $user_data['zone_id'] = $zone_id = $hm_data->zone_id;

            $user_data['district_id'] =  $hm_data->district_id;
            $user_data['edudistrict_id'] =  $hm_data->edudistrict_id;
            $user_data['subdistrict_id'] =  $hm_data->subdistrict_id;

            $user_data['designation_name'] = 'HM';
            $user_data['office_id'] = $CI->session->userdata('SCHOOL_ID');
        }
        
    } else {
        if(isFullAdditionRoleLogin($user_id,$master_office,$office_id) && $revise_proceedings==1){
            $usr_id = 'user_id';
            $desig_id = 'role_id';
            $tbl = 'full_addition_service_history';
            $is_full_addition = 1;
        }else{
            $usr_id = 'id';
            $desig_id = 'designation_id';
            $tbl = 'users';
        }
        $uid = 1;
        $CI->db->where($usr_id, $user_id);
        $usr = $CI->db->get($tbl)->result_array();
        //print_r($usr); return;
        if($is_full_addition == 1){
            $user_data['designation_id'] = $usr[0]['role_id'];
            $user_data['user_id'] = $user_id = $usr[0]['user_id'];
            $user_data['master_office_id'] = $master_office_id = $usr[0]['master_office_id'];
        }else{  
            $user_data['user_id'] = $user_id = $usr[0]['id'];
            $user_data['designation_id'] = $usr[0]['designation_id'];
            $user_data['master_office_id'] = $master_office_id = $usr[0]['office_id'];
        }
        $user_data['usergroup_id'] = $user_group_id = $usr[0]['user_group_id'];
        $user_data['office_block_id'] = $office_block_id = $usr[0]['office_block_id'];
        $user_data['zone_id'] = $zone_id = $usr[0]['zone_id'];

        $user_data['district_id'] =  $usr[0]['district_id'];
        $user_data['edudistrict_id'] =  $usr[0]['edudistrict_id'];
        $user_data['subdistrict_id'] =  $usr[0]['subdistrict_id'];

        $CI->db->select('designation_name');
        $CI->db->where('desig_id', $user_data['designation_id']);
        $user_data['designation_name'] = $designation_name = $CI->db->get('master_designation')->row('designation_name');
    }

    if($user_data['office_block_id'] == NULL)
            $user_data['office_block_id'] = 0;
    // /$userMasterOfficeId = $this->session->userdata('office_id');
    // $userEdnDistrictId  = $this->session->userdata('edudistrict_id');
    // $userSubDistrictId  = $this->session->userdata('subdistrict_id');

    $user_data['name'] = get_name_of_user_by_id($user_id);
    $user_data['user_group_name'] = get_usergroup_name_by_id($user_group_id);

    $user_data['role'] = '';
    $user_data['dist_name'] = '';

    if ($master_office_id == 1006) {
        $user_data['office_id'] = $userEdnDistrictId = ($uid == 0) ? $CI->session->userdata('edudistrict_id') : $usr[0]['edudistrict_id'];
        $user_data['role'] = 'DEO';
        $user_data['dist_name'] = get_edu_dist_name_by_id($userEdnDistrictId);
    } else if ($master_office_id == 1007) {
        $user_data['office_id'] = $userSubDistrictId = ($uid == 0) ? $CI->session->userdata('subdistrict_id') : $usr[0]['subdistrict_id'];
        $user_data['role'] = 'AEO';
        $user_data['dist_name'] = get_sub_dist_name_by_id($userSubDistrictId);
    } else if ($master_office_id == 1000) {
        $user_data['office_id'] = '';
        $user_data['role'] = 'ITAdmin';
        $user_data['dist_name'] = '';
    } else if ($master_office_id == 1001) {
        $user_data['office_id'] = 0;
        $user_data['role'] = 'DGE';
        $user_data['dist_name'] = '';
    }else if ($master_office_id == 1002) {
        $user_data['office_id'] =$userDistrictId = ($uid == 0) ? $CI->session->userdata('district_id') : $usr[0]['district_id'];;
        $user_data['role'] = 'DDE';
        $user_data['dist_name'] = '';
        //dde office added
    } else if ($master_office_id == 1012) {
        $user_data['office_id'] = '';
        $user_data['role'] = 'Manager';
        $user_data['dist_name'] = '';
    } else if ($master_office_id == 1014) {
        $user_data['office_id'] = get_supercheck_office_id($CI->session->userdata('user_id'));
        // $user_data['role'] = 'Manager';
    } else if ($master_office_id == 1015) {
        $user_data['office_id'] = law_office_id(); 
        $user_data['role'] = 'Law Officer';
    } else if ($master_office_id == 1008 || $master_office_id == 1010 || $master_office_id == 1011) {
        // $user_data['office_id'] = '';//get_supercheck_office_id($CI->session->userdata('SCHOOL_ID'));
        $user_data['role'] = 'HM';
    }else if ($master_office_id == 1016) {
        $user_data['office_id'] = 0;
        $user_data['role'] = $designation_name;
        $user_data['dist_name'] = '';
    }

    return $user_data;
}

function is_file_approved($requestId, $req_type=1) {
    $tbl_req = 'AASF_Request';
    if($req_type==2)
        $tbl_req = 'AASF_Request_SF';
    if($req_type==3)
        $tbl_req = 'AASF_Request_Appeal';
    if($req_type==4)
        $tbl_req = 'AASF_Request_Revision';
    if($req_type==5)
        $tbl_req = 'AASF_Request_Appeal_AA';
    if($req_type==6)
        $tbl_req = 'AASF_Request_Audit';
    if($req_type==8)
        $tbl_req = 'AASF_Request_TeachersBank';
    if($req_type==9)
        $tbl_req = 'AASF_Request_Addl_Proposal';
    $whre = "(file_status='Approved' || file_status='Rejected' || file_status='Partially Allowed' || file_status='Conditionally Approved' || file_status='Objection Retained' || file_status='Dispose' || file_status='Revise' || file_status='Cancel' || file_status='Petition Allowed')";
    $CI = &get_instance();
    $CI->db->where(array('id' => $requestId));
    $CI->db->where($whre);

    $file_approved = $CI->db->get($tbl_req);
    if ($file_approved->num_rows() > 0) {
        return true;
        //$file_approve = $file_approved->result_array();
        //return $user_profile[0]['name']." ".$user_profile[0]['middle_name']." ".$user_profile[0]['last_name'];
    } else {
        if($req_type==REQ_TYPE_AUD){
            $has_obj_retained = $CI->General->is_record_exists('AASF_work_flow','request_id='.$requestId.' and mov_status=42');
            if($has_obj_retained > 0){
                return true;
            }
        }elseif($req_type==REQ_TYPE_PA){
            return true;
        }
        return false;
    }
}

const NO_DATA_MSG = 'No Data Found!';

function date_to_mysql($date){
    if ($date){
        $new_date = str_replace('/', '-', $date);
        return date('Y-m-d', strtotime($new_date));
    }
    else
        return '';
}

function mysql_to_datetime($datetime) {
    if ($datetime)
        return date('d/m/Y h:i A', strtotime($datetime));
    else
        return '';
}

function mysql_to_date($datetime) {
    if ($datetime)
        return date('d/m/Y', strtotime($datetime));
    else
        return '';
}

function mysql_to_date_dotformat($datetime) {
    if ($datetime)
        return date('d.m.Y', strtotime($datetime));
    else
        return '';
}

function mysql_to_date_hyphenformat($datetime) {
    if ($datetime)
        return date('d - m - Y', strtotime($datetime));
    else
        return '';
}

function mysql_to_date_ddMMMYYYY_format($date) {
    if ($date)
        return date('d M Y', strtotime($date));
    else
        return '';
}

function get_year(){
    if (date('m') <= 5) {
        $financial_year = (date('Y')-1) . '-' . date('Y');
    } else {
        $financial_year = date('Y') . '-' . (date('Y') + 1);
    }
    return $financial_year;
}

function getacademic_id($start_year = NULL){
    $CI = &get_instance();
    $CI->db->select('id');
    if($start_year != NULL)
        $CI->db->where(array('year' => $start_year));
    else
        $CI->db->where(array('is_current' => 1));
    $id = $CI->db->get('AASF_Academic_Year')->row('id');
    return $id;
}
function getCalendarId(){
    $CI = &get_instance();
    $CI->db->select('id');
    $CI->db->where(array('is_current' => 1));
    $id = $CI->db->get('calendar_year')->row('id');
    return $id;
}
function getCalendarYear(){
    $CI = &get_instance();
    $CI->db->select('year');
    $CI->db->where(array('is_current' => 1));
    $year = $CI->db->get('calendar_year')->row('year');
    return $year;
}
function previousAcademicId(){
    $CI = &get_instance();
    $CI->db->select('parentId');
    $CI->db->where(array('is_current' => 1));
    $id = $CI->db->get('AASF_Academic_Year')->row('parentId');
    return $id;
}

function getActiveAcademicYear($academic_id = NULL){
    $CI = &get_instance();
    $CI->db->select('year_desc');
    if($academic_id == NULL)
        $CI->db->where(array('is_current' => 1));
    else
        $CI->db->where(array('id' => $academic_id));
    $year = $CI->db->get('AASF_Academic_Year')->row('year_desc');
    return $year;
}

function getActiveAcademicStartYear($academic_id = NULL){
    $CI = &get_instance();
    $CI->db->select('year');
    if($academic_id == NULL)
        $CI->db->where(array('is_current' => 1));
    else
        $CI->db->where(array('id' => $academic_id));
    $year = $CI->db->get('AASF_Academic_Year')->row('year');
    return $year;
}

function is_sms_type_active($sms_id){//check the sms type is active or not
    $CI = &get_instance();
    $CI->db->select('is_active');
    $CI->db->where(array('master_sms_id' => $sms_id));
    $is_active = $CI->db->get('master_sms')->row('is_active');
    return $is_active;
}

function get_sms_count($message_type,$phone_number){//check the sms type is active or not
    $CI = &get_instance();
    $CI->db->select('count(*) as cnt');
    $CI->db->join('sms_thread_receiver as str', 'str.sms_thread_id = st.sms_thread_id');
    $CI->db->where(array('st.message_type' => $message_type,'str.phone_number'=>$phone_number,'str.has_successfully_sent'=>1));
    $CI->db->like('st.send_on', date('Y-m-d'));
    $count = $CI->db->get('sms_thread as st')->row('cnt');
    return $count;
}

// function send_sms($master_sms_id, $phone) { 
    
//     $CI = &get_instance();
//     $CI->load->library('../controllers/Sms_Management');
//     $CI->Sms_Management->sendMessageBySMS($master_sms_id,$phone,$message);
// }

function getacademic_year_from_request($request_id){
    $CI = &get_instance();
    $CI->db->select('year_desc');
    $CI->db->join('AASF_Request_SF as SF', 'SF.year = AY.Year');
    $CI->db->where('SF.id', $request_id);
    // $CI->db->where(array('is_current' => 1));
    $id = $CI->db->get('AASF_Academic_Year AY')->row('year_desc');
    return $id;
}

function getacademic_year_id_from_request($request_id){
    $CI = &get_instance();
    $CI->db->select('AY.id as ac_id');
    $CI->db->join('AASF_Request_SF as SF', 'SF.year = AY.Year');
    $CI->db->where('SF.id', $request_id);
    // $CI->db->where(array('is_current' => 1));
    $id = $CI->db->get('AASF_Academic_Year AY')->row('ac_id');
    return $id;
}

function is_draft_approved_appeal($sf_request_id){//Created by Abhishek get Appeal request id(Param:SF File req id)
    $CI = &get_instance();
    $CI->db->select('ARP.is_draft_approved');
    $CI->db->join('appeal_request_ref as arr', 'arr.request_appeal_id = ARP.id');
    $CI->db->where('arr.request_id', $sf_request_id);
    // $CI->db->where(array('is_current' => 1));
    $is_draft_approved = $CI->db->get('AASF_Request_Appeal ARP')->row('is_draft_approved');
    return $is_draft_approved;
}

// Malayalam values
function get_district_malayalam($district_id){
    $CI = &get_instance();
    $CI->db->select('district_name_mal');
    $CI->db->where('district_code', $district_id);
    $id = $CI->db->get('master_district')->row('district_name_mal');
    return $id;
}

function get_sub_district_malayalam($sub_district_id){
    $CI = &get_instance();
    $CI->db->select('sub_district_name_mal');
    $CI->db->where('id', $sub_district_id);
    $id = $CI->db->get('master_subdistricts')->row('sub_district_name_mal');
    return $id;
}

function get_edu_district_malayalam($edu_district_id){
    $CI = &get_instance();
    $CI->db->select('edu_district_name_mal');
    $CI->db->where('id', $edu_district_id);
    $id = $CI->db->get('master_edudistricts')->row('edu_district_name_mal');
    return $id;
}

function get_school_name_malayalam($school_id){
    $CI = &get_instance();
    $CI->db->select('school_name_mal');
    $CI->db->where('id', $school_id);
    $name = $CI->db->get('schools')->row('school_name_mal');
    return $name;
}
// Malayalam ends
function getQualTypeFromId($qual_id){
    $CI = &get_instance();
    $CI->db->select('Q.qlfn_type as q_type');
    $CI->db->join('AASF_Qualification as Q', 'Q.id = QD.qlfn_type_id');
    $CI->db->where('QD.id', $qual_id);
    $id = $CI->db->get('AASF_Qlfn_Dtls QD')->row('q_type');
    return $id;
}

function isFileInHand($request_id, $reqType, $user_id=NULL){//}, $office_id, $designation, $section, $user_id = NULL){
    if($user_id==NULL)
        $usr_data = get_current_user_data();
    else
        $usr_data = get_current_user_data($user_id);
    $CI = &get_instance();
    $CI->db->select('count(*) as cnt');

    $CI->db->join('AASF_Request_Head as RQ', 'RQ.id = WF.request_id');

    $CI->db->where('WF.request_id', $request_id);
    $CI->db->where('WF.master_officeid', $usr_data['master_office_id']);
    $CI->db->where('WF.office_id', $usr_data['office_id']);
    // $CI->db->where('WF.role_id', $usr_data['designation_id']);
    $CI->db->where('WF.user_group_id', $usr_data['usergroup_id']);
    //$CI->db->where('user_id', $user_id);
    $CI->db->where('RQ.req_type', $reqType);
    $fl_stat = array('Closed', 'Parked');
    $CI->db->where_not_in('WF.wf_status', $fl_stat);
    $CI->db->where('WF.is_file_in_hand', 1);
    $count = $CI->db->get('AASF_work_flow WF')->row('cnt');
    return $count;
}

function getInHandFileIds($reqType, $user_id=NULL){
    if($user_id==NULL)
        $usr_data = get_current_user_data();
    else
        $usr_data = get_current_user_data($user_id);
    $CI = &get_instance();
    $CI->db->select('WF.request_id');

    //$CI->db->select('(CASE WHEN (RQ.req_type = 1) THEN RQ_AA.file_number WHEN (RQ.req_type = 2) THEN RQ_SF.file_number END) as file_number');

    $CI->db->join('AASF_Request_Head as RQ', 'RQ.id = WF.request_id');

    //$CI->db->join(' AASF_Request AS RQ_AA ',' RQ.id = RQ_AA.id AND RQ.req_type=1', 'left');
    //$CI->db->join(' AASF_Request_SF AS RQ_SF ',' RQ.id = RQ_SF.id AND RQ.req_type=2', 'left');

    $CI->db->where('WF.master_officeid', $usr_data['master_office_id']);
    $CI->db->where('WF.office_id', $usr_data['office_id']);
    $CI->db->where('WF.role_id', $usr_data['designation_id']);
    $CI->db->where('WF.user_group_id', $usr_data['usergroup_id']);

    $CI->db->where('RQ.req_type', $reqType);

    //$CI->db->where('user_id', $user_id);
    $CI->db->where('WF.is_file_in_hand', 1);
    $fl_stat = array('Closed', 'Parked');
    $CI->db->where_not_in('WF.wf_status', $fl_stat);
    $result = $CI->db->get('AASF_work_flow WF')->result_array();
    if(!empty($result))
        return $result[0];
    else
        return $result;
}

function hasInitFilePermissionDEO($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $pa = $CI->adminlib->get_pa_id();
    $deo = $CI->adminlib->get_deo_id();
    $deo_full_addition = $CI->adminlib->get_deo_full_addition_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $pa_full_addition = $CI->adminlib->get_pa_full_addition_id();
    $main_js = $CI->adminlib->get_main_js_id();
    $initFilePermissionsDEO = array($pa, $deo, $pa_full_addition, $aeo_full_addition, $deo_full_addition, $main_js);

    $pa_office_id = $CI->adminlib->get_pa_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsDEO)) && ($master_officeid == $pa_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionAEO($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $js = $CI->adminlib->get_js_id();
    $main_js = $CI->adminlib->get_main_js_id();
    $aeo = $CI->adminlib->get_aeo_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $ss_full_addition = $CI->adminlib->get_ss_full_addition_id();
    $initFilePermissionsAEO = array($js, $aeo, $ss_full_addition, $main_js, $aeo_full_addition);

    $js_office_id = $CI->adminlib->get_js_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsAEO)) && ($master_officeid == $js_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDDE($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $aa = $CI->adminlib->get_aa_id();
    $ao = $CI->adminlib->get_ao_id();
    $dde = $CI->adminlib->get_dde_id();
    $main_js = $CI->adminlib->get_main_js_id();
    $js = $CI->adminlib->get_js_id();
    $dde_full_addition = $CI->adminlib->get_dde_full_addition_id();
    $aa_full_addition = $CI->adminlib->get_aa_full_addition_id();
    $ao_full_addition = $CI->adminlib->get_ao_full_addition_id();
    
    $initFilePermissionsDDE = array($aa, $ao, $dde, $main_js, $js, $dde_full_addition, $aa_full_addition,$ao_full_addition);

    $dde_office_id = $CI->adminlib->get_dde_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsDDE)) && ($master_officeid == $dde_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    // $main_js = $CI->adminlib->get_main_js_id();
    // $js = $CI->adminlib->get_js_id();
   $dge = $CI->adminlib->get_dge_id();
    $suprd = $CI->adminlib->get_suprd_id();
    $fo = $CI->adminlib->get_fo_id();
    
    $initFilePermissionsDGE = array($jd, $suprd,$fo,$dge);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsDGE)) && ($master_officeid == $dge_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionSec($role_id = NULL){//secretariat init file permissions
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $us = $CI->adminlib->under_sec_id();
    $ds = $CI->adminlib->deputy_sec_id();
    $js = $CI->adminlib->joint_sec_id();
    $as = $CI->adminlib->additional_sec_id();
    $s = $CI->adminlib->secretary_id();
    $ss = $CI->adminlib->special_sec_id();
    $ss = $CI->adminlib->minister_id();

    
    $initFilePermissionsSec = array($us, $ds,$js,$as,$s,$ss);

    $sec_office_id = $CI->adminlib->get_sec_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsSec)) && ($master_officeid == $sec_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE_H_Section($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();
    
    $initFilePermissionsHSection = array($unit_officer);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsHSection)) && ($master_officeid == $dge_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE_F_Section($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();
    $suprd = $CI->adminlib->get_suprd_id();
    
    $initFilePermissionsHSection = array($unit_officer, $suprd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $user_block_id = $CI->adminlib->get_office_block_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsHSection)) && ($master_officeid == $dge_office_id) && ($user_block_id == F_BLOCK) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE_G_Section($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();
    $suprd = $CI->adminlib->get_suprd_id();
    
    $initFilePermissionsHSection = array($unit_officer, $suprd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $user_block_id = $CI->adminlib->get_office_block_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsHSection)) && ($master_officeid == $dge_office_id) && ($user_block_id == G_BLOCK) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE_E_Section($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();
    $suprd = $CI->adminlib->get_suprd_id();
    
    $initFilePermissionsESection = array($unit_officer, $suprd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $user_block_id = $CI->adminlib->get_office_block_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsESection)) && ($master_officeid == $dge_office_id) && ($user_block_id == E_BLOCK) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE_M_Section($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();
    $suprd = $CI->adminlib->get_suprd_id();
    
    $initFilePermissionsMSection = array($unit_officer, $suprd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $user_block_id = $CI->adminlib->get_office_block_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsMSection)) && ($master_officeid == $dge_office_id) && ($user_block_id == M_BLOCK) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE_EC_Section($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();
    $suprd = $CI->adminlib->get_suprd_id();
    
    $initFilePermissionsHSection = array($unit_officer, $suprd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $user_block_id = $CI->adminlib->get_office_block_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsHSection)) && ($master_officeid == $dge_office_id) && ($user_block_id == EC_BLOCK) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE_ET_Section($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();
    $suprd = $CI->adminlib->get_suprd_id();
    
    $initFilePermissionsHSection = array($unit_officer, $suprd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $user_block_id = $CI->adminlib->get_office_block_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsHSection)) && ($master_officeid == $dge_office_id) && ($user_block_id == ET_BLOCK) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGE_EM_Section($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();
    $suprd = $CI->adminlib->get_suprd_id();
    
    $initFilePermissionsHSection = array($unit_officer, $suprd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $user_block_id = $CI->adminlib->get_office_block_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsHSection)) && ($master_officeid == $dge_office_id) && ($user_block_id == EM_BLOCK) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionSuperCheckCellOffice($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();
    $super_check_cell_officer = $CI->adminlib->get_sco_id();
    
    $initFilePermissionsSCOSection = array($super_check_cell_officer);

    $supercheck_office_id = $CI->adminlib->get_supercheck_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsSCOSection)) && ($master_officeid == $supercheck_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasInitFilePermissionDGEAudit($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $fo = $CI->adminlib->get_fo_id();
    $ao = $CI->adminlib->get_ao_id();
    $js = $CI->adminlib->get_main_js_id();
    
    $initFilePermissionsDGEAudit = array($fo,$ao,$js);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $user_block_id = $CI->adminlib->get_office_block_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $initFilePermissionsDGEAudit)) && ($master_officeid == $dge_office_id) && ($user_block_id == AUDIT_BLOCK_DGE) )
        $permitted = 1;
    return $permitted;
}

function hasJDPermission($role_id=NULL){
    //if user is JD
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $jd = $CI->adminlib->get_jd_id();

    $jdPermissions = array( $jd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $jdPermissions)) && ($master_officeid == $dge_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasFOPermission($role_id=NULL){
     //if user is Sr Finance Officer
     $CI = &get_instance();
     $CI->load->library('adminlib');
     $fo = $CI->adminlib->get_fo_id();
 
     $foPermissions = array( $fo);
 
     $dge_office_id = $CI->adminlib->get_dge_office_id();
     $master_officeid = $CI->adminlib->get_master_office_id();
     if($role_id == NULL)
         $role_id = $CI->adminlib->get_role_id();
 
     $permitted = 0;
     if( (in_array($role_id, $foPermissions)) && ($master_officeid == $dge_office_id) )
         $permitted = 1;
     return $permitted;
}

function hasAOPermission($role_id=NULL){//Account Officer in DDE
    //if user is JD
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $ao = $CI->adminlib->get_ao_id();
    $ao_full_addition = $CI->adminlib->get_ao_full_addition_id();
    $aoPermissions = array( $ao,$ao_full_addition);

    $dde_office_id = $CI->adminlib->get_dde_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $aoPermissions)) && ($master_officeid == $dde_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasDGEAOPermission($role_id=NULL){//Account Officer in DDE
    //if user is JD
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $ao = $CI->adminlib->get_ao_id();
    $ao_full_addition = $CI->adminlib->get_ao_full_addition_id();
    $aoPermissions = array( $ao,$ao_full_addition);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $aoPermissions)) && ($master_officeid == $dge_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasDDEPermission($role_id=NULL){
    //if user is DDE
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $dde = $CI->adminlib->get_dde_id();
    $dde_full_addition = $CI->adminlib->get_dde_full_addition_id();

    $ddePermissions = array( $dde,$dde_full_addition);

    $dde_office_id = $CI->adminlib->get_dde_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();

    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $ddePermissions)) && ($master_officeid == $dde_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasDEOPermission($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $pa = $CI->adminlib->get_pa_id();
    $deo = $CI->adminlib->get_deo_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $deo_full_addition = $CI->adminlib->get_deo_full_addition_id();
    $pa_full_addition = $CI->adminlib->get_pa_full_addition_id();

    $deoPermissions = array( $deo, $pa_full_addition, $aeo_full_addition,$deo_full_addition);

    $pa_office_id = $CI->adminlib->get_pa_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $deoPermissions)) && ($master_officeid == $pa_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasAEOPermission($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $js = $CI->adminlib->get_js_id();
    $main_js = $CI->adminlib->get_main_js_id();
    $aeo = $CI->adminlib->get_aeo_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $ss_full_addition = $CI->adminlib->get_ss_full_addition_id();
    $aeoPermissions = array( $aeo, $aeo_full_addition);

    $js_office_id = $CI->adminlib->get_js_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $aeoPermissions)) && ($master_officeid == $js_office_id) )
        $permitted = 1;
    return $permitted;
}

function has_PA_Permission($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $pa = $CI->adminlib->get_pa_id();
    $deo = $CI->adminlib->get_deo_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $deo_full_addition = $CI->adminlib->get_deo_full_addition_id();
    $pa_full_addition = $CI->adminlib->get_pa_full_addition_id();

    $paPermissions = array($pa, $pa_full_addition, $deo, $aeo_full_addition,$deo_full_addition);

    $pa_office_id = $CI->adminlib->get_pa_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $paPermissions)) && ($master_officeid == $pa_office_id) )
        $permitted = 1;
    return $permitted;
}

function has_SS_Permission($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $js = $CI->adminlib->get_js_id();
    $aeo = $CI->adminlib->get_aeo_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $deo_full_addition = $CI->adminlib->get_deo_full_addition_id();
    $main_js = $CI->adminlib->get_main_js_id();
    $ss_full_addition = $CI->adminlib->get_ss_full_addition_id();
    $ssPermissions = array($js, $ss_full_addition, $main_js, $aeo, $aeo_full_addition,$deo_full_addition);

    $js_office_id = $CI->adminlib->get_js_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $ssPermissions)) && ($master_officeid == $js_office_id) )
        $permitted = 1;
    return $permitted;
}

function has_AA_Permission($role_id=NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $aa = $CI->adminlib->get_aa_id();
    $aa_full_addition = $CI->adminlib->get_aa_full_addition_id();

    $ao = $CI->adminlib->get_ao_id();
    $ao_full_addition = $CI->adminlib->get_ao_full_addition_id();
    $dde = $CI->adminlib->get_dde_id();
    $main_js = $CI->adminlib->get_main_js_id();
    $js = $CI->adminlib->get_js_id();

    $aaPermissions = array( $aa, $ao, $dde,$aa_full_addition);//, $main_js, $js);

    $dde_office_id = $CI->adminlib->get_dde_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $aaPermissions)) && ($master_officeid == $dde_office_id) )
        $permitted = 1;
    return $permitted;
}

function has_SUPRD_Permission($role_id=NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    
    
    $jd = $CI->adminlib->get_jd_id();
    $main_js = $CI->adminlib->get_main_js_id();
    $js = $CI->adminlib->get_js_id();
    $suprd = $CI->adminlib->get_suprd_id();

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();

    $suprdPermissions = array( $jd, $main_js, $js, $suprd);

    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $suprdPermissions)) && ($master_officeid == $dge_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasAdminPermission($role_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $admin_id = $CI->adminlib->get_admin_id();
    $adminPermissions = array($admin_id);

    $admin_office_id = $CI->adminlib->get_admin_office_id();
    $dno_office_id = $CI->adminlib->get_dno_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $adminPermissions)) && ( ($master_officeid == $admin_office_id || $master_officeid == $dno_office_id ) ) )
        $permitted = 1;
    return $permitted;
}

function hasStateAdminPermission($role_id = NULL){//for state admin
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $state_admin_id = $CI->adminlib->get_state_admin_id();
    $stateAdminPermissions = array($state_admin_id);
    $state_admin_office_id = $CI->adminlib->get_dno_office_id();//dno office id= state admin office id
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $stateAdminPermissions)) && ( ($master_officeid == $state_admin_office_id) ) )
        $permitted = 1;
    return $permitted;
}

function hasDGEPermission($role_id=NULL){
    //if user is DDE
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $dge = $CI->adminlib->get_dge_id();
//    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();

    $dgePermissions = array( $dge);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $dgePermissions)) && ($master_officeid == $dge_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasSecretaryPermission($role_id=NULL){
    //if user is DDE
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $sec = $CI->adminlib->secretary_id();
    $ss = $CI->adminlib->special_sec_id();

    $secPermissions = array( $sec,$ss);

    $sec_office_id = $CI->adminlib->get_sec_office_id();               
    $master_officeid = $CI->adminlib->get_master_office_id(); 
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();              

    $permitted = 0;
    if( (in_array($role_id, $secPermissions)) && ($master_officeid == $sec_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasMinisterPermission($role_id=NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $min = $CI->adminlib->minister_id();

    $minPermissions = array( $min);

    $sec_office_id = $CI->adminlib->get_sec_office_id();               
    $master_officeid = $CI->adminlib->get_master_office_id(); 
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();              

    $permitted = 0;
    if( (in_array($role_id, $minPermissions)) && ($master_officeid == $sec_office_id) )
        $permitted = 1;
    return $permitted;
}

function hasADGEPermission($role_id=NULL){
    //if user is DDE
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $adge = $CI->adminlib->get_adge_id();
//    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();

    $adgePermissions = array( $adge);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $adgePermissions)) && ($master_officeid == $dge_office_id) && $CI->session->userdata('office_block_id') == H_BLOCK )
        $permitted = 1;
    return $permitted;
}

function hasADGEAcademicPermission($role_id=NULL){
    //if user is DDE
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $adge = $CI->adminlib->get_adge_id();
//    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();

    $adgeAcademicPermissions = array( $adge);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $adgeAcademicPermissions)) && ($master_officeid == $dge_office_id) && ($CI->session->userdata('office_block_id') == 0 || $CI->session->userdata('office_block_id') == NULL) )
        $permitted = 1;
    return $permitted;
}

function hasUnitOfficerPermission($role_id=NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $unit_officer = $CI->adminlib->get_unit_officer_id();

    $unitOfficerPermissions = array( $unit_officer);

    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $unitOfficerPermissions)) )
        $permitted = 1;
    return $permitted;
}

function hasLawOfficerPermission($role_id=NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $law_officer = $CI->adminlib->get_law_officer_id();

    $lawOfficerPermissions = array( $law_officer);

    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $lawOfficerPermissions)) )
        $permitted = 1;
    return $permitted;
}

function hasUnitOfficerPermission_H_Section($role_id=NULL){
    //if user is UO in H block
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $unit_officer = $CI->adminlib->get_unit_officer_id();

    $unitOfficerPermissions = array( $unit_officer);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $unitOfficerPermissions)) && ($master_officeid == $dge_office_id) && $CI->session->userdata('office_block_id') == H_BLOCK )
        $permitted = 1;
    return $permitted;
}

function dgeDashboardPermission(){//For DGE dashboard contents access permission by other dge office users
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $role_id = $CI->adminlib->get_role_id();
    $permitted = 0;
    if($role_id == $CI->adminlib->get_jd_id() || $role_id == $CI->adminlib->get_unit_officer_id() || $role_id == $CI->adminlib->get_adge_id() || ($role_id == $CI->adminlib->get_main_js_id() && $CI->session->userdata('office_id') == $CI->adminlib->get_dge_office_id()) || $role_id == $CI->adminlib->get_sco_id() || $role_id == $CI->adminlib->get_state_admin_id() || hasDGEAuditBlock())
        $permitted = 1;
    return $permitted;
}

function getEquivalentRoles($role_id, $master_officeid){
    $CI = &get_instance();
    $CI->load->library('adminlib');

    $pa = $CI->adminlib->get_pa_id();
    $deo = $CI->adminlib->get_deo_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $pa_full_addition = $CI->adminlib->get_pa_full_addition_id();
    $deo_full_addition = $CI->adminlib->get_deo_full_addition_id();

    $js = $CI->adminlib->get_js_id();
    $main_js = $CI->adminlib->get_main_js_id();
    $aeo = $CI->adminlib->get_aeo_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $ss_full_addition = $CI->adminlib->get_ss_full_addition_id();

    $aa = $CI->adminlib->get_aa_id();
    $aa_full_addition = $CI->adminlib->get_aa_full_addition_id();
    $ao = $CI->adminlib->get_ao_id();
    $ao_full_addition = $CI->adminlib->get_ao_full_addition_id();
    $dde = $CI->adminlib->get_dde_id();
    $dde_full_addition = $CI->adminlib->get_dde_full_addition_id();

    $jd = $CI->adminlib->get_jd_id();
    $fo = $CI->adminlib->get_fo_id();
    $suprd = $CI->adminlib->get_suprd_id();
    $unit_officer = $CI->adminlib->get_unit_officer_id();

    $pa_office_id = $CI->adminlib->get_pa_office_id();
    $js_office_id = $CI->adminlib->get_js_office_id();
    $dde_office_id = $CI->adminlib->get_dde_office_id();
    $dge_office_id = $CI->adminlib->get_dge_office_id();

    $super_check_office_id = $CI->adminlib->get_supercheck_office_id();
    $law_office_id = $CI->adminlib->get_law_office_id();
    
    $clerk = $CI->adminlib->get_clerk_id();

    $dge = $CI->adminlib->get_dge_id();
    $adge = $CI->adminlib->get_adge_id();

    $sco = $CI->adminlib->get_sco_id();
    $law_officer = $CI->adminlib->get_law_officer_id();


    $permittedRoles = array();

    if($role_id == $dge){
        $permittedRoles = array($dge);
    } else if($role_id == $clerk){
        $permittedRoles = array($clerk);
    }else{
        switch($master_officeid){
            case $pa_office_id  : // DEO office - JS, PA, DEO, PA Full Addition, AEO Full Addition
                        switch($role_id){
                            case $main_js : $permittedRoles = array($main_js);
                                            break;
                            case $pa      : $permittedRoles = array($pa, $pa_full_addition);//, $deo, $aeo_full_addition);
                                            break;
                            case $deo     : $permittedRoles = array($deo, $pa_full_addition, $aeo_full_addition,$deo_full_addition);
                                            break;
                            case $pa_full_addition : $permittedRoles = array($deo, $pa, $pa_full_addition, $aeo_full_addition,$deo_full_addition);
                                            break;
                            case $aeo_full_addition : $permittedRoles = array($deo, $pa_full_addition, $aeo_full_addition,$deo_full_addition);
                                            break;
                            case $deo_full_addition : $permittedRoles = array($deo,$pa_full_addition, $aeo_full_addition,$deo_full_addition);
                                            break;
                        }
                        break;
            case $js_office_id  : // AEO office - SS, AEO, SS Full Addition, AEO Full Addition
                        switch($role_id){
                            case $js      : $permittedRoles = array($js, $main_js,$ss_full_addition);//, $ss_full_addition, $aeo_full_addition);
                                            break;
                            case $main_js : $permittedRoles = array($main_js);
                                            break;
                            case $aeo     : $permittedRoles = array($aeo, $aeo_full_addition);
                                            break;
                            case $ss_full_addition  : $permittedRoles = array($js, $ss_full_addition);
                            break;
                            case $aeo_full_addition : $permittedRoles = array($aeo, $ss_full_addition, $aeo_full_addition);
                                        break;
                        }
                        break;
            case $dde_office_id :  // DDE office - JS, SS, AA, AO, DDE
                        switch($role_id){
                            case $main_js :
                            case $js      : $permittedRoles = array($main_js, $js);
                                            break;
                            case $aa      : $permittedRoles = array($aa_full_addition,$aa);
                                            break;
                            case $aa_full_addition      : $permittedRoles = array($aa_full_addition,$aa);
                                            break;
                            case $ao      : $permittedRoles = array($aa, $ao,$ao_full_addition);//, $main_js, $js);
                                            break;
                            case $ao_full_addition      : $permittedRoles = array( $ao,$ao_full_addition);//, $main_js, $js);
                                            break;
                            case $dde     : $permittedRoles = array($dde,$dde_full_addition);
                                            break;
                            case $dde_full_addition     : $permittedRoles = array($dde,$dde_full_addition);
                                        break;
                        }
                        break;
            case $dge_office_id : // DGE office - JS/SS, JD
                        switch($role_id){
                            case $main_js :
                            case $js      : $permittedRoles = array($main_js, $js);
                                            break;
                            case $jd      : $permittedRoles = array($jd);
                                            break;
                            case $suprd   : $permittedRoles = array($suprd);
                                            break;
                            case $ao       :
                            case $unit_officer: $permittedRoles = array($unit_officer,$ao);
                                            break;
                            case $adge    : $permittedRoles = array($adge);
                                            break;
                            case $fo      : $permittedRoles = array($fo);
                                            break;
                        }
                        break;
            case $super_check_office_id : // DGE office - JS/SS, JD
                        switch($role_id){
                            case $sco      : $permittedRoles = array($sco);
                                        break;
                        }
                        break;
            case $law_office_id : 
                        switch($role_id){
                            case $law_officer : $permittedRoles = array($law_officer);
                                        break;
                        }
                        break;
        }
    }
    if(empty($permittedRoles)){
        $permittedRoles = array($role_id);
    }
    return $permittedRoles;
}

function isFullAdditionRoles($role_id){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $dde_full_addition = $CI->adminlib->get_dde_full_addition_id();
    $aa_full_addition  = $CI->adminlib->get_aa_full_addition_id();
    $ao_full_addition  = $CI->adminlib->get_ao_full_addition_id();
    $deo_full_addition = $CI->adminlib->get_deo_full_addition_id();
    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $pa_full_addition  = $CI->adminlib->get_pa_full_addition_id();
    $ss_full_addition  = $CI->adminlib->get_ss_full_addition_id();
    $full_addition_roles = array($aeo_full_addition, $pa_full_addition, $ss_full_addition,$deo_full_addition,$dde_full_addition,$aa_full_addition,$ao_full_addition);
    if( in_array($role_id, $full_addition_roles) )
        return 1;
    else
        return 0;
}

function isInitFile($request_id){
    $CI = &get_instance();
    $CI->db->select('count(*) as cnt');
    $CI->db->where('WF.request_id', $request_id);
    $CI->db->where('WF.is_file_in_hand', 1);
    $CI->db->where('WF.user_id IS NULL', null, false);
    $CI->db->where('WF.role_id IS NULL', null, false);
    $CI->db->where('WF.user_group_id IS NULL', null, false);
    // $CI->db->select('count(*) as cnt');
    // $CI->db->where('WF.request_id', $request_id);
    $count = $CI->db->get('AASF_work_flow WF')->row('cnt');
    // if($count==1)
    if($count>0)
        return 1;
    else
        return 0;
}

function get_school_id_from_request($request_id){
    $CI = &get_instance();
    $CI->db->select('school_id');
    $CI->db->where('RQ.id', $request_id);
    $id = $CI->db->get('AASF_Request_Head as RQ')->row('school_id');
    // $CI->db->where('SF.id', $request_id);
    // $CI->db->where('SF.id', $request_id);
    // $id = $CI->db->get('AASF_Request_SF as SF')->row('school_id');
    return $id;
}

function get_request_id_from_school($school_id, $academic_id, $req_type = REQ_TYPE_SF){
    $req_table = '';
    if($req_type == REQ_TYPE_SF)
        $req_table = 'AASF_Request_SF';
    else if($req_type == REQ_TYPE_AA)
        $req_table = 'AASF_Request';
    $CI = &get_instance();
    $CI->db->select('id');
    $CI->db->where('RQ.school_id', $school_id);
    $CI->db->where('RQ.academic_year_id', $academic_id);
    $id = $CI->db->get($req_table.' as RQ')->row('id');
    return $id;
}

function is_clerk($user_id = NULL){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $clerk_id = $CI->adminlib->get_clerk_id();
    $sec_asst_id = $CI->adminlib->sec_asst_id();//secretariat asst is clerk in sec

    if($user_id==NULL)
        $usr_data = get_current_user_data();
    else
        $usr_data = get_current_user_data($user_id);

    if( $usr_data['designation_id'] == $clerk_id || $usr_data['designation_id'] == $sec_asst_id)
        return 1;
    else
        return 0;
}

function isITAdmin(){
    $CI = &get_instance();
    if($CI->session->userdata('user_id') == ITADMIN_USER_ID){
        return 1;
    }else{
        return 0;
    }
}

function is_DNO($user_id = NULL){
    $CI = &get_instance();
    if($CI->session->userdata('office_id') == 1013 )
        return 1;
    else
        return 0;
}

function is_SCO(){//check the user is super check officer or not
    $CI = &get_instance();
    $CI->load->library('adminlib');
    if($CI->session->userdata('office_id') == SUPER_CHECK_OFFICE && $CI->session->userdata('designation_id') ==  $CI->adminlib->get_sco_id())
        return 1;
    else
        return 0;
}

function is_Law_Officer(){//check the user is law officer or not
    $CI = &get_instance();
    $CI->load->library('adminlib');
    if($CI->session->userdata('office_id') == LAW_OFFICE && $CI->session->userdata('designation_id') ==  $CI->adminlib->get_law_officer_id())
        return 1;
    else
        return 0;
}

function getAARequestIDFromAppealRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('ref.request_id');
    $CI->db->join('appeal_request_ref as ref', 'ref.request_appeal_id = APL.id');
    $CI->db->where('APL.id', $request_id);
    $id = $CI->db->get('AASF_Request_Appeal_AA APL')->row('request_id');
    return $id;
}

function getActiveAppealIDFromAARequestID($request_id){
    $CI = &get_instance();
    $CI->db->select('ref.request_appeal_id');
    $CI->db->join('appeal_request_ref as ref', 'ref.request_appeal_id = APL.id');
    $CI->db->where('ref.request_id', $request_id);
    // $CI->db->where('APL.final_file_status', 0);
    $CI->db->order_by('ref.appeal_request_ref_id','desc');
    $id = $CI->db->get('AASF_Request_Appeal_AA APL')->row('request_appeal_id');
    return $id;
}

function getActiveReopenAuditIDFromAARequestID($request_id){
    $CI = &get_instance();
    $CI->db->select('RO.reopen_by_request_id');
    $CI->db->where('RO.request_id', $request_id);
    $CI->db->where('RO.reopen_type', RE_OPEN_BY_AUDIT);
    $id = $CI->db->order_by('id',"desc")->limit(1)->get('reopened_file_history RO')->row('reopen_by_request_id');
    return $id;
}

function getAppealRequestIDFromAppealID($appeal_id, $module_type = NULL){
    // 1- APL_MODULE_SF ; 2 - APL_MODULE_AA
       if($module_type == NULL)
           $module_type = APL_MODULE_SF;
       if($module_type == APL_MODULE_SF)
           $tbl_apl = 'AASF_Request_Appeal';
       else if($module_type == APL_MODULE_AA)
           $tbl_apl = 'AASF_Request_Appeal_AA';
           
   $CI = &get_instance();
   $CI->db->select('APL.id');
   $CI->db->where('APL.appeal_id', $appeal_id);
   $id = $CI->db->get($tbl_apl.' APL')->row('id');
   return $id;
}

function getSFRequestIDFromAppealID($appeal_id, $module_type = NULL){
     // 1- APL_MODULE_SF ; 2 - APL_MODULE_AA
        if($module_type == NULL)
            $module_type = APL_MODULE_SF;
        if($module_type == APL_MODULE_SF)
            $tbl_apl = 'AASF_Request_Appeal';
        else if($module_type == APL_MODULE_AA)
            $tbl_apl = 'AASF_Request_Appeal_AA';
            
    $CI = &get_instance();
    $CI->db->select('ref.request_id');
    $CI->db->join('appeal_request_ref as ref', 'ref.request_appeal_id = APL.id');
    $CI->db->where('APL.appeal_id', $appeal_id);
    $id = $CI->db->get($tbl_apl.' APL')->row('request_id');
    return $id;
}

function getSFRequestIDFromAppealRequest($request_id, $req_type=NULL){ // 3-REQ_TYPE_APL; 5-REQ_TYPE_APL_AA
    if($req_type == NULL){
        $req_type = REQ_TYPE_APL;
    }
    $req_table = '';
    if($req_type == REQ_TYPE_APL)
        $req_table = 'AASF_Request_Appeal';
    else if($req_type == REQ_TYPE_APL_AA)
        $req_table = 'AASF_Request_Appeal_AA';
    $CI = &get_instance();
    $CI->db->select('ref.request_id');
    $CI->db->join('appeal_request_ref as ref', 'ref.request_appeal_id = APL.id');
    $CI->db->where('APL.id', $request_id);
    $id = $CI->db->get($req_table.' APL')->row('request_id');
    return $id;
}

function getAppealRequestIDsFromSFRequest($request_id, $req_type=NULL){
    $apl_tbl = 'AASF_Request_Appeal';
    if ($req_type == REQ_TYPE_APL_AA || $req_type == REQ_TYPE_AA || $req_type == REQ_TYPE_AUD || $req_type == REQ_TYPE_AUDIT_REMARK) {
        $apl_tbl = 'AASF_Request_Appeal_AA';
    }
    $CI = &get_instance();
    $CI->db->select('APL.id');//'ref.request_id');
    $CI->db->join('appeal_request_ref as ref', 'ref.request_appeal_id = APL.id');
    $CI->db->where('ref.request_id', $request_id);
    $apl_id = $CI->db->get($apl_tbl.' APL');//->row('request_id');
    $apl_id = $apl_id->result_array();
    return $apl_id;
}

function getAppealRequestIDFromAppealRemarkRequest($request_id,$req_type){ // AA appeal req id from appeal remark req id
    $CI = &get_instance();
    $CI->db->select('APLAA.id');//'ref.request_id');
    $CI->db->join('AASF_Request_Appeal_Remarks APR', 'APR.appeal_id = APLAA.appeal_id');
    $CI->db->join('AASF_Request_Head as RH', 'RH.id = APLAA.id');
    $CI->db->where('APR.id', $request_id);
    $CI->db->where('RH.req_type', $req_type);
    $apl_id = $CI->db->get('AASF_Request_Appeal_AA as APLAA')->row('id');
    return $apl_id;
}

function getAppealRemarkRequestIDFromAppealRequest($request_id,$req_type, $module_type=NUll){
    // 1- APL_MODULE_SF ; 2 - APL_MODULE_AA
    if($module_type == NULL)
        $module_type = APL_MODULE_SF;
    if($module_type == APL_MODULE_SF)
        $tbl_apl = 'AASF_Request_Appeal';
    else if($module_type == APL_MODULE_AA)
        $tbl_apl = 'AASF_Request_Appeal_AA';
    $CI = &get_instance();
    $CI->db->select('APR.id');//'ref.request_id');
    $CI->db->join($tbl_apl.' as APL', 'APL.appeal_id = APR.appeal_id');
    $CI->db->join('AASF_Request_Head as RH', 'RH.id = APR.id');
    $CI->db->where('APL.id', $request_id);
    $CI->db->where('RH.req_type', $req_type);
    $apl_id = $CI->db->get('AASF_Request_Appeal_Remarks APR')->row('id');
    return $apl_id;
}

function getAppealAttTypeFromAppealRequest($request_id){//get appeal remarks attachments type
    $CI = &get_instance();
    $CI->db->distinct();
    $CI->db->select('aa.attachment_type,APR.req_type');//'ref.request_id');
    $CI->db->join('AASF_Request_Appeal_Remarks as APR', 'APL.appeal_id = APR.appeal_id');
    $CI->db->join('appeal_attachments as aa', 'aa.appeal_id = APR.appeal_id and aa.req_type = APR.req_type');
    // $CI->db->join('appeal_attachments as aa1', 'aa1.req_type = APR.req_type');
    $CI->db->where('APL.id', $request_id);
    $CI->db->where('APR.is_approved', 1);
    $req_types = $CI->db->get('AASF_Request_Appeal APL')->result_array();
    return $req_types;
}

function getTaggedAppealIDsFromRevisionAppealRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('a.tagged_appeal_id');//'ref.request_id');
    $CI->db->join('appeal as a', 'a.appeal_id = APL.appeal_id');
    $CI->db->where('APL.id', $request_id);
    $id = $CI->db->get('AASF_Request_Appeal APL')->row('tagged_appeal_id');
    return $id;
}

function getTaggedAppealReqIDFromTaggedAppealID($appeal_id, $req_type, $excludeRevApl = NULL){
    $CI = &get_instance();
    $apl_tbl = getAppealTable($req_type);
    if($excludeRevApl == NULL || $excludeRevApl == 0){
        $id = $CI->General->getrow($apl_tbl, 'id', array('appeal_id' => $appeal_id))->id;
    }else{
        $CI->db->select('RA.id');
        $CI->db->join($apl_tbl.' as RA', 'RA.appeal_id = a.appeal_id');
        $CI->db->where('RA.appeal_id', $appeal_id);
        $CI->db->where('(a.is_revision_appeal=0 OR a.is_revision_appeal IS NULL)');
        $id = $CI->db->get('appeal a')->row('id');
    }
    return $id;
}

function getRequestTable($req_type){
    $req_tbl = '';
    switch ($req_type) {
        case REQ_TYPE_AA     : $req_tbl = 'AASF_Request';
                               break;
        case REQ_TYPE_SF     : $req_tbl = 'AASF_Request_SF';
                               break;
        case REQ_TYPE_REV    : $req_tbl = 'AASF_Request_Revision';
                               break;
        case REQ_TYPE_APL    : $req_tbl = 'AASF_Request_Appeal';
                               break;
        case REQ_TYPE_APL_AA : $req_tbl = 'AASF_Request_Appeal_AA';
                               break;
        case REQ_TYPE_AUD    : $req_tbl = 'AASF_Request_Audit';
                               break;
        case REQ_TYPE_ADDL_POST_PROPOSAL    : $req_tbl = 'AASF_Request_Addl_Proposal';
                               break;
    }
    return $req_tbl;
}

function getAppealTable($req_type){
    $apl_tbl = '';
    if ($req_type == REQ_TYPE_APL) {
        $apl_tbl = 'AASF_Request_Appeal';
    }else if ($req_type == REQ_TYPE_APL_AA) {
        $apl_tbl = 'AASF_Request_Appeal_AA';
    }
    return $apl_tbl;
}

function getRootTable($request_id){
    $root_tbl = '';
    $req_type = getRequestType($request_id);
    if ($req_type == REQ_TYPE_SF || $req_type == REQ_TYPE_APL || $req_type == REQ_TYPE_REV) {
        $root_tbl = 'AASF_Request_SF';
    }else if ($req_type == REQ_TYPE_AA ||  $req_type == REQ_TYPE_APL_AA || $req_type == REQ_TYPE_AUD ) {
        $root_tbl = 'AASF_Request';
    }
    return $root_tbl;
}

function getAppealIDsFromSFRequest($request_id,$is_re_app=NULL,$req_type=NULL){
    $apl_tbl = 'AASF_Request_Appeal';
    $root_req_type = getRequestType($request_id); 
    if ($root_req_type == REQ_TYPE_APL_AA || $root_req_type == REQ_TYPE_AA) {
            $apl_tbl = 'AASF_Request_Appeal_AA';
    }
    $CI = &get_instance();
    $CI->db->select('APL.appeal_id');//'ref.request_id');
    $CI->db->join('appeal_request_ref as ref', 'ref.request_appeal_id = APL.id');
    if(@$is_re_app == 1){
        $CI->db->join('appeal as a', 'a.appeal_id = APL.appeal_id');
        $CI->db->where('a.is_revision_appeal', $is_re_app);
    }
    $CI->db->where('ref.request_id', $request_id);
    $CI->db->order_by('APL.id', 'desc');
    $apl_id = $CI->db->get($apl_tbl.' APL');//->row('request_id');
    $apl_id = $apl_id->result_array();
    return $apl_id;
}

function getQuestionIDsFromAUDRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('aq.audit_questions_id as q_id');//'ref.request_id');
    $CI->db->join('audit_questions as aq', 'aq.aud_file_id = RA.id');
    $CI->db->where('RA.id', $request_id);
    $q_id = $CI->db->get('AASF_Request_Audit RA');//->row('request_id');
    $q_id = $q_id->result_array();
    return $q_id;
}

function getAnswerIDsFromAUDRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('ar.audit_reply_id as ans_id');//'ref.request_id');
    $CI->db->join('audit_reply as ar', 'ar.remark_file_id = RA.id');
    $CI->db->where('RA.aud_file_id', $request_id);
    $q_id = $CI->db->get('AASF_Request_Audit_Remarks RA');//->row('request_id');

    $q_id = $q_id->result_array();
    return $q_id;
}

function addNewAuditRemarksFilePermission($request_id){//@param:AASF_Request_audit Id 
    $CI = &get_instance();
    $CI->db->select('aq.audit_questions_id as q_id');//'ref.request_id');
    $CI->db->where('RA.aud_file_id', $request_id);
    $CI->db->order_by('aq.audit_questions_id','desc');
    $q_id = $CI->db->get('AASF_Request_Audit_Remarks RA')->row('q_id');
    return $q_id;
}

function getActiveQuestionId($request_id){
    $CI = &get_instance();
    $CI->db->select('aq.audit_questions_id as q_id');//'ref.request_id');
    $CI->db->join('audit_questions as aq', 'aq.aud_file_id = RA.id');
    $CI->db->where('RA.id', $request_id);
    $CI->db->order_by('aq.audit_questions_id','desc');
    $CI->db->limit(1);
    $q_id = $CI->db->get('AASF_Request_Audit RA')->row('q_id');
    return $q_id;
}

function getActiveAnswerId($q_id){
    $CI = &get_instance();
    $CI->db->select('ar.audit_reply_id as a_id');//'ref.request_id');
    $CI->db->where('ar.audit_questions_id', $q_id);
    $a_id = $CI->db->get('audit_reply ar')->row('a_id');
    return $a_id;
}


function getSFRequestIDFromReviewRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('SF_fileid');
    $CI->db->where('REV.id', $request_id);
    $id = $CI->db->get('AASF_Request_Revision REV')->row('SF_fileid');
    return $id;
}

function getAARequestIDFromAuditRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('AA_fileid');
    $CI->db->where('AUD.id', $request_id);
    // $CI->db->where('AUD.processing_office', 1);
    $id = $CI->db->get('AASF_Request_Audit AUD')->row('AA_fileid');
    return $id;
}

function getRootRequestIDFromAudit($request_id){
    $aa_request_id = getAARequestIDFromAuditRequest($request_id);
    $tmp_req_type = getRequestType($aa_request_id);
    if($tmp_req_type == REQ_TYPE_APL_AA){
        $aa_request_id = getSFRequestIDFromAppealRequest($aa_request_id,5); 
    }
    return $aa_request_id;
}

function getRootRequestIDFromAuditRemarkId($request_id){
    $CI = &get_instance();
    $aud_id = $CI->General->getrow('AASF_Request_Audit_Remarks','aud_file_id',array('id'=>$request_id))->aud_file_id;
    $root_file_id = getRootRequestIDFromAudit($aud_id);
    return $root_file_id;
}

function isAuditDeclarationFile($req_id){
    $CI = &get_instance();
    $is_declaration = $CI->General->getrow('AASF_Request_Audit_Remarks','is_declaration_file',array('id'=>$req_id))->is_declaration_file;
    return $is_declaration;
}

function isAuditAppealFile($req_id){
    $CI = &get_instance();
    $is_appeal = $CI->General->getrow('AASF_Request_Audit','is_appeal_file',array('id'=>$req_id))->is_appeal_file;
    return $is_appeal;
}

function getReviewRequestIDsFromSFRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('id');
    $CI->db->where('REV.SF_fileid', $request_id);
    $rev_id = $CI->db->get('AASF_Request_Revision REV');
    $rev_id = $rev_id->result_array();
    return $rev_id;
}

function getAuditRequestIDsFromAARequest($request_id){
    $req_type = getRequestType($request_id);
    $CI = &get_instance();
    $CI->db->select('id');
    $CI->db->where('AUD.AA_fileid', $request_id);
    $aud_id = $CI->db->get('AASF_Request_Audit AUD');
    $aud_id = $aud_id->result_array();
    if($aud_id == NULL && $req_type == REQ_TYPE_AA){
        $apl_id = getReOpenedAppealRequestByAudit($request_id);
        $aud_id = getAuditRequestIDsFromAAAppealRequest($apl_id);
    }
    if(isAuditDeclarationFile($request_id)){
        $new_aud_id = $CI->General->getrow('AASF_Request_Audit_Remarks','aud_file_id',array('id'=>$request_id))->aud_file_id;
        array_push($aud_id,array('id'=>$new_aud_id)); 
    }
    return $aud_id;
}

function getAuditRequestIDsFromAAAppealRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('id');
    $CI->db->where('AUD.AA_fileid', $request_id);
    $aud_id = $CI->db->get('AASF_Request_Audit AUD');
    $aud_id = $aud_id->result_array();
    return $aud_id;
}

function getReOpenedAppealRequestByAudit($request_id){
    $CI = &get_instance();
    $CI->db->select('AUD.AA_fileid');
    $CI->db->join('reopened_file_history AS RO','RO.reopen_by_request_id = AUD.id');
    $CI->db->where('RO.reopen_type', RE_OPEN_BY_AUDIT);
    $CI->db->where('RO.request_id', $request_id);
    $file_id = $CI->db->get('AASF_Request_Audit AUD');
    $file_id = $file_id->row()->AA_fileid;
    return $file_id;
}

function getAuditRemarkRequestIDsFromAARequest($request_id){
    $CI = &get_instance();
    $CI->db->select('AR.id');
    $CI->db->join('AASF_Request_Audit as A', 'A.id = AR.aud_file_id');
    $CI->db->where('A.AA_fileid', $request_id);
    $id = $CI->db->get('AASF_Request_Audit_Remarks AR')->row()->id;
    return $id;
}


function getReviewRemarkRequestIDsFromSFRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('RRR.id');
    $CI->db->join('AASF_Request_Review_Remarks as RRR', 'REV.id = RRR.rev_file_id');
    $CI->db->where('REV.SF_fileid', $request_id);
    $rev_id = $CI->db->get('AASF_Request_Revision REV');
    $rev_id = $rev_id->result_array();
    return $rev_id;
}

function getModificationIDsFromSFRequest($request_id){
    $CI = &get_instance();
    $CI->db->select('RM.id as modify_id');
    $CI->db->join('AASF_Request_SF as SF', 'SF.id = RM.fileId');
    $CI->db->where('SF.id', $request_id);
    $rev_id = $CI->db->get('AASF_Request_Modification RM');
    $rev_id = $rev_id->result_array();
    return $rev_id;
}

function getSFRequestIDFromModificationId($modification_id){
    $CI = &get_instance();
    $CI->db->select('fileId');
    $CI->db->where('RM.id', $modification_id);
    $id = $CI->db->get('AASF_Request_Modification RM')->row('fileId');
    return $id;
}

function getActiveModificationIDfromRequestSFID($sf_id){
    $CI = &get_instance();
    $CI->db->select('id');
    $CI->db->where('RM.fileId', $sf_id);
    $CI->db->where('RM.is_active', 1);
    $id = $CI->db->get('AASF_Request_Modification RM')->row('id');
    return $id;
}

function getAvailableSections(){
    $CI = &get_instance();
    $CI->load->model('CommonModel', 'CM');
    $CI->load->library('adminlib');
    $usr_data = get_current_user_data();
    $master_officeid = $usr_data['master_office_id'];
    $office = $usr_data['office_id'];
    $usergroup_id = $usr_data['usergroup_id'];
    $designation_id = $usr_data['designation_id'];

    $clerk_id    = $CI->adminlib->get_clerk_id();
    $all_clerks  = $CI->CM->getHierarchial_users($usergroup_id, $master_officeid, $office, $clerk_id);
    $available_sections = array();
    if(!empty($all_clerks)){
        foreach($all_clerks as $cl){
            array_push($available_sections, $cl['usergroup']);
        }
    }
    return $available_sections;
}
function getAvailableSectionsByAdmin(){
    $CI = &get_instance();
    $CI->load->model('CommonModel', 'CM');
    $CI->load->library('adminlib');
    $usr_data = get_current_user_data();
    $master_officeid = $CI->input->post('master_office');
    $office = $CI->input->post('office');
    $usergroup_id = $usr_data['usergroup_id'];
    $designation_id = $usr_data['designation_id'];

    $clerk_id    = $CI->adminlib->get_clerk_id();
    $all_clerks  = $CI->CM->getHierarchial_users($usergroup_id, $master_officeid, $office, $clerk_id);
    $available_sections = array();
    if(!empty($all_clerks)){
        foreach($all_clerks as $cl){
            array_push($available_sections, $cl['usergroup']);
        }
    }
    return $available_sections;
}
function getUserId($user_name){
    $CI = &get_instance();
    $id = $CI->General->getrow('users', 'id', array('username' => $user_name))->id;
    return $id;
}
function get_email($user_id){
    $CI = &get_instance();
    $result = $CI->db->select("email,is_sampoorna,school_code")->where("id",$user_id)->get("users")->row();
    if($result->is_sampoorna == 1){
        $email = $CI->db->select("school_email")->where("school_id",$result->school_code)->get("school_details")->row("school_email");
    }else{
        $email = $result->email;
    }    
    return $email;
}
function get_mobileno($user_id){
    $CI     = &get_instance();
    $phone  = $CI->db->select("phone")->where("user_id",$user_id)->get("user_profiles")->row("phone");
    return $phone;
}
function isDateTime($str){
    if (DateTime::createFromFormat('Y-m-d H:i:s', $str) !== FALSE) {
        return 1;
    }else{
        return 0;
    }
}
function get_draft_id($request_id,$is_letters=false){
     $CI     = &get_instance();
     if($is_letters == true)
        $draft_id = $CI->db->select("id")->where("request_id",$request_id)->where("status",1)->where("draft_template",2)->get("AASF_Draft_Notes")->row("id");
     else
        $draft_id = $CI->db->select("id")->where("request_id",$request_id)->where("status",2)->where_in("draft_template",array(3,5,6))->get("AASF_Draft_Notes")->row("id");
     return $draft_id;
}
function isDate($str){
    if (DateTime::createFromFormat('Y-m-d', $str) !== FALSE) {
        return 1;
    }else{
        return 0;
    }
}

function isValidManager($user_id = NULL){
    $validManager = 0;
    $CI = &get_instance();
    if($user_id == NULL){
        $user_id   = $CI->adminlib->get_user_id();
        $mngmnt_id = $CI->adminlib->get_management_id();
    }else{
        $mngmnt_id = $CI->adminlib->get_management_id($user_id);
    }

    if($mngmnt_id!='' && $mngmnt_id!=NULL){
        $schools_count = $CI->General->getrow('school_details', 'count(*) as cnt', array('mngment_id' => $mngmnt_id))->cnt;
        if($schools_count>0){
            $validManager = 1;
        }
    }

    return $validManager;
}

function getPhoneNumbersFromRequestID($request_id){//get all users phone number in related to a file
    $CI            = &get_instance();
    $CI->db->select('up.phone,up.user_id');//'ref.request_id');
    $CI->db->join('user_profiles as up', 'up.user_id = WF.user_id');
    $CI->db->where('WF.request_id', $request_id);
    $CI->db->group_by('up.user_id');
    $data          = $CI->db->get('AASF_work_flow WF');//->row('request_id');
    $temp_res = $data->result_array();
    $phones = array();
        foreach ($temp_res as $val) {
            $phones[$val['user_id']] = $val['phone'];
        }
    return $phones;
}

function getManagerPhoneNumberBySchoolID($school_id){
    $CI = &get_instance();
    $CI->db->select('up.phone,up.user_id');//'ref.request_id');
    $CI->db->join('users as u', 'u.school_management_id = SD.mngment_id');
    $CI->db->join('user_profiles as up', 'up.user_id = u.id');
    $CI->db->where('SD.school_id', $school_id);
    $data = $CI->db->get('school_details SD');//->row('request_id');
    $temp_res = $data->result_array();
    $phones = array();
        foreach ($temp_res as $val) {
            $phones[$val['user_id']] = $val['phone'];
        }
    return $phones;
}

function isSampoornaUser(){
    $CI = &get_instance();
    $CI->db->select('is_sampoorna');
    $CI->db->where('u.username', $CI->session->userdata('pen'));
    $result = $CI->db->get('users as u')->row('is_sampoorna');
    if($result == 1)
        return true;
    else
        return false;
}

function getProceedingsTypeFromRequestID($request_id,$draft_id=''){//get all users phone number in related to a file
    $CI = &get_instance();
    $CI->db->select('req_type');
    $CI->db->where('ARH.id', $request_id);
    $req_type = $CI->db->get('AASF_Request_Head ARH')->row("req_type");
    if($req_type == 2){
        $name = 'Older S.F Proceedings';
    }else if($req_type == 3){
        if(isRevisionAppeal($request_id, APL_MODULE_SF)){
            if(isGovernmentAppeal($request_id,$req_type))
                $name = 'Government Appeal Circular';
            else
                $name = 'Revision Appeal Proceedings';
        }else
            $name = 'S.F Appeal Proceedings';
    }else if($req_type == 4){
        $name = 'Reviewed Proceedings';
    }else if($req_type == 1){
        $name = 'A.A Proceedings';
    }else if($req_type == 5){
        if(isRevisionAppeal($request_id, APL_MODULE_AA))
            $name = 'A.A Revision Appeal Proceedings';
        else
            $name = 'A.A Appeal Proceedings';
    }else if($req_type == 6){
        $temp_type = $CI->General->getrow('AASF_Draft_Notes','draft_template',array('id'=>$draft_id))->draft_template;
        if($temp_type == 10){
            $name = 'Settlement Receipt';
        }else{
            if(isDGERefAudit($request_id)){
                $name = 'Audit Petition';
            }else{
                $name = 'Audit Proceedings';
            }
        }
    }elseif($req_type == 7){//Personal Audit
        $name = 'Personal Audit Proceedings';
    }elseif($req_type == 9){//Personal Audit
        $name = 'Additional Post Proposal Proceedings';
    }
    return $name;
}

function getZoneIdFromSchoolId($school_id){
     //administ_under - from school_details

    // revenue_district_id - from schools
    // zone_district_mapping
    // master_zones   
    $CI = &get_instance();
    $CI->db->select('zdm.master_zone_id as zone');
    $CI->db->join('schools as s', 's.revenue_district_id = zdm.master_district_id');
    $CI->db->where('s.id', $school_id);
    $zone = $CI->db->get('zone_district_mapping zdm')->row('zone');
    return $zone;
}

function isRevisionAppeal($request_id, $module_type){//Appeal Request Id
    if($module_type == APL_MODULE_SF)
        $apl_table = 'AASF_Request_Appeal';
    else if($module_type == APL_MODULE_AA)
        $apl_table = 'AASF_Request_Appeal_AA';
    $CI = &get_instance();
    $CI->db->select('a.is_revision_appeal');
    $CI->db->join($apl_table.' as RA', 'RA.appeal_id = a.appeal_id');
    $CI->db->where('RA.id', $request_id);
    $result = $CI->db->get('appeal a')->row('is_revision_appeal');
    if($result==1){
        return 1;
    }else{
        return 0;
    }
}

function isGovernmentAppeal($request_id, $req_type){
    if($req_type == REQ_TYPE_APL)
        $apl_table = 'AASF_Request_Appeal';
    else
        return 0;
    $CI = &get_instance();
    $CI->db->select('a.revision_office');
    $CI->db->join($apl_table.' as RA', 'RA.appeal_id = a.appeal_id');
    $CI->db->where('RA.id', $request_id);
    $result = $CI->db->get('appeal a')->row('revision_office');
    if($result==2){
        return 1;
    }else{
        return 0;
    }
}

function isDGERefAudit($request_id){//Appeal Request Id;
    $CI = &get_instance();
    $CI->db->select('RA.ref_audit_id');
    $CI->db->where('RA.id', $request_id);
    $result = $CI->db->get('AASF_Request_Audit RA')->row('ref_audit_id');
    if($result>0){
        return 1;
    }else{
        return 0;
    }
}

function isAidedSchool($school_id){
    $CI = &get_instance();
    $schools_fin_type = $CI->General->getrow('school_details', 'count(*) as cnt', array('school_id' => $school_id, 'school_finance_type_id'=>3))->cnt;
    return $schools_fin_type;
}
function isGovtSchool($school_id){
    $CI = &get_instance();
    $schools_fin_type = $CI->General->getrow('school_details', 'count(*) as cnt', array('school_id' => $school_id, 'school_finance_type_id'=>1))->cnt;
    return $schools_fin_type;
}

function getActiveManagerFromSchoolId($school_id){
    $CI = &get_instance();
    if(isGovtSchool($school_id)){
        return array();
    }else{
        //fetch manager
        $CI->db->select(' u.id,u.username,u.user_group_id,D.designation_name, rg.priority,up.name,up.middle_name,up.last_name,rg.usergroup, s.school_name, MT.is_current');

        $CI->db->from('users AS u');
        $CI->db->join('user_profiles AS up', 'up.user_id = u.id');
        $CI->db->join('school_details AS sd', 'sd.mngment_id = u.school_management_id');
        $CI->db->join('schools AS s', 's.id = sd.school_id');
        $CI->db->join('rbac_group AS rg ', ' u.user_group_id = rg.id');
        $CI->db->join('master_designation AS D ', ' D.desig_id = u.designation_id');
        //
        $CI->db->join('AASF_Management AS MG ', ' MG.id = u.school_management_id');
        $CI->db->join('manager_tenure AS MT ', ' MT.management_id = MG.id AND MT.user_id = u.id AND MT.is_current = 1');
        //
        $CI->db->where('s.id', $school_id);
        $CI->db->where('u.activated', 1);
        $CI->db->where('u.designation_id', $CI->adminlib->get_manager_id());
        $CI->db->where('u.office_id', MANAGER_OFFICE);

        $query = $CI->db->get();
        $result = $query->result_array();
        return $result;
    }
}

function getActiveHMFromSchoolId($school_id){
    $CI = &get_instance();

        $CI->db->select('u.id,u.username,u.user_group_id,D.designation_name, rg.priority,up.name,up.middle_name,up.last_name,rg.usergroup, s.school_name');

        $CI->db->from('users AS u');
        $CI->db->join('schools AS s', 's.id = u.school_code');
        $CI->db->join('user_profiles AS up', 'up.user_id = u.id');
        $CI->db->join('rbac_group AS rg ', ' u.user_group_id = rg.id');
        $CI->db->join('master_designation AS D ', ' D.desig_id = u.designation_id');

        $CI->db->where('u.school_code', $school_id);
        $CI->db->where('u.activated', 1);
        $CI->db->where('u.is_sampoorna', 1);
        $CI->db->where("u.username like 'admin@%'");
        $CI->db->where('u.designation_id', $CI->adminlib->get_hm_id());

        $query = $CI->db->get();
        $result = $query->result_array();
        return $result;
}

function getPhoneNumberFromOfficeId($master_officeid,$office_id){
    $CI = &get_instance();
    $CI->load->library('adminlib');
    if($master_officeid == AEO_OFFICE)
        $role_id = $CI->adminlib->get_aeo_id();
    elseif($master_officeid == DEO_OFFICE)
        $role_id = $CI->adminlib->get_deo_id();
    elseif ($master_officeid == DDE_OFFICE) 
        $role_id = $CI->adminlib->get_dde_id();
    $office_user_id = $CI->adminlib->get_active_user_id($master_officeid,$office_id,0,$role_id);
    $phone_number = get_mobileno($office_user_id);
    return $phone_number;
}

function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

function getDGEOfficeBlockForApptReAppeal($school_id){
    $block = false;
    $CI = &get_instance();
    $processing_master_office_id   = $CI->General->get_column("school_details","administ_under"," school_id = ".$school_id);
    $school_cat_id  = $CI->General->getrow('school_details', 'school_category_id', array('school_id'=>$school_id))->school_category_id;
    if($school_cat_id == 4){//4 is special school
        $block = M_BLOCK;
    }else if ($processing_master_office_id == AEO_OFFICE) {
        // $district_id  = $CI->General->getrow('schools', 'revenue_district_id', array('id'=>$school_id))->revenue_district_id;
        // if($district_id < 9){ // south zone - F sections
        //     $block = F_BLOCK;
        // }elseif($district_id){ // north zone - G sections
        //     $block = G_BLOCK;
        // }
        $edu_district_id  = $CI->General->getrow('schools', 'edu_district_id', array('id'=>$school_id))->edu_district_id;
        $block = $CI->General->getrow('aa_appeal_processing_edudistricts', 'office_block_primary', array('edu_district__id'=>$edu_district_id))->office_block_primary;

    } else if ($processing_master_office_id == DEO_OFFICE) { // EC, ET or EM blocks as per mapped list
        $edu_district_id  = $CI->General->getrow('schools', 'edu_district_id', array('id'=>$school_id))->edu_district_id;
        $block = $CI->General->getrow('aa_appeal_processing_edudistricts', 'office_block_id', array('edu_district__id'=>$edu_district_id))->office_block_id;
    }
    return $block;
}

function getRequestType($request_id) {
    $CI = &get_instance();
    $CI->db->select('req_type');
    $CI->db->from('AASF_Request_Head');
    $CI->db->where('id', $request_id);
    $query = $CI->db->get();
    $req_type = $query->row()->req_type;
    return $req_type;
}

function getOlderLabel($req_type){
    $label = '';
    if($req_type == REQ_TYPE_AA || $req_type == REQ_TYPE_APL_AA || $req_type == REQ_TYPE_AUD ){
        $label = "A.A. ";
    } else if($req_type == REQ_TYPE_SF || $req_type == REQ_TYPE_APL || $req_type == REQ_TYPE_REV){
        $label = "S.F. ";
    }
    return $label;
}

function getRequestTypeAsString($request_id) {
    $req_type = getRequestType($request_id);
    $req_type_str = '';
    switch($req_type){
        case REQ_TYPE_AA     : $req_type_str = "A.A."; break;
        case REQ_TYPE_SF     : $req_type_str = "S.F."; break;
        case REQ_TYPE_APL    :  if(isGovernmentAppeal($request_id,$req_type))
                                    $req_type_str = "S.F Government Appeal"; 
                                elseif(isRevisionAppeal($request_id, APL_MODULE_SF))
                                    $req_type_str = "S.F Rev. Appeal"; 
                                else
                                    $req_type_str = "S.F Appeal"; 
                                break;
        case REQ_TYPE_REV    : $req_type_str = "Review"; break;
        case REQ_TYPE_APL_AA : 
                                if(isRevisionAppeal($request_id, APL_MODULE_AA))
                                    $req_type_str = "A.A Rev. Appeal";
                                else
                                    $req_type_str = "A.A Appeal";
                                break;
        case REQ_TYPE_AUD    : $req_type_str = "Audit"; break;
        case REQ_TYPE_PA     : $req_type_str = "Personal Audit"; break;
        case REQ_TYPE_TBANK  : $req_type_str = "Teachers Bank"; break;
        case REQ_TYPE_REAPL_REMARK_AEO_DEO: 
            if(get_module_type($request_id) == 1){ $req_type_str = "S.F"; } 
            else if(get_module_type($request_id) == 2){ $req_type_str = "A.A"; } 
            $req_type_str .= " Appeal Remark";
            break;
        case ($req_type == REQ_TYPE_REAPL_REMARK_DDE ||$req_type == REQ_TYPE_REAPL_REMARK_H_SECTION || 
                $req_type == REQ_TYPE_REAPL_REMARK_SUPERCHECKCELL || $req_type == REQ_TYPE_REAPL_REMARK_LAW_OFFICE) : 
            if(get_module_type($request_id) == 1){ $req_type_str = "S.F"; } 
            else if(get_module_type($request_id) == 2){ $req_type_str = "A.A"; } 
            $req_type_str .= " Rev.Appeal Remark";
            break;
        case REQ_TYPE_COMMUNICATION: $req_type_str = "IOC"; break;
        case REQ_TYPE_APL_REMARK:
            if(get_module_type($request_id) == 1){ $req_type_str = "S.F"; } 
            else if(get_module_type($request_id) == 2){ $req_type_str = "A.A"; } 
            $req_type_str .= " Appeal Remark";
            break;
        case REQ_TYPE_REV_REMARK: 
            $req_type_str .= " Review Remark";
            break;
        case REQ_TYPE_AUDIT_REMARK:
            $req_type_str .= " Audit Remark";
            break;
        case REQ_TYPE_TBANK_REMARK:
            $req_type_str .= " Teachers Bank Remark";
            break;
    }
    return $req_type_str;
}

function getReviewAndAppealIds($fileId, $req_type,$tmp_fileId=NULL){
    @$rev_ids      = getReviewRequestIDsFromSFRequest($fileId);
    @$appeal_ids   = getAppealRequestIDsFromSFRequest($fileId,$req_type);
    if($req_type == REQ_TYPE_APL_AA || $req_type == REQ_TYPE_AUDIT_REMARK || ($tmp_fileId !=NULL && $req_type == REQ_TYPE_AUD && (get_instance()->session->userdata('office_id') == DDE_OFFICE || get_instance()->session->userdata('office_id') == DGE_OFFICE))){
        @$aud_ids      = getAuditRequestIDsFromAARequest($tmp_fileId);
    }
    else{
        @$aud_ids      = getAuditRequestIDsFromAARequest($fileId);
    }

    $rev_id_arr    = array();
        foreach ($rev_ids as $val) {
            $rev_id_arr[] = $val['id'];
        }
    $appeal_id_arr = array();
        foreach ($appeal_ids as $val) {
            $appeal_id_arr[] = $val['id'];
        }
    $aud_id_arr   = array();
        foreach ($aud_ids as $val) {
            $aud_id_arr[] = $val['id'];
        }
    $result = array_merge($rev_id_arr, $appeal_id_arr,$aud_id_arr);
    return $result;
}

function getReviewAndAppealIdsType($fileId, $req_type){
    @$rev_ids = getReviewRequestIDsFromSFRequest($fileId);
    @$appeal_ids = getAppealRequestIDsFromSFRequest($fileId,$req_type);
    @$aud_ids      = getAuditRequestIDsFromAARequest($fileId);
    $rev_id_arr = array();
        foreach ($rev_ids as $val) {
            $rev_id_arr[$val['id']] = "Review";
        }
    // print_r($rev_id_arr); die;
    $appeal_id_arr = array();
        foreach ($appeal_ids as $val) {
            $apl_req_type = getRequestType($val['id']);
            if($apl_req_type == REQ_TYPE_APL_AA){
                $label = "A.A. ";
            } else if($apl_req_type == REQ_TYPE_APL){
                $label = "S.F. ";
            }

            $appeal_id_arr[$val['id']] = $label." Appeal";
        }
    $aud_id_arr   = array();
        foreach ($aud_ids as $val) {
            $aud_id_arr[$val['id']] = "Audit";
        }

        $result = $rev_id_arr + $appeal_id_arr + $aud_id_arr;

    return $result;
}

function getReportingOfficer($userID){
    $CI = &get_instance();
    $CI->db->where('id', $userID);
    $usr = $CI->db->get('users')->result_array();
    //print_r($usr); return;
    $reporting_officer_id = $usr[0]['managing_id'];
    return $reporting_officer_id;    
}

function getWorkFlowUserDetaisFromAARequest($request_id){//get all users phone number in related to a file
    $CI            = &get_instance();
    $CI->db->select('u.id as user_id,u.designation_id as role_id,u.user_group_id,WF.office_id,WF.master_officeid');//'ref.request_id');\\\
    $CI->db->join('users as u' ,'u.id = WF.updated_by');
    $CI->db->where('WF.request_id', $request_id);
    $CI->db->group_by('u.id');
    $data          = $CI->db->get('AASF_work_flow WF')->result_array();//->row('request_id');
    return $data;
}

function isReSubmittedRequest($request_id){//check whether resubmitted file or not
    $CI = &get_instance();
    $CI->db->select('is_resubmitted');
    $CI->db->where(array('id' => $request_id));
    $is_resubmitted = $CI->db->get('AASF_Request')->row('is_resubmitted');
    return $is_resubmitted;
}

define("ACTIVITY_TYPE_GO", 1);
define("ACTIVITY_TYPE_LINK", 2);
define("ACTIVITY_TYPE_ATTACHMENT", 3);
define("ACTIVITY_TYPE_APPEAL_REMARKS", 4);
define("ACTIVITY_TYPE_REVIEW_REMARKS", 5);
define("ACTIVITY_TYPE_AUDIT_REMARKS", 6);
define("ACTIVITY_TYPE_IOC_TAGGED", 7);
define("ACTIVITY_TYPE_IOC_MESSAGE", 8);
define("ACTIVITY_TYPE_REV_APPEAL_REMARKS", 9);
define("ACTIVITY_TYPE_SETTLEMENT_APPROVE", 10);
define("ACTIVITY_TYPE_SETTLEMENT_CANCEL", 11);
define('ACTIVITY_TYPE_FILE_ACTION_RESET', 12);
define('ACTIVITY_TYPE_FILE_FAIR_RESET', 13);
define('ACTIVITY_TYPE_FILE_PROCEEDINGS_RESET', 14);
define('ACTIVITY_TYPE_LIABILITY_APPROVE',15);
define('ACTIVITY_TYPE_LIABILITY_REFIX',16);
define("ACTIVITY_TYPE_MANAGE_ATTACHMENT",17);
define('ACTIVITY_TYPE_SKIP_MOD_RESET', 18);
define('ACTIVITY_TYPE_FILE_SECTION_RESET',19);
define("ACTIVITY_TYPE_REV_APPEAL_REMARKS_INVALIDATE", 20);


// function write_auto_note($request_id, $activity_type, $master_office, $office_id, $office_block_id, $user_id, $role_id, $user_group_id, $title = NULL, $file_name = NULL, $file_url = NULL ) { // activity type: 1-New G.O.; 2-New Attachment; 3-New Link added; 4-Remarks; 
function write_auto_note($request_id, $activity_type, $title = NULL, $file_name = NULL, $file_url = NULL, $extra = NULL ) { // activity type: 1-New G.O.; 2-New Attachment; 3-New Link added; 4-Remarks; 
    $usr_data = get_current_user_data();
    $master_office   = $usr_data['master_office_id'];
    $office_id       = $usr_data['office_id'];
    $office_block_id = $usr_data['office_block_id'];
    $user_id         = $usr_data['user_id'];
    $role_id         = $usr_data['designation_id'];
    $usergroup_id    = $usr_data['usergroup_id'];
    $zone_id         = $usr_data['zone_id'];
    $content = '';
    switch($activity_type) {
        case ACTIVITY_TYPE_GO :  
                                $content = '<A data-toggle="modal" data-target="#fileForwardmodel_Go" onclick="showModalAttachmentsGLA(\''.$file_name.'\',\''.base_url().$file_url.'\',\'GO\')">'.'New G.O. uploaded - '.$title.'</A>';
                                break;
        case ACTIVITY_TYPE_LINK :
                                $content = '<A href="'.$file_name.'" target="_blank">'.'New Link uploaded - '.$title.'</A>';
                                break;
        case ACTIVITY_TYPE_ATTACHMENT :  
                                $content = '<A data-toggle="modal" data-target="#fileForwardmodel_Att" onclick="showModalAttachmentsGLA(\''.$file_name.'\',\''.base_url().$file_url.'\',\'Att\')">'.'New Attachment uploaded - '.$title.'</A>';
                                break;
        case ACTIVITY_TYPE_APPEAL_REMARKS: 
                                $content = '<A data-toggle="modal" data-target="#remarksModal" onclick="showAppealModalRemarks(\''.$extra['rem_request_id'].'\',\''.$extra['appeal_id'].'\',\''.$extra['rem_req_type'].'\')">'.'Remarks on the appeal approved by  '.$extra['approved_name'].' ('.$extra['approved_role'].' , '.$extra['approved_office_section'].') and sent.</A>';
                                break;
        case ACTIVITY_TYPE_REV_APPEAL_REMARKS: 
                                $content = '<A data-toggle="modal" data-target="#remarksModal" onclick="showAppealModalRemarks(\''.$extra['rem_request_id'].'\',\''.$extra['appeal_id'].'\',\''.$extra['rem_req_type'].'\')">'.'Remarks on the revision appeal approved by  '.$extra['approved_name'].' ('.$extra['approved_role'].' , '.$extra['approved_office_section'].') and sent.</A>';
                                break;
        case ACTIVITY_TYPE_REV_APPEAL_REMARKS_INVALIDATE :
                                $content = '<span class="text-black">'.'Remarks on the revision appeal invalidated by  '.$extra['approved_name'].' ('.$extra['approved_role'].' , '.$extra['approved_office_section'].').</span>';
                                break;                              
        case ACTIVITY_TYPE_REVIEW_REMARKS: 
                                $content = '';
                                break;
        case ACTIVITY_TYPE_AUDIT_REMARKS: 
                                if($file_name == 1){//1:Audit Question
                                    $content = '<span class="text-black">Remarks on the objection called for - </span><A data-toggle="modal" data-target="#remarksModal" onclick="showAuditModalRemarks(\''.$request_id.'\',\''.$title.'\',\''.$file_name.'\')">View</A>';
                                }elseif($file_name == 2){//2:Audit Reply
                                    $user = get_current_user_data();
                                    $content = '<span class="text-black">Remarks on the objection approved by the '.$user['name'].'('.$user['designation_name'].','.$user['user_group_name'].') and sent - </span><A data-toggle="modal" data-target="#remarksModal" onclick="showAuditModalRemarks(\''.$request_id.'\',\''.$title.'\',\''.$file_name.'\')">View</A>';
                                }
                                break;
        case ACTIVITY_TYPE_IOC_TAGGED: 
                                $content = '<A data-toggle="modal" data-target="#iocTagNote" onclick="iocTagModelNote(\''.$request_id.'\',\''.$file_name.'\')">'.'New IOC Tagged - '.$title.'</A>';
                                break;
        case ACTIVITY_TYPE_IOC_MESSAGE: 
                                $content = '<A data-toggle="modal" data-target="#iocMessageNote" onclick="iocMessageModelNote(\''.$file_name.'\')">'.'Letter Approved </A>';
                                break;
        case ACTIVITY_TYPE_SETTLEMENT_APPROVE:
                                $content = 'Settlement transaction of &#8377; <B>'.$extra['amount'].'</B> for user '.$extra['user'].' has been approved';
                                break;
        case ACTIVITY_TYPE_SETTLEMENT_CANCEL:
                                $content = 'Settlement transaction of &#8377; <B>'.$extra['amount'].'</B> '.$extra['user'].' has been cancelled';
                                break;
        case ACTIVITY_TYPE_FILE_ACTION_RESET : 
                                $content = '<span style="border: 1px solid #e6e6e6;padding: 5px;background-color: #ffff03;">File Action Reset by Admin</span>';
                                break;
        case ACTIVITY_TYPE_FILE_FAIR_RESET : 
                                $content = '<span style="border: 1px solid #e6e6e6;padding: 5px;background-color: #ffff03;">Fair Reset by Admin</span>';
                                break;
        case ACTIVITY_TYPE_FILE_PROCEEDINGS_RESET : 
                                $content = '<span style="border: 1px solid #e6e6e6;padding: 5px;background-color: #ffff03;">Proceedings Reset by Admin</span>';
                                break;
        case ACTIVITY_TYPE_LIABILITY_APPROVE : 
                                $content = '<span>Liability Approved</span>';
                                break;
        case ACTIVITY_TYPE_LIABILITY_REFIX : 
                                $content = '<span>Liability Refixed</span>';
                                break;
        case ACTIVITY_TYPE_MANAGE_ATTACHMENT : 
                                $content = '<A data-toggle="modal" data-target="#fileForwardmodel_Att" onclick="showModalAttachmentsGLA(\''.$file_name.'\',\''.base_url().$file_url.'\',\'Att\')">'.$extra.' - '.$title.'</A>';
                                break;
        case ACTIVITY_TYPE_SKIP_MOD_RESET : 
                                $content = '<span style="border: 1px solid #e6e6e6;padding: 5px;background-color: #ffff03;">Skip Modification Reset by Admin</span>';
                                break;
        case ACTIVITY_TYPE_FILE_SECTION_RESET : 
                                $content = '<span style="border: 1px solid #e6e6e6;padding: 5px;background-color: #ffff03;">Old file number '.$title.' have been reset by admin to '.$file_name.'</span>';
                                break;
    }
    $CI = &get_instance();
    $CI->load->model('FileNotes_Model', 'FNM');
    $date_of_entry = date("Y-m-d H:i:s");
    $notesArray = array(
        "request_id"	=>	$request_id, 
        "user_id"		=>	$user_id,
        "user_group_id"	=>	$usergroup_id,
        "role_id"	    =>	$role_id,
        "office_id"		=>	$office_id, 
        "remarks"		=>	$content, 
        "date_of_entry"	=>	$date_of_entry,
        "created_by"	=>	$user_id,
        "created_at"	=>	$date_of_entry,
        "updated_by"	=>	$user_id,
        "updated_at"	=>	$date_of_entry,
        "is_system_generated" => 1
        );

    $notesData = $CI->FNM->saveNotes($notesArray);
    return $notesData;
}

    function isAuditQuestionViewed($fileId){
        $CI = &get_instance();
        $active_qid = getActiveQuestionId($fileId);
        $active_ans_id = getActiveAnswerId($active_qid);
        @$is_active_question_approved = $CI->General->get_single_column_value("audit_questions","is_approved"," audit_questions_id =".$active_qid);
        if($active_ans_id !=NULL && $active_ans_id !='' && $is_active_question_approved == 1){
            $is_viewed = $CI->General->getrow('audit_reply','is_viewed',array("audit_questions_id"=>$active_qid),'')->is_viewed;

            return $is_viewed;
        }
    }

    function law_office_id(){
        return 0; // single law office- now set to 0 - static - may be DB required in future
    }

    function personalAuditStatus(){
        $CI = &get_instance();
        $CI->db->select('is_personal_audit');
        $CI->db->where('id',$CI->session->userdata('user_id'));
        $data = $CI->db->get('users')->row('is_personal_audit');
        return $data;
    }

    function filesize_formatted($size)
    {
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    function getDistEduSubIds($master_office,$office){
        $CI = &get_instance();
        $data = array();
        $data['district_id'] = NULL;
        $data['edudistrict_id'] = NULL;
        $data['subdistrict_id'] = NULL;
        switch ($master_office) {
            case DDE_OFFICE     :   $data['district_id'] = $office;
                                    break;
            case DEO_OFFICE     :   $data['district_id'] =$CI->General->getrow('master_edudistricts',
                                    'revenue_district_id',array('id' => $office))->revenue_district_id;

                                    $data['edudistrict_id'] = $office;

                                    break;
            case AEO_OFFICE     :   $data['district_id'] =$CI->General->getrow('master_subdistricts',
                                    'revenue_district_id',array('id' => $office))->revenue_district_id;

                                    $data['edudistrict_id'] =$CI->General->getrow('master_subdistricts',
                                    'edu_district_id',array('id' => $office))->edu_district_id;
                                    $data['subdistrict_id'] = $office;
                                    break;
        }
        return $data;
    }

    function isUserExistInChair($office_id,$master_office,$user_group){
        $CI = &get_instance();
        $data = array();
        switch ($master_office) {
            case DDE_OFFICE     :   $user = $CI->General->getrow('users','id,designation_id','office_id='.$master_office.' AND district_id='.$office_id.' AND user_group_id='.$user_group.' AND activated=1');
                                    break;
            case DEO_OFFICE     :   $user = $CI->General->getrow('users','id,designation_id','office_id='.$master_office.' AND edudistrict_id='.$office_id.' AND user_group_id='.$user_group.' AND activated=1');
                                    break;
            case AEO_OFFICE     :   $user = $CI->General->getrow('users','id,designation_id','office_id='.$master_office.' AND subdistrict_id='.$office_id.' AND user_group_id='.$user_group.' AND activated=1');
                                    break;
        }
        if($user->id > 0){
            $is_exist = 1;
            $user_name = getNameAndDesignationByUserId($user->id,$user->designation_id);
        }
        else
            $is_exist = 0;
        if($is_exist == 0){
            $user = $CI->General->getrow('full_addition_service_history','id,user_id,role_id','master_office_id='.$master_office.' AND office_id='.$office_id.' AND user_group_id='.$user_group.' AND is_active=1 AND is_delete=0');
            if($user->user_id > 0){
                $is_exist = 1;
                $user_name = getNameAndDesignationByUserId($user->user_id,$user->role_id,$user->id);
            }
            else
                $is_exist = 0;
        }
        if($is_exist == 0){
            $result = 0;
        }else{
            $result = $user_name;
        }

        return $result;
    }

    function isFullAdditionRoleLogin($user_id = NULL,$master_officeid=NULL,$officeid=NULL){
        $CI = &get_instance();
        if($user_id == NULL){
            if(isset($_SESSION['is_fulladdition']) && $CI->session->userdata('is_fulladdition') == 1){
                $result = 1;
            }else{  
                $result = 0;
            }
        }else{
            $CI = &get_instance();
            $CI->load->library('adminlib');
            $deo_full_addition = $CI->adminlib->get_deo_full_addition_id();
            $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
            $dde_full_addition = $CI->adminlib->get_dde_full_addition_id();
            $aa_full_addition = $CI->adminlib->get_aa_full_addition_id();
            $ao_full_addition = $CI->adminlib->get_ao_full_addition_id();
            $ao_full_addition = $CI->adminlib->get_ao_full_addition_id();
            $ss_full_addition  = $CI->adminlib->get_ss_full_addition_id();
            if($master_officeid == NULL && $officeid  == NULL){
                $master_officeid = $CI->adminlib->get_master_office_id();
                $officeid = $CI->adminlib->get_office_id();
            }
            $CI->db->select('count(id) as cnt');
            $CI->db->where('user_id',$user_id);
            $CI->db->where('master_office_id',$master_officeid);
            $CI->db->where('office_id',$officeid);
            $CI->db->where('is_active',1);
            $CI->db->where_in('role_id',array($deo_full_addition,$aeo_full_addition,$dde_full_addition,$aa_full_addition,$ao_full_addition,$ss_full_addition));
            $data = $CI->db->get('full_addition_service_history')->row('cnt');
            if($data > 0 ){
                $result = 1;
            }else{
                $result = 0;
            }
        }
        return $result;
    }

    function getNameAndDesignationByUserId($user_id,$desig_id,$is_fulladdition = NULL){
        $data = array();
        $data['name'] = get_name_of_user_by_id($user_id);
        $data['designation'] = get_designation_name_by_id($desig_id);
        $data['user_id'] = $user_id;
        $data['is_fulladdition'] = $is_fulladdition;
        return  $data;
    }


    function addWatermark($path){
        $ci = &get_instance();
        ob_end_clean();
        // $ci->load->library('m_pdf');
        // $mpdf_size=new mPDF('utf-8');
        $ci->load->library('m_pdf');
        $mpdf_size = new \mPDF('UTF-8');
        $check_pagecount = $mpdf_size->SetSourceFile(base_path().$path);
        if($check_pagecount > 0){
            $pageId = $mpdf_size->importPage(1);
            $size = $mpdf_size->getTemplateSize($pageId);
            // Define a default page size/format by array - page will be 190mm wide x 236mm height
            // $mpdf = new mPDF('utf-8',array($size['w'],$size['h']));
            $mpdf = new \mPDF('UTF-8',array($size['w'],$size['h']));
            $pagecount = $mpdf->SetSourceFile(base_path().$path);
            if($pagecount > 0){
                for ($i=1; $i <= $pagecount; $i++) { 
                    $tplId = $mpdf->ImportPage($i);
                    $mpdf->addPage();
                    $mpdf->UseTemplate($tplId);
                    $mpdf->SetWatermarkText('SAMANWAYA',0.05);
                    $mpdf->showWatermarkText = true;
                }
                $replace_paths= base_path().$path;
                $mpdf->Output($replace_paths, "F");
            }
        }
        return;
    }
    
    function get_cache_time(){
        return 435000; // 5days
    }
    
   function getIOCRoleID_DDE(){
        $CI = &get_instance();
        $CI->load->library('adminlib');
        $aa = $CI->adminlib->get_aa_id();
        $ao = $CI->adminlib->get_ao_id();
        $main_js = $CI->adminlib->get_main_js_id();
        $js = $CI->adminlib->get_js_id();
        $dde_full_addition = $CI->adminlib->get_dde_full_addition_id();
        $aa_full_addition = $CI->adminlib->get_aa_full_addition_id();
        $ao_full_addition = $CI->adminlib->get_ao_full_addition_id();
        return  array($aa, $ao,  $main_js, $js, $dde_full_addition, $aa_full_addition,$ao_full_addition);
    }
    
    function hasIOCPermission($role_id,$office_id,$master_office=NULL){
         
         $total = 0;
         $CI    = &get_instance();
         if($CI->session->userdata('office_block_id') == TAPAL_BLOCK && $role_id == $CI->adminlib->get_suprd_id()){
             return 1;
         }else if($role_id == $CI->adminlib->get_adge_id()){
             return 1;
         }
         $CI->db->select("count(*) as total");
         $CI->db->where("accessible_to_role_id",$role_id);
         if($master_office == NULL){
            $CI->db->where("created_by_master_office_id",$CI->adminlib->get_master_office_id());
         }
         $CI->db->where("created_office_id",$office_id);
         $CI->db->where('setid',0);
         $total = $CI->db->get("ioc_settings")->row("total");
         return $total;
    }
    
    function getIOCRoleID_DGE(){
        //IOC Setting - SS,UO(RA),UO [ET,EM,EC,North Zone,South Zone] ADPI, JD, ADPI Gen
        $CI = &get_instance();
        $CI->load->library('adminlib');
       // $jd = $CI->adminlib->get_jd_id();
        $uo = $CI->adminlib->get_unit_officer_id();
        $suprd = $CI->adminlib->get_suprd_id();
        $senior_fo = $CI->adminlib->get_fo_id();
        $accnts_ofcr = $CI->adminlib->get_ao_id();
        $adge = $CI->adminlib->get_adge_id();
        $jd = $CI->adminlib->get_jd_id();
        return  array($suprd,$uo,$senior_fo,$accnts_ofcr,$adge,$jd);
    }
    
    function get_design_name(){
        $CI = &get_instance();
        return $CI->session->userdata('designation_name');
    }
    function get_ioc_setting_access_dge_office(){
        $CI = &get_instance();
        $designation = $CI->session->userdata('designation_name');
        if($designation == "ADGE" || $designation == "DGE" || $designation == "Joint Director" 
                || $designation == "Senior Finance Officer"){
            return true;
        }else{
            return false;
        }
    }
    function getIOCActionPermissionDGE($role_id=NULL){

    $CI = &get_instance();
    $CI->load->library('adminlib');
    $adge = $CI->adminlib->get_adge_id();
//    $aeo_full_addition = $CI->adminlib->get_aeo_full_addition_id();
    $dge = $CI->adminlib->get_dge_id();
    $jd = $CI->adminlib->get_jd_id();
    
    $adgePermissions = array($adge,$dge,$jd);

    $dge_office_id = $CI->adminlib->get_dge_office_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();

    $permitted = 0;
    if( (in_array($role_id, $adgePermissions)) && ($master_officeid == $dge_office_id))
        $permitted = 1;
    return $permitted;
}

function getInitFilePermissionIOC_DGE($role_id=NULL){
    $CI   = &get_instance();
    $CI->load->library('adminlib'); 
    $dge  = $CI->adminlib->get_dge_id();
    $adge = $CI->adminlib->get_adge_id();
    $jd   = $CI->adminlib->get_jd_id();
    $tapal_supd = $CI->adminlib->get_suprd_id();
    $block = $CI->session->userdata('office_block_id');    
    $master_officeid = $CI->adminlib->get_master_office_id();
    $dge_office_id = $CI->adminlib->get_dge_office_id();
    if($block == TAPAL_BLOCK){
        $permissions = array($dge,$adge,$jd,$tapal_supd);
    }else{
        $permissions = array($dge,$adge,$jd);
    }
    
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();
    
    $permitted = 0;
    if( (in_array($role_id, $permissions)) && ($master_officeid == $dge_office_id))
        $permitted = 1;
    return $permitted;
    
}

function ADPI_ACADEMIC_UERGROUP_ID(){
    return 276;
}
function ADPI_GENERAL_UERGROUP_ID(){
    return 247;
}
function JD_UERGROUP_ID(){
    return 241;
}
function master_office(){
    $CI = & get_instance();
    return $CI->session->userdata('office_id');
}
    function getAppointeeNameFromAudit($aud_req_id){
        $CI = &get_instance();
        $root_file_id = getRootRequestIDFromAudit($aud_req_id);
        $appt_name = @$CI->General->getrow("AASF_Request R","appointee_name",array('R.id'=>$root_file_id))->appointee_name;
        return $appt_name;
    }
function isRemarkFile($req_type){
    switch ($req_type) {
        case REQ_TYPE_APL_REMARK:
        case REQ_TYPE_REV_REMARK:
        case REQ_TYPE_REAPL_REMARK_AEO_DEO:
        case REQ_TYPE_REAPL_REMARK_DDE:
        case REQ_TYPE_REAPL_REMARK_H_SECTION:
        case REQ_TYPE_REAPL_REMARK_SUPERCHECKCELL:
        case REQ_TYPE_REAPL_REMARK_LAW_OFFICE:
        case REQ_TYPE_AUDIT_REMARK:
        case REQ_TYPE_ADDLPOST_REMARK:
            $is_remark = 1;
            break;
        
        default:
            $is_remark = 0;
            break;
    }
    return $is_remark;
}
function clean($string) {
   $string = strtolower($string);
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function get_appointment_register_flag($val){    
    if($val == 1){
        return "Approval by this office";
    }else if($val == 2){
        return "Appeal";
    }else if($val == 3){
        return "Revision Appeal";
    }else if($val == 4){
        return "Govt Appeal";
    }else if($val == 5){
        return "Court order";
    }else if($val == 6){
        return "Others";
    }
}

function getAppealIDFromAARequestID($request_id,$status,$revision_appeal=NULL){
    $CI = &get_instance();
    $CI->db->select('ref.request_appeal_id');
    $CI->db->join('appeal_request_ref as ref', 'ref.request_appeal_id = APL.id');
    $CI->db->where('ref.request_id', $request_id);
//    $CI->db->where("APL.file_status","Rejected");
    $CI->db->join('AASF_Request_Head as RH', 'RH.id = APL.id');
    $CI->db->join('appeal as a', 'a.appeal_id = APL.appeal_id');
    if($revision_appeal == 1){
        $CI->db->where('a.is_revision_appeal',1);
    }else{
        $CI->db->where('a.is_revision_appeal',NULL);
    }
    $id = $CI->db->get('AASF_Request_Appeal_AA APL')->result_array();
    return $id;
}

function hasDGEAuditBlock(){
    $CI   = &get_instance();
    $CI->load->library('adminlib'); 
    $block  = $CI->adminlib->get_office_block_id();
    if($block == AUDIT_BLOCK_DGE){
        $res = true;
    }else{
        $res = false;
    }
    return $res;
}

function getRequestTypeFromDraftId($draft_id){
    $CI   = &get_instance();
    $req_id = $CI->General->getrow('AASF_Draft_Notes', 'request_id', array('id' => $draft_id))->request_id;
    $req_type = getRequestType($req_id);
    return $req_type;
}

function FileStatus($request_id, $reqType, $status){
    $CI = &get_instance();
    $CI->db->select('count(*) as cnt');
    $CI->db->join('AASF_Request_Head as RQ', 'RQ.id = WF.request_id');
    $CI->db->where('WF.request_id', $request_id);
    $CI->db->where('RQ.req_type', $reqType);
    $CI->db->where('WF.wf_status', $status);
    $CI->db->where('WF.is_file_in_hand', 1);
    $count = $CI->db->get('AASF_work_flow WF')->row('cnt');
    return $count;
}
function getIOCRequestID($iocid){
    $CI = &get_instance();
    $CI->db->select('request_id');
    $CI->db->where("ioc_id",$iocid);
    $request_id = $CI->db->get('AASF_Request_Communications RC')->row('request_id');
    return $request_id;
}
function getSchoolCode($school_id){
    $CI = &get_instance();
    return $CI->General->getrow('schools','school_code',array("id"=>$school_id),'')->school_code;
}
function getSchoolID($school_code){
    $CI = &get_instance();
    return $CI->General->getrow('schools','id',array("school_code"=>$school_code,'is_active'=>1),'')->id;
}
function getPreviousSchoolID($school_id){
    $CI = &get_instance();
    $school_code = getSchoolCode($school_id);
    return $CI->General->getrow('schools','id',array("school_code"=>$school_code,'is_active'=>0),'')->id;
}
function isCurrentTenure($start_date, $end_date = NULL){
    $is_current = 0;
    $now = time();
    if($end_date == '' || $end_date == NULL){
        $end_date = NULL;
        $start_date .= ' 00:00:00';
        if(strtotime($start_date) <= $now ) {
            $is_current = 1;
        }
    }
    if($end_date != NULL){
        $end_date .= ' 23:59:59';
        if(strtotime($end_date) >= $now && strtotime($start_date) <= $now) {
            // future date
            $is_current = 1;
        }
    }
    return $is_current;
}
function isCurrentTenureManager(){
    $CI = &get_instance();
    $is_current_tenure  =   0;
    $userType = $CI->adminlib->get_user_type();
    if ($userType == 'MANAGER') {
        $managementID = $CI->adminlib->get_management_id();
        $current_tenure_mgr         = $CI->MGM->getPresentTenureManagerByManagement($managementID);
        if(isset($current_tenure_mgr)){
            if($current_tenure_mgr->manager_id == $CI->session->userdata('user_id')){
                $is_current_tenure  = 1;
            }
        }
    }
    return $is_current_tenure;
}

//Digital Signature Start

function hasDigitallySigned($draft_id){
    $CI = &get_instance();
    return $CI->General->getrow('AASF_Draft_Notes','is_digitally_signed',array("id"=>$draft_id),'')->is_digitally_signed;
}

// function loginRequest($username,$password){
//     $headers = array();
//     $response = curl_request(DSIGN_URL.'index.php/api/login',array('email'=>$username,'password'=>$password),$headers);

//     $responseArray=json_decode($response);
//     if(!isset($responseArray->access_token)){
//       header('Content-Type: application/json');
//       echo $responseArray;
//     }
    
//     return $responseArray;     
// }

function getDSignCertificate(){
    // $ci = &get_instance();
    // $ci->load->library('adminlib');
    // $token = $ci->adminlib->get_acess_token();
    // $user_id = $ci->adminlib->get_user_id();
    //$app_name = APPLICATION_NAME;
    // $post=array(
    //     'user_id'=>$user_id,
    //     'application_name'=> $app_name
    // );
    // $post=json_encode($post);
    // $headers = array();
    // $headers[] = $token;
    // $headers[] = 'Content-Type: application/json';
    // $res = curl_request(DSIGN_URL.'index.php/api/getCertificate',$post,$headers);
    // $response = json_decode($res); 
    $CI = &get_instance();
    $CI->load->model('CommonModel', 'CM');
    $app_name = APPLICATION_NAME;
    $user_id = $CI->adminlib->get_user_id();
    $response = $CI->CM->getCertificate($user_id,$app_name);

    
    return $response;
}

// function curl_request($url, $post = false, $header = false)
// {
//     $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 1);

// curl_setopt($curl_handle, CURLOPT_URL, $host . '/index.php/api/authenticateUser/format/json');
//                     curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
//                     curl_setopt($curl_handle, CURLOPT_POST, 1);
//                     curl_setopt($curl_handle, CURLOPT_POSTFIELDS,$post_array);
//                     curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
//             curl_setopt($curl_handle,CURLOPT_SSL_VERIFYHOST, 1);




// curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// // echo '<pre>'; print_r($result); die;
// curl_close($ch);
// return $result;
// }

function curl_request($url, $post = false, $header = false)
{
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
//curl_setopt($crl, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
$info = curl_getinfo($ch);
// echo '<pre>'; print_r($info);
if (curl_errno($ch)) {
	//print_r('Curl error: ' . curl_error($ch));
	echo 'Error:' . curl_error($ch);
}
//echo '<pre>'; print_r($result); die;
curl_close($ch);
return $result;
}

function hasDSignRegistered(){
    $ci = &get_instance();
    return $ci->session->userdata('dsign_registered');
}

//Digital Signature End


function isAuditHSectionRemarksFile($req_id){//Remarks file id
    $CI = &get_instance();
    return $CI->General->getrow('AASF_Request_Audit_Remarks','file_type',array('id'=>$req_id))->file_type;
}
function isActionPermissionEnabled($req_type,$action_type){//type 1 = is_action_permitted, 2 = is_proceedings_approval_permitted,3 = is_letter_approval_permitted
    $CI = &get_instance();
    $role = $CI->session->userdata('designation_id');
    $master_office = $CI->session->userdata('office_id');

    switch ($action_type) {
        case 1:
            $column = 'is_action_permitted';
            break;
        case 2:
            $column = 'is_proceedings_approval_permitted';
            break;
        case 3:
            $column = 'is_letter_approval_permitted';
            break;
    }
    return $CI->General->getrow('action_permission',$column,array('role_id'=>$role,'master_office_id'=>$master_office,'req_type'=>$req_type))->$column;
}
 function getIOCRoleID_SEC(){
        $CI = &get_instance();
        $CI->load->library('adminlib');
        $suprd           = $CI->adminlib->get_suprd_id();
        $sec_asst        = $CI->adminlib->sec_asst_id();
        $under_sec       = $CI->adminlib->under_sec_id();
        $deputy_sec      = $CI->adminlib->deputy_sec_id();
        $joint_sec       = $CI->adminlib->joint_sec_id();
        $additional_sec  = $CI->adminlib->additional_sec_id();
        $sec             = $CI->adminlib->secretary_id();
        $special_sec     = $CI->adminlib->special_sec_id();
        return  array($suprd,$sec_asst,$under_sec,$deputy_sec,$joint_sec,$additional_sec,$sec,$special_sec);
 }
  function get_ioc_setting_access_sec_office(){
        $CI = &get_instance();
        $designation = $CI->session->userdata('designation_name');
        if($designation == "SUPERINTENDENT"){
            return true;
        }else{
            return false;
        }
    }
    
    function getInitFilePermissionIOC_SEC($role_id=NULL){
    $CI   = &get_instance();
    $CI->load->library('adminlib'); 
    $suprd           = $CI->adminlib->get_suprd_id();
    $sec_asst        = $CI->adminlib->sec_asst_id();
    $under_sec       = $CI->adminlib->under_sec_id();
    $deputy_sec      = $CI->adminlib->deputy_sec_id();
    $joint_sec       = $CI->adminlib->joint_sec_id();
    $additional_sec  = $CI->adminlib->additional_sec_id();
    $sec             = $CI->adminlib->secretary_id();
    $special_sec     = $CI->adminlib->special_sec_id();
    $master_officeid = $CI->adminlib->get_master_office_id();
    $sec_office_id   = $CI->adminlib->get_sec_office_id();
    $permissions = array($suprd,$sec_asst,$under_sec,$deputy_sec,$joint_sec,$additional_sec,$sec,$special_sec);
        
    if($role_id == NULL)
        $role_id = $CI->adminlib->get_role_id();
    
    $permitted = 0;
    if( (in_array($role_id, $permissions)) && ($master_officeid == $sec_office_id))
        $permitted = 1;
    return $permitted;
    
}

  function hasIOCApprovalPermission($role_id=NULL,$office_id=NULL,$master_officeid=NULL){
         
         $total = 0;
         $CI    = &get_instance();
         if($role_id == NULL)
          $role_id   = $CI->adminlib->get_role_id();
         if($office_id == NULL)
          $office_id = $CI->adminlib->get_office_id();
         if($master_officeid == NULL)
          $master_officeid = $CI->adminlib->get_master_office_id();  
         
         $CI->db->select("count(*) as total");
         $CI->db->where("accessible_to_role_id",$role_id);         
         $CI->db->where("created_office_id",$office_id);
         $CI->db->where("created_by_master_office_id",$master_officeid);
         $CI->db->where('setid',1);
         $total = $CI->db->get("ioc_settings")->row("total");
         return $total;
    }
    
    function checkHigherAuthority($oldusergroup,$masteroffice=NULL){
        
//        SELECT count(*) as total FROM `rbac_group` as r1
//left join rbac_group as r2 on r2.id = r1.parent_id
//left join rbac_group as r3 on r3.id = r2.parent_id
//left join rbac_group as r4 on r4.id = r3.parent_id
//left join rbac_group as r5 on r5.id = r4.parent_id
//WHERE r1.id = 248 and 247 in (r1.parent_id,r2.parent_id,r3.parent_id,r4.parent_id)
         $CI           = &get_instance();
        if($masteroffice == NULL)
          $masteroffice = $CI->adminlib->get_master_office_id();  
        
        $currentGroup = $CI->session->userdata('usergroup_id');       
        $parent_ids = array();
        $CI->db->select('count(*) as total');
        $CI->db->from('rbac_group as r1');
        $CI->db->join('rbac_group as r2','r2.id = r1.parent_id','left');
        $CI->db->join('rbac_group as r3','r3.id = r2.parent_id','left');
        $CI->db->join('rbac_group as r4','r4.id = r3.parent_id','left');
        $CI->db->join('rbac_group as r5','r5.id = r4.parent_id','left');        
        $CI->db->where('r1.office_id', $masteroffice);
        $CI->db->where('r1.id',$oldusergroup);
        $where = " ".$currentGroup." IN(r1.parent_id,r2.parent_id,r3.parent_id,r4.parent_id,r5.parent_id) ";
        $CI->db->where($where);
        $total = $CI->db->get()->row('total');
        
        if($total > 0){
            return 1;
        }else{
            return 0;
        }
      
    }
    
    function checkLastTookOver($applId){
        $CI           = &get_instance();
        $CI->db->select('count(*) as total');
        $CI->db->from('AASF_work_flow');
        $CI->db->where('request_id',$applId);
        $CI->db->where('mov_status',45);
        $total = $CI->db->get()->row('total');
        if($total > 0){
             $CI->db->select('MAX(id) as id');
             $CI->db->from('AASF_work_flow');
             $CI->db->where('request_id',$applId);
             $id = $CI->db->get()->row('id');
             
             $CI->db->select('mov_status');
             $CI->db->from('AASF_work_flow');
             $CI->db->where('request_id',$applId);
             $CI->db->where('id <',$id);
             $CI->db->limit(1);
             $mov_status = $CI->db->get()->row('mov_status');
             if($mov_status == 45){
                 return 0;
             }else{
                 return 1;
             }
        }else{
            return 1;
        }
    }

function isSecretariat(){
    $CI = &get_instance();
    if($CI->session->userdata('office_id') == SEC_OFFICE)        
        return 1;
    else
        return 0;
}


function encrypt($id){
    $CI = &get_instance();
    $CI->encryption->initialize(array('cipher' => 'aes-128','mode' => 'ctr','key' => 'fixation'));
    $ciphertext     = bin2hex($CI->encryption->encrypt($id));
    return $ciphertext;
}

function decrypt($id){
    $CI = &get_instance();
    $CI->encryption->initialize(array('cipher' => 'aes-128','mode' => 'ctr','key' => 'fixation'));
    $ciphertext     = $CI->encryption->decrypt(hex2bin($id));
    return $ciphertext;
}
function isGovAppealRemarks($req_id){
    $CI = &get_instance();
    $type = $CI->General->getrow('AASF_Request_Appeal_Remarks','type',array('id'=>$req_id))->type;
    if($type == 1)
        return true;
    else
        return false;
}

function isDDEOffice(){
    $CI = &get_instance();
    if($CI->session->userdata('office_id') == DDE_OFFICE)        
        return 1;
    else
        return 0;
}
function isDEOOffice(){
    $CI = &get_instance();
    if($CI->session->userdata('office_id') == DEO_OFFICE)        
        return 1;
    else
        return 0;
}

function isAEOOffice(){
    $CI = &get_instance();
    if($CI->session->userdata('office_id') == AEO_OFFICE)        
        return 1;
    else
        return 0;
}

function isMANAGEROffice(){ 
     $CI = &get_instance();
    if($CI->session->userdata('office_id') == MANAGER_OFFICE)        
        return 1;
    else
        return 0;
}  
function isHM(){
    $CI = &get_instance();
    $userType = $CI->adminlib->get_user_type();
    if($userType == 5)        
        return 1;
    else
        return 0;
} 
function isInterDistrict($req_id){//Checks the Teachers Bank File is Inter Dist
    $CI = &get_instance();
    $type = $CI->General->getrow('AASF_Request_TeachersBank','Type',array('id'=>$req_id))->Type;
    if($type == 2)
        return true;
    else
        return false;
}

function dge_office_blocks(){
    return array(NO_BLOCK,RA_BLOCK,H_BLOCK,G_BLOCK,E_BLOCK,F_BLOCK,EC_BLOCK,ET_BLOCK,EM_BLOCK,TAPAL_BLOCK,AUDIT_BLOCK_DGE);
}

function get_module_type($requestID){
    $CI = &get_instance();
    $appealID = $CI->General->getrow('AASF_Request_Appeal_Remarks','appeal_id',array('id'=>$requestID))->appeal_id;
    if($appealID > 0){
       $module_type = $CI->General->getrow('appeal','module_type',array('appeal_id'=>$appealID))->module_type;
    }
    
    return $module_type;
}

function write_action_notification($data){
    $CI = &get_instance();
    $CI->load->model('NotificationsModel', 'NM');
    $notificationData = $CI->NM->save_ActionNotifications($data);
    return $notificationData;
}

function getfileno_byRequestID($requestId,$request_type=NULL){
       $tbl = "";
    if($request_type == NULL){
       $request_type = getRequestType($requestId);
    }
    switch($request_type){
        case REQ_TYPE_AA:                          $tbl = "AASF_Request";                     break;
        case REQ_TYPE_SF:                          $tbl = "AASF_Request_SF";                  break;
        case REQ_TYPE_APL:                         $tbl = "AASF_Request_Appeal";              break;
        case REQ_TYPE_REV:                         $tbl = "AASF_Request_Revision";            break;
        case REQ_TYPE_APL_AA:                      $tbl = "AASF_Request_Appeal_AA";           break;
        case REQ_TYPE_AUD:                         $tbl = "AASF_Request_Audit";               break;
        case REQ_TYPE_PA:                          $tbl = "AASF_Request_Personal_Audit";      break;
        case REQ_TYPE_TBANK:                       $tbl = "AASF_Request_TeachersBank";        break;
//        case REQ_TYPE_MODIFICATION:                $tbl = "AASF_Request_Modification";        break;
        case REQ_TYPE_ADDL_POST_PROPOSAL:          $tbl = 'AASF_Request_Addl_Proposal';       break;
        case REQ_TYPE_APL_REMARK:                  $tbl = "AASF_Request_Appeal_Remarks";      break;
        case REQ_TYPE_REV_REMARK:                  $tbl = "AASF_Request_Review_Remarks";      break;
        case REQ_TYPE_REAPL_REMARK_AEO_DEO:        $tbl = "AASF_Request_Appeal_Remarks";      break;
        case REQ_TYPE_REAPL_REMARK_DDE:            $tbl = "AASF_Request_Appeal_Remarks";      break;
        case REQ_TYPE_REAPL_REMARK_H_SECTION:      $tbl = "AASF_Request_Appeal_Remarks";      break;
        case REQ_TYPE_REAPL_REMARK_SUPERCHECKCELL: $tbl = "AASF_Request_Appeal_Remarks";      break;
        case REQ_TYPE_REAPL_REMARK_LAW_OFFICE:     $tbl = "AASF_Request_Appeal_Remarks";      break;
        case REQ_TYPE_COMMUNICATION:               $tbl = "AASF_Request_Communications";      break;
        case REQ_TYPE_AUDIT_REMARK:                $tbl = "AASF_Request_Audit_Remarks";       break;
        case REQ_TYPE_GOV_REMARK:                  $tbl = "AASF_Request_Appeal_Remarks";      break;
        case REQ_TYPE_TBANK_REMARK:                $tbl = "AASF_Request_TeacherBank_Remarks"; break;
        default:                                   $tbl = "AASF_Request";                     break;
    }
    $CI       = &get_instance();
    if($tbl){
        if($request_type == REQ_TYPE_COMMUNICATION){
            $fileno = $CI->General->getrow($tbl,'file_number',array('request_id'=>$requestId))->file_number; 
        }else{
            $fileno = $CI->General->getrow($tbl,'file_number',array('id'=>$requestId))->file_number;
        }
    }
    return $fileno;
}

function getActionNotifications($userId) {
    $CI = &get_instance();
    $CI->load->library('adminlib');
    $CI->load->model('NotificationsModel', 'NM');
    $master_officeid  = $CI->adminlib->get_master_office_id();
    $officeid         = $CI->adminlib->get_office_id();   
    $office_block_id  = $CI->adminlib->get_office_block_id();
    $usergroup_id     = $CI->adminlib->get_user_group_id();
    $notificationData = $CI->NM->getActionNotifications($userId,$master_officeid,$officeid,$office_block_id,$usergroup_id);
    return $notificationData;
}

function geturl($request_id,$request_type){
    $CI = &get_instance();
    $url  = "";
    $encr = strtr($CI->encryption->encrypt($request_id), array('+' => '.', '=' => '-', '/' => '~'));
    if($request_type == 1){
        $url = base_url() . 'index.php/secured_user/Dashboard/getSelectedapplicationview/'.$encr.'/1';
    }
    return $url;
}

function getencr($request_id){
    $CI = &get_instance();
    $encr = strtr($CI->encryption->encrypt($request_id), array('+' => '.', '=' => '-', '/' => '~'));
    return $encr;
}

function get_master_office_name($master_office_id){
    $returnStr = "";
          if($master_office_id == DGE_OFFICE){
        $returnStr = "DGE Office";
    }else if($master_office_id == DDE_OFFICE){
        $returnStr = "DDE";
    }else if($master_office_id == DEO_OFFICE){
        $returnStr = "DEO";
    }else if($master_office_id == AEO_OFFICE){
        $returnStr = "AEO";
    }else if($master_office_id == 1008){
        $returnStr = "High School";
    }else if($master_office_id == 1010){
        $returnStr = "UP School";
    }else if($master_office_id == 1011){
        $returnStr = "LP School";
    }else if($master_office_id == MANAGER_OFFICE){
        $returnStr = "School Manager";
    }else if($master_office_id == ADMIN_OFFICE){
        $returnStr = "Admin Office";
    }else if($master_office_id == SUPER_CHECK_OFFICE){
        $returnStr = "Super Check Cell";
    }else if($master_office_id == LAW_OFFICE){
        $returnStr = "LAW Office";
    }else if($master_office_id == SEC_OFFICE){
        $returnStr = "Secretariat";
    }    
    return $returnStr;
}

function get_office_name($master_office_id,$officeid){
    $returnStr = "";
    $CI        = &get_instance();
    if($officeid > 0){
              if($master_office_id == DDE_OFFICE){            
            $returnStr = $CI->General->getrow('master_district','district_name',array('district_code'=>$officeid))->district_name;
        }else if($master_office_id == DEO_OFFICE){
            $returnStr = $CI->General->getrow('master_edudistricts','edu_district_name',array('id'=>$officeid))->edu_district_name;
        }else if($master_office_id == AEO_OFFICE){
            $returnStr = $CI->General->getrow('master_subdistricts','sub_district_name',array('id'=>$officeid))->sub_district_name;
        }else if(in_array($master_office_id,array(1008,1010,1011))){
            $r = $CI->General->getrow('master_schools','school_code,school_name',array('id'=>$officeid));
            $returnStr = $r->school_code." - ".$r->school_name;
        }else if($master_office_id == MANAGER_OFFICE){
            $returnStr = $CI->General->getrow('AASF_Management','mngmnt_name',array('id'=>$officeid));
        }        
    }    
    return $returnStr;
}

function isCAPermission(){
    $CI        = &get_instance();
    if($CI->adminlib->get_role_id() == $CI->adminlib->get_ca_id())
        return true;
    else    
        return false;
}

function getManagerOfficeByRequestID($requestID){
    $CI               = &get_instance();
    $managementID     = 0;
    $school_id        = 0;
    if($requestID > 0){
        $school_id    = $CI->General->getrow('AASF_Request_Head','school_id',array('id'=>$requestID))->school_id;
    }
    if($school_id > 0){
        $managementID = $CI->General->getrow('school_details','mngment_id',array('school_id'=>$school_id))->mngment_id;
    }
    return $managementID;
}

function getRoot_fileno_byRequestID($requestId,$request_type=NULL){ 
    $tbl = "";
    if($request_type == NULL){
       $request_type = getRequestType($requestId);
    }
    switch($request_type){
        case REQ_TYPE_AA: $tbl = "AASF_Request";     break;
        case REQ_TYPE_SF: $tbl = "AASF_Request_SF";  break;
    }
    $CI            = &get_instance();
    $rootRequestId = 0;
    if($request_type == REQ_TYPE_COMMUNICATION){
             $fileno = $CI->General->getrow($tbl,'file_number',array('request_id'=>$requestId))->file_number; 
    }else{
        if($request_type == REQ_TYPE_AA || $request_type == REQ_TYPE_SF){
             $fileno = $CI->General->getrow($tbl,'file_number',array('id'=>$requestId))->file_number;
        }else if($request_type == REQ_TYPE_APL){
             $rootRequestId = getSFRequestIDFromAppealRequest($requestId,REQ_TYPE_APL);
             $fileno = $CI->General->getrow('AASF_Request_SF','file_number',array('id'=>$rootRequestId))->file_number;
        }else if($request_type == REQ_TYPE_APL_AA){
             $rootRequestId = getSFRequestIDFromAppealRequest($requestId,REQ_TYPE_APL_AA);
             $fileno = $CI->General->getrow('AASF_Request','file_number',array('id'=>$rootRequestId))->file_number;
        }                        
    }    
    return $fileno;
}

function getNotificationString($notify,$type = NULL){ // for manager    
        $return_string  = "";                
        if ($notify['master_actions_id'] == 500) { // proceedings
            $return_string  =  $notify['first_name'].' ('.$notify['designation'].') ';       
            $return_string .= "(".notify_get_ofc_name($notify).") ";                     
//            if($notify['message'] == " File Revised Proceedings Approved"){
//                $return_string .= 'has issued the Revised Proceedings of ';
//            }else{
                $return_string .= 'has issued the Proceedings of ';
//            }
            $return_string .= notify_file_type($notify);        
            if($type == 'DASHBOARD_CONTENT'){
                  $return_string .= notify_file_string($notify);          
            }else{
                  $return_string .= $notify['file_no'];
            }
        }if ($notify['master_actions_id'] == 501) { //new file
            $return_string  =  $notify['first_name'].' ('.$notify['designation'].') ';       
            $return_string .= "(".notify_get_ofc_name($notify).") ";   
            $return_string .= 'has taken the ';                       
            $return_string .= notify_file_type($notify);        
            if($type == 'DASHBOARD_CONTENT'){
                  $return_string .= notify_file_string($notify);          
            }else{
                  $return_string .= $notify['file_no'];
            }
            $return_string   .= " for Processing";
        }
        if ($notify['master_actions_id'] == 502) { // aa submission
            $return_string   .= " You have submitted an ";
            if($type == 'DASHBOARD_CONTENT'){
             $return_string .= notify_file_string($notify); 
            }else{
              $return_string .= " Appointment Approval File ";   
            }
            $return_string   .= " to ".notify_get_ofc_name($notify);
        }
        if($notify['master_actions_id'] == 503){
            $return_string  = "A Hearing Letter has been approved for the ";
            $return_string .= notify_file_type($notify);
            if($type == 'DASHBOARD_CONTENT'){
                  $return_string .= notify_file_string($notify);          
            }else{
                  $return_string .= $notify['file_no'];
            }
            $return_string .= " by ".$notify['first_name'].' ('.$notify['designation'].') ';       
            $return_string .= "(".notify_get_ofc_name($notify).") ";   
        }
        if ($notify['master_actions_id'] == 504) { // aa submission
            
            if($type == 'DASHBOARD_CONTENT'){
             $return_string .= notify_file_string($notify)." ".$notify['message']; 
            }else{
              $return_string .= " Appointment Approval File ".$notify['message'];   
            }
            $return_string   .= " by ".$notify['first_name'].' ('.$notify['designation'].') ';       
            $return_string   .= "(".notify_get_ofc_name($notify).") ";
        }
        if($notify['request_type'] == REQ_TYPE_COMMUNICATION){
            $notify['message'] = str_replace('from', 'from '.$notify['first_name'].' ('.$notify['designation'].')', $notify['message']);
            if($type == 'DASHBOARD_CONTENT'){
                if ($notify['url'] != "") {
                    $url = base_url() . 'index.php/' . $notify['url'];                    
                    $return_string =  "<a href=".$url.">".$notify['file_type']." </a> ".$notify['message']."";                   
                }
            }else{
                $return_string = "IOC ".$notify['message'];
            }
        }
                                
        $return_string .= ' ('.findElapsedTime($notify['created_at']).').';  
        if((strtotime($notify['created_at']) > strtotime('-60 minutes',strtotime(date('Y-m-d H:i:s')))) 
            && $type == 'DASHBOARD_CONTENT'){
               $return_string .= '<img src="'.base_url().'assets/images/latestNew.gif" class="new_one_in_recent_updates"></img>';
        }
        return $return_string;        
}

function notify_get_ofc_name($notify){
    $return = "";
    if ($notify['master_officeid'] == DDE_OFFICE) {
        $return = 'DDE '.$notify['district_name'];
    } else if ($notify['master_officeid'] == DEO_OFFICE) {
        $return = 'DEO '.$notify['edu_district_name'];
    } else if ($notify['master_officeid'] == AEO_OFFICE) {
        $return = 'AEO '.$notify['sub_district_name'];
    } else if ($notify['master_officeid'] == DGE_OFFICE) {
        $return = 'DGE Office';
    }
    return $return;
}

function notify_file_type($notify){
    $return = "";
    if ($notify['file_type'] == "A.A.") {
        $return = '<b>Appointment Approval</b> ';
    } else if ($notify['file_type'] == "S.F.") {
        $return = '<b>Staff Fixation</b> ';
    } else {
        $return = '<b>'.$notify['file_type'].'</b> ';
    }
    return $return;
}

function notify_file_string($notify){ //manager
      $return  = "";
      $ss = "'".encrypt($notify['request_id'])."'";   
      if($notify['master_actions_id'] == 500){ //proceedings
          $return .= 'File No. ';
          if($notify['request_type'] == REQ_TYPE_AA){
              $return .= '<a href="#" onclick="getSelectedapplication(0,'.$notify['school_id'].','.$ss.');" data-toggle="modal" data-target="#myModal">'.$notify['file_no'].'</a>';
          }else if($notify['request_type'] == REQ_TYPE_SF){
              $academic_id = getacademic_id($notify['year']);
              $return .= '<a href="#" onclick="getsummary('.$notify['school_id'].','.$academic_id.');" data-toggle="modal" data-target="#summarymodal" id="anchor" data-name="'.$notify['school_id'].'">'.$notify['file_no'].'</a>';
          }else if($notify['request_type'] == REQ_TYPE_APL){
              $return .= '<a href="#" onclick="PopUpViewAppeals('.$notify['request_id'].');">'.$notify['file_no'].'</a>';
              $return .= ', '.$notify['school_name'].' ';
          }else if($notify['request_type'] == REQ_TYPE_APL_AA){
              $return .= '<a href="#" onclick="PopUpViewAppeals('.$notify['request_id'].');">'.$notify['file_no'].'</a>';              
              $return .= ', '.$notify['school_name'].' ';
          }else{
              $return .= $notify['file_no'];
          } 
      }else if($notify['master_actions_id'] == 501 || $notify['master_actions_id'] == 503){ // taken & hearing
          if($notify['request_type'] == REQ_TYPE_AA){
              $return .= 'File No. ';
              $return .= '<a href="#" onclick="getSelectedapplication(0,'.$notify['school_id'].','.$ss.');" data-toggle="modal" data-target="#myModal">'.$notify['file_no'].'</a>';
          }else if($notify['request_type'] == REQ_TYPE_SF){
              $return .= 'File No.'.$notify['file_no'];
              $return .= ', '.$notify['school_name'].' ';
          }else if($notify['request_type'] == REQ_TYPE_APL){
              $return .= 'File No.';
              $return .= '<a href="#" onclick="PopUpViewAppeals('.$notify['request_id'].');">'.$notify['file_no'].'</a>';
              $return .= ', '.$notify['school_name'].' ';
          }else if($notify['request_type'] == REQ_TYPE_APL_AA){
              $return .= 'File No.';
              $return .= '<a href="#" onclick="PopUpViewAppeals('.$notify['request_id'].');">'.$notify['file_no'].'</a>';              
              $return .= ', '.$notify['school_name'].' ';
          }else{
              $return .= 'File No. ';
              $return .= $notify['file_no'];
          } 
      }else if($notify['master_actions_id'] == 502){ // aa submission
          if($notify['request_type'] == REQ_TYPE_AA){
              $return .= '<a href="#" onclick="getSelectedapplication(0,'.$notify['school_id'].','.$ss.');" data-toggle="modal" data-target="#myModal">Appointment Approval File</a>';
          }
      }else if($notify['master_actions_id'] == 504){ //redirection
           if($notify['request_type'] == REQ_TYPE_AA){
              $return .= '<a href="#" onclick="getSelectedapplication(0,'.$notify['school_id'].','.$ss.');" data-toggle="modal" data-target="#myModal">Appointment Approval File</a>';
          }
      }
      return $return;
}

function getProcessingOffice($requestId){
    $CI  = &get_instance();
    $tmp = $CI->General->getrow('AASF_work_flow','master_officeid,office_id',array('request_id'=>$requestId));
    $ofc = get_master_office_name($tmp->master_officeid)." ".get_office_name($tmp->master_officeid,$tmp->office_id);
    return $ofc;
}

function CA_GENERAL_USERGROUP_ID(){
    return 313;
}

function CA_ACADEMIC_USERGROUP_ID(){
    return 314;
}

function CA_RA_USERGROUP_ID(){
    return 312;
}

function user_block(){
    $CI = & get_instance();
    return $CI->session->userdata('office_block_id');
}

function get_label_dropdown($request_id=NULL){
    
    $CI     = & get_instance();
    $labels = $CI->General->prepare_select_box_data('label_master','id, label_name', array('is_active' => 1), false, 'id', '');
    return $labels;
}

function get_labelled_files($req_id){
            $CI     = & get_instance();
            $CI->load->model('LabelModel', 'LBM');
            $labelled_files = $CI->LBM->get_labelled_files(NULL,NULL,$req_id);
            $labels         = $CI->LBM->label_master();
            $return_string  = "";
            $i = 0;
            if(count($labelled_files[$req_id])>0){    
                foreach($labelled_files[$req_id] as $row){                                
                    $return_string .= $labels[$row['label_id']].TAG_IMAGE;
                    if(($i+1) != count($labelled_files[$req_id])){
                        $return_string .= ",";
                    }
                    $i++;
                }
            } 
            
            return $return_string;
}

function getAppointeeNameByPEN($pen){
    $CI     = & get_instance();
    $name   = $CI->General->getrow('staff_master','name', array('PEN' => $pen))->name;
    return $name;
}
function checkSameOffice($office,$masteroffice){
    $CI     = & get_instance();
    $current_master_officeid = $CI->adminlib->get_master_office_id();
    $current_office_id = $CI->adminlib->get_office_id();
    if($current_master_officeid == $masteroffice && $current_office_id == $office){
        return true;
    }else{
        return false;
    }
}
function getDeviceDetails(){
     // $proxy="";
     $data = array();
     $protocol = $_SERVER['SERVER_PROTOCOL'];
     $ip = $_SERVER['REMOTE_ADDR'];
     $port = $_SERVER['REMOTE_PORT'];
     $agent = $_SERVER['HTTP_USER_AGENT'];
     $ref = $_SERVER['HTTP_REFERER'];
     $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); 
     if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $proxy= $_SERVER['HTTP_X_FORWARDED_FOR'];
      $user_agent = $_SERVER['HTTP_USER_AGENT'];
      $os_platform    = "Unknown OS Platform";
      $os_array       = array('/Windows NT 10.0/i'    =>  'Windows 10',
                              '/windows phone 8/i'    =>  'Windows Phone 8',
                              '/windows phone os 7/i' =>  'Windows Phone 7',
                              '/windows nt 6.3/i'     =>  'Windows 8.1',
                              '/windows nt 6.2/i'     =>  'Windows 8',
                              '/windows nt 6.1/i'     =>  'Windows 7',
                              '/windows nt 6.0/i'     =>  'Windows Vista',
                              '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                              '/windows nt 5.1/i'     =>  'Windows XP',
                              '/windows xp/i'         =>  'Windows XP',
                              '/windows nt 5.0/i'     =>  'Windows 2000',
                              '/windows me/i'         =>  'Windows ME',
                              '/win98/i'              =>  'Windows 98',
                              '/win95/i'              =>  'Windows 95',
                              '/win16/i'              =>  'Windows 3.11',
                              '/macintosh|mac os x/i' =>  'Mac OS X',
                              '/mac_powerpc/i'        =>  'Mac OS 9',
                              '/linux/i'              =>  'Linux',
                              '/ubuntu/i'             =>  'Ubuntu',
                              '/iphone/i'             =>  'iPhone',
                              '/ipod/i'               =>  'iPod',
                              '/ipad/i'               =>  'iPad',
                              '/android/i'            =>  'Android',
                              '/blackberry/i'         =>  'BlackBerry',
                              '/webos/i'              =>  'Mobile');
         $found = false;
         foreach ($os_array as $regex => $value) 
         {
             if($found)
             break;
             else if (preg_match($regex, $user_agent)) 
             {
                 $os_platform    =   $value;
             }
         }
         // return array('os'=>$os_platform,'device'=>$device);
         $OS=$os_platform;

         // echo $OS;die;
         $user_agent = $_SERVER['HTTP_USER_AGENT'];

         $browser        =   "Unknown Browser";
     
         $browser_array  = array('/msie/i'       =>  'Internet Explorer',
                                 '/firefox/i'    =>  'Firefox',
                                 '/safari/i'     =>  'Safari',
                                 '/chrome/i'     =>  'Chrome',
                                 '/opera/i'      =>  'Opera',
                                 '/netscape/i'   =>  'Netscape',
                                 '/maxthon/i'    =>  'Maxthon',
                                 '/konqueror/i'  =>  'Konqueror',
                                 '/mobile/i'     =>  'Handheld Browser');
     
         foreach ($browser_array as $regex => $value) 
         { 
             if($found)
             break;
             else if (preg_match($regex, $user_agent,$result)) 
             {
                 $browser    =   $value;
             }
         }
         $data['ip'] = $ip;
         $data['OS'] = $OS;
         $data['browser'] = $browser;
         $data['date']   = date("d/m/Y h:i A");
         return $data;
}

function saveOutwardDetails($outward_text,$type,$request_id=''){
    $CI     = & get_instance();
    $CI->load->library('adminlib');
    $device = getDeviceDetails();
    $device_details = $device['ip'].','.$device['OS'].','.$device['browser'];
    $data = array(
        'outward_text' => $outward_text,
        'type' => $type,
        'user_agent' => $device_details,
        'created_on' => date("Y-m-d H:i:s"),
        'created_by' => $CI->adminlib->get_user_id(),
        'created_role' => $CI->adminlib->get_role_id(),
        'created_usergroup' => $CI->adminlib->get_user_group_id(),
        'created_office' => $CI->adminlib->get_office_id(),
        'created_masteroffice' => $CI->adminlib->get_master_office_id()
    );
    if($request_id != ''){
        $data['request_id'] = $request_id;
    }
    $CI->db->insert('outward_register',$data);
    return $CI->db->insert_id();
}

function is_closed($requestId, $req_type=1) {
    $tbl_req = 'AASF_Request';
    if($req_type==2)
        $tbl_req = 'AASF_Request_SF';
    elseif($req_type==3)
        $tbl_req = 'AASF_Request_Appeal';
    elseif($req_type==4)
        $tbl_req = 'AASF_Request_Revision';
    elseif($req_type==5)
        $tbl_req = 'AASF_Request_Appeal_AA';
    elseif($req_type==6)
        $tbl_req = 'AASF_Request_Audit';
    $CI = &get_instance();
    $CI->db->select('final_file_status');
    $CI->db->where(array('id' => $requestId));

    $file_closed = $CI->db->get($tbl_req)->row()->final_file_status;
    return $file_closed;
}
function hasAEOOffice(){
    $CI=& get_instance();
    $master_office = $CI->session->userdata('office_id');
    return $master_office == AEO_OFFICE ? true : false;
}
function hasDEOOffice(){
    $CI=& get_instance();
    $master_office = $CI->session->userdata('office_id');
    return $master_office == DEO_OFFICE ? true : false;
}
function hasAdditionalPost($req_id){
    $CI = &get_instance();
    $has_additional_post = $CI->General->find_record_exists('AASF_Additional_Post_Dtls', 'id', 'request_id='.$req_id.' and is_confirmed=1');
    return $has_additional_post;
}
function copyAddlPostAndDivisions($fileId){
    $CI = &get_instance();
    $is_exist = $CI->General->find_record_exists('AASF_Additional_Post_Dtls_DGE','id','is_confirmed=1 and request_id='.$fileId);

    if($is_exist == 0){
        $additional_post_dtls = $CI->General->getdata('AASF_Additional_Post_Dtls','*',array('is_confirmed'=>1,'request_id'=>$fileId,'is_deleted'=>0));
        if(count($additional_post_dtls) > 0){
            $CI->PTM->saveAdditionalPostDtlsDge($additional_post_dtls);
            $data['additional_post_dtls_dge'] = $CI->PTM->get_additional_post_dtls_dge($fileId,1);
            
            
            $additional_div_dtls = $CI->General->getdata('AASF_Additional_Division_Dtls','*',array('request_id'=>$fileId,'is_deleted'=>0));
            $CI->PTM->saveAdditionalDivDtlsDge($additional_div_dtls);
        }
        $data['additional_div_dtls_dge'] = $CI->PTM->getAdditionalDivDetailsDGE($fileId,1);
    }
    return true;
}

function getHigherSchoolLevel($school_id){
    $CI = &get_instance();
    $school_level_type = $CI->General->getrow('higher_schools', 'type', array('id'=>$school_id))->type;
    return $school_level_type;
}

function arrayKeySetter($data,$key=''){
    $new_data = array();
    foreach($data as $row){
        $new_data[$row[$key]] = $row;
    }
    return $new_data;
}
function nestedArrayKeySetter($data,$key=''){
    $new_data = array();
    foreach($data as $row){
        $new_data[$row[$key]][] = $row;
    }
    return $new_data;
}
// echo 'hh'; die;
/* End of file general_helper.php
 * Location : application/helpers/general_helper.php
 */
