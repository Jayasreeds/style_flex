<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">                               
                <h4 class="card-title"><?php echo $page_title1;?></h4>                                
            </div>
            <div class="card-content">
                <div class="card-body">
                   <form id="typeForm">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            
                            <table class="table table-bordered table-hover" id="typeTable">   
                                <thead>
                                    <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                    <th width="20%">Type Name</th>
                                    
                                </thead>
                                <tbody class ='purchase_table'> 
                                <?php
                                 

                                    if(!empty($typedata))
                                    {

                                        foreach ($typedata as $res) {
                                            ?>                          
                                <tr>
                                    <td><input class="itemRow" type="checkbox"></td>
                                    <td><input type="text" class="form-control type_name" name="type_name[]" value="<?php echo $res['type_name'];?>"  placeholder="Type Name"></td>
                                </tr> 
                                <?php
                                        }
                                    } ?>
                                </tbody> 
                            </table>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <button class="btn btn-danger delete" id="removeRows" type="button">-</button>
                                    <button class="btn btn-success" id="addRows" type="button">+</button>
                                </div>
                            </div>                
                            
                        </div>

                    </div> <br />
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <button class="btn btn-primary" type="submit">Update Details</button>               
                            
                        </div>
                    </div>
                    </form>
                    
                      
                </div>
            </div>
        </div>
    </div>
</div>

 
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/size.js"></script>
 