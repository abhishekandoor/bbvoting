<?php $user_id = $this->session->userdata('user_id'); ?>
<style type="text/css">
    .li-custom{
        list-style: none;
        background-color: #fff;
        padding: 5px;
        display: flex;
        border-bottom: 1px solid #9e9e9e40;
    }

    .btn-custom{
        border: 1px solid #00000040;
        border-radius: 4px;
        padding: 4px;
        cursor: pointer !important;
    }

    .btn-custom:hover{
        color: white;
        background-color: #3c8cbc;
    }
    #file_search_button:hover{
        color: #3c8dbc !important;
    }
    .search {
    position: relative;
    margin: 0 auto;
    width: 300px;
}

.search input:focus + .results { display: block }

.search .results {
    display: none;
    max-height: 85vh;
    overflow-y: auto;
    overflow-x: hidden;
    position: absolute;
    top: 35px;
    left: 0;
    right: 0;
    z-index: 10;
    padding: 0;
    margin: 0;
    border-width: 1px;
    border-style: solid;
    border-color: #cbcfe2 #c8cee7 #c4c7d7;
    border-radius: 3px;
    background-color: #fdfdfd;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fdfdfd), color-stop(100%, #eceef4));
    background-image: -webkit-linear-gradient(top, #fdfdfd, #eceef4);
    background-image: -moz-linear-gradient(top, #fdfdfd, #eceef4);
    background-image: -ms-linear-gradient(top, #fdfdfd, #eceef4);
    background-image: -o-linear-gradient(top, #fdfdfd, #eceef4);
    background-image: linear-gradient(top, #fdfdfd, #eceef4);
    -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    -ms-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    -o-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.search .results li { display: block }

.search .results li:first-child { margin-top: -1px }

.search .results li:first-child:before, .search .results li:first-child:after {
    display: block;
    content: '';
    width: 0;
    height: 0;
    position: absolute;
    left: 50%;
    margin-left: -5px;
    border: 5px outset transparent;
}

.search .results li:first-child:before {
    border-bottom: 5px solid #c4c7d7;
    top: -11px;
}

.search .results li:first-child:after {
    border-bottom: 5px solid #fdfdfd;
    top: -10px;
}

.search .results li:first-child:hover:before, .search .results li:first-child:hover:after { display: none }

.search .results li:last-child { margin-bottom: -1px }

.search .results a {
    display: block;
    position: relative;
    margin: 0 -1px;
    padding: 6px 40px 6px 10px;
    color: #808394;
    font-weight: 500;
    text-shadow: 0 1px #fff;
    border: 1px solid transparent;
    border-radius: 3px;
}

.search .results a span { font-weight: 200 }

.search .results a:before {
    content: '';
    width: 18px;
    height: 18px;
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -9px;
    background: url(<?php echo base_url().'assets/images/search.png'; ?>) 0 0 no-repeat;
}

.search .results a:hover {
    text-decoration: none;
    color: #fff;
    text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
    border-color: #2380dd #2179d5 #1a60aa;
    background-color: #338cdf;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #59aaf4), color-stop(100%, #338cdf));
    background-image: -webkit-linear-gradient(top, #59aaf4, #338cdf);
    background-image: -moz-linear-gradient(top, #59aaf4, #338cdf);
    background-image: -ms-linear-gradient(top, #59aaf4, #338cdf);
    background-image: -o-linear-gradient(top, #59aaf4, #338cdf);
    background-image: linear-gradient(top, #59aaf4, #338cdf);
    -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
    -moz-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
    -ms-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
    -o-box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
    box-shadow: inset 0 1px rgba(255, 255, 255, 0.2), 0 1px rgba(0, 0, 0, 0.08);
}

:-moz-placeholder {
    color: #a7aabc;
    font-weight: 200;
}

::-webkit-input-placeholder {
    color: #a7aabc;
    font-weight: 200;
}
.allNotificationModal{
    overflow-y: hidden !important;
}
.allNotificationModal .modal-header{
    background-color: #3c8dbc;
    color: white;
}

.allNotificationModal .modal-dialog {
    width: 90% !important;
    bottom: 15% !important;
}

.allNotificationModal .modal-dialog .modal-body {
    height: 75vh !important;
}
.allNotificationModal .modal-body {
    max-height: 70vh !important;
    overflow: auto !important;
}

.lt-ie9 .search input { line-height: 26px }
</style>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?php echo base_url() . 'assets/images/staff_icon.png'; ?>" width="50" height="50" alt="Staff"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">SAMANWAYA</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="display: flex;align-items: center;">
        <!-- Sidebar toggle button-->
        <?php /*
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        */ ?>
        <button id="btnFullscreen" class="glyphicon glyphicon-fullscreen" style="padding: 5px;"></button>               
        <button id="exitFullscreen" class="glyphicon glyphicon-resize-small" style="padding: 5px;display: none;"></button>               
        <span style="color:#ffff;font-weight:bold;font-size:20px;flex:1;" class="text-center">
             <?php 
             echo @$_SESSION['officeName'].' ('.$_SESSION['designation_name'].' )';
             if(!empty($_SESSION['office_block_id'])){
                echo ' - '.get_office_block_name($_SESSION['office_block_id']);
             } 
             ?>
         </span>
         <?php if(in_array($this->session->userdata('office_id'),array(AEO_OFFICE,DEO_OFFICE,DDE_OFFICE,DGE_OFFICE))){ ?>
            <div class="search" method="post" action="index.html" >
                <div style="display: flex;align-items: center;padding: 5px 5px 5px 10px;background-color: #fff;border-radius: 2px;">
                    <input autocomplete="off" type="text" id="file_number" name="file_number" placeholder="Search file number/appointee" style="border: 0;text-decoration: none;outline: none;width: 90%;" onkeyup="getSuggestions(this);">
                    <i class="fa fa-search pointer" id="file_search_button" style="color: #a5a5a5;" onclick="getFileSearchDetails();"></i>
                    <ul class="results" >
                    </ul>
                </div>
            </div>
        <?php } ?>
      
        <div class="navbar-custom-menu">
        
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less-->

                
                <li class="dropdown messages-menu">
                    <?php //$notifications = get_notifications($user_id); ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropDownReadNotifications">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning" id="dropDownReadNotificationsCount"><?php echo count($notifications); ?></span>
                    </a>
                    <ul class="dropdown-menu" style="width:320px !important;" id="ulnotify">
                        <li class="header" id="dropDownReadNotificationsHeader">You have <?php echo count($notifications); ?> notifications <i class="glyphicon glyphicon-remove pull-right" onclick="hidenotify();"></i> <span style="padding: 1px;margin-right: 15px;color: #337ab7;cursor: pointer;" class="pull-right" onclick="getAllNotification(50);">View All</span></li>
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
                                            <p style="margin-left:10px !important;white-space: normal;">
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
                </li>
                <!-- Messages: style can be found in dropdown.less -->
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
                </li>
                <?php 
//                  print("<pre>");
//                  print_r($_SESSION);
//                  exit;
                ?>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $this->session->userdata('photo_url') ? base_url().'uploads/profile_images/'.$this->session->userdata('photo_url') : base_url() . 'assets/secured_user/dist/img/user2-160x160.jpg'; ?>" class="user-image" alt="User Image">
                        <?php if(hasDSignRegistered()): ?>
                            <span class="fa fa-check-circle label-success" title="D-Signature Registered" style="border-radius: 5px;position: absolute;left: 25px;top: 5px;"></span>
                        <?php endif; ?>
                        <span class="hidden-xs"><?php echo  $this->session->userdata('name');?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo $this->session->userdata('photo_url') ? base_url().'uploads/profile_images/'.$this->session->userdata('photo_url') : base_url() . 'assets/secured_user/dist/img/user2-160x160.jpg'; ?>" class="img-circle" >
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
                    <?php  
                    if($this->session->userdata('user_type')!=5){
                        
                        $su = $current_user_dtls = get_current_user_data();
                        // echo "<pre>"; print_r($current_user_dtls); echo "</pre><br>"; 
                        // echo "<pre>"; print_r($other_accounts); echo "</pre><br>"; die;

                        if(count((array)$other_accounts) > 0 && isset($other_accounts)){
                            foreach ($other_accounts as $row) { 
                               if(($su['office_id'] == $row['office_id'] && $su['master_office_id'] == $row['master_office_id'] && $su['designation_id'] == $row['role_id']))
                                    continue;
                                $encr_id     = strtr($this->encryption->encrypt($row['id']), array('+' => '.', '=' => '-', '/' => '~'));
                                ?>
                                <li class="li-custom"><span class="pull-left bold" style="padding-left: 5px;">
                                    <?php echo $this->adminlib->get_office_full_name($row['master_office_id'], $row['office_id'], $row['office_block_id']); ?></span><a href="<?php echo base_url().'index.php/secured_user/User/switchTofullAdditionAccount/'.$encr_id; ?>" style="flex: 1;text-align: end;background-color: transparent;cursor: default;padding-right: 5px;">
                                    <span class="btn-custom">Switch Account</span>
                                </a></li>
                            <?php 
                              //  endif;
                            }
                        } 
                        $tu = $user_tbl_dtls = get_current_user_data($this->session->userdata('user_id'));
                        if($tu['user_id'] != '' && $tu['user_id'] != NULL){
                            $encr_usrid     = strtr($this->encryption->encrypt(@$tu['user_id']), array('+' => '.', '=' => '-', '/' => '~'));
                        }
                        if($tu['designation_id'] != $su['designation_id'] || $tu['usergroup_id'] != $su['usergroup_id'] || $tu['master_office_id'] != $su['master_office_id'] || $tu['office_id'] != $su['office_id'] ){ ?>
                              <li class="li-custom"><span class="pull-left bold" style="padding-left: 5px;">
                                    <?php echo $this->adminlib->get_office_full_name($tu['master_office_id'], $tu['office_id'], $tu['office_block_id']); ?></span><a href="<?php echo base_url().'index.php/secured_user/User/switchTofullAdditionAccount/'.$encr_usrid.'/1'; ?>" style="flex: 1;text-align: end;background-color: transparent;cursor: default;padding-right: 5px;">
                                    <span class="btn-custom">Switch Account</span>
                                </a></li>
                        <?php }
                        }
                        ?>
                        <li class="user-footer">
                           <div class="pull-left">
                     <a href="<?php echo base_url().'index.php/secured_user/Employee/view_profile'?>" class="btn btn-default btn-flat">Profile</a>
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
<script>
    function getFileSearchDetails(file_no=''){

        var dialog = bootbox.dialog({
            title: '<h4 style="margin:0;">File Search Details</h4>',
            message: `<table class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>File#</th>
                        <th>File Type</th>
                        <th>School</th>
                        <th>Appointee Name</th>
                        <th>File Status</th>
                        <th>Processing Office</th>
                        <th>Inhand</th>
                    </tr>
                </thead>
                <tbody id="display_file_data">
                    <tr>
                        <td class="text-red text-center" colspan="10">No Data Found!</td>
                    </tr>
                </tbody>
            </table>`,
            size: 'large',
            buttons: {
                cancel: {
                    label: "Close",
                    className: 'btn-default'
                }
            }
        });
                    
        dialog.init(function(){
            search_filenumber(file_no);
        });
    }
    var fileNumber =  document.getElementById('file_number');
    if (typeof(fileNumber) != 'undefined' && fileNumber != null)
    {
        document.getElementById("file_number")
            .addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                getFileSearchDetails();
            }
        });
    }

    function getSuggestions(e){
        var file_number = $.trim(e.value);
        if(file_number != null && file_number != ''){
            $('.results').show();
            $.ajax({
                type: "POST",
                url: base_url + "index.php/secured_user/Admin/getFilesSuggestion",
                data: {'file_number': file_number, 'csrf_saveMe': csrf_token},
                beforeSend: function () {
                    // $('#fill-filenavs').LoadingOverlay("show", {
                    //     image: base_url + "assets/secured_user/js/overlay/loading.gif",
                    //     //fontawesome: "fa fa-spinner fa-spin",
                    //     zIndex: 2147483647
                    // })
                    $(".results").html('<li style="padding: 5px;"><span class="text-red">Loading...</span></li>');
                },
                success: function (data)
                {
                    $(".results").html(data);
                    // setTimeout(function () {
                    //     $('#fill-filenavs').LoadingOverlay("hide");
                    // }, 1000);
                },
                error: function (err) {
                    // setTimeout(function () {
                    //     $('#fill-filenavs').LoadingOverlay("hide");
                    // }, 1000);
                    console.log(err)
                }

            });
        }else{
            $('.results').hide();
            $(".results").html('<li style="padding: 5px;"><span class="text-red">No results found!</span></li>');
        }
    }

    function pickFilenumber(file_no){
        $('#file_number').val(file_no);
        $('.results').hide();
        getFileSearchDetails(file_no);
    }

</script>