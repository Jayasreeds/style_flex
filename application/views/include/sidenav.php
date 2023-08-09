 <?php $uri=$this->uri->segment(1);   ?>
 <!-- START: Main Menu-->
<div class="sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown active"><a href="#"><i class="icon-home mr-1"></i> Dashboard</a>                  
                <ul>
                    <li class="<?php if($uri=='dashboard') echo 'active'; ?>"><a href="<?php echo base_url();?>dashboard"><i class="icon-rocket"></i> Dashboard</a></li>
                   
                </ul>
            </li>
            <!-- <li class="dropdown"><a href="#"><i class="icon-user mr-1"></i> Profile</a>
                <ul>
                    <li class=""><a href="<?php echo base_url();?>profile/viewprofile"><i class="icon-user"></i>View Profile</a>
                       
                    </li>
                    <li class=""><a href="<?php echo base_url();?>profile/changepass"><i class="icon-key"></i>Change Password</a>
                       
                    </li>
                   
                   
                </ul>
            </li> -->
             <?php 
            if($this->session->userdata('type')=='1')
            {
                ?>
                <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i> Our Branch</a>                  
                    <ul>
                        <li class="<?php if($uri=='branch') echo 'active'; ?>"><a href="<?php echo base_url();?>branch"><i class="icon-organization"></i> Manage Branch</a></li>
                        <li class="<?php if($uri=='addbranch') echo 'active'; ?>"><a href="<?php echo base_url();?>addbranch"><i class="icon-organization"></i> Add Branch</a></li>                           
                       
                    </ul>                   
                </li>
                <?php
            } ?>
             <li class="dropdown"><a href="#"><i class="fa fa-list-alt mr-1"></i> Category</a>                 
                <ul>
                    <li class="<?php if($uri=='category') echo 'active'; ?>"><a href="<?php echo base_url();?>category"><i class="fas fa-user"></i>Manage Category</a>                  
                    </li> 
                    <li class="<?php if($uri=='addcategory') echo 'active'; ?>"><a href="<?php echo base_url();?>addcategory"><i class="fas fa-user-plus"></i>Add Category</a> 
                    </li>
                    <li class="<?php if($uri=='addsubcategory') echo 'active'; ?>"><a href="<?php echo base_url();?>addsubcategory"><i class="fas fa-user-plus"></i>Add SubCategory</a> 
                    </li>
                     
                </ul>                   
            </li>
             <li class="dropdown"><a href="#"><i class="fa fa-th-large"></i> Stock</a>                 
                <ul>
                    <li class="<?php if($uri=='model_name') echo 'active'; ?>"><a href="<?php echo base_url();?>model_name"><i class="fas fa-user"></i>Manage Model</a>                  
                    </li> 
                    <li class="<?php if($uri=='addmodel') echo 'active'; ?>"><a href="<?php echo base_url();?>addmodel"><i class="fas fa-user-plus"></i>Add Model</a> 
                    </li>
                     
                </ul>                   
            </li>


            
           
            

            <li class="dropdown"><a href="#"><i class="fas fa-user-circle mr-1"></i> Customers</a>                 
                <ul>
                    <li class="<?php if($uri=='customers') echo 'active'; ?>"><a href="<?php echo base_url();?>customers"><i class="fas fa-user"></i>Manage Customers</a>                  
                    </li> 
                    <li class="<?php if($uri=='addcustomer') echo 'active'; ?>"><a href="<?php echo base_url();?>addcustomer"><i class="fas fa-user-plus"></i>Add Customers</a> 
                    </li>
                     
                </ul>                   
            </li>
            <li class="dropdown"><a href="#"><i class="fas fa-caret-square-up mr-1"></i>Quality</a>                  
                <ul>
                    <li class="<?php if($uri=='quality') echo 'active'; ?>"><a href="<?php echo base_url();?>quality"><i class="fas fa-caret-square-up"></i>Manage Quality</a>                  
                    </li> 
                    <!-- <li><a href="#"><i class="fas fa-caret-square-up"></i>Add Quality</a>  -->
                    </li>
                </ul>                 
            </li>
            <li class="dropdown"><a href="#"><i class="far fa-square mr-1"></i> Size</a>                  
                <ul>
                    <li class="<?php if($uri=='addtype') echo 'active'; ?>"><a href="<?php echo base_url();?>addtype"><i class="far fa-square"></i>Manage Size Type</a>                                
                    </li>
                    <li class="<?php if($uri=='size') echo 'active'; ?>"><a href="<?php echo base_url();?>size"><i class="far fa-square"></i>Manage Size</a>                                
                    </li>
                    <!-- <li><a href="user-profile.html"><i class="far fa-square"></i>Add Size</a></li> -->
                </ul>                   
            </li>
            <li class="dropdown"><a href="#"><i class="fas fa-money-bill-wave-alt mr-1"></i> Price</a>                  
                <ul>
                    <li class="<?php if($uri=='price') echo 'active'; ?>"><a href="<?php echo base_url();?>price"><i class="fas fa-money-bill-wave-alt"></i>Manage Price</a>                                
                    </li>
                    <!-- <li><a href="user-profile.html"><i class="fas fa-money-bill-wave-alt"></i>Add New Price</a></li> -->
                </ul>                   
            </li>
            <li class="dropdown"><a href="#"><i class="far fa-money-bill-alt mr-1"></i> Billing</a>                   
                <ul>
                    <li class="<?php if($uri=='billing') echo 'active'; ?>"><a href="<?php echo base_url();?>billing"><i class="far fa-money-bill-alt"></i>Manage Billing</a>                               
                    </li>
                    <li class="<?php if($uri=='addbilling') echo 'active'; ?>"><a href="<?php echo base_url();?>addbilling"><i class="far fa-money-bill-alt"></i>Add Billing</a>                               
                    </li>
                    <li class="<?php if($uri=='invoice') echo 'active'; ?>"><a href="<?php echo base_url();?>invoice"><i class="fas fa-print"></i>Invoices</a>                               
                    <li class="<?php if($uri=='quotation') echo 'active'; ?>"><a href="<?php echo base_url();?>quotation"><i class="far fa-newspaper"></i>Manage Quotation</a>                                     
                    </li> 
                    <li class="<?php if($uri=='addquotation') echo 'active'; ?>"><a href="<?php echo base_url();?>addquotation"><i class="far fa-newspaper"></i>Add Quotation</a></li>   
                    
                </ul>                    
            </li>
            <li class="dropdown"><a href="#"><i class="fas fa-list-alt mr-1"></i> Reports</a>
                <ul>
                    <li class="<?php if($uri=='reports') echo 'active'; ?>"><a href="<?php echo base_url();?>reports"><i class="fas fa-list-alt"></i>Customer Reports</a>
                       
                    </li>
                    <li class="<?php if($uri=='billing_reports') echo 'active'; ?>"><a href="<?php echo base_url();?>billing_reports"><i class="fas fa-list-alt"></i>Billing Reports</a>
                       
                    </li>

                    <li class="<?php if($uri=='quotation_reports') echo 'active'; ?>"><a href="<?php echo base_url();?>quotation_reports"><i class="fas fa-list-alt"></i>Quotation Reports</a>
                       
                    </li>
                     
                </ul>
            </li>
            <?php 
            if($this->session->userdata('type')=='1')
            {
                ?>
            <li class="dropdown"><a href="#"><i class="fas fa-cogs mr-1"></i> Site Settings</a>                  
                <ul>
                    <li class="<?php if($uri=='sitesettings') echo 'active'; ?>"><a href="<?php echo base_url();?>sitesettings"><i class="fas fa-cog"></i> Site Settings</a></li>
                   
                </ul>
            </li>
        <?php } ?>
            <li class="dropdown"><a href="#"><i class="fas fa-lock mr-1"></i> Logout</a>
                <ul>
                    <li><a href="<?php echo base_url();?>login/logout"><i class="fas fa-lock"></i>Logout</a>
                       
                    </li>
                     
                </ul>
            </li>
        </ul>
        <!-- END: Menu-->
        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
<!-- END: Main Menu-->
