<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4>                                
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">                                           
                        <div class="col-12">
                            <form id="editProfile" method="post">
                                <div class="form-row">
                                    <div class="col-3 mb-3 form-group" >
                                        <label for="username">UserName </label>

                                    </div>
                                    <div class="col-1 mb-1 form-group" >
                                        :
                                    </div>
                                    <div class="col-3 mb-3 form-group" >
                                        <?php echo ucfirst($profiledata['username']); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-3 mb-3 form-group" >
                                        <label for="username">Email </label>

 
                                    </div>
                                    <div class="col-1 mb-1 form-group" >
                                        :
                                    </div>
                                    <div class="col-3 mb-3 form-group" >
                                        <?php echo $profiledata['email']; ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-3 mb-3 form-group" >
                                        <label for="username">Mobile Number </label>

                                    </div>
                                    <div class="col-1 mb-1 form-group" >
                                        :
                                    </div>
                                    <div class="col-3 mb-3 form-group" >
                                        <?php echo $profiledata['mobile']; ?>
                                    </div>
                                </div> 
                                <div class="form-row">
                                    <div class="col-3 mb-3 form-group" >
                                        <label for="username">Profile Image </label>

                                    </div>
                                    <div class="col-1 mb-1 form-group" >
                                        :
                                    </div>
                                    <div class="col-3 mb-3 form-group" >
                                        <img src="<?php echo base_url();?>uploads/logo/<?php echo $profiledata['logo'];?>" alt="" >
                                    </div>
                                   
                                    
                            
                                <div class="col-12">

                                    <a href="<?php echo base_url();?>profile" class="btn btn-primary">Edit</a>  

                                </div>
                            </form>
                        </div>
                    </div>   
                                    
                                
                           
                </div>
            </div>
        </div>
    </div>
</div>
 
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/profile.js"></script>
<!-- END: Card DATA-->