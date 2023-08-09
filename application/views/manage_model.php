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
                        <a class="btn btn-primary" href="<?php echo base_url();?>addmodel" >Add Model +</a>
                    </div>
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <?php if($type == '1')
                                {
                                    ?>
                                    <th>Branch Name</th>
                                <?php } ?>
                                <td>Model Name</td>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($modeldata))
                            {
                                $i='1';
                                foreach ($modeldata as $res) {
                                    $getbranch = $this->Branch_model->getBranchRow("branch_id = '".$res['branch_id']."'");
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <?php if($type == '1')
                                        {
                                            ?>
                                        <td><?php echo strtoupper($getbranch['branch_name']);?></td>
                                        <?php } ?>
                                        <td><?php echo ucfirst($res['model_name']);?></td>
                                        <td> 
                                            <div class="line-h-1 h5">  
                                                 
                                                <a class="text-success" href="<?php echo base_url('editmodel/'.$res['model_id']);?>"><i class="icon-pencil"></i></a>
                                                <a class="text-danger model_delete" data-id="<?php echo $res['model_id'];?>" ><i class="icon-trash"></i></a>
                                                                               
                                            </div>                                
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                               
                            } ?>
                            
  
                        </tbody>
                      
                    </table>
                    
                </div>
            </div>
        </div> 

    </div>                  
</div>
  

<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/model.js"></script>