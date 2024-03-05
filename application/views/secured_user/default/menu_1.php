<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="active treeview">
                <a href="<?php echo base_url() . 'index.php/secured_user/Dashboard'; ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

            </li>
            <li class="active treeview">
                <a href="<?php echo base_url() . 'index.php/secured_user/Messages'; ?>">
                    <i class="fa fa-envelope"></i> <span>Messages</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

            </li>

            <!--Usermanagement-->
            <?php
            if ($this->itschool_rbac->has_permission('Usermanagement', array('admin'), TRUE)) {
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa fa-users"></i> <span>Office Management</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/index') . '"><i class="fa fa-circle-o"></i>User Groups</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_usergroup') . '"><i class="fa fa-circle-o"></i>Create New Usergroup</a></li>' : ''; ?>
                        <!--<? ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/create_default_users') . '"><i class="fa fa-circle-o"></i>Create Defualt Users</a></li>' : ''; ?>-->
                        <?= ($this->itschool_rbac->has_permission('Usermanagement', array('admin','hr_manager'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_user') . '"><i class="fa fa-circle-o"></i>Create New User</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Usermanagement', array('admin','hr_manager'), TRUE)) ? '<li><a href="' . site_url('usermanagement/userList') . '"><i class="fa fa-circle-o"></i>User List</a></li>' : ''; ?>
                        <!--<? ($this->itschool_rbac->has_permission('Usermanagement', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/bulk_user') . '"><i class="fa fa-circle-o"></i>Create Bulk User</a></li>' : ''; ?>-->
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_taskgroup') . '"><i class="fa fa-circle-o"></i>Create New Taskgroup</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/taskgroups') . '"><i class="fa fa-circle-o"></i>Task Groups</a></li>' : ''; ?>         
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('edit'), TRUE)) ? '<li><a href="' . site_url('usermanagement/reset_password') . '"><i class="fa fa-circle-o"></i>Reset Password</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_role') . '"><i class="fa fa-circle-o"></i>Create Role</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/new_scope') . '"><i class="fa fa-circle-o"></i>Create Scope</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('usermanagement/configuration') . '"><i class="fa fa-circle-o"></i>Configure RBAC</a></li>' : ''; ?>
                    </ul>
                </li>
            <?php } ?>

            <!--Control Panel-->
            <?php
            if ($this->itschool_rbac->has_permission('Control_Panel', array(), TRUE)) {
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa fa-tasks"></i> <span>Control Panel</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('Control_Panel/create_menu') . '"><i class="fa fa-circle-o"></i>Create Menu</a></li>' : ''; ?>
                        <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('Control_Panel/add_news') . '"><i class="fa fa-circle-o"></i>Add News</a></li>' : ''; ?>
                    </ul>
                </li>
            <?php } ?>

            <!--Organization Chart-->
<!--            <li>
                <a href="<?php echo base_url().'index.php/secured_user/Department/masterChart'; ?>">
                    <i class="fa fa-industry"></i> <span>Organization Chart</span>
                </a>
            </li>-->

            <!--Office Chart-->
<!--            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sort-amount-asc"></i> <span>Know Your Office</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php foreach ($offices as $off => $office) { ?>
                        <li><a href="<?php echo base_url() . 'index.php/secured_user/Department/org_chart/' . $office['office_id']; ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span><?php echo $office['office_name']; ?></span> <i class="fa fa-angle-left pull-right"></i></a></li>
                    <?php } ?>
                </ul>
            </li>-->

            <!--Administration-->
            <?php if ($this->itschool_rbac->has_permission('Usermanagement', array('admin'), TRUE)) { ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>Administration</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'index.php/secured_user/Schoolmanagement/'?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>School Management Settings</span> <i class="fa fa-angle-left pull-right"></i></a></li>
                    <?= ($this->itschool_rbac->has_permission('Control_Panel', array('admin'), TRUE)) ? '<li><a href="' . site_url('secured_user/Designationmanagement/') . '"><i class="fa fa-circle-o"></i>Designation Management</a></li>' : ''; ?>
                    <!--<li><a href=""><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>Search Employee</span> <i class="fa fa-angle-left pull-right"></i></a></li>-->
                </ul>
            </li>
            <?php } ?>
            <?php 
            if($this->session->userdata('user_type')=="DEO"){ ?>
              <li class="active treeview">
                <a href="<?php echo base_url() . 'index.php/Admin/Lists/School/aeo/'.$this->session->userdata('edudistrict_id'); ?>">
                    <i class="fa fa-circle-o"></i> <span>School List</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
               </li>
            <?php } ?>
            <!--Employee functions-->
<!--            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Employee</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() . 'index.php/secured_user/Employee/view_profile/'; ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>Profile</span> <i class="fa fa-angle-left pull-right"></i></a></li>
                    <li><a href="<?php echo base_url() . 'index.php/secured_user/Employee/serviceRecord/'; ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>Service Record </span><i class="fa fa-angle-left pull-right"></i></a></li>
                    <li><a href="<?php ?>"><i class="fa fa fa-circle-o" aria-hidden="true"></i> <span>Apply for leave</span> <i class="fa fa-angle-left pull-right"></i></a></li>
                </ul>
            </li>-->

            <!--Settings-->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa fa-cogs"></i> <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?= '<li><a href="' . site_url('secured_user/User/edit') . '"><i class="fa fa-circle-o"></i>Edit Profile</a></li>'; ?>
                    <?= '<li><a href="' . site_url('secured_user/User/change_password') . '"><i class="fa fa-circle-o"></i>Change Password</a></li>'; ?>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
