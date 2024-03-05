<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Rbac_model
 * 
 * 		Handling description of groups , taskgroup, roles
 *  
 * @package		Itchool_rbac
 * @author		Mohamed Rashid C (https://twitter.com/rashivkp)
 * @based on	Tank_Auth 
 */
class Rbac_model extends CI_Model {

    private $table_name = 'rbac_group'; // user group	
    private $item_table_name = 'rbac_items'; // task groups and roles
    private $detils_table_name = 'rbac_items_description'; // roles description in each Task group
    private $scope_table_name = 'rbac_scope'; // roles description in each Task group
    private $surveyTbl='feedbacksurvey';
    private $type_group = 1;
    private $type_role = 0;

    function __construct() {
        parent::__construct();
      
    }
    /****************************************************************************
     * function to save survey
     ************************************************************************/
    function saveSurvey($issue,$suggestion,$date,$userid){
      $insertArray=array('user_id'=>$userid,'problems_faced'=>$issue,'suggestion'=>$suggestion,'date'=>$date);
      $save=$this->db->insert($this->surveyTbl,$insertArray);
      $data = array( 
        'display_msg_chk' => 0,
      ); 
      $this->db->set($data); 
      $this->db->where("id", $userid); 
      $this->db->update("users", $data);
      return true;
    }
    /**
     * creating new usergroup
     * 
     * @param array containing taskgroup and their corresponding roles
     * @return bool
     */
    function new_usergroup($data = NULL) {
        return $this->db->insert($this->table_name, $data);
    }

    /**
     * Updating usergroup
     * 
     * @param int $id usergroup_id
     * @param array $data containing taskgroup and their corresponding roles
     * @return bool
     */
    function update_usergroup($id, $data = array()) {
        $this->db->where($this->table_name . '.id', $id);
        $this->db->update($this->table_name, $data);
        return $this->db->affected_rows() == 1;
    }

    /**
     * creating new taskgroup
     * 
     * @param string name of taskgroup
     * @return bool
     */
    function new_taskgroup($taskgroup) {
        return $this->db->insert($this->item_table_name, array('item' => $taskgroup, 'type' => $this->type_group));
    }
    function getOldPassword($username)
    {
      
	//    $count=$this->db->select('invalid_count')
	//    ->from($this->table_user)
	//    ->where('users', array('username' => $user))ss;
	//    return $count;
	    $this->db->select('password');		
        $this->db->from($this->table_user);
		$this->db->where('username', $user);
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['password'];
		}
		if(isset($value))
			 return $value;
		else {
			return 0;
		}
	}

    /**
     * creating new role
     * 
     * @param string name of role
     * @return void
     */
    function new_role($role) {
        return $this->db->insert($this->item_table_name, array('item' => $role, 'type' => $this->type_role));
    }

    /**
     * creating new scope
     * 
     * @param string name of scope
     * @return void
     */
    function new_scope($scope) {
        return $this->db->insert($this->scope_table_name, array('scope' => $scope));
    }

    /**
     * check if the usergroup is already there
     * 
     * @param string
     * @return bool
     */
    function is_usergroup_available($usergroup, $office) {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(usergroup)=', strtolower($usergroup));
        $this->db->where('office_id', $office);

        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 0;
    }

    /**
     * Check if taskgroup is already there
     *
     * @param	string
     * @return	bool
     */
    function is_taskgroup_available($taskgroup) {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(item)=', strtolower($taskgroup));
        $this->db->where('type', $this->type_group);

        $query = $this->db->get($this->item_table_name);
        return $query->num_rows() == 0;
    }

    /**
     * check if the role is already there
     * 
     * @param string
     * @return bool
     */
    function is_role_available($role) {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(item)=', strtolower($role));
        $this->db->where('type', $this->type_role);

        $query = $this->db->get($this->item_table_name);
        return $query->num_rows() == 0;
    }

    /**
     * check if the scope is already there
     * 
     * @param string
     * @return bool
     */
    function is_scope_available($scope) {
        $this->db->select('1', FALSE);
        $this->db->where('scope', $scope);

        $query = $this->db->get($this->scope_table_name);
        return $query->num_rows() == 0;
    }

    /**
     * get usergroups
     * 
     * @param int $usergroup_id if given, returns the requested usergroup details
     * @return object db::result 
     */
    function get_usergroups($usergroup_id = FALSE, $office = FALSE) {
        if ($office)
            $this->db->where($this->table_name . '.office_id', $office);
        else if ($usergroup_id)
            $this->db->where($this->table_name . '.id', $usergroup_id);
        else {
            $this->db->where($this->table_name . '.priority > ' . $this->get_priority());
            $this->db->order_by($this->table_name . '.priority');
        }
        $this->db->select($this->table_name . '.*, ' . $this->scope_table_name . '.scope');
        $this->db->join($this->scope_table_name, $this->scope_table_name . '.id =' . $this->table_name . '.scope_id');
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }

    /**
     * get all taskgroups
     * @param int $taskgroup_id if given, returns the requested taskgroup details
     * @return object db::result
     */
    function get_taskgroups($id = FALSE) {
        if ($id)
            $this->db->where($this->item_table_name . '.id', $id);
        $this->db->where('type', $this->type_group);
        $query = $this->db->get($this->item_table_name);
        if ($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }

    /**
     * get all roles
     * @return object  db::result
     */
    function get_roles($id = FALSE) {
        if ($id)
            $this->db->where($this->item_table_name . '.id', $id);
        $this->db->where('type', $this->type_role);
        $query = $this->db->get($this->item_table_name);
        if ($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }

    /**
     * get user scopes
     * @return object
     */
    function get_scopes() {
        return $this->db->get($this->scope_table_name)->result();
    }

    /**
     * get current user's usergroup priority
     * @return int
     */
    function get_priority() {
        $this->db->select('priority');
        $this->db->where('id', $this->itschool_rbac->get_usergroup_id());
        return $this->db->get($this->table_name)->row()->priority;
    }

    function is_priority_assigned($priority) {
        $this->db->select('1', FALSE);
        $this->db->where('priority', $priority);
        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 1;
    }

    /**
     * fucntion for getting list of scopes
     * @param qualification level id
     */
    function do_list_scope($id = null) {
        $this->db->select('id, scope');

        if ($id != NULL) {
            $this->db->where('office_id', $id);
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('rbac_scope');

        $courses = array('0' => 'Select Scope');

        if ($query->result()) {
            foreach ($query->result() as $course) {
                $courses[$course->id] = $course->scope;
            }
            return $courses;
        } else {
            return FALSE;
        }
    }

    /**
     * fucntion for getting list of parents
     * @param qualification level id
     */
    function do_list_parent($id = null) {
        $this->db->select('id, usergroup');

        if ($id != NULL) {
            $this->db->where('office_id', $id);
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('rbac_group');

        $courses = array('0' => 'Select Parent');

        if ($query->result()) {
            foreach ($query->result() as $course) {
                $courses[$course->id] = $course->usergroup;
            }
            return $courses;
        } else {
            return FALSE;
        }
    }

    /**
     * fucntion for getting list of usergroups
     * @param office id
     */
    function do_list_usergroup($id = null) {
        $this->db->select('id, usergroup');

        if ($id != NULL) {
            $this->db->where('office_id', $id);
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('rbac_group');

        $courses = array('0' => 'Select Parent');

        if ($query->result()) {
            foreach ($query->result() as $course) {
                $courses[$course->id] = $course->usergroup;
            }
            return $courses;
        } else {
            return FALSE;
        }
    }

    function get_userlist($searchFiled, $searchId, $officeOnly=NULL, $master_office = NULL) {
        $this->db->select("U.id,U.username,U.email,U.is_sampoorna, US.descp,U.user_status,
        (CASE  
		  WHEN U.activated ='1' THEN 'Active'
		  WHEN U.banned = '1' THEN 'De-Active'
		 END) as current_status,
            CONCAT_WS(' ', UF.name, UF.middle_name, UF.last_name)AS name,
          MD.designation_name as designation,UG.usergroup,MDS.district_name,
          ME.edu_district_name,MS.sub_district_name,U.office_id, MD.desig_id,
          MB.block_name,

          (CASE when U.office_id=1002 then CONCAT_WS(' ', ' DDE ', MDS.district_name, ' ' ) 
            when U.office_id=1006 then CONCAT_WS(' ',' DEO ', ME.edu_district_name, ' ' ) 
            when U.office_id=1007 then CONCAT_WS(' ',' AEO ', MS.sub_district_name, ' ' ) 
            when U.office_id=1001 then ' DGE office '
            when U.office_id=1008 then UF.name
            when U.office_id=1010 then UF.name
            when U.office_id=1011 then UF.name
            when U.office_id=1014 then CONCAT_WS(' ',' SuperCheckCell ', ZN.zone_name, ' ' ) 
            when U.office_id=1015 then CONCAT_WS(' ',' Law Office ', ' ' ) 
           else ' Samanwaya ' end) as userofficename, MG.mngmnt_code, MG.mngmnt_name

        ");
        //$this->db->join('user_profiles UP','UP.user_id=U.id');
        $this->db->from('users U');
        $this->db->join('user_profiles UF', 'UF.user_id = U.id');
        $this->db->join('AASF_User_Status US','US.id=U.user_status');
        $this->db->join('master_designation MD', 'MD.desig_id = U.designation_id');
        $this->db->join('rbac_group UG', 'UG.id = U.user_group_id');
        $this->db->join('master_district MDS', 'MDS.district_code = U.district_id', 'LEFT');
        $this->db->join('master_edudistricts ME', 'ME.id = U.edudistrict_id', 'LEFT');
        $this->db->join('master_subdistricts MS', 'MS.id = U.subdistrict_id', 'LEFT');
        //
        $this->db->join('master_office_block MB', 'MB.office_block_id = U.office_block_id', 'LEFT');
        //
        $this->db->join('AASF_Management MG', 'MG.id = U.school_management_id', 'LEFT');

        $this->db->join('master_zones ZN ', ' ZN.master_zone_id = U.zone_id', 'left');

        if ($searchId > 0) {
            if($searchFiled == 'office_id'){
                $this->db->where('U.office_id', $searchId);
                $this->db->order_by('activated', 'desc');
            }elseif($this->session->userdata('office_id') == DGE_OFFICE){
                $this->db->where('U.office_id', $searchId);
                $this->db->order_by('activated', 'desc');
            }else{
                $this->db->where($searchFiled, $searchId);
                $this->db->order_by('activated', 'desc');
            }
            //$this->db->order_by('banned', 'asc');
            //ORDER By Name ASC
        }
        $this->db->where('U.id !=', $this->session->userdata('user_id'));
        $this->db->where('U.id !=',ITADMIN_USER_ID);
        if($officeOnly!=NULL){
            $this->db->where('U.office_id', $master_office);
        }else{
            if($this->session->userdata('office_id') > DGE_OFFICE && $this->session->userdata('office_id') != ADMIN_OFFICE 
                    && $this->session->userdata('office_id') != SUPER_CHECK_OFFICE){
                //$this->db->where('U.office_id', $this->session->userdata('office_id'));
                $this->db->where_in('U.office_id', array($this->session->userdata('office_id'),'1011','1010', '1014', '1015')); // ,'1012'
            }
        }
        $this->db->where('U.is_transfered', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_manager_userlist($searchFiled, $searchId, $officeOnly=NULL, $master_office = NULL) {
        $this->db->select("U.id, U.username, U.email, U.is_sampoorna, MG.id as mgmt_id, MG.mngmnt_code, MG.mngmnt_name, US.descp, U.user_status, 
        (CASE  
		  WHEN U.activated ='1' THEN 'Active'
          WHEN U.banned = '1' THEN 'De-Active'
          ELSE ''
		 END) as current_status,
            CONCAT_WS(' ', UF.name, UF.middle_name, UF.last_name) AS name,
          MD.designation_name as designation, UG.usergroup, MDS.district_name,
          ME.edu_district_name, MS.sub_district_name, U.office_id, MD.desig_id,
          MGT.tenure_id, MGT.is_current, MGT.start_date, MGT.end_date,

          CONCAT_WS(' ', MG.mngmnt_name, '[', (CASE when MG.mmngmnt_type='C' then ' Corporate ' when MG.mmngmnt_type='I' then ' Individual ' end), ' Management ]', ' ' ) as mngmnt_name_type,
          (CASE when MG.mmngmnt_type='C' then ' Corporate ' when MG.mmngmnt_type='I' then ' Individual ' end)as mngmnt_type, MG.address as mngmnt_address

        ");
        $this->db->from('AASF_Management MG');
        $this->db->join('users U', 'U.school_management_id = MG.id AND U.activated=1', 'LEFT');
        $this->db->join('user_profiles UF', 'UF.user_id = U.id', 'LEFT');
        $this->db->join('AASF_User_Status US','US.id=U.user_status', 'LEFT');
        $this->db->join('master_designation MD', 'MD.desig_id = U.designation_id', 'LEFT');
        $this->db->join('rbac_group UG', 'UG.id = U.user_group_id', 'LEFT');
        $this->db->join('master_district MDS', 'MDS.district_code = U.district_id', 'LEFT');
        $this->db->join('master_edudistricts ME', 'ME.id = U.edudistrict_id', 'LEFT');
        $this->db->join('master_subdistricts MS', 'MS.id = U.subdistrict_id', 'LEFT');
        //
        $this->db->join('manager_tenure MGT', 'MGT.management_id = MG.id AND MGT.user_id = U.id AND MGT.is_current = 1', 'LEFT');
        //

        /*if ($searchId > 0) {
            if($searchFiled == 'office_id'){
                $this->db->where('U.office_id', $searchId);
                // $this->db->order_by('MG.mngmnt_name', 'ASC');
            }elseif($this->session->userdata('office_id') == DGE_OFFICE){
                $this->db->where('U.office_id', $searchId);
                // $this->db->order_by('MG.mngmnt_name', 'ASC');
            }else{
                $this->db->where($searchFiled, $searchId);
                // $this->db->order_by('MG.mngmnt_name', 'ASC');
            }
            //$this->db->order_by('banned', 'asc');
            //ORDER By Name ASC
        }
        $this->db->where('U.id !=', $this->session->userdata('user_id'));
        $this->db->where('U.id !=',ITADMIN_USER_ID);
        $this->db->where('U.office_id', '1012');*/
        // $this->db->where('MGT.is_current', 1);
        $this->db->where('MG.edu_district_code', $searchId);
        $this->db->order_by('MG.mngmnt_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_userlistdde($searchFiled, $searchId) {
        $this->db->select('U.id,U.username,U.email,U.is_sampoorna,MG.mngmnt_code, MG.mngmnt_name,US.descp,U.user_status,
        (CASE  
		  WHEN U.activated ="1" THEN "Active"
		  WHEN U.banned = "1" THEN "De-Active"
		 END) as current_status,
            CONCAT_WS(" ", UF.name, UF.middle_name, UF.last_name)AS name,
          MD.designation_name as designation,UG.usergroup,MDS.district_name,
          ME.edu_district_name,MS.sub_district_name,U.office_id, MB.block_name
        ');
        //$this->db->join('user_profiles UP','UP.user_id=U.id');
        $this->db->from('users U');
        $this->db->join('user_profiles UF', 'UF.user_id = U.id');
        $this->db->join('AASF_User_Status US','US.id=U.user_status');
        $this->db->join('master_designation MD', 'MD.desig_id = U.designation_id');
        $this->db->join('rbac_group UG', 'UG.id = U.user_group_id');
        $this->db->join('master_district MDS', 'MDS.district_code = U.district_id', 'LEFT');
        $this->db->join('master_edudistricts ME', 'ME.id = U.edudistrict_id', 'LEFT');
        $this->db->join('master_subdistricts MS', 'MS.id = U.subdistrict_id', 'LEFT');
        //
        $this->db->join('master_office_block MB', 'MB.office_block_id = U.office_block_id', 'LEFT');
        //
        $this->db->join('AASF_Management MG', 'MG.id = U.school_management_id', 'LEFT');
        if ($searchId > 0) {
            $this->db->where($searchFiled, $searchId);
            $this->db->order_by('activated', 'desc');
            //$this->db->order_by('banned', 'asc');
            //ORDER By Name ASC
        }
        $this->db->where('U.id !=', $this->session->userdata('user_id'));
        if($this->session->userdata('office_id') > 1001){
            //$this->db->where('U.office_id', $this->session->userdata('office_id'));
            $this->db->where_in('U.office_id', array($this->session->userdata('office_id'),'1012','1011','1010'));
        }
        if($this->session->userdata('office_id')==1002)
        {
            $this->db->where('U.is_sampoorna <>',1);
            $this->db->where('U.office_id <>',1012);
        }
        $this->db->where('U.is_transfered', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

  
    function get_userlist_transfered($searchFiled, $searchId) {
        $this->db->select('U.id,U.user_id,U.email,U.transferred_on,        
          CONCAT_WS(" ", UF.name, UF.middle_name, UF.last_name)AS name,
          MD.designation_name as designation,UG.usergroup,MO.office_name,MDS.district_name,
          ME.edu_district_name,MS.sub_district_name
        ');
        //$this->db->join('user_profiles UP','UP.user_id=U.id');
        $this->db->from('AASF_User_Transfer U');
        $this->db->join('user_profiles UF', 'UF.user_id = U.user_id');
        $this->db->join('master_designation MD', 'MD.desig_id = U.designation_id');
        $this->db->join('rbac_group UG', 'UG.id = U.user_group_id');
        $this->db->join('master_offices MO', 'MO.office_id = U.dest_office_id');
        $this->db->join('master_district MDS', 'MDS.district_code = U.dest_district_id');
        $this->db->join('master_edudistricts ME', 'ME.id = U.dest_edudistrict_id', 'LEFT');
        $this->db->join('master_subdistricts MS', 'MS.id = U.dest_subdistrict_id', 'LEFT');
        if ($searchId > 0) {
            if($searchFiled == 'office_id'){
                $this->db->where('U.office_id', $searchId);
            }elseif($this->session->userdata('office_id') == DGE_OFFICE)
                $this->db->where('U.office_id', $searchId);
            else
                $this->db->where($searchFiled, $searchId);
        }
        $this->db->order_by('transferred_on', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_userlist_new($searchFiled, $searchId) {
        $this->db->select('U.id,U.user_id,U.email,U.transferred_on,US.pen,       
           CONCAT_WS(" ", UF.name, UF.middle_name, UF.last_name)AS name,
          MD.designation_name as designation,UG.usergroup,MO.office_name,MDS.district_name,
          ME.edu_district_name,MS.sub_district_name,MEE.edu_district_name as dest_deo,
          MSS.sub_district_name as dest_aeo,MOO.office_name as dest_office');
        //$this->db->join('user_profiles UP','UP.user_id=U.id');
        $this->db->from('AASF_User_Transfer U');
        $this->db->join('(select MAX(id) as tid,dest_subdistrict_id,dest_edudistrict_id,dest_office_id'
                . ' from AASF_User_Transfer group by user_id  order by id desc) as z','z.tid = U.id');
        $this->db->join('user_profiles UF', 'UF.user_id = U.user_id');
        $this->db->join('master_designation MD', 'MD.desig_id = U.designation_id');
        $this->db->join('rbac_group UG', 'UG.id = U.user_group_id');
        $this->db->join('master_offices MO', 'MO.office_id = U.office_id');
        $this->db->join('master_district MDS', 'MDS.district_code = U.district_id');
        $this->db->join('master_edudistricts ME', 'ME.id = U.edudistrict_id', 'LEFT');
        $this->db->join('master_subdistricts MS', 'MS.id = U.subdistrict_id', 'LEFT');
        $this->db->join('master_edudistricts MEE', 'MEE.id = z.dest_edudistrict_id', 'LEFT');
        $this->db->join('master_subdistricts MSS', 'MSS.id = z.dest_subdistrict_id', 'LEFT');
        $this->db->join('master_offices MOO', 'MOO.office_id = z.dest_office_id', 'LEFT');
        $this->db->join('users US', 'US.id = U.user_id');
        if ($searchId > 0) {
            $this->db->where('US.' . $searchFiled, $searchId);
        }
        $this->db->where('US.is_transfered', 1);
//        $this->db->group_by('U.user_id');
        $this->db->order_by('transferred_on', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getTransferedDetails($userid){
        //function to get the transfer details of a given user
        $this->db->select('user_id, designation_id, office_block_id, transferred_to, dest_office_id, dest_district_id, dest_subdistrict_id, dest_edudistrict_id, user_group_id, managing_id, dest_office_block_id');
        $this->db->from('AASF_User_Transfer');
        $this->db->where('user_id=',$userid);
        $this->db->order_by('transferred_on', 'desc');
        $this->db->limit(1);
        $data=$this->db->get();        
       // print_r($data->result_array());exit;
       return $data->result_array();

    }

    function getUserdetailsoftransfered($Id) {
        $this->db->select('U.id,U.user_id,U.email,U.transferred_on,        
           CONCAT_WS(" ", UF.name, UF.middle_name, UF.last_name)AS name,
          MD.designation_name as designation,UG.usergroup,MO.office_name,MDS.district_name,
          ME.edu_district_name,MS.sub_district_name,U.user_group_id,U.district_id,U.edudistrict_id,
          U.subdistrict_id,U.office_id,U.dest_district_id,U.dest_office_id,U.dest_subdistrict_id,U.dest_edudistrict_id
        ');
        //$this->db->join('user_profiles UP','UP.user_id=U.id');
        $this->db->from('AASF_User_Transfer U');
        $this->db->join('user_profiles UF', 'UF.user_id = U.user_id');
        $this->db->join('master_designation MD', 'MD.desig_id = U.designation_id');
        $this->db->join('rbac_group UG', 'UG.id = U.user_group_id');
        $this->db->join('master_offices MO', 'MO.office_id = U.office_id');
        $this->db->join('master_district MDS', 'MDS.district_code = U.district_id');
        $this->db->join('master_edudistricts ME', 'ME.id = U.edudistrict_id', 'LEFT');
        $this->db->join('master_subdistricts MS', 'MS.id = U.subdistrict_id', 'LEFT');
        $this->db->join('users US', 'US.id = U.user_id');
        $this->db->where('U.id', $Id);
        $this->db->where('US.is_transfered', 1);
        $this->db->order_by('transferred_on', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * function for checking the privilege for transfer a user to another office 
     * @param int sessionUser is the current user logged
     * @param int $userId User which need to transfer
     */
    function checkPrevilagetotransfer($sessionUser, $userId) {
        if ($this->session->userdata('office_id') == 1002) {
            $searchFiled = 'district_id';
            $searchId = $this->session->userdata('district_id');
            $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
        } elseif ($this->session->userdata('office_id') == 1006) {
            $searchFiled = 'edudistrict_id';
            $searchId = $this->session->userdata('edudistrict_id');
            $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
        } elseif ($this->session->userdata('office_id') == 1007) {
            $searchFiled = 'subdistrict_id';
            $searchId = $this->session->userdata('subdistrict_id');
            $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
        } elseif ($this->session->userdata('office_id') <= 1001 || $this->session->userdata('office_id') == 1013) {
            $data['userlist'] = $this->m_rbac->get_userlist(0, 0);
        }
        $ret_array = array();
        foreach ($data['userlist'] as $key => $val) {
            if ($val['id'] == $userId) {
                return $val;
            }
        }
        return $ret_array;
    }

    function transferUser($post, $transferUser, $sessionUser) {

        $this->db->where('id', $transferUser);
        $query = $this->db->get('users');
        $userTotransfer = $query->result_array()[0];

        $data = array();
        if(@$post['rollback']!=1){//if not rollback . Same function used for transfer and roll back to avoid confusions splitted existing fn.
        $data['user_id'] = $userTotransfer['id'];
        $data['email'] = $userTotransfer['email'];
        $data['school_code'] = $userTotransfer['school_code'];
        $data['school_management_id'] = $userTotransfer['school_management_id'];
        $data['created_by'] = $userTotransfer['created_by'];
        $data['office_id'] = $userTotransfer['office_id'];
        $data['office_block_id'] = $userTotransfer['office_block_id'];
        $data['district_id'] = $userTotransfer['district_id'];
        $data['subdistrict_id'] = $userTotransfer['subdistrict_id'];
        $data['edudistrict_id'] = $userTotransfer['edudistrict_id'];
        $data['designation_id'] = $userTotransfer['designation_id'];
        $data['user_group_id'] = $userTotransfer['user_group_id'];
        $data['managing_id'] = $userTotransfer['managing_id'];
        $data['assigned_on'] = $userTotransfer['created'];
        $data['transferred_on'] = date("Y-m-d H:i:s");
        $data['transferred_from'] = $this->session->userdata('office_id');
        $data['transferred_to'] = $post['office'];
        $data['dest_office_id'] = $post['office'];
        $data['dest_district_id'] = $post['district'];
        $data['dest_subdistrict_id'] = ($post['subdistrict'] == NULL) ? 0 : $post['subdistrict'];
        $data['dest_edudistrict_id'] = ($post['edudistrict'] == NULL) ? 0 : $post['edudistrict'];
        $data['transferred_by'] = $sessionUser;

        $insert = $this->db->insert('AASF_User_Transfer', $data);

        $data1 = array();
        $data1['office_id'] = $post['office'];
        $data1['office_block_id'] = $post['office_block'];
        $data1['district_id'] = $post['district'];
        $data1['edudistrict_id'] = $post['edudistrict'];
        $data1['subdistrict_id'] = $post['subdistrict'];
        $data1['banned'] = 1;
        $data1['is_transfered'] = 1;
        $data1['ban_reason'] = 'Transferd from current office';
        $data1['managing_id'] = 1;

        $this->db->where('id', $transferUser);
        $update = $this->db->update('users', $data1);
        }
        else
        {
            $data['user_id'] = $userTotransfer['id'];
            $data['email'] = $userTotransfer['email'];
            $data['school_code'] = $userTotransfer['school_code'];
            $data['school_management_id'] = $userTotransfer['school_management_id'];
            $data['created_by'] = $userTotransfer['created_by'];
            $data['office_id'] = $userTotransfer['office_id'];
            $data['office_block_id'] = $userTotransfer['office_block_id'];
            $data['district_id'] = $userTotransfer['district_id'];
            $data['subdistrict_id'] = $userTotransfer['subdistrict_id'];
            $data['edudistrict_id'] = $userTotransfer['edudistrict_id'];
            $data['designation_id'] = $userTotransfer['designation_id'];
            $data['user_group_id'] = $userTotransfer['user_group_id'];
            $data['managing_id'] = $userTotransfer['managing_id'];
            $data['assigned_on'] = $userTotransfer['created'];
            $data['transferred_on'] = date("Y-m-d H:i:s");
            $data['transferred_from'] = $this->session->userdata('office_id');
            $data['transferred_to'] = $post['office'];
            $data['dest_office_id'] = $post['office'];
            $data['dest_district_id'] = $post['district'];
            $data['dest_subdistrict_id'] = ($post['subdistrict'] == NULL) ? 0 : $post['subdistrict'];
            $data['dest_edudistrict_id'] = ($post['edudistrict'] == NULL) ? 0 : $post['edudistrict'];
            $data['transferred_by'] = $sessionUser;
    
            $insert = $this->db->insert('AASF_User_Transfer', $data);
            //print_r($data);exit;
    
            $data1 = array();
            $data1['office_id'] = $post['office'];
            $data1['office_block_id'] = $post['office_block'];
            $data1['district_id'] = $post['district'];
            $data1['edudistrict_id'] = $post['edudistrict'];
            $data1['subdistrict_id'] = $post['subdistrict'];
            $data1['banned'] = 1;
            $data1['is_transfered'] = 1;
            $data1['ban_reason'] = 'Transferd from current office';
            $data1['managing_id'] = 1;
           // print_r($data);exit;
            
            $this->db->where('id', $transferUser);
            $update = $this->db->update('users', $data1);
           

        }

        return true;
    }

    function saveTransferedUser($post) {
     //  print_r($post);exit;
        $data1 = array();
        if(isset($post))
        {
        if($this->session->userdata('office_id')!=1000 && $this->session->userdata('office_id')!=1013)  
        {
        $data1['office_id'] = $post['office'];
        $data1['office_block_id'] = $post['office_block'];
        $data1['designation_id'] = $post['designation'];
        $data1['user_group_id'] = $post['usergroup'];
        $data1['district_id'] = $this->session->userdata('district_id');
        $data1['edudistrict_id'] = $this->session->userdata('edudistrict_id');
        $data1['subdistrict_id'] = $this->session->userdata('subdistrict_id');
        $data1['banned'] = 0;
        $data1['activated'] = 1;
        $data1['is_transfered'] = 0;
        $data1['ban_reason'] = '';
        $data1['managing_id'] = $post['managing'];
        }
        else
        {
        $data1['office_id'] = $post['office'];
        $data1['designation_id'] = $post['designation'];
        $data1['user_group_id'] = $post['usergroup'];
        if($this->session->userdata('office_id')==1013){
            $data1['district_id']    = $this->session->userdata('district_id');
            $data1['edudistrict_id'] = $post['edudistrict'];
            $data1['subdistrict_id'] = $post['subdistrict'];
        }
        else{
            $data1['district_id'] = $post['district_id'];
            $data1['edudistrict_id'] = $post['edudistrict_id'];
            $data1['subdistrict_id'] = $post['subdistrict_id'];
        }
        $data1['banned'] = 0;
        $data1['activated'] = 1;
        $data1['is_transfered'] = 0;
        $data1['ban_reason'] = '';
        $data1['managing_id'] = $post['managing'];

        }
        
        // if(isset($post['managing']))
        //  $data1['managing_id'] = $post['managing'];
        // else {
        //     $data1['managing_id'] = NULL;//to avoid undefined index manager id error
        // }
        //echo $post['transfereduserid'];exit;

        $this->db->where('id', $post['transfereduserid']);
        $update = $this->db->update('users', $data1);
       // echo $update;exit;
        return true;
        }
        else 
          return false;
    } 

    function rollbackUser($userid) {
        $this->db->where('id', $userid);
        $query = $this->db->get('AASF_User_Transfer');
        $userTotransfer = $query->result_array()[0];
       
        $data1 = array();
        $data1['office'] = $userTotransfer['office_id'];
        $data1['office_block'] = $userTotransfer['office_block_id'];
        $data1['district'] = $userTotransfer['district_id'];
        $data1['edudistrict'] = $userTotransfer['edudistrict_id'];
        $data1['subdistrict'] = $userTotransfer['subdistrict_id'];
        $data1['banned'] = 1;
        $data1['is_transfered'] = 1;
        $data1['ban_reason'] = 'Transferred from current office';
        $data1['managing_id'] = 1;
        $data1['rollback'] =1;//to fix rollback transfer user issue
        $this->transferUser($data1, $userTotransfer['user_id'], $this->session->userdata('user_id'));
    }
    
    function update_user(){
         $this->db->trans_start();
        $data = array(
            //'username' =>  $this->input->post('username'),
           // 'pen' => $this->input->post('pen'),            
            'email' => $this->input->post('email'),
            'last_ip' => $this->input->ip_address(),
            'managing_id' => $this->input->post('managing'),
            'user_group_id' => $this->input->post('usergroup'),
            'designation_id' => $this->input->post('designation'),
            'office_block_id' => $this->input->post('office_block'),
            
        );
        
        if($this->input->post('schoolmanagement')!=0)
          $data['school_management_id']=$this->input->post('schoolmanagement');
          
        $this->db->where('id',$this->input->post('hiddenid'));
        $this->db->where('pen',$this->input->post('pen'));
        $this->db->update('users',$data);
        
        $profile_data = array(
            'name' => $this->input->post('profile_name'),
            'phone' => $this->input->post('mobile')            
        );
        $this->db->where('user_id',$this->input->post('hiddenid'));
        $this->db->update('user_profiles',$profile_data);
        $this->db->trans_complete();
      if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return 0;
      }else{
          return 1;
      }
    }

    function getUserAccount($pen)
    {
        //function to get user status
        $user=$this->db->select('U.username,U.pen,UF.name,U.user_status
        ');
        //$this->db->join('user_profiles UP','UP.user_id=U.id');
        $this->db->from('users U');
        $this->db->join('user_profiles UF', 'UF.user_id = U.id');
        $this->db->join('AASF_User_Status US','US.id = U.user_status');
        $this->db->where('U.pen',$pen);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }

    function updateUserStatus($pen,$choice)
    {
        //this model is used to update user status like suspension ,retirement etc.
        //echo $choice;exit;
        $this->db->trans_start();
        $selectChoice=$this->db->select('descp');
        $this->db->from('AASF_User_Status');
        $this->db->where('id',$choice);//exit;

        $query=$this->db->get();  //print_r($query);exit;
      
        if ($query->num_rows() > 0) {
            $descp= $query->row()->descp;
           // echo $descp;exit;
        }
       // $result=$query->result_array();
       // print_r($result);exit;

        $data=array('activated'=>0,'banned'=>1,'ban_reason'=>$descp,'user_status'=>$choice);
        $this->db->where('pen', $pen);
        $this->db->update('users', $data);

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            return true;;
        }

    }

    function getUsersByPen($pen,$is_where=NULL){//if @param is where = 1 then the pen is user_id
        $this->db->select('UP.name,md.designation_name,rg.usergroup,U.id as user_id,U.pen,U.office_id,U.designation_id,U.user_group_id,(CASE WHEN (U.office_id = 1006) THEN U.edudistrict_id WHEN (U.office_id = 1007) THEN U.subdistrict_id WHEN (U.office_id = 1002 OR U.office_id = 1001) THEN U.district_id END) as office,U.office_block_id,U.email,UP.phone,U.subdistrict_id,U.edudistrict_id,U.district_id,U.zone_id,U.has_full_addition_role');
        $this->db->from('users  as U');
        $this->db->join("user_profiles AS UP","UP.user_id = U.id");
        $this->db->join($this->table_name.' as rg','U.user_group_id = rg.id','left');
        $this->db->join('master_designation as md','md.desig_id = U.designation_id','left');
        if($is_where == 1){
            $user_id = $pen;
            $this->db->where('U.id', $user_id); 
            $data = $this->db->get()->row();
        }elseif($is_where == 2){//Get all un tracked full addition charge users
            $len = $pen;
            $this->db->where('LENGTH(U.pen)>', $len); 
            // $this->db->where_in('designation_id',array($this->adminlib->get_pa_full_addition_id(),$this->adminlib->get_ss_full_addition_id(),$this->adminlib->get_aeo_full_addition_id(),$this->adminlib->get_deo_full_addition_id()));
            $data = $this->db->get()->result_array();
        }elseif($is_where == 3){//User details for un tracked full addition charge
            $this->db->where('U.pen', $pen); 
            $data = $this->db->get()->row();
        }
        elseif($is_where == NULL){
            $this->db->like('U.pen', $pen, 'after'); 
            $data = $this->db->get()->result_array();
        }
        return $data;
    }

    function saveFullAdditionService($d){
        $this->db->trans_start();
        $data["user_id"] = $d['user_id'];
        $data["role_id"] = $d['designation'];
        $data["user_group_id"] = $d['user_group'];
        $data["master_office_id"] = $d['master_office'];
        $data["office_id"] = $d['office_id'];
        $data["office_block_id"] = $d['office_block'];
        $data['district_id']    = $d['district_id'];
        $data['edudistrict_id'] = $d['edudistrict_id'];
        $data['subdistrict_id'] = $d['subdistrict_id'];
        $data["assigned_from"] = $d['from_date'];
        $data["created_by"] = $this->adminlib->get_user_id();
        $data["created_role"] = $this->adminlib->get_role_id();
        $data["created_user_group_id"] = $this->adminlib->get_user_group_id();
        $data["created_office_id"] = $this->adminlib->get_office_id();
        $data["created_master_office_id"] = $this->adminlib->get_master_office_id();
        $data["created_office_block_id"] = $this->adminlib->get_office_block_id();
        $data["created_at"] = date("Y-m-d H:i:s");
        $data["is_active"]= 1;
        $this->db->insert('full_addition_service_history', $data);

        $du['has_full_addition_role'] = $d['has_full_addition']+1;
        $this->db->where("id", $d['user_id']); 
        $this->db->update("users",$du);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }   
    }

    function getFullAdditionDtls($user_id){
        $this->db->select('md.designation_name,rg.usergroup,FH.user_id,FH.assigned_from,FH.assigned_to,FH.master_office_id,
            FH.office_id,FH.office_block_id,FH.is_active,FH.id,FH.created_at,FH.deleted_at');
        $this->db->from('full_addition_service_history  as FH');
        $this->db->join($this->table_name.' as rg','FH.user_group_id = rg.id','left');
        $this->db->join('master_designation as md','md.desig_id = FH.role_id','left');
        $this->db->where('FH.user_id', $user_id); 
        $this->db->order_by('FH.is_active','DESC'); 
        $data = $this->db->get()->result_array();
        return $data;

    }

     function getFullAdditionUsers($is_active=NULL){
        $this->db->select('md.designation_name,FH.user_id,UP.name,U.pen,has_full_addition_role');
        $this->db->from('full_addition_service_history  as FH');
        $this->db->join('users as U','U.id = FH.user_id');  
        $this->db->join("user_profiles AS UP","UP.user_id = U.id");
        $this->db->join('master_designation as md','md.desig_id = U.designation_id','left'); 
        if($is_active == 1){
            $this->db->where('has_full_addition_role>',0);
        }else if($is_active == 0){
            $this->db->where('has_full_addition_role',0);
        }
        $this->db->group_by('FH.user_id');
        $data = $this->db->get()->result_array();
        return $data;

    }

    function addUserForFulladdition($arr){
        $this->db->trans_start();
            $data['user_id']                    = $arr->user_id;
            $data['role_id']                    = $arr->designation_id;
            $data['user_group_id']              = $arr->user_group_id;
            $data['office_id']                  = $arr->office;
            $data['master_office_id']           = $arr->office_id;
            $data['office_block_id']            = $arr->office_block_id;
            $data['zone_id']                    = $arr->zone_id;
            $data['district_id']                = $arr->district_id;
            $data['edudistrict_id']             = $arr->edudistrict_id;
            $data['subdistrict_id']             = $arr->subdistrict_id;
            $data['assigned_from']              = date("Y-m-d H:i:s");
            $data['created_by']                 = $this->adminlib->get_user_id();
            $data['created_role']               = $this->adminlib->get_role_id();
            $data['created_user_group_id']      = $this->adminlib->get_user_group_id();
            $data['created_office_id']          = $this->adminlib->get_office_id();
            $data['created_master_office_id']   = $this->adminlib->get_master_office_id();
            $data['created_office_block_id']    = $this->adminlib->get_office_block_id();
            $data['created_at']                 = date("Y-m-d H:i:s");
            $data['is_active']                  = 1;
            $data['is_delete']                  = 1;
            $this->db->insert('full_addition_service_history', $data);

            $has_full_addition = $this->General->getrow('users', 'has_full_addition_role',array('id'=>$arr->user_id))->has_full_addition_role;
            $du['has_full_addition_role'] = $has_full_addition+1;
            $this->db->where("id", $arr->user_id); 
            $this->db->update("users",$du);
            $this->db->trans_complete();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        } 
    }

    function getUserGroupsByBlock($master_office,$block,$desig=null){
        $this->db->select('ug.id,ug.usergroup');
        $this->db->from('users u');
        $this->db->join($this->table_name.' as ug','ug.id = u.user_group_id');
        $this->db->where('u.office_id',$master_office);
        $this->db->where('u.office_block_id',$block);
        if($desig != null)
            $this->db->where('u.designation_id',$desig);
        $this->db->order_by('ug.usergroup'); 
        $data = $this->db->get()->result_array();
        return $data;
    }
    function getUserGroupsByDesignation($master_office,$desig=''){
        $this->db->select('ug.id,ug.usergroup');
        $this->db->from('users u');
        $this->db->join($this->table_name.' as ug','ug.id = u.user_group_id');
        $this->db->where('u.office_id',$master_office);
        if($desig != ''){
            $this->db->where('u.designation_id',$desig);
        }
        $this->db->order_by('ug.usergroup'); 
        $data = $this->db->get()->result_array();
        return $data;
    }
    

    function updateSectionDistrictMapping($dist,$usrgrp,$office_id)
    {
        $this->db->trans_start();
        $is_exist = $this->General->find_record_exists('section_district_mapper','id','dist_id='.$dist.' and master_office_id = '.$office_id);
        if($is_exist == 1){
            if($usrgrp == '' || $usrgrp == null){
                $this->db->where('dist_id',$dist);
                $this->db->where('master_office_id',$office_id);
                $this->db->delete('section_district_mapper'); 
            }else{
                $data['usergroup_id'] = $usrgrp;
                $this->db->where('dist_id',$dist);
                $this->db->where('master_office_id',$office_id);
                $this->db->update('section_district_mapper',$data);   
            }
        }elseif($is_exist == 0){
            $data['dist_id'] = $dist;
            $data['usergroup_id'] = $usrgrp;
            $data['master_office_id'] = $office_id;
            $this->db->insert('section_district_mapper',$data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        } 
    }
    function getSectionMappedDists(){
        $this->db->select('md.district_name,md.district_code,sd.usergroup_id');
        $this->db->join('master_district as md','md.district_code = sd.dist_id');
        $data = $this->db->get('section_district_mapper sd')->result_array();
        foreach($data as $row){
            $new_data[$row['usergroup_id']][] = $row;
        }
        return $new_data;
    }

}

/* End of file rbac_model.php */
/* Location: ./application/models/rbac/rbac_model.php */
