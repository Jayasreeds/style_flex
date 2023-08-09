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
                        <a class="btn btn-primary" href="<?php echo base_url();?>addcategory">Add Category +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>#</th>
                                
                                
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($categorydata))
                            {
                                $i='1';
                                foreach ($categorydata as $res) {
                                    $getbranch = $this->Branch_model->getBranchRow("branch_id = '".$res['branch_id']."'");
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                      
                                        <td><?php echo ucfirst($res['category']);?></td>


                                        <?php if($res['status']=='1') { ?>
                                        <td><?php echo 'active'?> </td> <?php } ?>
                                    
                                        <?php if($res['status']=='2') { ?>
                                        <td><?php echo 'inactive'?> </td> <?php } ?>
                                        <td> 
                                            <div class="line-h-1 h5">  
                                                  
                                                
                                                <a class="text-success" href="<?php echo base_url('editcategory/'.$res['category_id']);?>"><i class="icon-pencil"></i></a>
                                                <a class="text-danger category_delete" data-id="<?php echo $res['category_id'];?>" ><i class="icon-trash"></i></a>
                                              
                                                                                    
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
                                    <h5 class="modal-title" id="exampleModalLongTitle">View Category Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4"><b>Category Name</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="category"></p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">&nbsp;</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><b>Subcategory Name</b></div>
                                        <div class="col-md-2">:</div>
                                        <div class="col-md-6"><p id="sub_category"></p></div>
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

                    
                </div>
            </div>
        </div> 

    </div>                  
</div>
  

<script src="<?php echo base_url(); ?>assets/dist/js/manual_js/category.js"></script>
