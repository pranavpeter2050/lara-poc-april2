<script>
export default {
  name: 'Register',
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      showError: false
    };
  },
  methods: {
    registerSubmit() {
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
          axios.defaults.headers.common['Authorization'] = token
          console.log("user: ", user);
          // this.$router.push('/movies')
          window.location.href='/movies'
      })
      .catch(err => {
          localStorage.removeItem('token')
          console.log(err);
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
                    <input v-model="form.name" class="form-control" type="text" id="fullname" placeholder="Enter your name" required>
                  </div>

                  <div class="mb-3">
                    <label for="emailaddress" class="form-label">Email address</label>
                    <input v-model="form.email" class="form-control" type="email" id="emailaddress" required placeholder="Enter your email">
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group input-group-merge">
                      <input v-model="form.password" type="password" id="password" class="form-control" placeholder="Enter your password">
                      <div class="input-group-text" data-password="false">
                        <span class="password-eye"></span>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirm Password</label>
                    <div class="input-group input-group-merge">
                      <input v-model="form.password_confirmation" type="password" id="password_confirm" class="form-control" placeholder="Enter your password">
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
