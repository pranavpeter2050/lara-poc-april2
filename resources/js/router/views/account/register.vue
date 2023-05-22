<script>
import useVuelidate from '@vuelidate/core'
import {
  required,
  email,
  helpers,
  sameAs
} from '@vuelidate/validators'
export default {
  name: 'Register',
  setup () {
    return { v$: useVuelidate() }
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      errors:{},
      submitted: false,
      showPassword: false,
    };
  },
  validations: {
    form: {
      name: {
        required: helpers.withMessage('Name is required.', required),
      },
      email: {
        required: helpers.withMessage('Email is required.', required),
        email: helpers.withMessage('Email is invalid.', email),
      },
      password: {
        required: helpers.withMessage('Password is required.', required),
      },
      password_confirmation: {
        required: helpers.withMessage('Password confirmation is required.', required),
        sameAsPassword: helpers.withMessage("Password confirmation doesn't match.", sameAs('password'))
      }
    }
  },
  methods: {
    toggleShow() {
      this.showPassword = !this.showPassword;
    },
    registerSubmit() {
      this.submitted = true;
      // stop here if form is invalid
      this.v$.$touch();
      if (this.v$.$invalid) {
        return;
      }
      axios.post("/api/register", this.form, {
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

          window.location.href='/movies'
      })
      .catch(err => {
          let error_msg = "";
          localStorage.removeItem('token')
          console.log(err.response.data);
          if(err.response.data.success === false) {
            error_msg = "This email has already been taken."
            // error_msg = "Unable to register you right now. PLease try again after some time."
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
              <!-- Logo-->
              <div class="card-header pt-4 pb-4 text-center bg-primary">
                <a href="#">
                  <span><img src="/assets/images/logo.png" alt="logo" height="22"></span>
                </a>
              </div>

              <div class="card-body p-4">
                <div class="text-center w-75 m-auto mb-4">
                  <h4 class="text-dark-50 text-center mt-0 fw-bold">Register</h4>
                </div>

                <form action="#" @submit.prevent="registerSubmit">
                  <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input v-model="form.name" class="form-control" :class="{ 'is-invalid': submitted && v$.form.name.$error }" type="text" id="fullname" placeholder="Enter your name" required>
                    <div class="invalid-feedback" v-for="(error, index) of v$.form.name.$errors" :key="index" autocomplete="off">
                      <div class="error-msg">{{ error.$message }}</div>
                    </div>
                    <p class="text-danger" v-text="errors.name"></p>
                  </div>

                  <div class="mb-3">
                    <label for="emailaddress" class="form-label">Email address</label>
                    <input v-model="form.email" class="form-control" :class="{ 'is-invalid': submitted && v$.form.email.$error }" type="email" id="emailaddress" required placeholder="Enter your email">
                    <div class="invalid-feedback" v-for="(error, index) of v$.form.email.$errors" :key="index" autocomplete="off">
                      <div class="error-msg">{{  error.$message }}</div>
                    </div>
                    <p class="text-danger" v-text="errors.email"></p>
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        v-model="form.password"
                        :class="{ 'is-invalid': submitted && v$.form.password.$error }"
                        id="password"
                        class="form-control"
                        placeholder="Enter your password"
                        :type="showPassword ? 'text' : 'password'"
                      >
                      <div class="input-group-text" :class="{ 'show-password': showPassword }" :data-password="showPassword" @click="toggleShow">
                        <span class="password-eye"></span>
                      </div>
                      <div class="invalid-feedback" v-for="(error, index) of v$.form.password.$errors" :key="index" autocomplete="off">
                        <div class="error-msg">{{ error.$message }}</div>
                      </div>
                      <p class="text-danger" v-text="errors.password"></p>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirm Password</label>
                    <div class="input-group input-group-merge">
                      <input v-model="form.password_confirmation" type="password" id="password_confirm" class="form-control" :class="{ 'is-invalid': submitted && v$.form.password_confirmation.$error }" placeholder="Re-enter your password">
                      <div class="invalid-feedback" v-for="(error, index) of v$.form.password_confirmation.$errors" :key="index" autocomplete="off">
                        <div class="error-msg">{{ error.$message }}</div>
                      </div>
                      <p class="text-danger" v-text="errors.password_confirmation"></p>
                    </div>
                  </div>

                  <div class="mb-3 text-center">
                    <button class="btn btn-primary" type="submit"> Sign Up </button>
                  </div>

                </form>
              </div> <!-- end card-body -->
            </div>
            <!-- end card -->

            <div class="row mt-3">
              <div class="col-12 text-center">
                <p class="text-muted">Already have account? <router-link to="/login" class="text-muted ms-1"><b>Log In</b></router-link></p>
              </div> <!-- end col-->
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
