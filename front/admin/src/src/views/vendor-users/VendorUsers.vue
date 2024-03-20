<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Vendor Users</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchUsers">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Email</th>
          <th>User name</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in filteredUsers" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteUser(user.id)">Delete</button>
            <router-link :to="`/edit-vendor-user/${user.id}`"><button class="btn btn-primary">Edit</button></router-link>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <ul class="pagination">
      <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
        <button class="page-link" @click="prevPage">Previous</button>
      </li>
      <li class="page-item" v-for="page in totalPages" :key="page" :class="{ 'active': page === currentPage }">
        <button class="page-link" @click="goToPage(page)">{{ page }}</button>
      </li>
      <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
        <button class="page-link" @click="nextPage">Next</button>
      </li>
    </ul>
  </main>
</template>

<script>
import VendorUsersService from "@/services/vendor-users/VendorUsersService";

export default {
  name: 'UsersView',
  data() {
    return {
      users: [],
      searchQuery: '',
      currentPage: 1,
      perPage: 10,
      totalRows: 0
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalRows / this.perPage);
    },
    filteredUsers() {
      return this.users.filter(user => {
        return user.name.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
        const response = await VendorUsersService.fetchUsers(this.currentPage);
        this.users = response.users.data;
        this.totalRows = response.users.total;
    },
    async deleteUser(userId) {
        await VendorUsersService.deleteUser(userId);
        this.users = this.users.filter(item => item.id !== userId);
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchUsers();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchUsers();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchUsers();
      }
    },
    searchUsers() {

    }
  }
};
</script>

<style>

</style>
