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
                        <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#newtodo">Add Price +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Quality Name</th>
                                <td>Size Details</td>
                                <th>Price Value</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($pricedata))
                            {
                                $i='1';
                                foreach ($pricedata as $res) {
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
                                    $getqualityname = $this->Quality_model->getQualityRow("quality_id = '".$res['quality_id']."'");
                                    $getsizedet = $this->Size_model->getSizeRow("size_id = '".$res['size_id']."'");
                                    $gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$getsizedet['type_id']."'");
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo ucfirst($getqualityname['quality_name']);?></td>
                                        <td><?php echo $getsizedet['size_det']." ".strtoupper($gettypename['type_name']);?></td>
                                        <td><?php echo "Rs. ".$res['price_val']."/-";?></td>
                                        <td><button type="button" class="<?php echo $class;?> change_status" data-id="<?php echo $res['price_id'];?>"><?php echo $status;?></button></td>
                                        <td> 
                                            <div class="line-h-1 h5">  
                                                <a style="padding-right: 12px;" class="text-info view_details" href="javascript:void(0)" data-toggle="modal" data-id="<?php echo $res['price_id'];?>" data-target="#exampleModalLong"><i class="fa fa-bars"></i></a>  
                                                <?php if($type == '1')
                                                {
                                                    ?>
                                                <a class="text-success get_edit_details" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $res['price_id'];?>" data-target="#edittodo"><i class="icon-pencil"></i></a>
                                                <a class="text-danger price_delete" data-id="<?php echo $res['price_id'];?>" ><i class="icon-trash"></i></a>  
                                                <?php
                                                }
                                                 ?>                                   
                                            </div>                                
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                               
                            } ?>
                            
  
                        </tbody>
                      
                    </table>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">View Price Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mt-3">
                                        <div class="col-md-4"><b>Quality Name</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="v_quality_id"></p></div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4"><b>Size Details</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="v_size_id"></p></div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4"><b>Price Value</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="v_price_val"></p></div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-4"><b>Note</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="v_note"></p></div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-4"><b>Status</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="v_status"></p></div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-4"><b>Last Updated</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="v_last_updated"></p></div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Todo -->
                    <div class="modal fade" id="newtodo">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        <i class="icon-pencil"></i> Add Price Details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="icon-close"></i>
                                    </button>
                                </div>
                                <form id="addPriceForm" class="add-todo-form">
                                    <div class="modal-body">                                               

                                        <div class="form-group"> 
                                            <label for="Status" class="col-form-label">Quality Name</label>                                               
                                            <select class="form-control" name="quality_id" id="quality_id">
                                                <option value="">Select Quality</option>
                                                <?php 
                                                if(!empty($qualitydata))
                                                {
                                                    foreach ($qualitydata as $res1) {
                                                      ?>
                                                      <option value="<?php echo $res1['quality_id'];?>"><?php echo ucfirst($res1['quality_name']);?></option>
                                                      <?php
                                                    }
                                                }
                                                  
                                                 ?>                                                  
                                            </select>
                                        </div> 

                                        <div class="form-group"> 
                                            <label for="Status" class="col-form-label">Size Details</label>                                               
                                            <select class="form-control" name="size_id" id="size_id">
                                                <option value="">Select Size</option>
                                                <?php if(!empty($sizedata))
                                                {
                                                    foreach ($sizedata as $res2) {
                                                        $gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$res2['type_id']."'");
                                                        ?>
                                                        <option value="<?php echo $res2['size_id'];?>"><?php echo $res2['size_det']." ".ucfirst($gettypename['type_name']);?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>    

                                        <div class="form-group">
                                            <label for="price" class="col-form-label">Price</label>
                                            <input type="text" class="form-control" name="price_val" id="price_val" placeholder="Price">
                                        </div>   

                                        <div class="form-group">
                                            <label for="note" class="col-form-label">Small Note</label>
                                            <textarea class="form-control" rows="5" name="note" id="note"></textarea>
                                        </div>   

                                        <div class="form-group"> 
                                            <label for="Status" class="col-form-label">Status</label>                                               
                                            <select class="selectpicker" data-live-search="true" name="status" id="status">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>                                        

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary add-todo">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Todo -->
                    <div class="modal fade" id="edittodo">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        <i class="icon-pencil"></i> Edit Price Details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="icon-close"></i>
                                    </button>
                                </div>
                                <form id="editPriceForm" class="add-todo-form">
                                    <div class="modal-body">                                               

                                        <div class="form-group"> 
                                            <label for="edt_quality_id" class="col-form-label">Quality Name</label>                                               
                                            <select class="selectpicker" data-live-search="true" name="edt_quality_id" id="edt_quality_id">
                                                <option value="">Select Quality</option>
                                                <?php 
                                                if(!empty($qualitydata))
                                                {
                                                    foreach ($qualitydata as $res1) {
                                                      ?>
                                                      <option value="<?php echo $res1['quality_id'];?>"><?php echo ucfirst($res1['quality_name']);?></option>
                                                      <?php
                                                    }
                                                }
                                                  
                                                 ?>                                                  
                                            </select>
                                        </div> 

                                        <div class="form-group"> 
                                            <label for="edt_size_id" class="col-form-label">Size Details</label>                                               
                                            <select class="selectpicker" data-live-search="true" name="edt_size_id" id="edt_size_id">
                                                <option value="">Select Size</option>
                                                <?php if(!empty($sizedata))
                                                {
                                                    foreach ($sizedata as $res2) {
                                                        $gettypename = $this->Size_model->getSizeTypeRow("type_id = '".$res2['type_id']."'");
                                                        ?>
                                                        <option value="<?php echo $res2['size_id'];?>"><?php echo $res2['size_det']." ".ucfirst($gettypename['type_name']);?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>    

                                        <div class="form-group">
                                            <label for="price" class="col-form-label">Price</label>
                                            <input type="text" class="form-control" name="edt_price_val" id="edt_price_val" placeholder="Price">
                                        </div>   

                                        <div class="form-group">
                                            <label for="note" class="col-form-label">Small Note</label>
                                            <textarea class="form-control" rows="5" name="edt_note" id="edt_note"></textarea>
                                        </div>   

                                        <div class="form-group"> 
                                            <label for="Status" class="col-form-label">Status</label>                                               
                                            <select class="selectpicker" data-live-search="true" name="edt_status" id="edt_status">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div> 
                                        <input type="hidden" name="price_id" id="price_id">                                       

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary add-todo">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> 

    </div>                  
</div>
  
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/price.js"></script>