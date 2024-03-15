<template>
  <div class="p-3">
    <div class="container">
      <h1>Add brand</h1>
      <form @submit.prevent="addBrand">
        <div class="mb-3">
          <label for="title" class="form-label">Brand name</label>
          <input type="text" class="form-control" id="title" v-model="formData.brand_name" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" v-model="formData.description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="images" class="form-label">Images</label>
          <input type="file" class="form-control" id="images" @change="onImagesChange" required>
        </div>
        <button type="submit" class="btn btn-primary">Add brand</button>
      </form>
    </div>
  </div>
</template>

<script>
import BrandService from "@/services/brands/BrandService";

export default {
  data() {
    return {
      formData: {
        brand_name: '',
        description: '',
        image: null
      },
    };
  },
  methods: {
    onImagesChange(event) {
      this.formData.image = event.target.files[0];
    },
    async addBrand() {
      const formData = new FormData();
      formData.append('brand_name', this.formData.brand_name);
      formData.append('description', this.formData.description);
      formData.append('image', this.formData.image);

      await BrandService.addBrand(formData);
    },
  },
};
</script>

<style>

</style>
