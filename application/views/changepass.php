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
                            <form id="editPass" method="post">
                                <div class="form-row">
                                    <div class="col-6 mb-3 form-group" >
                                        <label for="username">Current Password <i class="text-danger">*</i></label>

                                        <input type="password" name ="cpass" id ="cpass" class="form-control" placeholder="Current Password">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-6 mb-3 form-group"> 
                                        <label for="email">New Password</label>                                               
                                        <input type="password" name ="npass" id ="npass" class="form-control" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-6 mb-3 form-group">
                                        <label for="mobile">Retype New Password <i class="text-danger">*</i></label>

                                        <input type="password" name ="rpass" id ="rpass" class="form-control" placeholder="Retype New Password">

                                    </div>
                                </div>
                                 
                                <div class="col-12">

                                    <button type="submit" class="btn btn-primary">Update Password</button>   <button type="button" id="cancel" class="btn btn-outline-warning">Cancel</button>

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