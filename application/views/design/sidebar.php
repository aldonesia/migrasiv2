
      <body class="hold-transition skin-green fixed sidebar-mini"> <!-- .sidebar-collapse .fixed .layout-boxed -->
    <!-- Site wrapper -->
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url() ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>TMM</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><?php echo $title ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <?php
              if($this->session->userdata('role') == "R02"){
                echo '<a class="btn btn-lg btn-warning fa  fa-sign-out" style="margin:2px 2px 0 0;" href="'.base_url().'access/logout"> Log Out</a>';}
                else{echo '
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="'.base_url().'assets2/dist/img/nufail.jpg" class="user-image" alt="User Image">
                      <span class="hidden-xs">'.$username_logged.'</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="'.base_url().'assets2/dist/img/nufail.jpg" class="img-circle" alt="User Image">
                        <p>
                          <small>You are Logged In as '.$username_logged.'</small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <!-- <div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div> -->
                        <div class="pull-right">
                          <a href="'.base_url().'access/logout" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>';
                }
              ?>
              
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url()."assets2/" ?>dist/img/nufail.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $username_logged ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
           <?php
        $url_add_user = array('User','AddUser');
        $url_report = array('Report');
      ?>
      <?php
        $url_full_report = array('Report','ShowFullReport');
        $url_report_by_stat = array('Report','ShowStatusReport');
        $url_report_by_fase = array('Report','ShowFaseReport');
        $url_report_summary = array('Report','ShowSummaryReport');
        $url_report_by_date = array('Report','ShowReportbyDate');
        $url_report_excel = array('Report','ShowReport');
      ?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
           <ul class="sidebar-menu">
            <li class="header">MENU NAVIGASI</li>
            <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Report</span>
                <span class="label pull-right bg-blue"></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url($url_full_report); ?>"><i class="fa fa-circle-o"></i> Full Report</a></li>
                <li><a href="<?php echo site_url($url_report_by_stat); ?>"><i class="fa fa-circle-o"></i> Status Report</a></li>
                <li><a href="<?php echo site_url($url_report_summary); ?>"><i class="fa fa-circle-o"></i> Summary Report</a></li>
                <li><a href="<?php echo site_url($url_report_by_date); ?>"><i class="fa fa-circle-o"></i> Report by Date</a></li>
                <li><a href="<?php echo site_url($url_report_by_fase); ?>"><i class="fa fa-circle-o"></i> Report by Fase</a></li>
                <li><a href="<?php echo site_url($url_report_excel); ?>"><i class="fa fa-circle-o"></i> export report to Excel</a></li>
              </ul>
            </li>

             <li>
              <a href="#">
                <i class="fa fa-close"></i>
                <span><?php echo $username_logged?></span>
                <span class="label pull-right bg-blue"></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()."access/logout" ?>"><i class="fa fa-circle-o"></i> Sign Out</a></li>
              </ul>
            </li>
            <!-- /Santri -->
            <!-- /Nilai -->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>