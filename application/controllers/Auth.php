<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends MY_Auth {

    function __construct() {
        parent::__construct();
        //$this->load->helper(array('form', 'url'));
        //$this->load->library('form_validation');
        //$this->load->library('security');
        $this->load->library('tank_auth');
        $this->load->library('AdminLib');
        $this->load->library('itschool_rbac');
        $this->load->helper('captcha');
        $this->lang->load('tank_auth');
        $this->load->model('tank_auth/login_attempts','LA');//added for loging IP
        $this->load->model('tank_auth/users','users');//added for HM entry
        $this->load->model('CommonModel','CM');//added for HM entry
    }

    function index() {
        if ($message = $this->session->flashdata('message')) {
            $this->load->view('auth/general_message', array('message' => $message));
        } else {
            redirect('/auth/login/');
        }
    }

    /******
     * Load password Reset view
     * 
     */
     function reset_password_form_init()
     {
         $this->load->view('auth/reset_password_form_init');
     }

    /**
     * Login user on the site
     *
     * @return void
     */
    function login() {
        // echo '<pre>';
        // print_r($this->CM->getActivityLogs('2020-05-14', '2020-05-15', 1, 1007, 353));//, 1007));//, 403)); // 353
        // die;
        // echo '<pre>';
        // print_r($this->CM->totalOfficeUsers(1007, 353));die;
        // die;
       // $this->output->enable_profiler(TRUE);
        //echo "line 35";die;
        if(@$_SESSION['passreset']==1)
         {
             unset($_SESSION['passreset']);
             $this->logout();
         }

        if ($this->tank_auth->is_logged_in()) {         // logged in
            //echo "line 37";die;

            redirect('');
        } else if ( !$this->tank_auth->is_logged_in() && $this->session->userdata('user_type')==5 && $this->session->userdata('status')==1 ) {         // logged in as HM - sampoorna
            //echo "line 37";die;
            redirect(base_url('index.php/School/HM_Dashboard'));
        } else {

            $data['errors'] = array();
            $data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
                    $this->config->item('use_username', 'tank_auth'));
            $data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

            if ($this->input->post()) {

              $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
              $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
              if(isCaptchaEnabled())
                $this->form_validation->set_rules('captcha_txt', 'Captcha', 'required|callback_validate_captcha');
              $username=$this->input->post('login');
              $firstLogin=$this->LA->getInitLoginStatus($username);
              //   
                
                $loginWrong=$this->LA->getinvalidcount($username);


                if($loginWrong>=3)
                {
                 $this->LA->blockuser($username);
                 $data['invalid_ban']= "Too many invalid login attempts";
                // die;
                }
               
                if ($this->form_validation->run() === FALSE) {        // validation ok
                   // echo "line 57";die;

                    $data['captcha_img'] = $this->getCaptcha();
                    $this->template->write_view('content', 'home/content_panel', $data);
                    $this->template->load();
                } else {
                    $username = $this->form_validation->set_value('login');
                    //$password = $this->form_validation->set_value('password');

                    if(isset($_POST['sampoorna']) && $_POST['sampoorna'] == 1){
                        //if (mb_strtolower(substr($username, 0, 6)) == "admin@" || mb_strtolower(substr($username, 0, 11)) == "test_admin@") { //HM Login
                            $result = $this->check_sampoorna_school($this->form_validation->set_value('login'), $this->form_validation->set_value('password')); 
                            if($result == 2){
                                $result = $this->check_sampoorna_school_in_samanwaya($this->form_validation->set_value('login'), $this->form_validation->set_value('password'));  
                            }           
                            if ($result == "1" || $result == 1) {
                                $logged_user = $this->session->userdata();
                                //$school_code = mb_strtolower(substr($username, strpos($username, '@')+1));
                                $school_id = $logged_user['SCHOOL_ID'];
                                $school_exist = $this->check_school_exist($school_id);


                                if($school_exist>0){  // proceed to sampoorna login
                                    // echo $school_code;
                                    // var_dump($this->form_validation->set_value('login'), $this->form_validation->set_value('password'));
                                    // check if user details exists
                                    $user_exist = $this->check_user_exist($username);
                                    if($user_exist>0){
                                        // fetch userid from user table and store in session
                                        $user_id = $this->fetch__userid_by_username($username);
                                        $this->session->set_userdata('user_id', $user_id);



                                    }else{
                                        $school_level = $this->session->userdata('LEVEL');
                                        $office_id = array( 'LP' => $this->adminlib->get_lp_school_office_id(),
                                                            'UP' => $this->adminlib->get_up_school_office_id(),
                                                            'HS' => $this->adminlib->get_hs_school_office_id()
                                                        );
                                        // insert new record
                                        if ($this->users->is_username_available($username)) {
                                            
                                            $usergroup = $this->users->get_usergroup_by_office_id($office_id[$school_level]);
                                        
                                            $hm_user_data  = array(
                                                            'username' => strtolower($username),
                                                            'office_id' => $office_id[$school_level],
                                                            'district_id' => $logged_user['REV_DISTRICT_CODE'],
                                                            'subdistrict_id' => $logged_user['SUB_DISTRICT_CODE'],
                                                            'edudistrict_id' => $logged_user['EDU_DISTRICT_CODE'],
                                                            'school_code' => $logged_user['SCHOOL_ID'],
                                                            'designation_id' => $this->adminlib->get_hm_id(),
                                                            'user_group_id' => $usergroup->id,
                                                            'is_sampoorna'  => 1,
                                                            'last_ip' => $this->input->ip_address(),
                                                        );
                                            
                                            $school_data = array(
                                                            'name' => $logged_user['SCHOOL_NAME']
                                                            );
 
                                            $res = $this->users->create_user($hm_user_data, TRUE, $school_data);
                                            /////////////////////

                                            ////////////////////
                                            $user_id = $res['user_id'];
                                            $this->session->set_userdata('user_id', $user_id);
                                           
                                    }else{
                                            $data['errors']['login'] = "Username Unavailable!";
                                            redirect(base_url());
                                            //$this->error = array('username' => 'auth_username_in_use');
                                        }
                                    }
                              /////////////////////////////////////////////////

                              /////////////////////////////////////////////////
                              $_SESSION['username']=$username;

                              $messageStatus=$this->LA->getMessageViewStatus($username); 
                            // echo $this->session->userdata('designation_id');die;        
                              $_SESSION['msgFlag']=$messageStatus;


                             // var_dump($this->session->userdata()); die;
                            
                              if($messageStatus==1)
                               {
                                   $msg=$this->LA->getLoginMessage($this->adminlib->get_hm_id());


                                    $_SESSION['msgT']=$msg;
                                    //echo   $_SESSION['msgT'];die;
                                    
                               }
                                    $user_id = $this->General->getrow("users","id",array("school_code"=>$this->session->userdata("SCHOOL_ID"),"activated"=>1))->id;
                                    $this->session->set_userdata('user_id', $user_id);   
//                                    print_r($this->session->userdata());
//                                    exit;
                                    redirect('School/HM');
                                  //  echo "msg"; var_dump($msg); die;
                                }else{                     
                                    // redirect to login
                                    $data['errors']['login'] = "Login not allowed! Contact Support Team...";
                                    redirect(base_url());
                                }
                                // edit ends - 03-05-2019
                            } else if ($result != "1") { 
                                  
                    
                                                    
                                $data['errors']['password'] = "Invalid Username/Password!";
                                //$data['invalid_ban']= "Sampoorna user doesn't exist.";
                            //    // $loginWrong=$this->LA->getinvalidcount($username);
                            //     if($loginWrong>=3)
                            //     //{
                            //         $this->LA->blockuser($username);
                                    
                            //     }
                              
                            //     $this->getInvalidLogin($username);
                                
                                $data['captcha_img'] = $this->getCaptcha();
                                $this->template->write_view('content', 'home/content_panel', $data);
                                $this->template->load();
                            
                            } else {
                                $data['errors']['login'] = "Login not allowed!";
                            //$this->getInvalidLogin($username);
                            $loginWrong=$this->LA->getinvalidcount($username);
                            if($loginWrong>=3)
                            {
                                $this->LA->blockuser($username);

                            }
                            // echo "line 89";die;
                            //$loginWrong;
                            //die;
                            }
                        
                        
                    } else {
                        $user = $this->users->get_user_by_login($username);
                        is_null($user) && $this->tank_auth->error = array('login' => 'auth_incorrect_login');
                        $is_activated = $this->General->find_record_exists('users','id','activated=1 and banned=0 and username="'.$username.'"');
                        !is_null($user) && !$is_activated && $this->tank_auth->error=array('banned' => 'Banned');

                        if (!is_null($user) && $is_activated && $this->tank_auth->login(
                                        $this->form_validation->set_value('login'), $this->form_validation->set_value('password'), 0, $data['login_by_username'], $data['login_by_email'])) {        // success
                             //getInvalidLogin($login);
                             $loginWrong=$this->LA->getinvalidcount($username);
                             if($loginWrong>=3)
                             {
                              $this->LA->blockuser($username);
                              $data['errors']['login'] = "Login not allowed!";
                           
                             }
                             else
                               {
                                   $this->CM->writeActivityLog($this->session->userdata('user_id'), 1);
                                   //$_SESSION['officeName']="";
                            switch($this->session->userdata('office_id')){

                                case 1000 : 
                                            if($this->session->userdata('user_id') == ITADMIN_USER_ID){
                                              $office="IT ADMIN" ;
                                              $_SESSION['officeName']=$office;
                                            }
                                            else{
                                              $office="SNO" ;
                                              $_SESSION['officeName']=$office;
                                            }

                                            break;
                                case 1001 : 
                                            $office="DGE OFFICE" ;
                                            $_SESSION['officeName']=$office;
                                            if($this->session->userdata('office_block_id')){
                                                $_SESSION['officeBlockName']=$this->session->userdata('office_block_name');
                                            }
                                          
                                            break;
                                case  1002:                                //DDE  
                                            $office="DDE -"  ; 
                                            $revName=$this->General->getrow('master_district', 'district_name', array('district_code' =>$this->session->userdata('district_id') ))->district_name;
                                          
                                            $_SESSION['officeName']=$office." ".$revName;
                                            
                                            break;
                                case  1006 :  
                                            $office="DEO - ";
                                            $eduName=$this->General->getrow('master_edudistricts', 'edu_district_name', array('id' =>$this->session->userdata('edudistrict_id') ))->edu_district_name;
                                          
                                            $_SESSION['officeName']=$office." ".$eduName;
                                            
                                            break;
                                case  1007 :  
                                            $office="AEO - "; 
                                            $subName=$this->General->getrow('master_subdistricts', 'sub_district_name', array('id' =>$this->session->userdata('subdistrict_id') ))->sub_district_name;
                                            
                                            $_SESSION['officeName']=$office." ".$subName;
                                            
                                            // 
                                            break;
                                case 1013 : if(hasStateAdminPermission()){
                                                  $office="STATE ADMIN" ;
                                                  $_SESSION['officeName']=$office;
                                              }
                                              else{
                                                  $office="DNO - " ;
                                                  $revName=get_dist_name_by_id($this->session->userdata('district_id'));
                                                  $_SESSION['officeName']=$office." ".$revName;
                                              }
                                          
                                            break;
                                case 1014 : 
                                            $office="Super Check Cell" ;
                                            $zone=get_supercheck_office_name($this->session->userdata('zone_id'));
                                            $_SESSION['officeName']=$office." - ".$zone;
                                                                               
                                            break;
                                case 1015 : 
                                            $office="Law Office" ;
                                            $_SESSION['officeName']=$office;
                                                                                
                                            break;
                                case 1016 : 
                                            $office="Secretariat" ;
                                            $_SESSION['officeName']=$office;
                                                                                
                                            break;
                                

                                default:  
                                          $_SESSION['officeName']="";
                                          break;

                            }
                            
                            
                                $this->LA->clearInvalidLogin($username);
                                $messageStatus=$this->LA->getMessageViewStatus($username);
                                //$this->output->enable_profiler(TRUE);
                              $_SESSION['msgFlag']=$messageStatus;
                              if($messageStatus==1)
                               {
                                   $msg=$this->LA->getLoginMessage($this->session->userdata('designation_id'));
                                 
                                   
                                     $_SESSION['msgT']=$msg;
                                       // echo   $_SESSION['msgText'];die;
                                    
                               }
                               $_SESSION['username']=$username;

                               //DIGITAL SIG SESSION SET
                            //    $loginzToken= loginRequest(DSIGN_EMAIL,DSIGN_PASS);
                            //    $this->session->set_userdata('access_token', $loginzToken->access_token);

                               $responseArray = getDSignCertificate(); 
                                if($responseArray->certificate == ''){
                                    $this->session->set_userdata('dsign_registered',0);
                                }elseif ($responseArray->certificate != '') {
                                    $this->session->set_userdata('dsign_registered',1);
                                }
                             
                               // echo $_SESSION['msgFlag'];
                             // die;
                             if($this->session->userdata('user_type') == 'MANAGER'){
                                $this->session->set_flashdata('showIncompleteAlertAuth', 1);
                            }else{
                                $role_id = $this->session->userdata('designation_id');
                                $user_group_id = $this->session->userdata('usergroup_id');
                                $master_officeid = $this->session->userdata('office_id');
                                $officeid = $this->adminlib->get_office_id();
                                $reminder_exist = $this->General->find_record_exists('notification_recipients','id','notification_type=1
                                and role_id='.$role_id.' and usergroup_id='.$user_group_id.' and master_officeid='.$master_officeid.' and office_id ='.$officeid.' and is_read=0 and created_at="'.date('Y-m-d').'"');
                                if($reminder_exist == 1){
                                    $this->session->set_flashdata('showHearingReminderAuth', 1);
                                }
                            }
                        
                            
                             redirect('');
                            
                              
                               }
                             
                        } else {
                            $errors = $this->tank_auth->get_error_message();
                            $is_activated && $this->getInvalidLogin($username);
                            $loginWrong=$this->LA->getinvalidcount($username);
                            if($loginWrong>=3)
                           {
                            $this->LA->blockuser($username);
                            
                           }
                            foreach ($errors as $k => $v)
                                $data['errors'][$k] = $this->lang->line($v);

                            $data['captcha_img'] = $this->getCaptcha();
                            $this->template->write_view('content', 'home/content_panel', $data);
                            $this->template->load();

                        }
                    }
                }
            } else {
                //login success  
               // echo "line 120";die;

                $data['captcha_img'] = $this->getCaptcha();
                $this->template->write_view('content', 'home/content_panel', $data);
                $this->template->load();
            }
        }
    }
    
    function resetPasswordByEmail()
    {
        $this->load->view('auth/reset_password');

    }

    function getCaptcha(){
    if(isCaptchaEnabled()){
      $filename = $this->session->userdata('cap_file');
      if(isset($filename)){
        unlink('uploads/captcha/'.$filename);
      }
      $uploadpath = 'uploads/captcha/';
            if (!is_dir($uploadpath)) {
                mkdir($uploadpath, 0777, TRUE);
            }
        $config = array(
          'img_url' => base_url() .$uploadpath,
          'img_path' => $uploadpath,
          'img_height' => 30,
          'word_length' => 5,
          'img_width' => 120,
          'font_size' => 18
          );
        $cap = create_captcha($config);
        $this->session->set_userdata(array('captcha'=>$cap['word'],'cap_file'=>$cap['filename']));
        if($this->input->post('is_ajax') && $this->input->post('is_ajax') == 1)
          echo $cap['image'];
        else
          return $cap['image'];
      }
    }

    public function validate_captcha(){
          if($this->input->post('captcha_txt') != $this->session->userdata('captcha'))
          {
              $this->form_validation->set_message('validate_captcha', 'Wrong captcha code, hmm are you the Terminator?');
              return false;
          }else{
              return true;
          }

      }
    function verifyUser()
    {
        $PEN=$this->input->post('pen');
        $phone=$this->input->post('phone');
        $user=$this->LA->getUserAccount($PEN,$phone);
        $banReason=$this->LA->getBanReason($PEN);
       
        if($banReason=="Too many invalid login")//banned for invalid login
              { $in=$this->LA->emailInvalidCountClear($PEN);}
       
    if($user!=0)
     {
        //masking email
       
        $email=$user['email'];
        // echo $user['email'];//exit;
        $mail_part = explode("@", $email);
        $mail_part[0] = str_replace(substr($email,1,3),"******" ,$mail_part[0]);
       

        $mailMasked=implode("@", $mail_part);
        $data['maskedmail']=$mailMasked;
        $_SESSION['name']=$user['name'];
        $_SESSION['mail']=$email;
        $_SESSION['pen']=$PEN;
        $this->load->view('auth/email_confirm',$data);


     }
     else
     {
        $data['error']="<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h4><i class='icon fa fa-ban'></i> User Not Found!</h4> The user details you entered doesn't match with the records . Please use the username & phone no. related with the account</div>";
        $this->load->view('auth/reset_password',$data);
     }
    
        

        
    }

    function verifyOtpType()
    {
        $PEN=$this->input->post('pen');
        $phone=$this->input->post('phone');
        $user=$this->LA->getUserAccount($PEN,$phone);
        $banReason=$this->LA->getBanReason($PEN);
       
        if($banReason=="Too many invalid login")//banned for invalid login
              { $in=$this->LA->emailInvalidCountClear($PEN);}
        if($banReason && $banReason != 'Too many invalid login'){
            $data['error']="<div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
            <h4><i class='icon fa fa-ban'></i> User Banned by Authority</h4> The user is currently banned by the authority . <br>For more information please contact the corresponding office. </div>";
            $this->load->view('auth/reset_password',$data);
            return;
        } 
       
    if($user!=0)
     {
        //masking email
       
        $email=$user['email'];
        // echo $user['email'];//exit;
        $mail_part = explode("@", $email);
        $mail_part[0] = str_replace(substr($email,1,3),"******" ,$mail_part[0]);
       

        $mailMasked=implode("@", $mail_part);
        $data['maskedmail']=$mailMasked;
        $_SESSION['name']=$user['name'];
        $_SESSION['mail']=$email;
        $_SESSION['pen']=$PEN;
        $data['PEN'] = $PEN;
        $data['phone'] = $phone;
        $this->load->view('auth/sms_confirm',$data);


     }
     else
     {
        $data['error']="<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h4><i class='icon fa fa-ban'></i> User Not Found!</h4> The user details you entered doesn't match with the records . Please use the username & phone no. related with the account</div>";
        $this->load->view('auth/reset_password',$data);
     }
    
        

        
    }
 
    function testmail(){
   
   
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://mail.kite.kerala.gov.in',
            'smtp_port' => 465,
            'smtp_user' => 'samanwaya@kite.kerala.gov.in',
            'smtp_pass' => 'k1T3@2020',
            'mailtype'  => 'html', 
            
           
        ); 
                    $this->load->library('email'); 
                    $this->email->initialize($config);
                    $this->load->library('encrypt');
                    $this->email->to("samanwaya.server@gmail.com");            
        
                     $htmlContent= "Hi, <B>HELLO</B>...Welcome";
          
                    $this->email->from('samanwaya@kite.kerala.gov.in', 'noreply@samnwayasupport');
                    $this->email->subject('Password Reset');
                    $this->email->message($htmlContent);
                  //  echo $htmlContent;exit;
                   // $this->email->print_debugger(); 
                    $res = $this->email->send();
                    echo $res."<br>";
                    if($res) echo "success";
                    else echo "failed".$this->email->print_debugger();
        
                    $this->email->to('samanwaya@kite.kerala.gov.in');
                    $htmlContent="Dear Sir/Madam,<br/>";
                    $htmlContent=$htmlContent."<p> Password reset request from ";
                    $htmlContent=$htmlContent."<br/>has been processed.Request was from IP ".$_SERVER['REMOTE_ADDR']."<p>Thanks and Regards </p><p> Samanwaya Team</p>";
                    
                    $this->email->from('samanwaya@kite.kerala.gov.in', 'noreply@samnwayasupport');
                    $this->email->subject('Password Reset');
                    $this->email->message($htmlContent);
                  //  echo $htmlContent;exit;
                   // $this->email->print_debugger(); 
                    $this->email->send();
                    
         }
         
    function sendResetMail()
    {
      
        $email=$this->input->post('email');
        // echo " ".$email."= ".$_SESSION['mail'].($email==$_SESSION['mail']);exit;
        if(trim($email)==trim($_SESSION['mail']))
         {
            $random=mt_rand(1000,9999);
            $this->itschool_rbac->reset_password_by_username($_SESSION['pen'], $random);
            $this->LA->initLoginEnable($_SESSION['pen']);
	

// $config = Array(
//     'protocol' => 'smtp',
//     'smtp_host' => 'ssl://smtp.gmail.com',
//     'smtp_port' => 465,
//     'smtp_user' => 'samanwaya.server@gmail.com',
//     'smtp_pass' => 'k1T3@2018',
//     'mailtype'  => 'html', 
    
   
//); 

//$config = Array(
//    'protocol' => 'smtp',
//    'smtp_host' => 'ssl://mail.kite.kerala.gov.in',
//    'smtp_port' => 465,
//    'smtp_user' => 'samanwaya@kite.kerala.gov.in',
//    'smtp_pass' => 'k1T3@2020',
//    'mailtype'  => 'html',        
//); 
$config = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://mail.kite.kerala.gov.in',
    'smtp_port' => 465,
    'smtp_user' => 'noreply@kite.kerala.gov.in',
    'smtp_pass' => 'N0reply@2023',
    'mailtype'  => 'html',        
);

            $this->load->library('email'); 
            $this->email->initialize($config);
            $this->load->library('encrypt');
            $this->email->to($_SESSION['mail']); 

            $maildata['pen']=$_SESSION['pen'];
            $maildata['pwd']=$random;


             $htmlContent= $this->load->view('email/password_reset_html', $maildata,true);
  
//          $this->email->from('samanwaya@kite.kerala.gov.in', 'noreply@samnwayasupport');
            $this->email->from('noreply@kite.kerala.gov.in','Samanwaya Support');
            $this->email->subject('Samanwaya Password Reset');
            $this->email->message($htmlContent);
          //  echo $htmlContent;exit;
           // $this->email->print_debugger(); 
            $this->email->send();

            $this->email->to('samanwaya@kite.kerala.gov.in');
            $htmlContent="Dear Sir/Madam,<br/>";
            $htmlContent=$htmlContent."<p> Password reset request from ".$_SESSION['pen'];
            $htmlContent=$htmlContent."<br/>has been processed.Request was from IP ".$_SERVER['REMOTE_ADDR']."<p>Thanks and Regards </p><p> Samanwaya Team</p>";
            $this->email->from('noreply@kite.kerala.gov.in','Samanwaya Support');
           // $this->email->from('samanwaya@kite.kerala.gov.in', 'noreply@samnwayasupport');
            $this->email->subject('Password Reset');
            $this->email->message($htmlContent);
          //  echo $htmlContent;exit;
           // $this->email->print_debugger(); 
            $this->email->send();
           
            
               $data = array("status" => "ok", "message"=> "Success ");  
           
             

            echo json_encode($data);  
          // echo ('New Password has mailed to your id');
          return;

         }
         else
         {
            //echo  ('E-mail id not verified');
            $data = array("status" => "failed", "message"=> "Failed ");  
            echo json_encode($data);  
            return;
         }       
    }



    /**
     * Get Login Log
     * added by jomon
     * @return void
     */
    function getInvalidLogin($login)
    {
        $proxy="";
        $device="Not identified";
        $protocol = $_SERVER['SERVER_PROTOCOL'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $port = $_SERVER['REMOTE_PORT'];
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $ref = $_SERVER['HTTP_REFERER'];
        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); 
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
         $proxy= $_SERVER['HTTP_X_FORWARDED_FOR'];
         $user_agent = $_SERVER['HTTP_USER_AGENT'];
         $os_platform    = "Unknown OS Platform";
         $os_array       = array('/Windows NT 10.0/i'    =>  'Windows 10',
                                 '/windows phone 8/i'    =>  'Windows Phone 8',
                                 '/windows phone os 7/i' =>  'Windows Phone 7',
                                 '/windows nt 6.3/i'     =>  'Windows 8.1',
                                 '/windows nt 6.2/i'     =>  'Windows 8',
                                 '/windows nt 6.1/i'     =>  'Windows 7',
                                 '/windows nt 6.0/i'     =>  'Windows Vista',
                                 '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                 '/windows nt 5.1/i'     =>  'Windows XP',
                                 '/windows xp/i'         =>  'Windows XP',
                                 '/windows nt 5.0/i'     =>  'Windows 2000',
                                 '/windows me/i'         =>  'Windows ME',
                                 '/win98/i'              =>  'Windows 98',
                                 '/win95/i'              =>  'Windows 95',
                                 '/win16/i'              =>  'Windows 3.11',
                                 '/macintosh|mac os x/i' =>  'Mac OS X',
                                 '/mac_powerpc/i'        =>  'Mac OS 9',
                                 '/linux/i'              =>  'Linux',
                                 '/ubuntu/i'             =>  'Ubuntu',
                                 '/iphone/i'             =>  'iPhone',
                                 '/ipod/i'               =>  'iPod',
                                 '/ipad/i'               =>  'iPad',
                                 '/android/i'            =>  'Android',
                                 '/blackberry/i'         =>  'BlackBerry',
                                 '/webos/i'              =>  'Mobile');
                                 $found = false;
                                 foreach ($os_array as $regex => $value) 
                                 { 
                                     if($found)
                                      break;
                                     else if (preg_match($regex, $user_agent)) 
                                     {
                                         $os_platform    =   $value;
                                         $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
                                                   ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'COMPUTER');
                                     }
                                 }
                                 $device = !$device? 'COMPUTER':$device;
     
                              foreach ($os_array as $regex => $value) 
                              { 
                                  if($found)
                                   break;
                                  else if (preg_match($regex, $user_agent)) 
                                  {
                                      $os_platform    =   $value;
                                      $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
                                                ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'COMPUTER');
                                  }
                              }
                              $device = !$device? 'COMPUTER':$device;
                             // return array('os'=>$os_platform,'device'=>$device);
                            $OS=$os_platform;

                           // echo $OS;die;
                           $user_agent = $_SERVER['HTTP_USER_AGENT'];

                           $browser        =   "Unknown Browser";
                       
                           $browser_array  = array('/msie/i'       =>  'Internet Explorer',
                                                   '/firefox/i'    =>  'Firefox',
                                                   '/safari/i'     =>  'Safari',
                                                   '/chrome/i'     =>  'Chrome',
                                                   '/opera/i'      =>  'Opera',
                                                   '/netscape/i'   =>  'Netscape',
                                                   '/maxthon/i'    =>  'Maxthon',
                                                   '/konqueror/i'  =>  'Konqueror',
                                                   '/mobile/i'     =>  'Handheld Browser');
                       
                           foreach ($browser_array as $regex => $value) 
                           { 
                               if($found)
                                break;
                               else if (preg_match($regex, $user_agent,$result)) 
                               {
                                   $browser    =   $value;
                               }
                           }
                            $this->LA->storeip($ip,$login,$OS,$device,$browser);
                            if($this->LA->updateInvalidCount($login) >=3){
                                $email_data = array();
                                $email_data['ip'] = $ip;
                                $email_data['OS'] = $OS;
                                $email_data['browser'] = $browser;
                                $email_data['date']   = date("d/m/Y h:i A");
                                $email_data['notification_msg'] = 'Too many invalid login attempts';
                                $user_id = getUserId($login);
                                $email = get_email($user_id);
                                $this->CM->sendMail($email,'Account Security Alert',$this->load->view('email/reset_password_success',$email_data,TRUE));
                            }
                            

                           // $this->LA->
           //  $this->db->insert($this->table_name, array('ip_address' => $ip_address, 'login' => $login,'OS'=>$OS));
     
       //  echo $protocol." ".$ip." ".$port." ".$agent." ".$ref." ".$hostname." ".$proxy ;die;
    }
    /**
     * Logout user
     *
     * @return void
     */
    function logout() {
        //
        $this->CM->writeActivityLog($this->session->userdata('user_id'), 2);
        //
        $this->tank_auth->logout();
        session_destroy();
        $this->_show_message($this->lang->line('auth_message_logged_out'));
    }

    /**
     * Register user on the site
     *
     * @return void
     */
    function register() {
        if ($this->tank_auth->is_logged_in()) {         // logged in
            redirect('');
        } elseif ($this->tank_auth->is_logged_in(FALSE)) {      // logged in, not activated
            redirect('/auth/send_again/');
        } elseif (!$this->config->item('allow_registration', 'tank_auth')) { // registration is off
            $this->_show_message($this->lang->line('auth_message_registration_disabled'));
        } else {
            $use_username = $this->config->item('use_username', 'tank_auth');
            if ($use_username) {
                $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[' . $this->config->item('username_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('username_max_length', 'tank_auth') . ']|alpha_dash');
            }
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

            $captcha_registration = $this->config->item('captcha_registration', 'tank_auth');
            $use_recaptcha = $this->config->item('use_recaptcha', 'tank_auth');
            if ($captcha_registration) {
                if ($use_recaptcha) {
                    $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
                } else {
                    $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
                }
            }
            $data['errors'] = array();
            $email_activation = $this->config->item('email_activation', 'tank_auth');
            if ($this->form_validation->run()) {        // validation ok
                if (!is_null($data = $this->tank_auth->create_user(
                                $use_username ? $this->form_validation->set_value('username') : '', $this->form_validation->set_value('email'), $this->form_validation->set_value('password'), $email_activation))) {         // success
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                    if ($email_activation) {         // send "activate" email
                        $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                        $this->_send_email('activate', $data['email'], $data);

                        unset($data['password']); // Clear password (just for any case)

                        $this->_show_message($this->lang->line('auth_message_registration_completed_1'));
                    } else {
                        if ($this->config->item('email_account_details', 'tank_auth')) { // send "welcome" email
                            $this->_send_email('welcome', $data['email'], $data);
                        }
                        unset($data['password']); // Clear password (just for any case)

                        $this->_show_message($this->lang->line('auth_message_registration_completed_2') . ' ' . anchor('/auth/login/', 'Login'));
                    }
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            if ($captcha_registration) {
                if ($use_recaptcha) {
                    $data['recaptcha_html'] = $this->_create_recaptcha();
                } else {
                    $data['captcha_html'] = $this->_create_captcha();
                }
            }
            $data['use_username'] = $use_username;
            $data['captcha_registration'] = $captcha_registration;
            $data['use_recaptcha'] = $use_recaptcha;
            $this->load->view('auth/register_form', $data);
        }
    }

    /**
     * Send activation email again, to the same or new email address
     *
     * @return void
     */
    function send_again() {
        if (!$this->tank_auth->is_logged_in(FALSE)) {       // not logged in or activated
            redirect('/auth/login/');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if (!is_null($data = $this->tank_auth->change_email(
                                $this->form_validation->set_value('email')))) {   // success
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                    $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                    $this->_send_email('activate', $data['email'], $data);

                    $this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            //$this->load->view('auth/send_again_form', $data);
            redirect('secured_user/User');
        }
    }

    /**
     * Activate user account.
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function activate() {
        $user_id = $this->uri->segment(3);
        $new_email_key = $this->uri->segment(4);

        // Activate user
        if ($this->tank_auth->activate_user($user_id, $new_email_key)) {  // success
            $this->tank_auth->logout();
            $this->_show_message($this->lang->line('auth_message_activation_completed') . ' ' . anchor('/auth/login/', 'Login'));
        } else {                // fail
            $this->_show_message($this->lang->line('auth_message_activation_failed'));
        }
    }

    /**
     * Generate reset code (to change password) and send it to user
     *
     * @return void
     */
    function forgot_password() {
        if ($this->tank_auth->is_logged_in()) {         // logged in
            redirect('');
        } elseif ($this->tank_auth->is_logged_in(FALSE)) {      // logged in, not activated
            redirect('/auth/send_again/');
        } else {
            $this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if (!is_null($data = $this->tank_auth->forgot_password(
                                $this->form_validation->set_value('login')))) {

                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                    // Send email with password activation link
                    $this->_send_email('forgot_password', $data['email'], $data);

                    //$this->_show_message($this->lang->line('auth_message_new_password_sent'));
                    $this->session->set_flashdata('flashSuccess', $this->lang->line('auth_message_new_password_sent'));
                    redirect('Auth/login');
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            //$this->load->view('auth/forgot_password_form', $data);
            $this->template->write_view('content', 'auth/forgot_password_form', $data);
            $this->template->load();
        }
    }
    /****************************
     * function to hide messages
     */
    function neverShow()
    {  
          
         $id=$this->input->post('id');
         
          $this->LA-> nevershowmessage($id);
         
          return 200;
    }
   
    /**
     * Password Reset custom function as the existing tank autth not works 
     * 
    */

    function resetInitPassword()
    {
        // print_r($this->session);
        $username=$this->session->userdata('username');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|_notMatch['.$username.']|min_length[8]|strong_pass');
        function _notMatch( $password,$username){
            //  echo $password." ".$username;exit;
             if($username == $password){
                 //$this->form_validation->set_message('_notMatch', 'Username and password should be different');
                 return FALSE;
             }
            unset($_SESSION['passreset']);
             return TRUE;

          
         }
        function strong_pass($password)
        {
            if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $password)) {
                return FALSE;
            }
            else
               return TRUE;

        }

         $this->form_validation->set_message('_notMatch', 'Password and Username should be different');
         $this->form_validation->set_message('notMatch', 'Password and Username should be different');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');
         
        
        if ($this->form_validation->run()) {
            $newpassword=$this->form_validation->set_value('new_password');

            $this->itschool_rbac->reset_password_by_username($username, $this->input->post('new_password'));
            $this->LA->passwordFlagChange($username);
            
              
            
            $this->session->set_flashdata('success','Password Updated .Login again' );
            redirect('Auth/logout');
        }
        else
        {
            //$this->session->set_flashdata('error','Password and Confirm Password should match.' );
            $_SESSION['error']=1;
            
            redirect('Auth/reset_password_form_init');   
        }

       // echo $username;die;
    }
    /**
     * Re
     * place user password (forgotten) with a new one (set by user).
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function reset_password() {

        $user_id = $this->uri->segment(3);
        $new_pass_key = $this->uri->segment(4);
 
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

        $data['errors'] = array();

        if ($this->form_validation->run()) {        // validation ok
            if (!is_null($data = $this->tank_auth->reset_password(
                            $user_id, $new_pass_key, $this->form_validation->set_value('new_password')))) { // success
                $data['site_name'] = $this->config->item('website_name', 'tank_auth');
               
                // Send email with new password
                $this->_send_email('reset_password', $data['email'], $data);
                
                //$this->_show_message($this->lang->line('auth_message_new_password_activated') . ' ' . anchor('/auth/login/', 'Login'));
                $this->session->set_flashdata('flashSuccess', $this->lang->line('auth_message_new_password_activated') . ' ' . anchor('/auth/login/', 'Click here to login'));
            } else {              // fail
                //$this->_show_message($this->lang->line('auth_message_new_password_failed'));
                $this->session->set_flashdata('flashSuccess', $this->lang->line('auth_message_new_password_failed'));
            }
        } else {
            // Try to activate user by password key (if not activated yet)
            if ($this->config->item('email_activation', 'tank_auth')) {
                $this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
            }

            if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
                $this->_show_message($this->lang->line('auth_message_new_password_failed'));
            }
        }
        //$this->load->view('auth/reset_password_form', $data);
        $this->template->write_view('content', 'auth/reset_password_form', $data);
        $this->template->load();
    }

    /**
     * Change user password
     *
     * @return void
     */
    function change_password() {
        if (!$this->tank_auth->is_logged_in()) {        // not logged in or not activated
            redirect('/auth/login/');
        } else {
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
            $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if ($this->tank_auth->change_password(
                                $this->form_validation->set_value('old_password'), $this->form_validation->set_value('new_password'))) { // success
                    $this->_show_message($this->lang->line('auth_message_password_changed'));
                } else {              // fail
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            
            $this->load->view('auth/change_password_form', $data);
        }
    }

    /**
     * Change user email
     *
     * @return void
     */
    function change_email() {
        if (!$this->tank_auth->is_logged_in()) {        // not logged in or not activated
            redirect('/auth/login/');
        } else {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if (!is_null($data = $this->tank_auth->set_new_email(
                                $this->form_validation->set_value('email'), $this->form_validation->set_value('password')))) {   // success
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                    // Send email with new email address and its activation link
                    $this->_send_email('change_email', $data['new_email'], $data);

                    $this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            $this->load->view('auth/change_email_form', $data);
        }
    }

    /**
     * Replace user email with a new one.
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function reset_email() {
        $user_id = $this->uri->segment(3);
        $new_email_key = $this->uri->segment(4);

        // Reset email
        if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) { // success
            $this->tank_auth->logout();
            $this->_show_message($this->lang->line('auth_message_new_email_activated') . ' ' . anchor('/auth/login/', 'Login'));
        } else {                // fail
            $this->_show_message($this->lang->line('auth_message_new_email_failed'));
        }
    }

    /**init
     * Delete user from the site (only when user is logged in)
     *
     * @return void
     */
    function unregister() {
        if (!$this->tank_auth->is_logged_in()) {        // not logged in or not activated
            redirect('/auth/login/');
        } else {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if ($this->tank_auth->delete_user(
                                $this->form_validation->set_value('password'))) {  // success
                    $this->_show_message($this->lang->line('auth_message_unregistered'));
                } else {              // fail
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            $this->load->view('auth/unregister_form', $data);
        }
    }

    /**
     * Show info message
     *
     * @param	string
     * @return	void
     */
    function _show_message($message) {
        $this->session->set_flashdata('message', $message);
        redirect('/auth/');
    }

    /**
     * Send email message of given type (activate, forgot_password, etc.)
     *
     * @param	string
     * @param	string
     * @param	array
     * @return	void
     */
    function _send_email($type, $email, &$data) {
        $this->load->library('email');

        $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
        $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
        $this->email->to($email);
        $this->email->subject(sprintf($this->lang->line('auth_subject_' . $type), $this->config->item('website_name', 'tank_auth')));
        $this->email->message($this->load->view('email/' . $type . '-html', $data, TRUE));
        $this->email->set_alt_message($this->load->view('email/' . $type . '-txt', $data, TRUE));
        $this->email->send();
    }

    /**
     * Create CAPTCHA image to verify user as a human
     *
     * @return	string
     */
    function _create_captcha() {
        $this->load->helper('captcha');

        $cap = create_captcha(array(
            'img_path' => './' . $this->config->item('captcha_path', 'tank_auth'),
            'img_url' => base_url() . $this->config->item('captcha_path', 'tank_auth'),
            'font_path' => './' . $this->config->item('captcha_fonts_path', 'tank_auth'),
            'font_size' => $this->config->item('captcha_font_size', 'tank_auth'),
            'img_width' => $this->config->item('captcha_width', 'tank_auth'),
            'img_height' => $this->config->item('captcha_height', 'tank_auth'),
            'show_grid' => $this->config->item('captcha_grid', 'tank_auth'),
            'expiration' => $this->config->item('captcha_expire', 'tank_auth'),
        ));

        // Save captcha params in session
        $this->session->set_flashdata(array(
            'captcha_word' => $cap['word'],
            'captcha_time' => $cap['time'],
        ));

        return $cap['image'];
    }

    /**
     * Callback function. Check if CAPTCHA test is passed.
     *
     * @param	string
     * @return	bool
     */
    function _check_captcha($code) {
        $time = $this->session->flashdata('captcha_time');
        $word = $this->session->flashdata('captcha_word');

        list($usec, $sec) = explode(" ", microtime());
        $now = ((float) $usec + (float) $sec);

        if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
            $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
            return FALSE;
        } elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
                $code != $word) OR
                strtolower($code) != strtolower($word)) {
            $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Create reCAPTCHA JS and non-JS HTML to verify user as a human
     *
     * @return	string
     */
    function _create_recaptcha() {
        $this->load->helper('recaptcha');

        // Add custom theme so we can get only image
        $options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

        // Get reCAPTCHA JS and non-JS HTML
        $html = recaptcha_get_html($this->config->item('6Lc0Cp0UAAAAAHNrnXAl7nRqS9tI5m2SKJ6ydUNU', 'tank_auth'));

        return $options . $html;
    }

    /**
     * Callback function. Check if reCAPTCHA test is passed.
     *
     * @return	bool
     */
    function _check_recaptcha() {
        $this->load->helper('recaptcha');

        $resp = recaptcha_check_answer($this->config->item('6Lc0Cp0UAAAAAFfrM8kRhAszpi8BxpK5Ktkz7xVx', 'tank_auth'), $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

        if (!$resp->is_valid) {
            $this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
            return FALSE;
        }
        return TRUE;
    }

    /**
     * permission denieded message when a user try to access a page he has not been permitted
     */
    function permission() {
        $this->session->set_flashdata('flashWarning', 'Permission denied');
        redirect('secured_user/User');
        //$this->_show_message("Permission denieded")
    }

    function check_sampoorna_school($username, $password) {
        // $host = 'https://sampoornaapi.kite.kerala.gov.in';
        // $curl_handle = curl_init();
        // curl_setopt($curl_handle, CURLOPT_URL, $host . '/index.php/api/authenticateUser/format/json');
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl_handle, CURLOPT_POST, 1);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
        //     'username' => $username,
        //     'password' => $password
        // ));
        // curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        // $user = curl_exec($curl_handle);
        // curl_close($curl_handle);
        $postdata = http_build_query(
            array("username"=>$username,'password'=>$password)
          );
          
          $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
          );
          
          $context  = stream_context_create($opts);
          
          $user = file_get_contents('https://sampoornaapi.kite.kerala.gov.in/index.php/api/authenticateUser/format/json', false, $context);
        $result = json_decode($user);

        if(!isSampoornnaEnabled()){

            $school_code = $username;
            $school_id = $this->General->getdata("schools", 'id', array("school_code"=>$school_code,'is_active'=>1));
            $school_id = @$school_id[0]['id'];
            $result->status = "success123";

            if (@$result->status == "success123") {
                    @$data = $this->get_school_details($school_id);
                    if (@$data['finance_type'] == 1 || @$data['finance_type'] == 3) {

                            $set_session_data = array('SCHOOL_ID' => $school_id,
                                'user_id' => 999999,
                                'SCHOOL_CODE' => $data['code'],
                                'SCHOOL_NAME' => $data['name'],
                                'USER_GROUP' => 'SAMPOORNA',
                                'user_type' => 5,
                                'FINANCE_TYPE' => $data['finance_type'],
                                'LEVEL' => $data['level_type'],
                                'CLASS' => $data['course_ids'],
                                'REV_DISTRICT_CODE' => $data['district'],
                                'EDU_DISTRICT_CODE' => $data['edu_district'],
                                'SUB_DISTRICT_CODE' => $data['sub_district'],
                                'USER_NAME' => $username,
                                'name' => $data['name'],
                                'status' => 1
                                );
                            $this->session->set_userdata($set_session_data);
                            return 1;
                        
                    } else {
                        return 0;
                    }
                
            } 
        }

            /*Temporary code for testing commented for Gokul MU*/ 
        
        if (@$result->status == "success") {
            foreach ($result->loginDetails as $row) {
                $schoolAdmin = $row->admin;
                $data = $this->get_school_details($row->school_id);

                if ($data['finance_type'] == 1 || $data['finance_type'] == 3) {
                    if ($schoolAdmin) {
                        $set_session_data = array('SCHOOL_ID' => $row->school_id,
                            'user_id' => 999999,
                            'SCHOOL_CODE' => $data['code'],
                            'SCHOOL_NAME' => $data['name'],
                            'USER_GROUP' => 'SAMPOORNA',
                            'user_type' => 5,
                            'FINANCE_TYPE' => $data['finance_type'],
                            'LEVEL' => $data['level_type'],
                            'CLASS' => $data['course_ids'],
                            'REV_DISTRICT_CODE' => $data['district'],
                            'EDU_DISTRICT_CODE' => $data['edu_district'],
                            'SUB_DISTRICT_CODE' => $data['sub_district'],
                            'USER_NAME' => $username,
                            'name' => $data['name'],
                            'status' => 1);
            
                        $this->session->set_userdata($set_session_data);
                        return 1;
                    }
                } else {
                    return 0;
                }
            }
        } else {
            return 2;
        }
    }

    function check_sampoorna_school_in_samanwaya($username, $password) {
        
            /*Temporary code for testing commented for Gokul MU*/ 

        $sampoorna_dtls = $this->General->getrow('sampoorna_users','*',array('username'=>$username));
        
        if ($sampoorna_dtls) {
            if($sampoorna_dtls->hashed_password == sha1($sampoorna_dtls->salt.$password)){
                    $data = $this->get_school_details($sampoorna_dtls->school_id);
                    if ($data['finance_type'] == 1 || $data['finance_type'] == 3) {
                        $set_session_data = array('SCHOOL_ID' => $sampoorna_dtls->school_id,
                            'user_id' => 999999,
                            'SCHOOL_CODE' => $data['code'],
                            'SCHOOL_NAME' => $data['name'],
                            'USER_GROUP' => 'SAMPOORNA',
                            'user_type' => 5,
                            'FINANCE_TYPE' => $data['finance_type'],
                            'LEVEL' => $data['level_type'],
                            'CLASS' => $data['course_ids'],
                            'REV_DISTRICT_CODE' => $data['district'],
                            'EDU_DISTRICT_CODE' => $data['edu_district'],
                            'SUB_DISTRICT_CODE' => $data['sub_district'],
                            'USER_NAME' => $username,
                            'name' => $data['name'],
                            'status' => 1);
            
                        $this->session->set_userdata($set_session_data);
                        return 1;
                } else {
                    return 0;
                }
            }else{
                return 0;
            }
        } else {
            return 2;
        }
    }
    

    function get_school_details($school_id) {
        $details = $this->General->getrow('schools', 'school_name,school_code,revenue_district_id, sub_district_id, edu_district_id', array('id' => $school_id));
        $type = $this->General->getrow('school_details', 'school_finance_type_id,school_type_id', array('school_id' => $school_id));
        $levelid = $this->General->getrow('school_types', 'school_level_id', array('id' => $type->school_type_id));
        $level = $this->General->getrow('school_levels', 'course_ids,level_type', array('id' => $levelid->school_level_id));
        return array('name' => @$details->school_name, 'code' => @$details->school_code, 'district' => @$details->revenue_district_id, 'finance_type' => @$type->school_finance_type_id, 'course_ids' => @$level->course_ids, 'level_type' => @$level->level_type, 'sub_district' => @$details->sub_district_id, 'edu_district' => @$details->edu_district_id);
    }

    function faqs() {
        $data = array();
        $this->template->write_view('content', 'home/faqs', $data);
        $this->template->load();
    }

    function latestnews() {
        $data = array();
        $data['news'] = $this->General->getdata('cp_news', '*', '', 'priority DESC');
        $this->template->write_view('content', 'home/latestnews', $data);
        $this->template->load();
    }

    function downloads() {
        $data = array();
        $data['circulars'] = $this->General->getdata('cp_circulars_downloads', '*', '', 'priority DESC');
        $this->template->write_view('content', 'home/downloads', $data);
        $this->template->load();
    }

    function contacts() {
        $data = array();
        $this->template->write_view('content', 'home/contacts', $data);
        $this->template->load();
    }

    function about() {
        $data = array();
        $this->template->write_view('content', 'home/about', $data);
        $this->template->load();
    }

    function check_school_exist($school_id){
        $rows = $this->General->is_record_exists('schools', 'id='.$school_id);
        return $rows;
    }

    function check_user_exist($username){
        $username = strtolower($username);
        $rows = $this->General->is_record_exists('users', "username='".$username."'");
        return $rows;
    }
    
    function fetch__userid_by_username($username){
        $username = strtolower($username);
        $user = $this->General->getrow('users', 'id', array('username'=>$username));
        return $user->id;
    }
    // edit ends on 06-05-2019
    
    function test(){
        $this->load->view('email/password_reset_html');
    }

    function check_sampoorna_test($username='admin@40304', $password='anchalglps') {
        $host = 'https://sampoornaapi.kite.kerala.gov.in';
        $posts = array('username'=>$username,'password'=>$password);
        $post_array = http_build_query($posts);
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $host . '/index.php/api/authenticateUser/format/json');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
        //     'username' => 'admin@40304',
        //     'password' => 'anchalglps'
        // ));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,$post_array);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false); 
	    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, 1);
        $user = curl_exec($curl_handle);
        curl_close($curl_handle);
        $result = json_decode($user);
        echo '<pre>'; print_r($result); echo '</pre>';

        if(!isSampoornnaEnabled()){

            $school_code = $username;
            $school_id = $this->General->getdata("schools", 'id', array("school_code"=>$school_code,'is_active'=>1));
            $school_id = @$school_id[0]['id'];
            $result->status = "success123";

            if (@$result->status == "success123") {
                    @$data = $this->get_school_details($school_id);
                    if (@$data['finance_type'] == 1 || @$data['finance_type'] == 3) {

                            $set_session_data = array('SCHOOL_ID' => $school_id,
                                'user_id' => 999999,
                                'SCHOOL_CODE' => $data['code'],
                                'SCHOOL_NAME' => $data['name'],
                                'USER_GROUP' => 'SAMPOORNA',
                                'user_type' => 5,
                                'FINANCE_TYPE' => $data['finance_type'],
                                'LEVEL' => $data['level_type'],
                                'CLASS' => $data['course_ids'],
                                'REV_DISTRICT_CODE' => $data['district'],
                                'EDU_DISTRICT_CODE' => $data['edu_district'],
                                'SUB_DISTRICT_CODE' => $data['sub_district'],
                                'USER_NAME' => $username,
                                'name' => $data['name'],
                                'status' => 1
                                );
                            $this->session->set_userdata($set_session_data);
                            return 1;
                        
                    } else {
                        return 0;
                    }
                
            } 
        }

            /*Temporary code for testing commented for Gokul MU*/ 
        
        if (@$result->status == "success") {
            foreach ($result->loginDetails as $row) {
                $schoolAdmin = $row->admin;
                $data = $this->get_school_details($row->school_id);

                if ($data['finance_type'] == 1 || $data['finance_type'] == 3) {
                    if ($schoolAdmin) {
                        $set_session_data = array('SCHOOL_ID' => $row->school_id,
                            'user_id' => 999999,
                            'SCHOOL_CODE' => $data['code'],
                            'SCHOOL_NAME' => $data['name'],
                            'USER_GROUP' => 'SAMPOORNA',
                            'user_type' => 5,
                            'FINANCE_TYPE' => $data['finance_type'],
                            'LEVEL' => $data['level_type'],
                            'CLASS' => $data['course_ids'],
                            'REV_DISTRICT_CODE' => $data['district'],
                            'EDU_DISTRICT_CODE' => $data['edu_district'],
                            'SUB_DISTRICT_CODE' => $data['sub_district'],
                            'USER_NAME' => $username,
                            'name' => $data['name'],
                            'status' => 1);
            
                        $this->session->set_userdata($set_session_data);
                        echo 1;
                    }
                } else {
                    echo 0;
                }
            }
        } else {
            echo 2;
        }
    }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */