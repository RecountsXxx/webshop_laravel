<template>
  <div class="p-3">
    <div class="container">
      <h1>Add vendor</h1>
      <form @submit.prevent="addVendor">
        <div class="mb-3">
          <label for="title" class="form-label">Vendor name</label>
          <input type="text" class="form-control" id="title" v-model="formData.vendor_name" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" v-model="formData.description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="images" class="form-label">Images</label>
          <input type="file" class="form-control" id="images" @change="onImagesChange" required>
        </div>
        <button type="submit" class="btn btn-primary">Add vendor</button>
      </form>
    </div>
  </div>
</template>

<script>
import VendorService from "@/services/vendors/VendorService";

export default {
  data() {
    return {
      formData: {
        vendor_name: '',
        description: '',
        image: null
      },
    };
  },
  methods: {
    onImagesChange(event) {
      this.formData.image = event.target.files[0];
    },
    async addVendor() {
      const formData = new FormData();
      formData.append('vendor_name', this.formData.vendor_name);
      formData.append('description', this.formData.description);
      formData.append('image', this.formData.image);

      await VendorService.addVendor(formData);
    },
  },
};
</script>

<style>

</style>
