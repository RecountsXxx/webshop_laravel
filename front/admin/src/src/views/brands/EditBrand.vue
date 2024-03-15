<template>
  <div class="p-3">
    <div class="container">
      <h1>Edit brand</h1>
      <form @submit.prevent="editBrand">
        <div class="mb-3">
          <label for="categoryName" class="form-label">Brand name</label>
          <input type="text" class="form-control" id="categoryName" v-model="brand.brand_name" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" v-model="brand.description" required></textarea>
        </div>
        <div class="mb-3 d-flex flex-column">
          <label for="image" class="form-label">Image</label>
          <img :src="brand.image" width="250px" height="250px" v-if="brand.image">
          <input class="form-control mt-3" type="file" id="image" ref="imageInput">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Edit Brand</button>
      </form>
    </div>
  </div>
</template>

<script>
import BrandService from "@/services/brands/BrandService";

export default {
  data() {
    return {
      brand_id: this.$route.params.id,
      brand: {},
    };
  },
  async created() {
    this.brand = await BrandService.getBrand(this.brand_id);
  },
  methods: {
    async editBrand() {
      const formData = new FormData();
      formData.append('brand_name', this.brand.brand_name);
      formData.append('description', this.brand.description);
      if (this.$refs.imageInput.files[0]) {
        formData.append('image', this.$refs.imageInput.files[0]);
      }

      await BrandService.editBrand(formData, this.brand_id);
    },
  }
};
</script>

<style>

</style>
