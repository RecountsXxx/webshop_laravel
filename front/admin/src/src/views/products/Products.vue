<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Products</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search...">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Posts count</th>
          <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in filteredProducts" :key="product.id">
          <td>{{ product.id }}</td>
          <td>{{ product.title }}</td>
          <td>{{ product.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete product</button>
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
  name: 'categoryView',
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
  }
}
</script>

<style>

</style>
