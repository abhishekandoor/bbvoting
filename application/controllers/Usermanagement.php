<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User management controller
 *  
 * @package		Itchool_rbac
 * @author		Renjith P
 * @based on	Tank_Auth 
 */
class Usermanagement extends MY_User {

    /**
     * @var string folder name contain the view files for the current controller
     */
    private $fview = "secured_user/rbac";

    /**
     * @var string table name of rbac_group
     */
    private $table_group = "rbac_group";

    /**
     * @var string table name of master_offices
     */
    private $table_offices      = "master_offices";
    private $table_office_block = 'master_office_block'; //table name for master office blocks

    function __construct() {
        parent::__construct();
        $this->load->library('tank_auth');
        $this->load->library('AdminLib');
        
        // check the user is authenticated to access this group
        $this->itschool_rbac->has_permission(__CLASS__);
        $this->load->model('rbac/rbac_model', 'm_rbac');
        $this->load->model('Schoolmanagement_Model', 'SM');
        $this->load->model('General');
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => 'fixation'
                )
        );
        $this->encryption->initialize(array('driver' => 'mcrypt'));
        $this->template->add_js('assets/secured_user/plugins/datatables/jquery.dataTables.min.js');
        $this->template->add_js('assets/secured_user/plugins/datatables/dataTables.bootstrap.min.js');
        $this->template->add_js('assets/secured_user/js/listuser.js');
        $this->template->add_js('assets/secured_user/js/overlay/loadingoverlay.min.js');
        $this->template->add_js('assets/secured_user/js/new_user.js');
        $this->template->add_js('assets/secured_user/js/select2.js');
    }

    /**
     * index page for usermanagement
     */
    function index() {
        //$this->itschool_rbac->has_permission(__CLASS__,array('admin'));
        $this->usergroups();
    }
 
    /**
     * function for listing usergroups
     * @param type office id 
     */
    function list_usergroup($id) {
        $list = $this->m_rbac->do_list_usergroup($id);
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($list);
    }

    /**
     * page for adding new user
     */
    function new_user() {
       
        //print_r($this->input->post('password'));//die;
        ini_set('pcre.backtrack_limit', 100000);
        $u_usergroup = $this->input->post('usergroup'); //exit;
       // echo "<pre>"; print_r($this->input->post());exit;
        $this->itschool_rbac->has_permission(__CLASS__, array('admin', 'hr_manager'));
        //print_r($_POST);
        $this->load->library('form_validation');
        $this->load->helper('email');//for email validation
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean|alpha_dash|max_length[50]|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|valid_email_custom');

        $this->form_validation->set_rules('office', 'Office ', 'trim|required|xss_clean|greater_than[0]',array(
            'greater_than'      => 'This Field is required',
           
    ));
        $this->form_validation->set_rules('designation', 'Designation ', 'trim|required|xss_clean|greater_than[0]',array(
            'greater_than'      => 'This Field is required',
           
    ));
        $this->form_validation->set_rules('usergroup', 'User group ', 'trim|required|xss_clean|greater_than[0]',array(
            'greater_than'      => 'This Field is required',
           
    ));
    if($this->input->post('office') == SUPER_CHECK_OFFICE){
               $this->form_validation->set_rules('zones', 'Zone', 'trim|required|xss_clean|greater_than[0]',array(
                'greater_than'      => 'This Field is required',
               
        )); 
    }
        
       // $this->form_validation->set_message('Office', 'Please select %s ');//custom message for greater than or equal to zero
      //  $this->form_validation->set_message('Office', 'You must select a %s');
       // $this->form_validation->set_message('greater_than[0]', 'The %s field is mandatory ');
       /*********************************
        * Function alpha space
        * -------------------------------
        * This function is used for validating name fields
        * @param string  : value needed validation
        * @return validation_status
        */
          function alpha_space($str)
             {
   
              return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    
             } 
         /****************************************************************************************************
        * Function  valid email custome
        * --------------------------------------------------------------------------------------------------
        * This function is used for validating email  fields default validation allows hashes and special chars
        * @param string  : value needed validation
        * @return validation_status
        ****************************************************************************************************/
        function valid_email_custom($str)
             {
   
              return ( ! preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $str)) ? FALSE : TRUE;
    
             } 
             function _notMatch( $password,$username){
               //  echo $password." ".$username;exit;
                if($username == $password){
                    //$this->form_validation->set_message('_notMatch', 'Username and password should be different');
                    return FALSE;
                }
                return TRUE;
             
            }
        $this->form_validation->set_message('alpha_space', 'The %s field may only contain alpha characters & White spaces');
       // $this->form_validation->set_message('alpha_space', 'The %s field may only contain alpha characters & White spaces');
      $this->form_validation->set_message('_notMatch', 'Password and Username should be different');
       $this->form_validation->set_message('notMatch', 'Password and Username should be different');
     //  $ci =& get_instance();//for fixing $this is not  in object
        $this->form_validation->set_rules('profile_name', 'Name of the user ', 'trim|required|xss_clean|alpha_space');
        $this->form_validation->set_rules('mobile', 'Mobile Number ', 'trim|required|xss_clean|max_length[10]|min_length[10]|numeric');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
       
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'trim|xss_clean|required|matches[password]');
        
        
        if($this->input->post('office') != 1012){//Not a manager
            $this->form_validation->set_rules('pen', 'PEN', 'trim|required|xss_clean');
            $this->form_validation->set_rules('managing', 'Managing id', 'trim|xss_clean|numeric');
            $_POST['schoolmanagement']=NULL;
        }
        else{//is a manger
            $_POST['designation']=117; //this code will break when management designation id in table changes 
            $this->form_validation->set_rules('schoolmanagement', 'School Management', 'trim|required|xss_clean|greater_than[0]',array(
                'greater_than'      => 'This Field is required',
               
        ));
          //added required validation for school management if the office is school managemnt
        }

//        if ($u_usergroup != '1006' && $u_usergroup != '1006' && $u_usergroup != '104' && $u_usergroup != '105' && $u_usergroup != '109' && $u_usergroup != '107') {
//            $this->form_validation->set_rules('managing', 'Managing id', 'trim|xss_clean|numeric');
//            $managing = $this->form_validation->set_value('managing');
//        } else {
//            $managing = 1;
//        }
        if($this->tank_auth->get_officeId() == DEO_OFFICE && $this->input->post('office') == MANAGER_OFFICE) {
            $_POST['edudistrict'] = $this->session->userdata('edudistrict_id');
        } if($this->tank_auth->get_officeId() == AEO_OFFICE && $this->input->post('office') == MANAGER_OFFICE) {
            $_POST['subdistrict'] = $this->session->userdata('subdistrict_id');
        }
        $managing = 1;
        if ($this->form_validation->run()) {
            $existingUsers = $this->tank_auth->rbac_check_active_users($this->form_validation->set_value('office'), $this->form_validation->set_value('office_block'), $this->input->post('usergroup'), $this->input->post('district'), $this->input->post('edudistrict'), $this->input->post('subdistrict'),$this->input->post('zones'));
            if ($existingUsers > 0) {
                $data['sectionExist'] = 1;
            } else {
                $data['sectionExist'] = 0;
                if ($this->tank_auth->rbac_create_user(
                                $this->form_validation->set_value('username'), $this->form_validation->set_value('email'), $this->input->post('password') ? $this->input->post('password') : $this->form_validation->set_value('username'), FALSE, $this->input->post('usergroup'), $this->form_validation->set_value('managing'), $this->form_validation->set_value('office'), $this->form_validation->set_value('designation'), $this->input->post('district'), $this->input->post('edudistrict'), $this->input->post('subdistrict'), $this->input->post('school'), $this->input->post('schoolmanagement'), $this->input->post('profile_name'), $this->input->post('mobile'), $this->form_validation->set_value('pen'), $this->input->post('office_block'),$this->input->post('zones')
                        )) {
                    $this->session->set_flashdata('flashSuccess', 'New User Created.');
                    redirect($this->uri->uri_string());
                } else {
                    $errorResults = 'Error(s) : ';
                    foreach ($this->tank_auth->error as $err) {
                        $errorResults .= $err;
                    }
                    $this->session->set_flashdata('flashError', $errorResults);
                    redirect($this->uri->uri_string());
                }
            }
        }

        $data['designation'] = $this->General->prepare_select_box_data('master_designation', 'desig_id,designation_name');
        if ($this->tank_auth->get_officeId() <= 1001){ //list all offices when DPI or ITAdmin login
            $data['offices'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', '', '', 'office_id');
            $data['office_blocks'] = array(); //$this->General->prepare_select_box_data('master_office_block', 'office_block_id,block_name', '', '', 'office_block_id');
            $data['district'] = array('0' => '');
            $data['subdistrict'] = array('0' => '');
            $data['edudistrict'] = array('0' => '');
            $data['school'] = array('0' => '');
        }else if ($this->tank_auth->get_officeId() == 1013){ //list all offices when DPI or ITAdmin login
            $where_office    = array($this->adminlib->get_pa_office_id(),
                        $this->adminlib->get_dde_office_id(),
                        $this->adminlib->get_js_office_id()
                    );
            
            $this->db->select('office_id, office_name', FALSE);
            $this->db->where_in('office_id',$where_office);
            $query = $this->db->get($this->table_offices);
            $temp_res = $query->result_array();
            $offices = array(0=>'Please Select');
            foreach ($temp_res as $val) {
                $offices[$val['office_id']] = $val['office_name'];
            }
            $data['offices'] = $offices;
            $data['district'] = array('0' => '');
            $data['subdistrict'] = array('0' => '');
            $data['edudistrict'] = array('0' => '');
            $data['school'] = array('0' => '');
        }else{
            $data['offices'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', array('office_id' => $this->tank_auth->get_officeId()), '', 'office_id');
            $data['district'] = array('0' => '');
            $data['edudistrict'] = $this->General->prepare_select_box_data('edu_district_master', 'edu_district_code,edu_district_name', array('edu_district_code' => $this->session->userdata('edudistrict_id')), '', 'edu_district_code');
            $data['subdistrict'] = $this->General->prepare_select_box_data('sub_districts_Master', 'id,sub_district_name', array('id' => $this->session->userdata('subdistrict_id')), '', 'id');
            $data['school'] = array('0' => '');
        }
        if ($this->tank_auth->get_officeId() <= DGE_OFFICE)
        { //list all offices when DPI or ITAdmin login
            @$data['schoolmanagement'] = $this->General->prepare_select_box_data_management('AASF_Management', 'id,mngmnt_name', '', '', 'id');
        }
        else if ($this->tank_auth->get_officeId() == DEO_OFFICE) //list all managements based on edu district on DEO login
        {
            $data['schoolmanagement'] = $this->General->prepare_select_box_data_management('AASF_Management', 'id,mngmnt_name', array('edu_district_code' => $this->session->userdata('edudistrict_id')), '', 'id');
        }
        else if($this->tank_auth->get_officeId() == AEO_OFFICE)
        {
            $data['schoolmanagement'] = $this->General->prepare_select_box_data_management('AASF_Management', 'id,mngmnt_name', array('edu_district_code' => $this->session->userdata('subdistrict_id')), '', 'id');
        }
        else if($this->tank_auth->get_officeId() == DDE_OFFICE || $this->tank_auth->get_officeId() == ADMIN_OFFICE)
        {
            $this->db->select('AM.id, AM.mngmnt_name', FALSE);
            $this->db->join("master_edudistricts as me","me.id = AM.edu_district_code");
            $this->db->where('me.revenue_district_id',$this->session->userdata('district_id'));
            $query = $this->db->get('AASF_Management as AM');
            $temp_res = $query->result_array();
            $schoolmanagement = array(0=>'Please Select');
            foreach ($temp_res as $val) {
                $schoolmanagement[$val['id']] = $val['mngmnt_name'];
            }
            $data['schoolmanagement'] = $schoolmanagement;
           
        }

        /* Bread crum */
        $this->breadcrumbcomponent->add('Create New User', base_url() . 'index.php/usermanagement/new_user');
        $breadcrumb['breadcrumb'] = $this->breadcrumbcomponent->output();
        $breadcrumb['title'] = 'Create New User';
        $this->template->write_view('content', "/breadcrumb", $breadcrumb);
        /* End Bread crum */
//print("<pre>");
//print_r($data);
//exit;
        $this->template->write_view('content', $this->fview . "/new_user", $data);
        $this->template->render();
    }

    /**
     * page for creating multiple users in a single click
     */
    function bulk_user() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $num_usr = $this->input->post('num_user');
        $this->load->library('form_validation');
        $data['errors'] = array();
        for ($i = 1; $i <= $num_usr; $i++) {
            $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
            $this->form_validation->set_rules('username' . $i, 'User Name' . $i, 'trim|required|xss_clean|alpha_dash');
            $this->form_validation->set_rules('email' . $i, 'Email' . $i, 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('managing' . $i, 'Managing id' . $i, 'trim|required|xss_clean|numeric');

            if ($this->form_validation->run()) {
                if ($this->tank_auth->rbac_create_user(
                                $this->form_validation->set_value('username' . $i), $this->form_validation->set_value('email' . $i), $this->input->post('password' . $i) ? $this->input->post('password' . $i) : $this->form_validation->set_value('username' . $i), FALSE, $this->input->post('usergroup'), $this->form_validation->set_value('managing' . $i)
                        )) {
                    $this->session->set_flashdata('flashSuccess', $i . 'Users Created.');
                    if ($i == $num_usr)
                        redirect($this->uri->uri_string());
                }
            }
        }
        $this->template->add_js('assets/secured_user/js/rbac.js');
        $data['usergroups'] = $this->m_rbac->get_usergroups();
        $this->template->write_view('content', $this->fview . "/bulk_user_creation", $data);
        $this->template->render();
    }

    /**
     * list for dropdown scopes
     * @return list of qualifications
     */
    function list_scope($id = NULL) {
        $list = $this->m_rbac->do_list_scope($id);
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($list);
    }

    /**
     * list for dropdown scopes
     * @return list of qualifications
     */
    function list_parent($id) {
        $list = $this->m_rbac->do_list_parent($id);
        header('Content-Type: application/x-json; charset=utf-8');
        echo json_encode($list);
    }

    /**
     * page for adding new usergroup
     */
    function new_usergroup() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin', 'hr_manager'));
        $this->load->library('form_validation');
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $this->form_validation->set_rules('usergroup_name', 'User group name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('office', 'Office', 'trim|required|xss_clean|greater_than[0]');
        $this->form_validation->set_rules('scope', 'Scope', 'trim|required|xss_clean|greater_than[0]');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $permissions = array();
            if (is_array($groups = $this->input->post('selected_tasgroups_h'))) {
                foreach ($groups as $group) {
                    $permissions[$group] = array();
                    if (is_array($roles = $this->input->post('srole_' . $group))) {
                        foreach ($roles as $role) {
                            $permissions[$group][] = $role;
                        }
                    }
                }
                $permissions = json_encode($permissions);
                if ($this->itschool_rbac->create_usergroup(
                                $this->form_validation->set_value('usergroup_name'), $this->form_validation->set_value('office'), $this->form_validation->set_value('scope'), $this->form_validation->set_value('priority'), $permissions, $this->input->post('user_parent'), $this->input->post('description')
                        )) {
                    $this->session->set_flashdata('flashSuccess', 'New User Group Created.');
                    redirect($this->uri->uri_string());
                }
            } else {
                $data['errors']['selected_taskgroups'] = 'Please Assign Task Groups';
            }

            $errors = $this->itschool_rbac->get_error_message();
            foreach ($errors as $k => $v) {
                $data['errors'][$k] = $v;
            }
        }
        $this->template->add_js('assets/secured_user/js/overlay/loadingoverlay.min.js');
        $this->template->add_js('assets/secured_user/js/rbac.js');
        if ($this->tank_auth->get_officeId() <= 1001) //list all offices when DPI or ITAdmin login
            $data['office'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', '', '', 'office_id');
        else
            $data['office'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', array('office_id' => $this->tank_auth->get_officeId()), '', 'office_id');

        $data['taskgroups'] = $this->m_rbac->get_taskgroups();
        $data['roles'] = $this->m_rbac->get_roles();
        $data['priority'] = $this->General->get_max_id($this->table_group, 'priority') + 1;

        $this->template->write_view('content', $this->fview . "/new_usergroup", $data);
        $this->template->render();
    }

    /**
     * page for adding a taskgroup to database
     */
    function new_taskgroup() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->library('form_validation');
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');

        $this->form_validation->set_rules('taskgroup', 'Task Group', 'trim|required|xss_clean|alpha_dash');

        $data['errors'] = array();

        if ($this->form_validation->run()) {
            if ($data = $this->itschool_rbac->create_taskgroup($this->form_validation->set_value('taskgroup'))) {
                $this->session->set_flashdata('flashSuccess', 'New Task Group Created.');
                redirect($this->uri->uri_string());
            }
        }
        $errors = $this->itschool_rbac->get_error_message();
        foreach ($errors as $k => $v) {
            $data['errors'][$k] = $v;
        }

        $this->template->write_view('content', $this->fview . "/new_taskgroup", $data);
        $this->template->render();
    }

    /**
     * page for adding role
     */
    function new_role() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->library('form_validation');
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');

        $this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean|alpha_dash');

        $data['errors'] = array();

        if ($this->form_validation->run()) {
            if ($this->itschool_rbac->create_role($this->form_validation->set_value('role'))) {
                $this->session->set_flashdata('flashSuccess', 'New Role Created.');
                redirect($this->uri->uri_string());
            }
        }
        $errors = $this->itschool_rbac->get_error_message();
        foreach ($errors as $k => $v) {
            $data['errors'][$k] = $v;
        }
        $this->template->write_view('content', $this->fview . "/new_role", $data);
        $this->template->render();
    }

    /**
     * page for adding scope
     */
    function new_scope() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->library('form_validation');
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $this->form_validation->set_rules('scope', 'Scope', 'trim|required|xss_clean|alpha_dash');

        $data['errors'] = array();

        if ($this->form_validation->run()) {
            if ($this->itschool_rbac->create_scope($this->form_validation->set_value('scope'))) {
                $this->session->set_flashdata('flashSuccess', 'Scope Added Successfully.');
                redirect($this->uri->uri_string());
            }
        }
        $errors = $this->itschool_rbac->get_error_message();
        foreach ($errors as $k => $v) {
            $data['errors'][$k] = $v;
        }

        $data['office'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', '', '', 'office_id');
        $this->template->write_view('content', "secured_user/rbac/new_scope", $data);
        $this->template->render();
    }

    /**
     * bulk user creation
     */
    function create_default_users() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->template->write_view('content', $this->fview . "/create_default_users");
        $this->template->render();
    }

    /**
     * creating login credentials for all schools
     */
    function __create_school_login() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->model('school/school_model', 'm_school');
        $schools = $this->m_school->get_schools();
        foreach ($schools as $school) {

            $this->tank_auth->rbac_create_user(
                    $school->school_code, $school->school_code, $school->school_code, FALSE, 3, $school->id
            );
        }
    }

    /**
     * Reset password by username
     */
    function reset_password($reset_username = FALSE) {
       // echo ;die;
      // echo($this->session->userdata('user_type'));die;
        
        $data = array();
        //$officeid=$this->LA->getUsersOffice($reset_username);
        if($this->session->userdata('user_type')=="ITADMIN" || hasDEOPermission() || hasAEOPermission() || hasDDEPermission() || hasDGEPermission() || hasJDPermission() || is_DNO() || hasADGEPermission() || hasADGEAcademicPermission() || hasUnitOfficerPermission()){ // $this->session->userdata('user_type')=="AEO"||$this->session->userdata('user_type')=="DEO")
        //{//AEO ,DEO ITADMIN Can change password
        if ($reset_username) {
            $data['reset_username'] = $reset_username;
        }
        $reset_user_id = $this->General->getrow('users', 'id', array('username' => $reset_username))->id; 
        $current_user_id = $this->session->userdata('user_id');
        $user_dtls = $this->m_rbac->getUsersByPen($current_user_id,1);
        $office_name = $this->adminlib->get_office_name($user_dtls->office_id, $user_dtls->office,$user_dtls->office_block_id);
        $this->itschool_rbac->has_permission(__CLASS__, array('edit')); 
        $this->load->library('form_validation');
       
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean|min_length[' . $this->config->item('username_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('username_max_length', 'tank_auth') . ']');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if($this->session->userdata('user_type')=="ITADMIN" || is_DNO()){
            if ($this->form_validation->run()) {
     
                if ($this->itschool_rbac->reset_password_by_username(
                                $this->form_validation->set_value('username'), $this->input->post('password') ? $this->input->post('password') : $this->form_validation->set_value('username')
                        )) {
                    //force password reset
                    if(isForcePwdChangeEnabledOnResetPwd())
                        $this->LA->setInitLoginStatus($reset_username);
                    $this->session->set_flashdata('flashSuccess', 'Successfully done.The password reset notification has been sent to the corresponding user via email.');
                    if($reset_user_id == $current_user_id){
                        $notifcation_msg = 'You have changed your password.';
                        write_notification($current_user_id, $reset_user_id, 13);
                    }
                    else{
                        if($this->session->userdata('user_type')=="ITADMIN"){
                            $notifcation_msg = 'The Administrator has changed your password.';
                            write_notification($current_user_id, $reset_user_id, 14,'The Administrator');
                        }else{
                            $notifcation_msg = $user_dtls->name . "(" . @$user_dtls->designation_name . "," . @$office_name . ') has changed your password';
                            write_notification($current_user_id, $reset_user_id, 14,$user_dtls->name . "(" . @$user_dtls->designation_name . "," . @$user_dtls->usergroup . ")");
                        }
                    }  
                    $this->sendResetPasswordAlert($notifcation_msg,$reset_user_id);
                    redirect($this->uri->uri_string());
                }
            }
            else{
                $this->session->set_flashdata('error', 'Password Field is mandatory .It must have atleast 8 character length');
            }
        }
        else{
            //splitted for adding restriction of same office for all users other than ITADMIN
            
            $officeid=$this->LA->getUsersOffice($reset_username);
            // for checking thee user office
            // print_r($officeid);exit;
            if($officeid['eduDist']==$this->session->userdata('edudistrict_id')||$officeid['subDist']==$this->session->userdata('subdistrict_id')||$officeid['office']==1012 || ($officeid['office']==DGE_OFFICE &&  $officeid['dist']==$this->session->userdata('district_id') ) )
           {//if user is from same office
            if ($this->form_validation->run()) {
     
                if ($this->itschool_rbac->reset_password_by_username(
                                $this->form_validation->set_value('username'), $this->input->post('password') ? $this->input->post('password') : $this->form_validation->set_value('username')
                        )) {
                        //force password reset
                        if(isForcePwdChangeEnabledOnResetPwd())
                            $this->LA->setInitLoginStatus($reset_username);
                    if($reset_user_id == $current_user_id){
                        $notifcation_msg = 'You have changed your password.';
                        write_notification($current_user_id, $reset_user_id, 13);
                    }
                    else{
                        $notifcation_msg = $user_dtls->name . "(" . @$user_dtls->designation_name . "," . @$office_name . ') has changed your password';
                        write_notification($current_user_id, $reset_user_id, 14,$user_dtls->name . "(" . @$user_dtls->designation_name . "," . @$user_dtls->usergroup . ") ");
                    }   
                    $this->sendResetPasswordAlert($notifcation_msg,$reset_user_id);
                    $this->session->set_flashdata('flashSuccess', 'Successfully done.The password reset notification has been sent to the corresponding user via email.');
                    redirect($this->uri->uri_string());
                }
                else
                {
                    $this->session->set_flashdata('error', 'Sorry , You can change password of staff from your office only.');
                   
                }
            }
            else{
                $this->session->set_flashdata('error', 'Password Field is mandatory .It must have atleast 8 character length');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Sorry , You can change password of staff from your office only.');
           
        }

        }
        
        }
        else
        {
           $this->session->set_flashdata('error', 'Sorry , You are not supposed to change password of this user.');
               

        }
         /* Bread crum */
        $this->breadcrumbcomponent->add('User List', base_url() . 'index.php/usermanagement/userList');
        $this->breadcrumbcomponent->add('Reset Password', base_url() . 'index.php/usermanagement/userList');
        $breadcrumb['breadcrumb'] = $this->breadcrumbcomponent->output();
        $breadcrumb['title'] = 'Reset Password';
        $this->template->write_view('content', "/breadcrumb", $breadcrumb);
        /* End Bread crum */
        
        $this->template->write_view('content', $this->fview . "/reset_password", $data);
        $this->template->render();
    }

    function sendResetPasswordAlert($msg,$reset_user_id){
        $data = array();
        // $proxy="";
        $data = getDeviceDetails();
        // $data['ip'] = $ip;
        // $data['OS'] = $OS;
        // $data['browser'] = $browser;
        // $data['date']   = date("d/m/Y h:i A");

        $data['notification_msg'] = $msg;
        $email = get_email($reset_user_id);
        $this->CM->sendMail($email,'Account Security Alert',
        $this->load->view('email/reset_password_success',$data,TRUE));
        return;
    }

    /**
     * view & manage all usergroups
     */
    function usergroups() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));

        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $this->form_validation->set_rules('office', 'Office', 'trim|required|xss_clean|greater_than[0]');
        if ($this->form_validation->run()) {
            if (is_null($data['usergroups'] = $this->m_rbac->get_usergroups($usergroup_id = FALSE, $this->form_validation->set_value('office')))) {
                $data['usergroups'] = array();
                $this->template->write('content', '<br />' . error_message('There is no usergroups available to manage'));
            }
            foreach ($this->itschool_rbac->groups as $k => $v) {
                $data['groups_config'][$v] = $k;
            }
            foreach ($this->itschool_rbac->roles as $k => $v) {
                $data['roles_config'][$v] = $k;
            }
        }
        $data['offices'] = $this->General->prepare_select_box_data($this->table_offices, 'office_id,office_name', '', 'office_id');
        $this->template->write_view('content', $this->fview . "/usergroups", $data);
        $this->template->render();
    }

    /**
     * edit selected usergroup
     * @param int $id
     */
    function edit_usergroup($id = 0) {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));

        if (is_null($data['usergroups'] = $this->m_rbac->get_usergroups($id))) {
            show_404(__FILE__, FALSE);
        }
        $this->load->library('form_validation');
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $this->form_validation->set_rules('usergroup_name', 'User group name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|xss_clean|numeric');
        if ($this->form_validation->run()) {
            $permissions = array();
            if (is_array($groups = $this->input->post('selected_tasgroups_h'))) {
                foreach ($groups as $group) {
                    $permissions[$group] = array();
                    if (is_array($roles = $this->input->post('srole_' . $group))) {
                        foreach ($roles as $role) {
                            $permissions[$group][] = $role;
                        }
                    }
                }
                $permissions = json_encode($permissions);
                if ($this->itschool_rbac->update_usergroup(
                                $id, $this->form_validation->set_value('usergroup_name'), $permissions, $this->input->post('user_scope'), $this->form_validation->set_value('priority'), $this->input->post('user_parent'), $this->input->post('description')
                        )) {
                    $this->session->set_flashdata('flashSuccess', 'User Group Updated.');
                    redirect($this->uri->uri_string());
                }
            } else {
                $data['errors']['selected_taskgroups'] = 'Please Assign Task Groups';
            }

            $errors = $this->itschool_rbac->get_error_message();
            foreach ($errors as $k => $v) {
                $data['errors'][$k] = $v;
            }
        }
        $data['taskgroups'] = $this->m_rbac->get_taskgroups();
        $data['roles'] = $this->m_rbac->get_roles();
        $data['scopes'] = $this->m_rbac->get_scopes();
        $data['parent'] = $this->General->prepare_select_box_data($this->table_group, 'id,usergroup');
        foreach ($this->itschool_rbac->groups as $k => $v) {
            $data['groups_config'][$v] = $k;
        }
        foreach ($this->itschool_rbac->roles as $k => $v) {
            $data['roles_config'][$v] = $k;
        }

        //$this->template->write_view('content', $this->fview . "/usergroups", $data);
        $data['permissions'] = json_decode($data['usergroups'][0]->item_ids);
        $this->template->add_js('assets/secured_user/js/rbac.js');
        $this->template->write_view('content', $this->fview . "/edit_usergroup", $data);
        $this->template->render();
    }

    /**
     * view the content to be used in application/config/itschool_rbac.php
     */
    function configuration() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $data['roles'] = $this->m_rbac->get_roles();
        $data['taskgroups'] = $this->m_rbac->get_taskgroups();
        $path = "./application/controllers";
        $data['file_names'] = $this->itschool_rbac->scanFileNameRecursivly($path);
        $this->template->write_view('content', $this->fview . "/configuration", $data);
        $this->template->render();
    }

    /**
     * view members of provided usergroup
     * @param int $group_id
     */
    function members($group_id = FALSE) {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->model('rbac/rbac_users');
        $data['usergroups'] = $this->m_rbac->get_usergroups($group_id, $office_id = FALSE);
        if (!$group_id && is_null($data['usergroups'])) {
            show_404(__FILE__, FALSE);
        }
        if (is_null($data['users'] = $this->rbac_users->get_users_by_group($group_id))) {
            $this->session->set_flashdata('flashInfo', 'No Users In Requested Group.');
            redirect('usermanagement/usergroups');
        }
        $this->template->write_view('content', 'secured_user/rbac/members', $data);
        $this->template->render();
    }

    /**
     * remove user
     * @param type $group_id
     * @param type $user_id
     */
    function remove_user($group_id = FALSE, $user_id = FALSE) {
        if (!$group_id && !$user_id) {
            show_404(__FILE__, FALSE);
        }
        $this->load->model('tank_auth/users');
        if ($this->users->delete_user($user_id)) {
            set_message('Removed User Successfully..', 'alert-info');
            redirect("usermanagement/members/$group_id");
        }
    }

    /**
     * BAN user
     * @param type $group_id
     * @param type $user_id
     */
    function ban_user($user_id = FALSE, $status) {
        //echo "@First ".$user_id." -- ".$status;//exit;
        if (!$user_id) {
            show_404(__FILE__, FALSE);
        }
        $this->load->model('tank_auth/users');
        if ($status == 'De-Active') {
            $activated = 1;
            $banned = 0;
            $status = " Activated ";
            $baned_by = '';
            $invalid=0;
            $userDetails = get_current_user_data($user_id);
            if($userDetails['designation_id'] == 123){
                $existingUsers = 0;
            }else{
                $existingUsers = $this->tank_auth->rbac_check_active_users($userDetails['master_office_id'], $userDetails['office_block_id'], $userDetails['usergroup_id'], $userDetails['district_id'], $userDetails['edudistrict_id'], $userDetails['subdistrict_id'],$userDetails['zone_id']);
            }
            if ($existingUsers > 0) {
                $this->session->set_flashdata('flashError', 'There is an active user in this section with same privilege . Please transfer or deactivate the existing user and then try again !');
            } else {
               //echo $user_id." -- ".$activated." -- ".$banned." -- ".$baned_by;//exit;
                if ($this->users->ban_user($user_id, $activated, $banned, $baned_by,$invalid)) {
                    $this->session->set_flashdata('flashSuccess', 'User ' . $status . ' sucessfully.');
                }
            }
        } else if ($status == 'Active') {
            $activated = 0;
            $banned = 1;
            $status = " De-Activated ";
            $baned_by = "De-Activated by " . $this->session->userdata('user_id');
            $invalid=1;
            //echo $user_id." -- ".$activated." -- ".$banned." -- ".$baned_by;//exit;
            if ($this->users->ban_user($user_id, $activated, $banned, $baned_by,$invalid)) {
                $this->session->set_flashdata('flashSuccess', 'User ' . $status . ' sucessfully.');
            }
        }
        
        // $this->userList();
        redirect('usermanagement/userList');
    }

    /**
     * defining the roles description in provided taskgroup
     * @param type $group_id
     */
    function define_roles($taskgroup_id = FALSE) {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->model('rbac/rbac_description', 'm_description');
        if (!$taskgroup_id) {
            show_404(__FILE__, FALSE);
        }
        if (is_null($data['taskgroup'] = $this->m_rbac->get_taskgroups($taskgroup_id))) {
            show_404(__FILE__, FALSE);
        }
        $data['roles'] = $this->m_rbac->get_roles();

        //if button pressed
        if ($this->input->post('update_description')) {
            foreach ($data['roles'] as $role) {
                $description = $this->input->post($role->item . $role->id);
                if ($description != '') {
                    if (!$this->m_description->is_description_available($taskgroup_id, $role->id)) {
                        $this->m_description->update_description($taskgroup_id, $role->id, htmlspecialchars($description));
                    } else {
                        $this->m_description->insert_description($taskgroup_id, $role->id, htmlspecialchars($description));
                    }
                }
            }

            $this->session->set_flashdata('flashSuccess', 'Description Updated.');
            redirect($this->uri->uri_string());
        }
        $this->template->write_view('content', $this->fview . "/define_role", $data);
        $this->template->render();
    }

    /**
     * listing taskgroups
     */
    function taskgroups() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->model('rbac/rbac_description', 'm_description');
        $data['roles'] = $this->m_rbac->get_roles();
        $data['taskgroups'] = $this->m_rbac->get_taskgroups();
        $this->template->write_view('content', $this->fview . "/taskgroups", $data);
        $this->template->render();
    }

    /**
     * listing users
     */
    function userList() {
//        $this->output->enable_profiler(TRUE);
        ini_set('max_execution_time', 0);
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $logedinUser = $this->session->userdata('user_id');
        //
        $data['sel_tab'] = 1;
        if($this->input->get('tab'))
            $data['sel_tab'] = $this->input->get('tab');
        //
        if ($this->session->userdata('office_id') == DDE_OFFICE) {
            $searchFiled = 'district_id';
            $searchId = $this->session->userdata('district_id');
            $data['userlist'] = $this->m_rbac->get_userlistdde($searchFiled, $searchId);
            $data['user_transfered'] = $this->m_rbac->get_userlist_transfered($searchFiled, $searchId);
            $data['userlistnew'] = $this->m_rbac->get_userlist_new($searchFiled, $searchId);
        } elseif ($this->session->userdata('office_id') == DEO_OFFICE) {
            $searchFiled = 'edudistrict_id';
            $searchId = $this->session->userdata('edudistrict_id');
            $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
            // $data['mgr_userlist'] = $this->m_rbac->get_manager_userlist($searchFiled, $searchId);
            $data['managementsList'] = $this->SM->get_school_management($searchId);
            //
            $data['user_transfered'] = $this->m_rbac->get_userlist_transfered($searchFiled, $searchId);
            $data['userlistnew'] = $this->m_rbac->get_userlist_new($searchFiled, $searchId);
        } elseif ($this->session->userdata('office_id') == AEO_OFFICE) {
            $searchFiled = 'subdistrict_id';
            $searchId = $this->session->userdata('subdistrict_id');
            $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
            // $data['mgr_userlist'] = $this->m_rbac->get_manager_userlist($searchFiled, $searchId);
            $data['managementsList'] = $this->SM->get_school_management($searchId);
            //
            $data['user_transfered'] = $this->m_rbac->get_userlist_transfered($searchFiled, $searchId);
            $data['userlistnew'] = $this->m_rbac->get_userlist_new($searchFiled, $searchId);
        } elseif ($this->session->userdata('office_id') == DGE_OFFICE || 
                  $this->session->userdata('office_id') == SUPER_CHECK_OFFICE) {
            $searchFiled = 'office_id';
            $searchId = $this->session->userdata('office_id');
            $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
            $data['user_transfered'] = $this->m_rbac->get_userlist_transfered($searchFiled, $searchId);
            $data['userlistnew'] = $this->m_rbac->get_userlist_new($searchFiled, $searchId);
        } elseif ($this->session->userdata('office_id') <= DGE_OFFICE) {
            //below lines commented to reduce server load for IT Admin Login
            // $data['userlist'] = $this->m_rbac->get_userlist(0, 0);
            // $data['user_transfered'] = $this->m_rbac->get_userlist_transfered(0, 0);
            // $data['userlistnew'] = $this->m_rbac->get_userlist_new(0, 0);
            
            $data['userlist'] = array();
            $data['user_transfered'] = array();
            $data['userlistnew'] = array();
            $data['state_offices'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', array('has_usermanagement'=>1),false, 'office_id');
            $data['district']=  $this->General->prepare_select_box_data('master_district', 'district_code,district_name', '',false, 'district_code');
                     
            $data['subdistrict']=  $this->General->prepare_select_box_data('master_subdistricts', 'id,sub_district_name', '', 'id');
            $data['edudistrict']=  $this->General->prepare_select_box_data('master_edudistricts', 'id,edu_district_name', '', 'id');

        } else if($this->session->userdata('office_id') == ADMIN_OFFICE) {
             $searchFiled = 'district_id';
            $searchId = $this->session->userdata('district_id');
            $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
            // $data['mgr_userlist'] = $this->m_rbac->get_manager_userlist($searchFiled, $searchId);
            $data['user_transfered'] = $this->m_rbac->get_userlist_transfered($searchFiled, $searchId);
            $data['userlistnew'] = $this->m_rbac->get_userlist_new($searchFiled, $searchId);
            // $data['district']=  $this->General->prepare_select_box_data('master_district', 'district_code,district_name', '',false, 'district_code');
                      
            $data['subdistrict']=  $this->General->prepare_select_box_data('master_subdistricts', 'id,sub_district_name',array('revenue_district_id'=>$searchId), 'id');
            $data['edudistrict']=  $this->General->prepare_select_box_data('master_edudistricts', 'id,edu_district_name', array('revenue_district_id'=>$searchId), 'id');
        }
        else {
            $data['userlist'] = $this->m_rbac->get_userlist('created_by', $logedinUser);
        }
//print("<pre>");
//print_r($data);
//exit;
        /* Bread crum */
        $this->breadcrumbcomponent->add('User List', base_url() . 'index.php/usermanagement/userList');
        $breadcrumb['breadcrumb'] = $this->breadcrumbcomponent->output();
        $breadcrumb['title'] = 'User List';
        $this->template->write_view('content', "/breadcrumb", $breadcrumb);
        /* End Bread crum */

        $this->template->write_view('content', $this->fview . "/userlist", $data);
        $this->template->render();
    }

    function usertransfer($userId) {
        $data = array();

        $sessionUser = $this->session->userdata('user_id');
        $data['sessionUser'] = $sessionUser;
        $checkPrevilagetotransfer = $this->m_rbac->checkPrevilagetotransfer($sessionUser, $userId);
        $data['checkPrevilagetotransfer'] = $checkPrevilagetotransfer;
        $data['offices'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', '', '', 'office_id');
        $data['office_blocks'] = $this->General->prepare_select_box_data('master_office_block', 'office_block_id,block_name');
        $data['district'] = $this->General->dolistDropdown('master_district', 'district_code,district_name', '', 'district_code');


        if ($this->input->post()) {
            $post = $this->input->post();
            $data['post'] = $post;
            $saveTransfer = $this->m_rbac->transferUser($post, $checkPrevilagetotransfer['id'], $sessionUser);
            $this->session->set_flashdata('success', 'User Transfered Successfully');
        
            $this->userList();
        } else {
            /* Bread crum */
            $this->breadcrumbcomponent->add('User List', base_url() . 'index.php/usermanagement/userList');
            $this->breadcrumbcomponent->add('User Transfer', base_url() . 'index.php/usermanagement/usertransfer');
            $breadcrumb['breadcrumb'] = $this->breadcrumbcomponent->output();
            $breadcrumb['title'] = 'User Transfer';
            $this->template->write_view('content', "/breadcrumb", $breadcrumb);
            /* End Bread crum */
            $this->template->write_view('content', $this->fview . "/usertransfer", $data);
            $this->template->render();
        }
    }

    function transfer_the_user($Id, $Type) {
//        print("<pre>");
//        print_r($_POST);
//        exit;
        $data = array();
        $data['userdetails'] = @$this->m_rbac->getUserdetailsoftransfered($Id)[0];
        if ($Type == 2) {//Rejecting the new user request and roll back to previous office
            $rollback = $this->m_rbac->rollbackUser($data['userdetails']['id']);           
            $this->session->set_flashdata('flashSuccess', 'Success !! <br>The user rollbacked successfully!');

            redirect('usermanagement/userList');
            //$this->userList();
        } else {
            if ($this->input->post()) {
                if ($Type == 1) {//Accepting the new user request to current office
                    if($this->session->userdata('office_id')!=1000 && $this->session->userdata('office_id')!=1013){
                         $existingUsers = $this->tank_auth->rbac_check_active_users($this->input->post('office'), $this->input->post('office_block'), $this->input->post('usergroup'), $this->session->userdata('district_id'), $this->session->userdata('edudistrict_id'), $this->session->userdata('subdistrict_id'));
                    }
                    else {                            
                         $dataOfTransfer=$this->m_rbac->getTransferedDetails($data['userdetails']['user_id']);
                        //  echo "<pre>"; print_r($dataOfTransfer);die;
                        //  print_r($this->input->post());exit;
                         $existingUsers=$this->tank_auth->rbac_check_active_users($dataOfTransfer[0]['dest_office_id'],$dataOfTransfer[0]['dest_office_block_id'], $this->input->post('usergroup'), $dataOfTransfer[0]['dest_district_id'], $dataOfTransfer[0]['dest_edudistrict_id'], $dataOfTransfer[0]['dest_subdistrict_id']);
                        // echo $existingUsers;exit;
                        //$transferData=array();
                        
                        $transferData=array('office'=>$dataOfTransfer[0]['dest_office_id'],'edudistrict'=>$dataOfTransfer[0]['dest_edudistrict_id'],'transfereduserid'=>$dataOfTransfer[0]['user_id'],'usergroup'=>$this->input->post('usergroup'),'designation'=>$this->input->post('designation'),'district_id'=>$dataOfTransfer[0]['dest_district_id'],'edudistrict_id'=>$dataOfTransfer[0]['dest_edudistrict_id'],'subdistrict_id'=>$dataOfTransfer[0]['dest_subdistrict_id'],'managing'=>$dataOfTransfer[0]['managing_id'], 'office_block'=>$dataOfTransfer[0]['office_block_id']);
                  //  print_r($transferData);exit;
                        }
                  
                   if ($existingUsers > 0) {
                        $data['sectionExist'] = 1;
                        $this->session->set_flashdata('flashError', 'Error !! <br>There is an active user in this section with same privilege . Please transfer or deactivate the existing user and then try again !');
                        redirect('usermanagement/userList');
                        //$this->userList();
                    } else {
                        $data['sectionExist'] = 0;
                        if($this->session->userdata('office_id')!=1000)
                           $save = $this->m_rbac->saveTransferedUser($this->input->post());
                        else
                           $save = $this->m_rbac->saveTransferedUser($transferData);
                        $this->session->set_flashdata('success', 'User Transfered successfully');
                        redirect('usermanagement/userList');
                        //$this->userList();
                    }
                }
            }

    //    print_r($this->session->userdata());
    //exit;
    if($this->session->userdata('office_id')!=1000 && $this->session->userdata('office_id') !=1013)
    {
            $data['usergroup'] = $this->General->prepare_select_box_data('rbac_group', 'id,usergroup', array('office_id' => $this->session->userdata('office_id')), false, 'id');
            $data['designation'] = $this->General->prepare_select_box_data('master_designation', 'desig_id,designation_name');
    }
    else
     {    $data['usergroup'] = $this->General->prepare_select_box_data('rbac_group', 'id,usergroup','', false, 'id');
          $data['designation'] = $this->General->prepare_select_box_data('master_designation', 'desig_id,designation_name');
          $data['office_blocks'] = $this->General->prepare_select_box_data('master_office_block', 'office_block_id,block_name');
          $data['trans_office_id'] = $this->General->getrow("AASF_User_Transfer","dest_office_id",array("id"=>$Id))->dest_office_id;
          $data['trans_edudistrict_id'] = $this->General->getrow("AASF_User_Transfer","dest_edudistrict_id",array("id"=>$Id))->dest_edudistrict_id;
          $data['trans_subdistrict_id'] = $this->General->getrow("AASF_User_Transfer","dest_subdistrict_id",array("id"=>$Id))->dest_subdistrict_id;
          
     }
            /* Bread crum */
            $this->breadcrumbcomponent->add('User List', base_url() . 'index.php/usermanagement/userList');
            $this->breadcrumbcomponent->add('User Transfer', base_url() . 'index.php/usermanagement/usertransfer');
            $breadcrumb['breadcrumb'] = $this->breadcrumbcomponent->output();
            $breadcrumb['title'] = 'Accept User Transfer';
            $this->template->write_view('content', "/breadcrumb", $breadcrumb);
            /* End Bread crum */
            $this->template->write_view('content', $this->fview . "/acceptusertransfer", $data);
            $this->template->render();
        }
    }
    function editUser($id)
    {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin', 'hr_manager'));
        //echo "edit ";die;
    }
    function getUserList()
    {
//         $this->output->enable_profiler(TRUE);
        $dist=$this->input->post('dist');//for mapping DDE office in future
        $edudist=$this->input->post('edudist');
        $subdist=$this->input->post('subdist');
        $office=$this->input->post('office');
        //$employee=$this->m_rbac->getUserByDist($edudist,$subdist);//function is defined in RBAC Model
      // echo ($edudist);return;exit;
      if($office!=0){
        $searchFiled = 'office_id';
        $searchId =$office;
        $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
        $data['user_transfered'] = $this->m_rbac->get_userlist_transfered($searchFiled, $searchId);
        $data['userlistnew'] = $this->m_rbac->get_userlist_new($searchFiled, $searchId);
        $display=   $this->load->view($this->fview . "/userlistitadmin", $data);
        return $display;
      }
      if($dist!=0 && $edudist==0){
          //if data is ditrict only 
        $searchFiled = 'district_id';
        $searchId =$dist;
        //  echo $dist;exit;
        $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
        $data['user_transfered'] = $this->m_rbac->get_userlist_transfered($searchFiled, $searchId);
        $data['userlistnew'] = $this->m_rbac->get_userlist_new($searchFiled, $searchId);
        
        $display=   $this->load->view($this->fview . "/userlistitadmin", $data);
     //   echo $display;
        return $display;
       }
        if($subdist==0){
            $searchFiled = 'edudistrict_id';
            $searchId =$edudist;
        }else{
            $searchFiled = 'subdistrict_id';
            $searchId =$subdist;
        }
     //  echo $dist;exit;
        $data['userlist'] = $this->m_rbac->get_userlist($searchFiled, $searchId);
        // $data['mgr_userlist'] = $this->m_rbac->get_manager_userlist($searchFiled, $searchId);
        $data['user_transfered'] = $this->m_rbac->get_userlist_transfered($searchFiled, $searchId);
        $data['userlistnew'] = $this->m_rbac->get_userlist_new($searchFiled, $searchId);
        
        $display=   $this->load->view($this->fview . "/userlistitadmin", $data);
     //   echo $display;
        return $display;
             //  echo $edudist."  ".$subdist;
    }
    /************************************************************************************
     * function to change the status of staff like suspension retirement etc
     * 
     * 
     * 
     *=================================================================================*/
    function staffChange()
    {
         

      //  $this->load->view('secured_user/rbac/change_staff');
        $this->template->write_view('content', "secured_user/rbac/change_staff");
        $this->template->render();
     }
     function getEmployee()
     {
          $i=0;
          if($this->input->post('pen')!=0){
          {
          $employee=$this->m_rbac->getUserAccount($this->input->post('pen'));
          $status=$this->General->prepare_select_box_data('AASF_User_Status','id,descp', '', '', 'id');
           $table="<table class='table table-striped table-bordered'>
                       <thead>
                          <tr>
                             <th>#</th> <th>Username</th><th>Name</th> <th>PEN</th>  <th> User Status</th><th><th/>
                          </tr>
                       </thead>";
                       if( (!empty($employee)) && count($employee)>0){
                        foreach ($employee as  $value) {
                            # code...
                           // print_r($value);exit;
                           $i++;
                        $table.="<tr><td>".$i."</td><td>".$value['username']."</td><td>".$value['name']."</td>";
                        $table.="<td id='pen'>".$value['pen']."</td><td>";
                        $table.="".form_dropdown('dropStatus', $status, $value['user_status'], array('class' => 'form-control select2', 'id' => 'statusSelection','required'=>'required'));
                        $table.="</td><td><button class='btn btn-primary' onclick='updateStatus()'>Save</button></td>";
            
                        
                          
                
                    }
                }
                    else {
                       $table.=" <tr>
                                    <td colspan=7> No Data Found </td> </tr> ";
                    }
         
         
               $table.=" <table>         ";

                }



        echo $table;
            }
            else {
                echo "<div class='alert alert-danger'> Please enter a valid PEN .Only staff user's status can be changed</div>";
            }
        return;
     }
    
    function updateStaffStatus()
    {
        //this function is used to update staff status in users table

        // echo $this->input->post('pen')."  ".$this->input->post('choice');exit;
        $pen=$this->input->post('pen');
        $choice=$this->input->post('choice');
        $updateStaffStatus=$this->m_rbac->updateUserStatus($pen,$choice);

        if($updateStaffStatus==true)
        {
            $i=0;
            if($pen!=0)
            {
            $employee=$this->m_rbac->getUserAccount($this->input->post('pen'));
            $status=$this->General->prepare_select_box_data('AASF_User_Status','id,descp', '', '', 'id');
             $table="<table class='table table-striped table-bordered'>
                         <thead>
                            <tr>
                               <th>#</th> <th>Username</th><th>Name</th> <th>PEN</th>  <th> User Status</th><th><th/>
                            </tr>
                         </thead>";
                         if( (!empty($employee)) && count($employee)>0){
                          foreach ($employee as  $value) {
                              # code...
                             // print_r($value);exit;
                             $i++;
                          $table.="<tr><td>".$i."</td><td>".$value['username']."</td><td>".$value['name']."</td>";
                          $table.="<td id='pen'>".$value['pen']."</td><td>";
                          $table.="".form_dropdown('dropStatus', $status, '', array('class' => 'form-control select2', 'id' => 'statusSelection','required'=>'required'));
                          $table.="</td><td><button class='btn btn-primary' onclick='updateStatus()'>Save</button></td>";
                          
                          
                            
                  
                      }
                        $table.="<tr><td colspan=7 ><div class='alert alert-success'>Staff record successfully updated</div></td></tr>";
                  }
                      else {
                         $table.=" <tr>
                                      <td colspan=7> No Data Found </td> </tr> ";
                      }
           
           
                 $table.=" <table>         ";
  
          echo $table;
                    }
                    else
                     {
                         echo "<div class='alert alert-danger'> Please enter a valid PEN .Only staff user's status can be changed.</div>";
                     }
          return;
            // return true;
         }
        else
        {
           return false;
        }
        


    }




    function editUsers(){
        // $this->output->enable_profiler(TRUE);
        $u_usergroup = $this->input->post('usergroup');
        $this->itschool_rbac->has_permission(__CLASS__, array('admin', 'hr_manager'));
        $this->load->helper('email');

        $data['designation'] = $this->General->prepare_select_box_data('master_designation', 'desig_id,designation_name');
        if(isset($_GET['id'])){
            $user_office_id = $this->General->getrow('users', 'office_id', array('id' => $_GET['id']))->office_id;
            @$data['has_office_block'] = $this->General->getrow($this->table_offices, 'has_office_block', array('office_id' => $user_office_id))->has_office_block;
            if (@$data['has_office_block'] == 1) {
                 $data['office_blocks'] = $this->General->prepare_select_box_data($this->table_office_block, 'office_block_id,block_name', array('office_id' => $user_office_id), false, 'block_name');
                 $data['office_block_id'] = $this->General->getrow('users', 'office_block_id', array('id' => $_GET['id']))->office_block_id;
            }
        }
        if ($this->tank_auth->get_officeId() <= 1001){ //list all offices when DPI or ITAdmin login
            $data['offices'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', '', '', 'office_id');
            $data['district'] = array('0' => '');
            $data['subdistrict'] = array('0' => '');
            $data['edudistrict'] = array('0' => '');
            $data['school'] = array('0' => '');
        }else{
            $data['offices'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', array('office_id' => $this->tank_auth->get_officeId()), '', 'office_id');
            $data['district'] = array('0' => '');
            $data['edudistrict'] = $this->General->prepare_select_box_data('edu_district_master', 'edu_district_code,edu_district_name', array('edu_district_code' => $this->session->userdata('edudistrict_id')), '', 'edu_district_code');
            $data['subdistrict'] = $this->General->prepare_select_box_data('sub_districts_Master', 'id,sub_district_name', array('id' => $this->session->userdata('subdistrict_id')), '', 'id');
            $data['school'] = array('0' => '');
        }
        if ($this->tank_auth->get_officeId() == DGE_OFFICE) // currently no list; modify this code to list all offices when DPI or ITAdmin login
            $data['schoolmanagement'] = array();//$this->General->prepare_select_box_data_management('AASF_Management', 'id,mngmnt_name', '', '', 'id');
        else if ($this->tank_auth->get_officeId() < DGE_OFFICE) //list all offices when DPI or ITAdmin login
            $data['schoolmanagement'] = $this->General->prepare_select_box_data_management('AASF_Management', 'id,mngmnt_name', '', '', 'id');
        else if ($this->tank_auth->get_officeId() == DEO_OFFICE) //list all managements based on edu district on DEO login
            $data['schoolmanagement'] = $this->General->prepare_select_box_data_management('AASF_Management', 'id,mngmnt_name', array('edu_district_code' => $this->session->userdata('edudistrict_id')), '', 'id');
        else
            $data['schoolmanagement'] = $this->General->prepare_select_box_data_management('AASF_Management', 'id,mngmnt_name', array('edu_district_code' => $this->session->userdata('subdistrict_id')), '', 'id');

        if(isset($_GET['id'])){
           $data['user']         =  $this->General->getdata("users","*",array("id"=>$_GET['id']));
           $data['user_profiles'] =  $this->General->getdata("user_profiles","*",array("user_id"=>$_GET['id']));
        }

        
        $this->load->view($this->fview . "/edit_user", $data);

    }
    function UpdateUSER(){

        /////
        $existingUsers = $this->tank_auth->rbac_check_active_users($this->input->post('office'), $this->input->post('office_block'), $this->input->post('usergroup'), $this->input->post('district'), $this->input->post('edudistrict'), $this->input->post('subdistrict'), $this->input->post('zones'), $this->input->post('hiddenid')); // passing user id as last param for excluding that user
            if ($existingUsers > 0) {
                $data['sectionExist'] = 1;
                $ret_data['success'] = 0;
                $ret_data['error'] = 1;
                $ret_data['msg'] = 'There is an active user in this section with same privilege . Please transfer or deactivate the existing user and then try again !!';
                $ret = json_encode($ret_data);
                echo $ret;
            } else {
                $data['sectionExist'] = 0;
                $result =$this->m_rbac->update_user();
                if($result == 1){ 
                    $this->session->set_flashdata('success', 'Saved Successfully!');
                    $ret_data['success'] = 1;
                    $ret_data['msg'] = 'Saved Successfully!';
                    $ret = json_encode($ret_data);
                    echo $ret;
                }
                else{   
                    $this->session->set_flashdata('error'  , 'Some error occured!');
                    $ret_data['success'] = 0;
                    $ret_data['msg'] = 'Some error occured!';
                    $ret = json_encode($ret_data);
                    echo $ret;
                } 
            }
        /////
                    
    }

    /**
     * allocate user to the other office full addition charge
     */
    function newFullAdditionCharge() {
        ini_set('max_execution_time', 0);
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $logedinUser = $this->session->userdata('user_id');
       
        /* Bread crum */
        $this->breadcrumbcomponent->add('User List', base_url() . 'index.php/usermanagement/new_fulladdition_charge');
        $breadcrumb['breadcrumb'] = $this->breadcrumbcomponent->output();
        $breadcrumb['title'] = 'Manage Full Additional Roles';
        $this->template->write_view('content', "/breadcrumb", $breadcrumb);
        /* End Bread crum */

        $data['offices'] = $this->General->prepare_select_box_data('master_offices', 'office_id,office_name', array('has_full_addition' => 1), '', 'office_id');
        $data['districts'] = $this->General->prepare_select_box_data('master_district', 'district_code,district_name', array('state_id' => 18), '', 'district_code');
        $data['designation'] = $this->General->prepare_select_box_data('master_designation', 'desig_id,designation_name', array('is_full_addition_role' => 1), '', 'desig_id');
        $data['users_list'] = $this->m_rbac->getFullAdditionUsers(1);
        $data['users_list_deactive'] = $this->m_rbac->getFullAdditionUsers(0);
        $this->template->write_view('content', $this->fview . "/new_fulladdition_charge", $data);
        $this->template->render();
    }

    function searchUserForFullAddition(){
        $pen = $this->input->post('pen');
        $matched_user = $this->m_rbac->getUsersByPen($pen);
        $data = "";
        $data .= '<thead>
                    <th>#</th>
                    <th>PEN</th>
                    <th>Name</th> 
                    <th>Designation</th>
                    <th>office</th>
                    <th class="text-center">Select</th> 
                </thead>
                <tbody>';
        $slno = 0;
        if(!empty($matched_user)){
            foreach ($matched_user as $row) {
                $is_active = $this->General->getrow('users','activated',array('id'=>$row['user_id']))->activated;
                $slno++;
                $office_name = $this->adminlib->get_office_full_name($row['office_id'],$row['office'],$row['office_block_id']);
                $data .= '<tr><td>'.$slno.'</td>
                              <td>'.$row['pen'].'</td>
                              <td>'.$row['name'].'</td>
                              <td>'.$row['designation_name'].','.$row['usergroup'].'</td>
                              <td>'.$office_name.'</td>
                              <td align="center">';
                              if($is_active == 1)
                $data .=            '<input class="userCheckbox" name="users_list" type="radio" value="'.$row['pen'].'">';
                              else
                $data .=            '<i class="text-red">Not-Active in Samanwaya</i>';

                $data .= '
                </td><td><i class="text-red" id="msg_'.$row['pen'].'"></i></td></tr>';

            }
        }else{
            $data .= '<tr>
                            <td colspan="3" align="center" class="text-red">'.NO_DATA_MSG.'</td>
                      </tr>';
        }
        $data .='</tbody>';
        echo $data;
    }

    function getEducationDist(){
        $district_id = $this->input->post('dist_id');
        // $edu_districts = $this->General->getdata('master_edudistricts', 'id,edu_district_name', array("revenue_district_id"=>$district_id), 'id');

        $edu_districts = $this->General->prepare_select_box_data('master_edudistricts', 'id,edu_district_name', array('revenue_district_id' => $district_id), '', 'id');
        $display_data = '';
        foreach ($edu_districts as $key => $value) {
            $display_data .= '<option value="'.$key.'">'.$value.'</option>';
        }
        echo $display_data;
    }

    function getSubDistricts(){
        $edu_district_id = $this->input->post('edu_dist_id');
        // $edu_districts = $this->General->getdata('master_edudistricts', 'id,edu_district_name', array("revenue_district_id"=>$district_id), 'id');

        $sub_districts = $this->General->prepare_select_box_data('master_subdistricts', 'id,sub_district_name', array('edu_district_id' => $edu_district_id), '', 'id');
        $display_data = '';
        foreach ($sub_districts as $key => $value) {
            $display_data .= '<option value="'.$key.'">'.$value.'</option>';
        }
        echo $display_data;
    }

    function getUserGroupList(){
        $office_id = $this->input->post('office_id');

        $user_groups = $this->General->prepare_select_box_data('rbac_group', 'id,usergroup', array('office_id' => $office_id), '', 'id');
        $display_data = '';
        foreach ($user_groups as $key => $value) {
            $display_data .= '<option value="'.$key.'">'.$value.'</option>';
        }
        echo $display_data;
    }

    function saveFullAdditionDetails(){
        $data = array();
        $active_msg = 0;
        $data['master_office'] = $this->input->post('selected_offices');
        $pen = $this->input->post('pen');
        $data['designation'] = $this->input->post('designation');
        // $data['user_group'] = $this->input->post('user_group');

        $data['from_date'] = $this->input->post('from_date');
        switch($data['master_office']){
            case DDE_OFFICE :   $data['office_id'] = $this->input->post('districts');
                                break;
            case DEO_OFFICE :   $data['office_id'] = $this->input->post('deo_office');
                                break;
            case AEO_OFFICE :   $data['office_id'] = $this->input->post('aeo_office'); 
                                break;
        }
        $data['user_group'] = $this->General->getrow('master_designation','user_group_id',array('desig_id'=>$data['designation']))->user_group_id;
        $data['office_block'] = 0;
        if($data['designation'] == $this->adminlib->get_ao_full_addition_id())
            $data['office_block'] = AUDIT_BLOCK;
        $data['district_id']    = $this->input->post('districts');
        $data['edudistrict_id'] = $this->input->post('deo_office');
        $data['subdistrict_id'] = $this->input->post('aeo_office'); 
        $usr_dtls = $this->General->getrow('users', 'id,has_full_addition_role',array('pen'=>$pen));
        $data['user_id'] = $usr_dtls->id;
        $data['has_full_addition'] = $usr_dtls->has_full_addition_role;
        $has_full_addition = NULL;
        $is_active_exist = isUserExistInChair($data['office_id'],$data['master_office'],$data['user_group']);
        if($is_active_exist == 0){
            $is_exist = $this->General->is_record_exists('full_addition_service_history','user_id='.$usr_dtls->id);
            $data['user_id'] = $usr_dtls->id;
            if($is_exist == 0){
                $personal_dtls = get_current_user_data($usr_dtls->id);
                $name = $personal_dtls['name'].' ['.$personal_dtls['designation_name'].']'; 
            }elseif($is_exist > 0){
                $name = 0;
            }
            $response = $this->m_rbac->saveFullAdditionService($data);
            if($response == 1){
                $has_full_addition = $this->General->getrow('users','has_full_addition_role',array('id'=>$usr_dtls->id))->has_full_addition_role;
                $msg = 'Successfully saved the full addition charge.';
            }
            else
                $msg = 'Not saved the full addition charge right now!';
        }else{
            $response = 0;
            $msg = "There is an active user exist in same chair!";
            if($is_active_exist['is_fulladdition'] > 0){
                $is_active_pen = $this->General->getrow('users','pen',array('id'=>$is_active_exist['user_id']))->pen;
                $active_msg = $is_active_exist['name'].'('.$is_active_exist['designation'].") is already active,<a onclick='inDirectDeactivation(".$is_active_exist['is_fulladdition'].",".$is_active_pen.")'>click here</a> to deactivate the full addition role.";
            }
            $name = 0;
        }
        echo json_encode(array("response"=>@$response,"msg"=>$msg,"name"=>$name,"full_add_stat"=>$has_full_addition,"active_msg"=>$active_msg));
    }   

    function getFullAdditionDetails(){
        $pen = $this->input->post('pen');
        $user_id = $this->General->getrow('users', 'id',array('pen'=>$pen))->id;
        $personal_dtls = $this->m_rbac->getUsersByPen($user_id,1);
        $office_name = $this->adminlib->get_office_full_name($personal_dtls->office_id,$personal_dtls->office,$personal_dtls->office_block_id);
        $full_addition_dtls = $this->m_rbac->getFullAdditionDtls($user_id);
        // echo '<pre>'; print_r($full_addition_dtls); die;
        $display_data = '';
        $display_data .= '
                <div class="row" style="padding: 0px 10px 0px 15px;">
                                <div class="col-md-4 bgSettlementUserInfo whiteBorderLineRight">
                                    <dt class="col-md-3 ">PEN</dt>
                                    <dd class="col-md-9 " id="dispPen">'.$personal_dtls->pen.'</dd>
                                    <dt class="col-md-3 ">Name</dt>
                                    <dd class="col-md-9 " id="dispName">'.$personal_dtls->name.'</dd>
                                </div>
                                <div class="col-md-4 bgSettlementUserInfo whiteBorderLineRight">
                                    <dt class="col-md-3 ">Designation</dt>
                                    <dd class="col-md-9 " id="dispDesig">'.$personal_dtls->designation_name.'</dd>
                                    <dt class="col-md-3 ">Office</dt>
                                    <dd class="col-md-9 " id="dispOffice">'.$office_name.'</dd>
                                </div>
                                <div class="col-md-4 bgSettlementUserInfo whiteBorderLineRight">
                                    <dt class="col-md-3 ">Email</dt>
                                    <dd class="col-md-9 " id="dispEmail" style="word-wrap: break-word;">'.$personal_dtls->email.'</dt>
                                    <dt class="col-md-3 ">Phone</dt>
                                    <dd class="col-md-9 " id="dispPhone">'.$personal_dtls->phone.'</dd>
                                </div>
                            </div>
            <div class="row" style="padding-top:5px;">
                <div class="col-md-12" style="background-color: white;">
                    <table class="table table-bordered table-striped table-responsive no-footer" id="fulladdition_tbls">
                        <thead> 
                            <tr class="bg-white">
                                <td class="text-center" colspan="6"><b>Full Addition Service History</b>
                                    <a class="pull-right" data-toggle="modal" data-target="#fulladditionModal"><i class="fa fa-plus"></i>Add New</a>
                                </td>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Full Addition & Office</th>
                                <th class="text-center">From</th>
                                <th class="text-center">To</th>
                                <th class="text-center" width="150">Recorded On</th>
                                <th class="text-center">Current Status</th>
                            </tr>
                        </thead>
                        <tbody>';

            $i = 0;
        if(count((array)$full_addition_dtls) > 0) {
            foreach ($full_addition_dtls as $row) {
                $i = $i+1;
                if($row['deleted_at'] == NULL)$deleted_at = "Present"; else $deleted_at = mysql_to_date($row['deleted_at']);
                $display_data  .=
                            '<tr>
                                <td>'.$i.'</td>
                                <td>'.$row['designation_name'].'['.$this->adminlib->get_office_full_name($row['master_office_id'],$row['office_id'],$row['office_block_id']).']</td>
                                <td align="center">'.dateFormat_dmY($row['assigned_from']).'</td>
                                <td align="center">';
                                if($row['assigned_to'] == NULL){
                                    $display_data .= '-';
                                }elseif($row['assigned_to'] != NULL){
                                    $display_data .= dateFormat_dmY($row['assigned_to']);
                                }
                $display_data  .='</td>
                                <td align="center">'.mysql_to_date($row['created_at']).' - '.$deleted_at.'</td>
                                <td align="center">';
                                if($row['is_active'] == 1){
                                    $display_data .= '<span class="label label-success">Active</span>';
                                    $display_data .= '<a style="padding-left:3px;" onClick="deactivateFullAdditionModal('.$row['id'].')"><span>Deactivate</span></a>';
                                }elseif($row['is_active'] == 0){
                                    $display_data .= '<span class="label label-default">De-Activated</span>';
                                }
                $display_data  .= '</td>
                            </tr>';
            }
        }else{
            $display_data .= '<tr>
                                <td colspan="6" class="text-center text-red">No Data Found!</td>
                             </tr>';
        }
        $display_data .=  '</tbody>
                    </table>
                </div>
            </div>';

    echo $display_data;
    }

    function deactivateFullAddition(){
        $full_id = $this->input->post('id');
        $pen = $this->input->post('pen');
        $to_date = $this->input->post('deactive_on');
        $pen_user_id = $this->General->getrow('users', 'id',array('pen'=>$pen))->id;
        $office = $this->General->getrow("full_addition_service_history","created_office_id,created_master_office_id",array("id"=>$full_id));
        $has_full_addition = $this->General->getrow('users','has_full_addition_role',array('id'=>$pen_user_id))->has_full_addition_role;
        $user_id                = $this->adminlib->get_user_id();
        $role_id                = $this->adminlib->get_role_id();
        $user_group_id          = $this->adminlib->get_user_group_id();
        $office_id              = $this->adminlib->get_office_id();
        $master_office_id       = $this->adminlib->get_master_office_id();
        $block_id               = $this->adminlib->get_office_block_id(); 
        $full_addition_stat     = NULL;
        $date                   = date("Y-m-d");
        if($office->created_master_office_id == $master_office_id && $office->created_office_id == $office_id){
            $this->db->trans_start();
            $res = $this->General->update('full_addition_service_history',array('assigned_to'=>$to_date,'is_active'=>0,'is_delete'=>1,'deleted_by'=>$user_id,'deleted_role'=>$role_id,'deleted_user_group_id'=>$user_group_id,'deleted_office_id'=>$office_id,'deleted_master_office_id'=>$master_office_id,'deleted_office_block_id'=>$block_id,'deleted_at'=>$date),array('id'=>$full_id,'user_id'=>$pen_user_id));
            $res_usr = $this->General->update('users',array('has_full_addition_role'=>($has_full_addition-1)),array('id'=>$pen_user_id));
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $response = 0;
            } else {
                if($res_usr == 1 && $res == 1){
                    $this->db->trans_commit();
                    $response = 1;
                    $full_addition_stat = $has_full_addition-1;
                }else{
                    $response = 0;
                }
            } 
            if($response == 1)
                $msg = 'Successfully deactivated full addition charge.';
            else
                $msg = 'Not deactivated full addition charge because'.$response;
           
        }else{
            $response = 0;
            $msg = "You have no permission to deactivate this user.";
        }
        echo json_encode(array("response"=>@$response,"msg"=>$msg,"full_add_stat"=>$full_addition_stat));


    }

    function getAllFullAdditionUsers(){
        $matched_user = $this->m_rbac->getUsersByPen(6,2);//Get morethan six digit pen users
        $data = "";
        $data .= '<thead>
                    <th>#</th>
                    <th>PEN</th>
                    <th>Name</th> 
                    <th>Designation</th>
                    <th>office</th>
                    <th class="text-center">Merge</th> 
                </thead>
                <tbody class="hoverTable">';
        $slno = 0;
        if(!empty($matched_user)){
            foreach ($matched_user as $row) {
                $is_active = $this->General->getrow('users','activated',array('id'=>$row['user_id']))->activated;
                $slno++;
                $office_name = $this->adminlib->get_office_full_name($row['office_id'],$row['office'],$row['office_block_id']);
                $data .= '<tr style="cursor: default;"><td>'.$slno.'</td>
                              <td>'.$row['pen'].'</td>
                              <td>'.$row['name'].'</td>
                              <td>'.$row['designation_name'].','.$row['usergroup'].'</td>
                              <td>'.$office_name.'</td>
                              <td align="center">';
                            if($row['has_full_addition_role'] > 0)
                $data .=            '<span class="text-success fa fa-check-circle"></span>';
                            elseif($is_active == 1)
                $data .=            '<a href="#" class="btn btn-sm btn-primary" onClick="mergeFulladditionCharge('.$row['pen'].')" style="margin-right: 5px; margin-top: 1px; height: 30px !important;">Add Full-Addition</a>';
                              elseif($is_active == 0)
                $data .=            '<i class="text-red">Not-Active in Samanwaya</i>';

                $data .= '
                </td><td><i class="text-red" id="msg_'.$row['pen'].'"></i></td></tr>';

            }
        }else{
            $data .= '<tr>
                            <td colspan="3" align="center" class="text-red">'.NO_DATA_MSG.'</td>
                      </tr>';
        }
        $data .='</tbody>';
        echo $data;
    }

    function mergeUsersInFulladdition(){
        $checkedPen = $this->input->post('checkedPen');
        $user_dtls = $this->m_rbac->getUsersByPen($checkedPen,3);
        $response = $this->m_rbac->addUserForFulladdition($user_dtls);
        $trow = "";
            $trow .= '<tr onclick="getFullAdditionUserDetails('.$user_dtls->pen.')">
                <td>'.$user_dtls->pen.'</td>
                <td>'.$user_dtls->name.' ['.$user_dtls->designation_name.']</td>
            </tr>';
        if($response == 1)
            $msg = 'Successfully added.';
        else
            $msg = 'Cannot add user right now.';
        echo json_encode(array("response"=>$response,"msg"=>$msg,"trow"=>$trow));
    }

    function sectionDistrictMapping($office_id=''){
        $data = array();
        $mapped_dists = array();
        if($office_id == ''){
            $data['mapped_dists'] = [];
            $data['districts'] = $this->General->getdata('master_district','district_code,district_name',"state_id=18", 'district_code');
        }else{
            $data['mapped_dists'] = $this->General->getdata('section_district_mapper','dist_id,usergroup_id',array('master_office_id'=>$office_id),'dist_id');
            // echo '<pre>'; print_r($data['mapped_dists']); echo '</pre>'; die;
            foreach($data['mapped_dists'] as $row){
                $mapped_dists[] = $row['dist_id'];
            }
            // $List = implode("','", $mapped_dists);
            $data['districts'] = $this->General->getdata('master_district','district_code,district_name',"district_code NOT IN( '" . implode( "', '" , $mapped_dists ) . "' ) and state_id=18", 'district_code');
            $data['sec_mapped_dists'] = $this->m_rbac->getSectionMappedDists();
            if($office_id == HSE_OFFICE){
                $rdd = $this->adminlib->get_rdd_id();
                $data['usergroup'] = $this->m_rbac->getUserGroupsByDesignation($office_id,$rdd);
            }else{
                $data['usergroup'] = $this->m_rbac->getUserGroupsByDesignation($office_id);
            }
        }
        // $desig_id = $this->adminlib->get_clerk_id();
        $data['master_offices'] = $this->General->getdata('master_offices','office_id,office_name');
        // echo '<pre>'; print_r($data['usergroup']); echo '</pre>'; die;
        // echo '<pre>'; print_r($data['usergroup']); 

        // echo '<pre>'; print_r($data['sec_mapped_dists']); die;
        /* Bread crum */
        $data['selected_office_id'] = $office_id;
        $this->breadcrumbcomponent->add('Section-District Mapping', base_url() . 'index.php/usermanagement/new_user');
        $breadcrumb['breadcrumb'] = $this->breadcrumbcomponent->output();
        $breadcrumb['title'] = 'Section - District Mapping';
        $this->template->write_view('content', "/breadcrumb", $breadcrumb);
        /* End Bread crum */

        $this->template->write_view('content', $this->fview . "/section_dist_mapping", $data);
        $this->template->render();
    }
    function updateSectionDistrictMapping(){
        $dist_id = $this->input->post('dist');
        $user_group = $this->input->post('usrgrp');
        $office_id = $this->input->post('office_id');
        $res = $this->m_rbac->updateSectionDistrictMapping($dist_id,$user_group,$office_id);
        echo json_encode(array('response'=>$res));
    }
    
    function managerlist($searchLocation="",$searchId=""){
//        print("<pre>");
//        print_r($_SESSION);
//        exit;
        if(master_office() == ITADMIN_OFFICE || master_office() == ADMIN_OFFICE){
         if($searchId > 0){  
            $data['managementsList'] = $this->SM->get_management_list($searchId,$searchLocation);
         }else {
            $data['managementsList'] = array();
         }
        if($this->session->userdata('user_type') == "ADMIN" && master_office() == ADMIN_OFFICE){
            $where1 = " revenue_district_id =  ".$this->session->userdata('district_id');
        }else{
            $where1 = " ";
        }
         $data['search_loc'] = $searchLocation;
         $data['search_id']  = $searchId;
         $data['district'] = $this->General->prepare_select_box_data("master_district","district_code,district_name","","Select","district_code");
         $data['deo_list'] = $this->General->prepare_select_box_data("master_edudistricts","id,edu_district_name",$where1,"Select","id");
         $data['aeo_list'] = $this->General->prepare_select_box_data("master_subdistricts","id,sub_district_name",$where1,"","id");
         $this->template->write_view('content', $this->fview . "/manager_list", $data);
         $this->template->render();
        }
    }

}

/* End of file usermanagement.php */
/* Location: ./application/controllers/usermanagement.php */