<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login_attempts
 *
 * This model serves to watch on all attempts to login on the site
 * (to protect the site from brute-force attack to user database)
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Login_attempts extends CI_Model
{
	private $table_name 		  = 'login_attempts';
	private $table_user 		  = 'users';
	private $table_msg  		  ='AASF_Msg_popup';
	private $table_msg_child      = 'AASF_Msg_popup_Child';
	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
	}

	/**
	 * Get number of attempts to login occured from given IP-address or login
	 *
	 * @param	string
	 * @param	string
	 * @return	int
	 */
	function get_attempts_num($ip_address, $login)
	{
		$this->db->select('1', FALSE);
		$this->db->where('ip_address', $ip_address);
		if (strlen($login) > 0) $this->db->or_where('login', $login);

		$qres = $this->db->get($this->table_name);
		return $qres->num_rows();
	}

	/**
	 * Increase number of attempts for given IP-address and login
	 *
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	function increase_attempt($ip_address, $login)
	{
			$this->db->insert($this->table_name, array('ip_address' => $ip_address, 'login' => $login,));
	}
	/*******************************************************8
	 * To set Init Login flag
	 * 
	 * ------------------------------------------------------
	 */
	function setInitLoginStatus($userId){

		$this->db->trans_start();

			$data = array(
				'first_login_chk'=>1
				);
			$this->db->set($data); 
			$this->db->where("username", $userId); 
			$this->db->update("users", $data);

		$this->db->trans_complete();
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			return 1;
		}

}
	/**
	 * To get the password status to check whether the password is default
	 *
	 * @param	int
	 * 
	 * @return	int
	 */
	 function getInitLoginStatus($userId)
	 {
        $this->db->select('first_login_chk');		
        $this->db->from($this->table_user);
		$this->db->where('username', $userId);
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['first_login_chk'];
		}
		if(isset($value))
			 return $value;
		else {
			 return 0;
		}

	 }
	 /**
	 * To get the password status to check whether the broadcast message read is ok
	 *
	 * @param	int
	 * 
	 * @return	int
	 */
	function getMessageViewStatus($userId)
	{
	   $this->db->select('display_msg_chk');		
	   $this->db->from($this->table_user);
	   $this->db->where('username', $userId);
	   $query = $this->db->get();
	   if($query->num_rows()>0) {
		   $data = $query->row_array();
		   $value = $data['display_msg_chk'];
	   }
	   if(isset($value))
			return $value;
	   else {
			return 0;
	   }

	}
	/*************************************************************************************
	 * getmessage function to get home push messages
	 * -----------------------------------------------------------------------------------
	 *  @param int
	 *  @returns  string
	 *====================================================================================*/
	function getLoginMessage($desingationId)
	{   
	//	$this->output->enable_profiler(TRUE);
		$this->db->select('MSG.msg_txt');		
		$this->db->from($this->table_msg .' MSG');
		$this->db->join($this->table_msg_child. ' AS child', 'child.msg_id=MSG.id');
		
		$this->db->where('MSG.is_active', 1);
		$this->db->where('child.desig_id',$desingationId);
		$this->db->order_by('display_date','DESC');
  
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$msg  = $data['msg_txt'];
		
		
			
		}
	//	echo $msg;die;
		if(isset($msg))
			return $msg;
        else {
			return 0;
  		 }
	  
	}

/**
	 * Get user details
	 *
	 * @param	string
	 * @param	string
	 * @return	array
	 */
function getUserAccount($pen,$phone)
{       $this->db->select('user.username,up.phone,user.email,user.pen,up.name');	
	// $this->db->from($this->table_msg .' MSG');
	    	$this->db->join('user_profiles AS up', 'up.user_id=user.id');	
      	$this->db->from($this->table_user.' AS user');
				$this->db->where('user.username', $pen);
				$this->db->where('up.phone', $phone);
				$query = $this->db->get();
        if($query->num_rows()>0) {
					$data = $query->row_array();
					$mail = $data['email'];
					$phone1= $data['phone'];
					$pen1=$data['pen'];
					$name=$data['name'];
					$userdata=array('phone'=>$phone1,'pen'=>$pen1,'email'=>$mail,'name'=>$name);
					return $userdata;

				}
				else {
				 return 0;
				}
			  

}
	
//function to get the office of user 
//It accepts username and returns the office associated with user

function getUsersOffice($username)
{       $this->db->select('user.office_id,user.subdistrict_id,user.edudistrict_id,user.district_id');	
	// $this->db->from($this->table_msg .' MSG');
	    //	$this->db->join('user_profiles AS up', 'up.user_id=user.id');	
      	$this->db->from($this->table_user.' AS user');
				$this->db->where('user.username', $username);
			
				$query = $this->db->get();
        if($query->num_rows()>0) {
					$data = $query->row_array();
					$officeId = $data['office_id'];
					$subDistrictId=$data['subdistrict_id'];
					$eduDistrictId=$data['edudistrict_id'];
					$districtId=$data['district_id'];
		
					$userdata=array('office'=>$officeId,'subDist'=>$subDistrictId,'eduDist'=>$eduDistrictId, 'dist'=>$districtId);
					return $userdata;

				}
				else {
				 return 0;
				}
			  

}

	/**
	 * Increase log info  for wrong login IP-address and login
	 *
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	function storeip($ip_address, $login,$OS,$device,$browser)
	{
			$this->db->insert($this->table_name, array('ip_address' => $ip_address, 'login' => $login,'OS'=>$OS,'device_type'=>$device,'browser_name'=>$browser));
	}

    /* to block get the count of invalid attempts user
	*
	* @param	string
	* @return   int
	*/
	function getinvalidcount($user)
	{
	//    $count=$this->db->select('invalid_count')
	//    ->from($this->table_user)
	//    ->where('users', array('username' => $user))ss;
	//    return $count;
	    $this->db->select('invalid_count');		
        $this->db->from($this->table_user);
		$this->db->where('username', $user);
		$this->db->where('is_sampoorna <>',1 );
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['invalid_count'];
		}
		if(isset($value))
			 return $value;
		else {
			return 0;
		}
	}
	/**********************************************
	 * function to hide message flag
	 */
	function nevershowmessage($username)
	{
		$data = array( 
			'display_msg_chk' => 0,
		  ); 
		  
		$this->db->set($data); 
		$this->db->where("username", $username); 
		$this->db->update("users", $data);
	}
//to make password reset form 
	function initLoginEnable($username)
	{
		$data = array( 
			'first_login_chk' => 1,
		  ); 
		  
		$this->db->set($data); 
		$this->db->where("username", $username); 
		$this->db->update("users", $data);
	}
	/*
	*To clear invalid user count when the user logs in successfully
	*
	*@param string
	*@return void
	*
	*/
	function clearInvalidLogin($user)
	{
		$value=0;
		$this->db->select('invalid_count');		
        $this->db->from($this->table_user);
		$this->db->where('username', $user);
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['invalid_count'];
		}
		// code to get invalid count from db ^
       // echo $value;die;
		if($value<3)
		{
		//if the count exists and it is less than 3 clear failed login attempts 
		$data = array( 
			'invalid_count' => 0,
			
		  ); 
		  
		$this->db->set($data); 
		$this->db->where("username", $user); 
		$this->db->update("users", $data);
      //  echo "updated  ".$this->db->affected_rows();die;

		}
	}
	function emailInvalidCountClear($user)
	{
		
	  // echo "clr";exit;
			 //if the user is exceeded max count 
			 $data = array( 
				'banned'=>0,
				'ban_reason'=>"",	
				'activated'=>1,
				'invalid_count'=>0		 
			 ); 
			 $this->db->set($data); 
			 $this->db->where("username", $user); 
			 $this->db->update("users", $data);

		 
		
		if(isset($value))
		     return $value;
		else 
		     return 0;

	}

	//function to clearblock on e-mail activation

	/* to block malicious user
	*
	* @param	string	
	* @return	int
	*/
	function updateInvalidCount($user)
	{
		$this->db->select('invalid_count');		
        $this->db->from($this->table_user);
		$this->db->where('username', $user);
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['invalid_count'];
		}
		// code to get invalid count from db ^
	   if(isset($value))
	   {
		$newCount=$value+1;
		$data = array( 
			'invalid_count' => $newCount); 
		$this->db->set($data); 
		$this->db->where("username", $user); 
		$this->db->update("users", $data);
		 //update the count ^
		$this->db->select('invalid_count');		
        $this->db->from($this->table_user);
		$this->db->where('username', $user);
		$query = $this->db->get();
		if($query->num_rows()>0) {
			$data = $query->row_array();
			$value = $data['invalid_count'];
		}
		//^new count fetched
	   if($value>=3)
	     {
			 //if the user is exceeded max count 
			 $data = array( 
				'banned'=>1,
				'ban_reason'=>"Too many invalid login",				 
			 ); 
			 $this->db->set($data); 
			 $this->db->where("username", $user); 
			 $this->db->update("users", $data);

		 }
		}
		if(isset($value))
		     return $value;
		else 
		     return 0;

	}
  /*******************************************************************************************************************
   *                     Function to update firstLogin flag
   *                       
   *                     @param string 
   *                     @return void
   * 
   *------------------------------------------------------------------------------------------------------------------*/
  function passwordFlagChange($username)
  {
	$data = array( 
		'first_login_chk'=>0,
				 
	 ); 
	 $this->db->set($data); 
	 $this->db->where("username", $username); 
	 $this->db->update("users", $data);
	 
   

  }
	
	/* to block malicious user
	*
	* @param	string
	* @param	string
	* @param    timestamp
	* @return	void
	*/
	function blockuser($user)
	{
		
		 //if the user is exceeded max count 
		 $data = array( 
			'banned'=>1,
			'activated'=>0,
			'ban_reason'=>"Too many invalid login",			 
		 ); 
		 $this->db->set($data); 
		 $this->db->where("username", $user); 
		 $this->db->update("users", $data);


	}
 /******************************
	* Function to get the ban user reason
  */
	function getBanReason($username){

		$this->db->select('ban_reason,username');
		$this->db->from('users');
		$this->db->where('username',$username);
		$query=$this->db->get();
	 if($query->num_rows()>0) {
		$data = $query->row_array();
		$value = $data['ban_reason'];
	}
	else {
		$value="";
	}
return $value;


	}
	/**
	 * Clear all attempt records for given IP-address and login.
	 * Also purge obsolete login attempts (to keep DB clear).
	 *
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	void
	 */
	function clear_attempts($ip_address, $login, $expire_period = 86400)
	{
		$this->db->where(array('ip_address' => $ip_address, 'login' => $login));

		// Purge obsolete login attempts
		$this->db->or_where('UNIX_TIMESTAMP(time) <', time() - $expire_period);

		$this->db->delete($this->table_name);
	}
	
}

/* End of file login_attempts.php */
/* Location: ./application/models/auth/login_attempts.php */