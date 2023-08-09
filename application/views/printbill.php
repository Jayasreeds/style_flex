<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
<!-- END: Page CSS-->

<!-- START: Template CSS-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">        
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/flags-icon/css/flag-icon.min.css"> 
<!-- START: Custom CSS-->
       

<?php

$billbasedata =   $this->Invoice_model->getBillbaseRow("bill_no = '".$bill_no."'");   
$billsubdata = $this->Invoice_model->getBillsubResults("bill_no = '".$bill_no."'");
$billsubdatarow = $this->Invoice_model->getBillsubRow("bill_no = '".$billbasedata['bill_no']."'");
$cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$billsubdatarow['cus_id']."'");
$branchname =   $this->Branch_model->getBranchRow("branch_id = '".$page_data['cus_data']['branch_id']."'");

 //exit();?>
<div class="col-12 col-lg-12 mt-3 pl-lg-0">
        <div class="card border h-100 invoice-list-section">

              
                <div id="printerDiv">
                 <div class="row" style="margin:15px !important; ">
                    
                    <div class="col-md-12 col-12 add_invoice_div">
                        <h4 class="invoice_h4">STYLE FLEX</h4>
                    </div>
                    <?php $editsettingdata = $this->Settings_model->getSettingRow('1'); ?>
                    <div class="col-md-12 col-12 add_invoice_div_2">
                        <h6 class="invoice_h4"><?php echo $editsettingdata['address'];?>
                        </h6>
                    </div>
                    <div class="col-md-12 col-12 add_invoice_div_2" style="text-align: center;">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <h5 class="add_h5">GSTIN : <?php echo strtoupper($branchname['gst_no']);?></h5>
                            </div>
                            <div class="col-md-6 col-6" style="border-left: 2px solid;">
                                <h5 class="add_h5">PAN NO : <?php echo strtoupper($branchname['pan_no']);?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 add_invoice_div_2">
                        <div class="row">
                            <div class="col-md-4 col-4">
                                <?php $invoice_date = date("Y-m-d", strtotime($billbasedata['paid_date']));  ?>
                               <p class="add_p">INVOICE No : <?php echo $billbasedata['bill_no'];?></p>
                                <p class="add_p">INVOICE Date : <?php echo date("Y-m-d");?> </p>
                            </div>
                            <div class="col-md-4 col-4" style="border-left: 2px solid; border-right: 2px solid;">
                                <h5 class="add_h5 mt-5 mb-5">SALES INVOICE</h5>
                            </div>
                            <div class="col-md-4 col-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 add_invoice_div_2">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <h6 class="invoice_h6">Details of Receiver (Billed To)</h6>
                                <p class="add_p">
                                <?php $exp = explode(',', $cus_data['address']);
                                foreach ($exp as $res1) {
                                    ?>
                                    <?php echo $res1;?><br />
                                    <?php
                                }
                                ?>
                                </p><br />
                            </div>
                            <div class="col-md-6 col-6" style="border-left: 2px solid;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 add_invoice_div_2 contatent_div" style="height: 767px; padding: 0px !important;">
                        <div class="card-body table-responsive" 
                        style="padding: 0px !important;">
                                <table class="table table-bordered" style="text-align: center;">
                                    <thead>
                                        <tr style="    font-weight: 700;">
                                            <td><b>SNO </b></td>
                                            <td><b>Quality NAME</b></td>
                                            <td><b>Size Details</b></td>
                                            <td><b>Price</b></td>
                                            <td><b>Quantity</b></td>
                                            <td><b>Total</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($billsubdata))
                                        {
                                            $i = '1';
                                            foreach ($billsubdata as $res) {
                                                $price = $res['price'];
                                                $b = str_replace( ',', '', $price );
                                                if( is_numeric( $b ) ) {
                                                    $price = $b;
                                                } 

                                                $total = $res['total'];
                                                $c = str_replace( ',', '', $total );
                                                if( is_numeric( $c ) ) {
                                                    $total = $c;
                                                } 

                                                ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo ucwords($res['quality_id']);?></td>
                                                    <td><?php echo ucwords($res['size_id']);?></td>
                                                    <td><?php echo number_format($price,'2');?></td>
                                                    <td><?php echo $res['quantity'];?></td>
                                                    <td><?php echo number_format($total,'2');?></td>
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
                    <div class="col-md-12 col-12 add_invoice_div_2">
                        <div class="row">
                            <div class="col-md-7 col-7">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <p class="add_p">SGST : </p>
                                        <p class="add_p">CGST :</p>
                                        <p class="add_p">TOTAL GST : </p>
                                    </div>
                                    <?php $gstval = $billbasedata['gst_val']/2; ?>
                                    <div class="col-md-6 col-6">
                                        <p class="add_p"><?php echo number_format($gstval,'2')." %";?></p>
                                        <p class="add_p"><?php echo number_format($gstval,'2')." %";?></p>
                                        <p class="add_p"><?php echo "Rs. ".number_format($billbasedata['gst_total'],'2');?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-5" style="border-left: 2px solid;">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <p class="add_p">SUB TOTAL :</p>
                                        <p class="add_p">DISCOUNT :</p>
                                        <p class="add_p">TOTAL GST :</p>
                                        <p class="add_p">GRAND TOTAL :</p>
                                        <!-- <p class="add_p">PAID AMOUNT :</p>
                                        <p class="add_p">BALANCE :</p> -->
                                    </div>
                                    <div class="col-md-6 col-6" style="text-align: end;">
                                        <p class="add_p"><?php echo "Rs. ".number_format($billbasedata['subtotal'],'2');?></p>
                                        <p class="add_p"><?php echo number_format($billbasedata['discount'],'2')." %";?></p>
                                        <p class="add_p"><?php echo "Rs. ".number_format($billbasedata['gst_total'],'2');?></p>
                                        <p class="add_p"><?php echo "Rs. ".number_format($billbasedata['grand_total'],'2');?></p>
                                        <!-- <p class="add_p"><?php echo "Rs. ".number_format($billbasedata['paid_amount'],'2');?></p>
                                        <p class="add_p"><?php echo "Rs. ".number_format($billbasedata['balance'],'2');?></p> -->
                                    </div>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 add_invoice_div_2">
                        <div class="row">
                            <div class="col-md-7 col-7">
                                <?php 
$rs = number_format($billbasedata['grand_total'],'2');
$rsinwords = $this->Invoice_model->getIndianCurrency($billbasedata['grand_total']);?>
                                <p class="add_p" style="    font-weight: 700; font-size: 18px;"><?php echo strtoupper($rsinwords);?></p> 
                            </div>
                            <div class="col-md-5 col-5" style="border-left: 2px solid;">
                                <h5 style="margin-top: 12px;
    text-align: end;
    font-weight: 600;">TOTAL BALANCE Rs. <?php echo number_format($billbasedata['grand_total'],'2');?></h5>                              
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 add_invoice_div_2">
                        <div class="row">
                            <div class="col-md-4 col-4">
                            </div>
                            <div class="col-md-3 col-3" style="border-left: 2px solid;">
                                <p class="add_p mt-3 mb-3">Prepared By </p>
                            </div>
                            <div class="col-md-5 col-5" style="border-left: 2px solid;">
                                <p class="add_p">For STYLE FLEX</p>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
          
        
            </div>
 
        </div>
    </div>
   