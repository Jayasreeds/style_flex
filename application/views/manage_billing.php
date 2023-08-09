<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4> 
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="btn-group mb-2" style="float: right;">
                        <a class="btn btn-primary" href="<?php echo base_url();?>addbilling">Add Bill +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>Bill No</th>
                                <th>Customer ID</th>
                                <?php if($type == '1')
                                {
                                    ?>
                                    <th>Branch Name</th>
                                    <?php
                                } ?>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Balance</th>
                                <th>Estimate Date</th>
                                <th>Invoice Status</th>
                                <th>Paid Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($billingdata))
                            {
                                foreach ($billingdata as $res) {
                                    $branchname =   $this->Branch_model->getBranchRow("branch_id = '".$res['branch_id']."'");  

                                    if($res['paid_status'] == '1')
                                    {
                                        $paid_status = "PAID";
                                        $class = "btn btn-outline-success";
                                    }
                                    else if($res['paid_status'] == '2')
                                    {
                                        $paid_status = "UNPAID";
                                        $class = "btn btn-outline-danger";
                                    }
                                    else if($res['paid_status'] == '3')
                                    {
                                        $paid_status = "PARTIALLY PAID";
                                        $class = "btn btn-outline-warning";
                                    }

                                    if($res['invoice_status'] == '1')
                                        $invoice_status = 'Invoiced';
                                    else
                                        $invoice_status = 'Convert to Invoice';
                                    $cusid = $this->Invoice_model->getBillsubRow("bill_no = '".$res['bill_no']."'");

                                    $cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$cusid['cus_id']."'");  
                                    ?>
                                    <tr>
                                        <td><?php echo strtoupper($res['bill_no']);?></td>
                                        <td><?php echo strtoupper($cusid['cus_id']);?></td>
                                        <?php if($type == '1')
                                        {
                                            ?>
                                            <td><?php echo strtoupper($branchname['branch_name']);?></td>
                                            <?php
                                        } ?>
                                        <td><?php echo ucwords($cus_data['cus_name']);?></td>
                                        <td><?php echo $cus_data['email'];?></td>
                                        <td><?php echo number_format($res['grand_total'],'2');?></td>
                                        <td><?php echo number_format($res['paid_amount'],'2');?></td>
                                        <td><?php echo number_format($res['grand_total'],'2');?></td>
                                        <td><?php echo $res['created_on'];?></td>
                                        <td>
                                        <?php if($res['invoice_status'] == '0')
                                        {
                                            ?>
                                            <button type="button" class="btn btn-outline-info change_invoicestatus" data-id="<?php echo $res['bill_no'];?>">Convert to Invoice</button>
                                        <?php
                                        }
                                        else if($res['invoice_status'] == '1')
                                        {
                                         ?>
                                            <a style="color: #fff;" class="btn btn-info" href="<?php echo base_url('viewbill/'.$res['bill_no']);?>" target="_blank">Invoiced</a>
                                         <?php
                                        }
                                         
                                        ?></td>
                                        <?php   
                                        if($res['paid_status']=='1')
                                        {
                                            ?>
                                            <td><button type="button" class="<?php echo $class;?>"><?php echo $paid_status;?></button></td>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <td><button type="button" class="<?php echo $class;?> change_paidstatus" data-id="<?php echo $res['bill_no'];?>"><?php echo $paid_status;?></button></td>
                                            <?php
                                        } ?>
                                        
                                        <td> 
                                            <div class="line-h-1 h5">  
                                               
                                                <a class="text-info" href="<?php echo base_url('viewbill/'.$res['bill_no']);?>" target="_blank"><i class="fa fa-bars"></i></a>
                                                <?php if($type == '1')
                                                {
                                                    ?>  
                                                <a class="text-success edit-invoice" href="<?php echo base_url('editbilling/'.$res['id']);?>"><i class="icon-pencil"></i></a>
                                                <a class="text-danger invoice_delete" data-id="<?php echo $res['bill_no'];?>"  ><i class="icon-trash"></i></a>
                                                <?php } ?>                                 
                                            </div>                                
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            
                        ?>
                             
                        </tbody>
                      
                    </table>
                    <!-- Modal -->
                    <!-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">View Bill Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4"><b>Bill No</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">STY4562</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Customer ID</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">CUS8472</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Customer Name</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">TestAdmin</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Customer Email</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">testadmin@gmail.com </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Customer Address</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">Test Address1, Test Address2, Location. </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Location</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">Test Location </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>State</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">Test State </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Zip Code</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">629844 </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Country</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">India </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Mobile Number</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">6957454545</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Status</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">Accepted</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4"><b>Due Date</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6">2020/11/19</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                        
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div> 

    </div>                  
</div>
 
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/billing.js"></script>
