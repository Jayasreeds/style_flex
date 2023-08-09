<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4> 
            </div>
            <div class="card-body">
                <form id="attender_add_form" autocomplete="off" action="<?php echo base_url();?>reports" method="post">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>From</label>
                            <input type="text" name="from_date" id="from_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>To</label>
                            <input type="text" name="to_date" id="to_date" class="form-control">
                        </div>
                    </div>
                    <?php if(!empty($branch))
                    {
                        ?>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Branch</label>
                                <select name="branch_id" class="form-control">
                                    <option value="all">All</option>
                                    <?php 
                                    foreach ($branch as $b) {
                                       ?> <option value="<?php echo $b['branch_id']; ?>" > <?php echo strtoupper($b['branch_name']); ?></option>
                                       <?php
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <?php
                    } ?>
                    
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success btn-block">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table id="example" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Date</th>
                                <?php if($type =='1')
                                {
                                    ?>
                                    <th>Branch</th>
                                    <?php
                                } ?>
                                
                              
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($cusloc as $k) {
                                $branchname =   $this->Branch_model->getBranchRow("branch_id = '".$k['branch_id']."'");  
                            ?>
                            <tr>
                                <td><?php echo strtoupper ($k['cus_id']);?></td>
                                <td><?php echo ucfirst ( $k['cus_name']);?></td>
                                <td><?php echo $k['email'];?></td>
                                <td><?php echo $k['mobile'];?></td>
                                <td><?php echo $k['last_updated'];?></td>
                                <?php if($type =='1')
                                {
                                    ?>
                                <td><?php echo strtoupper($branchname['branch_name']);?></td>
                            <?php } ?>
                                 
                            </tr>
                            <?php } ?>

                           
                             
                             
                        </tbody>
                       
                    </table>
                  
                </div>
            </div>
        </div> 

    </div>                  
</div>
 
 