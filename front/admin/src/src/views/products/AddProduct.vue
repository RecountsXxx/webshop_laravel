<template>
  <div class="p-3">
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
          <input type="text" class="form-control" id="price" v-model="formData.price" required>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">New price</label>
          <input type="text" class="form-control" id="new_price" v-model="formData.new_price">
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Count</label>
          <input type="text" class="form-control" id="price" v-model="formData.count" required>
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
        price: 100,
        category_id: '',
        vendor_id: '',
        brand_id: '',
        count: 1,
        new_price: '',

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
    async addProduct() {
      const formData = new FormData();
      formData.append('title', this.formData.title);
      formData.append('description', this.formData.description);
      formData.append('price', parseFloat(this.formData.price));
      formData.append('category_id', this.formData.category_id);
      formData.append('vendor_id', this.formData.vendor_id);
      formData.append('brand_id', this.formData.brand_id);
      formData.append('count', this.formData.count);
      if(this.formData.new_price != ''){
        formData.append('new_price', this.formData.new_price);
      }
      const product = await ProductService.addProduct(formData)
      if(product != null) {
          for (const image of this.formData.images) {
            const formData = new FormData();
            formData.append('image', image);
            formData.append('product_id', product.id);

            await ProductService.addImage(formData);
          }
      }
    },
    async fetchCategories() {
      try {
        let allCategories = [];
        let page = 1;
        let totalPages = 1;
        while (page != null) {
          let response = await axios.get(`http://localhost/api/admin/categories?page=${totalPages}`);
          allCategories = allCategories.concat(response.data.data.categories.data);
          page = response.data.data.categories.next_page_url;
          totalPages++;
        }
        this.categories = allCategories;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },

    async fetchVendors() {
      try {
        let allVendors = [];
        let page = 1;
        let totalPages = 1;
        while (page != null) {
          let response = await axios.get(`http://localhost/api/admin/vendors?page=${totalPages}`);
          allVendors = allVendors.concat(response.data.data.vendors.data);
          page = response.data.data.vendors.next_page_url;
          totalPages++;
        }
        this.vendors = allVendors;
      } catch (error) {
        console.error('Error fetching vendors:', error);
      }
    },
    async fetchBrands() {
      try {
        let allBrands = [];
        let page = 1;
        let totalPages = 1;
        while (page != null) {
          let response = await axios.get(`http://localhost/api/admin/brands?page=${totalPages}`);
          allBrands = allBrands.concat(response.data.data.brands.data);
          page = response.data.data.brands.next_page_url;
          totalPages++;
        }
        this.brands = allBrands;
      } catch (error) {
        console.error('Error fetching brands:', error);
      }
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
