<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>സമന്വയ</title>
        <link rel="icon" href="<?php echo base_url().'/assets/images/favcon.png'; ?>" type="image/png" sizes="16x16">
      
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/secured_user/bootstrap/css/bootstrap.min.css'; ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/secured_user/dist/css/AdminLTE.min.css'; ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/secured_user/dist/css/skins/_all-skins.min.css'; ?>">
       
        <!-- bootstrap wysihtml5 - text editor -->
        <?php /* <link rel="stylesheet" href="<?php //echo base_url() . 'assets/secured_user/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'; ?>"> */ ?>
        <!-- Edited/Written CSS for special cases -->
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/secured_user/css/bootstrap_overrided.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/secured_user/css/dashboardStyle.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/secured_user/css/toastr.min.css'; ?>">

        <link rel="stylesheet" href="<?php echo base_url() . 'assets/secured_user/css/toastr.scss'; ?>">
        <style>
    @media only screen and (max-width: 600px) {
.box-primary{
    width:auto !important;
    box-shadow:none !important;
}
#pen ,#phone{
    height:40px !important;
}
.main-footer{
    width:100% !important;
}
    }
</style>
        <script src="<?php echo base_url() . 'assets/secured_user/js/toastr.js'; ?>"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-142877641-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-142877641-1');
</script>

    <?php /* <link rel="stylesheet" href="<?php //echo base_url() . 'assets/secured_user/plugins/ckeditor/css/samples.css'?>">
	<link rel="stylesheet" href="<?php //echo base_url() . 'assets/secured_user/plugins/ckeditor/toolbarconfigurator/lib/codemirror/neo.css'?>"> */ ?>


       
        <!-- bootstrap wysihtml5 - text editor -->
        <?php /*<link rel="stylesheet" href="<?php //echo base_url() . 'assets/secured_user/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' ?>"> */ ?>
        <!-- DYNAMIC STYLES -->

        <!-- for models -->

        <?php echo (isset($_styles)) ? $_styles : ''; ?>
        <script>
            var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
            var BASEPATH = "<?php echo (site_url()); ?>";
            var path = '<?php echo base_url(); ?>';
            var ses_user_id = '<?php echo $this->session->userdata('user_id'); ?>';
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini" style="background-color:#D3D3D366">
      

<?php
// $email = array(
// 	'name'	=> 'email',
// 	'id'	=> 'email',
//     'maxlength'	=> 100,
    
// 	'size'	=> 50,
// 	'required'
// );
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'maxlength'	=> 100,
	'size'	=> 30,
    'required'=>'required',
    'class'=>'form-control'
);
?>
<?php $user_id = $this->session->userdata('user_id'); ?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url().'index.php/Auth/logout'?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?php echo base_url() . 'assets/images/staff_icon.png'; ?>" width="50" height="50" alt="Staff"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">SAMANWAYA</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <button id="btnFullscreen" class="glyphicon glyphicon-fullscreen" style="padding: 5px;margin-top: 10px;"></button>               
        <button id="exitFullscreen" class="glyphicon glyphicon-resize-small" style="padding: 5px;margin-top: 10px;display: none;"></button>               
       --> <div class="navbar-custom-menu"> 
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less-->
                <!-- <li class="dropdown messages-menu">
                    <?php $notifications = get_notifications($user_id); ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropDownReadNotifications">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning" id="dropDownReadNotificationsCount"><?php echo count($notifications); ?></span>
                    </a>
                    <ul class="dropdown-menu" style="width:320px !important; ">
                        <li class="header" id="dropDownReadNotificationsHeader">You have <?php echo count($notifications); ?> notifications </li>
                        <li>
                            <ul class="menu" id="dropDownReadNotificationsList">
                                <?php /*get_current_user_data(48);*/ //print_r($this->session->userdata()); ?>
                                    <?php if(isset($notifications) && count($notifications)>0): ?>
                                    <?php foreach($notifications as $notify) : ?>
                                    <?php $elapsed = findElapsedTime($notify['created_at']); ?>
                                    <li>
                                        <a href="#">
                                            <h4  style="word-wrap: break-word !important; margin-left:10px !important; ">
                                                <?php echo $notify['first_name'].' '.$notify['last_name'].' <BR>('.$notify['designation'].', '.$notify['section'].')'; ?>
                                            </h4>
                                            <p style="margin-left:10px !important;">
                                                <?php echo $notify['notification']; ?>
                                            </p>
                                            <small class="pull-right"><i class="fa fa-clock-o"></i><?php echo $elapsed; ?></small>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <!-- Messages: style can be found in dropdown.less
                <li class="dropdown messages-menu">
                    <?php $unreadMsgs = get_unread_messages($user_id); ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success"><?php echo count($unreadMsgs); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have <?php echo count($unreadMsgs);//$this->session->userdata('unreadMsgCount'); ?> unread messages <?php //print_r($this->session->userdata()); ?> </li>
                        <li>
                            <ul class="menu">
                                <?php $unreadMsgData = $unreadMsgs;//$this->session->userdata('unreadMsgData'); ?>
                                <?php if(isset($unreadMsgData) && count($unreadMsgData)>0): ?>
                                <?php foreach($unreadMsgData as $msg) : ?>
                                <?php $elapsed = findElapsedTime($msg['cdate']); ?>
                                
                                <li>
                                    <a href="<?php echo base_url() . 'index.php/secured_user/Messages/readMessage/'.$msg['id']; ?>">
                                        <h4>
                                            <?php echo $msg['subject']; ?>
                                            <small><i class="fa fa-clock-o"></i><?php echo $elapsed; ?></small>
                                        </h4>
                                        <p>
                                            <?php echo $msg['first_name'].' '.$msg['last_name'].'('.$msg['designation'].', '.$msg['section'].')'; ?>
                                        </p>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                
                            </ul>
                        </li>
                        <li class="footer"><a href="<?php echo base_url() . 'index.php/secured_user/Messages'; ?>">See All Messages</a></li>
                    </ul>
                </li> -->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $this->session->userdata('photo_url') ? $this->session->userdata('photo_url') : base_url() . 'assets/secured_user/dist/img/user2-160x160.jpg'; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo  $this->session->userdata('name');?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo $this->session->userdata('photo_url') ? $this->session->userdata('photo_url') : base_url() . 'assets/secured_user/dist/img/user2-160x160.jpg'; ?>" class="img-circle" >
                            <p>
                              <?php echo  $this->session->userdata('name');?>
                                <!--<small>Member since Nov. 2012</small>-->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!--                  <li class="user-body">
                                            <div class="col-xs-4 text-center">
                                              <a href="#">Followers</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                              <a href="#">Sales</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                              <a href="#">Friends</a>
                                            </div>
                                          </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                           <div class="pull-left">
                     <!-- <a href="<?php echo base_url().'index.php/secured_user/Employee/view_profile'?>" class="btn btn-default btn-flat">Profile</a>
                            </div> -->
							</div>
                            <div class="pull-right">
                     <a href="<?php echo base_url().'index.php/Auth/logout'?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <!--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="col-md-4" style="padding:10px;margin: 0 auto ; margin-top:40px;float:none !important ;height:auto;z-index:999">
<div class="box box-primary" style="box-shadow: 10px 10px 5px grey;border:none;height:400px !important;width:400px" >
  <div class="box-header ">
    <h3 class="box-title" style="font-size:1.4em;font-weight:bold;margin:15px !important"> &nbsp; <img src="<?php echo base_url() . 'assets/images/staff_icon.png'; ?>">&nbsp; Verify your e-mail id</h3>
   
    
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <!-- <span class="label label-primary"></span>
    </div> -->
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body" style="margin:15px !important" >
  <p>
  We will send a four digit temporary password to this e-mail id.Enter the masked e-mail id.You will be redirected to Login Page .
</p>
<form action="<?php echo base_url();?>index.php/Auth/resetInitPassword" method="post" id="mailform">
<table class="table table-condensed">
<tr>
<input type="hidden" name="csrf_saveMe" value="<?php echo $this->security->get_csrf_hash();?>">
        
		<td>
        
        <?php echo form_label(@$maskedmail, $email['id']); ?></td>
		</tr>
<tr><td><?php echo form_input($email); ?></td>

		<td style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
	</tr>
	
</table>
<div class="pull-left">
       <a href="<?php echo base_url();?>"  >  <button type="button" class="btn btn-default" >Cancel</button> </a>
    </div>
 <div align="right"><?php //echo form_button('send', 'Send Mail','class="btn btn-primary"','id="submit"','onclick="sendVerificationMail()"','type="button"'); ?>
 <button type="button" class="btn btn-primary" id="buttonMailVerify" onclick="sendVerificationMail()">Get Code</button>
 
 </div> 
<?php echo form_close(); ?>
</div>
</div>

</div>
 

            <?php //echo $sidebar; ?>

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <!--            <div class="control-sidebar-bg"></div>-->
        </div><!-- ./wrapper -->

  <!-- jQuery 2.1.4 -->
  <script src="<?php echo base_url() . 'assets/secured_user/plugins/jQuery/jQuery-2.1.4.min.js'; ?>"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() . 'assets/secured_user/plugins/jQueryUI/jquery-ui.min.js'; ?>"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo base_url() . 'assets/secured_user/bootstrap/js/bootstrap.min.js'; ?>"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <?php /* <script src="<?php //echo base_url() . 'assets/secured_user/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'; ?>"></script> */ ?>
        <!-- Slimscroll -->
        <script src="<?php echo base_url() . 'assets/secured_user/plugins/slimScroll/jquery.slimscroll.min.js'; ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() . 'assets/secured_user/plugins/fastclick/fastclick.min.js'; ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() . 'assets/secured_user/dist/js/app.min.js'; ?>"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes)
        <script src="<?php echo base_url() . 'assets/secured_user/dist/js/pages/dashboard.js'; ?>"></script> -->
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() . 'assets/secured_user/dist/js/demo.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/secured_user/js/admindashboard.js'; ?>"></script>
        <script src="<?php echo base_url() . 'assets/secured_user/js/toastr.min.js'; ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-loading-overlay/2.1.6/loadingoverlay.js"></script>

        <script type="text/javascript"> var path = '<?= site_url() ?>';
        var base_url = '<?= base_url() ?>';</script>

        <script>


 function sendVerificationMail()
{
 // alert($('#email').val());
 var email1=$('#email').val();
 //alert(email1);
 $.ajax({
    type: "POST",
    url:  "<?php echo base_url() ?>index.php/Auth/sendResetMail", 
    data: {'email': email1,'csrf_saveMe': csrf_token,},
   beforeSend:function(){
    $.LoadingOverlay("show", {
                            image: base_url + "assets/secured_user/js/overlay/loading.gif"
                            //fontawesome: "fa fa-spinner fa-spin"
                        })
   },
    success: 
              
              function(data){
                setTimeout(function () {
                            $.LoadingOverlay("hide");
                        }, 1000);
                  //alert(data.status);
                  
            var parsed_data=JSON.parse(data);
            if(parsed_data.status=='ok'){
                toastr.success("Check your e-mail for the new password");

                setTimeout(function(){
                location.href = "<?php echo base_url(); ?>";
                },2000);
               // alert(data);
            }
            else
            {  toastr.error("Entered e-mail id is not matched with your account");
                
            }
              },
    error:function(data){
        //alert(data);
        toastr.error("Entered e-mail id is not matched with your account");
          
    }
          
 });
}
</script>

        <!-- Bootstrap WYSIHTML5 -->
        <?php /* <script src="<?php //echo base_url() . 'assets/secured_user/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js' ?>"></script> */ ?>

 


		<footer class="main-footer col-sm-12 no-margin" style="margin-bottom:0 !important;position: fixed;
  left: 0;
  bottom: 0; width:100%">
                <div style="text-align:center">
                    Website designed and developed by <a href="https://kite.kerala.gov.in" target="_blank" ><strong>KITE</strong></a> for DPI<br>
                    <b>Version</b> 1.0.0
                </div>
                <strong><!--<a href="https://kite.kerala.gov.in" target="_blank" ><img src="<?php // echo base_url() . 'assets/images/kite.png'; ?>" alt="KITE"></a>-->
            </footer>
            
</body>
</html>