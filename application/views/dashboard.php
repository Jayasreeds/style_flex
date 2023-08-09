<!-- START: Card Data-->
<style>
.bg-primary, .round-button {
    background: #69bb64  !important;
}
.bg-secondary, .round-button {
    background: #3e688e  !important;
}
</style>
<div class="row">
    <div class="col-12 col-lg-12  mt-3">
        <div class="row">
            <?php if($type == '1' && !empty($branchdata))
            { ?>
                <div class="col-12">
                    <div class="col-12 col-sm-4 mt-3">
                        <select class="form-control" name="branch_id" id="branch_id">
                            <option value="all">ALL</option>
                            <?php if(!empty($branchdata))
                            {
                                foreach ($branchdata as $res1) {
                                    ?>
                                    <option value='<?php echo $res1['branch_id'];?>'><?php echo strtoupper($res1['branch_name']);?></option>
                                    <?php
                                }
                               
                            }
                            ?>
                        </select>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12">
                <div class="row">

                    <div class="col-12 col-sm-3 mt-3">
                        <div class="card bg-secondary">
                            <a href="<?php echo base_url(); ?>Customers ">
                            <div class="card-body">
                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                    <i class="icon-user icons card-liner-icon mt-2 "></i>
                                    <div class='card-liner-content'>
                                        
                                        <h2 class="card-liner-title " id="custotal"><?php echo ($custotal) ? $custotal : '0';?></h2>
                                        <h6 class="card-liner-subtitle ">Total Customers</h6>                                       
                                    </div>  
                                                               
                                </div></a>   
                                <!-- <div id="apex_primary_chart"></div>                                -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 mt-3">
                        <div class="card bg-primary">
                            <a href="<?php echo base_url(); ?>Customers "><div class="card-body">
                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                    <i class="icon-user icons card-liner-icon mt-2 "></i>
                                    <div class='card-liner-content'>
                                        <h2 class="card-liner-title " id="cusdate"><?php echo ($cusdate) ? $cusdate : '0';?></h2>
                                        <h6 class="card-liner-subtitle ">Today's Customers</h6> 
                                    </div> 
                                                                
                                </div></a>  
                                <!-- <span class="bg-primary card-liner-absolute-icon text-white card-liner-small-tip">+4.8%</span> -->
                                <!-- <div id="apex_today_visitors"></div>  -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 mt-3">
                        <div class="card bg-info">
                             <a href="<?php echo base_url(); ?>billing "> <div class="card-body">
                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                   <i class="icon-user icons card-liner-icon mt-2"></i>
                                  <div class='card-liner-content'>
                                        <h2 class="card-liner-title" id="billdate"><?php echo ($billdate) ? $billdate : '0';?></h2>
                                        <h6 class="card-liner-subtitle">Today's Billing Count</h6> 
                                    </div>  
                                                               
                                </div> </a>  
                                <!-- <div id="apex_today_sale"></div>  -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 mt-3">
                        <div class="card bg-danger">
                           <a href="<?php echo base_url(); ?>Billing "> <div class="card-body">
                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                     <i class="icon-user icons card-liner-icon mt-2"></i>
                                    <div class='card-liner-content'>
                                        <h2 class="card-liner-title" id="billtotal"><?php echo ($billtotal) ? $billtotal : '0';?></h2>
                                        <h6 class="card-liner-subtitle">Total Billing Count</h6> 
                                    </div> 
                                                                 
                                </div></a>  
                                <!-- <div id="apex_today_profit"></div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 mt-3">
                        <div class="card bg-warning">
                           <a href="<?php echo base_url(); ?>Billing ">  <div class="card-body">
                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                   <i class="icon-user icons card-liner-icon mt-2"></i>
                                   <div class='card-liner-content'>
                                        <h2 class="card-liner-title" id="billtodayamt">Rs. <?php echo ($billtodayamt['grand_total']) ? $billtodayamt['grand_total'] : '0.00';?></h2>
                                        <h6 class="card-liner-subtitle">Today's Billing Amount</h6> 
                                    </div>  
                                                                  
                                </div></a>
                                <!-- <div id="apex_today_sale"></div>  -->
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-3 mt-3">
                        <div class="card">
                            <a href="<?php echo base_url(); ?>Billing "> <div class="card-body">
                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                   <i class="icon-user icons card-liner-icon mt-2"></i>
                                   <div class='card-liner-content'>
                                        <h2 class="card-liner-title" id="billtotalamt">Rs. <?php echo ($billtotalamt['grand_total']) ? $billtotalamt['grand_total'] : '0.00';?></h2>
                                        <h6 class="card-liner-subtitle">Total Billing Amount</h6> 
                                    </div> 
                                                                  
                                </div></a> 
                                <!-- <div id="apex_today_sale"></div>  -->
                            </div>
                        </div>
                    </div>




                </div>
            </div>
           
        </div>
    </div>   
 
<?php if(!empty($cusloc))
{
?>
    <div class="col-12 col-md-12 col-lg-4 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h6 class="card-title">Visits by Locations</h6> 
            </div>
            <div class="card-body table-responsive p-0">                         

                <table class="table font-w-600 mb-0">
                    <thead>

                        <tr>                                           
                            <th>Location</th>
                            <th>Customer ID</th>
                            <!-- <th>Amount</th>   
                            <th>Paid Status</th>  -->                                       

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($cusloc as $k) {
                            ?>
                           <tr class="zoom">                                           
                            <td><?php echo strtoupper($k['branch_name']);?></td>
                            <td class="text-success"><?php echo strtoupper($k['cus_id']);?></td>
                            <!-- <td class="text-danger"> </td>
                            <td class="text-info"></td> -->

                        </tr>   
                       <?php }?>
                        
                       
                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php 
}
if(!empty($cus))
{
    ?>

    <div class="col-md-6 col-lg-3 mt-3">
        <div class="card overflow-hidden">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h6 class="card-title">New Customers</h6>
            </div>
            <div class="card-content">
                <div class="card-body p-0">
                    <ul class="list-group list-unstyled">
                        <?php foreach ($cus as $a) {?>
                        <li class="p-2 border-bottom zoom">


                            


                            <div class="media d-flex w-100">
                                <a href="#"><img src="dist/images/author1.jpg" alt="" class="img-fluid ml-0 mt-2  rounded-circle" width="40"></a>
                                <div class="media-body align-self-center pl-2">
                                <span class="mb-0 font-w-600"><?php echo ucwords($a['cus_name']);?> </span><br>
                                <span class="mb-0 font-w-500 tx-s-12"><?php echo strtoupper($a['branch_name']);?> 
                                 <div class="ml-auto my-auto" style="float:right;">
                                    <a href="#"  data-toggle="dropdown">
                                        <i class="icon-options icons h6 font-weight-bold"></i>
                                    </a>
                                   
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="<?php echo base_url('editcustomer/'.$a['id']);?>" class="dropdown-item px-2 align-self-center d-flex">
                                            <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Customer</a>
                                        
                                    </div>
                                </div>  
                                </span> 

                                       <?php } ?>   

                                </div>


                            </div> 
                        </li>
                       
                        
                    </ul> 
                </div>
            </div>
        </div>
    </div>
<?php }

if(!empty($recentbillingdata))
{ ?>    
    <div class="col-12 col-md-12 col-lg-5 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h6 class="card-title">Recent Billing</h6> 
            </div>
            <div class="card-body table-responsive p-0">                         

                <table class="table font-w-600 mb-0">
                    <thead>
                        <tr>                                           
                            <th>Bill No</th>
                            <th>Customer ID</th>
                            <th>Total Amount</th>
                            <th>Paid Status</th>
                                                             

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($recentbillingdata as $res) {
                                if($res['paid_status'] == '1')
                                    $status = "PAID";
                                else if($res['paid_status'] == '2')
                                    $status = "UNPAID";
                                else if($res['paid_status'] == '3')
                                    $status = "PARTIALLY PAID";
                                ?>
                                <tr class="zoom">                                           
                                   <td> <a href="<?php echo base_url('editbilling/'.$res['id']);?>"><?php echo strtoupper($res['bill_no']);?></a></td>
                                    <td class="text-success"><?php echo strtoupper($res['cus_id']);?></td>
                                    <td class="text-success"><?php echo number_format($res['grand_total'],'2');?></td>
                                    <td class="text-success"><?php echo $status;?></td>

                                </tr>
                                <?php
                            }
                        ?>
                           
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php } ?>
</div>
<!-- END: Card DATA--> 

<script type="text/javascript">
    $(document).on('change','#branch_id',function() {
        var branch_id = this.value;
        $.ajax({
            type: "post",
            url: base_url + 'dashboard/getdashboarddetails',
            data: { branch_id: branch_id },
            dataType: 'json',
            cache: false,
            success: function(data) {

                $('#custotal').text(data.custotal);
                $('#cusdate').text(data.cusdate);
                $('#billtotal').text(data.billtotal);
                $('#billdate').text(data.billdate);
                $('#billtodayamt').text(data.billtodayamt);
                $('#billtotalamt').text(data.billtotalamt);

            },
            error: function(xhr, status, error) {
                alert(error);
            },

        }); 
    });
</script>
