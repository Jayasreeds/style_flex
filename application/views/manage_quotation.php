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
                        <a class="btn btn-primary" href="<?php echo base_url();?>addquotation">Add Quotation +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>Quotation No</th>
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
                                <th>Estimate Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($quotationdata))
                            {
                                foreach ($quotationdata as $res) {

                                    $branchname =   $this->Branch_model->getBranchRow("branch_id = '".$res['branch_id']."'");
                                    $cusid = $this->Quotation_model->getQuotesubRow("quote_no = '".$res['quote_no']."'");

                                    $cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$cusid['cus_id']."'");  
                                    ?>
                                    <tr>
                                        <td><?php echo strtoupper($res['quote_no']);?></td>
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
                                        <td><?php echo $res['created_on'];?></td>
                                         
                                        <td> 
                                            <div class="line-h-1 h5">  
                                                <a class="text-info" href="<?php echo base_url('viewquotation/'.$res['quote_no']);?>" target="_blank"><i class="fa fa-bars"></i></a>
                                                  
                                                <a class="text-success edit-invoice" href="<?php echo base_url('editquotation/'.$res['id']);?>"><i class="icon-pencil"></i></a>
                                                <a class="text-danger quotation_delete" data-id="<?php echo $res['quote_no'];?>"  ><i class="icon-trash"></i></a>                                 
                                            </div>                                
                                        </td>
                                    </tr>
                                    <?php
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
 
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/quotation.js"></script>
