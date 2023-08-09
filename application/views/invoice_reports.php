<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4> 
            </div>
            <div class="card-body">
                <form id="attender_add_form" autocomplete="off" action="<?php echo base_url();?>billing_reports" method="post">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>From</label>
                            <input type="text" name="from_date" id="from_date" class="form-control" >
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>To</label>
                            <input type="text" name="to_date" id="to_date" class="form-control"  >
                        </div>
                    </div>

                    <!-- <div class="col-lg-2">
                        <div class="form-group">
                            <label>Branch</label>
                            <select name="branch_id" id="branch_id" class="form-control">
                                <option value=" ">Select Branch</option>
                                <?php 
                                foreach ($branch as $b) {
                                   ?> <option value="<?php echo $b['branch_id']; ?>" > <?php echo strtoupper($b['branch_name']); ?></option>
                                   <?php
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div> -->
                    <?php 
                    if(!empty($branch))
                    { ?>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Branch</label>
                                <select name="branch_id" id="branch_id" class="form-control">
                                    <option value="all">All</option>
                                    <?php
                                       foreach ($branch as $res) {
                                           ?> <option value="<?php echo $res['branch_id']; ?>" > <?php echo strtoupper($res['branch_name']); ?></option>
                                           <?php
                                        } 
                                   
                                    ?>
                                </select>
                            </div>
                        </div>
                    <?php  } ?>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Customer ID</label>
                            <select name="cus_id" id="cus_id" class="form-control">
                                <option value="all">All</option>
                                <?php 
                                if(!empty($cusdata))
                                {
                                   foreach ($cusdata as $res) {
                                       ?> <option value="<?php echo $res['cus_id']; ?>" > <?php echo strtoupper($res['cus_id']); ?></option>
                                       <?php
                                    } 
                                }
                                    
                                ?>
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <select name="cus_name" id="cus_name" class="form-control">
                                <option value="all">All</option>
                                <?php 
                                if(!empty($cusdata))
                                {
                                   foreach ($cusdata as $res1) {
                                       ?> <option value="<?php echo $res1['cus_id']; ?>" > <?php echo strtoupper($res1['cus_name']); ?></option>
                                       <?php
                                    } 
                                }
                                    
                                ?>
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <select name="mobile" id="mobile" class="form-control">
                                <option value="all">All</option>
                                <?php 
                                if(!empty($cusdata))
                                {
                                   foreach ($cusdata as $res1) {
                                       ?> <option value="<?php echo $res1['cus_id']; ?>" > <?php echo strtoupper($res1['mobile']); ?></option>
                                       <?php
                                    } 
                                }
                                    
                                ?>
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Paid Status</label>
                            <select name="paid_status" id="paid_status" class="form-control">
                                <option value="all">All</option>
                                <option value="1"> Paid</option>
                                <option value="2" >Unpaid</option>
                                <option value="3" >Partially Paid</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>GST</label>
                            <select name="gst_type" id="gst_type" class="form-control">
                                <option value="all">All</option>
                                <option value="1"> GST</option>
                                <option value="2" >Non-GST</option>
                                      
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success btn-block">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table id="example" class="display table dataTable table-striped table-bordered" >

                        <thead>
                            <tr>
                                <th>Bill No</th>
                                <th>Customer ID</th>
                                <th>Branch Name</th>
                                <th>Name</th>
                                <th>Invoice Date</th>
                                <th>Total</th>
                                <th>Action</th>
                                <!-- <th>Balance</th>
                                <th>Paid Status</th> -->
                                <!-- <th>Status</th> -->
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($billingdata as $res) { 
                            $id=$this->Reports_model->getsubRow("bill_no='".$res['bill_no']."'");
                            $ir=$this->Reports_model->getnameRow("cus_id='".$id['cus_id']."'");
                            $branchname =   $this->Branch_model->getBranchRow("branch_id = '".$ir['branch_id']."'");  
                            $myvalue = $res['created_on'];
                            $datetime = new DateTime($myvalue);
                            $date = $datetime->format('d-m-Y');
                            $time = $datetime->format('H:i:s');

                             if($res['paid_status'] == '1')
                            {
                               
                                $status = 'PAID';
                            }
                             if($res['paid_status'] == '2')
                            {
                               
                                $status = 'UNPAID';
                            }
                              if($res['paid_status'] == '3') 
                            {
                               
                                $status = 'PARTIALLY PAID';
                            }
                            ?>
                            <tr>   
                                <td><?php echo $res['bill_no'];?></td>
                                <td><?php echo strtoupper($id['cus_id']);?></td>
                                <td><?php echo strtoupper($branchname['branch_name']);?></td>
                                <td><?php echo strtoupper($ir['cus_name']);?></td>
                                <td><?php echo $date;?></td>
                                <td>Rs. <?php echo ($res['grand_total']);?></td>
                                <td><a href="<?php echo base_url();?>viewbill/<?php echo $res['bill_no'];?>" target="_blank" class="btn btn-info"><i class="fas fa-print"></i></a></td>
                                <!-- <td>Rs. <?php echo ($res['balance']);?></td>
                                <td><?php echo $status;?></td> -->
                         
                            </tr>
                        <?php }?>
                           
                        </tfoot>
                    </table>
                   
                </div>
            </div>
        </div> 

    </div>                  
</div>
 
<script type="text/javascript">
    $('#from-date').datepicker();
    $('#to-date').datepicker();
$(document).on('change', "#branch_id", function() {
                 
    var branch_id = $(this).val();
    if (branch_id) {
        $.ajax({
            type: 'POST',
            url: base_url+'customers/getCustomers',
            data: { branch_id: branch_id },
            dataType:'JSON',
            success: function(data) {
                $('#cus_id').html('<option value="all">All</option>');
                
                if (data) {
                    $(data).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.cus_id).text(this.cus_id.toUpperCase());

                        $('#cus_id').append(option);
                        //$("#cus_id").selectpicker('refresh');

                    });
                } else {
                
                    $('#cus_id').html('<option value="">Customer not available</option>');
                }

                $('#cus_name').html('<option value="all">All</option>');
                
                if (data) {
                    $(data).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.cus_id).text(this.cus_name.toUpperCase());

                        $('#cus_name').append(option);
                        //$("#cus_id").selectpicker('refresh');

                    });
                } else {
                
                    $('#cus_name').html('<option value="">Customer not available</option>');
                }

                $('#mobile').html('<option value="all">All</option>');
                
                if (data) {
                    $(data).each(function() {
                        var option = $('<option />');
                        option.attr('value', this.cus_id).text(this.mobile);

                        $('#mobile').append(option);
                        //$("#cus_id").selectpicker('refresh');

                    });
                } else {
                
                    $('#mobile').html('<option value="">Customer not available</option>');
                }
            }
        });
    }
});
</script>