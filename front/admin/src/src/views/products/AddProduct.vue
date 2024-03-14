<template>
  <div>
    <div class="container">
      <h1>Add Product</h1>
      <form @submit.prevent="addProduct">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" v-model="formData.title" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" v-model="formData.description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" class="form-control" id="price" v-model="formData.price" required>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select" id="category" v-model="formData.category_id" required>
            <option value="" disabled selected>Choose category</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="vendor" class="form-label">Vendor</label>
          <select class="form-select" id="vendor" v-model="formData.vendor_id" required>
            <option value="" disabled selected>Choose vendor</option>
            <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">{{ vendor.vendor_name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="brand" class="form-label">Brand</label>
          <select  class="form-select" id="brand" v-model="formData.brand_id" required>
            <option value="" disabled selected>Choose Brand</option>
            <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.brand_name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="images" class="form-label">Images</label>
          <input type="file" class="form-control" id="images" @change="onImagesChange" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
      </form>
    </div>
  </div>
</template>

<script>
import ProductService from "@/services/products/ProductService";
import axios from "axios";

export default {
  data() {
    return {
      formData: {
        title: '',
        description: '',
        price: 123.2,
        category_id: '',
        vendor_id: '',
        brand_id: '',
        images: []
      },
      categories: [],
      vendors: [],
      brands: [],
    };
  },
  methods: {
    onImagesChange(event) {
      this.formData.images = event.target.files;
    },
    addProduct() {
      const formData = new FormData();
      formData.append('title', this.formData.title);
      formData.append('description', this.formData.description);
      formData.append('price', parseFloat(this.formData.price));
      formData.append('category_id', this.formData.category_id);
      formData.append('vendor_id', this.formData.vendor_id);
      formData.append('brand_id', this.formData.brand_id);
      for (let i = 0; i < this.formData.images.length; i++) {
        formData.append('images[]', this.formData.images[i]);
      }

      ProductService.addProduct(formData);
    },
    async fetchCategories() {
      let response = await axios.get('http://localhost/api/admin/categories');
      console.log(response.data.data.categories);
      this.categories = response.data.data.categories;
    },
    async fetchVendors() {
      let response = await axios.get('http://localhost/api/admin/vendors');
      console.log(response.data.data.categories);
      this.vendors = response.data.data.vendors;
    },
    async fetchBrands() {
      let response = await axios.get('http://localhost/api/admin/brands');
      console.log(response.data.data.categories);
      this.brands = response.data.data.brands;
    },
  },
  mounted() {
    this.fetchCategories();
    this.fetchVendors();
    this.fetchBrands();
  },
};
</script>

<style>

</style>
