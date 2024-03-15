<template>
  <div class="p-3">
    <div class="container">
      <h1>Edit admin</h1>
      <form @submit.prevent="editAdmin">
        <div class="mb-3">
          <label for="name" class="form-label">Admin name</label>
          <input type="text" class="form-control" id="name" v-model="this.admin.name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="this.admin.email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" v-model="this.admin.password" required>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Edit Admin</button>
      </form>
    </div>
  </div>
</template>

<script>
import AdminService from "@/services/admins/AdminService";

export default {
  data() {
    return {
      admin_id: this.$route.params.id,
      admin: {},
    };
  },
  async created() {
    this.admin = await AdminService.getAdmin(this.admin_id);
  },
  methods: {
    async editAdmin() {
      const data = {
        name: this.admin.name,
        email: this.admin.email,
        password: this.admin.password
      }

      await AdminService.editAdmin(data, this.admin_id);
    },
  }
};
</script>

<style>

</style>
