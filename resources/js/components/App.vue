<template>
    <!-- Begin page -->
    <div class="wrapper">

      <!-- ========== Topbar Start ========== -->
      <div class="navbar-custom topnav-navbar">
        <div class="container-fluid detached-nav">

          <!-- Topbar Logo -->
          <div class="logo-topbar">
            <!-- Logo light -->
            <a href="#" class="logo-light">
              <span class="logo-lg">
                <img src="/assets/images/logo.png" alt="logo" height="22">
              </span>
              <span class="logo-sm">
                <img src="/assets/images/logo-sm.png" alt="small logo" height="22">
              </span>
            </a>

            <!-- Logo Dark -->
            <a href="#" class="logo-dark">
              <span class="logo-lg">
                <img src="/assets/images/logo-dark.png" alt="dark logo" height="22">
              </span>
              <span class="logo-sm">
                <img src="/assets/images/logo-dark-sm.png" alt="small logo" height="22">
              </span>
            </a>
          </div>

          <ul class="list-unstyled topbar-menu float-end mb-0">

            <li class="dropdown notification-list topbar-dropdown">
              <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="/assets/images/flags/us.jpg" alt="user-image" class="me-0 me-sm-1" height="12">
                <span class="align-middle d-none d-lg-inline-block">English</span> <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <img src="/assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <img src="/assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <img src="/assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <img src="/assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                </a>

              </div>
            </li>

            <li class="notification-list d-none d-sm-inline-block">
              <a class="nav-link" href="javascript:void(0)" id="light-dark-mode">
                <i class="ri-moon-line noti-icon"></i>
              </a>
            </li>

            <li class="dropdown notification-list">
              <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                      aria-expanded="false">
                <span class="account-user-avatar">
            <img src="/assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                </span>
                <span>
            <span class="account-user-name">Dominic Keller</span>
            <span class="account-position">Founder</span>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <i class="mdi mdi-account-circle me-1"></i>
                  <span>My Account</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <i class="mdi mdi-account-edit me-1"></i>
                  <span>Settings</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <i class="mdi mdi-lifebuoy me-1"></i>
                  <span>Support</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <i class="mdi mdi-lock-outline me-1"></i>
                  <span>Lock Screen</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                  <i class="mdi mdi-logout me-1"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>

          <div class="main-title-wrappr">
            <h1 class="display-6 pt-2">MoviesDB</h1>
          </div>

        </div>
      </div>
      <!-- ========== Topbar End ========== -->

      <!-- ========== Left Sidebar Start ========== -->
      <div class="leftside-menu">

        <!-- Logo Light -->
        <a href="#" class="logo logo-light">
          <span class="logo-lg">
            <img src="/assets/images/logo.png" alt="logo" height="22">
          </span>
          <span class="logo-sm">
            <img src="/assets/images/logo-sm.png" alt="small logo" height="22">
          </span>
        </a>

        <!-- Logo Dark -->
        <a href="#" class="logo logo-dark">
          <span class="logo-lg">
            <img src="/assets/images/logo-dark.png" alt="dark logo" height="22">
          </span>
          <span class="logo-sm">
            <img src="/assets/images/logo-dark-sm.png" alt="small logo" height="22">
          </span>
        </a>

          <!-- Sidebar Hover Menu Toggle Button -->
          <button type="button" class="bg-transparent button-sm-hover p-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
            <i class="ri-checkbox-blank-circle-line align-middle"></i>
          </button>

        <!-- Sidebar -left -->
        <div class="h-100" id="leftside-menu-container" data-simplebar>

          <!--- Sidemenu -->
          <ul class="side-nav">

            <li class="side-nav-item">
              <router-link to="/movies" class="side-nav-link">
                <i class="mdi mdi-movie-open-outline"></i>
                <span> Movies </span>
              </router-link>
            </li>

            <!-- <li class="side-nav-item">
              <a href="/#" class="side-nav-link">
                <i class="mdi mdi-account"></i>
                <span> Users </span>
              </a>
            </li> -->

          </ul>
          <!--- End Sidemenu -->

          <div class="clearfix"></div>
        </div>
      </div>
      <!-- ========== Left Sidebar End ========== -->

      <!-- ============================================================== -->
      <!-- Start Page Content here -->
      <!-- ============================================================== -->

      <div class="content-page">
        <div class="content">

          <!-- Start Content-->
          <slot />
          <!-- container -->

        </div>
        <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                {{ new Date().getFullYear() }} - {{ new Date().getFullYear() + 1 }} © Hyper - Coderthemes.com
              </div>
              <div class="col-md-6">
                <div class="text-md-end footer-links d-none d-md-block">
                  <a href="javascript: void(0);">About</a>
                  <a href="javascript: void(0);">Support</a>
                  <a href="javascript: void(0);">Contact Us</a>
                </div>
              </div>
            </div>
          </div>
        </footer>
        <!-- end Footer -->

      </div>

      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
  </template>
<script>
export default {
  name: 'App',
  data() {
    return {
      isDarkMode: false,
    };
  }
}
</script>
