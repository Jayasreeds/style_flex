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
$quotebasedata =   $this->Quotation_model->getQuotebaseRow("quote_no = '".$quote_no."'");  
$quotesubdata = $this->Quotation_model->getQuotesubResults("quote_no = '".$quote_no."'");
$quotesubdatarow = $this->Quotation_model->getQuotesubRow("quote_no = '".$quotebasedata['quote_no']."'");
$cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$quotesubdatarow['cus_id']."'");
$branchname =   $this->Branch_model->getBranchRow("branch_id = '".$cus_data['branch_id']."'");

?>
<div class="col-12 col-lg-12 mt-3 pl-lg-0">
        <div class="card border h-100 invoice-list-section">

                <div class="row mt-2">
                    <div class="col-12 col-md-12">
                        <div class="col-md-3">
                            <button id="print_invoice" target="_blank" class="btn btn-danger" style="float: left;">Print</button>

                        </div>
                        <div class="col-md-6">
                            
                        </div>

                        <div class="col-md-3" style="float: right;">
                            <a href="<?php echo base_url('quotation');?>" class="btn btn-primary" data-dismiss="modal" style="float:right;">Cancel </a>
                        </div>
                    </div>
                    
                </div>
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
                                <?php $invoice_date = date("Y-m-d", strtotime($quotebasedata['created_on']));  ?>
                               <p class="add_p">Quotation No : <?php echo $quotebasedata['quote_no'];?></p>
                                <p class="add_p">Estimate Date : <?php echo date("Y-m-d");?> </p>
                            </div>
                            <div class="col-md-4 col-4" style="border-left: 2px solid; border-right: 2px solid;">
                                <h5 class="add_h5 mt-5 mb-5">Quotation</h5>
                            </div>
                            <div class="col-md-4 col-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 add_invoice_div_2">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <h6 class="invoice_h6">Details of Receiver (Quotation To)</h6>
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
                                            <td><b>S.No </b></td>
                                            <td><b>Quality Name</b></td>
                                            <td><b>Size Details</b></td>
                                            <td><b>Price</b></td>
                                            <td><b>Quantity</b></td>
                                            <td><b>Total</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($quotesubdata))
                                        {
                                            $i = '1';
                                            foreach ($quotesubdata as $res) {
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
                                    <?php $gstval = $quotebasedata['gst_val']/2; ?>
                                    <div class="col-md-6 col-6">
                                        <p class="add_p"><?php echo number_format($gstval,'2')." %";?></p>
                                        <p class="add_p"><?php echo number_format($gstval,'2')." %";?></p>
                                        <p class="add_p"><?php echo "Rs. ".number_format($quotebasedata['gst_total'],'2');?></p>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-5 col-5" style="border-left: 2px solid;">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <p class="add_p">SUB TOTAL :</p>
                                        <!-- <p class="add_p">DISCOUNT :</p> -->
                                        <p class="add_p">TOTAL GST :</p>
                                        <p class="add_p">GRAND TOTAL :</p>
                                        <!-- <p class="add_p">PAID AMOUNT :</p>
                                        <p class="add_p">BALANCE :</p> -->
                                    </div>
                                    <div class="col-md-6 col-6" style="text-align: end;">
                                        <p class="add_p"><?php echo "Rs. ".number_format($quotebasedata['subtotal'],'2');?></p>
                                        <!-- <p class="add_p"><?php echo number_format($quotebasedata['discount'],'2')." %";?></p> -->
                                        <p class="add_p"><?php echo "Rs. ".number_format($quotebasedata['gst_total'],'2');?></p>
                                        <p class="add_p"><?php echo "Rs. ".number_format($quotebasedata['grand_total'],'2');?></p>
                                        <!-- <p class="add_p"><?php echo "Rs. ".number_format($quotebasedata['paid_amount'],'2');?></p>
                                        <p class="add_p"><?php echo "Rs. ".number_format($quotebasedata['balance'],'2');?></p> -->
                                    </div>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 add_invoice_div_2">
                        <div class="row">
                            <div class="col-md-7 col-7">
                                <?php 
$rs = number_format($quotebasedata['grand_total'],'2');
$rsinwords = $this->Quotation_model->getIndianCurrency($quotebasedata['grand_total']);?>
                                <p class="add_p" style="    font-weight: 700; font-size: 18px;"><?php echo strtoupper($rsinwords);?></p> 
                            </div>
                            <div class="col-md-5 col-5" style="border-left: 2px solid;">
                                <h5 style="margin-top: 12px;
    text-align: end;
    font-weight: 600;">TOTAL BALANCE Rs. <?php echo number_format($quotebasedata['grand_total'],'2');?></h5>                              
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
     
    <script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/quotation.js"></script>

    <script type="text/javascript">
    $(document).on("click", "#print_invoice", function() {
   
   
        var printContents = document.getElementById("printerDiv").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

   })
    </script>