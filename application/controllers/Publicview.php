<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Publicview extends MY_Auth {

    function __construct() {
        parent::__construct();
        //$this->load->helper(array('form', 'url'));
        //$this->load->library('form_validation');
        //$this->load->library('security');
        $this->load->library('tank_auth');
        $this->load->library('AdminLib');
        $this->load->library('itschool_rbac');
        $this->lang->load('tank_auth');
        $this->load->model('tank_auth/login_attempts','LA');
        $this->load->model('tank_auth/users','users');
        $this->load->model('Admin/ExcessModel',"EM");
        $this->load->model('ReportsModel',"RM");
        $this->load->model('HSE_office/RosterReportModel', 'ROM');
        $this->load->model('Datacollection_Model', 'DCM');
    }
    
    function TeachersBank($academic_id = ""){
        if($academic_id == ""){
             $academic_id = $this->General->getrow('AASF_Academic_Year','id',array('is_current'=>1))->id;
        }
        $data['academicYear']    = $this->General->prepare_select_box_data('AASF_Academic_Year','id,year_desc',' ','','Year desc','Select Academic Year');
        $data['SelAcademicYear'] = $academic_id;
        $data['teachers_bank_list'] = $this->RM->get_teachers_bank_report($academic_id);
        $data['flag']               = 1;
        $data['list']               = $this->EM->get_submitted_list_DGE();
        $this->template->write_view('content', 'Publicview/teachers_bank_report', $data);
        $this->template->load();
    }
    
    function get_teacher_bank_staff_data(){
        $academic_id                    = $this->input->post("academic_id");
        $district                       = $this->input->post("district");
        $designation                    = $this->input->post("designation");
        $data['teacher_list']           = $this->RM->get_teachers_bank_list($district,$designation,NULL,$academic_id);
        $data['district']               = $this->input->post("district");
        $data['deployed_schools']       = $this->RM->get_deployed_schools($district,$designation,$academic_id);
//        print("<pre>");
//        print_r($data['deployed_schools']);
//        exit;
        $data['deployed_schools_inter'] = $this->RM->get_deployed_schools_inter($district,$designation,$academic_id);
        $this->load->view("Publicview/teachers_bank_teacher_list",$data);
    }
    function rosterData()
    {
        $data = array();
        
        $this->template->write_view('content', 'Publicview/RosterDataReport', $data);
        $this->template->load();
    }
    function getRosterData($type)
    {
        $res=$this->ROM->getRosterData($type);
        $jsondata=json_encode($res);
        echo $jsondata;
    }
    function getManagementList($management_id = '')
    {
        // print_r($management_id);
        $data['id']=$management_id;
        // print_r($data['id']);die;
        $is_entered = $this->General->is_record_exists('disability_datacollection','management_id='.$management_id);
        $is_confirmed = $this->General->is_record_exists('disability_datacollection_confirmation','management_id='.$management_id.' and is_confirmed=1');
        // $is_verified = $this->General->is_record_exists('disability_datacollections','management_id='.$management_id.' and is_verified=1 and is_deleted = 0 ');
        $data['is_verified'] = $is_verified = $this->ROM->getVerifiedSchoolsCount($management_id);
        $data['categories'] = $this->General->getdata('datacollection_master_category','id,category',array('is_active'=>1));
        $data['report'] = array();
        $data['emp_report'] = array();
        if($is_verified > 0){
            $data['report'] = $this->ROM->getDisabilityConfirmation($management_id);
            $data['emp_report'] = $this->DCM->getEmploymentRpwdReport($management_id);
        }
        if($is_entered == 0){
            $data['status_message'] = 'Data Not Entered';
            $data['status_color'] = '#F44336';
        }elseif($is_confirmed == 0){
            $data['status_message'] = 'Data Not Confirmed By Manager';
            $data['status_color'] = '#F44336';
        }elseif($is_verified == 0){
            $data['status_message'] = 'Data Not Verified By Office';
            $data['status_color'] = '#F44336';
        }elseif(($is_verified > 0)){
            $total_schools = $this->General->is_record_exists('school_details','mngment_id='.$management_id);
            $data['status_message'] = $is_verified.' / '.$total_schools.' Schools are Verified By Office';
            $data['status_color'] = '#417e36';
        }
        if($management_id != ''){
            $data['mngmnt_name'] = $this->General->getrow('AASF_Management','mngmnt_name',array('id'=>$management_id))->mngmnt_name;
        }else{
            $data['mngmnt_name'] = 'All';
        }
        $this->load->view("HSE_office/DisabilityReport", $data);
        // $this->template->load();
    }
    function printDiv($management_id='')
    {
        $data = array(); 
        $data['categories'] = $this->General->getdata('datacollection_master_category','id,category',array('is_active'=>1));
        $data['report'] = $this->ROM->getDisabilityConfirmation($management_id);
        $data['emp_report'] = $this->DCM->getEmploymentRpwdReport($management_id);
        if($management_id != ''){
            $data['mngmnt_name'] = $this->General->getrow('AASF_Management','mngmnt_name',array('id'=>$management_id))->mngmnt_name;
        }else{
            $data['mngmnt_name'] = 'All';
        }
            ob_end_clean();
            $this->load->library('m_pdf');
            $mpdf = new mPDF('utf-8', 'A4-L','','',15,15,16,25);
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
            $mpdf->defaultfooterfontsize = 8;	/* in pts */
            $mpdf->defaultfooterfontstyle = I;	/* blank, B, I, or BI */
            $mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */

            $is_entered = $this->General->is_record_exists('disability_datacollection','management_id='.$management_id);
            $is_confirmed = $this->General->is_record_exists('disability_datacollection_confirmation','management_id='.$management_id.' and is_confirmed=1');
            // $is_verified = $this->General->is_record_exists('disability_datacollections','management_id='.$management_id.' and is_verified=1 and is_deleted = 0 ');
            $data['is_verified'] = $is_verified = $this->ROM->getVerifiedSchoolsCount($management_id);
            if($is_entered == 0){
                $data['status_message'] = 'Data Not Entered';
                $data['status_color'] = '#F44336';
            }elseif($is_confirmed == 0){
                $data['status_message'] = 'Data Not Confirmed By Manager';
                $data['status_color'] = '#F44336';
            }elseif($is_verified == 0){
                $data['status_message'] = 'Data Not Verified By Office';
                $data['status_color'] = '#F44336';
            }elseif(($is_verified > 0)){
                $total_schools = $this->General->is_record_exists('school_details','mngment_id='.$management_id);
                $data['status_message'] = $is_verified.' / '.$total_schools.' Schools are Verified By Office';
                $data['status_color'] = '#417e36';
            }
            $html['draft_note'] = $this->load->view('HSE_office/RosterReportPrint', $data, true);
            $html= $this->load->view('secured_user/pdf', $html,true);
            $mpdf->SetHTMLFooter('
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:none; border-top:thin solid; ">
            <tr>
            
            <td style="width:45%; font-weight:100; ; color:#c1c0c0; font-size:10px; ">
                
                SAMANWAYA
            </td>
            <td style="width:10%; text-align:center; font-weight:100; ; color:#000000; font-size:10px; ">{PAGENO}/{nb}</td>
            <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">Printed on {DATE d/m/Y h:i:s A}</td>
            </tr>
            </table>');
    
              $stylesheet = `.table-bordered-custom tr td{ border:thin solid #f1f1f1 !important;vertical-align: middle}
              .table-custom tr{ border-bottom: thin solid #000 !important; }`;
              $mpdf->WriteHTML($stylesheet,1);
              $mpdf->WriteHTML($html);
              $pdfFilePath1 = "rpwd_report.pdf";
              $mpdf->Output($pdfFilePath1, "D");
        }

    function managementEntries($management_id){
        $data = array();
        $data['schools'] = $this->ROM->getSchoolManagementEntries($management_id);
        $data['categories'] = $this->General->getdata('datacollection_master_category','id,category',array('is_active'=>1));
        $data['entered_schools_count'] = $this->ROM->getEnteredSchools($management_id);
        $data['hss_vhss_schools'] = $this->ROM->getHigherSchoolManagementEntries($management_id);
        $data['entered_categories'] = $this->ROM->getEnteredCategories($management_id);
        $data['mngmnt_name'] = $this->General->getrow('AASF_Management','mngmnt_name',array('id'=>$management_id))->mngmnt_name;
        $data['is_confirmed'] = $this->General->getrow('disability_datacollection_confirmation',"is_confirmed",array('is_confirmed'=>1,'management_id'=>$management_id))->is_confirmed;
        $data['management_id'] = $management_id;
        $this->template->write_view("content", "Publicview/ManagementSchoolDashboard", $data);
        $this->template->load();
    }
    function managerSchoolEntry($school_id,$is_hss_vhss=''){
        $data = array();
        $school_management_id = $this->General->getrow('school_details','mngment_id',array('school_id'=>$school_id))->mngment_id;
        if($is_hss_vhss == 1){
            $school_type = getHigherSchoolLevel($school_id);
        }
        $management_id = $this->adminlib->get_management_id();
        $data['school_id'] = $school_id;
        if($is_hss_vhss == 1){
            $data['school_name'] = hss_vhss_school_name_byid($school_id);
            if($school_type == 'h'){
                $data['category'] = $this->General->getdata('datacollection_master_category','id,category','is_active = 1 and level IN (2,0)');
            }else{
                $data['category'] = $this->General->getdata('datacollection_master_category','id,category','is_active = 1 and level IN (3,0)');
            }
        }else{
            $data['category'] = $this->General->getdata('datacollection_master_category','id,category','is_active = 1 and level IN (1,0)');
            $data['school_name'] = school_name_byid($school_id);
        }
        $data['management_id'] =  $school_management_id;
        $data['entered_data'] = $this->DCM->getEnteredSchoolData($school_id);
        $data['school_code'] = getSchoolCode($school_id);
        $this->template->write_view("content", "Publicview/manager_school_entry", $data);
        $this->template->load();
    }

    function managerCategoryEntry($category_id,$management_id=''){
        if($management_id == '')
            $management_id = $this->adminlib->get_management_id();
                $data['category_name'] = $this->General->getrow('datacollection_master_category','category',array('id'=>$category_id))->category;
                $data['entered_data'] = $this->DCM->getEnteredCategoryData($management_id,$category_id);
                $is_confirmed = $this->General->getrow('disability_datacollection_confirmation',"is_confirmed",array('is_confirmed'=>1,'management_id'=>$management_id))->is_confirmed;
                if(isValidManager()){
                    $data['is_confirmed'] = $is_confirmed;
                }else{
                    $data['is_confirmed'] = 0;
                }
                $data['management_id'] = $management_id;
                $this->template->write_view("content", "Publicview/manager_category_entry", $data);
                $this->template->load();

    }
}

?>