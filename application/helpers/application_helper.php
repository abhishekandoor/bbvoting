<?php

function getAcademicIdFromRequest($request_id, $req_type){
    if($req_type==1)
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
    if($req_type==9)
        $tbl_req = 'AASF_Request_Addl_Proposal';
    //
    $CI = &get_instance();
    $academic_id = $CI->General->getrow($tbl_req, 'academic_year_id', array('id' => $request_id))->academic_year_id;
    return $academic_id;
    //
}

function getPreviousAcademicYearId($request_id, $req_type){
    $sel_academic_id = getAcademicIdFromRequest($request_id, $req_type);    
//    $academic_year = getActiveAcademicStartYear($sel_academic_id);
//    $prev_academic_year = $academic_year - 1;
//    $prev_academic_id = getacademic_id($prev_academic_year);
    $CI = &get_instance();
    $CI->db->select('parentId');
    $CI->db->where('id', $sel_academic_id);
    $acd_id = $CI->db->get('AASF_Academic_Year')->row('parentId');
    $prev_academic_id = $acd_id;            
    return $prev_academic_id;
}
function getPreviousAcademicIdByCurrentyear($sel_academic_id){
    $academic_year = getActiveAcademicStartYear($sel_academic_id);    
//    $prev_academic_year = $academic_year - 1;
//    $prev_academic_id = getacademic_id($prev_academic_year);
    $CI = &get_instance();
    $CI->db->select('parentId');
    $CI->db->where('Year', $academic_year);
    $acd_id = $CI->db->get('AASF_Academic_Year')->row('parentId');
    $prev_academic_id = $acd_id;     
    
    return $prev_academic_id;
}
function getAllPreviousAcademicIdsByCurrentyear($sel_academic_id){
    $academic_year = getActiveAcademicStartYear($sel_academic_id);
//    $prev_academic_year = $academic_year - 1;
//    $prev_academic_id = getacademic_id($prev_academic_year);
    
    //
    $CI = &get_instance();
    //
    $CI->db->select('id');
    $CI->db->where('Year<', $academic_year);
    $academic_id_list = array();
    $acd_ids = $CI->db->get('AASF_Academic_Year')->result_array();
    //
    // $academic_id_list = $CI->General->getdata('AASF_Academic_Year', 'id', array('Year<' => $academic_year))->result_array();
    if(count((array)$acd_ids) > 0 ){
        foreach($acd_ids as $id)
            array_push($academic_id_list, $id['id']);
    }
    return $academic_id_list;
    //
}

function getDistrictIdFromSchool($school_id){
    $CI = &get_instance();
    $district_id  = $CI->General->getrow('schools', 'revenue_district_id', array('id'=>$school_id))->revenue_district_id;
    return $district_id;
}

function getFinanceTypeFromSchool($school_id){
    $CI = &get_instance();
    $school_fin_type = $CI->General->getrow( 'school_details', 'school_finance_type_id fin_type', array( 'school_id' => $school_id ) )->fin_type;
    return $school_fin_type;
}

function getSchoolCodeFromId($school_id) {
    if ($school_id) {
        $CI = &get_instance();
        $scode  = $CI->General->getrow('schools', 'school_code', array('id'=>$school_id))->school_code;
        return $scode;
    }
}

function getStaffListIdFromSchool($school_id, $academic_id = NULL){
    if ($academic_id == NULL) {
        $academic_id = getacademic_id();
    }
        $CI = &get_instance();
        $list_id  = $CI->General->getrow('staff_list', 'staff_list_id', array('school_id'=>$school_id, 'academic_id' => $academic_id))->staff_list_id;
        return $list_id;
}

function getSchoolIdFromStaffList($staff_list_id){
    // echo "asdf".$staff_list_id; die;
    $CI = &get_instance();
    $school_id  = $CI->General->getrow('staff_list', 'school_id', array('staff_list_id' => $staff_list_id))->school_id;
    // echo $school_id; die;
    return $school_id;
}


?>