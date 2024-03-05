<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QualificationLib
 *
 * @author Akhila
 */
class AdminLib
{


    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('General');
        $this->ci->load->helper('general_helper');
    }

    public function get_user_id()
    {
        return $this->ci->session->userdata('user_id');
        // $data['userdata']['user_id'];
    }
    public function get_role_id()
    {
        return $this->ci->session->userdata('designation_id');
    }
    public function get_master_office_id()
    {
        return $this->ci->session->userdata('office_id');
    }
    public function get_office_block_id()
    {
        return $this->ci->session->userdata('office_block_id');
    }
    public function get_office_id()
    {
        if ($this->ci->session->userdata('office_id') === '1006') {
            @$office_id = $this->ci->session->userdata('edudistrict_id');
        } else if ($this->ci->session->userdata('office_id') === '1007') {
            @$office_id = $this->ci->session->userdata('subdistrict_id');
        } else if ($this->ci->session->userdata('office_id') === '1002') {
            @$office_id = $this->ci->session->userdata('district_id');
        } else if ($this->ci->session->userdata('office_id') === '1001' || $this->ci->session->userdata('office_id') === '1000') {
            @$office_id = 0; //$this->ci->session->userdata('district_id');   
        } else if ($this->ci->session->userdata('office_id') === '1014') {
            @$office_id = get_supercheck_office_id($this->ci->session->userdata('user_id')); //$this->ci->session->userdata('district_id');   
        } else if ($this->ci->session->userdata('office_id') === '1015') {
            @$office_id = law_office_id();
        }  else if ($this->ci->session->userdata('office_id') === '1016') {
            @$office_id = 0;
        }else if ($this->ci->session->userdata('office_id') === '1017' || $this->ci->session->userdata('office_id') === '1018') {
            @$office_id = 0;
        }
        return @$office_id;
    }
    public function get_office_name($master_office_id, $office_id, $office_block = NULL)
    {
        if ($master_office_id == DEO_OFFICE) {
            @$office_name = get_edu_dist_name_by_id($office_id);
        } else if ($master_office_id == AEO_OFFICE) {
            @$office_name = get_sub_dist_name_by_id($office_id);
        } else if ($master_office_id == DDE_OFFICE) {
            @$office_name = get_dist_name_by_id($office_id);
        } else if ($master_office_id == DGE_OFFICE) {
            @$office_name = get_dist_name_by_id($office_id);
            if ($office_block == NULL || $office_block == 0)
                @$office_name = "DGE";
            else
                @$office_name = get_office_block_name($office_block);
        } else if ($master_office_id == SUPER_CHECK_OFFICE) {
            @$office_name = get_supercheck_office_name($office_id);
        }
        return @$office_name;
    }
    public function get_office_full_name($master_office_id, $office_id, $office_block = NULL)
    {
        if ($office_block != NULL)
            $office_name = $this->get_office_name($master_office_id, $office_id, $office_block);
        else
            $office_name = $this->get_office_name($master_office_id, $office_id);
        $office_types = array(
            DEO_OFFICE => "DEO",
            AEO_OFFICE => "AEO",
            DDE_OFFICE => "DDE",
            DGE_OFFICE => "DGE",
            SUPER_CHECK_OFFICE => "Super Check Cell",
            LAW_OFFICE         => "Law Office"
        );
        return ($office_types[$master_office_id] . ' ' . $office_name);
    }
    public function get_user_type()
    {
        return $this->ci->session->userdata('user_type');
    }
    public function get_management_id($user_id = NULL)
    {
        if ($user_id != NULL) {
            $mngmnt_id = $this->ci->General->getrow('users', 'school_management_id as mng_id', array('id' => $user_id))->mng_id;
            return $mngmnt_id;
        } else {
            return $this->ci->session->userdata('school_management_id');
        }
    }
    public function get_user_group_id($user_id = NULL)
    {
        if ($user_id != NULL) {
            $user_group_id = $this->ci->General->getrow('users', 'user_group_id', array('id' => $user_id))->user_group_id;
            return $user_group_id;
        } else {
            return $this->ci->session->userdata('usergroup_id');
        }
    }
    public function get_active_user_id($master_office_id, $office_id, $office_block_id, $role_id)
    {
        $office_field = '';
        switch ($master_office_id) {
            case DEO_OFFICE:
                $office_field = 'edudistrict_id';
                break;
            case AEO_OFFICE:
                $office_field = 'subdistrict_id';
                break;
            case DDE_OFFICE:
                $office_field = 'district_id';
                break;
            case DGE_OFFICE:
                $office_field = 'district_id';
                break;
            case SUPER_CHECK_OFFICE:
                $office_field = 'zone_id';
                break;
        }
        if ($office_field != '') {
            if ($office_id == 0)
                $user_details = $this->ci->General->getrow('users', 'id', array('office_id' => $master_office_id, '(' . $office_field . ' = 0 OR ' . $office_field . ' IS NULL)', 'office_block_id' => $office_block_id, 'designation_id' => $role_id, 'activated' => 1));
            else
                $user_details = $this->ci->General->getrow('users', 'id', array('office_id' => $master_office_id, $office_field => $office_id, 'office_block_id' => $office_block_id, 'designation_id' => $role_id, 'activated' => 1));
            if (isset($user_details))
                return $user_details->id;
            else
                return 0;
        } else {
            return 0;
        }
    }
    public function get_pa_id()
    {
        return 118;
    }
    public function get_js_id()
    {
        return 120;
    }
    public function get_clerk_id()
    {
        return 110;
    }
    public function get_pa_office_id()
    {
        return 1006;
    }
    public function get_js_office_id()
    {
        return 1007;
    }
    public function get_admin_office_id()
    {
        return 1000;
    }
    public function get_dno_office_id()
    {
        return 1013;
    }
    public function get_dde_office_id()
    {
        return 1002;
    }
    public function get_dge_office_id()
    {
        return 1001;
    }
    public function get_supercheck_office_id()
    {
        return 1014;
    }
    public function get_law_office_id()
    {
        return 1015;
    }
    public function get_sec_office_id()
    {
        return 1016;
    }
    public function get_admin_id()
    {
        return 100;
    }
    public function get_state_admin_id()
    {
        return 131;
    }
    public function get_main_js_id()
    {
        return 119;
    }
    public function get_suprd_id()
    {
        return 132;
    }
    public function get_sco_id()
    { // super check officer
        return 133;
    }
    public function get_law_officer_id()
    { // law officer
        return 134;
    }
    public function get_jd_id()
    {
        return 130;
    }
    public function get_unit_officer_id()
    {
        return 128;
    }
    public function get_dde_id()
    {
        return 112; //112 is is the desig id of dde
    }
    public function get_dge_id()
    {
        return 129; //129 is is the desig id of dge
    }
    public function get_adge_id()
    {
        return 127; //127 is is the desig id of adge
    }
    public function get_lp_school_office_id()
    {
        return 1011;
    }
    public function get_up_school_office_id()
    {
        return 1010;
    }
    public function get_hs_school_office_id()
    {
        return 1008;
    }
    public function get_deo_id()
    {
        return 115;
    }
    public function get_aeo_id()
    {
        return 116;
    }
    public function get_manager_id()
    {
        return 117;
    }
    public function get_manager_usergroup()
    {
        return 109;
    }
    public function get_hm_id()
    {
        return 123;
    }
    public function get_pa_full_addition_id()
    {
        return 121;
    }
    public function get_ss_full_addition_id()
    {
        return 122;
    }
    public function get_aeo_full_addition_id()
    {
        return 126;
    }
    public function get_deo_full_addition_id()
    {
        return 135;
    }
    public function get_dde_full_addition_id()
    {
        return 136;
    }
    public function get_aa_full_addition_id()
    {
        return 137;
    }
    public function get_aa_id()
    {
        return 124;
    }
    public function get_ao_id()
    {
        return 125;
    }
    public function get_ao_full_addition_id()
    {
        return 138;
    }
    public function get_fo_id(){
        return 140;
    }

    //Digitl Signature End
    public function get_acess_token()
    {
        return "Authorization: Bearer ".$this->ci->session->userdata('access_token');
    }
    //D Sig End

    public function sec_asst_id(){
        return 141;
    }
    public function under_sec_id(){
        return 142;
    }
    public function deputy_sec_id(){
        return 143;
    }
    public function joint_sec_id(){
        return 144;
    }
    public function additional_sec_id(){
        return 145;
    }
    public function secretary_id(){
        return 146;
    }
    public function special_sec_id(){
        return 147;
    }
 
    public function minister_id(){
        return 148;
    }
    public function get_ca_id(){
        return 149;
    }
    public function get_rdd_id(){
        return 154;
    }
    function Final_approve($master_officeid, $office_id, $user_id, $user_group_id, $role_id, $request_id, $req_type)
    {
        // echo "test";die
        //        $update_data = array('mov_status'=>3, 
        //            'date_of_action' => date('Y-m-d H:i:s'), 
        //            'wf_status' => 'Closed',
        //            'updated_by'=>@$this->ci->session->userdata('user_id'),
        //            'updated_at'=>date('Y-m-d H:i:s'));
        //        
        //         $save_data = array(
        //            "final_file_status" => 1,
        //            "updated_at" => date('Y-m-d H:i:s'),
        //            "updated_by" => @$this->ci->session->userdata('user_id')
        //        );
        return $this->ci->CM->final_approve($master_officeid, $office_id, $user_id, $user_group_id, $role_id, $request_id, $req_type);
    }

    function generateProceedingsSF($request_id = NULL)
    {
        // if($this->input->post('request_id'))
        //     $request_id = $this->input->post('request_id');
        $academic_id = getAcademicIdFromRequest($request_id, REQ_TYPE_SF);
        $fview = "secured_user/";
        $table_Request_SF = 'AASF_Request_SF';
        $table_AASF_alloted_posts_final = 'AASF_alloted_posts_final';
        $table_schools = 'schools';


        //$select = "AD.*,AP.system_alloted_post_total as alloted,AP.*";
        $select = "AD.id, AD.Designation, AD.is_permanent, AD.is_language_teacher, AD.is_special_teacher, AD.is_full_time, AD.is_teaching, AP.last_year_posts_temp, AP.last_year_posts_perm,AP.last_year_apl_posts_temp,AP.last_year_apl_posts_perm, AP.current_posts_temp, AP.current_posts_perm, AP.remark_difference, AP.system_alloted_post_total as alloted_prev, AD.display_order";
        $join = array(0 => "AASF_Designation as AD, AD.id = AP.designation_id");
        $data['saved_data_post_final'] = $saved_data_post_final = $this->ci->General->getdata_new("AASF_alloted_posts_final AP", $select, array("AP.request_id" => $request_id, "AP.is_active" => 1, "AP.academic_id" => $academic_id), "AD.display_order", $join);
        //echo '<pre>'; print_r($saved_data_post_final);
        //$this->output->enable_profiler(TRUE);
        /***/
        //$data['saved_data_post_final_core'] = $saved_data_post_final = $this->General->getdata_new("AASF_alloted_posts_final AP", $select, array("AP.request_id" => $request_id, "AP.is_active"=>1), "AD.display_order", $join);


        $data['academic_year'] = $academic_year = getacademic_year_from_request($request_id);
        $data['academic_year_id'] = $academic_year_id = getacademic_year_id_from_request($request_id);

        $data['reqId'] = $reqId = $request_id;
        $data['draftNo'] = $draftNo = $this->ci->DNM->generateDraftNo($reqId);

        $data['req_type'] = $req_type = $this->ci->CM->getRequestType($reqId);
        // $req_table = $this->table_Request;
        // if($req_type==2)
        $req_table = $table_Request_SF;
        $data['file_number'] = $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $reqId))->file_number;
        $data['current_user_data'] = $current_user_data = get_current_user_data();

        $draftName = 'Proceedings';
        $current_time = date("Y-m-d H:i:s");
        $officeId = $current_user_data['office_id'];
        $data['office_name'] = $office_name = $current_user_data['dist_name'];
        if ($current_user_data['master_office_id'] == 1007) {
            $office_name_type = 'ഉപജില്ലാ ';
            $data['office_name_mal'] = $office_name_mal = get_sub_district_malayalam($officeId);
        }
        if ($current_user_data['master_office_id'] == 1006) {
            $office_name_type = 'ജില്ലാ ';
            $data['office_name_mal'] = $office_name_mal = get_edu_district_malayalam($officeId);
        }
        $data['office_name_type'] = $office_name_type;
        $draft_template = 3;
        /***************************/
        $req_school_id = $this->ci->CM->get_school_from_request($request_id);
        // $all_alloted_post = $this->PM->process_posts($req_school_id);
        // $allotted_posts_school = $this->General->getdata($this->table_qualification, 'subject_reference', array('course_id' => $id));
        // $subject = $subject_ref['0']['subject_reference'];
        $school_id = $req_school_id;
        $data['school_name'] = $school_name = $this->ci->General->getrow($table_schools, 'school_name', array('id' => $school_id))->school_name;
        $data['school_name_mal'] = $school_name_mal = get_school_name_malayalam($req_school_id);
        $stdcnt = $data['stdcnt'] = $this->ci->DVM->getStdCount($school_id, $academic_year);

        $data['appln_submitted_date'] = $appln_submitted_date = '';
        $appln_submitted_date = $this->ci->General->getrow($table_Request_SF, 'appln_final_submit_date', array('id' => $request_id))->appln_final_submit_date;
        if (isset($appln_submitted_date))
            $data['appln_submitted_date'] = $appln_submitted_date = mysql_to_date_hyphenformat($appln_submitted_date);

        $accm_detailsPre = $data['accm_detailsPre'] = $this->ci->General->getdata_new('AASF_Building_Dtls', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id, 'building_type' => 2, 'built_current_year!=' => 1), 'id', ''); // Pre KER-2

        $accm_detailsPost = $data['accm_detailsPost'] = $this->ci->General->getdata_new('AASF_Building_Dtls', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id, 'building_type' => 1, 'built_current_year!=' => 1), 'id', ''); // Post KER-1

        $accm_detailsCurrent = $data['accm_detailsCurrent'] = $this->ci->General->getdata_new('AASF_Building_Dtls', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id, 'built_current_year' => 1), 'id', ''); // Post KER-1

        //echo '<pre>'; print_r($accm_details); die;

        $fitness_details = $data['fitness_details'] = $this->ci->General->getdata_new('AASF_Building_Fit_history', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id), 'id', '');
        $data['school_id'] = $school_id;
        $category = $data['category'] = $this->ci->General->prepare_select_box_data_new('AASF_Building_Category', 'id,category', '', '', 'id');
        $build_type = $data['build_type'] = $this->ci->General->prepare_select_box_data_new('AASF_Building_Type', 'id,type', '', '', 'id');


        $alloted_post = $data['alloted_post'] = $this->ci->PTM->get_post_allotted_post($request_id);
        $tmp_core_allotted = $this->ci->PTM->get_post_allotted_post_core($request_id);
        $core_allot = array();
        foreach ($tmp_core_allotted as $tmp_core) {
            $core_allot[$tmp_core['display_order']] = $tmp_core;
        }
        $alloted_post_core = $data['alloted_post_core'] = $core_allot;

        //$this->output->enable_profiler(TRUE);
        $data['entered'] = $entered = $this->ci->General->getdata_new('AASF_SF_Stud_Dtls as AF', 'AF.*', array('school_id' => $school_id, 'academic_id' => $academic_year_id), 'id');
        if (count($entered) > 0) {
            foreach ($entered as $key => $value) {
                $newdata[$value['course_id']] = $value;
            }
        }

        $join = array(0 => "AASF_SF_Stud_Dtls_Child as AD , AD.parent_id = A.id");
        $child_details = $this->ci->General->getdata_new("AASF_SF_Stud_Dtls as A", "A.course_id,AD.*", array('A.school_id' => $school_id, 'A.academic_id' => $academic_year_id), 'A.id', $join);
        //print_r($child_details); die;
        if (count($child_details) > 0) {
            foreach ($child_details as $key => $value) {
                $childdata[$value['course_id']][$value['language_id']] = $value;
            }
        }
        $art_or_craft = $data['art_or_craft'] = $this->ci->General->getdata_new("AASF_SF_Art_or_Craft as B", "B.*", array("B.school_id" => $school_id, 'academic_year_id' => $academic_year_id), "", "", "school_id");
        $declaration_details = $data['declaration_details'] = $this->ci->General->getdata_new('sixth_workingday_prologue', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id), 'id', '');

        $details = $data['details'] = @$newdata;
        $child_data = $data['child_data'] = @$childdata;

        $data['name_user'] = $name_user = get_name_of_user_by_id(@$this->ci->session->userdata('user_id'));
        ////////////////
        ////////////////

        $total_stdcnt = $total_stdcnt_with_uid_eid = $total_stdcnt_with_no_uid_eid =
            $total_affidavit_stdcnt = $total_re_adm_stdcnt = $total_ptr_stdcnt = $total_efft_str_stdcnt =
            $total_allowed_div_stdcnt = $total_allowed_div_last_year_stdcnt = $total_extra_divisions =
            $total_reduced_divisions =
            $total_arab_stdcnt = $tot_lparab = $tot_uparab = $tot_hsarab =
            $total_sanskrit_stdcnt = $tot_lpsanskrit = $tot_upsanskrit = $tot_hssanskrit =
            $total_urdu_stdcnt = $tot_lpurdu = $tot_upurdu = $tot_hsurdu =
            $total_tamil_stdcnt = $tot_lptamil = $tot_uptamil = $tot_hstamil =
            $total_kannada_stdcnt = $tot_lpkannada = $tot_upkannada = $tot_hskannada =
            $total_gujarathi_stdcnt = $tot_lpgujarathi = $tot_upgujarathi = $tot_hsgujarathi =
            $total_allowed_div_arab = $total_allowed_div_sanskrit = $total_allowed_div_urdu = $total_allowed_div_tamil = $total_allowed_div_kannada = $total_allowed_div_gujarathi = 0;


        $data['total_stdcnt'] = $data['total_stdcnt_with_uid_eid'] = $data['total_stdcnt_with_no_uid_eid'] =
            $data['total_affidavit_stdcnt'] = $data['total_re_adm_stdcnt'] = $data['total_ptr_stdcnt'] = $data['total_efft_str_stdcnt'] =
            $data['total_allowed_div_stdcnt'] = $data['total_allowed_div_last_year_stdcnt'] = $data['total_extra_divisions'] =
            $data['total_reduced_divisions'] = $data['total_arab_stdcnt'] = $data['tot_lparab'] = $data['tot_uparab'] = $data['tot_hsarab'] =
            $data['total_sanskrit_stdcnt'] = $data['tot_lpsanskrit'] = $data['tot_upsanskrit'] = $data['tot_hssanskrit'] =
            $data['total_urdu_stdcnt'] = $data['tot_lpurdu'] = $data['tot_upurdu'] = $data['tot_hsurdu'] =
            $data['total_tamil_stdcnt'] = $data['tot_lptamil'] = $data['tot_uptamil'] = $data['tot_hstamil'] =
            $data['total_kannada_stdcnt'] = $data['tot_lpkannada'] = $data['tot_upkannada'] = $data['tot_hskannada'] =
            $data['total_gujarathi_stdcnt'] = $data['tot_lpgujarathi'] = $data['tot_upgujarathi'] = $data['tot_hsgujarathi'] =
            $data['total_allowed_div_arab'] = $data['total_allowed_div_sanskrit'] = $data['total_allowed_div_urdu'] = $data['total_allowed_div_tamil'] = $data['total_allowed_div_kannada'] = $data['total_allowed_div_gujarathi'] = 0;


        $classwise_stdcount = $classwise_stdcount_with_uid_eid = $classwise_stdcount_with_no_uid_eid = $affidavit_stdcount = $re_adm_stdcount = $ptr_stdcount = $efft_str_stdcount = $allowed_div_stdcount = $allowed_div_last_year_stdcount = $extra_divisions = $reduced_divisions = $classwise_arab_stdcount = $allowed_div_arab =
            $classwise_sanskrit_stdcount = $allowed_div_sanskrit =
            $classwise_urdu_stdcount = $allowed_div_urdu =
            $classwise_tamil_stdcount = $allowed_div_tamil =
            $classwise_kannada_stdcount = $allowed_div_kannada =
            $classwise_gujarathi_stdcount = $allowed_div_gujarathi = array(1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '', 7 => '', 8 => '', 9 => '', 10 => '');

        $data['classwise_stdcount'] = $data['classwise_stdcount_with_uid_eid'] = $data['classwise_stdcount_with_no_uid_eid'] = $data['affidavit_stdcount'] = $data['re_adm_stdcount'] = $data['ptr_stdcount'] = $data['efft_str_stdcount'] = $data['allowed_div_stdcount'] = $data['allowed_div_last_year_stdcount'] = $data['extra_divisions'] = $data['reduced_divisions'] = $data['classwise_arab_stdcount'] = $data['allowed_div_arab'] =
            $data['classwise_sanskrit_stdcount'] = $data['allowed_div_sanskrit'] =
            $data['classwise_urdu_stdcount'] = $data['allowed_div_urdu'] =
            $data['classwise_tamil_stdcount'] = $data['allowed_div_tamil'] =
            $data['classwise_kannada_stdcount'] = $data['allowed_div_kannada'] =
            $data['classwise_gujarathi_stdcount'] = $data['allowed_div_gujarathi'] = array(1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '', 7 => '', 8 => '', 9 => '', 10 => '');

        for ($count_class = 1; $count_class <= 10; $count_class++) {
            if ((!empty($stdcnt)) && (count($stdcnt) > 0)) {
                if (array_key_exists($count_class, $stdcnt)) {

                    $data['classwise_stdcount'][$count_class] = $classwise_stdcount[$count_class] = $stdcnt[$count_class]['totalStudentsSampoorna'];
                    $data['total_stdcnt'] = $total_stdcnt = $total_stdcnt + $stdcnt[$count_class]['totalStudentsSampoorna'];

                    $data['classwise_stdcount_with_uid_eid'][$count_class] = $classwise_stdcount_with_uid_eid[$count_class] = $stdcnt[$count_class]['totalUid'] + $stdcnt[$count_class]['totalEid'];

                    $data['classwise_stdcount_with_no_uid_eid'][$count_class] = $classwise_stdcount_with_no_uid_eid[$count_class] = $stdcnt[$count_class]['totalStudentsSampoorna'] - ($stdcnt[$count_class]['totalUid'] + $stdcnt[$count_class]['totalEid']);

                    $data['total_stdcnt_with_uid_eid'] = $total_stdcnt_with_uid_eid =  $total_stdcnt_with_uid_eid + $stdcnt[$count_class]['totalUid'] + $stdcnt[$count_class]['totalEid'];

                    $data['total_stdcnt_with_no_uid_eid'] = $total_stdcnt_with_no_uid_eid = $total_stdcnt_with_no_uid_eid + $stdcnt[$count_class]['totalStudentsSampoorna'] - ($stdcnt[$count_class]['totalUid'] + $stdcnt[$count_class]['totalEid']);

                    /*
                    // ARAB
                    $data['classwise_arab_stdcount'][$count_class] = $classwise_arab_stdcount[$count_class] = ($stdcnt[$count_class]['l_arab_boys']+$stdcnt[$count_class]['l_arab_girls']);
                    $data['total_arab_stdcnt'] = $total_arab_stdcnt = $total_arab_stdcnt + $classwise_arab_stdcount[$count_class];

                    if($count_class < 5){
                        $data['tot_lparab'] = $tot_lparab =  $tot_lparab + ($stdcnt[$count_class]['l_arab_boys']+$stdcnt[$count_class]['l_arab_girls']);
                    }
                    if($count_class > 4 && $count_class < 8){
                        $data['tot_uparab'] = $tot_uparab =  $tot_uparab + ($stdcnt[$count_class]['l_arab_boys']+$stdcnt[$count_class]['l_arab_girls']);
                    }
                    if($count_class > 7){
                        $data['tot_hsarab'] = $tot_hsarab = $tot_hsarab + ($stdcnt[$count_class]['l_arab_boys']+$stdcnt[$count_class]['l_arab_girls']);
                    }

                    // SANSKRIT
                    $data['classwise_sanskrit_stdcount'][$count_class] = $classwise_sanskrit_stdcount[$count_class] = ($stdcnt[$count_class]['l_sanskrit_boys']+$stdcnt[$count_class]['l_sanskrit_girls']);

                    $data['total_sanskrit_stdcnt'] = $total_sanskrit_stdcnt  = $total_sanskrit_stdcnt + $classwise_sanskrit_stdcount[$count_class];

                    if($count_class < 5){
                        $data['tot_lpsanskrit'] = $tot_lpsanskrit = $tot_lpsanskrit + ($stdcnt[$count_class]['l_sanskrit_boys']+$stdcnt[$count_class]['l_sanskrit_girls']);
                    }
                    if($count_class > 4 && $count_class < 8){
                        $data['tot_upsanskrit'] = $tot_upsanskrit = $tot_upsanskrit + ($stdcnt[$count_class]['l_sanskrit_boys']+$stdcnt[$count_class]['l_sanskrit_girls']);
                    }
                    if($count_class > 7){
                        $data['tot_hssanskrit'] = $tot_hssanskrit = $tot_hssanskrit + ($stdcnt[$count_class]['l_sanskrit_boys']+$stdcnt[$count_class]['l_sanskrit_girls']);
                    }

                    // URDU
                    $data['classwise_urdu_stdcount'][$count_class] = $classwise_urdu_stdcount[$count_class] = ($stdcnt[$count_class]['l_urdu_boys']+$stdcnt[$count_class]['l_urdu_girls']);

                    $data['total_urdu_stdcnt'] = $total_urdu_stdcnt = $total_urdu_stdcnt + $classwise_urdu_stdcount[$count_class];

                    if($count_class < 5){
                        $data['tot_lpurdu'] = $tot_lpurdu = $tot_lpurdu + ($stdcnt[$count_class]['l_urdu_boys']+$stdcnt[$count_class]['l_urdu_girls']);
                    }
                    if($count_class > 4 && $count_class < 8){
                        $data['tot_upurdu'] = $tot_upurdu = $tot_upurdu + ($stdcnt[$count_class]['l_urdu_boys']+$stdcnt[$count_class]['l_urdu_girls']);
                    }
                    if($count_class > 7){
                        $data['tot_hsurdu'] = $tot_hsurdu = $tot_hsurdu + ($stdcnt[$count_class]['l_urdu_boys']+$stdcnt[$count_class]['l_urdu_girls']);
                    }

                    // TAMIL
                    $data['classwise_tamil_stdcount'][$count_class] = $classwise_tamil_stdcount[$count_class] = ($stdcnt[$count_class]['l_tamil_boys']+$stdcnt[$count_class]['l_tamil_girls']);

                    $data['total_tamil_stdcnt'] = $total_tamil_stdcnt = $total_tamil_stdcnt + $classwise_tamil_stdcount[$count_class];

                    if($count_class < 5){
                        $data['tot_lptamil'] = $tot_lptamil = $tot_lptamil + ($stdcnt[$count_class]['l_tamil_boys']+$stdcnt[$count_class]['l_tamil_girls']);
                    }
                    if($count_class > 4 && $count_class < 8){
                        $data['tot_uptamil'] = $tot_uptamil = $tot_uptamil + ($stdcnt[$count_class]['l_tamil_boys']+$stdcnt[$count_class]['l_tamil_girls']);
                    }
                    if($count_class > 7){
                        $data['tot_hstamil'] = $tot_hstamil = $tot_hstamil + ($stdcnt[$count_class]['l_tamil_boys']+$stdcnt[$count_class]['l_tamil_girls']);
                    }

                    // KANNADA
                    $data['classwise_kannada_stdcount'][$count_class]  = $classwise_kannada_stdcount[$count_class] = ($stdcnt[$count_class]['l_kannada_boys']+$stdcnt[$count_class]['l_kannada_girls']);

                    $data['total_kannada_stdcnt'] = $total_kannada_stdcnt = $total_kannada_stdcnt + $classwise_kannada_stdcount[$count_class];

                    if($count_class < 5){
                        $data['tot_lpkannada'] = $tot_lpkannada = $tot_lpkannada + ($stdcnt[$count_class]['l_kannada_boys']+$stdcnt[$count_class]['l_kannada_girls']);
                    }
                    if($count_class > 4 && $count_class < 8){
                        $data['tot_upkannada'] = $tot_upkannada = $tot_upkannada + ($stdcnt[$count_class]['l_kannada_boys']+$stdcnt[$count_class]['l_kannada_girls']);
                    }
                    if($count_class > 7){
                        $data['tot_hskannada'] = $tot_hskannada = $tot_hskannada + ($stdcnt[$count_class]['l_kannada_boys']+$stdcnt[$count_class]['l_kannada_girls']);
                    }

                    // GUJARATHI
                    $data['classwise_gujarathi_stdcount'][$count_class] = $classwise_gujarathi_stdcount[$count_class] = ($stdcnt[$count_class]['l_gujarathi_boys']+$stdcnt[$count_class]['l_gujarathi_girls']);

                    $data['total_gujarathi_stdcnt']  = $total_gujarathi_stdcnt = $total_gujarathi_stdcnt + $classwise_gujarathi_stdcount[$count_class];

                    if($count_class < 5){
                        $data['tot_lpgujarathi'] = $tot_lpgujarathi = $tot_lpgujarathi + ($stdcnt[$count_class]['l_gujarathi_boys']+$stdcnt[$count_class]['l_gujarathi_girls']);
                    }
                    if($count_class > 4 && $count_class < 8){
                        $data['tot_upgujarathi'] = $tot_upgujarathi = $tot_upgujarathi + ($stdcnt[$count_class]['l_gujarathi_boys']+$stdcnt[$count_class]['l_gujarathi_girls']);
                    }
                    if($count_class > 7){
                        $data['tot_hsgujarathi'] = $tot_hsgujarathi = $tot_hsgujarathi + ($stdcnt[$count_class]['l_gujarathi_boys']+$stdcnt[$count_class]['l_gujarathi_girls']);
                    }
                    */
                }
            }

            if ((!empty($child_data)) && (count($child_data) > 0)) {
                if (array_key_exists($count_class, $child_data)) {
                    // ARABIC
                    $data['allowed_div_arab'][$count_class] = $allowed_div_arab[$count_class] = @$child_data[$count_class][1]['allowed_div_curr_year'];
                    $data['total_allowed_div_arab'] = $total_allowed_div_arab = $total_allowed_div_arab + $allowed_div_arab[$count_class];

                    //SANSKRIT
                    $data['allowed_div_sanskrit'][$count_class] = $allowed_div_sanskrit[$count_class] = @$child_data[$count_class][2]['allowed_div_curr_year'];

                    $data['total_allowed_div_sanskrit'] = $total_allowed_div_sanskrit = $total_allowed_div_sanskrit + $allowed_div_sanskrit[$count_class];

                    // URDU
                    $data['allowed_div_urdu'][$count_class] = $allowed_div_urdu[$count_class] = @$child_data[$count_class][3]['allowed_div_curr_year'];

                    $data['total_allowed_div_urdu'] = $total_allowed_div_urdu = $total_allowed_div_urdu + $allowed_div_urdu[$count_class];

                    // TAMIL
                    $data['allowed_div_tamil'][$count_class] = $allowed_div_tamil[$count_class] = @$child_data[$count_class][4]['allowed_div_curr_year'];

                    $data['total_allowed_div_tamil'] = $total_allowed_div_tamil = $total_allowed_div_tamil + $allowed_div_tamil[$count_class];

                    // KANNADA
                    $data['allowed_div_kannada'][$count_class] = $allowed_div_kannada[$count_class] = @$child_data[$count_class][5]['allowed_div_curr_year'];

                    $data['total_allowed_div_kannada'] = $total_allowed_div_kannada = $total_allowed_div_kannada + $allowed_div_kannada[$count_class];

                    // GUJARATHI
                    $data['allowed_div_gujarathi'][$count_class] = $allowed_div_gujarathi[$count_class] = @$child_data[$count_class][6]['allowed_div_curr_year'];

                    $data['total_allowed_div_gujarathi'] = $total_allowed_div_gujarathi = $total_allowed_div_gujarathi + $allowed_div_gujarathi[$count_class];

                    ///////////////////////////////
                    ///////////////////////////////
                    // ARAB
                    $data['classwise_arab_stdcount'][$count_class] = $classwise_arab_stdcount[$count_class] = @$child_data[$count_class][1]['eff_strength'];
                    $data['total_arab_stdcnt'] = $total_arab_stdcnt = $total_arab_stdcnt + $classwise_arab_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lparab'] = $tot_lparab =  $tot_lparab + (@$child_data[$count_class][1]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_uparab'] = $tot_uparab =  $tot_uparab + (@$child_data[$count_class][1]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hsarab'] = $tot_hsarab = $tot_hsarab + (@$child_data[$count_class][1]['eff_strength']);
                    }

                    // SANSKRIT
                    $data['classwise_sanskrit_stdcount'][$count_class] = $classwise_sanskrit_stdcount[$count_class] = (@$child_data[$count_class][2]['eff_strength']);

                    $data['total_sanskrit_stdcnt'] = $total_sanskrit_stdcnt  = $total_sanskrit_stdcnt + $classwise_sanskrit_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lpsanskrit'] = $tot_lpsanskrit = $tot_lpsanskrit + (@$child_data[$count_class][2]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_upsanskrit'] = $tot_upsanskrit = $tot_upsanskrit + (@$child_data[$count_class][2]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hssanskrit'] = $tot_hssanskrit = $tot_hssanskrit + (@$child_data[$count_class][2]['eff_strength']);
                    }

                    // URDU
                    $data['classwise_urdu_stdcount'][$count_class] = $classwise_urdu_stdcount[$count_class] = (@$child_data[$count_class][3]['eff_strength']);

                    $data['total_urdu_stdcnt'] = $total_urdu_stdcnt = $total_urdu_stdcnt + $classwise_urdu_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lpurdu'] = $tot_lpurdu = $tot_lpurdu + (@$child_data[$count_class][3]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_upurdu'] = $tot_upurdu = $tot_upurdu + (@$child_data[$count_class][3]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hsurdu'] = $tot_hsurdu = $tot_hsurdu + (@$child_data[$count_class][3]['eff_strength']);
                    }

                    // TAMIL
                    $data['classwise_tamil_stdcount'][$count_class] = $classwise_tamil_stdcount[$count_class] = (@$child_data[$count_class][4]['eff_strength']);

                    $data['total_tamil_stdcnt'] = $total_tamil_stdcnt = $total_tamil_stdcnt + $classwise_tamil_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lptamil'] = $tot_lptamil = $tot_lptamil + (@$child_data[$count_class][4]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_uptamil'] = $tot_uptamil = $tot_uptamil + (@$child_data[$count_class][4]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hstamil'] = $tot_hstamil = $tot_hstamil + (@$child_data[$count_class][4]['eff_strength']);
                    }

                    // KANNADA
                    $data['classwise_kannada_stdcount'][$count_class]  = $classwise_kannada_stdcount[$count_class] = (@$child_data[$count_class][5]['eff_strength']);

                    $data['total_kannada_stdcnt'] = $total_kannada_stdcnt = $total_kannada_stdcnt + $classwise_kannada_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lpkannada'] = $tot_lpkannada = $tot_lpkannada + (@$child_data[$count_class][5]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_upkannada'] = $tot_upkannada = $tot_upkannada + (@$child_data[$count_class][5]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hskannada'] = $tot_hskannada = $tot_hskannada + (@$child_data[$count_class][5]['eff_strength']);
                    }

                    // GUJARATHI
                    $data['classwise_gujarathi_stdcount'][$count_class] = $classwise_gujarathi_stdcount[$count_class] = (@$child_data[$count_class][6]['eff_strength']);

                    $data['total_gujarathi_stdcnt']  = $total_gujarathi_stdcnt = $total_gujarathi_stdcnt + $classwise_gujarathi_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lpgujarathi'] = $tot_lpgujarathi = $tot_lpgujarathi + (@$child_data[$count_class][6]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_upgujarathi'] = $tot_upgujarathi = $tot_upgujarathi + (@$child_data[$count_class][6]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hsgujarathi'] = $tot_hsgujarathi = $tot_hsgujarathi + (@$child_data[$count_class][6]['eff_strength']);
                    }
                    ///////////////////////////////
                    ///////////////////////////////
                }
            }

            if ((!empty($details)) && (count($details) > 0)) {
                if (array_key_exists($count_class, $details)) {
                    $data['affidavit_stdcount'][$count_class] = $affidavit_stdcount[$count_class] = @$details[$count_class]['nonuid_role_str'];
                    $data['total_affidavit_stdcnt'] = $total_affidavit_stdcnt = $total_affidavit_stdcnt + $details[$count_class]['nonuid_role_str'];

                    $data['re_adm_stdcount'][$count_class] = $re_adm_stdcount[$count_class] = @$details[$count_class]['neglected_readmns'];
                    $data['total_re_adm_stdcnt'] = $total_re_adm_stdcnt = $total_re_adm_stdcnt + $details[$count_class]['neglected_readmns'];

                    $data['ptr_stdcount'][$count_class] = $ptr_stdcount[$count_class] = $details[$count_class]['ptr_accomod_div'];
                    $data['total_ptr_stdcnt'] = $total_ptr_stdcnt = $total_ptr_stdcnt + $details[$count_class]['ptr_accomod_div'];

                    $data['allowed_div_stdcount'][$count_class] = $allowed_div_stdcount[$count_class] = $details[$count_class]['allowed_div_curr_year'];
                    $data['total_allowed_div_stdcnt'] = $total_allowed_div_stdcnt = $total_allowed_div_stdcnt + $details[$count_class]['allowed_div_curr_year'];

                    $data['allowed_div_last_year_stdcount'][$count_class] = $allowed_div_last_year_stdcount[$count_class] = @$details[$count_class]['allowed_div_last_year'];
                    $data['total_allowed_div_last_year_stdcnt'] = $total_allowed_div_last_year_stdcnt = $total_allowed_div_last_year_stdcnt + @$details[$count_class]['allowed_div_last_year'];

                    if ($allowed_div_stdcount[$count_class] > $allowed_div_last_year_stdcount[$count_class]) {
                        $data['extra_divisions'][$count_class] = $extra_divisions[$count_class] = @$allowed_div_stdcount[$count_class] - @$allowed_div_last_year_stdcount[$count_class];
                        $data['total_extra_divisions'] = $total_extra_divisions = $total_extra_divisions + @$extra_divisions[$count_class];
                    } else {
                        $data['reduced_divisions'][$count_class] = $reduced_divisions[$count_class] = @$allowed_div_last_year_stdcount[$count_class] - @$allowed_div_stdcount[$count_class];
                        $data['total_reduced_divisions'] = $total_reduced_divisions = $total_reduced_divisions + @$reduced_divisions[$count_class];
                    }
                }
            }

            //$efft_str_stdcount[$count_class] = ($classwise_stdcount_with_uid_eid[$count_class]+$classwise_stdcount_with_no_uid_eid[$count_class]) - $re_adm_stdcount[$count_class];

            $efft_str_stdcount[$count_class] = ($classwise_stdcount_with_uid_eid[$count_class] + $affidavit_stdcount[$count_class]) - $re_adm_stdcount[$count_class];

            if ($efft_str_stdcount[$count_class] > 0)
                $data['efft_str_stdcount'][$count_class] = $efft_str_stdcount[$count_class];
            else
                $data['efft_str_stdcount'][$count_class] = '';

            $data['total_efft_str_stdcnt'] = $total_efft_str_stdcnt = $total_efft_str_stdcnt + $efft_str_stdcount[$count_class];
        }
        $data['recognized'] = $this->ci->General->getdata("AASF_school_recognized", "*", array("request_id" => $request_id), "");
        $data['measuring_units'] = $measuring_units = array('Metres', 'Feet');
        //// loading template and store as string
        //print_r($classwise_stdcount);
        $notes = $this->ci->load->view($fview . 'filenavs/post_sf_proceedings', $data, true);
        // echo $notes;
        return $notes;
    }


    function generateProceedingsAdditionalSF($request_id = NULL)
    {
        // if($this->input->post('request_id'))
        //     $request_id = $this->input->post('request_id');
        $academic_id = getAcademicIdFromRequest($request_id, REQ_TYPE_SF);
        $fview = "secured_user/";
        $table_Request_SF = 'AASF_Request_SF';
        $table_AASF_alloted_posts_final = 'AASF_alloted_posts_final';
        $table_schools = 'schools';


        //$select = "AD.*,AP.system_alloted_post_total as alloted,AP.*";
        // $select = "AD.id, AD.Designation, AD.is_permanent, AD.is_language_teacher, AD.is_special_teacher, AD.is_full_time, AD.is_teaching, AP.last_year_posts_temp, AP.last_year_posts_perm, AP.current_posts_temp, AP.current_posts_perm, AP.remark_difference, AP.system_alloted_post_total as alloted_prev, AD.display_order";
        $select = "AD.id, AD.Designation, AD.is_permanent, AD.is_language_teacher, AD.is_special_teacher, AD.is_full_time, AD.is_teaching, AP.last_year_posts_temp, AP.last_year_posts_perm,AP.last_year_apl_posts_temp,AP.last_year_apl_posts_perm, AP.current_posts_temp, AP.current_posts_perm, AP.remark_difference, AP.system_alloted_post_total as alloted_prev, AD.display_order";
        $join = array(0 => "AASF_Designation as AD, AD.id = AP.designation_id");
        $data['saved_data_post_final'] = $saved_data_post_final = $this->ci->General->getdata_new("AASF_alloted_posts_final AP", $select, array("AP.request_id" => $request_id, "AP.is_active" => 1, "AP.academic_id" => $academic_id), "AD.display_order", $join);
        //echo '<pre>'; print_r($saved_data_post_final);
        //$this->output->enable_profiler(TRUE);
        /***/
        //$data['saved_data_post_final_core'] = $saved_data_post_final = $this->General->getdata_new("AASF_alloted_posts_final AP", $select, array("AP.request_id" => $request_id, "AP.is_active"=>1), "AD.display_order", $join);
        
        
        $data['academic_year'] = $academic_year = getacademic_year_from_request($request_id);
        $data['academic_year_id'] = $academic_year_id = getacademic_year_id_from_request($request_id);

        $data['reqId'] = $reqId = $request_id;
        $data['draftNo'] = $draftNo = $this->ci->DNM->generateDraftNo($reqId);

        $data['req_type'] = $req_type = $this->ci->CM->getRequestType($reqId);
        // $req_table = $this->table_Request;
        // if($req_type==2)
        $req_table = $table_Request_SF;
        $data['file_number'] = $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $reqId))->file_number;
        $data['current_user_data'] = $current_user_data = get_current_user_data();

        $draftName = 'Proceedings';
        $current_time = date("Y-m-d H:i:s");
        $officeId = $current_user_data['office_id'];
        $data['office_name'] = $office_name = $current_user_data['dist_name'];
        if ($current_user_data['master_office_id'] == 1007) {
            $office_name_type = 'ഉപജില്ലാ ';
            $data['office_name_mal'] = $office_name_mal = get_sub_district_malayalam($officeId);
        }
        if ($current_user_data['master_office_id'] == 1006) {
            $office_name_type = 'ജില്ലാ ';
            $data['office_name_mal'] = $office_name_mal = get_edu_district_malayalam($officeId);
        }
        $data['office_name_type'] = $office_name_type;
        $draft_template = 3;
        /***************************/
        $req_school_id = $this->ci->CM->get_school_from_request($request_id);
        // $all_alloted_post = $this->PM->process_posts($req_school_id);
        // $allotted_posts_school = $this->General->getdata($this->table_qualification, 'subject_reference', array('course_id' => $id));
        // $subject = $subject_ref['0']['subject_reference'];
        $school_id = $req_school_id;
        $data['school_name'] = $school_name = $this->ci->General->getrow($table_schools, 'school_name', array('id' => $school_id))->school_name;
        $data['school_name_mal'] = $school_name_mal = get_school_name_malayalam($req_school_id);
        $stdcnt = $data['stdcnt'] = $this->ci->DVM->getStdCount($school_id, $academic_year);

        $data['appln_submitted_date'] = $appln_submitted_date = '';
        $appln_submitted_date = $this->ci->General->getrow($table_Request_SF, 'appln_final_submit_date', array('id' => $request_id))->appln_final_submit_date;
        if (isset($appln_submitted_date))
            $data['appln_submitted_date'] = $appln_submitted_date = mysql_to_date_hyphenformat($appln_submitted_date);

        $accm_detailsPre = $data['accm_detailsPre'] = $this->ci->General->getdata_new('AASF_Building_Dtls', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id, 'building_type' => 2, 'built_current_year!=' => 1), 'id', ''); // Pre KER-2

        $accm_detailsPost = $data['accm_detailsPost'] = $this->ci->General->getdata_new('AASF_Building_Dtls', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id, 'building_type' => 1, 'built_current_year!=' => 1), 'id', ''); // Post KER-1

        $accm_detailsCurrent = $data['accm_detailsCurrent'] = $this->ci->General->getdata_new('AASF_Building_Dtls', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id, 'built_current_year' => 1), 'id', ''); // Post KER-1

        //echo '<pre>'; print_r($accm_details); die;

        $fitness_details = $data['fitness_details'] = $this->ci->General->getdata_new('AASF_Building_Fit_history', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id), 'id', '');
        $data['school_id'] = $school_id;







        
        $category = $data['category'] = $this->ci->General->prepare_select_box_data_new('AASF_Building_Category', 'id,category', '', '', 'id');
        $build_type = $data['build_type'] = $this->ci->General->prepare_select_box_data_new('AASF_Building_Type', 'id,type', '', '', 'id');


        $alloted_post = $data['alloted_post'] = $this->ci->PTM->get_post_allotted_post($request_id);
        $tmp_core_allotted = $this->ci->PTM->get_post_allotted_post_core($request_id);
        $core_allot = array();
        foreach ($tmp_core_allotted as $tmp_core) {
            $core_allot[$tmp_core['display_order']] = $tmp_core;
        }
        $alloted_post_core = $data['alloted_post_core'] = $core_allot;

        //$this->output->enable_profiler(TRUE);
        $data['entered'] = $entered = $this->ci->General->getdata_new('AASF_SF_Stud_Dtls as AF', 'AF.*', array('school_id' => $school_id, 'academic_id' => $academic_year_id), 'id');
        if (count($entered) > 0) {
            foreach ($entered as $key => $value) {
                $newdata[$value['course_id']] = $value;
            }
        }

        $join = array(0 => "AASF_SF_Stud_Dtls_Child as AD , AD.parent_id = A.id");
        $child_details = $this->ci->General->getdata_new("AASF_SF_Stud_Dtls as A", "A.course_id,AD.*", array('A.school_id' => $school_id, 'A.academic_id' => $academic_year_id), 'A.id', $join);
        //print_r($child_details); die;
        if (count($child_details) > 0) {
            foreach ($child_details as $key => $value) {
                $childdata[$value['course_id']][$value['language_id']] = $value;
            }
        }
        $art_or_craft = $data['art_or_craft'] = $this->ci->General->getdata_new("AASF_SF_Art_or_Craft as B", "B.*", array("B.school_id" => $school_id, 'academic_year_id' => $academic_year_id), "", "", "school_id");
        $declaration_details = $data['declaration_details'] = $this->ci->General->getdata_new('sixth_workingday_prologue', '*', array('school_id' => $school_id, 'academic_id' => $academic_year_id), 'id', '');

        $details = $data['details'] = @$newdata;
        $child_data = $data['child_data'] = @$childdata;

        $data['name_user'] = $name_user = get_name_of_user_by_id(@$this->ci->session->userdata('user_id'));
        ////////////////
        ////////////////


        
        //START - Newly added for additional post section and proceedings change
        $data['school_code'] = getSchoolCodeFromId($school_id);
        $data['district_name'] = get_district_malayalam($current_user_data['district_id']);

        if ($this->get_master_office_id() == DEO_OFFICE || $this->get_master_office_id() == AEO_OFFICE) {
            $type = 1;
        }
        $data['school_visit'] = $this->ci->General->getrow('school_visit_details','id,DATE_FORMAT(school_visit_date, "%d/%m/%Y") AS school_visit_date,remarks,additional_status,has_accommodation_changes,accommodation_changes_reason,is_confirmed', array('school_id' => $school_id, 'request_id' => $request_id, 'academic_id' => $academic_year_id, 'type' => $type));
        
        
        $school_visit_final_post_details_arr = array();
        $school_visit_final_post_details = $this->ci->General->getdata('school_visit_final_post_details','designation_id,approved_posts,additional_posts,remarks',array('request_id'=>$request_id,'academic_id'=>$academic_id));
        foreach($school_visit_final_post_details as $key=>$value){
            $school_visit_final_post_details_arr[$value['designation_id']] = $value;
        }
        $data['school_visit_final_post_details'] = $school_visit_final_post_details_arr;
        

        $course_ids    = $this->ci->School_Model2->getcourse_ids($school_id);
        $course_ids_array = explode(",", $course_ids);
        $data['course_ids'] = \array_diff($course_ids_array, [11, 12]);
        $data['strength_details'] = $this->ci->PTM->getStrengthDetails($request_id,$school_id);
        $data['division_details'] = $this->ci->PTM->getDivisionDetails($request_id,$school_id);

        $division_details_total_count = 0;
        $division_details_total_count_arabic = 0;
        $division_details_total_count_sanskrit = 0;
        $division_details_total_count_urdu = 0;
        $division_details_total_count_tamil = 0;
        $division_details_total_count_kannada = 0;
        $division_details_total_count_gujarathi = 0;

        $total_strength_details_school_visit = 0;
        $total_strength_school_visit_arabic_lp = 0;
        $total_strength_school_visit_arabic_up = 0;
        $total_strength_school_visit_arabic_hs = 0;
        $total_strength_school_visit_sanskrit_lp = 0;
        $total_strength_school_visit_sanskrit_up = 0;
        $total_strength_school_visit_sanskrit_hs = 0;
        $total_strength_school_visit_urdu_lp = 0;
        $total_strength_school_visit_urdu_up = 0;
        $total_strength_school_visit_urdu_hs = 0;
        $total_strength_school_visit_tamil_lp = 0;
        $total_strength_school_visit_tamil_up = 0;
        $total_strength_school_visit_tamil_hs = 0;
        $total_strength_school_visit_kannada_lp = 0;
        $total_strength_school_visit_kannada_up = 0;
        $total_strength_school_visit_kannada_hs = 0;
        $total_strength_school_visit_gujarathi_lp = 0;
        $total_strength_school_visit_gujarathi_up = 0;
        $total_strength_school_visit_gujarathi_hs = 0;

        $total_school_visit_reduced_divisions = array();
        $reduced_divisions_school_visit = array();
        $grand_total_school_visit_reduced_divisions = 0;

        foreach ($data['course_ids'] as $value) {
            $division_details_total_count += $data['division_details'][$value][0]['approved_division'];
            $division_details_total_count_arabic += $data['division_details'][$value][1]['approved_division'];
            $division_details_total_count_sanskrit += $data['division_details'][$value][2]['approved_division'];
            $division_details_total_count_urdu += $data['division_details'][$value][3]['approved_division'];
            $division_details_total_count_tamil += $data['division_details'][$value][4]['approved_division'];
            $division_details_total_count_kannada += $data['division_details'][$value][5]['approved_division'];
            $division_details_total_count_gujarathi += $data['division_details'][$value][6]['approved_division'];

            $reduced_count = @$details[$value]['allowed_div_last_year']-@$data['division_details'][$value][0]['approved_division'];
            if($reduced_count<0){
                $reduced_count = 0;
            }
            $total_school_visit_reduced_divisions[$value] = $reduced_count;
            $grand_total_school_visit_reduced_divisions += $reduced_count;


            $total_strength_details_school_visit += $data['strength_details'][$value]['strength_for_sf'];

            if ($value < 5) {
                $total_strength_school_visit_arabic_lp += $data['division_details'][$value][1]['total_students'];
                $total_strength_school_visit_sanskrit_lp += $data['division_details'][$value][2]['total_students'];
                $total_strength_school_visit_urdu_lp += $data['division_details'][$value][3]['total_students'];
                $total_strength_school_visit_tamil_lp += $data['division_details'][$value][4]['total_students'];
                $total_strength_school_visit_kannada_lp += $data['division_details'][$value][5]['total_students'];
                $total_strength_school_visit_gujarathi_lp += $data['division_details'][$value][6]['total_students'];
            }
            if ($value > 4 && $value < 8) {
                $total_strength_school_visit_arabic_up += $data['division_details'][$value][1]['total_students'];
                $total_strength_school_visit_sanskrit_up += $data['division_details'][$value][2]['total_students'];
                $total_strength_school_visit_urdu_up += $data['division_details'][$value][3]['total_students'];
                $total_strength_school_visit_tamil_up += $data['division_details'][$value][4]['total_students'];
                $total_strength_school_visit_kannada_up += $data['division_details'][$value][5]['total_students'];
                $total_strength_school_visit_gujarathi_up += $data['division_details'][$value][6]['total_students'];
            }
            if ($value > 7) {
                $total_strength_school_visit_arabic_hs += $data['division_details'][$value][1]['total_students'];
                $total_strength_school_visit_sanskrit_hs += $data['division_details'][$value][2]['total_students'];
                $total_strength_school_visit_urdu_hs += $data['division_details'][$value][3]['total_students'];
                $total_strength_school_visit_tamil_hs += $data['division_details'][$value][4]['total_students'];
                $total_strength_school_visit_kannada_hs += $data['division_details'][$value][5]['total_students'];
                $total_strength_school_visit_gujarathi_hs += $data['division_details'][$value][6]['total_students'];
            }
            
        }
        $data['division_details_total_count'] = $division_details_total_count;
        $data['division_details_total_count_arabic'] = $division_details_total_count_arabic;
        $data['division_details_total_count_sanskrit'] = $division_details_total_count_sanskrit;
        $data['division_details_total_count_urdu'] = $division_details_total_count_urdu;
        $data['division_details_total_count_tamil'] = $division_details_total_count_tamil;
        $data['division_details_total_count_kannada'] = $division_details_total_count_kannada;
        $data['division_details_total_count_gujarathi'] = $division_details_total_count_gujarathi;

        $data['total_strength_details_school_visit'] = $total_strength_details_school_visit;
        $data['total_strength_school_visit_arabic_lp'] = $total_strength_school_visit_arabic_lp;
        $data['total_strength_school_visit_sanskrit_lp'] = $total_strength_school_visit_sanskrit_lp;
        $data['total_strength_school_visit_urdu_lp'] = $total_strength_school_visit_urdu_lp;
        $data['total_strength_school_visit_tamil_lp'] = $total_strength_school_visit_tamil_lp;
        $data['total_strength_school_visit_kannada_lp'] = $total_strength_school_visit_kannada_lp;
        $data['total_strength_school_visit_gujarathi_lp'] = $total_strength_school_visit_gujarathi_lp;
        $data['total_strength_school_visit_arabic_up'] = $total_strength_school_visit_arabic_up;
        $data['total_strength_school_visit_sanskrit_up'] = $total_strength_school_visit_sanskrit_up;
        $data['total_strength_school_visit_urdu_up'] = $total_strength_school_visit_urdu_up;
        $data['total_strength_school_visit_tamil_up'] = $total_strength_school_visit_tamil_up;
        $data['total_strength_school_visit_kannada_up'] = $total_strength_school_visit_kannada_up;
        $data['total_strength_school_visit_gujarathi_up'] = $total_strength_school_visit_gujarathi_up;
        $data['total_strength_school_visit_arabic_hs'] = $total_strength_school_visit_arabic_hs;
        $data['total_strength_school_visit_sanskrit_hs'] = $total_strength_school_visit_sanskrit_hs;
        $data['total_strength_school_visit_urdu_hs'] = $total_strength_school_visit_urdu_hs;
        $data['total_strength_school_visit_tamil_hs'] = $total_strength_school_visit_tamil_hs;
        $data['total_strength_school_visit_kannada_hs'] = $total_strength_school_visit_kannada_hs;
        $data['total_strength_school_visit_gujarathi_hs'] = $total_strength_school_visit_gujarathi_hs;

        $data['school_visit_reduced_divisions'] = $total_school_visit_reduced_divisions;
        $data['grand_total_school_visit_reduced_divisions'] = $grand_total_school_visit_reduced_divisions;



        $school_visit_final_div_details_arr = array();
        $school_visit_final_div_details = $this->ci->General->getdata('school_visit_total_division_details','course_id,language_id,additional_division',array('request_id'=>$request_id,'school_visit_id'=>$data['school_visit']->id));
        foreach ($school_visit_final_div_details as $row) {
            $school_visit_final_div_details_arr[$row['course_id']][$row['language_id']] = $row['additional_division'];
        }
        $data['school_visit_final_div_details'] = $school_visit_final_div_details_arr;
        $data['language_details'] = $this->ci->PTM->get_language_details($request_id);

        $data['school_visit_final_post_details_arr'] = $school_visit_final_post_details_arr;
        $data['additional_post_consolidation'] = $this->ci->PTM->getFinalPostDtls($request_id,$school_id);
        

       //END - Newly added for additional post section and proceedings change




        $total_stdcnt = $total_stdcnt_with_uid_eid = $total_stdcnt_with_no_uid_eid =
            $total_affidavit_stdcnt = $total_re_adm_stdcnt = $total_ptr_stdcnt = $total_efft_str_stdcnt =
            $total_allowed_div_stdcnt = $total_allowed_div_last_year_stdcnt = $total_extra_divisions =
            $total_reduced_divisions =
            $total_arab_stdcnt = $tot_lparab = $tot_uparab = $tot_hsarab =
            $total_sanskrit_stdcnt = $tot_lpsanskrit = $tot_upsanskrit = $tot_hssanskrit =
            $total_urdu_stdcnt = $tot_lpurdu = $tot_upurdu = $tot_hsurdu =
            $total_tamil_stdcnt = $tot_lptamil = $tot_uptamil = $tot_hstamil =
            $total_kannada_stdcnt = $tot_lpkannada = $tot_upkannada = $tot_hskannada =
            $total_gujarathi_stdcnt = $tot_lpgujarathi = $tot_upgujarathi = $tot_hsgujarathi =
            $total_allowed_div_arab = $total_allowed_div_sanskrit = $total_allowed_div_urdu = $total_allowed_div_tamil = $total_allowed_div_kannada = $total_allowed_div_gujarathi = 0;


        $data['total_stdcnt'] = $data['total_stdcnt_with_uid_eid'] = $data['total_stdcnt_with_no_uid_eid'] =
            $data['total_affidavit_stdcnt'] = $data['total_re_adm_stdcnt'] = $data['total_ptr_stdcnt'] = $data['total_efft_str_stdcnt'] =
            $data['total_allowed_div_stdcnt'] = $data['total_allowed_div_last_year_stdcnt'] = $data['total_extra_divisions'] =
            $data['total_reduced_divisions'] = $data['total_arab_stdcnt'] = $data['tot_lparab'] = $data['tot_uparab'] = $data['tot_hsarab'] =
            $data['total_sanskrit_stdcnt'] = $data['tot_lpsanskrit'] = $data['tot_upsanskrit'] = $data['tot_hssanskrit'] =
            $data['total_urdu_stdcnt'] = $data['tot_lpurdu'] = $data['tot_upurdu'] = $data['tot_hsurdu'] =
            $data['total_tamil_stdcnt'] = $data['tot_lptamil'] = $data['tot_uptamil'] = $data['tot_hstamil'] =
            $data['total_kannada_stdcnt'] = $data['tot_lpkannada'] = $data['tot_upkannada'] = $data['tot_hskannada'] =
            $data['total_gujarathi_stdcnt'] = $data['tot_lpgujarathi'] = $data['tot_upgujarathi'] = $data['tot_hsgujarathi'] =
            $data['total_allowed_div_arab'] = $data['total_allowed_div_sanskrit'] = $data['total_allowed_div_urdu'] = $data['total_allowed_div_tamil'] = $data['total_allowed_div_kannada'] = $data['total_allowed_div_gujarathi'] = 0;


        $classwise_stdcount = $classwise_stdcount_with_uid_eid = $classwise_stdcount_with_no_uid_eid = $affidavit_stdcount = $re_adm_stdcount = $ptr_stdcount = $efft_str_stdcount = $allowed_div_stdcount = $allowed_div_last_year_stdcount = $extra_divisions = $reduced_divisions = $classwise_arab_stdcount = $allowed_div_arab =
            $classwise_sanskrit_stdcount = $allowed_div_sanskrit =
            $classwise_urdu_stdcount = $allowed_div_urdu =
            $classwise_tamil_stdcount = $allowed_div_tamil =
            $classwise_kannada_stdcount = $allowed_div_kannada =
            $classwise_gujarathi_stdcount = $allowed_div_gujarathi = array(1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '', 7 => '', 8 => '', 9 => '', 10 => '');

        $data['classwise_stdcount'] = $data['classwise_stdcount_with_uid_eid'] = $data['classwise_stdcount_with_no_uid_eid'] = $data['affidavit_stdcount'] = $data['re_adm_stdcount'] = $data['ptr_stdcount'] = $data['efft_str_stdcount'] = $data['allowed_div_stdcount'] = $data['allowed_div_last_year_stdcount'] = $data['extra_divisions'] = $data['reduced_divisions'] = $data['classwise_arab_stdcount'] = $data['allowed_div_arab'] =
            $data['classwise_sanskrit_stdcount'] = $data['allowed_div_sanskrit'] =
            $data['classwise_urdu_stdcount'] = $data['allowed_div_urdu'] =
            $data['classwise_tamil_stdcount'] = $data['allowed_div_tamil'] =
            $data['classwise_kannada_stdcount'] = $data['allowed_div_kannada'] =
            $data['classwise_gujarathi_stdcount'] = $data['allowed_div_gujarathi'] = array(1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '', 7 => '', 8 => '', 9 => '', 10 => '');

        for ($count_class = 1; $count_class <= 10; $count_class++) {
            if ((!empty($stdcnt)) && (count($stdcnt) > 0)) {
                if (array_key_exists($count_class, $stdcnt)) {

                    $data['classwise_stdcount'][$count_class] = $classwise_stdcount[$count_class] = $stdcnt[$count_class]['totalStudentsSampoorna'];
                    $data['total_stdcnt'] = $total_stdcnt = $total_stdcnt + $stdcnt[$count_class]['totalStudentsSampoorna'];

                    $data['classwise_stdcount_with_uid_eid'][$count_class] = $classwise_stdcount_with_uid_eid[$count_class] = $stdcnt[$count_class]['totalUid'] + $stdcnt[$count_class]['totalEid'];

                    $data['classwise_stdcount_with_no_uid_eid'][$count_class] = $classwise_stdcount_with_no_uid_eid[$count_class] = $stdcnt[$count_class]['totalStudentsSampoorna'] - ($stdcnt[$count_class]['totalUid'] + $stdcnt[$count_class]['totalEid']);

                    $data['total_stdcnt_with_uid_eid'] = $total_stdcnt_with_uid_eid =  $total_stdcnt_with_uid_eid + $stdcnt[$count_class]['totalUid'] + $stdcnt[$count_class]['totalEid'];

                    $data['total_stdcnt_with_no_uid_eid'] = $total_stdcnt_with_no_uid_eid = $total_stdcnt_with_no_uid_eid + $stdcnt[$count_class]['totalStudentsSampoorna'] - ($stdcnt[$count_class]['totalUid'] + $stdcnt[$count_class]['totalEid']);

                }
            }

            if ((!empty($child_data)) && (count($child_data) > 0)) {
                if (array_key_exists($count_class, $child_data)) {
                    // ARABIC
                    $data['allowed_div_arab'][$count_class] = $allowed_div_arab[$count_class] = @$child_data[$count_class][1]['allowed_div_curr_year'];
                    $data['total_allowed_div_arab'] = $total_allowed_div_arab = $total_allowed_div_arab + $allowed_div_arab[$count_class];

                    //SANSKRIT
                    $data['allowed_div_sanskrit'][$count_class] = $allowed_div_sanskrit[$count_class] = @$child_data[$count_class][2]['allowed_div_curr_year'];

                    $data['total_allowed_div_sanskrit'] = $total_allowed_div_sanskrit = $total_allowed_div_sanskrit + $allowed_div_sanskrit[$count_class];

                    // URDU
                    $data['allowed_div_urdu'][$count_class] = $allowed_div_urdu[$count_class] = @$child_data[$count_class][3]['allowed_div_curr_year'];

                    $data['total_allowed_div_urdu'] = $total_allowed_div_urdu = $total_allowed_div_urdu + $allowed_div_urdu[$count_class];

                    // TAMIL
                    $data['allowed_div_tamil'][$count_class] = $allowed_div_tamil[$count_class] = @$child_data[$count_class][4]['allowed_div_curr_year'];

                    $data['total_allowed_div_tamil'] = $total_allowed_div_tamil = $total_allowed_div_tamil + $allowed_div_tamil[$count_class];

                    // KANNADA
                    $data['allowed_div_kannada'][$count_class] = $allowed_div_kannada[$count_class] = @$child_data[$count_class][5]['allowed_div_curr_year'];

                    $data['total_allowed_div_kannada'] = $total_allowed_div_kannada = $total_allowed_div_kannada + $allowed_div_kannada[$count_class];

                    // GUJARATHI
                    $data['allowed_div_gujarathi'][$count_class] = $allowed_div_gujarathi[$count_class] = @$child_data[$count_class][6]['allowed_div_curr_year'];

                    $data['total_allowed_div_gujarathi'] = $total_allowed_div_gujarathi = $total_allowed_div_gujarathi + $allowed_div_gujarathi[$count_class];

                    ///////////////////////////////
                    ///////////////////////////////
                    // ARAB
                    $data['classwise_arab_stdcount'][$count_class] = $classwise_arab_stdcount[$count_class] = @$child_data[$count_class][1]['eff_strength'];
                    $data['total_arab_stdcnt'] = $total_arab_stdcnt = $total_arab_stdcnt + $classwise_arab_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lparab'] = $tot_lparab =  $tot_lparab + (@$child_data[$count_class][1]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_uparab'] = $tot_uparab =  $tot_uparab + (@$child_data[$count_class][1]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hsarab'] = $tot_hsarab = $tot_hsarab + (@$child_data[$count_class][1]['eff_strength']);
                    }

                    // SANSKRIT
                    $data['classwise_sanskrit_stdcount'][$count_class] = $classwise_sanskrit_stdcount[$count_class] = (@$child_data[$count_class][2]['eff_strength']);

                    $data['total_sanskrit_stdcnt'] = $total_sanskrit_stdcnt  = $total_sanskrit_stdcnt + $classwise_sanskrit_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lpsanskrit'] = $tot_lpsanskrit = $tot_lpsanskrit + (@$child_data[$count_class][2]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_upsanskrit'] = $tot_upsanskrit = $tot_upsanskrit + (@$child_data[$count_class][2]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hssanskrit'] = $tot_hssanskrit = $tot_hssanskrit + (@$child_data[$count_class][2]['eff_strength']);
                    }

                    // URDU
                    $data['classwise_urdu_stdcount'][$count_class] = $classwise_urdu_stdcount[$count_class] = (@$child_data[$count_class][3]['eff_strength']);

                    $data['total_urdu_stdcnt'] = $total_urdu_stdcnt = $total_urdu_stdcnt + $classwise_urdu_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lpurdu'] = $tot_lpurdu = $tot_lpurdu + (@$child_data[$count_class][3]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_upurdu'] = $tot_upurdu = $tot_upurdu + (@$child_data[$count_class][3]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hsurdu'] = $tot_hsurdu = $tot_hsurdu + (@$child_data[$count_class][3]['eff_strength']);
                    }

                    // TAMIL
                    $data['classwise_tamil_stdcount'][$count_class] = $classwise_tamil_stdcount[$count_class] = (@$child_data[$count_class][4]['eff_strength']);

                    $data['total_tamil_stdcnt'] = $total_tamil_stdcnt = $total_tamil_stdcnt + $classwise_tamil_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lptamil'] = $tot_lptamil = $tot_lptamil + (@$child_data[$count_class][4]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_uptamil'] = $tot_uptamil = $tot_uptamil + (@$child_data[$count_class][4]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hstamil'] = $tot_hstamil = $tot_hstamil + (@$child_data[$count_class][4]['eff_strength']);
                    }

                    // KANNADA
                    $data['classwise_kannada_stdcount'][$count_class]  = $classwise_kannada_stdcount[$count_class] = (@$child_data[$count_class][5]['eff_strength']);

                    $data['total_kannada_stdcnt'] = $total_kannada_stdcnt = $total_kannada_stdcnt + $classwise_kannada_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lpkannada'] = $tot_lpkannada = $tot_lpkannada + (@$child_data[$count_class][5]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_upkannada'] = $tot_upkannada = $tot_upkannada + (@$child_data[$count_class][5]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hskannada'] = $tot_hskannada = $tot_hskannada + (@$child_data[$count_class][5]['eff_strength']);
                    }

                    // GUJARATHI
                    $data['classwise_gujarathi_stdcount'][$count_class] = $classwise_gujarathi_stdcount[$count_class] = (@$child_data[$count_class][6]['eff_strength']);

                    $data['total_gujarathi_stdcnt']  = $total_gujarathi_stdcnt = $total_gujarathi_stdcnt + $classwise_gujarathi_stdcount[$count_class];

                    if ($count_class < 5) {
                        $data['tot_lpgujarathi'] = $tot_lpgujarathi = $tot_lpgujarathi + (@$child_data[$count_class][6]['eff_strength']);
                    }
                    if ($count_class > 4 && $count_class < 8) {
                        $data['tot_upgujarathi'] = $tot_upgujarathi = $tot_upgujarathi + (@$child_data[$count_class][6]['eff_strength']);
                    }
                    if ($count_class > 7) {
                        $data['tot_hsgujarathi'] = $tot_hsgujarathi = $tot_hsgujarathi + (@$child_data[$count_class][6]['eff_strength']);
                    }
                    ///////////////////////////////
                    ///////////////////////////////
                }
            }

            if ((!empty($details)) && (count($details) > 0)) {
                if (array_key_exists($count_class, $details)) {
                    $data['affidavit_stdcount'][$count_class] = $affidavit_stdcount[$count_class] = @$details[$count_class]['nonuid_role_str'];
                    $data['total_affidavit_stdcnt'] = $total_affidavit_stdcnt = $total_affidavit_stdcnt + $details[$count_class]['nonuid_role_str'];

                    $data['re_adm_stdcount'][$count_class] = $re_adm_stdcount[$count_class] = @$details[$count_class]['neglected_readmns'];
                    $data['total_re_adm_stdcnt'] = $total_re_adm_stdcnt = $total_re_adm_stdcnt + $details[$count_class]['neglected_readmns'];

                    $data['ptr_stdcount'][$count_class] = $ptr_stdcount[$count_class] = $details[$count_class]['ptr_accomod_div'];
                    $data['total_ptr_stdcnt'] = $total_ptr_stdcnt = $total_ptr_stdcnt + $details[$count_class]['ptr_accomod_div'];

                    $data['allowed_div_stdcount'][$count_class] = $allowed_div_stdcount[$count_class] = $details[$count_class]['allowed_div_curr_year'];
                    $data['total_allowed_div_stdcnt'] = $total_allowed_div_stdcnt = $total_allowed_div_stdcnt + $details[$count_class]['allowed_div_curr_year'];

                    $data['allowed_div_last_year_stdcount'][$count_class] = $allowed_div_last_year_stdcount[$count_class] = @$details[$count_class]['allowed_div_last_year'];
                    $data['total_allowed_div_last_year_stdcnt'] = $total_allowed_div_last_year_stdcnt = $total_allowed_div_last_year_stdcnt + @$details[$count_class]['allowed_div_last_year'];

                    if ($allowed_div_stdcount[$count_class] > $allowed_div_last_year_stdcount[$count_class]) {
                        $data['extra_divisions'][$count_class] = $extra_divisions[$count_class] = @$allowed_div_stdcount[$count_class] - @$allowed_div_last_year_stdcount[$count_class];
                        $data['total_extra_divisions'] = $total_extra_divisions = $total_extra_divisions + @$extra_divisions[$count_class];
                    } else {
                        $data['reduced_divisions'][$count_class] = $reduced_divisions[$count_class] = @$allowed_div_last_year_stdcount[$count_class] - @$allowed_div_stdcount[$count_class];
                        $data['total_reduced_divisions'] = $total_reduced_divisions = $total_reduced_divisions + @$reduced_divisions[$count_class];
                    }
                }
            }

            //$efft_str_stdcount[$count_class] = ($classwise_stdcount_with_uid_eid[$count_class]+$classwise_stdcount_with_no_uid_eid[$count_class]) - $re_adm_stdcount[$count_class];

            $efft_str_stdcount[$count_class] = ($classwise_stdcount_with_uid_eid[$count_class] + $affidavit_stdcount[$count_class]) - $re_adm_stdcount[$count_class];

            if ($efft_str_stdcount[$count_class] > 0)
                $data['efft_str_stdcount'][$count_class] = $efft_str_stdcount[$count_class];
            else
                $data['efft_str_stdcount'][$count_class] = '';

            $data['total_efft_str_stdcnt'] = $total_efft_str_stdcnt = $total_efft_str_stdcnt + $efft_str_stdcount[$count_class];
        }
        $data['recognized'] = $this->ci->General->getdata("AASF_school_recognized", "*", array("request_id" => $request_id), "");
        $data['measuring_units'] = $measuring_units = array('Metres', 'Feet');
        //// loading template and store as string
        //print_r($classwise_stdcount);
        $notes = $this->ci->load->view($fview . 'filenavs/additional_post_sf_proceedings', $data, true);
        // echo $notes;
        return $notes;
    }

    function generateHearingLetter($request_id = NULL, $data = NULL)
    {
        $fview = "secured_user/";
        $notes = $this->ci->load->view($fview . 'filenavs/hearing_letter', $data, true);
        return $notes;
    }

    function generateAuditHearingLetter($request_id = NULL, $data = NULL)
    {
        $fview = "secured_user/";
        $current_user_data = get_current_user_data();
        $hearing_date = explode(" ", $data['hearing_date_time']);
        $data['hearing_date'] = $hearing_date[0];
        $data['hearing_time'] = $hearing_date[1] . $hearing_date[2];
        $audit_dtls = $this->ci->General->getrow('AASF_Request_Audit', 'file_number,school_id', array('id' => $request_id));
        $data['file_number'] = $audit_dtls->file_number;
        $data['school_name'] = school_name_byid($audit_dtls->school_id);
        $appt_dtls = $this->getApptDetailsForAudit($request_id);
        $data['appointee_name'] = $appt_dtls['appt_name'][0]['appointee_name'];
        $data['appt_desig_name'] = $appt_dtls['appt_name'][0]['Designation'];
        $data['appt_approved_on'] = mysql_to_date($appt_dtls['approved_on']);
        $officeId = $current_user_data['office_id'];
        $data['office_name_mal'] = get_district_malayalam($officeId);
        $notes = $this->ci->load->view($fview . 'filenavs/audit_hearing_letter', $data, true);
        return $notes;
    }

    function generateLiabilityProceedings($request_id = NULL, $liability_data = NULL)
    {
        $data = array();
        $data['liability_data'] = $liability_data;
        $current_user_data = get_current_user_data();
        $officeId = $current_user_data['office_id'];
        $office_name_mal = get_district_malayalam($officeId);
        $data['office_name_mal'] = $office_name_mal;
        $fview = "secured_user/";
        $notes = $this->ci->load->view($fview . 'filenavs/liability_proceedings_dde', $data, true);
        return $notes;
    }

    function generateAppealProceedingsDDE($request_id = NULL, $action_mode = NULL)
    {
        $fview = "secured_user/";

        $this->ci->load->model('Appeals_Model', "APAM");

        $req_type = $this->ci->CM->getRequestType($request_id);

        $req_table = 'AASF_Request_Appeal';
        if ($req_type == REQ_TYPE_APL_AA)
            $req_table = 'AASF_Request_Appeal_AA';
        $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $request_id))->file_number;
        $current_user_data = get_current_user_data();

        $officeId = $current_user_data['office_id'];
        $office_name_mal = get_district_malayalam($officeId);
        if ($this->ci->session->userdata('office_id') == DEO_OFFICE) {
            $office_name_mal = get_edu_district_malayalam($officeId);
        }

        $appl_detl = $this->ci->APAM->get_appeal_details($request_id);
        if (isset($appl_detl[0]))
            $appl_detl = $appl_detl[0];
        // echo "<br><pre>";
        // print_r($appl_detl);
        // die;
        $action_mode = ' ......... ';
        if ($action_mode == 1) {
            $action_mode = 'അനുവദിച്ച്';
        } else if ($action_mode == 2) {
            $action_mode = 'നിരസിച്ച്';
        }

        $print_data = array(
            'office_name_mal'             => $office_name_mal,
            'school_name_mal'             => $appl_detl['school_mal'],
            'appeal_action'               => $action_mode, //'അനുവദിച്ച് ',// നിരസിച്ച്',
            'appeal_submit_date'          => mysql_to_date($appl_detl['apl_submit_date']),
            'aeo_deo_office_mal'          => $appl_detl['sf_office_mal'],
            'appeal_aeo_deo_remarks_date' => mysql_to_date($appl_detl['apl_remarks_date']),
            'appeal_order_number'         => $file_number,
            'appeal_order_date'           => date('d/m/Y')
        );
        if ($current_user_data['master_office_id'] == DGE_OFFICE && $req_type == REQ_TYPE_APL)
            $notes = $this->ci->load->view($fview . 'filenavs/appeal_proceedings_dge', $print_data, true);
        elseif ($current_user_data['master_office_id'] == SEC_OFFICE && $req_type == REQ_TYPE_APL)
            $notes = $this->ci->load->view($fview . 'filenavs/appeal_proceedings_dge', $print_data, true);
        else if ($current_user_data['master_office_id'] == DDE_OFFICE && $req_type == REQ_TYPE_APL)
            $notes = $this->ci->load->view($fview . 'filenavs/appeal_proceedings_dde', $print_data, true);
        else if ($current_user_data['master_office_id'] == DDE_OFFICE && $req_type == REQ_TYPE_APL_AA)
            $notes = $this->ci->load->view($fview . 'filenavs/appeal_proceedings_dde_aa', $print_data, true);
        else if ($current_user_data['master_office_id'] == DEO_OFFICE && $req_type == REQ_TYPE_APL_AA)
            $notes = $this->ci->load->view($fview . 'filenavs/appeal_proceedings_dde_aa', $print_data, true);
        else if ($current_user_data['master_office_id'] == DGE_OFFICE && $req_type == REQ_TYPE_APL_AA)
            $notes = $this->ci->load->view($fview . 'filenavs/appeal_proceedings_dge_aa', $print_data, true);
        return $notes;
    }

    function generateAdditionalProposalProceedings($request_id = NULL)
    {
        $data = array();
        $fview = "secured_user/";
        $file = $this->ci->General->getrow('AASF_Request_Addl_Proposal','school_id,file_number',array('id'=>$request_id));
        $school_name_mal = get_school_name_malayalam($file->school_id);
        $data['file_number'] = $file->file_number;
        $data['school_name_mal'] = $school_name_mal;
        $data['appeal_action'] = 'നിരസിച്ച്';
        $notes = $this->ci->load->view($fview . 'filenavs/proposal_proceedings_dge.php', $data, true);
        return $notes;
    }


    function generateAppealProceedingsAEODEO($request_id = NULL, $data = NULL)
    {
        $fview = "secured_user/";
        // $sf_request_id = getSFRequestIDFromAppealRequest($request_id);
        $this->ci->load->model('Appeals_Model', "APAM");

        // $req_table = 'AASF_Request_SF';
        // $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $request_id))->file_number;
        // $file_number = $file_number."/A";
        $current_user_data = get_current_user_data();

        $officeId = $current_user_data['office_id'];
        $office_name_mal = get_district_malayalam($officeId);

        $appl_detl = $this->ci->APAM->get_appeal_details($request_id);
        if (isset($appl_detl[0]))
            $appl_detl = $appl_detl[0];
        // echo "<br><pre>";
        // print_r($appl_detl);
        // die;
        $office_type_mal = '';
        if ($appl_detl['sf_master_office'] == 1006)
            $office_type_mal = 'ജില്ലാ';
        else if ($appl_detl['sf_master_office'] == 1007)
            $office_type_mal = 'ഉപജില്ലാ';
        $academic_year = getacademic_year_id_from_request($appl_detl['request_id_sf']);

        // $appeal_order_date = '';
        // $appeal_order_number = '';
        // appeal remarks file number as aeo/deo revised order number

        $this->ci->db->select('rm.file_number');
        $this->ci->db->join('AASF_Request_Appeal_Remarks as rm', 'rm.appeal_id = APL.appeal_id');
        $this->ci->db->where('APL.id', $request_id);
        $remarks_file_number = $this->ci->db->get('AASF_Request_Appeal APL')->row('file_number');

        $file_number = $remarks_file_number;
        //
        // $file_number = $appl_detl['file_number']."/Appeal";
        $print_data = array(
            'office_name_mal'             => $appl_detl['sf_office_mal'],
            'office_type_mal'             => $office_type_mal, /* ജില്ലാ / ഉപജില്ലാ */
            'academic_year'               => $academic_year,
            'school_name_mal'             => $appl_detl['school_mal'],
            'dist_name_mal'               => $appl_detl['district_name_mal'],
            'appeal_order_date'           => mysql_to_date($appl_detl['apl_proceedings_date']),
            'appeal_order_number'         => $appl_detl['apl_file_number'],
            'sf_order_date'               => mysql_to_date($appl_detl['sf_proceedings_date']),
            'sf_order_number'             => $appl_detl['file_number'],
            'sf_order_number_new'         => $file_number,
            'sf_order_date_new'           => date("d/m/Y"),
            'apl_rev_modify_type'         => ' അപ്പീൽ '
        );
        $notes = $this->ci->load->view($fview . 'filenavs/appeal_proceedings_aeo_deo', $print_data, true);
        return $notes;
    }

    function generateApptAppealProceedingsAEODEO($request_id = NULL, $data = NULL)
    {
        $fview = "secured_user/";
        // $sf_request_id = getSFRequestIDFromAppealRequest($request_id);
        //echo $request_id;
        $this->ci->load->model('Appeals_Model', "APAM");

        $current_user_data = get_current_user_data();

        $officeId = $current_user_data['office_id'];
        $office_name_mal = get_district_malayalam($officeId);

        // $appl_detl = $this->ci->APAM->get_appeal_details($request_id);
        // if(isset($appl_detl[0]))
        //     $appl_detl = $appl_detl[0];


        $office_type_mal = '';
        // if($appl_detl['sf_master_office'] == 1006)
        //     $office_type_mal = 'ജില്ലാ';
        // else if($appl_detl['sf_master_office'] == 1007)
        //     $office_type_mal = 'ഉപജില്ലാ';

        $office_type_mal = 'ജില്ലാ/ ഉപജില്ലാ';

        // $academic_year = getacademic_year_id_from_request($appl_detl['request_id_sf']);


        $this->ci->db->select('rm.file_number');
        $this->ci->db->join('AASF_Request_Appeal_Remarks as rm', 'rm.appeal_id = APL.appeal_id');
        $this->ci->db->where('APL.id', $request_id);
        $remarks_file_number = $this->ci->db->get('AASF_Request_Appeal_AA APL')->row('file_number');

        $file_number = $remarks_file_number;
        //
        $print_data = array(
            'office_name_mal'             => '....', //$appl_detl['sf_office_mal'],
            'office_type_mal'             => $office_type_mal, /* ജില്ലാ / ഉപജില്ലാ */
            'academic_year'               => '......', //$academic_year,
            'school_name_mal'             => '.......', //$appl_detl['school_mal'],
            'dist_name_mal'               => '...........', //$appl_detl['district_name_mal'],
            'appeal_order_date'           => '........', //mysql_to_date($appl_detl['apl_proceedings_date']),
            'appeal_order_number'         => '..............', //$appl_detl['apl_file_number'],
            'sf_order_date'               => '............', //mysql_to_date($appl_detl['sf_proceedings_date']),
            'sf_order_number'             => '............', //$appl_detl['file_number'],
            'sf_order_number_new'         => $file_number,
            'sf_order_date_new'           => date("d/m/Y"),
            'apl_rev_modify_type'         => ' അപ്പീൽ '
        );
        $notes = $this->ci->load->view($fview . 'filenavs/appeal_proceedings_aeo_deo_aa', $print_data, true);
        return $notes;
    }

    function generateReviewProceedingsDDE($request_id = NULL)
    {
        $fview = "secured_user/";

        // $this->ci->load->model('Appeals_Model',"APAM");

        $req_type = $this->ci->CM->getRequestType($request_id);

        $req_table = 'AASF_Request_Revision';
        $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $request_id))->file_number;
        $current_user_data = get_current_user_data();

        $officeId = $current_user_data['office_id'];
        $office_name_mal = get_district_malayalam($officeId);

        $action_mode = 'അനുവദിച്ച്';

        $print_data = array(
            'office_name_mal'             => $office_name_mal,
            'school_name_mal'             => '...', //$appl_detl['school_mal'],
            'appeal_action'               => $action_mode, //'അനുവദിച്ച് ',// നിരസിച്ച്',
            'appeal_submit_date'          => '........', //mysql_to_date($appl_detl['apl_submit_date']),
            'aeo_deo_office_mal'          => '.......', //$appl_detl['sf_office_mal'],
            'appeal_aeo_deo_remarks_date' => '.........', //mysql_to_date($appl_detl['apl_remarks_date']),
            'appeal_order_number'         => $file_number,
            'appeal_order_date'           => date('d/m/Y')
        );
        $notes = $this->ci->load->view($fview . 'filenavs/review_proceedings_parent_office', $print_data, true);
        return $notes;
    }

    function generateAuditProceedingsDDE($request_id = NULL, $action_mode = NULL)
    {
        $fview = "secured_user/";

        // $this->ci->load->model('Appeals_Model',"APAM");

        $req_type = $this->ci->CM->getRequestType($request_id);

        $req_table = 'AASF_Request_Audit';
        $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $request_id))->file_number;
        $current_user_data = get_current_user_data();

        $officeId = $current_user_data['office_id'];
        $office_name_mal = get_district_malayalam($officeId);

        $action_mode = 'അനുവദിച്ച്';

        $print_data = array(
            'office_name_mal'             => $office_name_mal,
            'school_name_mal'             => '...', //$appl_detl['school_mal'],
            'appeal_action'               => $action_mode, //'അനുവദിച്ച് ',// നിരസിച്ച്',
            'appeal_submit_date'          => '........', //mysql_to_date($appl_detl['apl_submit_date']),
            'aeo_deo_office_mal'          => '.......', //$appl_detl['sf_office_mal'],
            'appeal_aeo_deo_remarks_date' => '.........', //mysql_to_date($appl_detl['apl_remarks_date']),
            'appeal_order_number'         => $file_number,
            'appeal_order_date'           => date('d/m/Y')
        );
        $notes = $this->ci->load->view($fview . 'filenavs/audit_proceedings_dde_office', $print_data, true);
        return $notes;
    }

    function generateAuditProceedingsDGE($request_id = NULL, $action_mode = NULL)
    {
        $fview = "secured_user/";

        // $this->ci->load->model('Appeals_Model',"APAM");

        $req_type = $this->ci->CM->getRequestType($request_id);

        $req_table = 'AASF_Request_Audit';
        $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $request_id))->file_number;
        $current_user_data = get_current_user_data();

        $officeId = $current_user_data['office_id'];
        $office_name_mal = get_district_malayalam($officeId);

        $action_mode = 'അനുവദിച്ച്';

        $print_data = array(
            'office_name_mal'             => $office_name_mal,
            'school_name_mal'             => '...', //$appl_detl['school_mal'],
            'appeal_action'               => $action_mode, //'അനുവദിച്ച് ',// നിരസിച്ച്',
            'appeal_submit_date'          => '........', //mysql_to_date($appl_detl['apl_submit_date']),
            'aeo_deo_office_mal'          => '.......', //$appl_detl['sf_office_mal'],
            'appeal_aeo_deo_remarks_date' => '.........', //mysql_to_date($appl_detl['apl_remarks_date']),
            'appeal_order_number'         => $file_number,
            'appeal_order_date'           => date('d/m/Y')
        );
        $notes = $this->ci->load->view($fview . 'filenavs/audit_proceedings_dge_office', $print_data, true);
        return $notes;
    }

    function generateReviewProceedingsAEODEO($request_id = NULL, $data = NULL)
    {
        $fview = "secured_user/";
        $sf_request_id = getSFRequestIDFromAppealRequest($request_id);
        //echo $request_id;
        // $this->ci->load->model('Appeals_Model',"APAM");

        // $req_table = 'AASF_Request_SF';
        // $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $request_id))->file_number;
        // $file_number = $file_number."/A";
        $current_user_data = get_current_user_data();

        $officeId = $current_user_data['office_id'];
        $office_name_mal = get_district_malayalam($officeId);

        $office_type_mal = 'ഉപജില്ലാ';

        // $appeal_order_date = '';
        // $appeal_order_number = '';
        // appeal remarks file number as aeo/deo revised order number

        $this->ci->db->select('rm.file_number');
        $this->ci->db->join('AASF_Request_Review_Remarks as rm', 'rm.rev_file_id = REV.id');
        $this->ci->db->where('REV.id', $request_id);
        $remarks_file_number = $this->ci->db->get('AASF_Request_Revision REV')->row('file_number');

        $file_number = $remarks_file_number;
        //
        // $file_number = $appl_detl['file_number']."/Appeal";
        $print_data = array(
            'office_name_mal'             => '..........', //$appl_detl['sf_office_mal'],
            'office_type_mal'             => $office_type_mal, /* ജില്ലാ / ഉപജില്ലാ */
            'academic_year'               => '2019-20', //$academic_year,
            'school_name_mal'             => '........', //$appl_detl['school_mal'],
            'dist_name_mal'               => '........', //$appl_detl['district_name_mal'],
            'appeal_order_date'           => '.........', //mysql_to_date($appl_detl['apl_proceedings_date']),
            'appeal_order_number'         => '.........', //$appl_detl['apl_file_number'],
            'sf_order_date'               => '.........', //mysql_to_date($appl_detl['sf_proceedings_date']),
            'sf_order_number'             => '..........', //$appl_detl['file_number'],
            'sf_order_number_new'         => $file_number,
            'sf_order_date_new'           => date("d/m/Y"),
            'apl_rev_modify_type'         => '  റിവ്യൂ  '
        );
        $notes = $this->ci->load->view($fview . 'filenavs/review_proceedings_aeo_deo', $print_data, true);
        return $notes;
    }

    function generateApptApprovalProceedings($request_id = NULL, $action = NULL)
    {
        $fview = "secured_user/";

        // $this->ci->load->model('Appeals_Model',"APAM");

        $req_type = $this->ci->CM->getRequestType($request_id);

        $req_table = 'AASF_Request';
        $file_number = $this->ci->General->getrow($req_table, 'file_number', array('id' => $request_id))->file_number;
        $current_user_data = get_current_user_data();

        $officeId = $current_user_data['office_id'];

        //

        $data['office_name_mal'] = $office_name_mal = '';

        if ($current_user_data['master_office_id'] == 1007) {
            $office_name_type = 'ഉപജില്ലാ ';
            $data['office_name_mal'] = $office_name_mal = get_sub_district_malayalam($officeId);
        }
        if ($current_user_data['master_office_id'] == 1006) {
            $office_name_type = 'ജില്ലാ ';
            $data['office_name_mal'] = $office_name_mal = get_edu_district_malayalam($officeId);
        }
        $data['office_name_type'] = $office_name_type;

        //

        // $office_name_mal = get_district_malayalam($officeId);

        $print_data = array(
            'office_name_mal'           => $office_name_mal,
            'office_name_type'          => $office_name_type,
            'school_name_mal'           => '...', //$appl_detl['school_mal'],
            'file_order_number'         => $file_number,
            'file_order_date'           => date('d/m/Y')
        );
        if ($action == 1)
            $notes = $this->ci->load->view($fview . 'filenavs/appt_approval_proceedings', $print_data, true);
        else if ($action == 2)
            $notes = $this->ci->load->view($fview . 'filenavs/appt_rejection_proceedings', $print_data, true);
        return $notes;
    }

    function generateModificationProceedingsAEODEO($sf_request_id, $modification_id, $data = NULL)
    {

        $fview = "secured_user/";

        $data['current_user_data'] = $current_user_data = get_current_user_data();

        $draftName = 'Revised Proceedings';
        $current_time = date("Y-m-d H:i:s");
        $officeId = $current_user_data['office_id'];
        $data['office_name'] = $office_name = $current_user_data['dist_name'];
        if ($current_user_data['master_office_id'] == 1007) {
            $office_name_type = 'ഉപജില്ലാ ';
            $data['office_name_mal'] = $office_name_mal = get_sub_district_malayalam($officeId);
        }
        if ($current_user_data['master_office_id'] == 1006) {
            $office_name_type = 'ജില്ലാ ';
            $data['office_name_mal'] = $office_name_mal = get_edu_district_malayalam($officeId);
        }
        $data['office_name_type'] = $office_name_type;

        $academic_year = getacademic_year_id_from_request($sf_request_id);

        // modification file number as aeo/deo revised order number

        $this->ci->db->select('RM.file_number');
        $this->ci->db->join('AASF_Request_SF as SF', 'SF.id = RM.fileId');
        $this->ci->db->where('RM.id', $modification_id);
        $this->ci->db->where('SF.id', $sf_request_id);
        $modification_file_number = $this->ci->db->get('AASF_Request_Modification RM')->row('file_number');

        $file_number = $modification_file_number;

        $sf_file_number = $this->ci->General->getrow('AASF_Request_SF', 'file_number', array('id' => $sf_request_id))->file_number;

        //
        $academic_year_desc = getacademic_year_from_request($sf_request_id);
        $print_data = array(
            'office_name_mal'             => $data['office_name_mal'],
            'office_type_mal'             => $office_name_type, /* ജില്ലാ / ഉപജില്ലാ */
            'academic_year'               => $academic_year_desc,
            'school_name_mal'             => '...........', //$appl_detl['school_mal'],
            'dist_name_mal'               => '...........', //$appl_detl['district_name_mal'],
            'sf_order_date'               => '..................', //mysql_to_date($appl_detl['sf_proceedings_date']),
            'sf_order_number'             => $sf_file_number,
            'sf_order_number_new'         => $file_number,
            'sf_order_date_new'           => date("d/m/Y"),
            'apl_rev_modify_type'         => ' ............... '
        );
        $notes = $this->ci->load->view($fview . 'filenavs/modification_proceedings_aeo_deo', $print_data, true);
        return $notes;
    }

    function sendMessageBySMS($master_sms_id = '', $phone = '', $user_id = '', $date = '', $place = '')
    {
        return true;
        /*
        $is_active = is_sms_type_active($master_sms_id);
        if ($is_active == 1) {
            if ($master_sms_id == FORGOT_SMS_TYPE) {
                $msg_cnt      = get_sms_count($master_sms_id, $phone);
                $user = $this->ci->LA->getUserAccount($user_id, $phone);
                if ($user != 0  && $msg_cnt < SMS_OTP_LIMIT) {
                    $random = mt_rand(1000, 9999);
                    $this->ci->itschool_rbac->reset_password_by_username($_SESSION['pen'], $random);
                    $this->ci->LA->initLoginEnable($_SESSION['pen']);
                    $message            = FORGOT_PASS_SMS_OTP;
                    $msg                = $random . ' ' . $message;
                } else {
                    if ($master_sms_id == FORGOT_SMS_TYPE) {
                        $this->ci->session->sess_destroy();
                    }
                    $data = array("status" => "failed", "message" => "Failed ");
                    echo json_encode($data);
                    return;
                }
            }
            if ($master_sms_id == APL_HEARING_SMS_TYPE) {
                $message = 'A personal hearing on Staff fixation appeal to be conducted on ' . @$date . '@ ' . @$place . ', Attendance is mandatory.Check mail.';
            } else if ($master_sms_id == REV_HEARING_SMS_TYPE) {
                $message = 'A personal hearing on Staff fixation review to be conducted on ' . @$date . '@ ' . @$place . ', Attendance is mandatory.Check mail.';
            } elseif ($master_sms_id == GET_REMARKS_SMS_TYPE) {
                if (@$date == NULL)
                    $message = "A file forwarded from DGE Office for your remarks.\nPlease login https://samanwaya.kite.kerala.gov.in"; //@date as File number in this sms type
                else
                    $message = "A file #: " . @$date . " forwarded from DGE Office for your remarks.\nPlease login https://samanwaya.kite.kerala.gov.in"; //@date as File number in this sms type
                $message =
                    $msg = $message;
            } else if ($master_sms_id == GET_AUDIT_SMS_TYPE) {
                $message = 'A Audit File is Canceled please check';
                $msg = $message;
            } else if ($master_sms_id == GET_IOC_SMS_TYPE) {
                $message = 'IOC message received please check';
                $msg = $message;
            } else if ($master_sms_id == AUDIT_REQ_SMS_TYPE) {
                $message = 'Your request for Audit is reverted. Please contact DDE for more details';
                $msg = $message;
            }
            if (is_array($phone)) {
                $save_records_id = $this->ci->CM->save_sms_msg_records($message, $master_sms_id, $phone);
                $msg = $message;
            } else {
                $save_records_id = $this->ci->CM->save_sms_msg_records($message, $master_sms_id, $phone, $user_id);
            }
            if ($save_records_id != 0) {
                $result     = $this->sendSMS($msg, $phone);
                $sms_status = explode(',', $result);
                $sms_status = $sms_status[0];
                $sms_status_cnt = $sms_status[1];
                if ($sms_status == 402) {
                    $this->ci->General->update('sms_thread_receiver', array("has_successfully_sent" => 1), array("sms_thread_id" => $save_records_id));
                    $data       = array("status" => "ok", "message" => "Success ");
                } else {
                    $data       = array("status" => "not_active", "message" => "Failed ");
                }
            } else {
                $data = array("status" => "failed", "message" => "Failed ");
            }
        } else {
            $data = array("status" => "not_active", "message" => "Failed ");
        }
        if ($master_sms_id == FORGOT_SMS_TYPE) {
            $this->ci->session->sess_destroy();
        }
        if ($master_sms_id == GET_IOC_SMS_TYPE || $master_sms_id == AUDIT_REQ_SMS_TYPE) {
            return json_encode($data);
        } else {
            echo json_encode($data);
        }
        */
    }


    function sendSMS($msg, $phone)
    { //send forgot password otp via sms
        // proc_nice(-20);//highest proirity;
        $str      = $msg; // to be changed
        $message  = urlencode($str);
        $numbers  = $phone; // to be changed/ check if phone is array or not, if array, numbers= join(",",phone)
        if (is_array($numbers)) {
            $numbers = implode(',', $numbers);
        }
        $username = "dpiker";
        $password = "123@dpiker";
        // $senderid = "DGESAM"; 
        $url = "http://api.esms.kerala.gov.in/fastclient/SMSclient.php?username=" . $username . "&password=" . $password . "&message=" . $message . "&numbers=" . $numbers;
        $result  =  file_get_contents($url); // or use curl_exec()
        //   $result = '402,1';
        return $result;
    }

    function getApptAppealGoBackURL($office, $block, $req_type, $is_revision_appeal = NULL)
    {
        $appeal_dashboard_url = "index.php/secured_user/Dashboard/user_dashboards/5";
        $appeal_remark_url = "index.php/secured_user/Appeals/view_appeal_list_aa";
        $audit_remark_url = "index.php/secured_user/Audit/view_audit_list";
        $audit_dashboard_url = "index.php/secured_user/Dashboard/user_dashboards/6";
        $goBackUrl = '';
        if ($req_type == REQ_TYPE_APL_AA) {
            switch ($office) {
                case AEO_OFFICE:
                    $goBackUrl = $appeal_remark_url;
                    break;
                case DEO_OFFICE:
                    $goBackUrl = $appeal_dashboard_url;
                    break;
                case DDE_OFFICE:
                    $goBackUrl = $appeal_dashboard_url;
                    break;
                case DGE_OFFICE:
                    $goBackUrl = $appeal_dashboard_url; // check blocks
                    break;
            }
        } else if ($req_type == REQ_TYPE_APL_REMARK || $req_type == REQ_TYPE_REAPL_REMARK_AEO_DEO || $req_type == REQ_TYPE_REAPL_REMARK_DDE || $req_type == REQ_TYPE_REAPL_REMARK_H_SECTION || $req_type == REQ_TYPE_REAPL_REMARK_SUPERCHECKCELL) {
            $goBackUrl = $appeal_remark_url;
        } else if ($req_type == REQ_TYPE_AUDIT_REMARK) {
            $goBackUrl = $audit_remark_url;
        } else if ($req_type == REQ_TYPE_AUD) {
            $goBackUrl = $audit_dashboard_url;
        }
        return $goBackUrl;
    }

    function generateDraftNotesArray($reqID, $draftNo, $file_number, $draftName, $office_id, $user_id, $user_data, $draft_note_content, $draft_template = DRAFT_TYPE_BLANK_PROCEEDINGS)
    {
        $current_time = date("Y-m-d H:i:s");
        $draft_arr = array(
            "request_id"            => $reqID,
            "draft_no"              => $draftNo,
            "file_no"               => $file_number,
            "draft_title"           => $draftName,
            "user_id"               => $user_id,
            "current_time"          => $current_time,
            "office_id"             => $office_id,
            "draft_note"            => $draft_note_content,
            "draft_template"        => $draft_template,
            'current_office_id'     => $user_data['office_id'],
            'current_usergroup_id'  => $user_data['usergroup_id'],
            'current_designation'   => $user_data['designation_id']
        );
        return $draft_arr;
    }

    function generateDraftApprovalArray($status, $userData, $dateTime)
    {
        $draftNotes_array  = array(
            "status"        =>    $status,
            "approved_by"    =>    $userData['user_id'],
            "approved_at"    =>    $dateTime,
            "updated_by"    =>    $userData['user_id'],
            "updated_at"    =>    $dateTime,

            "updated_role"            =>  $userData['current_designation'],
            "updated_user_group_id"    =>  $userData['current_usergroup_id'],
            "updated_office_id"        =>  $userData['current_office_id'],

            "approved_role"                =>  $userData['current_designation'],
            "approved_user_group_id"    =>  $userData['current_usergroup_id'],
            "approved_office_id"        =>  $userData['current_office_id']
        );
        return $draftNotes_array;
    }

    function generateDraftNoteDtlsUpdateArray($userData, $dateTime, $is_approved = '', $draft_note = '', $isUpdUserOffice = 0, $isDateOfEntry = 0)
    {
        $draftNotesDetails_array  = array(
            'updated_by'    =>    $userData['user_id'],
            'updated_at'    =>    $dateTime,
            'updated_role'            =>  $userData['current_designation'],
            'updated_user_group_id'    =>  $userData['current_usergroup_id'],
            'updated_office_id'        =>  $userData['current_office_id']
        );
        if ($is_approved != '') {
            $draftNotesDetails_array['is_approved'] = $is_approved;
        }
        if ($isDateOfEntry == 1) {
            $draftNotesDetails_array['date_of_entry'] = $dateTime;
        }
        if ($isUpdUserOffice == 1) {
            $draftNotesDetails_array['user_id'] = $userData['user_id'];
            $draftNotesDetails_array['office_id'] = $userData['current_office_id'];
        }
        if ($draft_note != '') {
            $draftNotesDetails_array['draft_note'] = $draft_note;
        }
        if (isset($userData['nameMal'])) {
            $draftNotesDetails_array['name_mal']   = $userData['nameMal'];
        }
        if (isset($userData['schoolMal'])) {
            $draftNotesDetails_array['school_mal'] = $userData['schoolMal'];
        }
        if (isset($userData['addlNotes'])) {
            $draftNotesDetails_array['addl_note']  = $userData['addlNotes'];
        }
        return $draftNotesDetails_array;
    }

    function generateDraftProceedingsApprovalArray($status, $userData, $dateTime)
    {
        $draftNotes_array  = array(
            "status"        =>    $status,
            "proceeded_by"    =>    $userData['user_id'],
            "proceeded_at"    =>    $dateTime,
            "updated_by"    =>    $userData['user_id'],
            "updated_at"    =>    $dateTime,

            "updated_role"            =>  $userData['current_designation'],
            "updated_user_group_id"    =>  $userData['current_usergroup_id'],
            "updated_office_id"        =>  $userData['current_office_id'],

            "proceeded_role"            =>  $userData['current_designation'],
            "proceeded_user_group_id"    =>  $userData['current_usergroup_id'],
            "proceeded_office_id"        =>  $userData['current_office_id']
        );
        return $draftNotes_array;
    }

    function generateReOpenHistoryArray($reqID, $school_id, $reopen_type, $fileId, $current_user_data)
    {
        $reopen_history_data = array(
            "request_id"              => $reqID,
            "school_id"               => $school_id,
            "reopen_type"             => $reopen_type,
            "reopen_by_request_id"    => $fileId,
            "file_status"             => 'Open',
            "created_by"              => $current_user_data['user_id'],
            "created_at"              => date("Y-m-d H:i:s"),
            "created_role"            => $current_user_data['designation_id'],
            "created_user_group_id"   => $current_user_data['usergroup_id'],
            'created_master_officeid' => $current_user_data['master_office_id'],
            'created_office_id'       => $current_user_data['office_id'],
            'created_office_block_id' => $current_user_data['office_block_id']
        );
        return $reopen_history_data;
    }

    function getDraftUnicode($req_id, $draft_id = NULL)
    {
        $proceedings_type = getProceedingsTypeFromRequestID($req_id, $draft_id);
        $pro_type =
            array(
                "A.A Proceedings"                => 'A',
                "Older S.F Proceedings"          => 'B',
                "A.A Appeal Proceedings"         => 'C',
                "S.F Appeal Proceedings"         => 'D',
                "A.A Revision Appeal Proceedings" => 'E',
                "Revision Appeal Proceedings"    => 'F',
                "Reviewed Proceedings"           => 'G',
                "Audit Proceedings"              => 'H',
                "Settlement Receipt"             => 'R',
            );
        $office_type = $this->get_office_id();
        $office_type = str_pad($office_type, 3, '0', STR_PAD_LEFT);
        $office = $this->get_master_office_id();
        $off_type =
            array(
                "1008"       => 'A',
                "1010"       => 'A',
                "1011"       => 'A',
                "1012"       => 'B',
                "1007"       => 'C',
                "1006"       => 'D',
                "1002"       => 'E',
                "1001"       => 'F',

            );
        $draft_id = str_pad($draft_id, 6, '0', STR_PAD_LEFT);
        $UNICODE = $pro_type[$proceedings_type] . $office_type . $off_type[$office] . $draft_id;
        return $UNICODE;
    }

    function getDraftQrCode($enc_draft_id, $req_type, $draft_type = 0)
    {
        $style = '';
        $qr_code= '';
        if ($req_type == REQ_TYPE_AUD) {
            if ($draft_type == 2) {
                $style = "style='float:right;'";
            } elseif ($draft_type == 3) {
                $style = "";
            }
        } else {
            $style = "";
        }
        $url = base_url() . "index.php/QrCode/download_pdf/" . $enc_draft_id . "/1";
        // $qr_url = "https://chart.googleapis.com/chart?chs=125x125&cht=qr&chl=$url&choe=UTF-8";
        $this->ci->load->library('qrcodes/ciqrcode');
        $ciqrcode = new Ciqrcode();
        $params['data'] = $url;
        $params['level'] = 'L';
        $params['size'] = 2;
        $res = $this->ci->ciqrcode->generate($params);
        if ($this->check_base64_image($res)) {
            $base64 = 'data:image/png;base64,' .$res;
            $qr_code = "<img $style src='".$base64."'/>";
            return $qr_code;
        } else {
            return false;
        }      
    }

    function  getOutwardPdfQRCode($outward_id,$file_number){
        $this->ci->load->library('qrcodes/ciqrcode');
        $master_office_id = $this->get_master_office_id();
        $office_id = $this->get_office_id();
        $office_block = $this->get_office_block_id();
        $office_name = $this->get_office_full_name($master_office_id, $office_id, $office_block);
        $ciqrcode = new Ciqrcode();
        $data = 'Outward Ref ID : '.$outward_id.PHP_EOL.'FIle# : '.$file_number.PHP_EOL.'Office : '.$office_name.PHP_EOL.'Date : '.date('d/m/Y h:i A');
        $params['data'] = $data;
        $params['level'] = 'L';
        $params['size'] = 2;
        $res = $this->ci->ciqrcode->generate($params);
        if ($this->check_base64_image($res)) {
            $base64 = 'data:image/png;base64,' .$res;
            $qr_code = "<img src='".$base64."'/>";
            return $qr_code;
        } else {
            return false;
        }
    }

    function getCustomQrCode($content){
        $this->ci->load->library('qrcodes/ciqrcode');
        $params['data'] = $content;
        $params['level'] = 'L';
        $params['size'] = 2;
        $res = $this->ci->ciqrcode->generate($params);
        if ($this->check_base64_image($res)) {
            $base64 = 'data:image/png;base64,' .$res;
            $qr_code = "<img src='".$base64."'/>";
            return $qr_code;
        } else {
            return false;
        }

    }

    function check_base64_image($base64) {
        $base64 = 'data:image/png;base64,' .$base64;
        $array=getimagesize($base64);
        $e=explode("/",$array['mime']);
        if($e[0]=="image"){
            return true;
        }else{
            return false;
        }
    }

    function updateAuditFinalFileStatus($action, $req_id)
    {
        switch ($action) {
            case "Cancel":
                $data = 5;
                break;
            case "Revise":
                $data = 10;
                break;
            case "Declararion Revise":
                $data = 11;
                break;
            case "Petition Allowed":
                $data = 15; // check blocks
                break;
            case "No Remarks":
                $data = 20;
                break;
        }
        $result = $this->ci->General->update('AASF_Request', array("audit_final_status" => $data), array("id" => $req_id));
        return $result;
    }

    function isReOpenedViaAudit($req_id)
    { //A.A Request id
        $this->ci->db->select('is_reopened');
        $this->ci->db->where('A.active_type', 4);
        // $where = ("('A.audit_final_status=11 OR A.audit_final_status=5')");
        // $this->ci->db->where($where);
        $this->ci->db->where('A.id', $req_id);
        $data = $this->ci->db->get('AASF_Request as A')->row()->is_reopened;
        return $data;
    }

    function auditMovementStatusAfterRetain($audId, $applId)
    { //Audit Movement Status After Objection Retain
        $is_liability = $this->is_liability($audId, $applId);
        $aud_rem_id   = @$this->ci->General->getrow('AASF_Request_Audit_Remarks', 'id', array("aud_file_id" => $audId))->id;
        $is_dge_pending = 0;
        if ($aud_rem_id)
            $is_dge_pending = $this->ci->General->is_record_exists('dge_request_notes', 'aud_remark_id=' . $aud_rem_id . ' AND is_approved=1');
        if ($is_liability == 1) {
            $data = "Fixing Liability";
        } elseif ($is_liability == 2) {
            $data = "Petition Allowed in DGE";
        } elseif ($is_dge_pending > 0) {
            $school_id = $this->ci->General->getrow('AASF_Request_Audit', 'school_id', array('id' => $audId))->school_id;
            $block = getDGEOfficeBlockForApptReAppeal($school_id);
            @$office_name = get_office_block_name($block);
            $block_name = explode(" ", $office_name);
            $data = "Pending in DGE [" . $block_name[0] . "]";
        } else {
            $data = "Pending in";
        }
        return $data;
    }

    function is_liability($audId, $applId)
    {
        $is_liabilty = 0;
        @$dge_audit_stat = $this->ci->General->getrow('AASF_Request_Audit', 'file_status', array('ref_audit_id' => $audId))->file_status;
        @$is_draft_approved = $this->ci->General->getrow('AASF_Request_Audit', 'is_draft_approved', array('ref_audit_id' => $audId))->is_draft_approved;
        $tem_req_type = getRequestType($applId);
        $tmp_applId = $applId;
        if ($tem_req_type == REQ_TYPE_APL_AA) {
            $tmp_applId = getSFRequestIDFromAppealRequest($tmp_applId, REQ_TYPE_APL_AA);
        }
        $is_self_revise = $this->ci->General->getrow('AASF_Request', 'audit_final_status', array("id" => $tmp_applId))->audit_final_status;
        if (((@$dge_audit_stat == "Revise" || @$dge_audit_stat == "Cancel") && $is_draft_approved == 1) || $is_self_revise == 11) {
            $is_liabilty = 1;
        } elseif (@$dge_audit_stat == "Petition Allowed") {
            $is_liabilty = 2;
        }
        return $is_liabilty;
    }

    function get_repository_upload_path($is_upload_path = NULL)
    {
        $CI = &get_instance();
        $usr_data = $CI->session->userdata();
        if ($usr_data > 0) {
            $office_id       = $this->get_office_id();
            $master_officeid = $this->get_master_office_id();
            if ($is_upload_path == 1) {
                $uploadpath = './uploads/repository/' . $master_officeid . '/' . $office_id;
                if (!is_dir($uploadpath)) {
                    mkdir($uploadpath, 0777, TRUE);
                }
                return $uploadpath;
            } elseif ($is_upload_path == NULL) {
                $file_path = '/uploads/repository/' . $master_officeid . '/' . $office_id . '/';
                return $file_path;
            }
        }
    }

    function getApptDetailsForAudit($aud_req_id)
    { //get appointment details for audit
        $data = array();
        $root_file_id = getRootRequestIDFromAudit($aud_req_id);
        $aa_file_id = getAARequestIDFromAuditRequest($aud_req_id);
        $req_type = getRequestType($aa_file_id);
        $join  = array(0 => "AASF_Designation as D,D.id = R.desig_id");
        $data['appt_name'] = @$this->ci->General->getdata_new("AASF_Request R", "appointee_name,D.Designation", array('R.id' => $root_file_id), "", $join);
        if ($req_type == REQ_TYPE_APL_AA) {
            $tbl = 'AASF_Request_Appeal_AA';
        } elseif ($req_type == REQ_TYPE_AA) {
            $tbl = 'AASF_Request';
        }
        $data['approved_on'] = $this->ci->General->getrow($tbl, 'approved_at', array('id' => $aa_file_id))->approved_at;
        return $data;
    }

    function getFileApprovedDate($request_id)
    {
        // returns action taken date - now only for approve and reject
        $file_action_status = array(2, 8); // 2- approved/partial approved; 8-rejected; 
        $tbl = 'AASF_work_flow';
        //
        $this->ci->db->select('date_of_action');
        $this->ci->db->where('request_id', $request_id);
        $this->ci->db->where_in('mov_status', $file_action_status);
        $this->ci->db->order_by('id', 'ASC');
        $file_action_date = $this->ci->db->get($tbl)->row()->date_of_action;
        //
        $file_action_date = mysql_to_datetime($file_action_date);
        return $file_action_date;
    }

    function getApprovedDetailsByRequestID($req_id){
        $req_type = getRequestType($req_id);
        $tbl = 'AASF_work_flow';
        if($req_type == REQ_TYPE_AA || $req_type == REQ_TYPE_APL_AA)
            $mov_stat = 2;
        $this->ci->db->select('up.name,u.pen,md.designation_name,rg.usergroup');
        $this->ci->db->from($tbl.' as fl');
        $this->ci->db->join('users as u','u.id = fl.updated_by');
        $this->ci->db->join('user_profiles as up','up.user_id = fl.updated_by');
        $this->ci->db->join('master_designation as md','md.desig_id = fl.role_id');
        $this->ci->db->join('rbac_group as rg','rg.id = fl.user_group_id');
        $this->ci->db->where('fl.request_id',$req_id); 
        $this->ci->db->where('fl.mov_status',$mov_stat);
        $this->ci->db->order_by('fl.id','ASC');
        $this->ci->db->limit(1);
        $data = $this->ci->db->get()->row();
        return $data;
    }

    function getTaggedAppointeeListCountByBond($bond_id){
        $this->ci->db->select('count(id) as cnt');
        $this->ci->db->from('bond_mgr_appointees');
        $this->ci->db->where('bond_id',$bond_id);
        $data = $this->ci->db->get()->row()->cnt;
        return $data;
    }
    function get_roster_upload_path($school_id,$is_upload_path = NULL)
    {
        $CI = &get_instance();
        $usr_data = $CI->session->userdata();
        if ($usr_data > 0) {
            $office_id       = $this->get_office_id();
            $master_officeid = $this->get_master_office_id();

            if ($is_upload_path == 1) {
                $uploadpath = './uploads/roster_data/' . $master_officeid . '/' . $office_id.'/'.$school_id;
                if (!is_dir($uploadpath)) {
                    mkdir($uploadpath, 0777, TRUE);
                }
                return $uploadpath;
            } elseif ($is_upload_path == NULL) {
                $file_path = '/uploads/roster_data/' . $master_officeid . '/' . $office_id . '/'.$school_id.'/';
                return $file_path;
            }
        }
    }
    function get_roster_category_upload_path($management_id,$category_id,$is_upload_path = NULL)
    {
        $CI = &get_instance();
        $usr_data = $CI->session->userdata();
        if ($usr_data > 0) {
            $office_id       = $this->get_office_id();
            $master_officeid = $this->get_master_office_id();
            if ($is_upload_path == 1) {
                $uploadpath = './uploads/roster_data/category/' . $management_id . '/' . $category_id;
                if (!is_dir($uploadpath)) {
                    mkdir($uploadpath, 0777, TRUE);
                }
                return $uploadpath;
            } elseif ($is_upload_path == NULL) {
                $file_path = '/uploads/roster_data/category/' . $management_id . '/' . $category_id . '/';
                return $file_path;
            }
        }
    }
    function get_teacher_photo_path($district_id,$school_id,$is_upload_path = NULL)
    {
        $CI = &get_instance();
        $usr_data = $CI->session->userdata();
        if ($usr_data > 0) {
            $office_id       = $this->get_office_id();
            $master_officeid = $this->get_master_office_id();
            if ($is_upload_path == 1) {
                $uploadpath = './uploads/staff/photo/' . $district_id . '/' . $school_id;
                if (!is_dir($uploadpath)) {
                    mkdir($uploadpath, 0777, TRUE);
                }
                return $uploadpath;
            } elseif ($is_upload_path == NULL) {
                $file_path = '/uploads/staff/photo/' . $district_id . '/' . $school_id . '/';
                return $file_path;
            }
        }
    }
}
