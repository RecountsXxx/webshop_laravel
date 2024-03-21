<template>
  <h1 class="ms-5 mt-3">Account page</h1>
  <div class="flex justify-center items-center p-5 w-100">
    <form @submit.prevent="submitForm" class="w-full max-w-md bg-white shadow-md rounded w-100 px-8 pt-6 pb-8 mb-4">
      <h2 class="text-2xl mb-4 text-center">Become a Seller</h2>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="shop_name">Shop Name:</label>
        <input v-model="form.shop_name" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shop_name" type="text" placeholder="Enter shop name" required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description:</label>
        <textarea v-model="form.description" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" rows="4" placeholder="Enter description" required></textarea>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
        <input v-model="form.email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Enter email" required>
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
import UserService from "@/Services/User/UserService";

export default {
  name:'accountComponent',
  data() {
    return {
      form: {
        shop_name: '',
        description: '',
        email: ''
      }
    };
  },
  methods: {
    async submitForm() {
      await UserService.JoinToVendor(this.form);
      console.log('Form submitted:', this.form);
    }
  }
};
</script>
