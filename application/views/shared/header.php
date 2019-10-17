<header class="topnavbar-wrapper">
   <!-- START Top Navbar-->
   <nav class="navbar topnavbar">
      <!-- START navbar header-->
      <div class="navbar-header">
         <a class="navbar-brand" href="#/">
            <div class="brand-logo">
               <img class="img-fluid" src="<?php echo base_url('assets/img/aflicae.png'); ?>" width="45px" alt="App Logo">
            </div>
            <div class="brand-logo-collapsed">
               <img class="img-fluid" src="<?php echo base_url('assets/img/aflicae.png'); ?>" width="40px" alt="App Logo">
            </div>
         </a>
      </div>
      <!-- END navbar header-->
      <!-- START Left navbar-->
      <ul class="navbar-nav mr-auto flex-row">
         <li class="nav-item">
            <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
            <a class="nav-link d-none d-md-block d-lg-block d-xl-block" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed">
               <em class="fas fa-bars"></em>
            </a>
            <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
            <a class="nav-link sidebar-toggle d-md-none" href="#" data-toggle-state="aside-toggled" data-no-persist="true">
               <em class="fas fa-bars"></em>
            </a>
         </li>
         <div class='pull-left' id='titulomodulo' style='color:white; font-size:18px;    padding-top: 15px;'></div>
         <!-- END lock screen-->
      </ul>

      <!-- END Left navbar-->
      <!-- START Right Navbar-->
      <ul class="navbar-nav flex-row">
         <!-- Search icon-
               <li class="nav-item">
                  <a class="nav-link" href="#" data-search-open="">
                     <em class="icon-magnifier"></em>
                  </a>
               </li>->
                Fullscreen (only desktops)
               <li class="nav-item d-none d-md-block">
                  <a class="nav-link" href="#" data-toggle-fullscreen="">
                     <em class="fas fa-expand"></em>
                  </a>
               </li>-->
         <!-- START Alert menu-->

         <!-- END Alert menu-->
         <!-- START Offsidebar button-->
         <li class="nav-item">
            <a class="nav-link" href="#" data-toggle-state="offsidebar-open" data-no-persist="true">
               <em class="icon-notebook"></em>
            </a>
         </li>
         <!-- END Offsidebar menu-->
         <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Login/logout') ?>">
               <em class="icon-logout"></em>
            </a>
         </li>
      </ul>
      <!-- END Right Navbar-->
      <!-- START Search form-->
      <form class="navbar-form" role="search" action="search.html">
         <div class="form-group">
            <input class="form-control" type="text" placeholder="Type and hit enter ...">
            <div class="fas fa-times navbar-form-close" data-search-dismiss=""></div>
         </div>
         <button class="d-none" type="submit">Submit</button>
      </form>
      <!-- END Search form-->
   </nav>
   <!-- END Top Navbar-->
</header>