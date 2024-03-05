<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * Application Preview Page
 *  Author Reshmi
 */
require_once APPPATH . '/libraries/JWT.php';

class Preview extends MY_User {

    private $fview = "Preview/";
    private   $READ_ONLY = 0;
    private   $READ_AND_EDIT = 1;
    private   $TAB1 = 1;
    private   $TAB2 = 2;
    private   $TAB3 = 3;
    private $table_Appeal_AA  = 'AASF_Request_Appeal_AA';

    function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation', 'general_helper');
        $this->load->library('AdminLib');
        $this->load->helpers('form_helper');
        $this->load->model('General');
        $this->load->model('ApplicationModel', 'AM');
        $this->load->model('Qualification_Model', 'QM');
        $this->load->model('FileUpload_Model', 'FM');
        $this->load->model('FileNotes_Model','FN');
        $this->load->model('CommonModel', 'CM');
        $this->load->model('School/Manager_Model', 'MGM');
        $this->load->model('Appeals_Model',"APAM");
        $this->template->add_js('assets/secured_user/js/preview.js');
    }

    function index() {
        //
    }

    /**
     * Manager Submitted  Application Preview
     * @param Application Id
     * returns a Preview of Application
     */
    function applicationPreview($request_id = NULL) {

        $is_current_tenure_manager  =   isCurrentTenureManager();
        $user_office = $this->session->userdata('office_id');

        if( ($user_office == MANAGER_OFFICE) &&  (!isManagerApplicationEnabled() || !$is_current_tenure_manager) ){
            echo '<span class="text-danger text-bold">Not Allowed...</span>';
            return;
        }
        
        $data = array();
        $data['request_id'] = @$request_id;
        $user_id = $this->session->userdata('user_id');
        //Line added for resolve the office resubmitted file issue(Start)
            $is_resubmitted = $this->General->getrow('AASF_Request','is_resubmitted',array('id'=>$request_id))->is_resubmitted;
            $is_office_resubmit = $this->General->find_record_exists('application_resubmit_log','id','req_id='.$request_id);
            if($is_resubmitted == 1 && $is_office_resubmit == 1)
                $user_id = '';
        //Line added for resolve the office resubmitted file issue(End)
        $data['appointee_data'] = $this->AM->getIncompeleteSubmittedApplication($request_id); // Getting Appointee details 
        $data['acadamic'] = $this->QM->get_acadamic_details_withoutFlags($request_id);               // Getting Academic Qualification
        $data['professional'] = $this->QM->get_professional_details_withoutFlags($request_id);           // Getting Professional Qualification
        $data['eligibility'] = $this->QM->get_eligibility_details_withoutFlags($request_id);            // Getting Eligibility Qualification
        $data['department'] = $this->QM->get_department_details_withoutFlags($request_id);             // Getting Departmental Qualification
        $data['files'] = $this->FM->getGeneralDocumentsFiles($request_id, $user_id);  // Getting General Documents
        $data['approved_services'] = $this->AM->getServiceDetails($request_id, 'Y');              // Getting Previous Approved service details
        $data['unapproved_services'] = $this->AM->getServiceDetails($request_id, 'N');              // Getting Previous unapproved service details
        $file_status_array = $this->FM->getFileStatus($request_id);                      // Getting File status
        $file_status = $file_status_array[0]['file_status'];
        $data['file_status'] = @$file_status;
        $designation               = @$this->General->getrow('AASF_Request', 'desig_id', array('id'=>$request_id)) ;
        $desig_id                  = $designation->desig_id;  
  
        $appointment               = @$this->General->getrow('AASF_Request', 'appointment_type', array('id'=>$request_id)) ;
        $appointment_type          = $appointment->appointment_type;
        $data['appointment_type']  = @$appointment_type;
        $data['desig_id']          = @$desig_id;
        if((($desig_id == 85) || ($desig_id == 87) || ($desig_id == 88)) && ($appointment_type == 3)){
            $data['mandatory_doc_count']        = @$this->AM->getCountofMandatoryGeneralDocumentsOnPromotion();
            $data['upload_mandatory_doc_count'] = @$this->AM->uploadedCountGeneralDocumentsOnPromotion(@$request_id); 
        } else {
            $data['mandatory_doc_count']        = $this->AM->getCountofMandatoryGeneralDocuments();                 // Getting count of Mandatory documents
            $data['upload_mandatory_doc_count'] = $this->AM->uploadedCountGeneralDocuments(@$request_id);     // Getting count of uploaded count of mandatory documents
        }
         $vacancy_reason_id = @$data['appointee_data']['request'][0]['vacancy_reason_id'];
        if (@$vacancy_reason_id > 1) {
            $data['vacancyAns'] = $this->getVacancyReasonDetails($request_id, $vacancy_reason_id); // Getting Nature of vacancy details
        }
        $data['validationStatus'] = 1;
        $data['validationStatusMessage'] = '';


        $acadamic      = $this->QM->get_acadamic_details_withoutFlags($request_id);
        $has_ktet_exemption = $this->General->getrow('AASF_Request','has_ktet_exemption',array('id'=>$request_id))->has_ktet_exemption;
        $eligibility = $this->QM->get_eligibility_details_withoutFlags($request_id);
        if(isMANAGEROffice()){
            if(empty($acadamic)){
                $data['validationStatus'] = 0;
                $data['validationStatusMessage'] = 'you are not submitted the academic qualifications.For submitting the details click on <a href="#qualification_tab" data-toggle="tab" aria-expanded="true"  onclick="document.getElementById(`qualification_tabhead`).click();"><button style="color:green;margin-left: 10px;" type="button">Add Qualification</button></a>  ';
            }elseif($has_ktet_exemption == 2 && empty($eligibility)){
                $data['validationStatus'] = 0;
                $data['validationStatusMessage'] = 'you are not submitted the T.E.T qualification details.For submitting the details click on<a href="#qualification_tab" data-toggle="tab" aria-expanded="true"  onclick="document.getElementById(`qualification_tabhead`).click();"><button style="color:green;margin-left: 10px;" type="button">Add Qualification</button></a>  ';
            }else{
                if( $data['mandatory_doc_count'] != $data['upload_mandatory_doc_count']){
                    $data['validationStatus'] = 0;
                    $data['validationStatusMessage'] = 'you are not submitted the general documents details.For submitting the details click on  <a href="#documents_tab" data-toggle="tab" aria-expanded="true"  onclick="document.getElementById(`documents_tabhead`).click();"><button style="color:green;margin-left: 10px;" type="button">Add General Documents</button></a>';
                }
            }
        }
        $this->load->view($this->fview . 'ApplicationPreview', $data);
    }

    /**
     * Get Vacancy Reasons details based on vacancy type
     * @param Application Id
     * @param Vacancy Reason Id
     * Loads vacancy reasons
     */
    function getVacancyReasonDetails($reqId, $vacancy_reason_id) {
        $vacancy_data = array();
        /**
         * Get Vacancy Reasons details based on vacancy type
         * @param Application Id
         * @param Vacancy Reason Id
         * vacancy reasons as array
         */
        $getvacncyreasonsdata = $this->AM->getVacancyReasonsData($reqId, $vacancy_reason_id);
        if ($vacancy_reason_id == '4') {      // Transfer
            $vacancy_data = array(
                "teacher_name" => $getvacncyreasonsdata[0]["dtl_qtn_ans"],
                "designation" => $getvacncyreasonsdata[1]["dtl_qtn_ans"],
                "school_name" => $getvacncyreasonsdata[2]["dtl_qtn_ans"],
                "date_of_vacancy" => $getvacncyreasonsdata[3]["dtl_qtn_ans"],
                "scale" => $getvacncyreasonsdata[4]["dtl_qtn_ans"],
                "pay" => $getvacncyreasonsdata[5]["dtl_qtn_ans"]
            );
        } else if ($vacancy_reason_id == '3') {    // Promotion
            $todate = "";
            if ($getvacncyreasonsdata[4]["dtl_qtn_ans"] != '') {
                $todate = $getvacncyreasonsdata[4]["dtl_qtn_ans"];
            } else {
                $todate = NULL;
            }
            $vacancy_data = array(
                "teacher_name" => $getvacncyreasonsdata[0]["dtl_qtn_ans"],
                "olddesignation" => $getvacncyreasonsdata[1]["dtl_qtn_ans"],
                "school_name" => $getvacncyreasonsdata[2]["dtl_qtn_ans"],
                "period_of_promotion_from" => $getvacncyreasonsdata[3]["dtl_qtn_ans"],
                "period_of_promotion_to" => $todate,
                "pay_scale" => $getvacncyreasonsdata[5]["dtl_qtn_ans"],
                "basic_pay" => $getvacncyreasonsdata[6]["dtl_qtn_ans"],
                "pay_scale_old" => $getvacncyreasonsdata[7]["dtl_qtn_ans"]
            );
        } else if ($vacancy_reason_id == '5' || $vacancy_reason_id == '2') {  // 2 - Retirement , 5 - Death
            $vacancy_data = array(
                "teacher_name" => $getvacncyreasonsdata[0]["dtl_qtn_ans"],
                "designation" => $getvacncyreasonsdata[1]["dtl_qtn_ans"],
                "relief_date" => $getvacncyreasonsdata[2]["dtl_qtn_ans"],
                "scale" => $getvacncyreasonsdata[3]["dtl_qtn_ans"],
                "pay" => $getvacncyreasonsdata[4]["dtl_qtn_ans"]
            );
        } else if ($vacancy_reason_id == '6' || $vacancy_reason_id == '7' || $vacancy_reason_id == '10') { // 6 - Resignation , 7 - Dismissal , 10 - Suspension 
            $vacancy_data = array(
                "teacher_name" => $getvacncyreasonsdata[0]["dtl_qtn_ans"],
                "designation" => $getvacncyreasonsdata[1]["dtl_qtn_ans"],
                "relief_date" => $getvacncyreasonsdata[2]["dtl_qtn_ans"],
                "approved" => $getvacncyreasonsdata[3]["dtl_qtn_ans"],
                "scale" => $getvacncyreasonsdata[4]["dtl_qtn_ans"],
                "pay" => $getvacncyreasonsdata[5]["dtl_qtn_ans"],
            );
        } else if ($vacancy_reason_id == '8') { // 8 - Deputation/Foreign Services
            $vacancy_data = array(
                "teacher_name" => $getvacncyreasonsdata[0]["dtl_qtn_ans"],
                "designation" => $getvacncyreasonsdata[1]["dtl_qtn_ans"],
                "relief_date" => $getvacncyreasonsdata[2]["dtl_qtn_ans"],
                "order_no" => $getvacncyreasonsdata[3]["dtl_qtn_ans"],
                "order_date" => $getvacncyreasonsdata[4]["dtl_qtn_ans"],
                "pay" => $getvacncyreasonsdata[5]["dtl_qtn_ans"],
                "scale" => $getvacncyreasonsdata[6]["dtl_qtn_ans"]
            );
        } else if ($vacancy_reason_id == '9') { // 9 - Leave Vacancy
            $vacancy_data = array(
                "teacher_name" => $getvacncyreasonsdata[0]["dtl_qtn_ans"],
                "designation" => $getvacncyreasonsdata[1]["dtl_qtn_ans"],
                "leave_period_from" => $getvacncyreasonsdata[2]["dtl_qtn_ans"],
                "leave_period_to" => $getvacncyreasonsdata[3]["dtl_qtn_ans"],
                "order_no" => $getvacncyreasonsdata[4]["dtl_qtn_ans"],
                "order_date" => $getvacncyreasonsdata[5]["dtl_qtn_ans"],
                "scale" => $getvacncyreasonsdata[6]["dtl_qtn_ans"],
                "pay" => $getvacncyreasonsdata[7]["dtl_qtn_ans"]
            );
        } else if ($vacancy_reason_id == '11') { // 11 - Reversion
            $vacancy_data = array(
                "teacher_name" => $getvacncyreasonsdata[0]["dtl_qtn_ans"],
                "designation" => $getvacncyreasonsdata[1]["dtl_qtn_ans"],
                "relief_date" => $getvacncyreasonsdata[2]["dtl_qtn_ans"],
                "reverted_post" => $getvacncyreasonsdata[3]["dtl_qtn_ans"],
                "leave_period_from" => $getvacncyreasonsdata[4]["dtl_qtn_ans"],
                "leave_period_to" => $getvacncyreasonsdata[5]["dtl_qtn_ans"],
                "approved_authority" => $getvacncyreasonsdata[6]["dtl_qtn_ans"]
            );
        } else  if ($vacancy_reason_id == '12'){                      // 12 - Removal
            $vacancy_data = array(
                "teacher_name" => @$getvacncyreasonsdata[0]["dtl_qtn_ans"],
                "designation" => @$getvacncyreasonsdata[1]["dtl_qtn_ans"],
                "relief_date" => @$getvacncyreasonsdata[2]["dtl_qtn_ans"],
                "approved" => @$getvacncyreasonsdata[3]["dtl_qtn_ans"],
                "scale" => @$getvacncyreasonsdata[4]["dtl_qtn_ans"],
                "pay" => @$getvacncyreasonsdata[5]["dtl_qtn_ans"]
            );
        }
        return $vacancy_data;
    }

    /**
     * Application submission to AEO/DEO Office
     * @param Application Id
     */
    function SubmitApplication($request_id) {
        $user_id    =   $this->session->userdata('user_id');
        $this->load->library('form_validation');
        if ($this->input->post('btnAppSubmit')) {
            $submit_data = array(
                "req_id" => $request_id,
                "user_id" => $user_id
            );
            
            $request=$this->General->getrow("AASF_Request","school_id,appointee_name,school_id"," id = ".$submit_data['req_id']);
            $administ_under=$this->General->get_column("school_details","administ_under"," school_id = ".$request->school_id);
            if($administ_under==1007){
                $subdist_id = $this->session->userdata('subdistrict_id');
                $mail_id=$this->General->get_column("master_subdistricts","office_email"," id = ".$subdist_id);
            }else if($administ_under==1006){
                $edudist_id = $this->session->userdata('edudistrict_id');
                $mail_id=$this->General->get_column("master_edudistricts","office_email"," id = ".$edudist_id);
            }
            $school_name=$this->General->get_column("schools","school_name"," id = ".$request->school_id);
            $mailSubject="Appointment Application Submitted ";
            $mailContent= "The manager of <b>".$school_name."</b> has forwarded an appointment Approval in respect of sri/smt <b>".$request->appointee_name.".</b> Kindly forward the application to the section";
            $cc_mail = get_email($user_id);
          //$this->CM->sendMail($mail_id,$mailSubject,$mailContent,$cc_mail);  //Send Mail to the Office Mail 
          $mail_data = getDeviceDetails();
          $mail_data['notification_msg'] = $mailContent;
          $this->CM->sendMail($mail_id,$mailSubject,
          $this->load->view('email/appointment_submit_html',$mail_data,TRUE),$cc_mail);
          $this->db->trans_start();
          $submit = $this->AM->saveFinalSubmition($submit_data);  // Setting 'Partial Submission' File status to 'Open'
          
          if(hasInitFilePermissionDEO() || hasInitFilePermissionAEO()){
                $save_log = $this->AM->saveApplicationResubmitLog($request_id);
            }   
            $changeTabPermission = $this->AM->setTabPermission($this->TAB1,$this->READ_ONLY,$this->TAB2,$this->READ_ONLY,$this->TAB3,$this->READ_ONLY,$request_id); 
            if($changeTabPermission == 1){
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('success', 'Application Submitted to Office');
                    redirect("secured_user/Dashboard/user_dashboards/1");
                }
            }
        }
    }

    /**
     * Get the Display date format
     * @param DB date in 'Y-m-d'
     * returns Display date format in 'd/m/Y'
     */
    function getDisplayDate($dbdate) {
        if ($dbdate != "") {
            $date = DateTime::createFromFormat('Y-m-d', $dbdate);
            $date = $date->format('d/m/Y');
            return $date;
        } else {
            return NULL;
        }
    }

    /**
     * Application Print Preview
     * @param Application Id
     * displays pdf output of Application
     */
    function applicationPreviewPrint($request_id) {

        $data = array();
        $data['request_id'] = @$request_id;
        $user_id = $this->session->userdata('user_id');
        $data['appointee_data'] = $this->AM->getIncompeleteSubmittedApplication($request_id);
        $data['acadamic'] = $this->QM->get_acadamic_details_withoutFlags($request_id);
        $data['professional'] = $this->QM->get_professional_details_withoutFlags($request_id);
        $data['eligibility'] = $this->QM->get_eligibility_details_withoutFlags($request_id);
        $data['department'] = $this->QM->get_department_details_withoutFlags($request_id);
        $data['files'] = $this->FM->getGeneralDocumentsFiles($request_id, $user_id);
        $data['approved_services'] = $this->AM->getServiceDetails($request_id, 'Y');
        $data['unapproved_services'] = $this->AM->getServiceDetails($request_id, 'N');
        $vacancy_reason_id = @$data['appointee_data']['request'][0]['vacancy_reason_id'];
        if (@$vacancy_reason_id > 1) {
            $data['vacancyAns'] = $this->getVacancyReasonDetails($request_id, $vacancy_reason_id);
        }
        $qr_content = 'Application Id : '.$request_id.PHP_EOL.'Appointee : '.$data['appointee_data']['request'][0]['appointee_name'].PHP_EOL.'Downloaded on : '.date('d/m/Y h:i A');
        $data['qr_code'] = $this->adminlib->getCustomQrCode($qr_content);   
        $management_id = $this->General->getrow('school_details','mngment_id',array('school_id'=>$data['appointee_data']['request'][0]['school_id']))->mngment_id;
        $data['management_name'] = $this->General->getrow('AASF_Management','mngmnt_name',array('id'=>$management_id))->mngmnt_name;
        ob_end_clean();
        $this->load->library('m_pdf');
        $mpdf = new mPDF('utf-8', 'A4');
        $mpdf->autoScriptToLang = true;
        $mpdf->baseScript = 1;
        $mpdf->autoVietnamese = true;
        $mpdf->autoArabic = true;
        $mpdf->autoLangToFont = true;
        $mpdf->useAdobeCJK = true;
        // $mpdf->SetAutoFont(AUTOFONT_ALL);
        $mpdf->debug = true;
        $mpdf->autoPageBreak = true;
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->debug = true;
        $mpdf->SetWatermarkText('SAMANWAYA',0.05);
        $mpdf->showWatermarkText = true;
//        $this->load->view($this->fview . 'FinalReport', $data);       
        $html = $this->load->view($this->fview . 'FinalReport', $data, true);

        $mpdf->SetHTMLFooter('
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:none; border-top:thin solid; ">
        <tr>
        <td><span style="font-family: Inconsolata, monospace;color:#ff0000;font-size:14px;">'.@$request_id.'</span></td>
        
        <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">
            SAMANWAYA
        </td>
        <td style="width:10%; text-align:center; font-weight:100; ; color:#000000; font-size:10px; ">{PAGENO}/{nb}</td>
        <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">Printed on {DATE d/m/Y h:i:s A}</td>
        </tr>
        </table>');

        $stylesheet = '.table-bordered-custom tr td{ border:thin solid #f1f1f1 !important;vertical-align: middle}
        .table-custom tr{ border-bottom: thin solid #000 !important; }
        '; // external css
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html);
        $pdfFilePath = "applicationpreview.pdf";
        $mpdf->Output($pdfFilePath, "D"); //D-Download; I-Inline       
    }
/**
 * For Final Report
 */
     public function final_report($request_id,$key,$oth_req_type=NULL,$oth_req_id=NULL,$school_id= NULL) {
        if(get_hash($request_id) != $key){
                redirect('Common/deny');
        }
//        echo $request_id;
//        exit;
        $data['request_id'] = @$request_id;
        $data['appointee_data'] = $this->AM->getIncompeleteSubmittedApplication($request_id);
        $data['acadamic'] = $this->QM->get_acadamic_details_withoutFlags($request_id);
        $data['professional'] = $this->QM->get_professional_details_withoutFlags($request_id);
        $data['eligibility'] = $this->QM->get_eligibility_details_withoutFlags($request_id);
        $data['department'] = $this->QM->get_department_details_withoutFlags($request_id);
        $data['sch_aeo_dtl'] = $this->CM->getManagementschooldata($request_id);
        $upload_by =  @$this->General->getrow("AASF_Request", 'created_by', array('id'=> $request_id)) ;
        $documents_Upload_by        =  $upload_by->created_by;
         
        $data['files'] = $this->FM->getGeneralDocumentsFiles($request_id, $documents_Upload_by);
        $data['approved_services'] = $this->AM->getServiceDetails($request_id, 'Y');
        $data['unapproved_services'] = $this->AM->getServiceDetails($request_id, 'N');
        $vacancy_reason_id = @$data['appointee_data']['request'][0]['vacancy_reason_id'];
        if (@$vacancy_reason_id > 1) {
            $data['vacancyAns'] = $this->getVacancyReasonDetails($request_id, $vacancy_reason_id);
        }
         $data['appointment']  = $this->CM->getAppointmentdetails($request_id);
         $data['applicant']    = $this->CM->getApplicationDetails($request_id);
        //  echo '<pre>'; print_r($data['applicant']); die;
         if(@$oth_req_type == REQ_TYPE_APL_AA){
             $data['questions']                = $this->APAM->get_questions(REQ_TYPE_APL_AA);
             $data['file_appeal_id']           = $appeal_id = $this->General->getrow($this->table_Appeal_AA, 'appeal_id', array('id' => $oth_req_id ))->appeal_id;
             $data['appeal_details_submitted'] = $this->APAM->get_submitted_appeal_details($school_id,APL_MODULE_AA,$appeal_id);
             if($this->session->userdata('office_id')==DGE_OFFICE){
                 $new_appeal_id = getAppealRequestIDsFromSFRequest($request_id, REQ_TYPE_APL_AA);
                 $notes = array(); $i = 0;
                 foreach($new_appeal_id as $row){
                     $notes[$i]           = $this->FN->getFileNotes($row['id']);
                     $notes[$i]['is_rev'] = isRevisionAppeal($row['id'],APL_MODULE_AA);
                     $i++;
                 }               
                 $data['fileNotes_apl']  = $notes;
             }else{
                 $data['fileNotes_apl']  = $this->FN->getFileNotes($oth_req_id);
             }
         }else if(@$oth_req_type == REQ_TYPE_AUD){
                 $data['fileNotes_audit'] = $this->FN->getFileNotes($oth_req_id);
         }
         $data['vacancy']      = $this->CM->getVacancyMainAnswerDetails($request_id, @$data['applicant']->vacancy_reason_id);
         $data['appointeee']   = $this->getAppointeeOfficedata($request_id);
         $data['appointee']    = $this->CM->getAppointeeOfficedata($request_id);
         $data['post']         = $this->CM->getPostdata($request_id);
         $data['fileNotes']    = $this->FN->getFileNotes($request_id);
         $data['oth_req_type'] = $oth_req_type;
         $data['oth_req_id']   = $oth_req_id;
//       print("<pre>");
//       print_r($data['appointeee']);
//       exit;

        if($oth_req_id != NULL){
            $file_req_id = $oth_req_id;
            $file_req_type = getRequestType($oth_req_id);
            if($file_req_type == REQ_TYPE_APL_AA)
                $data['title'] = 'APPOINTMENT APPROVAL APPEAL';
            elseif($file_req_type == REQ_TYPE_AUD)
                $data['title'] = 'AUDIT';
            elseif($file_req_type == REQ_TYPE_AA)
                $data['title'] = 'APPOINTMENT APPROVAL';
        }else{
            $file_req_id = $request_id;
            $file_req_type = getRequestType($request_id);
            if($file_req_type == REQ_TYPE_AA)
                $data['title'] = 'APPOINTMENT APPROVAL';
        }

        $user_array = array();
        $user_array['user_id']          = $this->adminlib->get_user_id();
        $user_array['role_id']          = $this->adminlib->get_role_id();
        $user_array['usergroup_id']     = $this->adminlib->get_user_group_id();
        $user_array['officeid']         = $this->adminlib->get_office_id();
        $user_array['master_officeid']  = $this->adminlib->get_master_office_id();
        $user_dtls = $this->m_rbac->getUsersByPen($user_array['user_id'],1);
        $office_name = $this->adminlib->get_office_name($user_dtls->office_id, $user_dtls->office,$user_dtls->office_block_id);
        $outward_text = 'Downloaded by '.$user_dtls->name . "(" . @$user_dtls->designation_name . "," . @$office_name . ") on ".date('d/m/Y h:i A');
        $outward_id = saveOutwardDetails($outward_text,OUTWARD_TYPE_FILE_DOWNLOAD,$file_req_id);
        $data['file_number'] = $data['applicant']->file_number;
        $data['appln_final_submit_date'] = $data['applicant']->appln_final_submit_date;
        $data['qr_code'] = $this->adminlib->getOutwardPdfQRCode($outward_id,$data['file_number']);  
        $data['outward_id'] = $outward_id;
        
        $data['office_full_name'] = $this->adminlib->get_office_full_name($user_dtls->office_id, $user_dtls->office,$user_dtls->office_block_id);
            
        ob_end_clean();
        $this->load->library('m_pdf');
        $mpdf = new mPDF('utf-8', 'A4','','',15,15,16,25);
          // $mpdf->useSubstitutions = true;
          $mpdf->autoScriptToLang = true;
          $mpdf->baseScript = 1;
          $mpdf->keep_table_proportions = false;
  
          // $mpdf->autoVietnamese = true;
          // $mpdf->autoArabic = true;
          $mpdf->autoLangToFont = true;
          $mpdf->useAdobeCJK = true;
          // $mpdf->SetAutoFont(AUTOFONT_ALL);
          $mpdf->debug = false;
          $mpdf->autoPageBreak = true;
          $mpdf->setAutoTopMargin='stretch';
          $mpdf->SetWatermarkText('SAMANWAYA',0.05);
          $mpdf->showWatermarkText = true;
        $html = $this->load->view($this->fview . 'FinalFileReport', $data, true);


        $mpdf->SetHTMLFooter('
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:none; border-top:thin solid; ">
        <tr>
        <td><span style="font-family: Inconsolata, monospace;color:#ff0000;font-size:14px;">'.@$outward_id.'</span></td>
        
        <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">
            SAMANWAYA
        </td>
        <td style="width:10%; text-align:center; font-weight:100; ; color:#000000; font-size:10px; ">{PAGENO}/{nb}</td>
        <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">Printed on {DATE d/m/Y h:i:s A}</td>
        </tr>
        </table>');
        //      $this->template->write_view('content', 'Preview/FinalFileReport', $data);
        //      $this->template->load();
          $stylesheet = '.table-bordered-custom tr td{ border:thin solid #f1f1f1 !important;vertical-align: middle}
          .table-custom tr{ border-bottom: thin solid #000 !important; }
          '; // external css
          $mpdf->WriteHTML($stylesheet,1);
          $mpdf->WriteHTML($html);
          $pdfFilePath1 = "applicationfilepreview.pdf";
          $mpdf->Output($pdfFilePath1, "D"); //D-Download; I-Inline 
    }

  /*   Get data based on Rules  */

    public function getAppointeeOfficedata($request_id) {
        $appnt_data = $this->CM->getAppointeedata($request_id);

        $rule = @$appnt_data[0]['claim_rule'];
        if ($rule != '') {
            if ($rule == "R1") {
                $appnt_r1_data = $this->CM->getAppointeeOfficeR1data($request_id);
                $result_array = array_merge($appnt_data, $appnt_r1_data);
            } else if ($rule == "R43") {
                $appnt_43_data = $this->CM->getAppointeeOfficeR43data($request_id);
                $result_array = array_merge($appnt_data, $appnt_43_data);
            } else if ($rule == "R51a") {
                $appnt_R51a_data = $this->CM->getAppointeeOfficeR51Adata($request_id);
                $result_array = array_merge($appnt_data, $appnt_R51a_data);
            } else if ($rule == "R51b") {
                $appnt_R51b_data = $this->CM->getAppointeeOfficeR51Bdata($request_id);
                $result_array = array_merge($appnt_data, $appnt_R51b_data);
            }
            return $result_array;
        } else if ($rule == '') {
            return @$appnt_data[0];
        }
    }
}

?>