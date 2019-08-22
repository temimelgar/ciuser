<header class="main-header">

    <a href="<?php echo base_url(); ?>dashboard/home" class="logo">

        <span class="logo-mini">IPC</span>

        <span class="logo-lg"><img src="<?php echo base_url('assets/images/logo_white.png');?>"></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a> 
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url();?>/assets/AdminLTE/dist/img/avatar-default.png" class="user-image" alt="User Image">

                        <span class="hidden-xs"><?php echo $this->session->userdata('full_name'); ?></span>

                    </a>
                    <ul class="dropdown-menu">

                        <li class="user-header">
                            <img src="<?php echo base_url();?>/assets/AdminLTE/dist/img/avatar-default.png" class="img-circle" alt="User Image">
                            <p>
                                <?php echo $this->session->userdata('employee_id'); ?>
                            </p>
                        </li>

                        <li class="user-footer">

                            <div class="pull-right">
                                <a href="<?php echo base_url('login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>