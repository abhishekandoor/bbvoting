<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Users extends CI_Model {

    private $table_name = 'users'; // user accounts
    private $profile_table_name = 'user_profiles'; // user profiles
    private $address_table_name = 'user_address'; // user address
    private $group_table_name = 'rbac_group'; // user groups
    private $scope_table_name = 'rbac_scope'; // user scope
    private $master_office = 'master_offices'; // user scope
    private $master_office_block = 'master_office_block'; // office blocks
    private $master_designation = 'master_designation'; // office blocks

    function __construct() {
        parent::__construct();

        $ci = & get_instance();
        $this->table_name = $ci->config->item('db_table_prefix', 'tank_auth') . $this->table_name;
        $this->profile_table_name = $ci->config->item('db_table_prefix', 'tank_auth') . $this->profile_table_name;
    }

    /****************
     * Function change init password
     */
     function resetInitPassword($username){

        $this->db->set('password', $new_pass);
        $this->db->set('new_password_key', NULL);
        $this->db->set('new_password_requested', NULL);
        $this->db->where('username', $username);
     }
    /**
     * Get user record by Id
     *
     * @param	int
     * @param	bool
     * @return	object
     */
    function get_user_by_id($user_id, $activated) {
        $this->db->where('id', $user_id);
        $this->db->where('activated', $activated ? 1 : 0);

        $query = $this->db->get($this->table_name);
        if ($query->num_rows() == 1)
            return $query->row();
        return NULL;
    }

    /**
     * Get user record by login (username or email)
     *
     * @param	string
     * @return	object
     */
    function get_user_by_login($login) {
        $this->db->where('LOWER(username)=', strtolower($login));
        $this->db->or_where('LOWER(email)=', strtolower($login));

        $this->db->select('U.*,UG.item_ids as usergroup, US.scope as scope,MO.user_type as role, CONCAT_WS(" ", UP.name, UP.middle_name, UP.last_name) AS name, OB.block_name, MD.designation_name');
        $this->db->from($this->table_name . ' AS U');
        $this->db->join($this->group_table_name . ' AS UG', 'UG.id=U.user_group_id');
        $this->db->join($this->scope_table_name . ' AS US', 'US.id=UG.scope_id');
        $this->db->join($this->master_office . ' AS MO', 'MO.office_id=U.office_id');
        $this->db->join($this->profile_table_name . ' AS UP', 'UP.user_id=U.id');
        $this->db->join($this->master_office_block . ' AS OB', 'OB.office_block_id=U.office_block_id', 'left');
        $this->db->join($this->master_designation . ' AS MD', 'MD.desig_id=U.designation_id');
        $query = $this->db->get();
		
        if ($query->num_rows() == 1)
            return $query->row();
        return NULL;
    }

    /**
     * Get user record by username
     *
     * @param	string
     * @return	object
     */
    function get_user_by_username($username) {
        $this->db->where('LOWER(username)=', strtolower($username));

        $query = $this->db->get($this->table_name);
        if ($query->num_rows() == 1)
            return $query->row();
        return NULL;
    }

    /**
     * Get user record by email
     *
     * @param	string
     * @return	object
     */
    function get_user_by_email($email) {
        $this->db->where('LOWER(email)=', strtolower($email));

        $query = $this->db->get($this->table_name);
        if ($query->num_rows() == 1)
            return $query->row();
        return NULL;
    }

    /**
     * Check if username available for registering
     *
     * @param	string
     * @return	bool
     */
    function is_username_available($username) {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(username)=', strtolower($username));

        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 0;
    }

    /**
     * Check if email available for registering
     *
     * @param	string
     * @return	bool
     */
    function is_email_available($email) {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(email)=', strtolower($email));
        $this->db->or_where('LOWER(new_email)=', strtolower($email));

        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 0;
    }
    /**
     * Check if pen available for registering
     *
     * @param	string
     * @return	bool
     */
    function is_pen_available($pen) {
        $this->db->select('1', FALSE);
        $this->db->where('pen', strtolower($pen));

        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 0;
    }

    /**
     * Create new user record
     *
     * @param	array
     * @param	bool
     * @return	array
     */
    function create_user($data, $activated = TRUE, $profile) {
        $data['created'] = date('Y-m-d H:i:s');
        $data['activated'] = $activated ? 1 : 0;

        if ($this->db->insert($this->table_name, $data)) {
            $user_id = $this->db->insert_id();
            if ($activated) {
                $this->create_profile($user_id, $profile);
                $this->create_Permanentaddress($user_id);
                $this->create_Communicationaddress($user_id);
                $this->create_user_job_profile($user_id);
            }
            return array('user_id' => $user_id);
        }
        return NULL;
    }

    /**
     * Activate user if activation key is valid.
     * Can be called for not activated users only.
     *
     * @param	int
     * @param	string
     * @param	bool
     * @return	bool
     */
    function activate_user($user_id, $activation_key, $activate_by_email) {
        $this->db->select('1', FALSE);
        $this->db->where('id', $user_id);
        if ($activate_by_email) {
            $this->db->where('new_email_key', $activation_key);
        } else {
            $this->db->where('new_password_key', $activation_key);
        }
        $this->db->where('activated', 0);
        $query = $this->db->get($this->table_name);

        if ($query->num_rows() == 1) {

            $this->db->set('activated', 1);
            $this->db->set('new_email_key', NULL);
            $this->db->where('id', $user_id);
            $this->db->update($this->table_name);

            $this->create_profile($user_id);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Purge table of non-activated users
     *
     * @param	int
     * @return	void
     */
    function purge_na($expire_period = 172800) {
        $this->db->where('activated', 0);
        $this->db->where('UNIX_TIMESTAMP(created) <', time() - $expire_period);
        $this->db->delete($this->table_name);
    }

    /**
     * Delete user record
     *
     * @param	int
     * @return	bool
     */
    function delete_user($user_id) {
        $this->db->where('id', $user_id);
        $this->db->delete($this->table_name);
        if ($this->db->affected_rows() > 0) {
            $this->delete_profile($user_id);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Set new password key for user.
     * This key can be used for authentication when resetting user's password.
     *
     * @param	int
     * @param	string
     * @return	bool
     */
    function set_password_key($user_id, $new_pass_key) {
        $this->db->set('new_password_key', $new_pass_key);
        $this->db->set('new_password_requested', date('Y-m-d H:i:s'));
        $this->db->where('id', $user_id);

        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Check if given password key is valid and user is authenticated.
     *
     * @param	int
     * @param	string
     * @param	int
     * @return	void
     */
    function can_reset_password($user_id, $new_pass_key, $expire_period = 900) {
        $this->db->select('1', FALSE);
        $this->db->where('id', $user_id);
        $this->db->where('new_password_key', $new_pass_key);
        $this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);

        $query = $this->db->get($this->table_name);
        return $query->num_rows() == 1;
    }

    /**
     * Change user password if password key is valid and user is authenticated.
     *
     * @param	int
     * @param	string
     * @param	string
     * @param	int
     * @return	bool
     */
    function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900) {
        $reset_by = $this->session->userdata('user_id') ;
        $this->General->insert('reset_password_log',array('user_id'=>$user_id,'reset_by'=>$reset_by,'reset_on'=>date('Y-m-d H:i:s')));
        $this->db->set('password', $new_pass);
        $this->db->set('new_password_key', NULL);
        $this->db->set('new_password_requested', NULL);
        $this->db->where('id', $user_id);
        $this->db->where('new_password_key', $new_pass_key);
        $this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);

        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Change user password
     *
     * @param	int
     * @param	string
     * @return	bool
     */
    function change_password($user_id, $new_pass) {
        $reset_by = $this->session->userdata('user_id') ;
        $ip_address = $this->input->ip_address();
        $this->General->insert('reset_password_log',array('user_id'=>$user_id,'reset_by'=>$reset_by,'reset_on'=>date('Y-m-d H:i:s'),'ip_address'=>$ip_address));
        $this->db->set('password', $new_pass);
        $this->db->where('id', $user_id);

        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Set new email for user (may be activated or not).
     * The new email cannot be used for login or notification before it is activated.
     *
     * @param	int
     * @param	string
     * @param	string
     * @param	bool
     * @return	bool
     */
    function set_new_email($user_id, $new_email, $new_email_key, $activated) {
        $this->db->set($activated ? 'new_email' : 'email', $new_email);
        $this->db->set('new_email_key', $new_email_key);
        $this->db->where('id', $user_id);
        $this->db->where('activated', $activated ? 1 : 0);

        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Activate new email (replace old email with new one) if activation key is valid.
     *
     * @param	int
     * @param	string
     * @return	bool
     */
    function activate_new_email($user_id, $new_email_key) {
        $this->db->set('email', 'new_email', FALSE);
        $this->db->set('new_email', NULL);
        $this->db->set('new_email_key', NULL);
        $this->db->where('id', $user_id);
        $this->db->where('new_email_key', $new_email_key);

        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0;
    }

    /**
     * Update user login info, such as IP-address or login time, and
     * clear previously generated (but not activated) passwords.
     *
     * @param	int
     * @param	bool
     * @param	bool
     * @return	void
     */
    function update_login_info($user_id, $record_ip, $record_time) {
        $this->db->set('new_password_key', NULL);
        $this->db->set('new_password_requested', NULL);

        if ($record_ip)
            $this->db->set('last_ip', $this->input->ip_address());
        if ($record_time)
            $this->db->set('last_login', date('Y-m-d H:i:s'));

        $this->db->where('id', $user_id);
        $this->db->update($this->table_name);
    }

    /**
     * Ban user
     *
     * @param	int
     * @param	string
     * @return	void
     */
    function ban_user($user_id, $activated, $banned, $reason = NULL,$invalid) {
	  if($invalid==1)
       { $this->db->where('id', $user_id);
        $this->db->update($this->table_name, array(
            'banned' => $banned,
            'activated' => $activated,
            'ban_reason' => $reason,
        ));
    }
        else {
            $this->db->where('id', $user_id);
            $this->db->update($this->table_name, array(
                'banned' => $banned,
                'activated' => $activated,
                'ban_reason' => $reason,
                'invalid_count'=>0));
                

        }
        return TRUE;
    }

    /**
     * Unban user
     *
     * @param	int
     * @return	void
     */
    function unban_user($user_id) {
        $this->db->where('id', $user_id);
        $this->db->update($this->table_name, array(
            'banned' => 0,
            'ban_reason' => NULL,
            'invalid_count'=>0,// to unblock invalid login attempt users
        ));
    }

    /**
     * Create an empty profile for a new user
     *
     * @param	int
     * @return	bool
     */
    private function create_profile($user_id, $profile) {
        //$this->db->set('user_id', $user_id);
        $profile['user_id'] = $user_id;
        return $this->db->insert($this->profile_table_name,$profile);
    }

    /**
     * Create an empty communication address fields for a new user
     *
     * @param	int
     * @return	bool
     */
    private function create_Communicationaddress($user_id) {
        $this->db->set('user_id', $user_id);
        $this->db->set('type', 'c');
        $this->db->set('state', '18');
        return $this->db->insert($this->address_table_name);
    }
    private function create_user_job_profile($user_id) {
        $this->db->set('user_id', $user_id);
        return $this->db->insert('user_job_profile');
    }

    /**
     * Create an empty permanent address fields for a new user
     *
     * @param	int
     * @return	bool
     */
    private function create_Permanentaddress($user_id) {
        $this->db->set('user_id', $user_id);
        $this->db->set('type', 'p');
        $this->db->set('state', '18');
        return $this->db->insert($this->address_table_name);
    }

    /**
     * Delete user profile
     *
     * @param	int
     * @return	void
     */
    private function delete_profile($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete($this->profile_table_name);
    }
    
    function rbac_check_active_users($office, $office_block, $usergroup,$district,$eduDistrict,$subDistrict,$zones, $exclude_user = NULL){
        if($office == 1002){//DDE
            if($district==0 || $district==NULL){
                $this->db->where(" (district_id IS NULL OR district_id =0)");
            }else{
                $this->db->where('district_id', $district);
            }
        }elseif ($office == 1001) {//DGE
            if($district==0 || $district==NULL){
                $this->db->where(" (district_id IS NULL OR district_id =0)");
            }else{
                $this->db->where('district_id', $district);//0
            }
            if($office_block==0 || $office_block==NULL){
                $this->db->where(" (office_block_id IS NULL OR office_block_id =0)");
            }else{
                $this->db->where('office_block_id', $office_block);//0
            }
        }elseif ($office == 1006) {//DEO
            if($eduDistrict==0 || $eduDistrict==NULL){
                $this->db->where(" (edudistrict_id IS NULL OR edudistrict_id =0)");
            }else{
                $this->db->where('edudistrict_id', $eduDistrict);
            }
        }elseif ($office == 1007) {//AEO
            if($subDistrict==0 || $subDistrict==NULL){
                $this->db->where(" (subdistrict_id IS NULL OR subdistrict_id =0)");
            }else{
                $this->db->where('subdistrict_id', $subDistrict);
            }
        }elseif ($office == 1013) {//DNO
            if($district==0 || $district==NULL){
                $this->db->where(" (district_id IS NULL OR district_id =0)");
            }else{
                $this->db->where('district_id', $district);
            }
        }elseif($office == 1012){
            return 0;
        }elseif($office == SUPER_CHECK_OFFICE){
            $this->db->where('zone_id', $zones);
        }
        $this->db->select('id');
        $this->db->where('user_group_id', $usergroup);
        $this->db->where('banned', 0);
        $this->db->where('activated', 1);
        if($exclude_user!=NULL && $exclude_user!='')
            $this->db->where('id !=', $exclude_user);
        $query = $this->db->get($this->table_name);
        return $query->num_rows();
    }

    // only for getting usergroup of HM (LP, UP, HS) by office id. As HM, no duplicate rows
    function get_usergroup_by_office_id($office_id) {
        $this->db->select('id');
        $this->db->where('office_id', $office_id);
        $query = $this->db->get($this->group_table_name);
        if ($query->num_rows() == 1)
            return $query->row();
        return NULL;
    }
    
    function check_activated($username){
        $this->db->select('activated');
        $this->db->where('LOWER(username)=', strtolower($username));
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() == 1)
            return $query->row();
        return NULL;
    }
    

}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */
