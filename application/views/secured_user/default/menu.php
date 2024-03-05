<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <?php
        if ($this->session->userdata('user_type') != 'MANAGER') {
            ?>

          <?php echo form_open('secured_user/Dashboard/user_dashboards', array('class' => 'sidebar-form')); ?>
<!--            <form action="<?php echo base_url() ?>index.php/secured_user/Dashboard/search_data" method="post" class="sidebar-form">-->

                <div class="input-group">
                    <input type="text" name="txtsearch"  id="txtsearch" class="form-control" placeholder="Enter File Number/Name">
                    <span class="input-group-btn">
                        
                        <a class="btn btn-flat" id="srh" href="#" onclick="javascript:searchapplication();" data-toggle="modal" data-target="#searchModal"><i class="fa fa-search"></i></a> 
                        
<!--                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"></button>-->
                    </span>
                </div>
            <?php echo form_close(); ?>
        <?php } ?>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php if(!personalAuditStatus()): ?>
        <ul class="sidebar-menu">
            <li class="active treeview">
            <li class="active"><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> <span>Home</span></a> </li>                              
            </li>
            <li class="treeview">
                <?php if($this->session->userdata('office_id')!=ADMIN_OFFICE && $this->session->userdata('office_id')!=ITADMIN_OFFICE){ ?>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                <?php } ?>
                <ul class="treeview-menu">
                <?php if($this->session->userdata('office_block_id') == AUDIT_BLOCK && $this->session->userdata('office_id') == DDE_OFFICE){ ?>
                    <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/6'; ?>"><i class="fa fa-circle-o"></i> Audit</a></li>
                    <?php if(isPersonalAuditEnabled()): 
                        $pen=$this->General->getrow('users','pen',array("id"=>$this->session->userdata('user_id')))->pen;
                        ?>
                        <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/7'; ?>"><i class="fa fa-circle-o"></i> Personal Audit</a></li>
                        <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Audit/personalAuditView/'?><?php echo $pen; ?>"><i class="fa fa-circle-o"></i> Personal Audit (own)</a></li>
                    <?php endif; ?>
                    <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/getGroupCommunication'; ?>"><i class="fa fa-circle-o"></i> IOC</a></li>
                <?php } else { ?>
                    <?php if($this->session->userdata('office_id')!=DGE_OFFICE && !isSecretariat()){ ?>
                        <li><a href="<?php if($this->session->userdata('office_id') != DDE_OFFICE && $this->session->userdata('office_id') != DGE_OFFICE) { echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/1'; } else { echo base_url().'index.php/secured_user/Dashboard/user_dashboards/5';} ?>"><i class="fa fa-circle-o"></i><?php if($this->session->userdata('office_id') == DDE_OFFICE){ echo " A.A Appeal"; }else{ echo "Appointment Approval";} ?></a></li>
                    <?php }else if($this->session->userdata('office_block_id')==G_BLOCK || $this->session->userdata('office_block_id')==F_BLOCK || $this->session->userdata('office_block_id')==E_BLOCK || $this->session->userdata('office_block_id')==EC_BLOCK || $this->session->userdata('office_block_id')==EM_BLOCK || $this->session->userdata('office_block_id')==ET_BLOCK ) { ?>
                        <li><a href="<?php echo base_url().'index.php/secured_user/Dashboard/user_dashboards/5'; ?>"><i class="fa fa-circle-o"></i><?php echo " A.A Rev. Appeal"; ?></a></li>
                    <?php }if($this->session->userdata('office_block_id')==F_BLOCK){ ?>
                        <li><a href="<?php echo base_url().'index.php/secured_user/Dashboard/getAdalatFiles'; ?>"><i class="fa fa-circle-o"></i><?php echo "Adalat/Inspection"; ?></a></li>
                    <?php   } if($this->session->userdata('office_id')==MANAGER_OFFICE){ ?>
                        <li><a href="<?php echo base_url().'index.php/secured_user/Dashboard/user_dashboards?tab=2&section=Tab2Section1'; ?>"><i class="fa fa-circle-o"></i>Staff Fixation</a></li>
                        <?php } ?>
                    <?php    if($this->session->userdata('office_id')!=MANAGER_OFFICE && $this->session->userdata('office_id') != DDE_OFFICE && $this->session->userdata('office_id') != DGE_OFFICE && !isSecretariat())
                        {?>
                        <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/2';?>"><i class="fa fa-circle-o"></i> Staff Fixation</a></li>
                <?php } ?>
                    <?php
                        if($this->session->userdata('office_id') == DEO_OFFICE){ ?>
                            <li><a href="<?php echo base_url().'index.php/secured_user/Dashboard/user_dashboards/5'; ?>"><i class="fa fa-circle-o"></i><?php echo " A.A Appeal"; ?></a></li> 
                        <?php
                        }
                        if($this->session->userdata('office_id') == DEO_OFFICE || $this->session->userdata('office_id') == AEO_OFFICE){ ?>
                            <li><a href="<?php echo base_url().'index.php/secured_user/Appeals/view_appeal_list_aa/'; ?>"><i class="fa fa-circle-o"></i><?php echo " A.A Appeal Remarks"; ?></a></li> 
                    <?php } ?>
                    <?php    if($this->session->userdata('office_id')==AEO_OFFICE || $this->session->userdata('office_id')==DEO_OFFICE)
                        {?>
                        <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Appeals/view_appeal_list'; ?>"><i class="fa fa-circle-o"></i> S.F Appeal</a></li>
                <?php } ?>
                <?php    if($this->session->userdata('office_id')==AEO_OFFICE)
                        {?>
                        <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Revision/view_review_list'; ?>"><i class="fa fa-circle-o"></i> Review</a></li>
                <?php } ?>

                <?php   if($this->session->userdata('office_id')==DDE_OFFICE || isSecretariat())
                        {?>
                        <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/3'; ?>"><i class="fa fa-circle-o"></i> S.F Appeal</a></li>
                    <?php }  ?>
                    <?php   if($this->session->userdata('office_id')==DGE_OFFICE  &&  
                            !in_array($this->session->userdata('office_block_id'),array(G_BLOCK,F_BLOCK,E_BLOCK,EC_BLOCK,EM_BLOCK,ET_BLOCK))){  
                        if($this->session->userdata('office_block_id')==2){ ?>
                        <?php if(!in_array($this->session->userdata('usergroup_id'), array(ADPI_GENERAL_UERGROUP_ID()))){ ?>
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Appeals/view_appeal_list'; ?>"><i class="fa fa-circle-o"></i> S.F. Rev. Appeal</a></li>
                        <?php } ?>  
                            <!--<li class="active"><a href="<?php //echo base_url() . 'index.php/secured_user/Appeals/view_appeal_list_aa'; ?>"><i class="fa fa-circle-o"></i> A.A. Rev. Appeal</a></li>-->
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/5'; ?>"><i class="fa fa-circle-o"></i> A.A. Rev. Appeal</a></li>
                       <?php } else {
                              if($this->session->userdata('usergroup_id') != ADPI_ACADEMIC_UERGROUP_ID()){
                           ?>
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/3'; ?>"><i class="fa fa-circle-o"></i> S.F. Revision Appeal</a></li>
                        <?php 
                              }
                            }                        
                     }  ?>
                    <?php  if($this->session->userdata('office_id')==DDE_OFFICE || $this->session->userdata('office_id')==DEO_OFFICE)
                        {?>
                        <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/4'; ?>"><i class="fa fa-circle-o"></i> S.F Review</a></li>
                        <?php }  ?>
                        <?php if(($this->session->userdata('office_id')==SEC_OFFICE || $this->session->userdata('office_id')==DDE_OFFICE || $this->session->userdata('office_id')==DEO_OFFICE || $this->session->userdata('office_id')==AEO_OFFICE || $this->session->userdata('office_id')==DGE_OFFICE || $this->session->userdata('office_id')==MANAGER_OFFICE) && isIOCEnabled()) { ?>
                        <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/getGroupCommunication'; ?>"><i class="fa fa-circle-o"></i> IOC</a></li>
                        <?php } 
                        if(($this->session->userdata('office_id')==DDE_OFFICE || $this->session->userdata('office_id')==DGE_OFFICE) && isAuditEnabled()){
                            if(!hasADGEPermission() && $this->session->userdata('office_block_id') == H_BLOCK){ ?>
                                <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Audit/view_audit_list'; ?>"><i class="fa fa-circle-o"></i> Audit</a></li>
                        <?php  }else{
                        ?>
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards/6'; ?>"><i class="fa fa-circle-o"></i> Audit</a></li>
                        <?php } 
                        } 
                        if(isAuditEnabled() && ($this->session->userdata('office_id')==DEO_OFFICE || $this->session->userdata('office_id')==AEO_OFFICE)){
                        ?>
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Audit/view_audit_list/'; ?>"><i class="fa fa-circle-o"></i> Audit</a></li>
                        <?php }
                         if(isPersonalAuditEnabled() && isAuditEnabled() && ($this->session->userdata('office_id')==DEO_OFFICE || $this->session->userdata('office_id')==AEO_OFFICE || $this->session->userdata('office_id')==DDE_OFFICE)){ 
                            $pen=$this->General->getrow('users','pen',array("id"=>$this->session->userdata('user_id')))->pen;
                            ?>
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Audit/personalAuditView/'?><?php echo $pen; ?>"><i class="fa fa-circle-o"></i> Personal Audit (own)</a></li>
                        <?php }
                            if (in_array($this->session->userdata('office_id'), array(DEO_OFFICE,AEO_OFFICE))){ ?>
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Bonds/';  ?>"><i class="fa fa-circle-o"></i> Bonds</a></li>
                            
                        <?php } if (in_array($this->session->userdata('office_id'), array(DDE_OFFICE,DGE_OFFICE))){ ?>
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Bonds/report'; ?>"><i class="fa fa-circle-o"></i> Bonds</a></li>
                            
                        <?php }  
                    } ?>
                    <?php if(in_array($this->session->userdata('office_id'), array(DGE_OFFICE,DDE_OFFICE,DEO_OFFICE,AEO_OFFICE))){ 
                           if(!in_array($this->session->userdata('office_id'),array(H_BLOCK,RA_BLOCK)) && !hasJDPermission()){ ?>
                            <li class="active"><a href="<?php echo base_url() . 'index.php/secured_user/Labelling';  ?>"><i class="fa fa-circle-o"></i> Labels</a></li>
                    <?php }  
                     } 
                    ?> 
                    <?php /* ?>
                        <li class="active"><a href="<?php echo base_url().'index.php/secured_user/Dashboard/getStrayFiles' ?>"><i class="fa fa-circle-o"></i> Misplaced Files</a></li>    
                    <?php */ ?>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url() . 'index.php/secured_user/Messages'; ?>">
                    <i class="fa fa-envelope"></i> <span>Messages</span>
                </a>

            </li>

            <!--Usermanagement-->
            <?php
            if ($this->itschool_rbac->has_permission('Usermanagement', array('admin'), TRUE)) {
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa fa-users"></i> <span>User Management</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/index') . '"><i class="fa fa-circle-o"></i>User Groups</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_usergroup') . '"><i class="fa fa-circle-o"></i>Create New Usergroup</a></li>' : ''; ?>
                        <!--<? ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/create_default_users') . '"><i class="fa fa-circle-o"></i>Create Defualt Users</a></li>' : ''; ?>-->
                        <?= ($this->itschool_rbac->has_permission('Usermanagement', array('admin', 'hr_manager'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_user') . '"><i class="fa fa-circle-o"></i>Create New User</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Usermanagement', array('admin', 'hr_manager'), TRUE)) ? '<li><a href="' . site_url('usermanagement/userList') . '"><i class="fa fa-circle-o"></i>User List</a></li>' : ''; ?>
                        <?php if(master_office() == ITADMIN_OFFICE || master_office() == ADMIN_OFFICE){ ?>
                        <li><a href="<?php echo base_url().'index.php/usermanagement/managerlist/'; ?>"><i class="fa fa-circle-o"></i>Managements</a></li>
                        <?php } ?>
                        <!--<? ($this->itschool_rbac->has_permission('Usermanagement', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/bulk_user') . '"><i class="fa fa-circle-o"></i>Create Bulk User</a></li>' : ''; ?>-->
                        <?php if($this->session->userdata('designation_id') == $this->adminlib->get_admin_id() && $this->session->userdata('office_id') != ADMIN_OFFICE):
                                echo '<li><a href="' . site_url('usermanagement/newFullAdditionCharge') . '"><i class="fa fa-circle-o"></i>Create Full Addition</a></li>';
                              endif; ?>
                         <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_taskgroup') . '"><i class="fa fa-circle-o"></i>Create New Taskgroup</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/taskgroups') . '"><i class="fa fa-circle-o"></i>Task Groups</a></li>' : ''; ?>         
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('edit'), TRUE)) ? '<li><a href="' . site_url('usermanagement/reset_password') . '"><i class="fa fa-circle-o"></i>Reset Password</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_role') . '"><i class="fa fa-circle-o"></i>Create Role</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_scope') . '"><i class="fa fa-circle-o"></i>Create Scope</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/configuration') . '"><i class="fa fa-circle-o"></i>Configure RBAC</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/sectionDistrictMapping') . '"><i class="fa fa-circle-o"></i>Section-District</a></li>' : ''; ?>
           
                    </ul>
                </li>
            <?php } ?>

            <!--Control Panel-->
            <?php
            if ($this->itschool_rbac->has_permission('Control_Panel', array(), TRUE)) {
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa fa-tasks"></i> <span>News/Circular</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        //<?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('Control_Panel/create_menu') . '"><i class="fa fa-circle-o"></i>Add Menus</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('Control_Panel/create_circulars') . '"><i class="fa fa-circle-o"></i>Add Circulars</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('Control_Panel/add_news') . '"><i class="fa fa-circle-o"></i>Add News</a></li>' : ''; ?>
                    </ul>
                </li>
            <?php } ?>            
            <!--Administration-->
            <?php if ($this->itschool_rbac->has_permission('Usermanagement', array('admin'), TRUE) && $this->session->userdata('office_id')!=1013) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-building"></i> <span>Administration</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() . 'index.php/secured_user/Schoolmanagement/' ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>School Management</span> </a></li>
                        <?php /* <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('secured_user/Designationmanagement/') . '"><i class="fa fa-circle-o"></i>Designation Management</a></li>' : ''; ?> */ ?>
                        <!--<li><a href=""><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>Search Employee</span> <i class="fa fa-angle-left pull-right"></i></a></li>-->
                    </ul>
                </li>
            <?php } ?>
            <?php /* ?>
            <?php if ($this->session->userdata('user_type') == "DEO") { ?>
                <li class="treeview">
                    <a href="<?php echo base_url().'index.php/Admin/Lists/School/aeo/' . $this->session->userdata('edudistrict_id').'/'.get_hash($this->session->userdata('edudistrict_id')); ?>">
                        <i class="fa fa-circle-o"></i> <span>Staff Fixation</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata('user_type') == "AEO") { ?>
                <li class="treeview">
                    <a href="<?php echo base_url().'index.php/Admin/Lists/School/school/'.$this->session->userdata('subdistrict_id').'/'.get_hash($this->session->userdata('subdistrict_id')); ?>">
                        <i class="fa fa-circle-o"></i> <span>Staff Fixation</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
            <?php } ?>
            <?php */ ?>
            <!--Settings-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa fa-cogs"></i> <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!--<?= '<li><a href="' . site_url('secured_user/User/edit') . '"><i class="fa fa-circle-o"></i>Edit Profile</a></li>'; ?>-->
                    <?php if( $this->session->userdata('user_type') == 'ITADMIN' && $this->session->userdata('user_id') == ITADMIN_USER_ID){ ?>
                    <?= '<li><a href="' . site_url('secured_user/SiteSettings/site_permissions') . '"><i class="fa fa-circle-o"></i>Site Settings</a></li>'; ?>
                    <?= '<li><a href="' . site_url('secured_user/SiteSettings/manage_appt_options') . '"><i class="fa fa-circle-o"></i>A.A Option Settings</a></li>'; ?>
                    
                    <?= '<li><a href="' . site_url('secured_user/SiteSettings/functionality_testing') . '"><i class="fa fa-circle-o"></i>Troubleshooting</a></li>'; ?>
                    <?php }
                    if($this->session->userdata('office_id') == ITADMIN_OFFICE){
                        echo '<li><a href="' . site_url('secured_user/Labelling/label_master') . '"><i class="fa fa-circle-o"></i>Label Settings</a></li>';
                    }
                    ?>
                    <li><a href="<?php echo base_url() . 'index.php/secured_user/Employee/view_profile/'; ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>Profile</span></a></li>
                    <?= '<li><a href="' . site_url('secured_user/User/change_password') . '"><i class="fa fa-circle-o"></i>Change Password</a></li>'; ?>                    
                 
                 <?php 
                    if($this->session->userdata('office_id')!=MANAGER_OFFICE)
                    {
                 ?>
                    <li><a href="<?php echo base_url() . 'index.php/secured_user/Employee/serviceRecord/'; ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>Service Record </span></a></li>
               
                  <?php 

                    }

                    ?>
                 <?php 
                   if($officeSettingsMenuPermission==1)
                   {
                 ?>
                    <li><a href="<?php echo base_url() . 'index.php/secured_user/Appeals/office_settings'; ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>Office Settings </span></a></li>               
                  <?php                   
                    }                
                    if(($this->session->userdata('office_id') == DDE_OFFICE && $this->session->userdata('user_type') == "DDE") ||
            ($this->session->userdata('office_id') == DGE_OFFICE && get_ioc_setting_access_dge_office() == true) ||
            ($this->session->userdata('office_id') == SEC_OFFICE && get_ioc_setting_access_sec_office() == true)){
                    ?>
                      <li>
                          <a href="<?php echo base_url().'index.php/secured_user/SiteSettings/set_ioc_settings'; ?>">
                              <i class="fa fa fa-circle-o" aria-hidden="true"></i><span>IOC Settings</span></a>
                      </li>          
                <?php } ?>
                </ul>
            </li>
            <?php
                if( $this->session->userdata('office_id') == MANAGER_OFFICE )
                {
            ?>
                <!--<li><a href="<?php echo base_url() . 'index.php/secured_user/Dashboard/user_dashboards?tab=2&t='.time(); ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>SF Appeals </span></a></li>-->
               
            <?php
                }
            ?>
            <!--            Organization Chart-->
            <?php
            // if ($this->session->userdata('user_type') != 'MANAGER' && $this->session->userdata('office_id')!=ADMIN_OFFICE)
            if($this->session->userdata('office_id')==ITADMIN_OFFICE)
            {
                ?>
                <li>
                    <a href="<?php echo base_url() . 'index.php/secured_user/Department/masterChart'; ?>">
                        <i class="fa fa-industry"></i> <span>Organization Chart</span>
                    </a>
                </li>
              <?php 
                if($this->session->userdata('office_id')==ITADMIN_OFFICE)
                    {
                        ?>
                <!--            Office Chart-->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-sort-amount-asc"></i> <span>Know Your Office</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
    <?php foreach ($offices as $off => $office) { ?>
                            <li><a href="<?php echo base_url() . 'index.php/secured_user/Department/org_chart/' . $office['office_id']; ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span><?php echo $office['office_name']; ?></span></a></li>
                        <?php } ?>
                    </ul>
                </li>
<?php } 
} //end of hiddend for users except it admin
?>
        </ul>
        <?php endif; ?>
    </section>
    <!-- /.sidebar -->
</aside>