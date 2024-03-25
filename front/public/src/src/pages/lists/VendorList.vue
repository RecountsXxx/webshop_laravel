<template>
  <div class="p-3">
    <h1 class="text-3xl ms-5">Vendors list</h1>
    <p class="ms-5">Here you can explore the list of vendors on our platform.</p>
    <input class="mb-3 ms-5 mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
           type="text" v-model="searchQuery" placeholder="Search...">

    <br>
    <hr>
    <br>
    <div v-for="vendor in filteredVendors" :key="vendor.id" class="mt-2 relative flex flex-col w-full border border-slate-100 rounded-xl p-8 cursor-pointer transition hover:shadow-xl hover:transform hover:-translate-y-2">
      <router-link :to="'/shop/vendor/' + vendor.vendor_name">
        <div class="flex flex-row text-center align-middle items-center">
          <img width="100px" height="100px" :src="vendor.image" alt="Sneaker" />
          <h2 class="text-3xl mt-2 text-center">{{ vendor.vendor_name }}</h2>
        </div>
        <p>{{ vendor.description }}</p>
      </router-link>
    </div>
    <ul class="pagination flex justify-center mt-4">
      <li :class="{ 'opacity-50 pointer-events-none': currentPage === 1 }">
        <button @click="prevPage"
                class="py-2 px-4 border border-gray-300 rounded-l hover:bg-gray-200 focus:outline-none">
          Previous
        </button>
      </li>
      <li v-for="page in totalPages" :key="page"
          :class="{ 'opacity-50 pointer-events-none': page === currentPage }">
        <button @click="goToPage(page)"
                class="py-2 px-4 border-t border-b border-gray-300 hover:bg-gray-200 focus:outline-none">
          {{ page }}
        </button>
      </li>
      <li :class="{ 'opacity-50 pointer-events-none': currentPage === totalPages }">
        <button @click="nextPage"
                class="py-2 px-4 border border-gray-300 rounded-r hover:bg-gray-200 focus:outline-none">
          Next
        </button>
      </li>
    </ul>

  </div>

</template>

<script>
import VendorService from "@/services/vendor/VendorService";
export default{
  data(){
    return{
      vendors:[],
      searchQuery: '',
      currentPage: 1,
      perPage: 2,
      totalRows: 0
    }
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
  async created(){
    await this.fetchVendors();
  },
  methods:{
    async fetchVendors(){
      const response = await VendorService.getVendors(this.currentPage);
      this.vendors = response.vendors.data;
      this.totalRows = response.vendors.total;
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
  }
}
</script>

<style>

</style>