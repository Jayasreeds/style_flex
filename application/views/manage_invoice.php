
<!-- Edit Invoice -->
<div class="modal fade" id="editinvoice">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon-pencil"></i> Edit Invoice
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="icon-close"></i>
                </button>
            </div>
            <form class="edit-invoice-form">
                <div class="modal-body">                                               

                    <div class="form-group">
                        <label for="due-date" class="col-form-label">Due Date</label>
                        <input type="text" id="due-date" class="form-control" required="" >      
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Status</label>
                        <select class="form-control" id="status">
                            <option value="generated-invoice">Partially Paid</option>
                            <option value="paid-invoice">Paid</option>
                            <option value="pending-invoice">Unpaid</option>
                            <option value="canceled-invoice">Canceled</option>                                                           
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="edit-date">
                    <button type="submit" class="btn btn-primary add-todo">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- START: Card Data-->
<div class="row row-eq-height">
    <div class="col-12 col-lg-2 mt-3 todo-menu-bar flip-menu pr-lg-0">
        <a href="#" class="d-inline-block d-lg-none mt-1 flip-menu-close"><i class="icon-close"></i></a>
        <div class="card border h-100 invoice-menu-section">

            <ul class="nav flex-column invoice-menu">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-invoicetype="invoice">
                        <i class="fas fa-list-alt"></i> All
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-invoicetype="paid-invoice">
                        <i class="fas fa-money-check-alt"></i> Paid
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-invoicetype="pending-invoice">
                        <i class="far fa-money-bill-alt"></i> Partially Paid
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="#" data-invoicetype="canceled-invoice">
                        <i class="fa fa-window-close"></i> Unpaid
                    </a>
                </li>                               

            </ul>         

        </div>  
    </div>
    <div class="col-12 col-lg-10 mt-3 pl-lg-0">
        <div class="card border h-100 invoice-list-section">

             


            <div class="card-header border-bottom p-1 d-flex">
                <a href="#" class="d-inline-block d-lg-none flip-menu-toggle"><i class="icon-menu"></i></a>
                <input type="text" class="form-control border-0 p-2 w-100 h-100 invoice-search" placeholder="Search ...">                               
            </div>
            <div class="card-body p-0">
                <div class="invoices list">

                   
                    <?php 
                    if(!empty($invoicepaiddata))
                    {
                        foreach ($invoicepaiddata as $res1) {
                            $billsubdatarow = $this->Invoice_model->getBillsubRow("bill_no = '".$res1['bill_no']."'");
                            $cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$billsubdatarow['cus_id']."'");    

                            ?>
                            <div class="invoice paid-invoice" data-status="paid-invoice"> 
                                <div class="invoice-content">                                               
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Invoice Number: </p>
                                        <p class="invoice-no"><?php echo $res1['bill_no'];?></p>
                                    </div>
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Customer: </p>
                                        <p class="cliname"><?php echo ucwords($cus_data['cus_name']);?></p>
                                    </div>
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Invoice Date: </p>
                                        <p class="invocie-date"><?php echo $res1['paid_date'];?></p>
                                    </div>
                                    
                                    <div class="invoice-status-info">
                                        <p class="mb-0 small">Status </p>
                                        <p class="invoice-status"></p>
                                    </div>
                                    <div class="line-h-1 h5"> 
                                        <?php if($res1['invoice_status']=='1')
                                        {
                                            ?>
                                            <a class="text-info" target="_blank" href="<?php echo base_url('viewbill/'.$res1['bill_no']);?>"><i class="fa fa-bars"></i></a> 
                                            <?php
                                        } ?>
                                         
                                        <!-- <a class="text-success edit-invoice" href="#" data-toggle="modal" data-target="#editinvoice"><i class="icon-pencil"></i></a>
                                        <a class="text-danger delete-invoice" href="#"><i class="icon-trash"></i></a> -->                                 
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } ?>
                    <?php if(!empty($paymentpendingdata))
                    {
                        foreach ($paymentpendingdata as $res2) {
                            $billsubdatarow = $this->Invoice_model->getBillsubRow("bill_no = '".$res2['bill_no']."'");
                            $cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$billsubdatarow['cus_id']."'");    
                            ?>
                            <div class="invoice canceled-invoice" data-status="canceled-invoice"> 
                                <div class="invoice-content">                                               
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Invoice Number: </p>
                                        <p class="invoice-no"><?php echo $res2['bill_no'];?></p>
                                    </div>
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Client: </p>
                                        <p class="cliname"><?php echo ucwords($cus_data['cus_name']);?></p>
                                    </div>
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Invoice Date: </p>
                                        <p class="invocie-date"><?php echo ucwords($res2['paid_date']);?></p>
                                    </div>
                                   
                                    <div class="invoice-status-info">
                                        <p class="mb-0 small">Status </p>
                                        <p class="invoice-status"></p>
                                    </div>
                                    <div class="line-h-1 h5">   
                                        <?php if($res1['invoice_status']=='1')
                                        {
                                            ?>
                                            <a class="text-info" target="_blank" href="<?php echo base_url('viewbill/'.$res1['bill_no']);?>"><i class="fa fa-bars"></i></a> 
                                            <?php
                                        } ?>
                                        <!-- <a class="text-info" target="_blank" href="<?php echo base_url('viewbill/'.$res2['bill_no']);?>"><i class="fa fa-bars"></i></a>
                                        <a class="text-success edit-invoice" href="#" data-toggle="modal" data-target="#editinvoice"><i class="icon-pencil"></i></a>
                                        <a class="text-danger delete-invoice" href="#"><i class="icon-trash"></i></a> -->                                 
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }?>

                    <?php if(!empty($paymentpartiallydata))
                    {
                        foreach ($paymentpartiallydata as $res3) {
                            $billsubdatarow = $this->Invoice_model->getBillsubRow("bill_no = '".$res3['bill_no']."'");
                            $cus_data = $this->Customer_model->getCustomerRow("cus_id = '".$billsubdatarow['cus_id']."'");    
                            ?>
                    
                            <div class="invoice pending-invoice" data-status="pending-invoice"> 
                                <div class="invoice-content">                                               
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Invoice Number: </p>
                                        <p class="invoice-no"><?php echo $res3['bill_no'];?></p>
                                    </div>
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Client: </p>
                                        <p class="cliname"><?php echo ucwords($cus_data['cus_name']);?></p>
                                    </div>
                                    <div class="invoice-info">
                                        <p class="mb-0 small">Invoice Date: </p>
                                        <p class="invocie-date"><?php echo ucwords($res3['paid_date']);?></p>
                                    </div>
                                   
                                    <div class="invoice-status-info">
                                        <p class="mb-0 small">Status </p>
                                        <p class="invoice-status"></p>
                                    </div>
                                    <div class="line-h-1 h5">  
                                    <?php if($res1['invoice_status']=='1')
                                        {
                                            ?>
                                            <a class="text-info" target="_blank" href="<?php echo base_url('viewbill/'.$res1['bill_no']);?>"><i class="fa fa-bars"></i></a> 
                                            <?php
                                        } ?> 
                                        <!-- <a class="text-info" target="_blank" href="<?php echo base_url('viewbill/'.$res3['bill_no']);?>"><i class="fa fa-bars"></i></a>
                                        <a class="text-success edit-invoice" href="#" data-toggle="modal" data-target="#editinvoice"><i class="icon-pencil"></i></a>
                                        <a class="text-danger delete-invoice" href="#"><i class="icon-trash"></i></a> -->                                 
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
 
                </div>   
            </div>
        </div>
    </div>
</div>
              
<script type="text/javascript">
    $(document).on("click", "#print_invoice", function() {
   
   
        var printContents = document.getElementById("printerDiv").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

   })
</script>