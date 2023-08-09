<!-- START: Card Data-->
<div class="row">
    <form id="addBillForm">
        <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">                               
                <h4 class="card-title"><?php echo $page_title2;?></h4>                                
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div id="showid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover">   
                                <thead>
                                    <th width="20%">Model name</th>
                                    <th width="20%">Model numbers</th>
                                   
                                </thead>
                                <tbody class ='purchase_table'>                           
                                <tr>
                                    
                                     <td>
                                        <label for="username">Model name</label>
                                        <select name="model_id" id="model_id">
                                            <option value="">Select Model</option>
                                            <?php 
                                            if(!empty($modeldata))
                                            {
                                                foreach ($modeldata as $result) {
                                                    // $getname = $this->Quality_model->getQualityRow("quality_id = '".$result['quality_id']."'");
                                                    ?>
                                                    <option value="<?php echo $result['model_id'];?>"><?php echo ucwords($result['model_name']);?></option>
                                                    <?php
                                                }
                                            } ?>
                                            
                                        </select>
                                    </td>
                                     <td>
                                        <label for="username">Model number</label>

                                        <input type="text" class="form-control" name="model_number" id="model_number" placeholder="Model number">
                                    </td>
                                   
                                </tr> 
                                </tbody> 
                                </table> 
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                        <button class="btn btn-success" id="temp_save" name="temp_save" value="1" type="submit">Add</button>
                                        <!-- <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                                        <button class="btn btn-success tr_clone_add" id="add_relation" type="button">+ Add More</button> -->
                                          
                                    </div>
                                </div>                  
                            
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="temp_details">   
                                <thead>
                                    <th width="19.67%">Model name</th>
                                    <th width="19.67%">Model number</th>
                                    
                                    
                                </thead>
                                <tbody id="addtempdata" class="addtempdata">    
                                </tbody> 
                                </table> 
                              
                        </div>
                    </div>

                   </div>
                    
                   
                    
                </div>
            </div>
        </div>
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4>                                
            </div>
            
            <div class="card-content">
                <div class="card-body">
                    <div class="row">                                           
                        <div class="col-12 mb-5">
                            <!-- <form id="addCustomerForm"> -->
                                <div class="form-row">

                                    <div class="col-md-6 mb-3 form-group">
                                        <label for="username">Branch Name</label>
                                        <?php if($type=='1')
                                        { ?>
                                        

                                            <select class="branch_id" name="branch_id" id="branch_id" >
                                                <option value="">Select Branch</option>
                                                <?php 
                                                foreach ($branchdata as $branch) {
                                                   ?> <option value="<?php echo $branch['branch_id']; ?>" > <?php echo strtoupper($branch['branch_name']); ?></option>
                                                   <?php
                                                }
                                                ?>
                                      
                                            </select>

                                        
                                        <?php  }
                                        else
                                        {
                                            ?>
                                        

                                            <select class="branch_id" name="branch_id" id="branch_id" disabled>
                                                <option value="">Select Branch</option>
                                                <?php 
                                                foreach ($branchdata as $branch) {
                                                   ?> <option value="<?php echo $branch['branch_id']; ?>" <?php if($branch['branch_id']==$this->session->userdata('branch_id')) echo 'selected="selected"'; ?> > <?php echo strtoupper($branch['branch_name']); ?></option>
                                                   <?php
                                                }
                                                ?>
                                      
                                            </select>

                                        
                                        <?php
                                        } ?>
                                    </div>
                                   
                                     <div class="col-md-6 mb-3 form-group">
                                        <label for="username">Stock type</label>
                                       

                                            <select class="stock_type" name="stock_type" id="stock_type" >
                                                <option value="">Select stock type</option>
                                                 <option value="1" > new battery </option>
                                                  <option value="2" > second hand battery </option> 
                                                    <option value="3" > battery accessories</option> 
                                            </select>

                                        
                                        
                                    </div>
                                   

                                    <input type="hidden" name="tempbillno" id="tempbillno" value="<?php echo $tempbillno;?>">

                                    <div class="col-6 mb-3 form-group">
                                        <label for="category">Select Category<i class="text-danger">*</i></label>

                                        <select class="category" name="category" id="category">
                                            <option value="">Select Category</option>
                                            
                                            <?php 
                                            foreach ($categorydata as $res) {
                                               ?> <option value="<?php echo $res['category_id']; ?>" > <?php echo strtoupper($res['category']); ?></option>
                                               <?php
                                            }
                                            ?>
 
                                        </select>
                                    </div>

                                    <div class="col-6 mb-3 form-group">
                                        <label for="category">Select Sub Category<i class="text-danger">*</i></label>

                                        <select class="sub_category" name="sub_category" id="sub_category">
                                            <option value="">Select Sub Category</option>
                                            
                                            <?php 
                                            foreach ($categorydata as $res) {
                                               ?> <option value="<?php echo $res['sub_category']; ?>" > <?php echo strtoupper($res['sub_category']); ?></option>
                                               <?php
                                            }
                                            ?>
 
                                        </select>
                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="productname">Product Name</label>

                                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" autocomplete="off">

                                    </div>

                                   
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Price</label>

                                        <input type="text" class="form-control" name="price" id="price" placeholder="Price" autocomplete="off">

                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Quantity</label>

                                        <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity" autocomplete="off">

                                    </div>
                                    <div class="col-6 mb-3 form-group" >
                                        <label for="username">Tax</label>

                                        <input type="text" class="form-control" name="tax" id="tax" placeholder="Tax" autocomplete="off">
                                    </div>

                                    <div class="col-6 mb-3 form-group" >
                                        <label for="username">HSN / SAC Code</label>

                                        <input type="text" class="form-control" name="hsn_code" id="hsn_code" placeholder="HSN / SAC Code" autocomplete="off">

                                    </div>
                                     <div class="col-6 mb-3 form-group" >
                                        <label for="username">Warrenty</label>

                                        <input type="text" class="form-control" name="warrenty" id="warrenty" placeholder="warrenty" autocomplete="off">

                                    </div>
                                     

                                     <div class="col-6 mb-3 form-group" >
                                        <label for="username">AHM</label>

                                        <input type="text" class="form-control" name="ahm" id="ahm" placeholder="ahm" autocomplete="off">

                                    </div>
                                    <div class="form-group col-md-2">
                            <input type="submit" class="btn btn-primary" name="fullform" value="Save Stock Details">
                        </div>
                                   
                                   

                                    
                                    <!-- <div class="col-6 mb-3 form-group"> 
                                        <label for="status">Status<i class="text-danger"></i></label>                                               
                                            <select class="selectpicker status" id="status" name ="status">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                    </div> -->

                               
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    
        </form>

        <!-- div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h4 class="card-title">Transaction Details</h4>                                   
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Estimate Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">GST</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>21/11/2020</td>
                                    <td>Rs. 1000</td>
                                    <td>5 %</td>
                                    <td>2 %</td>
                                    <td>Rs. 1200</td>
                                    <td>Rs. 1200</td>
                                    <td>Rs. 0</td>
                                    <td><a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#newtodo">Paid Status</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>21/11/2020</td>
                                    <td>Rs. 1000</td>
                                    <td>5 %</td>
                                    <td>2 %</td>
                                    <td>Rs. 1200</td>
                                    <td>Rs. 1200</td>
                                    <td>Rs. 0</td>
                                    
                                    <td><a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#newtodo">Paid Status</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>21/11/2020</td>
                                    <td>Rs. 1000</td>
                                    <td>5 %</td>
                                    <td>2 %</td>
                                    <td>Rs. 1200</td>
                                    <td>Rs. 1200</td>
                                    <td>Rs. 0</td>
                                    
                                    <td><a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#newtodo">Paid Status</a></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div> 

        </div> -->
    </div>
    <br /><br /><br />
        
<!-- Edit Todo -->
<<!-- div class="modal fade" id="newtodo">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon-pencil"></i> Add Payment Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="icon-close"></i>
                </button>
            </div>
            <form class="add-todo-form">
                <div class="modal-body">                                               

                    <div class="form-group">
                        <label for="cus_name">Total</label>                                               
                        <input type="text" name ="cus_name" id ="cus_name" class="form-control" value="Rs. 5000">
                    </div>
                    <div class="form-group">
                        <label for="username">Paid Amount</label>

                        <input type="text" class="form-control" value ="Rs. 3000">

                    </div>   
                    <div class="form-group">
                        <label for="username">Paid Date</label>

                        <input type="text" class="form-control" value="21/11/2020">

                    </div> 
                    <div class="form-group">
                        <label for="username">Balance</label>

                        <input type="text" class="form-control" value="Rs. 2000">

                    </div>                                                 

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add-todo">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
</div>
<!-- END: Card DATA-->
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/billing.js"></script>
 