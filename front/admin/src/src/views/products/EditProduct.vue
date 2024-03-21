<template>
  <div class="p-3">
    <div class="container">
      <h1>Edit Product</h1>
      <form @submit.prevent="editProduct">
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
          <input type="text" class="form-control" id="price" v-model="formData.new_price" required>
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
          <select class="form-select" id="brand" v-model="formData.brand_id" required>
            <option value="" disabled selected>Choose Brand</option>
            <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.brand_name }}</option>
          </select>
        </div>
        <div>
          <h5>Images</h5>
          <div class="d-flex flex-wrap">
            <div class="d-flex flex-row gap-2 mt-2 position-relative" v-for="(image, index) in formData.images" :key="index" style="flex: 0 0 25%;">
              <span class="position-absolute top-0 start-0  ms-1 mt-1 rounded-circle text-white" style="background: #f34444; width: 30px; height: 30px; cursor: pointer;" @click="deleteImage(index)">
                <i class="ms-2 fas fa-times" style="line-height: 30px;"></i>
              </span>
              <img :src="image.image" width="250px" height="250px">
            </div>


          </div>
          <div class="mb-3 mt-3">
            <label for="formFile" class="form-label">Add image</label>
            <input multiple class="form-control" @change="addImage" type="file" id="formFile">
          </div>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Edit Product</button>
      </form>
    </div>
  </div>
</template>

<script>
import ProductService from "@/services/products/ProductService";
import axios from "axios";
import products from "@/views/products/Products.vue";

export default {
  computed: {
    products() {
      return products;
    }
  },
  data() {
    return {
      formData: {
        title: '',
        description: '',
        price: '',
        category_id: '',
        vendor_id: '',
        brand_id: '',
        images: [],
        new_price:'',
        count:'',
      },
      images:[],
      categories: [],
      vendors: [],
      brands: [],
      product_id: this.$route.params.id,
      product: [],
    };
  },
  async created() {
    this.product = await ProductService.getProduct(this.product_id);
    this.formData.title = this.product.title;
    this.formData.description = this.product.description;
    this.formData.price = this.product.price;
    this.formData.category_id = this.product.category_id;
    this.formData.vendor_id = this.product.vendor_id;
    this.formData.brand_id = this.product.brand_id;
    this.formData.new_price = this.product.new_price;
    this.formData.count = this.product.count;
    this.formData.images = this.product.images;
  },
  methods: {
    async editProduct() {
      await ProductService.editProduct(this.formData, this.product_id);

      for (const image of this.images) {
        const formData = new FormData();
        formData.append('image', image);
        formData.append('product_id', this.product_id);

        await ProductService.addImage(formData);
      }
    },



    async addImage(event) {
      const files = event.target.files;
      for (let i = 0; i < files.length; i++) {
        const image = files[i];
        const imageUrl = URL.createObjectURL(image);
        this.formData.images.push({ image: imageUrl });
        this.images.push(image);
      }
    },

    async deleteImage(index) {
      const image = this.formData.images[index];
      if (image.id) {
        try {
          await ProductService.deleteImage(image.id);
        } catch (error) {
          console.error('Error deleting image:', error);
        }
      }
      
      const imageIndex = this.images.findIndex(img => img === image.image);
      if (imageIndex !== -1) {
        this.images.splice(imageIndex, 1);
      }
      this.formData.images.splice(index, 1);
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
/* Ваши стили здесь */
</style>
