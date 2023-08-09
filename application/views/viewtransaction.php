<?php $uri = $this->uri->segment(2); ?>
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title"><?php echo $page_title1;?> For <?php echo strtoupper($uri);?></h4> 
            </div>

            <div class="card-body">
                <div class="table-responsive">
                     
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Bill No</th>
                                <th>Estimate Date</th>
                                <th>GST % </th>
                                <th>Discount %</th>
                                <th>Total Rs.</th>
                                <th>Paid Amount Rs.</th>
                                <th>Balance Rs.</th>
                                <th>Handle</th>
                                 
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($billbaseresults))
                            {   
                                $i = '1';
                                foreach ($billbaseresults as $res) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $res['bill_no'];?></td>
                                        <td><?php echo $res['created_on'];?></td>
                                        <td><?php echo number_format($res['gst_val'],'2');?></td>
                                        <td><?php echo number_format($res['discount'],'2');?></td>
                                        <td><?php echo number_format($res['grand_total'],'2');?></td>
                                        <td><?php echo number_format($res['paid_amount'],'2');?></td>
                                        <td><?php echo number_format($res['balance'],'2');?></td>
                                        <td><a href="<?php echo base_url();?>viewbill/<?php echo $res['bill_no'];?>" target="_blank" class="btn btn-info"><i class="fas fa-print"></i></a></td>
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
 