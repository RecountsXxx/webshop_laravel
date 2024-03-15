<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Brands</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchBrands">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Brand name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="brand in filteredBrands" :key="brand.id">
          <td>{{ brand.id }}</td>
          <td>{{ truncateString(brand.brand_name, 35) }}</td>
          <td>{{ truncateString(brand.description, 35) }}</td>
          <td><img :src="brand.image" width="35px" height="35px"></td>
          <td>{{ brand.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteBrand(brand.id)">Delete</button>
            <a :href="`http://localhost/brand/${brand.id}`"><button class="btn btn-success">View</button></a>
            <router-link :to="`/edit-brand/${brand.id}`"><button class="btn btn-primary">Edit</button></router-link>
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
import BrandService from "@/services/brands/BrandService";

export default {
  name: 'BrandsView',
  data() {
    return {
      brands: [],
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
    filteredBrands() {
      return this.brands.filter(brand => {
        return brand.brand_name.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchBrands();
  },
  methods: {
    async fetchBrands() {
        const response = await BrandService.fetchBrands(this.currentPage);
        this.brands = response.brands.data;
        this.totalRows = response.brands.total;
    },
    async deleteBrand(brandId) {
        await BrandService.deleteBrand(brandId);
        this.brands = this.brands.filter(item => item.id !== brandId);
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchBrands();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchBrands();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchBrands();
      }
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
    searchBrands() {

    }
  }
};
</script>

<style>

</style>
