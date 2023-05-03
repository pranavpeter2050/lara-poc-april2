<script>
import Layout from "../../../components/App.vue";
export default {
  page: {
    title: "Index of Movies",
  },
  components: {
    Layout,
  },
  data() {
    return {
      isWriteAllowed: true
    };
  }
};
</script>
<template>
  <Layout>

    <!-- Start Content-->
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <div class="page-title-right">

                <form class="d-flex">
                  <!-- Topbar Search Form -->
                  <div class="app-search dropdown">
                    <form>
                      <div class="input-group">
                        <input type="search" class="form-control dropdown-toggle"  placeholder="Search..." id="top-search">
                        <span class="mdi mdi-magnify search-icon"></span>
                        <button class="input-group-text btn btn-primary" type="submit">Search</button>
                      </div>
                    </form>

                    <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                      <!-- item-->
                      <div class="dropdown-header noti-title">
                        <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                      </div>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="uil-notes font-16 me-1"></i>
                        <span>Analytics Report</span>
                      </a>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="uil-life-ring font-16 me-1"></i>
                        <span>How can I help you?</span>
                      </a>

                      <!-- item-->
                      <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="uil-cog font-16 me-1"></i>
                        <span>User profile settings</span>
                      </a>

                      <!-- item-->
                      <div class="dropdown-header noti-title">
                        <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                      </div>

                      <div class="notification-list">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <div class="d-flex">
                            <img class="d-flex me-2 rounded-circle" src="assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="32">
                            <div class="w-100">
                              <h5 class="m-0 font-14">Erwin Brown</h5>
                              <span class="font-12 mb-0">UI Designer</span>
                            </div>
                          </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                          <div class="d-flex">
                            <img class="d-flex me-2 rounded-circle" src="assets/images/users/avatar-5.jpg" alt="Generic placeholder image" height="32">
                            <div class="w-100">
                              <h5 class="m-0 font-14">Jacob Deo</h5>
                              <span class="font-12 mb-0">Developer</span>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                <!-- <div class="input-group">
                  <input type="text" class="form-control form-control-light" id="dash-daterange">
                  <span class="input-group-text bg-primary border-primary text-white">
                    <i class="mdi mdi-calendar-range font-13"></i>
                  </span>
                </div> -->
                <a href="javascript: void(0);" class="btn btn-primary ms-2">
                  <i class="mdi mdi-autorenew"></i>
                </a>
              </form>
            </div>
            <h4 class="page-title">Movies Index</h4>

            <div class="row mb-2" v-if="isWriteAllowed">
              <div class="col-sm-8">
              </div>
              <div class="col-sm-4">
                <div class="text-sm-end">
                  <router-link
                    to="/new-movie"
                    class="btn btn-primary btn-sm"
                    ><em class="mdi mdi-movie-open-plus-outline"></em
                  > Add movie</router-link>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
    <!-- container -->

  </Layout>
</template>
