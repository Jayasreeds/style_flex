<!-- START: Card Data-->
<div class="row">
    <form id="editBillForm">
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
                                        <label for="username">Bill Number</label>

                                        <input type="text" class="form-control" name="billid" id="billid" value="<?php echo $billbasedata['bill_no'];?>" readonly>

                                    </div>

                                    <div class="col-md-6 mb-3 form-group">
                                        <label for="username">Branch Name</label>

                                        <select class="branch_id" name="branch_id" id="branch_id" disabled>
                                            <option value="">Select Branch</option>
                                            <?php 
                                            foreach ($branchdata as $branch) {
                                               ?> <option value="<?php echo $branch['branch_id']; ?>" <?php if($branch['branch_id']==$cus_data['branch_id']) echo 'selected="selected"'; ?>> <?php echo strtoupper($branch['branch_name']); ?></option>
                                               <?php
                                            }
                                            ?>
                                  
                                        </select>

                                    </div>
 
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer ID</label>

                                        <input type="text" class="form-control" name="cus_id" id="cus_id" readonly value="<?php echo strtoupper($cus_data['cus_id']);?>" >

                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer Name</label>

                                        <input type="text" class="form-control" name="cus_name" id="cus_name" disabled value="<?php echo ucwords($cus_data['cus_name']);?>" >

                                    </div>
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Customer Email</label>

                                        <input type="text" class="form-control" name="email" id="email" disabled value="<?php echo $cus_data['email'];?>" >

                                    </div>
                                    <div class="col-6 mb-3 form-group" >
                                        <label for="username">Billing Address</label>

                                        <textarea class="form-control" name="address" id="address" disabled><?php echo ucwords($cus_data['address']);?></textarea>

                                    </div>
                                     
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">State<i class="text-danger"></i></label>
                                        <div class="col-md-12" style="width:100%; padding:0px;" >
                                            <select class="state_id" name="state_id" id="state_id" disabled>
                                                <option value="">Select State</option>
                                                <?php if(!empty($state_list)){
                                                    foreach($state_list as $row ) {    ?>
                                                        <option value="<?php echo $row['state_id'] ?>" <?php if($row['state_id']==$cus_data['state_id']) echo 'selected="selected"'; ?>> <?php echo ucwords($row['state_name']) ?> </option>
                                                <?php }  
                                                    } ?>
                                            </select>

                                        </div>
                                    </div>
                                   
                                    <div class="col-6 mb-3 form-group">
                                        <label for="city_id">City<i class="text-danger"></i></label>

                                            <select class="city_id" name="city_id" id="city_id" disabled>
                                                <option value="">Select City</option>
                                                <?php if(!empty($city_list)){
                                                    foreach($city_list as $row1 ) {    ?>
                                                        <option value="<?php echo $row1['city_id'];?>" <?php if($row1['city_id']==$cus_data['city_id']) echo 'selected="selected"'; ?>> <?php echo ucwords($row1['city_name']) ?> </option>
                                                     <?php  }  
                                                } ?>
                                            </select>
                                    </div>
                                    
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Zip code</label>

                                        <input type="text" class="form-control" name="zip_code" id="zip_code" value="<?php echo $cus_data['zip_code'];?>" disabled>

                                    </div> 
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Mobile Number</label>

                                        <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $cus_data['mobile'];?>" disabled>

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
                                <?php if($billbasedata['paid_status']!='1')
                                {   ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                        <button class="btn btn-success" id="temp_save" name="temp_save" value="1" type="submit">Add</button>
                                        <!-- <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                                        <button class="btn btn-success tr_clone_add" id="add_relation" type="button">+ Add More</button> -->
                                          
                                    </div>
                                </div> 
                                <?php } ?>                 
                            
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
                                
                                <?php if(!empty($billsubdata))                       
                                {
                                    $i = '1';
                                    foreach ($billsubdata as $res) {
                                    ?>
                                        <tr>
                                            <tr>
                                                <td><input type="text" class="form-control quality_id1" name="quality_id1[]" value="<?php echo ucwords($res['quality_id']);?>" readonly></td>
                                                <td><input type="text" class="form-control size1" name="size1[]" value="<?php echo $res['size_id'];?>" readonly></td>
                                                <td><input type="text" class="form-control price1" name="price1[]" value="<?php echo $res['price'];?>" readonly></td>
                                                <td><input type="text" class="form-control quantity1" name="quantity1[]" value="<?php echo $res['quantity'];?>" ></td>
                                                <td><input type="text" class="form-control total1" name="total1[]" value="<?php echo $res['total'];?>" readonly></td>
                                                <td> </td>
                                                <!-- <td><button class="btn btn-danger delete" id="removeRows" type="button">Delete</button></td> -->
                                            </tr>
                                        </tr> 
                                        <?php  
                                        $i++;     
                                    }
                                }
                                ?>
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
                                
                                <input type="text" class="form-control" name="subtotal" id="subtotal" readonly value="<?php echo $billbasedata['subtotal'];?>">
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
                                
                                <input type="text" class="form-control discount" name="discount" id="discount" value="<?php echo $billbasedata['discount'];?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">GST Type</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group ">
                                
                                <select class="form-control gst" name="gst" id="gst">
                                    <option value="3" <?php if($billbasedata['gst_type']=="3") echo 'selected="selected"'; ?>>Non-GST</option>
                                    <option value="1" <?php if($billbasedata['gst_type']=="1") echo 'selected="selected"'; ?>>Exclusive</option>
                                    <option value="2" <?php if($billbasedata['gst_type']=="2") echo 'selected="selected"'; ?>>Inclusive</option>
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
                                
                                <input type="text" class="form-control gstamt" name="gstamt" id="gstamt" value="<?php echo $billbasedata['gst_val'];?>">
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
                                
                                <input type="text" class="form-control totalgst" name="totalgst" id="totalgst" value="<?php echo $billbasedata['gst_total'];?>" readonly>
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
                                
                                <input type="text" class="form-control gstprepost" name="gstprepost" id="gstprepost" value="<?php echo $billbasedata['gst_prepost'];?>" readonly>
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
                                
                                <input type="text" class="form-control" name="gtotal" id="gtotal" value="<?php echo $billbasedata['grand_total'];?>" readonly>
                            </div>
                        </div>
                        
                    </div>
                             
                        <div class="col-md-2">
                        </div>
 
                    </div>
                    <?php if($billbasedata['paid_status']!='1')
                    {
                        ?>
                        <div class="row mb-5">
                            <div class="col-md-10">
                            </div>
                            <div class="form-group col-md-2">
                                <input type="submit" class="btn btn-primary" name="fullform" value="Update Invoice Details">
                            </div>
                        </div>  
                        <?php
                    } ?>
                    
                </div>
            </div>
        </div>
        </form>

        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h4 class="card-title">Transaction Details</h4>                                   
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Estimate Date</th>
                                    <th scope="col">Total Rs.</th>
                                    <th scope="col">GST Type</th>
                                    <th scope="col">GST %</th>
                                    <th scope="col">Discount %</th>
                                    <th scope="col">Grand Total Rs.</th>
                                    <th scope="col">Paid Amount Rs.</th>
                                    <th scope="col">Balance Rs.</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($billbasedata))
                                {
                                   
                                        if($billbasedata['gst_type'] == '1')
                                            $type = 'Exclusive';
                                        else
                                            $type = 'Inclusive';
                                        ?>
                                        <tr>
                                            <!-- <th scope="row">1</th> -->
                                            <td><?php echo $billbasedata['created_on'];?></td>
                                            <td><?php echo number_format($billbasedata['subtotal'],'2');?></td>
                                            <td><?php echo strtoupper($type);?></td>
                                            <td><?php echo number_format($billbasedata['gst_val'],'2');?></td>
                                            <td><?php echo number_format($billbasedata['discount'],'2');?></td>
                                            <td><?php echo number_format($billbasedata['grand_total'],'2');?></td>
                                            <td><?php echo number_format($billbasedata['paid_amount'],'2');?></td>
                                            <td><?php echo number_format($billbasedata['balance'],'2');?></td>
                                            <td>
                                            <?php 
                                            if($billbasedata['paid_status']=='1')
                                            {
                                                ?>
                                                <a class="btn btn-success" href="javascript:void(0);" ><i class="fa fa-thumbs-up"> Paid</i></a>
                                                <?php
                                            }
                                            else
                                            {   
                                                ?>
                                                <a class="btn btn-primary get_edit_details" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $billbasedata['bill_no'];?>" data-target="#newtodo">Paid Status</a>
                                                <?php

                                            } ?>
                                            
                                            </td>

                                        </tr>
                                        <?php
                                    }
                              
                                
                                ?>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div> 

        </div>

        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h4 class="card-title">Paid Amount Details</h4>                                   
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Total Rs.</th>
                                    <th scope="col">#</th>
                                    <th scope="col">Paid Date</th>
                                    <th scope="col">Paid Amount Rs.</th>
                                    <th scope="col">Balance Rs.</th>
                                     
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($paymentdata))
                                {
                                    ?>
                                    <td rowspan="<?php echo $paymentdatacount+1;?>"><h4>Rs. <?php echo number_format($billbasedata['grand_total'],'2');?></h4></td>
                                    <?php
                                    $totalpaid = 0;
                                    $i='1';
                                    foreach($paymentdata as $res1)
                                    {
                                        $totalpaid+=$res1['paid_amount'];
                                        $bal = $billbasedata['grand_total'] - $totalpaid;
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $res1['paid_date'];?></td>
                                            <td><?php echo number_format($res1['paid_amount'],'2');?></td>
                                            <td><?php echo number_format($bal,'2');?></td>
                                            
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                              
                                
                                ?>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div> 

        </div>
    </div>
    <br /><br /><br />
        
<!-- Edit Todo -->
<div class="modal fade" id="newtodo">
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
            <form class="add-todo-form" id="paidForm">
                <div class="modal-body">                                               

                    <div class="form-group">
                        <label for="cus_name">Grand Total</label>                                               
                        <input type="text" name ="grand_total1" id ="grand_total1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Paid Amount</label>

                        <input type="text" class="form-control" name ="paid_amount1" id ="paid_amount1" readonly>

                    </div>  
                    <div class="form-group">
                        <label for="username">Pay Now</label>

                        <input type="text" class="form-control" name ="pay_now1" id ="pay_now1" autocomplete="off" required>

                    </div>  
                    <div class="form-group">
                        <label for="username">Paid Date</label>

                        <input type="text" class="form-control" name ="from_date" id ="from_date" autocomplete="off" required>

                    </div> 
                    <div class="form-group">
                        <label for="username">Balance</label>

                        <input type="text" class="form-control" name="balance1" id="balance1" readonly>

                    </div>    
                    <input type="hidden" name="billid1" id="billid1">                                             
                    <input type="hidden" name="id1" id="id1">   
                    <input type="hidden" name="paid_amount2" id="paid_amount2">                                           

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add-todo">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- END: Card DATA-->
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/billing.js"></script>
 