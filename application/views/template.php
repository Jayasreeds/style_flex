<?php $this->load->view('include/header');?>
<?php $this->load->view('include/sidenav');
$this->load->model('Settings_model');
$editsettingdata = $this->Settings_model->getSettingRow('1');
if($this->session->userdata('type') == '1')  
    $login = 'Master Panel';
else
    $login = 'Admin Panel';
?>
        <!-- START: Main Content-->
        <main>
            <div class="container-fluid site-width">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="addtional_head_h4 mb-0"><?php echo $page_title;?></h4> <p class="addtional_head_p">Welcome to <?php echo ucwords($editsettingdata['title']);?> <?php echo $login;?> </p></div>

                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard" class="add_head_a">Home</a></li>
                                <li class="breadcrumb-item active add_head_a_active"><?php echo $page_title;?></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <?php     $this->load->view('include/alert');

               
                $this->load->view($page_path);?>

                              
            </div>
        </main>
        <!-- END: Content-->

<?php $this->load->view('include/footer');?>
