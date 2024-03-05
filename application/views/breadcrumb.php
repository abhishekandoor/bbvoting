<section class="content-header" style="background: white !important;" id="content-head">
    <div class="row">
        <div class="col-md-2">
            <?php if (@$title != '') { ?>
                <!--<h1>-->
                <span style="font-size:13px;font-weight:bold;"><?php echo $title;?></span>                   
                <!--</h1>-->
            <?php } ?>
                
        </div>
        <div class="col-md-8">
            <?php if(in_array($this->session->userdata('office_id'),array(SEC_OFFICE,DGE_OFFICE,DDE_OFFICE,DEO_OFFICE,AEO_OFFICE))){ ?>
            <div class="row">        
             <div class="col-md-11" id="DashboardRecentNotifications">        
                <?php $this->load->view('secured_user/dashboard/recentNotificationsajax'); ?>
             </div>
             <div class="col-md-1" style="padding:0px;width:20px;"><img src="<?php echo base_url().'assets/images/sync.png'; ?>" style="width:15px;height:15px;cursor: pointer;" 
                 onclick="loadRecentNotifications();" class="pull-right"/> </div>
            </div>
            <?php } ?>
        </div>
        <div class="col-md-2">
            <ol class="breadcrumb" style="padding:0px;margin-bottom:0px;background-color:#fff;">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <!--        <li class="active">Dashboard</li>-->
                <?php echo $breadcrumb; ?>
            </ol>
        </div>
    </div>
</section>