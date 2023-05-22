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
      title: "Index",
      token: localStorage.getItem("token"),
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
            Authorization: "Bearer " + this.token,
          },
        })
        .then((response) => {
          this.moviesList = response.data.data;
        });
    },
    deleteMovie(movieId) {
      Swal.fire({
        text: "Are you sure you want to delete this?",
        showCancelButton: true,
        confirmButtonColor: "#ff5b5b",
        cancelButtonColor: "#a1a9b1",
        cancelButtonText: "Cancel",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          axios
            .delete("/api/movies/" + movieId, {
              headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: "Bearer " + this.token,
              },
            })
            .then((response) => {
              Toast.fire({
                icon: "success",
                title: "Movie has been deleted.",
              });

              this.fetchMovies()
            })
            .catch(error => {
              Toast.fire({
                icon: "error",
                title: "Some error occured! Please try again",
              });
            });
        }
      });
    },
    formatDate(date) {
      if(date !== null )
      {
        var d = new Date(date),
          month = '' + (d.getMonth() + 1),
          day = '' + d.getDate(),
          year = d.getFullYear();

        if (month.length < 2)
          month = '0' + month;
        if (day.length < 2)
          day = '0' + day;

        return [ day, month, year].join('-');
      }
    }
  }
};
</script>
<template>
  <Layout>
    <!-- Start Content-->
    <div class="container-fluid">

      <div class="row mt-2">
        <div class="col-10">
          <div class="page-title-box">
            <h4 class="page-title">{{ title }}</h4>
          </div>
        </div>

        <div class="col-2 my-auto">
          <div class="add-movie-wrappr d-flex justify-content-end">
            <router-link
            to="/new-movie"
            class="btn btn-primary"
            ><em class="mdi mdi-movie-open-plus-outline"></em
            > Add movie</router-link>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="card">
          <div class="card-body">
            <!-- <table id="basic-datatable" class="table dt-responsive nowrap w-100 table-bordered"> -->
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
                    <td>{{ formatDate(movie.year_of_release) }}</td>
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
          </div> <!-- end card-body-->
        </div>
      </div>

    </div>
    <!-- container -->

  </Layout>
</template>
