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
                            <form id="addCategoryForm">
                                <div class="form-row">
                                    <!-- <div class="col-6 mb-3 form-group">
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
                                        

                                      </div> -->
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Category</label>

                                        <input type="text" class="form-control" name="category" id="category" placeholder="category ">

                                    </div>
                                    <div class="col-6 mb-3 form-group"> 
                                   <label for="status">Status<i class="text-danger"></i></label>                                               
                                   <select class="selectpicker" id="status" name ="status" >
                                       <option value="" >Select Status</option>
                                       <option value="1">Active</option>
                                       <option value="2">Inactive</option>
                                   </select>
                               </div>
                                    <!-- <div class="col-6 mb-3 form-group">
                                        <label for="username">Sub Category</label>

                                        <input type="text" class="form-control" name="sub_category" id="sub_category" placeholder="sub category">

                                    </div> -->
                                     <div class="col-12 mb-5">

                                        <button type="submit" class="btn btn-primary">Add Category</button>   <button type="button" id="cancel" class="btn btn-outline-warning">Cancel</button>

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

<script src="<?php echo base_url(); ?>assets/dist/js/manual_js/category.js"></script>
