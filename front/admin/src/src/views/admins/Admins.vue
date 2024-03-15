<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Admins</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchAdmins">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Email</th>
          <th>Admin name</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="admin in filteredAdmins" :key="admin.id">
          <td>{{ admin.id }}</td>
          <td>{{ admin.email }}</td>
          <td>{{ admin.name }}</td>
          <td>{{ admin.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteAdmin(admin.id)">Delete</button>
            <router-link :to="`/edit-admin/${admin.id}`"><button class="btn btn-primary">Edit</button></router-link>
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
import AdminService from "@/services/admins/AdminService";

export default {
  name: 'AdminsView',
  data() {
    return {
      admins: [],
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
    filteredAdmins() {
      return this.admins.filter(admin => {
        return admin.name.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchAdmins();
  },
  methods: {
    async fetchAdmins() {
        const response = await AdminService.fetchAdmins(this.currentPage);
        this.admins = response.admins.data;
        this.totalRows = response.admins.total;
    },
    async deleteAdmin(adminId) {
        await AdminService.deleteAdmin(adminId);
        this.admins = this.admins.filter(item => item.id !== adminId);
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchAdmins();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchAdmins();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchAdmins();
      }
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
    searchAdmins() {

    }
  }
};
</script>

<style>

</style>
