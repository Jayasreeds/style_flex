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
                        <div class="col-12 mb-5">
                            <form id="addCustomerForm">
                                <div class="form-row">
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Branch Name</label>
                                          
                                        <?php if($type=='1')
                                        {
                                            ?>
                                            <select name="branch_id" id="branch_id" class="selectpicker">
                                              <option value="">Choose...</option>
                                              <?php 
                                              foreach ($branchdata as $branch) {
                                                 ?> <option value="<?php echo $branch['branch_id']; ?>" > <?php echo strtoupper($branch['branch_name']); ?></option>

                                                 <?php
                                              }
                                            ?></select><?php
                                        }
                                        else
                                        {
                                            ?>
                                            <select name="branch_id" disabled id="branch_id" class="selectpicker">
                                              <option value="">Choose...</option>
                                              <?php 
                                              foreach ($branchdata as $branch) {
                                                 ?> <option value="<?php echo $branch['branch_id']; ?>" <?php if($branch['branch_id']==$this->session->userdata('branch_id')) echo 'selected="selected"'; ?>> <?php echo strtoupper($branch['branch_name']); ?></option>
                                            
                                                 <?php
                                              }
                                            ?></select><?php
                                        } ?>
                                        

                                      </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer ID</label>

                                        <input type="text" class="form-control" name="cus_id" id="cus_id" placeholder="Customer ID">

                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer Name</label>

                                        <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="Customer Name">

                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer Email</label>

                                        <input type="text" class="form-control" name="email" id="email" placeholder="Customer Email">

                                    </div>
                                    <div class="col-6 mb-3 form-group" >
                                        <label for="username">Billing Address</label>

                                        <textarea class="form-control" name="address" id="address" placeholder="Billing Address"></textarea>

                                    </div>
                                     
                                       <div class="col-6 mb-3 form-group">
                                   <label for="username">State<i class="text-danger"></i></label>
                                   <div class="col-md-12" style="width:100%; padding:0px;" >
                                   <select class="selectpicker" name="state_id" id="state_id">
                                 <option value="">Select State</option>
                                 <?php if(!empty($state_list)){
                                    foreach($state_list as $row ) {    ?>
                                 <option value=" <?php echo $row['state_id'] ?> "> <?php echo  ucwords($row['state_name']) ?> </option>
                                 <?php    }  } ?>
                              </select>

                               </div>
                           </div>
                                   
                                    <div class="col-6 mb-3 form-group">
                                   <label for="city_id">City<i class="text-danger"></i></label>

                                   <select class="selectpicker" name="city_id" id="city_id">
                                 <option value="">Select City</option>
                                 <?php if(!empty($city_list)){
                                    foreach($city_list as $row ) {    ?>
                                 <option value=" <?php echo $row['city_id'] ?> "> <?php echo  ucwords($row['city_name']) ?> </option>
                                 <?php    }  } ?>
                              </select>
                               </div>
                                    
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Zip code</label>

                                        <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip code">

                                    </div> 
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Mobile Number</label>

                                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">

                                    </div>
                                     <div class="col-6 mb-3 form-group"> 
                                   <label for="status">Status<i class="text-danger"></i></label>                                               
                                   <select class="selectpicker" id="status" name ="status" >
                                       <option value="" >Select Status</option>
                                       <option value="1">Active</option>
                                       <option value="0">Inactive</option>
                                   </select>
                               </div>

                                    <div class="col-12 mb-5">

                                        <button type="submit" class="btn btn-primary">Add Customer</button>   <button type="button" id="cancel" class="btn btn-outline-warning">Cancel</button>

                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
</div>
<!-- END: Card DATA-->

<script src="<?php echo base_url(); ?>assets/dist/js/manual_js/customer.js"></script>
