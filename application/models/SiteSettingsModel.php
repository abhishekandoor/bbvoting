<?php

class SiteSettingsModel extends CI_Model
{

    private $tbl_master_site_settings	= 	'master_site_settings';
    private $tbl_designations           = "AASF_Designation";
    private $tbl_master_aa_designation_settings = "master_aa_designation_settings";
    private $tbl_vacancy_nature     = 'AASF_Vcncy_Reasons';
    private $tbl_appt_nature        = 'AASF_Appnt_Nature';
	   
	public function __construct(){
		parent::__construct();
		$this->load->library('AdminLib');
		$this->load->model('CommonModel','CM');
                $this->load->model('General','GM');
	}	

	public function saveOption($options=array()){
			
			$this->db->trans_start();
			$this->db->update($this->tbl_master_site_settings, array('is_enabled'=>0));
			foreach($options as $opt){
				$this->db->where('id', $opt);
				$this->db->update($this->tbl_master_site_settings, array('is_enabled'=>1));
			}
			$apl_disabled = $this->General->getrow($this->tbl_master_site_settings, 'is_enabled', array('id' => 16 ))->is_enabled;
			// temp code added for disabling approval action - temporarily using id now for updating, need to change
			if($apl_disabled==1){
				$this->db->where('id', 2);
				$this->db->update('request_actions', array('req_type'=>100));
			} else{
				$this->db->where('id', 2);
				$this->db->update('request_actions', array('req_type'=>5));
			}
			//
			$this->db->trans_complete();
            if($this->db->trans_status()==true)
            {
                return true;
            }
            else
            {
				// echo $this->db->_error_message();die;
                return false;
            }
	}
        
        function getDesignations_by_role($roleid){
            $this->db->select("desig_id,designation_name");
            $this->db->where_in("desig_id",$roleid);
            $data = $this->db->get("master_designation")->result_array();
            return $data;
        }
        
        function save_IOC_settings($data){
            $ins_data       = array();
            $selected_roles = $this->input->post("selected_roles");
            $settings_type  = $this->input->post("settings_type");
  
            $this->db->where("setid",$settings_type);
            $this->db->where("created_by_master_office_id",$data['master_officeid']);
            $this->db->delete("ioc_settings");   
            
            if(count($selected_roles)>0){
                foreach($selected_roles as $k => $v){
                    $ins_data['setid']                       = $settings_type;
                    $ins_data['created_role']                = $data['role_id'];
                    $ins_data['created_office_id']           = $data['officeid'];
                    $ins_data['created_by_master_office_id'] = $data['master_officeid'];
                    $ins_data['created_by']                  = $data['userID'];
                    $ins_data['created_at']                  = date('Y-m-d H:i:s');
                    $ins_data['accessible_to_role_id']       = $k;                
                    $this->db->insert("ioc_settings",$ins_data);
                }
            }            
        }

    public function saveDesigOptions($option, $designations = array()){
        
        $this->db->trans_start();
        $this->db->update($this->tbl_master_aa_designation_settings, array('is_active' => 0), array('is_active' => 1));
        $this->db->update($this->tbl_master_aa_designation_settings, array('is_active' => 1), array('id' => $option));
        $this->db->update($this->tbl_designations, array('is_allowed_for_appln' => 0));
        if( $option == 5 ){
            foreach($designations as $opt){
                $this->db->where('id', $opt);
                $this->db->update($this->tbl_designations, array('is_allowed_for_appln' => 1));
            }
        }else if( $option == 1 ){ // All Designations
            $this->db->update($this->tbl_designations, array('is_allowed_for_appln' => 1));
        }else if( $option == 2 ){ // HM Only
            // headmaster, headmistress, teacher in-charge
            $this->db->where_in('id', array(85, 176, 86, 147));
            $this->db->update($this->tbl_designations, array('is_allowed_for_appln' => 1));
        }else if( $option == 3 ){ // All Teaching Staff Only
            $this->db->update($this->tbl_designations, array('is_allowed_for_appln' => 1), array('is_teaching' => 'Y'));
        }else if( $option == 4 ){ // All Non-Teaching Staff Only
            $this->db->update($this->tbl_designations, array('is_allowed_for_appln' => 1), array('is_teaching' => 'N'));
        }
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
        {
            return true;
        }
        else
        {
            // echo $this->db->_error_message();die;
            return false;
        }
    }
    
    public function saveANatureOptions($options = array()){
        $this->db->trans_start();
        $this->db->update($this->tbl_appt_nature, array('is_allowed_for_appln' => 0));
        foreach($options as $opt){
            $this->db->where('id', $opt);
            $this->db->update($this->tbl_appt_nature, array('is_allowed_for_appln' => 1));
        }
        
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
        {
            return true;
        }
        else
        {
            // echo $this->db->_error_message();die;
            return false;
        }
    }
    
    public function saveVNatureOptions($options = array()){
        $this->db->trans_start();
        $this->db->update($this->tbl_vacancy_nature, array('is_allowed_for_appln' => 0));
        foreach($options as $opt){
            $this->db->where('id', $opt);
            $this->db->update($this->tbl_vacancy_nature, array('is_allowed_for_appln' => 1));
        }
        
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
        {
            return true;
        }
        else
        {
            // echo $this->db->_error_message();die;
            return false;
        }
	}
}