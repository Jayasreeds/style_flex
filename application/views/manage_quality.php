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
                        <a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#newtodo">Add Quality +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Quality Name</th>
                                <!-- <td>Last Modified</td> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($qualitydata))
                            {
                                $i='1';
                                foreach ($qualitydata as $res) {
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
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo ucfirst($res['quality_name']);?></td>
                                        <!-- <td><?php echo $res['last_updated'];?></td> -->
                                        <td><button type="button" class="<?php echo $class;?> change_status" data-id="<?php echo $res['quality_id'];?>"><?php echo $status;?></button></td>
                                        <td> 
                                            <div class="line-h-1 h5">  
                                                <a style="padding-right: 12px;" class="text-info view_details" href="javascript:void(0)" data-toggle="modal" data-id="<?php echo $res['quality_id'];?>" data-target="#exampleModalLong"><i class="fa fa-bars"></i></a>  
                                                <?php if($type == '1')
                                                {
                                                    ?>
                                                    <a class="text-success get_edit_details" href="javascript:void(0);" data-toggle="modal" data-id="<?php echo $res['quality_id'];?>" data-target="#edittodo"><i class="icon-pencil"></i></a>
                                                <a class="text-danger quality_delete" data-id="<?php echo $res['quality_id'];?>" ><i class="icon-trash"></i></a>
                                                    <?php
                                                } ?>
                                                                                    
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
                                    <h5 class="modal-title" id="exampleModalLongTitle">View Quality Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4"><b>Quality Name</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="quality_name"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Note</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="note"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Status</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="status"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Last Updated</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="last_updated"></p></div>
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
                                        <i class="icon-pencil"></i> Add Quality Details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="icon-close"></i>
                                    </button>
                                </div>
                                <form id="addQualityForm" class="add-todo-form">
                                    <div class="modal-body">                                               

                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Quality Name</label>
                                            <input type="text" class="form-control" name="quality_name" id="qualityname">
                                        </div>                                                    

                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Small Note</label>
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
                                        <i class="icon-pencil"></i> Edit Quality Details
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="icon-close"></i>
                                    </button>
                                </div>
                                <form id="editQualityForm" class="add-todo-form">
                                    <div class="modal-body">                                               

                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Quality Name</label>
                                            <input type="text" class="form-control" name="edt_quality_name" id="edt_quality_name">
                                        </div>                                                    

                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Small Note</label>
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
                                        <input type="hidden" name="quality_id" id="quality_id">

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
  

<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/quality.js"></script>