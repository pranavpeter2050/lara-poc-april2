<script>
import { mapActions } from 'vuex'
import useVuelidate from '@vuelidate/core'
import {
  required,
  email,
  helpers
} from '@vuelidate/validators'

export default {
  name: 'Login',
  setup () {
    return { v$: useVuelidate() }
  },
  data() {
    return {
      form: {
        email: "",
        password: ""
      },
      errors:{},
      submitted: false,
      showPassword: false,
    };
  },
  validations: {
    form: {
      email: {
        required: helpers.withMessage('Email is required.', required),
        email: helpers.withMessage('Email is invalid.', email),
      },
      password: {
        required: helpers.withMessage('Password is required.', required),
      },
    },
  },
  methods: {
    ...mapActions(["login"]),

    toggleShow() {
      this.showPassword = !this.showPassword;
    },
    loginSubmit() {
      this.submitted = true;
      // stop here if form is invalid
      this.v$.$touch();
      if (this.v$.$invalid) {
        return;
      }
      axios.post("/api/login", this.form, {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      })
      .then(resp => {
        console.log(resp.data)
          const token = resp.data.access_token
          const user = resp.data.user
          localStorage.setItem('token', token)
          localStorage.setItem('uid', user.id)
          localStorage.setItem('uname', user.name)
          axios.defaults.headers.common['Authorization'] = token
          console.log("user: ", user);
        //   this.$router.push({ path: "/movies" })
          window.location.href='/movies'
      })
      .catch(err => {
        let error_msg = "";
        localStorage.removeItem('token')
        console.log(err.response.data);
        if(err.response.data.success === false) {
          error_msg = "Email/Password is incorrect."
          this.errors = {
            email: error_msg
          }
        } else {
          this.errors = {}
        }
      })
    }

  }
}
</script>

<template>
  <div class="authentication-bg">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xxl-4 col-lg-5">
            <div class="card">
              <!-- Logo -->
              <div class="card-header pt-4 pb-4 text-center bg-primary">
                <a href="#">
                  <span><img src="/assets/images/logo.png" alt="logo" height="22"></span>
                </a>
              </div>

              <div class="card-body p-4">
                <div class="text-center w-75 m-auto">
                  <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                  <p class="text-muted mb-4">Enter your email address and password.</p>
                </div>

                <form action="#" @submit.prevent="loginSubmit()">
                  <div class="mb-3">
                    <label for="emailaddress" class="form-label">Email address</label>
                    <input
                      v-model="form.email"
                      id="emailaddress"
                      class="form-control"
                      :class="{ 'is-invalid': submitted && v$.form.email.$error }"
                      placeholder="Enter your email"
                      type="email"
                      required
                    >
                    <div class="invalid-feedback" v-for="(error, index) of v$.form.email.$errors" :key="index" autocomplete="off">
                      <div class="error-msg">{{  error.$message }}</div>
                    </div>
                    <p class="text-danger" v-text="errors.email"></p>
                  </div>

                  <div class="mb-3">
                    <!-- <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a> -->
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        v-model="form.password"
                        id="password"
                        class="form-control"
                        :class="{ 'is-invalid': submitted && v$.form.password.$error }"
                        placeholder="Enter your password"
                        :type="showPassword ? 'text' : 'password'"
                      >
                      <div class="input-group-text" :class="{ 'show-password': showPassword  }" :data-password="showPassword" @click="toggleShow">
                        <span class="password-eye"></span>
                      </div>
                      <div class="invalid-feedback" v-for="(error, index) of v$.form.password.$errors" :key="index" autocomplete="off">
                        <div class="error-msg">{{  error.$message }}</div>
                      </div>
                      <p class="text-danger" v-text="errors.password"></p>
                    </div>
                  </div>

                  <div class="mb-3 mb-0 text-center">
                    <button class="btn btn-primary" type="submit"> Log In </button>
                  </div>

                </form>
              </div> <!-- end card-body -->
            </div>
            <!-- end card -->

            <div class="row mt-3">
              <div class="col-12 text-center">
                <p class="text-muted">Don't have an account? <router-link to="/register" class="text-muted ms-1"><b>Sign Up</b></router-link></p>
              </div> <!-- end col -->
            </div>
            <!-- end row -->

          </div> <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>
    <!-- end page -->
  </div>
</template>

<style>
.authentication-bg {
  background-image: url("/assets/images/bg-pattern-light.svg");
  background-size: cover;
  background-position: center;
}
</style>
