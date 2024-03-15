<template>
  <div class="p-3">
    <div class="container">
      <h1>Edit category</h1>
      <form @submit.prevent="editCategory">
        <div class="mb-3">
          <label for="categoryName" class="form-label">Category name</label>
          <input type="text" class="form-control" id="categoryName" v-model="category.category_name" required>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" v-model="category.description" required></textarea>
        </div>
        <div class="mb-3 d-flex flex-column">
          <label for="image" class="form-label">Image</label>
          <img :src="category.image" width="250px" height="250px" v-if="category.image">
          <input class="form-control mt-3" type="file" id="image" ref="imageInput">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Edit Category</button>
      </form>
    </div>
  </div>
</template>

<script>
import CategoryService from "@/services/categories/CategoryService";

export default {
  data() {
    return {
      category_id: this.$route.params.id,
      category: {},
    };
  },
  async created() {
    this.category = await CategoryService.getCategory(this.category_id);
  },
  methods: {
    async editCategory() {
      const formData = new FormData();
      formData.append('category_name', this.category.category_name);
      formData.append('description', this.category.description);
      if (this.$refs.imageInput.files[0]) {
        formData.append('image', this.$refs.imageInput.files[0]);
      }

      await CategoryService.editCategory(formData, this.category_id);
    },
  }
};
</script>

<style>

</style>
