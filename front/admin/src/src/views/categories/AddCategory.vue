<template>
  <div class="p-3">
    <div class="container">
      <h1>Add category</h1>
      <form @submit.prevent="addCategory">
        <div class="mb-3">
          <label for="title" class="form-label">Category name</label>
          <input type="text" class="form-control" id="title" v-model="formData.category_name" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" v-model="formData.description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="images" class="form-label">Images</label>
          <input type="file" class="form-control" id="images" @change="onImagesChange" required>
        </div>
        <button type="submit" class="btn btn-primary">Add category</button>
      </form>
    </div>
  </div>
</template>

<script>
import CategoryService from "@/services/categories/CategoryService";

export default {
  data() {
    return {
      formData: {
        category_name: '',
        description: '',
        image: null
      },
    };
  },
  methods: {
    onImagesChange(event) {
      this.formData.image = event.target.files[0];
    },
    async addCategory() {
      const formData = new FormData();
      formData.append('category_name', this.formData.category_name);
      formData.append('description', this.formData.description);
      formData.append('image', this.formData.image);

      await CategoryService.addCategory(formData);
    },
  },
};
</script>

<style>

</style>
