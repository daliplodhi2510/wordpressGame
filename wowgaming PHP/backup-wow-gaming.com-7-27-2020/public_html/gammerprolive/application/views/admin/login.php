<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gammerpro Login</title>

    <link href="<?php echo base_url();?>assets/admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin_assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/admin_assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin_assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">GAMMER PRO</h1>

            </div>
            
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" action="<?php echo base_url();?>admin/LoginController/doLogin" method="POST">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                </div>
                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Login</button>

               
            </form>
        </div>
    </div>
 <div class="row">
               <div class="col-md-4 col-md-offset-4 form-group">
                <?php 
                  if(!empty($this->session->flashdata('message'))): ?>
                    <div class="row">
                       <div class="col-md-12 text-center">
                          <div class="alert <?php print_r($this->session->flashdata('alert-class')); ?> text-center" style="font-weight: bold;">
                             <?php print_r($this->session->flashdata('message')['message']); ?>
                          </div>
                       </div>
                    </div>
                <?php endif; ?>
               </div>
            </div>
    <!-- Mainly scripts -->
    <script src="<?php echo base_url();?>assets/admin_assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin_assets/js/bootstrap.min.js"></script>

</body>

</html>
