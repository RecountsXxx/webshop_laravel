<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Requests</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchRequests">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Email</th>
          <th>Shop name</th>
          <th>Description</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr  v-for="request in filteredRequests" style="height: 50px;" :key="request.id">
          <td>{{ request.id }}</td>
          <td>{{ request.email }}</td>
          <td>{{ request.shop_name }}</td>
          <td>{{ request.description }}</td>
          <td>{{ request.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteRequest(request.id)">Decline</button>
            <button class="btn btn-success" @click="addToVendors(request.id)">Add to vendors</button>
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
import JoinToVendorsService from "@/services/vendors/join-to-vendors/JoinToVendorsService";

export default {
  name: 'RequestsView',
  data() {
    return {
      requests: [],
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
    filteredRequests() {
      return this.requests.filter(request => {
        return request.shop_name.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchRequests();
  },
  methods: {
    async fetchRequests() {
        const response = await JoinToVendorsService.fetchRequests(this.currentPage);
          this.requests = response.requests.data;
          this.totalRows = response.requests.total;
    },
    async deleteRequest(requestId) {
        await JoinToVendorsService.deleteRequest(requestId);
        this.requests = this.requests.filter(item => item.id !== requestId);
    },
    async addToVendors(requestId) {
      await JoinToVendorsService.addToVendors(requestId);
      this.requests = this.requests.filter(item => item.id !== requestId);
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchRequests();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchRequests();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchRequests();
      }
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
    searchRequests() {

    }
  }
};
</script>

<style>


</style>
