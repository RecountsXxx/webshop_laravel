<template>
  <section class="vh-100 w-100 w-full gradient-custom">
    <div class="container py-5 w-100 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <div class="">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-4">Please enter your login and password!</p>
                <div class="form-outline mb-4">
                  <input type="email" v-model="email" placeholder="Enter your email" class="text-white bg-transparent form-control form-control-lg">
                </div>
                <div class="form-outline form-white mb-4">
                  <input type="password" v-model="password" placeholder="Enter your password" class="text-white bg-transparent form-control form-control-lg">
                </div>

                <p class="small pb-lg-2"><a class="text-white-50" href="#">Forgot password?</a></p>

                <button class="btn btn-outline-light btn-lg px-5" @click="login">Login</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import AuthService from "@/services/auth/AuthService";

export default {
  name: 'loginView',
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async login(){
        await AuthService.login(this.email,this.password);
        this.$router.push('dashboard')
    }
  }
}
</script>

<style scoped>
input::placeholder{
  color:gray;
}
.gradient-custom {
  background: #6a11cb;
  background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
  background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
}
</style>
