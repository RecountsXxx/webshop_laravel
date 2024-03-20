<template>
  <div class="p-3">
    <div class="container">
      <h1>Edit vendor user</h1>
      <form @submit.prevent="editUser">
        <div class="mb-3">
          <label for="name" class="form-label">User name</label>
          <input type="text" class="form-control" id="name" v-model="this.user.name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" v-model="this.user.email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" v-model="this.user.password" required>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Edit user</button>
      </form>
    </div>
  </div>
</template>

<script>
import VendorUsersService from "@/services/vendor-users/VendorUsersService";

export default {
  data() {
    return {
      user_id: this.$route.params.id,
      user: {},
    };
  },
  async created() {
    this.user = await VendorUsersService.getUser(this.user_id);
  },
  methods: {
    async editUser() {
      const data = {
        name: this.user.name,
        email: this.user.email,
        password: this.user.password
      }

      await VendorUsersService.editUser(data, this.user_id);
    },
  }
};
</script>

<style>

</style>
