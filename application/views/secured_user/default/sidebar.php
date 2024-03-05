<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">User Management</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript::;">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>

            </ul><!-- /.control-sidebar-menu -->

        </div><!-- /.tab-pane -->
        
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>
                <div class="form-group">
                    <i class="fa fa-pencil-square-o"></i>
                    <a href="">Edit Profile</a>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <i class="fa fa-user-secret"></i>
                   <a href="">Change Password</a>
                </div><!-- /.form-group -->


                <div class="form-group">
                    <i class="fa fa-minus-square"></i>
                    <a href="<?php echo base_url() . 'index.php/Auth/logout'; ?>">Sign Out</a>
                </div><!-- /.form-group -->

        </div><!-- /.form-group -->

        </form>
    </div><!-- /.tab-pane -->

</aside><!-- /.control-sidebar -->