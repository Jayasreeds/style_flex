
<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title>Pick Admin</title>
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/flags-icon/css/flag-icon.min.css"> 

        <!-- END Template CSS-->     

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/social-button/bootstrap-social.css"/>   
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/toastr/toastr.min.css"/>
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    <form action="#" class="row row-eq-height lockscreen  mt-5 mb-5" id="forgotForm">
                        <div class="lock-image col-12 col-sm-5"></div>
                        <div class="login-form col-12 col-sm-7">
                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" name="email" id="email" required="" placeholder="Enter your email">
                            </div>

                            
                            <div class="form-group mb-3">
                                     <!-- <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked=""> -->
                                <!-- <label><a href="<?php echo base_url();?>login/forgot">Forgot Password?</a></label> -->
                             </div>

                            <div class="form-group mb-0">
                                <button class="btn btn-primary" type="submit"> Send </button>
                                <!-- <a class="btn btn-primary" style="float: right;" > Log In </a> -->
                            </div>
                            
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- END: Content-->

        <!-- START: Template JS-->
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/moment/moment.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?php echo base_url();?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/dist/vendors/jquery-validation/jquery.validate.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/toastr/toastr.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/js/toastr.script.js"></script>
        <script type="text/javascript">
            var base_url = '<?php echo base_url();?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/login.js"></script>
        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->
</html>
