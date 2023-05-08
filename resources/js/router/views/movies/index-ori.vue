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
      title: "Movies Index",
      isWriteAllowed: true,
      moviesList: []
    };
  },
  mounted() {
    this.fetchMovies()
  },
  methods: {
    fetchMovies() {
      axios
        .get("/api/movies", {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
        })
        .then((response) => {
          // console.log(response.data.data)
          this.moviesList = response.data.data;
        });
        // console.log("fetchmovies")
    },
    deleteMovie(movieId) {
      // console.log("delete-movie-id: ", movieId)
      axios
        .delete("/api/movies/" + movieId, {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
        })
        .then((response) => {
          console.log(response.data);

          this.fetchMovies()
        })
        .catch(error => {
          console.error(error);
        });
    }
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
            <h4 class="page-title">{{ title }}</h4>
          </div>
        </div>
      </div>

      <!-- Global action search, add-movie, reset -->
      <div class="row mb-2">
        <div class="d-flex justify-content-between">
          <div class="search-wrappr d-flex">
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
          </div>

          <div class="add-movie-wrappr">
            <router-link
              to="/new-movie"
              class="btn btn-primary"
              ><em class="mdi mdi-movie-open-plus-outline"></em
            > Add movie</router-link>
          </div>
        </div>
      </div>

      <div class="row">
      <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
              <th>Name</th>
              <th>Production Studio</th>
              <th>Year of Release</th>
              <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          <template v-for="movie in moviesList" :key="movie.id">
            <tr>
              <td>{{ movie.name }}</td>
              <td>{{ movie.studio }}</td>
              <td>{{ movie.year_of_release }}</td>
              <td>
                <router-link
                  :to="{
                    name: 'edit-movie',
                    params: { id: movie.id },
                  }"
                  class="btn btn-light btn-sm me-2"
                  ><em class="mdi mdi-movie-open-edit-outline"></em
                ></router-link>
                <button type="button" class="btn btn-danger btn-sm" @click="deleteMovie(movie.id)">
                  <i class="mdi mdi-delete-outline"></i>
                </button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
      </div>

    </div>
    <!-- container -->

  </Layout>
</template>
