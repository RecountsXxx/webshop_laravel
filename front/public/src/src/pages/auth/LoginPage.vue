<template>
  <div class="p-10">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-auto w-auto" src="../../assets/img/logo.png" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input id="email" v-model="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
              <div class="text-sm">
                <a href="#" class="font-semibold text-black hover:text-indigo-500">Forgot password?</a>
              </div>
            </div>
            <div class="mt-2">
              <input id="password" v-model="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="flex justify-center">
            <div class="product__details__cart__option">
              <label @click="login" class="primary-btn">Sign in</label>
            </div>
          </div>
        </div>

        <p class="text-center text-sm text-gray-500">
          Not a member?
          <router-link to="/register" class="font-semibold leading-6 text-black hover:text-indigo-500">Create an account</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import UserService from "@/services/user/UserService";

export default {
  name: 'loginComponent',
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    login() {
      UserService.login(this.email, this.password);
    }
  }
}
</script>

<style>

</style>