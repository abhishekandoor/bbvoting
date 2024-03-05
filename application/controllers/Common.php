<?php

/**
 * controller for general repeated functions
 */
class Common extends MY_Controller {

    private $table_district = 'master_district'; //table name for master district
    private $table_edudistrict = 'master_edudistricts'; //table name for master edudistrict
    private $table_subdistrict = 'master_subdistricts'; //table name for master subdistrict
    private $table_offices = 'master_offices'; //table name for master offices
    private $table_office_block = 'master_office_block'; //table name for master office blocks
    private $table_schools = 'schools'; //table name for master schools
    private $table_group = 'rbac_group'; //table name for user groups
    private $table_AASF_Designation = 'AASF_Designation'; // table name for designation
    private $table_master_zones = 'master_zones'; //table name for master zones

    function __construct() {
        parent::__construct();
        //load models
        $this->load->model('General');
        $this->load->model('Department_model','dm');
    }

    /**
     * function for processing district list via ajax
     * return list of districts
     */
    function listDistricts($id = NULL) {
        if ($this->session->userdata('office_id') > 1001) {
            $data = $this->General->dolistDropdown($this->table_district, 'district_code,district_name', array('district_code' => $this->session->userdata('district_id')), 'district_code');
        } else {
            $data = $this->General->dolistDropdown($this->table_district, 'district_code,district_name', '', 'district_code');
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
    }

    /**
     * function for processing zone list via ajax
     * return list of zones
     */
    function listZones($id = NULL) {
        if ($this->session->userdata('office_id') == $id) {
            $join = array(0=>"zone_district_mapping as ZDM ,ZDM.master_zone_id = Z.master_zone_id,left");
            $data = $this->General->prepare_select_box_data_new($this->table_master_zones.' as Z','Z.master_zone_id,Z.zone_name',array('ZDM.master_district_id' => $this->session->userdata('district_id')),false,'',$join);
        } else{
            $data = $this->General->dolistDropdown($this->table_master_zones, 'master_zone_id,zone_name', '', 'master_zone_id');
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
    }

    /**
     * function for processing edudistrict list via ajax
     * return list of edudistricts
     */
    function listEdudistricts($id = NULL) {
//        if ($this->session->userdata('office_id') == 1006) {
//            $edu_id = $this->session->userdata('edudistrict_id');
//            $data = $this->General->dolistDropdown($this->table_edudistrict, 'id,edu_district_name', 'revenue_district_id=' . $id . ' AND id = ' . $edu_id, 'id');
//        }else if ($this->session->userdata('office_id') == 1007) {
//            $edu_id = $this->session->userdata('edudistrict_id');
//            $data = $this->General->dolistDropdown($this->table_edudistrict, 'id,edu_district_name', 'revenue_district_id=' . $id . ' AND id = ' . $edu_id, 'id');
//        } else {
//            $data = $this->General->dolistDropdown($this->table_edudistrict, 'id,edu_district_name', 'revenue_district_id=' . $id, 'id');
//        }
        $data = $this->General->dolistDropdown($this->table_edudistrict, 'id,edu_district_name', 'revenue_district_id=' . $id, 'id');
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
    }

    /**
     * function for processing subdistrict list via ajax
     * return list of subdistricts
     */
    function listSubdistricts($id = NULL) {
//        if ($this->session->userdata('office_id') == 1007) {
//            $sub_id = $this->session->userdata('subdistrict_id');
//            $data = $this->General->dolistDropdown($this->table_subdistrict, 'id,sub_district_name', 'edu_district_id=' . $id . ' AND id = ' . $sub_id, 'id');
//        } else {
//            $data = $this->General->dolistDropdown($this->table_subdistrict, 'id,sub_district_name', 'edu_district_id=' . $id, 'id');
//        }
        $data = $this->General->dolistDropdown($this->table_subdistrict, 'id,sub_district_name', 'edu_district_id=' . $id, 'id');
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
    }

    function listSubdistrictsByDistrict($id = NULL) {
        $data = $this->General->dolistDropdown($this->table_subdistrict, 'id,sub_district_name', 'revenue_district_id=' . $id, 'id');
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
    }

    /**
     * function for processing office blocks list via ajax
     * return list of offcce blocks
     */
    function listOfficeBlocks($id = NULL) {
        @$has_office_block = $this->General->getrow($this->table_offices, 'has_office_block', array('office_id' => @$id))->has_office_block;
        if ($has_office_block == 1) {
            $data = $this->General->dolistDropdown($this->table_office_block, 'office_block_id,block_name', array('office_id' => $id), 'block_name');
        } else {
            $data = array(0=>'');
        }
        // unset($data[0]);
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
    }

    /**
     * function for processing schools list via ajax
     * return list of schools
     */
    function listSchools($id = NULL) {
        $data = $this->General->dolistDropdown($this->table_schools, 'school_code,school_name', 'sub_district_id=' . $id, 'school_code');
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($data);
    }

    function getManagingUser($office_id,$usergroup_id,$whichoffice=0){ //echo $office_id." -- ".$usergroup_id;exit;
		
        $parent_group_id=$this->General->get_column($this->table_group,'parent_id',array('id'=>$usergroup_id));
        
		
		if ($this->session->userdata('office_id') == ITADMIN_OFFICE){
            $managers=$this->dm->getManagersAdmin($office_id,$parent_group_id,$whichoffice);
          //  print_r($managers);exit;
		}
		else if ($this->session->userdata('office_id') == DEO_OFFICE) {
			$off_id = $this->session->userdata('edudistrict_id');
			$office_name = 'edudistrict_id';
			$managers=$this->dm->getManagers($office_id,$parent_group_id,$off_id,$office_name);
		}else if ($this->session->userdata('office_id') == AEO_OFFICE) {
			$off_id = $this->session->userdata('subdistrict_id');
			$office_name = 'subdistrict_id';
			$managers=$this->dm->getManagers($office_id,$parent_group_id,$off_id,$office_name);
		} else if ($this->session->userdata('office_id') == DDE_OFFICE) {
			$off_id = $this->session->userdata('district_id');
			$office_name = 'district_id';
			$managers=$this->dm->getManagers($office_id,$parent_group_id,$off_id,$office_name);
		} else if ($this->session->userdata('office_id') == DGE_OFFICE) {
			$off_id = $this->session->userdata('district_id');
			$office_name = 'district_id';
			$managers=$this->dm->getManagers($office_id,$parent_group_id,$off_id,$office_name);
		} else if ($this->session->userdata('office_id') == ADMIN_OFFICE) {
			// $off_id = $this->session->userdata('district_id');
            // $office_name = 'district_id';
            $managers=$this->dm->getManagersAdmin($office_id,$parent_group_id,$whichoffice);
			// $managers=$this->dm->getManagers($office_id,$parent_group_id,$off_id,$office_name);
		} else{
            $managers=array();
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($managers);    
    }
    

    function getScaleofPay($desigId){
        $scale_of_pay = $this->General->getrow($this->table_AASF_Designation,'scale',array('id'=>$desigId),'');
          header('Content-Type: application/x-json; charset=utf-8');
         echo json_encode($scale_of_pay);
    }

    function deny(){
           $this->load->view("School/default/denied");
           
    }
    function getAllEducationDist(){
        $edu_districts = $this->General->prepare_select_box_data('master_edudistricts', 'id,edu_district_name', '', '', 'id');
        $display_data = '';
        foreach ($edu_districts as $key => $value) {
            $display_data .= '<option value="'.$key.'">'.$value.'</option>';
        }
        echo $display_data;
    }
    function getAllDistricts(){
        $edu_districts = $this->General->prepare_select_box_data('master_district', 'district_code,district_name','', '', 'district_code');
        $display_data = '';
        foreach ($edu_districts as $key => $value) {
            $display_data .= '<option value="'.$key.'">'.$value.'</option>';
        }
        echo $display_data;
    }

}

?>
