<script>
import Layout from "../../../components/App.vue";
import moment from 'moment';
export default {
  page: {
    title: "Add Movie",
  },
  components: {
    Layout,
  },
  data() {
    return {
      title: "Add Movie",
      editmode: false,
      isActive: true,
      id: this.$route.params.id,
      movieId: null,
      movieDataForm: new FormData(),
      movieData: {
        name: "",
        studio: "",
        year_of_release: ""
      }
    };
  },
  mounted() {
    // console.log("$route-param-id: ", this.$route.params.id)
    this.editmode = true;
    if (typeof this.id == "undefined") {
      this.editmode = false;
    }
    this.title = this.editmode
      ? "Edit Movie"
      : "Add Movie";

    if (this.editmode == true) {
      this.movieId = this.$route.params.id
      this.fetchMovieDetails(this.movieId)
    }
  },
  methods: {
    fetchMovieDetails(movieId) {
      axios
        .get("/api/movies/" + movieId, {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
        })
        .then((response) => {
        //   console.log(response.data);
          let movie = response.data
          this.movieData.name = movie.name
          this.movieData.studio = movie.studio

          let dateValue = movie.year_of_release;
          // Use Moment.js to check if the date value is in the required format
          if (!moment(dateValue, 'YYYY-MM-DD', true).isValid()) {
            // If the date value is not in the required format, convert it to the same
            dateValue = moment(dateValue, 'YYYY').format('YYYY-MM-DD');
          }
          this.movieData.year_of_release = dateValue
        })
        .catch(error => {
          console.error(error);
        });
    },
    movieInsert() {
      // console.log("movie-save-form-submit")
      this.movieDataForm.append("name", this.movieData.name);
      this.movieDataForm.append("studio", this.movieData.studio);
      this.movieDataForm.append("yor", this.movieData.year_of_release);

      axios
        .post("/api/movies", this.movieDataForm, {
          headers: {
            "Content-Type": "multipart/form-data",
            Accept: "application/json",
          },
        })
        .then(response => {
          console.log(response.data);

          this.$router.push({ path: "/movies" });
        })
        .catch(error => {
          console.error(error);
        });
    },
    movieUpdate() {
      // console.log("movie-update-form-submit")
      let payload = this.movieData
      payload.yor = this.movieData.year_of_release

      axios
        .patch("/api/movies/" + this.movieId, JSON.stringify(payload), {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
        })
        .then(response => {
          console.log(response.data);

          this.$router.push({ path: "/movies" });
        })
        .catch(error => {
          console.error(error);
        });
    },
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

      <div class="row">
        <div class="col-8">
          <div class="card">
            <!-- <div class="card-header bg-light">
              Quote
            </div> -->
            <div class="card-body">
              <form @submit.prevent="editmode ? movieUpdate() : movieInsert()">
                <div class="mb-3">
                  <label for="movieName" class="form-label">Movie name</label>
                  <input
                    v-model="movieData.name"
                    id="movieName"
                    class="form-control"
                    placeholder="Movie name"
                    type="text"
                  >
                  <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Movie name">
                  <small id="emailHelp" class="form-text text-muted">Enter name o the movie here.</small> -->
                </div>
                <div class="mb-3">
                  <label for="prodStudio" class="form-label">Production Studio</label>
                  <input
                    v-model="movieData.studio"
                    id="prodStudio"
                    class="form-control"
                    placeholder="Production Studio"
                    type="text"
                  >
                </div>
                <div class="mb-3">
                  <label for="yor" class="form-label">Year of Release</label>
                  <input
                    v-model="movieData.year_of_release"
                    id="yor"
                    class="form-control"
                    placeholder="Year of Release"
                    type="date"
                  >
                </div>
                <div class="bttn-wrappr">
                  <button
                    class="btn btn-primary me-1 btn-sm"
                    type="submit"
                    :disabled="!isActive"
                    v-show="!editmode"
                  >
                    Save
                  </button>
                  <button
                    v-show="editmode"
                    class="btn btn-primary me-1 btn-sm"
                    type="submit"
                    :disabled="!isActive"
                  >
                    Update
                  </button>
                  <router-link
                    to="/movies"
                    class="btn btn-light btn-sm"
                    >
                    Cancel
                  </router-link>
                </div>
              </form>
            </div> <!-- end card-body-->
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
