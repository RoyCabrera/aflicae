<?php $this->load->view('shared/head'); ?>
<body>
   <div class="wrapper">
      <!-- top navbar-->
      <?php //$this->load->view('shared/header'); ?>
      <!-- sidebar-->
      <?php //$this->load->view('shared/aside'); ?>
      <!-- offsidebar-->
        <?php $this->load->view('shared/offsidebar'); ?>
        <?php $this->load->view('shared/pie_scripts'); ?>
      <!-- Main section-->
      <!-- <section class="section-container"> -->
         <!-- Page content-->
         <div class="content-wrapper">
            <?php echo $contents ?>
         </div>
     <!--  </section> -->
      <?php $this->load->view('shared/footer'); ?>
   </div>

</body>

<?php

    if($this->session->userdata('error')) { echo '<script>toastr["error"]("'.$this->session->userdata('error').'");</script>'; } $this->session->unset_userdata('error');
    if($this->session->userdata('success')){ echo '<script>toastr["success"]("'.$this->session->userdata('success').'");</script>'; } $this->session->unset_userdata('success');


?>


</html>
