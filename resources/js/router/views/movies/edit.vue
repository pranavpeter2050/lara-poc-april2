<script>
import Layout from "../../../components/App.vue";
import moment from 'moment';
import { useVuelidate } from '@vuelidate/core';
import { required, helpers } from '@vuelidate/validators';
export default {
  page: {
    title: "Add Movie",
  },
  components: {
    Layout,
  },
  setup () {
    return { v$: useVuelidate() }
  },
  data() {
    return {
      title: "Add Movie",
      editmode: false,
      isActive: true,
      submitted: false,
      id: this.$route.params.id,
      movieId: null,
      movieDataForm: new FormData(),
      movieData: {
        name: "",
        studio: "",
        year_of_release: ""
      },
      errors: [],
    };
  },
  validations: {
    movieData: {
      name: {
        required: helpers.withMessage("Name is required", required),
      },
      studio: {
        required: helpers.withMessage("Name of Production Studio is required", required),
      },
      year_of_release: {
        required: helpers.withMessage("Release Date is required", required),
      },
    },
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
    async movieInsert() {
      this.submitted = true;
      this.movieDataForm.append("name", this.movieData.name);
      this.movieDataForm.append("studio", this.movieData.studio);
      this.movieDataForm.append("yor", this.movieData.year_of_release);

      const result = await this.v$.$validate()
      if (!result) {
        // notify form is invalid
        return;
      }
      this.isActive = false;
      this.submitted = false;
      axios
        .post("/api/movies", this.movieDataForm, {
          headers: {
            "Content-Type": "multipart/form-data",
            Accept: "application/json",
          },
        })
        .then(response => {
          Toast.fire({
            icon: "success",
            title: "Movie added successfully!",
          });
          this.isActive = true;

          this.$router.push({ path: "/movies" });
        })
        .catch(error => {
          console.error(error);
        });
    },
    async movieUpdate() {
      this.submitted = true;
      let payload = this.movieData
      payload.yor = this.movieData.year_of_release
      const result = await this.v$.$validate()
      if (!result) {
        // notify form is invalid
        return;
      }
      this.isActive = false;
      this.submitted = false;
      axios
        .patch("/api/movies/" + this.movieId, JSON.stringify(payload), {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
        })
        .then(response => {
          Toast.fire({
            icon: "success",
            title: "Movie updated successfully!",
          });
          this.isActive = true;

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

      <div class="row mt-2">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">{{ title }}</h4>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <div class="card">
            <div class="card-body">
              <form @submit.prevent="editmode ? movieUpdate() : movieInsert()">
                <div class="mb-3">
                  <label for="movieName" class="form-label">Movie name</label>
                  <input
                    v-model="movieData.name"
                    id="movieName"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && v$.movieData.name.$error }"
                    placeholder="Movie name"
                    type="text"
                  >
                  <div
                    class="invalid-feedback"
                    v-for="(error, index) of v$.movieData.name.$errors"
                    :key="index"
                    autocomplete="off">
                    <div class="error-msg">
                      {{ error.$message }}
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="prodStudio" class="form-label">Production Studio</label>
                  <input
                    v-model="movieData.studio"
                    id="prodStudio"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && v$.movieData.studio.$error }"
                    placeholder="Production Studio"
                    type="text"
                  >
                  <div
                    class="invalid-feedback"
                    v-for="(error, index) of v$.movieData.studio.$errors"
                    :key="index"
                    autocomplete="off">
                    <div class="error-msg">
                      {{ error.$message }}
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="yor" class="form-label">Year of Release</label>
                  <input
                    v-model="movieData.year_of_release"
                    id="yor"
                    class="form-control"
                    :class="{ 'is-invalid': submitted && v$.movieData.year_of_release.$error }"
                    placeholder="Year of Release"
                    type="date"
                  >
                  <div
                    class="invalid-feedback"
                    v-for="(error, index) of v$.movieData.year_of_release.$errors"
                    :key="index"
                    autocomplete="off">
                    <div class="error-msg">
                      {{ error.$message }}
                    </div>
                  </div>
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
                  class="btn btn-primary me-1 btn-sm"
                  type="submit"
                  :disabled="!isActive"
                  v-show="editmode"
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
