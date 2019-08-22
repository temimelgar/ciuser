<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url();?>/assets/AdminLTE/dist/img/avatar-default.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('full_name'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i><?php echo $this->session->userdata()['employee_id']; ?></a>
            </div>
        </div>

<!--         <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> -->

        <ul class="sidebar-menu">
            <li class="header" style="text-align: left;">Main Navigation</li>
            <li class="<?php echo ($this->uri->uri_string() == 'dashboard') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-cube"></i> <span>Home</span>
                </a>
            </li>

            <li class="treeview">
            <a href="#">
            <i class="fa fa-briefcase"></i> <span>Transactions</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>billingentry/"><i class="fa fa-plus-circle"></i> New Billing Entry</a></li>
                    <li><a href="<?php echo base_url(); ?>billingentry/viewbillingentries"><i class="fa fa-clock-o"></i> View Billing Entries</a></li>
                </ul>
            </li>

            <li class="treeview">
            <a href="#">
            <i class="fa fa-info-circle"></i> <span>Provider Account Info.</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>accountinfomobile/"><i class="fa fa-mobile"></i>Mobile</a></li>
                    <li><a href="<?php echo base_url(); ?>accountinfolandline/"><i class="fa fa-phone"></i>Landline</a></li>
                </ul>
            </li>

            <li class="treeview">
            <a href="#">
            <i class="fa fa-history"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>accountinfolandline/exportaccount"><i class="fa fa-mobile"></i>Accounts</a></li>
                    <li><a href="<?php echo base_url(); ?>billingentry/billing_entry_monthly"><i class="fa fa-book"></i>Billing Entries per Month</a></li>
  <!--                   <li><a href="#"><i class="fa fa-building"></i>Providers</a></li> -->
                </ul>
            </li>

            <li class="treeview">
            <a href="#">
            <i class="fa fa-cogs"></i> <span>Maintenance</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url(); ?>provider/"><i class="fa fa-tasks"></i> Providers</a></li>
<!--                     <li><a href="<?php echo base_url(); ?>assignee/"><i class="fa fa-tasks"></i> Assignee</a></li> -->
                </ul>
            </li>


        </ul>

    </section>
</aside>
