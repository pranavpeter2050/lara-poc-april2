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

        <ul class="list-unstyled topbar-menu float-end mb-0 mt-0.5">

          <li class="notification-list">
            <div class="user-info-wrappr mt-2">
              <button type="button" class="logout-bttn btn btn-dark btn-sm" @click="logout" >
                <em class="mdi mdi-logout"></em>
                Logout
              </button>
            </div>

          </li>
        </ul>

        <div class="main-title-wrappr">
          <h1 class="display-6 pt-2">
            MoviesDB
            <span class="account-user-name ms-2"> Welcome <strong>{{ user_name }}</strong>!</span>
          </h1>
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
<style scoped>
.account-user-name {
  font-size: 14px;
}

.logout-bttn {
  padding: 3px 8px;
  font-size: 12px;
}
</style>
<script>
import store from '../store/index';
export default {
  name: 'App',
  computed: {
    isLoggedIn: function() {
      return store.getters.isLoggedIn
    }
  },
  data() {
    return {
      isDarkMode: false,
      showProfileMenu: false,
      user_name: localStorage.getItem('uname')
    };
  },
  mounted() {
    $('.dropdown-toggle').dropdown()
  },
  methods: {
    logout() {
      axios.post("/api/logout", this.form, {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      })
      .then(resp => {
        console.log(resp)
        localStorage.removeItem('token')
        localStorage.removeItem('uid')
        localStorage.removeItem('uname')
        delete axios.defaults.headers.common['Authorization']
        window.location.href='/logout'
      })
      .catch(err => {
        localStorage.removeItem('token')
        console.log(err);
      })
    }
  }
};
</script>
