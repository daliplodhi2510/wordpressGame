<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $title; ?></title>
      <?php  
         include 'styles.php';
         
         ?>
   </head>
   <body>
      <div id="wrapper">
      <nav class="navbar-default navbar-static-side" role="navigation">
          <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
         <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
               <li class="nav-header">
                  <div class="dropdown profile-element">
                     <span>
                     <!-- <img alt="image" class="img-circle" src="img/profile_small.jpg" /> -->
                     </span>
                     <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                     <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Gammer PRO</strong>
                     </span> <span class="text-muted text-xs block">ADMIN <b class="caret"></b></span> </span> </a>
                     <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <!--li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li-->
                        <li><a href="<?php echo base_url(); ?>admin/LoginController/logout">Logout</a></li>
                     </ul>
                  </div>
                  <div class="logo-element">
                     IN+
                  </div>
               </li>
               <li class="active">
                  <a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
               </li>
               <!--li>
                  <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Admin</span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="#"><i class="fa fa-circle-o"></i>Admin List</a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i>Admin Profile</a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i>Admin Password</a></li>
                  </ul>
               </li-->
               <!--li>
                  <a href="#"><i class="fa fa-sliders" aria-hidden="true"></i> <span class="nav-label">Slider</span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="#"><i class="fa fa-circle-o"></i>Listing</a></li>
                  </ul>
               </li-->
               <li>
                  <a href="#"><i class="fa fa-gamepad" aria-hidden="true"></i> <span class="nav-label">Matches</span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo base_url(); ?>admin/match/match-list"><i class="fa fa-circle-o"></i>Match List</a></li>
                     <li><a href="<?php echo base_url(); ?>admin/match/add-match"><i class="fa fa-circle-o"></i>Add Match</a></li>
                  </ul>
               </li>
               <!--li>
                  <a href="#"><i class="fa fa-play-circle" aria-hidden="true"></i> <span class="nav-label">Ongoing matches</span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="#"><i class="fa fa-circle-o"></i>Listing</a></li>
                  </ul>
               </li-->
               <li>
                  <a href="#"><i class="fa fa-money" aria-hidden="true"></i> <span class="nav-label">Withdrawal list</span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <!--li><a href="<?php  echo base_url();?>admin/withdrawal/listing"><i class="fa fa-circle-o"></i>Listing</a></li-->
                     <li><a href="<?php  echo base_url();?>admin/transaction/get-withdrawal-details"><i class="fa fa-circle-o"></i>Listing</a></li>
                  </ul>
               </li>
               <li>
                  <a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i> <span class="nav-label">Transaction list </span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <!--li><a href="<?php echo base_url();?>admin/transaction/tranaction-listing"><i class="fa fa-circle-o"></i>Listing</a></li-->
                     <li><a href="<?php echo base_url();?>admin/transaction/view-wallet-transaction-listing"><i class="fa fa-circle-o"></i>Wallet transaction listing</a></li>
                  </ul>
               </li>
               <li>
                  <a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span class="nav-label">Users </span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo base_url();?>admin/users/listing"><i class="fa fa-circle-o"></i>Listing</a></li>
                  </ul>
               </li>
               <!--li>
                  <a href="#"><i class="fa fa-bullhorn" aria-hidden="true"></i> <span class="nav-label">Announcement </span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="#"><i class="fa fa-circle-o"></i>Listing</a></li>
                  </ul>
               </li-->
               <!--li>
                  <a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i> <span class="nav-label">Send notification </span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="#"><i class="fa fa-circle-o"></i>Listing</a></li>
                  </ul>
               </li-->
               <!--li>
                  <a href="#"><i class="fa fa-tablet" aria-hidden="true"></i> <span class="nav-label">Games</span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="#"><i class="fa fa-circle-o"></i>Listing</a></li>
                  </ul>
               </li-->
               <li>
                  <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> <span class="nav-label">Master</span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo base_url(); ?>admin/master/rules-master"><i class="fa fa-circle-o"></i>Rules</a></li>
                     <li><a href="<?php echo base_url(); ?>admin/master/upload-image"><i class="fa fa-circle-o"></i>Images</a></li>
                     <li><a href="<?php echo base_url(); ?>admin/master/create-game"><i class="fa fa-circle-o"></i>Games</a></li>
                  </ul>
               </li>
               <li>
                  <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> <span class="nav-label">Configuration </span><span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                     <li><a href="#"><i class="fa fa-circle-o"></i>Pages</a></li>
                     <li><a href="<?php echo base_url();?>admin/pages/privacy-policy"><i class="fa fa-circle-o"></i>Privacy Policy</a></li>
                     <li><a href="<?php echo base_url();?>admin/pages/terms-and-condition"><i class="fa fa-circle-o"></i> Terms and Condition</a></li>
                     <li><a href="<?php echo base_url();?>admin/pages/contact-us"><i class="fa fa-circle-o"></i>Contact</a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i>Update</a></li>
                  </ul>
               </li>
            </ul>
         </div>
      </nav>
      <div id="page-wrapper" class="gray-bg dashbard-1">
      <div class="row border-bottom">
         <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
               <li>
                  <span class="m-r-sm text-muted welcome-message">Welcome to  <?php //echo $this->session->userdata['logged_in']['first_name'].' '.$this->session->userdata['logged_in']['last_name']; ?></span>
               </li>
               <li>
                  <a href="<?php echo base_url().'admin/LoginController/logout'; ?>">
                  <i class="fa fa-sign-out"></i> Log out
                  </a>
               </li>
            </ul>
         </nav>
      </div>