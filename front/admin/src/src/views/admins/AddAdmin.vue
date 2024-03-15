<template>
  <div class="p-3">
    <div class="container">
      <h1>Add admin</h1>
      <form @submit.prevent="addAdmin">
        <div class="mb-3">
          <label for="title" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="formData.email" required>
        </div>
        <div class="mb-3">
          <label for="title" class="form-label">Admin name</label>
          <input type="text" class="form-control" id="name" v-model="formData.name" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" v-model="formData.password" required>
        </div>
        <button type="submit" class="btn btn-primary">Add admin</button>
      </form>
    </div>
  </div>
</template>

<script>
import AdminService from "@/services/admins/AdminService";

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
    async addAdmin() {
      const formData = new FormData();
      formData.append('name', this.formData.name);
      formData.append('email', this.formData.email);
      formData.append('password', this.formData.password);
      await AdminService.addAdmin(formData);
    },
  },
};
</script>

<style>

</style>
