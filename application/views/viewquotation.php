 
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
                   <!--  <div class="col-12 col-md-12">
                        <div class="card border-0">
                            <div class="card-header d-flex justify-content-between align-items-center">                               
                                 <h4 class="card-title">STYLE FLEX <span class="inv-no"></span></h4>                               
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><address>

                                                    <strong>Your Store</strong><br>
                                                    2940 Rainbow Road Alhambra, CA 91801 California </address>
                                                <b>Customer ID : </b> CUS25657<br>
                                                <b>Telephone:</b> 123456789<br>
                                                <b>E-Mail:</b> demo@demo.com<br>
                                                <b>Web Site:</b> <a href="#">http://abc.com</a>

                                                </td>
                                            <td><b>Date Added:</b> 26/10/2020<br>
                                                <b>Order ID:</b> 3135<br>
                                                <b>Bill No:</b> STY87686<br>
                                                <b>Payment Method:</b> Cash On Delivery<br>
                                                <b>Shipping Address:</b> 2940  Rainbow Road Alhambra, <br>CA 91801 California<br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    
                   <!--  <div class="col-12 col-md-12">
                        <div class="card border-0">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td style="width: 50%;"><b>To</b></td>
                                            <td style="width: 50%;"><b>Ship To (if different address)</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><address>
                                                    2940  Rainbow Road<br>Alhambra, CA<br>91801 California </address></td>
                                            <td><address>
                                                    1424  Brown Avenue<br>Knoxville, TN<br>91801 Tennessee </address></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-12 col-md-12">
                        <div class="card border-0">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td><b>Description</b></td>
                                            <td><b>Quality</b></td>
                                            <td><b>Size</b></td>
                                            <td class="text-right"><b>Quantity</b></td>
                                            <td class="text-right"><b>Unit Price</b></td>
                                            <td class="text-right"><b>Total</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Testing Description <br>
                                                &nbsp;<small> - Delivery Date: 2020-11-20</small>
                                            </td>
                                            <td>Superb-A</td>
                                            <td>12 X 12</td>
                                            <td class="text-right">1</td>
                                            <td class="text-right">Rs.122.00</td>
                                            <td class="text-right">Rs.122.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="5"><b>Sub-Total</b></td>
                                            <td class="text-right">Rs.122.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="5"><b>GST</b></td>
                                            <td class="text-right">Rs.5.00</td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-right" colspan="5"><b>VAT (20%)</b></td>
                                            <td class="text-right">Rs.21.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="5"><b>Total</b></td>
                                            <td class="text-right">Rs.130.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-12 col-md-12">
                        <div class="card redial-border-light redial-shadow">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td><b>Comment</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>This is Test comment</td>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                        </div> -->
                    <!-- </div>  -->

                    
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card redial-border-light redial-shadow">
                    <div class="card-body table-responsive">
                        <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#newtodo">Send Quotation via Email</a> 
                        <!-- <button type="submit" class="btn btn-primary">Generate Bill</button> -->
                        <button type="submit" class="btn btn-outline-warning">Cancel</button>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-md-12">
                <div class="card border-0">
                    <div class="col-12 text-center">
                        <br /><br />
                    </div>
                </div>
            </div>
            </div>
 
        </div>
    </div>
    <!-- Edit Todo -->
    <div class="modal fade" id="newtodo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="icon-pencil"></i> Send Email
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="icon-close"></i>
                    </button>
                </div>
                <form class="add-todo-form" id="sendmailForm" action="<?php echo base_url('sendmailForm/'.$quotebasedata['quote_no']);?>" method="post">
                    <div class="modal-body">                                               

                        <div class="form-group">
                            <label for="email">Email</label>                                               
                            <input type="text" name ="cus_mail" id ="cus_mail" class="form-control" placeholder="Email">
                        </div>
                                                                      

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary add-todo">Send</button>
                    </div>
                </form>
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