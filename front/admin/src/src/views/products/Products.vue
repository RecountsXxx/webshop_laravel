<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Products</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search...">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Description</th>
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
          <td>{{ product.title }}</td>
          <td>{{ truncateString(product.description, 30) }}</td>
          <td>{{ product.price }}</td>
          <td><img :src=product.image width="35px" height="35px"></td>
          <td>{{ product.category.category_name }}</td>
          <td>{{ product.brand.brand_name }}</td>
          <td>{{ product.vendor.vendor_name }}</td>
          <td>{{ product.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
            <router-link to="/add-product"><button class="btn btn-primary" @click="deleteProduct(product.id)">Edit</button></router-link>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </main>
</template>

<script>
import ProductService from "@/services/products/ProductService";

export default {
  name: 'productsView',
  data() {
    return {
      products: [],
      searchQuery: '',
    };
  },
  computed: {
    filteredProducts() {
      return this.products.filter(product =>
          product.title.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  async created() {
    this.products = await ProductService.fetchProducts();
  },
  methods: {
    async deleteProduct(productId){
      await ProductService.deleteProduct(productId);
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
  }
}
</script>

<style>

</style>
