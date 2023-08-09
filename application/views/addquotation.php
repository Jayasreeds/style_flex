<!-- START: Card Data-->
<div class="row">
    <form id="addQuotationForm">
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

                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Quotation Number</label>

                                        <input type="text" class="form-control" name="quoteid" id="quoteid" value="<?php echo $quoteno;?>" readonly>

                                    </div>

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

                                    <div class="col-6 mb-3 form-group">
                                        <label for="customers">Select Customer<i class="text-danger">*</i></label>

                                        <select class="customers" name="customers" id="customers">
                                            <option value="">Select Customer</option>
                                            <option value="new">NEW CUSTOMER</option>
                                            <?php 
                                            foreach ($customerdata as $res) {
                                               ?> <option value="<?php echo $res['id']; ?>" > <?php echo strtoupper($res['cus_name']); ?></option>
                                               <?php
                                            }
                                            ?>
 
                                        </select>
                                    </div>

                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer ID</label>

                                        <input type="text" class="form-control" name="cus_id" id="cus_id" placeholder="Customer ID" autocomplete="off">

                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer Name</label>

                                        <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="Customer Name" autocomplete="off">

                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer Email</label>

                                        <input type="text" class="form-control" name="email" id="email" placeholder="Customer Email" autocomplete="off">

                                    </div>
                                    <div class="col-6 mb-3 form-group" >
                                        <label for="username">Customer Address</label>

                                        <textarea class="form-control" name="address" id="address" placeholder="Customer Address" autocomplete="off"></textarea>

                                    </div>
                                     
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">State<i class="text-danger"></i></label>
                                        <div class="col-md-12" style="width:100%; padding:0px;" >
                                            <select class="state_id" name="state_id" id="state_id">
                                                <option value="">Select State</option>
                                                <?php if(!empty($state_list)){
                                                    foreach($state_list as $row ) {    ?>
                                                        <option value="<?php echo $row['state_id'] ?>"> <?php echo ucwords($row['state_name']) ?> </option>
                                                <?php }  
                                                    } ?>
                                            </select>

                                        </div>
                                    </div>
                                   
                                    <div class="col-6 mb-3 form-group">
                                        <label for="city_id">City<i class="text-danger"></i></label>

                                            <select class="city_id" name="city_id" id="city_id">
                                                <option value="">Select City</option>
                                                <?php if(!empty($city_list)){
                                                    foreach($city_list as $row1 ) {    ?>
                                                        <option value="<?php echo $row1['city_id'];?>"> <?php echo ucwords($row1['city_name']) ?> </option>
                                                     <?php  }  
                                                } ?>
                                            </select>
                                    </div>

                                    <input type="hidden" name="temp_city_id" id="temp_city_id">
                                    
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Zip code</label>

                                        <input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Zip code" autocomplete="off">

                                    </div> 
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Mobile Number</label>

                                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" autocomplete="off" >

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
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">                               
                <h4 class="card-title"><?php echo $page_title2;?></h4>                                
            </div>
            <div class="card-content">
                <div class="card-body">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover">   
                                <thead>
                                    <th width="20%">Quality</th>
                                    <th width="20%">Size</th>
                                    <th width="20%">Price</th>
                                    <th width="20%">Quantity</th>                              
                                    <th width="20%">Total</th>
                                </thead>
                                <tbody class ='purchase_table'>                           
                                <tr>
                                    <td>
                                        <select name="quality_id" id="quality_id">
                                            <option value="">Select Quality</option>
                                            <?php 
                                            if(!empty($qualitydata))
                                            {
                                                foreach ($qualitydata as $result) {
                                                    $getname = $this->Quality_model->getQualityRow("quality_id = '".$result['quality_id']."'");
                                                    ?>
                                                    <option value="<?php echo $result['quality_id'];?>"><?php echo ucwords($getname['quality_name']);?></option>
                                                    <?php
                                                }
                                            } ?>
                                            
                                        </select>
                                    </td>
                                    <td>
                                        <select name="size" id="size">
                                            <option value="">Select Size</option>
                                            <?php 
                                                if(!empty($sizedata))
                                                {
                                                    foreach ($sizedata as $result) {
                                                        $typname = $this->Size_model->getSizeTypeRow("type_id = '".$result['type_id']."'"); 
                                                        ?>
                                                        <option value="<?php echo $result['size_id'];?>"><?php echo $result['size_det']." ".ucfirst($typname['type_name']);?></option>
                                                        <?php
                                                    }
                                                } ?>
                                             
                                        </select>
                                    </td>            
                                    <td><input type="text" class="form-control" name="price" id="price" placeholder="Price" readonly></td>
                                    <td><input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity"></td>
                                    <td><input type="number" class="form-control" name="total" id="total" placeholder="Total" readonly></td>
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
                                    <th width="19.67%">Quality</th>
                                    <th width="19.67%">Size</th>
                                    <th width="18.67%">Price</th>
                                    <th width="17.67%">Quantity</th>                              
                                    <th width="18.67%">Total</th>
                                    <th width="5.67%">Action</th>
                                </thead>
                                <tbody id="addtempdata" class="addtempdata">    
                                </tbody> 
                                </table> 
                              
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">SubTotal</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                
                                <input type="text" class="form-control" name="subtotal" id="subtotal" readonly placeholder="SubTotal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Discount (%)</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                
                                <input type="text" class="form-control discount" name="discount" id="discount" value="0" placeholder="Discount %">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="temp_discount" id="temp_discount">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">GST Type</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                
                                <select class="form-control gst" name="gst" id="gst">
                                        <option value="3">Non-GST</option>
                                        <option value="1">Exclusive</option>
                                        <option value="2">Inclusive</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div id="show_gst_id">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                             <label class="control-label">GST (%)</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                
                                <input type="text" class="form-control gstamt" name="gstamt" id="gstamt" value="0">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div id="show_total_gst_id">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                             <label class="control-label">Total GST</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                
                                <input type="text" class="form-control totalgst" name="totalgst" id="totalgst" value="0" placeholder="GST" readonly>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div id="show_prepost_gst_id">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                             <label class="control-label" id="gsttype">Post-GST Amount</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                
                                <input type="text" class="form-control gstprepost" name="gstprepost" id="gstprepost" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Grand Total</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                
                                <input type="text" class="form-control" name="gtotal" id="gtotal" placeholder="Grand Total" readonly>
                            </div>
                        </div>
                        
                    </div>
                             
                        <div class="col-md-2">
                        </div>
 
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-10">
                        </div>
                        <div class="form-group col-md-2">
                            <input type="submit" class="btn btn-primary" name="fullform" value="Save Quotaion Details">
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
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/quotation.js"></script>
 