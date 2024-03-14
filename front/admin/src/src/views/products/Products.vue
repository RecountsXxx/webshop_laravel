<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Products</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchProducts">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Price</th>
          <th>Image</th>
          <th>Category name</th>
          <th>Brand name</th>
          <th>Vendor name</th>
          <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in filteredProducts" :key="product.id">
          <td>{{ product.id }}</td>
          <td>{{ truncateString(product.title, 35) }}</td>
          <td>{{ product.price }}</td>
          <td><img :src="product.images[0].image" width="35px" height="35px"></td>
          <td>{{ product.category.category_name }}</td>
          <td>{{ product.brand.brand_name }}</td>
          <td>{{ product.vendor.vendor_name }}</td>
          <td>{{ product.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
            <a :href="`http://localhost/product/${product.id}`"><button class="btn btn-success">View</button></a>
            <router-link :to="`/edit-product/${product.id}`"><button class="btn btn-primary">Edit</button></router-link>
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
import ProductService from "@/services/products/ProductService";

export default {
  name: 'ProductsView',
  data() {
    return {
      products: [],
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
    filteredProducts() {
      return this.products.filter(product => {
        return product.title.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await ProductService.fetchProducts(this.currentPage);
        this.products = response.products.data;
        this.totalRows = response.products.total;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async deleteProduct(productId) {
      try {
        await ProductService.deleteProduct(productId);
        this.products = this.products.filter(item => item.id !== productId);
      } catch (error) {
        console.error('Error deleting product:', error);
      }
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchProducts();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchProducts();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchProducts();
      }
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
    searchProducts() {
      this.currentPage = 1;
    }
  }
};
</script>

<style scoped>

</style>
