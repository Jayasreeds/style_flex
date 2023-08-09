<?php
$CI =& get_instance();
$CI->load->model('Settings_model');
$CI->load->model('Login_model');
$editsettingdata = $CI->Settings_model->getSettingRow('1');  
?>
<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title><?php echo ucwords($editsettingdata['title']);?></title>
        <link rel="shortcut icon" href="<?php echo base_url();?>uploads/logo/<?php echo $editsettingdata['icon'];?>" />
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- START: Page CSS-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
        <!-- END: Page CSS-->

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">        
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/flags-icon/css/flag-icon.min.css">         
        <!-- END Template CSS-->

        <!-- START: Page CSS-->
        <link rel="stylesheet"  href="<?php echo base_url();?>assets/dist/vendors/chartjs/Chart.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/sweetalert/sweetalert.css">
        <!-- END: Page CSS-->

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/morris/morris.css"> 
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/chartjs/Chart.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/starrr/starrr.css"> 
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/addtional.css">
         <script src="<?php echo base_url();?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

        <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.js"></script> -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/toastr/toastr.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/select2/css/select2.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/select2/css/select2-bootstrap.min.css"/>
        
 
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->
    <style type="text/css">
        .site-footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background: #101329 !important;
            text-align: center;
            color: #fff !important;
            text-align: center;
        }
    </style>

    <!-- START: Body-->
    <body id="main-container" class="default compact-menu">

        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div class="loader"></div>
        </div>
        <!-- END: Pre Loader-->

        <!-- START: Header-->
        <div id="header-fix" class="header fixed-top">
            <div class="site-width">
                <nav class="navbar navbar-expand-lg  p-0">
                    <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">  
                        <a href="<?php echo base_url();?>dashboard" class="horizontal-logo text-left">
                            <img src="<?php echo base_url();?>uploads/logo/<?php echo $editsettingdata['logo'];?>" style="    width: 135px !important;height: 150px;margin-top: -56px;margin-left: -11px;"> <!-- <span class="h4 font-weight-bold align-self-center mb-0 ml-auto addtional_head_p">Bill</span>  -->             
                        </a>                   
                    </div>
                    <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                        <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                    </div>

                    <!-- <form class="float-left d-none d-lg-block search-form">
                        <div class="form-group mb-0 position-relative">
                            <input type="text" class="form-control border-0 rounded bg-search pl-5" placeholder="Search anything...">
                            <div class="btn-search position-absolute top-0">
                                <a href="#"><i class="h6 icon-magnifier"></i></a>
                            </div>
                            <a href="#" class="position-absolute close-button mobilesearch d-lg-none" data-toggle="dropdown" aria-expanded="false"><i class="icon-close h5"></i>                               
                            </a>

                        </div>
                    </form> -->
                    <div class="navbar-right ml-auto h-100">
                        <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                            <li class="d-inline-block align-self-center  d-block d-lg-none">
                                <a href="#" class="nav-link mobilesearch" data-toggle="dropdown" aria-expanded="false"><i class="icon-magnifier h4"></i>                               
                                </a>
                            </li>                        

                            <?php
                             
                            if($this->session->userdata('type')=='1')
                            {
                                $img = $CI->Login_model->masterlogin("id='1'");
                                $logo = $img->logo;
                                $path = "uploads/logo/$logo";

                            }
                            else
                            {
                                $img = $CI->Login_model->adminlogin("branch_id = '".$this->session->userdata('branch_id')."'");
                                $logo = $img->doct_img;
                                $path = "assets/images/branch/$logo";

                            }
                          
                            ?>
                            <li class="dropdown user-profile align-self-center d-inline-block">
                                <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false"> 
                                    <div class="media">  
                                    <?php if($img)
                                    {
                                        ?>
                                        <img src="<?php echo base_url();?><?php echo $path;?>" alt="" class="d-flex img-fluid rounded-circle" width="29">
                                        <?php
                                    } 
                                    else{
                                        ?>
                                        <img src="<?php echo base_url();?>assets/images/logo/profile_img.jpg" alt="" class="d-flex img-fluid rounded-circle" width="29">
                                        <?php
                                    }   ?>
                                        
                                    </div>
                                </a>
                                <div class="dropdown-menu border dropdown-menu-right p-0">
                                <?php if($this->session->userdata('type')=='1')
                                {
                                    ?>
                                    
                                        <a href="<?php echo base_url();?>viewprofile" class="dropdown-item px-2 align-self-center d-flex">
                                            <span class="icon-pencil mr-2 h6 mb-0"></span> Profile</a>
                                        <a href="<?php echo base_url();?>changepass" class="dropdown-item px-2 align-self-center d-flex">
                                            <span class="icon-user mr-2 h6 mb-0"></span> Change Password</a>
                                        <div class="dropdown-divider"></div>
                                        
                                        <div class="dropdown-divider"></div>
                                        
                                            
                                    
                                    <?php
                                }
                                ?>
                                <a href="<?php echo base_url();?>login/logout" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- END: Header-->