   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="<?php echo base_url('assets/vendor/modernizr/modernizr.custom.js'); ?>"></script>
   <!-- JQUERY-->
   <script src="<?php echo base_url('assets/vendor/jquery/dist/jquery.js');  ?>"></script>
   <!-- BOOTSTRAP-->
   <script src="<?php echo base_url('assets/vendor/popper.js/dist/umd/popper.js');  ?>"></script>
   <script src="<?php echo base_url('assets/vendor/bootstrap/dist/js/bootstrap.js');  ?>"></script>
   <!-- STORAGE API-->
   <script src="<?php echo base_url('assets/vendor/js-storage/js.storage.js');  ?>"></script>
   <!-- JQUERY EASING-->
   <script src="<?php echo base_url('assets/vendor/jquery.easing/jquery.easing.js');  ?>"></script>
   <!-- ANIMO-->
   <script src="<?php echo base_url('assets/vendor/animo/animo.js');  ?>"></script>
   <!-- SCREENFULL-->
   <script src="<?php echo base_url('assets/vendor/screenfull/dist/screenfull.js');  ?>"></script>
   <!-- LOCALIZE-->
   <script src="<?php echo base_url('assets/vendor/jquery-localize/dist/jquery.localize.js');  ?>"></script>

      <!-- FILESTYLE-->
      <script src="<?php echo base_url('assets/vendor/bootstrap-filestyle/src/bootstrap-filestyle.js'); ?>"></script>
   <!-- =============== PAGE VENDOR SCRIPTS ===============-->
   <!-- =============== APP SCRIPTS ===============-->
   <script src="<?php echo base_url('assets/js/app.js');  ?>"></script>
     <!-- =============== BOOSTRAP VALIDATOR ===============-->
   <script src="<?php echo base_url('assets/js/bootstrapValidator.min.js');  ?>"></script>
  <!-- =============== ALERTAS ===============-->
  <script src="<?php echo base_url('assets/vendor/sweetalert/dist/sweetalert.min.js');  ?>"></script>
  <script src="<?php echo base_url('assets/vendor/toastr/toastr.min.js');?>"></script>

   <!-- Datatables-->
   <script src="<?php echo base_url('assets/vendor/datatables.net/js/jquery.dataTables.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/dataTables.buttons.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/buttons.colVis.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/buttons.flash.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/buttons.html5.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/buttons.print.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-keytable/js/dataTables.keyTable.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-responsive/js/dataTables.responsive.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/jszip/dist/jszip.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/pdfmake/build/pdfmake.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/pdfmake/build/vfs_fonts.js'); ?>"></script>
   <script src="<?php echo base_url('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'); ?>"></script>

   <script>

		$( window ).on( "load", function() {
          $("#preloader").fadeOut('slow',function(){$(this).remove();});
      });



      toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}


      </script>

