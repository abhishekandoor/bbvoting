<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Rbac_profile
 * 
 * Profile information handling
 *  
 * @package		Itchool_rbac
 * @author		Renjith P
 * @based on	Tank_Auth 
 */
class Rbac_profile extends CI_Model {

    private $table_name = 'users'; // user accounts
    private $profile_table_name = 'user_profiles'; // user profiles
    private $address_table_name = 'user_address'; // user address
    private $group_table_name = 'rbac_group'; // user groups
    private $scope_table_name = 'rbac_scope'; // user scope
    private $education_table_name = 'user_eduqualification'; // user education qualification
    private $jobprofile_table_name = 'user_job_profile'; // user education qualification
    private $table_office = 'master_offices'; // table office master
    private $table_designation = 'master_designation'; //table name of master table for designation

    function __construct() {
        parent::__construct();
    }

    /**
     * geting profile data
     * 
     * @param int $user_id
     * @return object db::row
     */
    function get_profile($user_id) {
        $this->db->select($this->table_name . '.email');
        $this->db->select($this->table_name . '.username');
        $this->db->select($this->profile_table_name . '.name');
        $this->db->select($this->profile_table_name . '.middle_name');
        $this->db->select($this->profile_table_name . '.last_name');
        $this->db->select($this->profile_table_name . '.gender');
        $this->db->select($this->profile_table_name . '.dob');
        $this->db->select($this->profile_table_name . '.website');
        $this->db->select($this->profile_table_name . '.phone');
        $this->db->select($this->profile_table_name . '.photo');

        $this->db->join($this->table_name, $this->table_name . '.id = ' . $this->profile_table_name . '.user_id');
        $this->db->where($this->table_name . '.id', $user_id);
        $this->db->from($this->profile_table_name);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
            return $query->row();
        return NULL;
    }

    /**
     * is reset 
     * @param int $user_id 
     * @return bool 
     */
    function is_reset($user_id, $column) {
        $this->db->select('1', FALSE);
        $this->db->where($column, 1);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->profile_table_name);        
        if ($query->num_rows() > 0)
            return TRUE;
        return FALSE;
    }

    /**
     * set reset flag off
     * @param int #user_id
     */
    function set_reset_off($user_id, $column) {
        $this->db->where('user_id', $user_id);
        $this->db->set($column, 0);
        $this->db->update($this->profile_table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * set reset flag off
     * @param int #user_id
     */
    function set_reset($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->set('reset_flag', 1);
        $this->db->update($this->profile_table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * update profile
     * @param int $user_id 
     * @param array $data
     * @return void
     */
    function update_profile($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->update($this->profile_table_name, $data);
        return $this->db->affected_rows() > 0;
    }

    /**
     * update address
     * @param int $user_id,$user_id, $line1, $line2, $state, $district, $pincode, $type
     * @return void
     */
    function update_address($user_id, $data, $type) {
        $this->db->where('user_id', $user_id);
        $this->db->where('type', $type);
        $this->db->update($this->address_table_name, $data);
        return $this->db->affected_rows() > 0;
    }

    /**
     * add educational qualifications
     * @param array $data
     * @return void
     */
    function add_educational_qualification($data) {
        $this->db->insert($this->education_table_name, $data);
        return $this->db->affected_rows() > 0;
    }

    /**
     * get designation details of an employee
     * @param user_id
     */
    function getDesignation($user_id) {
        $this->db->select('MD.designation_name,MO.office_name');
        $this->db->from($this->table_name . ' US');
        $this->db->join($this->table_office . ' MO', 'MO.office_id=US.office_id');
        $this->db->join($this->table_designation . ' MD', 'MD.desig_id=US.designation_id');
        $this->db->where('id',$user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * add job profile
     * @param array $data
     * @return void
     */
    function add_job_profile($data) {
        $this->db->insert($this->jobprofile_table_name, $data);
        return $this->db->affected_rows() > 0;
    }

    /**
     * get educational qualifications of a user
     * @param int $user_id 
     * @return void
     */
    function get_edu_details($user_id) {
        $this->db->select('ED.edu_id,ED.marks_percentage,ED.issuing_authority,MQ.course_name,MS.subject_name');
        $this->db->join('master_qualification MQ', 'ED.qualification=MQ.course_id');
        $this->db->join('master_subjects MS', 'ED.subject=MS.subject_id');
        $this->db->from('user_eduqualification ED');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * change email, but its breakig the rule of validation
     *
     * @param	int
     * @param	string
     * @return	bool
     */
    function change_email($user_id, $email) {
        $this->db->set('email', $email);
        $this->db->where('id', $user_id);
        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * fucntion for getting list of educational qualifications
     * @param qualification level id
     */
    function do_list_qualification($id = null) {
        $this->db->select('course_id, course_name');

        if ($id != NULL) {
            $this->db->where('qualification_level_id', $id);
        }
        $this->db->order_by('course_id', 'asc');
        $query = $this->db->get('master_qualification');

        $courses = array('0' => 'Please Select Qualification');

        if ($query->result()) {
            foreach ($query->result() as $course) {
                $courses[$course->course_id] = $course->course_name;
            }
            return $courses;
        } else {
            return FALSE;
        }
    }

    /**
     * fucntion for getting list of subjects
     * @param subject reference
     */
    function do_list_subjects($id = null) {
        $this->db->select('subject_id, subject_name');

        if ($id != NULL) {
            $this->db->where('subject_reference', $id);
        }
        $this->db->order_by('subject_id', 'asc');
        $query = $this->db->get('master_subjects');

        $courses = array('0' => '');

        if ($query->result()) {
            foreach ($query->result() as $course) {
                $courses[$course->subject_id] = $course->subject_name;
            }
            return $courses;
        } else {
            $courses[0] = 'Not Applicable';
            return $courses;
        }
    }

    /**
     * fucntion for getting list of districts corresponding to a state
     * @param state id 
     */
    function do_list_district($id) {
        $this->db->select('district_code, district_name');

        if ($id != NULL) {
            $this->db->where('state_id', $id);
        }
        $this->db->order_by('district_code', 'asc');
        $query = $this->db->get('master_district');

        $districts = array('0' => '');

        if ($query->result()) {
            foreach ($query->result() as $dst) {
                $districts[$dst->district_code] = $dst->district_name;
            }
            return $districts;
        } else {
            $districts[0] = 'Not Applicable';
            return $districts;
        }
    }

}
