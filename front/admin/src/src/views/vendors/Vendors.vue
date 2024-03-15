<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Vendors</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchVendors">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Vendor name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="vendor in filteredVendors" :key="vendor.id">
          <td>{{ vendor.id }}</td>
          <td>{{ truncateString(vendor.vendor_name, 35) }}</td>
          <td>{{ truncateString(vendor.description, 35) }}</td>
          <td><img :src="vendor.image" width="35px" height="35px"></td>
          <td>{{ vendor.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteVendor(vendor.id)">Delete</button>
            <a :href="`http://localhost/vendor/${vendor.id}`"><button class="btn btn-success">View</button></a>
            <router-link :to="`/edit-vendor/${vendor.id}`"><button class="btn btn-primary">Edit</button></router-link>
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
import VendorService from "@/services/vendors/VendorService";

export default {
  name: 'VendorsView',
  data() {
    return {
      vendors: [],
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
    filteredVendors() {
      return this.vendors.filter(vendor => {
        return vendor.vendor_name.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchVendors();
  },
  methods: {
    async fetchVendors() {
        const response = await VendorService.fetchVendors(this.currentPage);
        this.vendors = response.vendors.data;
        this.totalRows = response.vendors.total;
    },
    async deleteVendor(vendorId) {
        await VendorService.deleteVendor(vendorId);
        this.vendors = this.vendors.filter(item => item.id !== vendorId);
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchVendors();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchVendors();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchVendors();
      }
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
    searchVendors() {

    }
  }
};
</script>

<style>

</style>
