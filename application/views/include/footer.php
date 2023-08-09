 <!-- START: Footer-->
       <!--  <footer class="site-footer">
            2020 &copy; @ Shadowws.com
        </footer> -->
        <!-- END: Footer-->


        <!-- START: Back to top-->
        <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->

 
        <script type="text/javascript"> 
        var base_url = '<?php echo base_url(); ?>'; 
    </script>

        <!-- START: Template JS-->
       
        <script src="<?php echo base_url();?>assets/dist/vendors/moment/moment.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?php echo base_url();?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <!-- END: Template JS-->       

        <!-- START: APP JS-->
        <script src="<?php echo base_url();?>assets/dist/js/app.js"></script>
        <!-- END: APP JS-->

        <!-- START: Page JS-->
        <script src="<?php echo base_url();?>assets/dist/js/app.invoicelist.js"></script>
        <!-- END: Template JS-->
 
        <!-- START: Page Vendor JS-->
        <script src="<?php echo base_url();?>assets/dist/vendors/raphael/raphael.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/morris/morris.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/chartjs/Chart.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/starrr/starrr.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>        
        <script src="<?php echo base_url();?>assets/dist/vendors/chartjs/Chart.min.js"></script>  
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/apexcharts/apexcharts.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/sweetalert/sweetalert.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/js/sweetalert.script.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page JS-->
        <script src="<?php echo base_url();?>assets/dist/js/home.script.js"></script>
        <!-- END: Page JS-->

         <!-- Datatable-->
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/js/jquery.dataTables.min.js"></script> 
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/js/datatable.script.js"></script>
                
        <script src="<?php echo base_url();?>assets/dist/vendors/select2/js/select2.full.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/js/select2.script.js"></script>

<!-- END: Page Vendor JS-->


    </body>
    <!-- END: Body-->
</html>
<script>
$(document).ready(function() {
    
   // $('.selectpicker').selectpicker();
    $('#from_date').datepicker();
    $('#to_date').datepicker();

    //$('.selectize').selectize();
});
</script>