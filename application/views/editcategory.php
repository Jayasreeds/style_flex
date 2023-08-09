<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4>                                
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">                                           
                        <div class="col-12 mb-5">
                            <form id="editCategoryForm">
                                <div class="form-row">
                                    
                                    <div class="col-6 mb-3 form-group">
                                        <label for="username">Category</label>

                                        <input type="text" class="form-control" name="category" id="category" placeholder="category" value="<?php echo $edt_categorydata['category'];?>">

                                    </div>
                                   <div class="col-6 mb-3 form-group"> 
                                   <label for="status">Status<i class="text-danger"></i></label>                                               
                                   <select class="selectpicker" id="status" name ="status" >
                                       <option value=" " >Select Status</option>
                                       <option value="1"<?php if($edt_categorydata['status']=='1') echo 'selected=="selected"';?>>Active</option>
                                       <option value="2"<?php if($edt_categorydata['status']=='2') echo 'selected=="selected"';?>>Inctive</option>
                                   </select>
                               </div>
                                     <div class="col-12 mb-5">

                                        <button type="submit" class="btn btn-primary">Update Category</button>   <button type="button" id="cancel" class="btn btn-outline-warning">Cancel</button>

                                    </div>
                                    <input type="hidden" name="category_id" id="category_id" value="<?php echo $edt_categorydata['category_id'];?>">
                                   
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
</div>
<!-- END: Card DATA-->

<script src="<?php echo base_url(); ?>assets/dist/js/manual_js/category.js"></script>
