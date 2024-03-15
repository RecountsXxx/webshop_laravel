<template>
  <div class="p-3">
    <div class="container">
      <h1>Edit vendor</h1>
      <form @submit.prevent="editVendor">
        <div class="mb-3">
          <label for="categoryName" class="form-label">Vendor name</label>
          <input type="text" class="form-control" id="categoryName" v-model="vendor.vendor_name" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" v-model="vendor.description" required></textarea>
        </div>
        <div class="mb-3 d-flex flex-column">
          <label for="image" class="form-label">Image</label>
          <img :src=vendor.image width="250px" height="250px" v-if="vendor.image">
          <input class="form-control mt-3" type="file" id="image" ref="imageInput">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Edit vendor</button>
      </form>
    </div>
  </div>
</template>

<script>
import VendorService from "@/services/vendors/VendorService";

export default {
  data() {
    return {
      vendor_id: this.$route.params.id,
      vendor: {},
    };
  },
  async created() {
    this.vendor = await VendorService.getVendor(this.vendor_id);
  },
  methods: {
    async editVendor() {
      const formData = new FormData();
      formData.append('vendor_name', this.vendor.vendor_name);
      formData.append('description', this.vendor.description);
      if (this.$refs.imageInput.files[0]) {
        formData.append('image', this.$refs.imageInput.files[0]);
      }

      await VendorService.editVendor(formData, this.vendor_id);
    },
  }
};
</script>

<style>

</style>
