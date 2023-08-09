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
                        <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#newtodo">Add Size +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Size</th>
                                <th>Size Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($sizedata))
                            {
                                $i='1';
                                foreach ($sizedata as $result) {
                                    if($result['status'] == '1')
                                    {
                                        $class = "btn btn-outline-success";
                                        $status = 'Active';
                                    }
                                    else
                                    {
                                        $class = "btn btn-outline-danger";
                                        $status = 'Inactive';
                                    }
                                    $typename = $this->Size_model->getSizeTypeRow("type_id = '".$result['type_id']."'");

                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $result['size_det'];?></td>
                                        <td><?php echo strtoupper($typename['type_name']);?></td>
                                        <td><button type="button" class="<?php echo $class;?> change_status" data-id="<?php echo $result['size_id'];?>"><?php echo $status;?></button></td>
                                        <td> 
                                            <div class="line-h-1 h5">  
                                                <a style="padding-right: 12px;" class="text-info view_details" href="javascript:void(0)" data-toggle="modal" data-id="<?php echo $result['size_id'];?>" data-target="#exampleModalLong"><i class="fa fa-bars"></i></a>  
                                                <?php if($type == '1')
                                                {
                                                    ?>
                                                    <a class="text-success get_edit_details" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $result['size_id'];?>" data-target="#edittodo"><i class="icon-pencil"></i></a>
                                                    <a class="text-danger size_delete" data-id="<?php echo $result['size_id'];?>" ><i class="icon-trash"></i></a>  
                                                    <?php
                                                }
                                                 ?>                                 
                                            </div>                              
                                        </td>
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
 <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Size Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4"><b>Size Type</b></div>
                    <div class="col-md-2">:</div>
                    <div class="col-md-6"><p id="v_sizetype"></p></div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><b>Size Details</b></div>
                    <div class="col-md-2">:</div>
                    <div class="col-md-6"><p id="v_sizedet"></p></div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><b>Note</b></div>
                    <div class="col-md-2">:</div>
                    <div class="col-md-6"><p id="v_note"></p></div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><b>Status</b></div>
                    <div class="col-md-2">:</div>
                    <div class="col-md-6"><p id="v_status"></p></div>
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

<!-- Add Todo -->
<div class="modal fade" id="newtodo">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon-pencil"></i> Add Size Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="icon-close"></i>
                </button>
            </div>
            <form id="addSizeForm" class="add-todo-form">
                <div class="modal-body">                                               
                    <div class="form-group">
                        <label for="title" class="col-form-label">Select Size Type</label><br />
                        <select name="sizetype" id="sizetype">
                            <option value="">Select type</option>
                            <?php
                            if(!empty($typedata))
                            {
                                foreach ($typedata as $res) {
                                    ?>

                                    <option value="<?php echo $res['type_id'];?>"><?php echo strtoupper($res['type_name']);?></option>
                                    <?php
                                }
                            }?>
                            
                        </select>
                    </div> 
                    <div class="row ">
                        <div class="form-group col-md-5">
                            <label for="title" class="col-form-label">Size (Length)</label><br />
                            <input type="text" name="lsize" class="form-control" id="lsize" size="4">  
                        </div> 
                        <div class="form-group col-md-2">
                            <label for="title" class="col-form-label" style="margin-top: 30px;">X</label><br />
                        </div> 
                        <div class="form-group col-md-5">
                            <label for="title" class="col-form-label">Size (Width)</label><br />
                            <input type="text" name="wsize" class="form-control" id="wsize" size="4"> 
                        </div> 
                    </div>                                                   

                    <div class="form-group">
                        <label for="description" class="col-form-label">Note</label>
                        <textarea class="form-control" rows="5" name="note" id="note"></textarea>
                    </div>
                    <div class="form-group"> 
                        <label for="Status" class="col-form-label">Status</label>                                               
                        <select name="status" id="status" class="form-control">
                            <option value="">Choose...</option>
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
                    <i class="icon-pencil"></i> Edit Size Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="icon-close"></i>
                </button>
            </div>
            <form id="editSizeForm" class="add-todo-form">
                <div class="modal-body">                                               
                    <div class="form-group">
                        <label for="title" class="col-form-label">Select Size Type</label><br />
                        <select class="selectpicker" data-live-search="true" name="edt_sizetype" id="edt_sizetype">
                            <option value="">Select type</option>
                            <?php
                            if(!empty($typedata))
                            {
                                foreach ($typedata as $res) {
                                    ?>

                                    <option value="<?php echo $res['type_id'];?>"><?php echo strtoupper($res['type_name']);?></option>
                                    <?php
                                }
                            }?>
                            
                        </select>
                    </div> 
                    <div class="row ">
                        <div class="form-group col-md-5">
                            <label for="title" class="col-form-label">Size (Length)</label><br />
                            <input type="text" name="edt_lsize" class="form-control" id="edt_lsize" size="4">  
                        </div> 
                        <div class="form-group col-md-2">
                            <label for="title" class="col-form-label" style="margin-top: 30px;">X</label><br />
                        </div> 
                        <div class="form-group col-md-5">
                            <label for="title" class="col-form-label">Size (Width)</label><br />
                            <input type="text" name="edt_wsize" class="form-control" id="edt_wsize" size="4"> 
                        </div> 
                    </div>                                                   

                    <div class="form-group">
                        <label for="description" class="col-form-label">Note</label>
                        <textarea class="form-control" rows="5" name="edt_note" id="edt_note"></textarea>
                    </div>
                    <div class="form-group"> 
                        <label for="Status" class="col-form-label">Status</label>                                               
                        <select class="selectpicker" data-live-search="true" name="edt_status" id="edt_status">
                            <option value="">Choose...</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <input type="hidden" name="size_id" id="size_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add-todo">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/size.js"></script>