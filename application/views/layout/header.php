<!DOCTYPE html>

<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <!-- Meta, title, CSS, favicons, etc. -->

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="images/favicon.ico" type="image/ico" />



  <title>Online Assessment</title>



  <!-- Bootstrap -->

  <link href="<?php echo base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Data Table -->

  <link href="<?php echo base_url();?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

  <!-- Select2 -->

  <link href="<?php echo base_url();?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">

  <!-- Font Awesome -->

  <link href="<?php echo base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- NProgress -->

  <link href="<?php echo base_url();?>vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- iCheck -->

  <link href="<?php echo base_url();?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">



  <!-- bootstrap-progressbar -->

  <link href="<?php echo base_url();?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

  <!-- JQVMap -->

  <link href="<?php echo base_url();?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

  <!-- bootstrap-daterangepicker -->

  <link href="<?php echo base_url();?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">



  <!-- Custom Theme Style -->

  <link href="<?php echo base_url();?>build/css/custom.min.css" rel="stylesheet">

  <!-- jQuery -->

  <script src="<?php echo base_url();?>vendors/jquery/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>



</head>



<body class="nav-md">

  <div class="container body">

    <div class="main_container">

      <div class="col-md-3 left_col">

        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">

            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Online Exam</span></a>

          </div>



          <div class="clearfix"></div>

          <!-- sidebar menu : START-->

          <?php $this->load->view('/layout/sidebar'); ?>

          <!-- sidebar menu : END-->

        </div>

      </div>

      <!-- top navigation -->

      <div class="top_nav">

        <div class="nav_menu">

          <nav>

            <div class="nav toggle">

              <a id="menu_toggle"><i class="fa fa-bars"></i></a>

            </div>



            <ul class="nav navbar-nav navbar-right">

              <li class="">

                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                  <img src="<?php echo base_url().$user_profile_image; ?>" alt=""><?php echo $username; ?>

                  <span class=" fa fa-angle-down"></span>

                </a>

                <ul class="dropdown-menu dropdown-usermenu pull-right">

                  <li><a href="javascript:;"> Profile</a></li>

               <!--    <li>

                    <a href="javascript:;">

                      <span class="badge bg-red pull-right">50%</span>

                      <span>Settings</span>

                    </a>

                  </li>

                  <li><a href="javascript:;">Help</a></li> -->

                  <li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>

                </ul>

              </li>



           <!--    <li role="presentation" class="dropdown">

                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">

                  <i class="fa fa-envelope-o"></i>

                  <span class="badge bg-green">6</span>

                </a>

                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

                  <li>

                    <a>

                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>

                      <span>

                        <span>John Smith</span>

                        <span class="time">3 mins ago</span>

                      </span>

                      <span class="message">

                        Film festivals used to be do-or-die moments for movie makers. They were where...

                      </span>

                    </a>

                  </li>

                  <li>

                    <a>

                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>

                      <span>

                        <span>John Smith</span>

                        <span class="time">3 mins ago</span>

                      </span>

                      <span class="message">

                        Film festivals used to be do-or-die moments for movie makers. They were where...

                      </span>

                    </a>

                  </li>

                  <li>

                    <a>

                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>

                      <span>

                        <span>John Smith</span>

                        <span class="time">3 mins ago</span>

                      </span>

                      <span class="message">

                        Film festivals used to be do-or-die moments for movie makers. They were where...

                      </span>

                    </a>

                  </li>

                  <li>

                    <a>

                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>

                      <span>

                        <span>John Smith</span>

                        <span class="time">3 mins ago</span>

                      </span>

                      <span class="message">

                        Film festivals used to be do-or-die moments for movie makers. They were where...

                      </span>

                    </a>

                  </li>

                  <li>

                    <div class="text-center">

                      <a>

                        <strong>See All Alerts</strong>

                        <i class="fa fa-angle-right"></i>

                      </a>

                    </div>

                  </li>

                </ul>

              </li> -->

            </ul>

          </nav>

        </div>

      </div>

      <!-- /top navigation -->