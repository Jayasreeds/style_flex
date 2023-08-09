
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4> 
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="btn-group mb-2" style="float: right;">
                        <a class="btn btn-primary" href="<?php echo base_url();?>addcustomer">Add Customer +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <?php if($type == '1')
                                {
                                    ?>
                                    <th>Branch Name</th>
                                    <?php
                                } ?>
                                
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Transaction</th>
                                <th>Action</th> 
                                
                            </tr>
                        </thead>
                        <tbody>
                             <?php 
                            if(!empty($cusdata))
                            {
                                $i='1';
                                foreach ($cusdata as $res) {
                                    $branchname =   $this->Branch_model->getBranchRow("branch_id = '".$res['branch_id']."'"); 
                                    if($res['status'] == '1')
                                    {
                                        $class = "btn btn-outline-success";
                                        $status = 'Active';
                                    }
                                    else
                                    {
                                        $class = "btn btn-outline-danger";
                                        $status = 'Inactive';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <?php if($type == '1')
                                        {
                                            ?>
                                            <td><?php echo strtoupper($branchname['branch_name']);?></td>
                                            <?php
                                        } ?>
                                        <td><?php echo strtoupper($res['cus_id']);?></td>
                                        <td><?php echo ucfirst($res['cus_name']);?></td>
                                         <td><?php echo $res['email'];?></td>
                                         <td><?php echo $res['mobile'];?></td>
                                         <td><button type="button" class="<?php echo $class;?> change_status" data-id="<?php echo $res['id'];?>"><?php echo $status;?></button></td>
                                         <td><a href="<?php echo base_url();?>viewtransaction/<?php echo $res['cus_id'];?>" target="_blank" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
                                         <td> 
                                            <div class="line-h-1 h5">  
                                                <a style="padding-right: 12px;" class="text-info view_details" href="javascript:void(0)" data-toggle="modal" data-id="<?php echo $res['id'];?>" data-target="#exampleModalLong"><i class="fa fa-bars"></i></a>  
                                                <a class="text-success" href="<?php echo base_url('editcustomer/'.$res['id']); ?>" ><i class="icon-pencil"></i></a>
                                                <a class="text-danger cus_delete" data-id="<?php echo $res['id'];?>" ><i class="icon-trash"></i></a>                                    
                                            </div>                                
                                        </td>
                            </tr>
                        <?php } 
                    }?>  

                            
                    </tbody>
                </table>
                          
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">View Customer Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4"><b>Name</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="cus_name"></p></div>
                                    </div>
                                     
                                    <div class="row">
                                        <div class="col-md-4"><b>ID</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="cus_id"></p></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4"><b>Email</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="email"></p></div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-4"><b>Billing Address</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="address"></p></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4"><b>Branch Name</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="branch_id"></p></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4"><b>City</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="city_id"></p></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4"><b>State</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="state_id"></p></div>
                                    </div>
                                  
                                    <div class="row">
                                        <div class="col-md-4"><b>Zip Code</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="zip_code"></p></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4"><b>Mobile Number</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="mobile"></p></div>
                                    </div>
                                  
                                    <div class="row">
                                        <div class="col-md-4"><b>Status</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="status"></p></div>
                                    </div>
                                   
                                    <!-- <div class="row">
                                        <div class="col-md-4"><b>Last Updated</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="last_updated"></p></div>
                                    </div> -->
                                 
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    </div>                  
</div>
 
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/customer.js"></script>