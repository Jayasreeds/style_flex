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
                            <form id="editSiteDetails">
                                <div class="form-row">
                                    
                                    <div class="col-6 mb-3">
                                        <label for="username">Site Title</label>

                                        <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo $editsettingdata['title']; ?>">

                                    </div>
                                    <div class="col-6 mb-3">

                                        <label for="username">Site Logo (File Dimension 200 X 200px)</label><br />
                                        <input type="file" name="logo" id="logo" class="form-control" >
                                        <div id="logo_error"></div>
                                        <img id="img1" src="<?php echo base_url();?>uploads/logo/<?php echo $editsettingdata['logo'];?>" width="70px" height="70px" alt="" ><br />
                                        
                                        

                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="username">Email</label>

                                        <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $editsettingdata['email']; ?>">

                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="username">Site Fav icon (File Dimension 200 X 200px)</label><br />
                                         <input type="file" name="icon" id="icon" class="form-control" >
                                        <div id="icon_error"></div>
                                        <img id="img2" src="<?php echo base_url();?>uploads/logo/<?php echo $editsettingdata['icon'];?>" width="70px" height="70px" alt="" ><br />
                                        
                                       

                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="username">Mobile Number</label>

                                        <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="mobile" value="<?php echo $editsettingdata['mobile']; ?>" >

                                    </div>
                                    <div class="col-6 mb-3">
                                         <label for="address" class="col-form-label">Address </label>
                                         <textarea class="form-control" name="address" id="address"><?php echo $editsettingdata['address']; ?></textarea>

                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="username">Copyright Content</label>

                                        <input type="text" class="form-control" name="copyright" placeholder="Copyright content" value="<?php echo $editsettingdata['copyright']; ?>">

                                    </div> 
                                    <div class="col-6 mb-3">
                                        <label for="username">Mail Username</label>

                                        <input type="text" class="form-control" name="mail_username" placeholder="Mail Username" value="<?php echo $editsettingdata['mail_username']; ?>">

                                    </div> 
                                    <div class="col-6 mb-3">
                                        <label for="username">Mail Password</label>

                                        <input type="password" class="form-control" name="mail_pass" placeholder="Mail Password" value="<?php echo $editsettingdata['mail_pass']; ?>">

                                    </div> 
                                    <div class="col-6 mb-3">
                                        <label for="username">Port Number</label>

                                        <input type="text" class="form-control" name="mail_port" placeholder="Port Number" value="<?php echo $editsettingdata['mail_port']; ?>">

                                    </div> 
                                    <div class="col-12 mb-5">

                                        <button type="submit" id="save" class="btn btn-primary">Update Details</button>   <button type="button" id="cancel" class="btn btn-outline-warning">Cancel</button>

                                    </div>

                                    <input type="hidden" name="logofile" value="<?php echo $editsettingdata['logo'];?>">
                                    <input type="hidden" name="iconfile" value="<?php echo $editsettingdata['icon'];?>">
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/manual_js/settings.js"></script>