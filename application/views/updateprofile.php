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
                                    <div class="col-6 mb-3 form-group" >
                                        <label for="username">UserName <i class="text-danger">*</i></label>

                                        <input type="text" name ="username" id ="username" class="form-control" placeholder="UserName" value="<?php echo $profiledata['username'];?>">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-6 mb-3 form-group"> 
                                        <label for="email">Email</label>                                               
                                        <input type="text" name ="email" id ="email" class="form-control" placeholder="Email" value="<?php echo $profiledata['email'];?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-6 mb-3 form-group">
                                        <label for="mobile">Mobile Number <i class="text-danger">*</i></label>

                                        <input type="text" name ="mobile" id ="mobile" class="form-control" placeholder="Mobile Number" value="<?php echo $profiledata['mobile'];?>">

                                    </div>
                                </div>
                                 <div class="col-6 mb-3 form-group">
                                    <label for="logofile">Choose Profile Image (File Dimension 100 X 100px)<i class="text-danger">*</i></label>
                                    
                                    <div class="">
                                        <input type="file" class="form-control" id="logofile" name="logofile">
                                        
                                        <div class="invalid-feedback">Example invalid file</div>
                                    </div><br />
                                    <img id="ImdID" src="<?php echo base_url();?>uploads/logo/<?php echo $profiledata['logo'];?>" style = "width:100px; height: 100px;">
                                    <div id="file_error"></div>
                                </div>
                                <input type="hidden" name="imagefile" id="imagefile" value="<?php echo $profiledata['logo'];?>">
                        
                                <div class="col-12">

                                    <button type="submit" id="save" class="btn btn-primary">Update Profile</button>   <button type="button" id="cancel" class="btn btn-outline-warning">Cancel</button>

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