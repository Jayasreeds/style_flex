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
                        <a class="btn btn-primary" href="<?php echo base_url();?>addbranch">Add Branch +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Admin Name</th>
                                <th>Admin Email</th>
                                <th>Last Modified</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = '1';
                            foreach ($branchdata as $res) {
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
                                    <td><?php echo $i;?></td>
                                    <td><?php echo strtoupper($res['branch_name']);?></td>
                                    <td><?php echo ucfirst($res['username']);?></td>
                                    <td><?php echo $res['email_id'];?></td>
                                    <td><?php echo $res['created_on'];?></td>
                                    <td><button type="button" class="<?php echo $class;?> change_status" data-id="<?php echo $res['branch_id'];?>"><?php echo $status;?></button></td>
                                    <td> 
                                        <div class="line-h-1 h5">  
                                            <a class="text-info view_details" href="#" data-toggle="modal" data-id="<?php echo $res['branch_id'];?>" data-target="#exampleModalLong" ><i class="fa fa-bars"></i></a>  
                                            <a class="text-success get_edit_details" href="<?php echo base_url('editbranch/'.$res['branch_id']);?>"><i class="icon-pencil"></i></a>
                                            <a class="text-danger branch_delete" data-id="<?php echo $res['branch_id'];?>" ><i class="icon-trash"></i></a>                                 
                                        </div>                                
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>

                            
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
                                        <div class="col-md-4"><b>Branch Name</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="branch_name"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Admin FirstName</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="first_name"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Admin LastName</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="last_name"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Admin UserName</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="username"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Admin Email</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="email_id"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Mobile Number</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="mobile_number"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Branch Address</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="branch_address"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Status</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="status"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Last Modified</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="created_on"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                        
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
 
<script src="<?php echo base_url(); ?>assets\dist\js\branch\branch.js"></script>
 