<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Fixation And Appointment Approval</title>
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

        <script src="<?php echo base_url() . 'assets/secured_user/js/toastr.js'; ?>"></script>


        <?php echo (isset($_styles)) ? $_styles : ''; ?>
        <script>
            var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
            var BASEPATH = "<?php echo (site_url()); ?>";
            var path = '<?php echo base_url(); ?>';
            var ses_user_id = '<?php echo $this->session->userdata('user_id'); ?>';
        </script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini" style="background-color:#D3D3D366">
      

<?php $user_id = $this->session->userdata('user_id'); ?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?php echo base_url() . 'assets/images/staff_icon.png'; ?>" width="50" height="50" alt="Staff"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">SAMANWAYA</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
<div class="navbar-custom-menu"> 
            <ul class="nav navbar-nav">
               
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
                        <li class="user-footer">
                           <div class="pull-left">
							</div>
                            <div class="pull-right">
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

<div class="col-md-4" style="padding:18x;margin: 0 auto ; margin-top:20px;float:none !important ;height:auto ;z-index:999">
<div class="box box-primary" style="box-shadow: 10px 10px 5px grey;border:none;height:550px !important;width:400px" >
  <div class="box-header ">
    <h3 class="box-title" style="font-size:1.4em;font-weight:bold;margin:15px !important"> &nbsp; <img src="<?php echo base_url() . 'assets/images/staff_icon.png'; ?>">&nbsp; Find your account</h3>
   
    <div class="box-tools pull-right">
  </div>
  <!-- /.box-header -->
  <div class="box-body" style="margin:15px !important">
   <?php
       if(isset($error))
         echo $error;
   ?>
    <p>
    We will send a four digit temporary password to your mobile number.

    </p>
<form action="<?php echo base_url();?>index.php/Auth/verifyUser" method="post">
<table class="table table-condensed">
<input type="hidden" name="csrf_saveMe" value="<?php echo $this->security->get_csrf_hash();?>">
    <tr>
    <div class="form-group">
	   	<label><input type="radio" name="otp_type" id="sms_otp" value="1" checked="checked" onclick="select_otp_type();">OTP Send via SMS</label>
	</div>
    </tr>
	<tr>
       <div class="form-group">
		<label><input type="radio" name="otp_type" id="email_otp" value="0" onclick="select_otp_type();">OTP Send via Email</label>
      </div>
	</tr>
    <tr>
    <input type="hidden" name="pen" id="pen" value="<?php echo $PEN; ?>">
    <input type="hidden" name="phone" id="phone" value="<?php echo $phone; ?>">
    <input type="hidden" name="master_sms_id" id="master_sms_id" value="<?php echo FORGOT_SMS_TYPE; ?>">
    <div class="pull-left">
       <a href="<?php echo base_url();?>"  >  <button type="button" class="btn btn-default" >Cancel</button> </a>
    </div>
    <div align="right" style="display: none;" id="email_div"><?php echo form_submit('verify', 'Next','class="btn btn-primary"','id="submit"'); ?></div>
    <div align="right" id="sms_div">
         <button type="button" class="btn btn-primary" id="buttonSMSOTP" onclick="sendVerificationSMS()">Get Code</button>
    </div>
    <!-- <div align="right"><a class="btn btn-primary" id="send_sms_otp" name="send_sms_otp"></div> -->
    </tr>
</table>

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
        <script src="<?php echo base_url() . 'assets/secured_user/js/overlay/loadingoverlay.min.js'; ?>"></script>
        <script type="text/javascript">
            var path = '<?= site_url() ?>';
            var base_url = '<?= base_url() ?>';
        </script>
        <script type="text/javascript">
            function select_otp_type(){
                var otp_type = $('input[name=otp_type]:checked').val();
                if(otp_type == 0){//otp_typ 0 is otp via email
                    $.LoadingOverlay("show", {
                        image: base_url + "assets/secured_user/js/overlay/loading.gif",
                        zIndex: 2147483647
                    })
                    if($('#sms_div').hide()){
                        if($('#email_div').show()){
                            setTimeout(function () {
                                $.LoadingOverlay("hide");
                            }, 1000);
                        }
                    }
                }
                else if(otp_type == 1){//otp_typ 1 is otp via sms
                    $.LoadingOverlay("show", {
                        image: base_url + "assets/secured_user/js/overlay/loading.gif",
                        zIndex: 2147483647
                    })
                    if($('#sms_div').show()){
                        if($('#email_div').hide()){
                            setTimeout(function () {
                                $.LoadingOverlay("hide");
                            }, 1000);
                        }
                    }
                }
            }

            function sendVerificationSMS()
            {
             $('#buttonSMSOTP').hide();
             var phone=$('#phone').val();
             var user_id=$('#pen').val();
             var master_sms_id=$('#master_sms_id').val();
             $.ajax({
                type: "POST",
                url: base_url + "index.php/Sms_Management/sendMessageBySMS",
                data: {'phone': phone,'user_id':user_id,'master_sms_id':master_sms_id,'csrf_saveMe': csrf_token,},
               beforeSend:function(){
                $.LoadingOverlay("show", {
                        image: base_url + "assets/secured_user/js/overlay/loading.gif",
                        zIndex: 2147483647
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
                            toastr.success("Check your phone for the new password");

                            setTimeout(function(){
                            location.href = "<?php echo base_url(); ?>";
                            },2000);
                           // alert(data);
                        }
                        else if(parsed_data.status=='not_active')
                        {  
                            toastr.error("SMS facility not available right now.");
                            setTimeout(function(){
                            },2000);
                        }
                        else
                        {  
                            toastr.error("Entered phone number is not matched with your account");
                            setTimeout(function(){
                            },2000);
                        }
                          },
                error:function(data){
                    //alert(data);
                    toastr.error("Entered phone number is not matched with your account");
                      setTimeout(function () {
                                $.LoadingOverlay("hide");
                            }, 1000);
                }
                      
             });
            }
        </script>

        <!-- Bootstrap WYSIHTML5 -->
        <?php /* <script src="<?php //echo base_url() . 'assets/secured_user/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js' ?>"></script> */ ?>

 


		<footer class="main-footer col-sm-12 no-margin" style="margin-bottom:0 !important;position: fixed;
  left: 0;
  bottom: 0;">
                <div style="text-align:center">
                    Website designed and developed by <a href="https://kite.kerala.gov.in" target="_blank" ><strong>KITE</strong></a> for DPI<br>
                    <b>Version</b> 1.0.0
                </div>
                <strong><!--<a href="https://kite.kerala.gov.in" target="_blank" ><img src="<?php // echo base_url() . 'assets/images/kite.png'; ?>" alt="KITE"></a>-->
            </footer>
</body>
</html>