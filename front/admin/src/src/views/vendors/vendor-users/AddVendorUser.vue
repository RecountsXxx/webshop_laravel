<template>
  <div class="p-3">
    <div class="container">
      <h1>Add vendor user</h1>
      <form @submit.prevent="addUser">
        <div class="mb-3">
          <label for="title" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="formData.email" required>
        </div>
        <div class="mb-3">
          <label for="title" class="form-label">User name</label>
          <input type="text" class="form-control" id="name" v-model="formData.name" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" v-model="formData.password" required>
        </div>
        <button type="submit" class="btn btn-primary">Add user</button>
      </form>
    </div>
  </div>
</template>

<script>
import VendorUsersService from "@/services/vendors/vendor-users/VendorUsersService";

export default {
  data() {
    return {
      formData: {
        name: '',
        email:'',
        password: '',
      },
    };
  },
  methods: {
    async addUser() {
      const formData = new FormData();
      formData.append('name', this.formData.name);
      formData.append('email', this.formData.email);
      formData.append('password', this.formData.password);
      await VendorUsersService.addUser(formData);
    },
  },
};
</script>

<style>

</style>
