<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
          <form id="branch_edit_form" method="post">
            <div class="card-header">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4>                                
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">                                           
                        <div class="col-12 mb-1">
                            
                                <div class="form-row">
                                    <div class="col-6 mb-3 form-group" >
                                        <label for="first_name">First Name <i class="text-danger">*</i></label>

                                        <input type="text" name ="first_name" id ="first_name" class="form-control" placeholder="First Name" value="<?php echo $editbranchdata['first_name'];?>">

                                    </div>
                                    <div class="col-6 mb-3 form-group"> 
                                        <label for="last_name">Last Name</label>                                               
                                        <input type="text" name ="last_name" id ="last_name" class="form-control" placeholder="Last Name" value="<?php echo $editbranchdata['last_name'];?>">
                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="mobile_number">Mobile Number <i class="text-danger">*</i></label>

                                        <input type="text" name ="mobile_number" id ="mobile_number" maxlength="10" class="form-control" placeholder="Mobile Number" value="<?php echo $editbranchdata['mobile_number'];?>">

                                    </div>

                                    <div class="col-6 mb-3 form-group">
                                      <label for="mobile_number">Choose Profile Image (File Dimension 100 X 100px)<i class="text-danger">*</i></label>
                                       
                                          <input type="file" class="form-control" id="validatedCustomFile" name="validatedCustomFile">
                                          
                                          <div class="invalid-feedback">Example invalid file</div><br />
                                         
                                        <img id="ImdID" src="<?php echo base_url();?>assets/images/branch/<?php echo $editbranchdata['doct_img'];?>" style = "width:100px; height: 100px;">
                                        <div id="file_error"></div>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card-header">                               
                                <h4 class="card-title">Login Information</h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12 mb-1">
                                   
                               
                                    <div class="row">
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">UserName<i class="text-danger">*</i></label>

                                        <input type="text" name ="username" id ="username" class="form-control" placeholder="UserName" value="<?php echo $editbranchdata['username'];?>">

                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="password">Password<i class="text-danger">*</i></label>

                                        <input type="password" name ="password" id ="password" class="form-control" placeholder="Password" value="<?php echo $editbranchdata['password'];?>">

                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-6 mb-3 form-group">
                                        <label for="cpassword">Confirm Password<i class="text-danger">*</i></label>

                                        <input type="password" name ="cpassword" id ="cpassword"  class="form-control" placeholder="Confirm Password" value="<?php echo $editbranchdata['password'];?>">

                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                             <div class="card-header">                               
                                <h4 class="card-title"><?php echo $page_title2;?></h4>                                
                            </div>  
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12 mb-5">                             

                            
                           <div class="form-row">
                           <div class="col-6 mb-3 form-group">
                                   <label for="branch_name">Branch Name<i class="text-danger">*</i></label>

                                   <input type="text" name ="branch_name" id ="branch_name" class="form-control" placeholder="Branch Name" value="<?php echo $editbranchdata['branch_name'];?>">

                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="branch_code">Branch Code<i class="text-danger">*</i></label>
                                   <div >
                                   <input type="text" name ="branch_code" id ="branch_code" class="form-control" placeholder="Branch Code" value="<?php echo $editbranchdata['branch_code'];?>">
                                   </div>
                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="username">State<i class="text-danger">*</i></label>
                                   <div class="col-md-12" style="width:100%; padding:0px;" >
                                   <select  class="selectpicker" name="state_id" id="state_id">
                                 <option value="">Select State</option>
                                 <?php if(!empty($state_list)){
                                    foreach($state_list as $row ) {    ?>
                                 <option value=" <?php echo $row['state_id'] ?> " <?php if($editbranchdata['state_id']==$row['state_id']) echo 'selected="selected"'; ?>> <?php echo  ucwords($row['state_name']) ?> </option>
                                 <?php    }  } ?>
                              </select>

                               </div>
                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="city_id">City<i class="text-danger">*</i></label>

                                   <select class="selectpicker" name="city_id" id="city_id">
                                 <option value="">Select City</option>
                                 <?php if(!empty($city_list)){
                                    foreach($city_list as $row ) {    ?>
                                 <option value=" <?php echo $row['city_id'] ?> " <?php if($editbranchdata['city_id']==$row['city_id']) echo 'selected="selected"';?>> <?php echo  ucwords($row['city_name']) ?> </option>
                                 <?php    }  } ?>
                              </select>
                               </div>
                               <div class="col-6 mb-3 form-group"> 
                                   <label for="branch_address">Branch Address<i class="text-danger">*</i></label>                                       
                                   <textarea class="form-control" name ="branch_address" id ="branch_address"   placeholder="Branch Address"><?php echo $editbranchdata['branch_address'];?></textarea>     
                                </div>

                               <div class="col-6 mb-3 form-group">
                                   <label for="pincode">Pincode<i class="text-danger">*</i></label>

                                   <input type="number" name ="pincode" id ="pincode" minlength="6" maxlength="6" class="form-control" placeholder="Pincode" value="<?php echo $editbranchdata['pincode'];?>">

                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="landline_number">Landline Number</label>

                                   <input type="number" name ="landline_number" id ="landline_number" class="form-control" placeholder="Landline" value="<?php echo $editbranchdata['landline_number'];?>">

                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="branch_mobile_number">Mobile Number (use comma if more than one number needed) <i class="text-danger">*</i></label>

                                   <input type="text" name ="branch_mobile_number" onkeypress="CheckNumeric(event);" id ="branch_mobile_number" class="form-control" placeholder="##########,##########" value="<?php echo $editbranchdata['branch_mobile_number'];?>">

                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="email_id">Email Id</label>

                                   <input type="email" name ="email_id" id ="email_id" class="form-control" placeholder="Email Id" value="<?php echo $editbranchdata['email_id'];?>">

                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="reg_no">Registration Number</label>

                                   <input type="text" name ="reg_no" id ="reg_no" class="form-control" placeholder="Registration Number" value="<?php echo $editbranchdata['reg_no'];?>">

                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="gst_no">GST Number</label>

                                   <input type="text" name ="gst_no" id ="gst_no" class="form-control" placeholder="GST Number" value="<?php echo $editbranchdata['gst_no'];?>">

                               </div>
                               <div class="col-6 mb-3 form-group">
                                   <label for="pan_no">PAN Number</label>

                                   <input type="text" name ="pan_no" id ="pan_no" class="form-control" placeholder="PAN Number" value="<?php echo $editbranchdata['pan_no'];?>">

                               </div>
                               <div class="col-6 mb-3 form-group"> 
                                   <label for="status">Status<i class="text-danger">*</i></label>                                               
                                   <select class="selectpicker" id="status" name ="status"   class="form-control">
                                       <option value="" >Select Status</option>
                                       <option value="1" <?php if($editbranchdata['status']=='1') echo 'selected="selected"';?>>Active</option>
                                       <option value="2" <?php if($editbranchdata['status']=='2') echo 'selected="selected"';?>>Inactive</option>
                                   </select>
                               </div>

                              <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $editbranchdata['branch_id'];?>">
                              <input type="hidden" name="doct_img" value="<?php echo $editbranchdata['doct_img'];?>">

                               <div class="col-12 mb-1">

                                   <button type="submit" id="save" class="btn btn-primary">Update Details</button>   <button type="button" id="branchbtn" class="btn btn-outline-warning">Cancel</button>

                               </div>
                           </div></div>
                         </div>
                       </div>
                     </div>
                       
                   </div>   
                                    
                                
                           
                        </div>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </div>
   
</div>
<script src="<?php echo base_url(); ?>assets\dist\js\branch\branch.js"></script>

<!-- END: Card DATA-->