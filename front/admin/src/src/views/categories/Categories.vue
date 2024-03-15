<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Categories</h1>
    <input class="input-group form-control mb-3" type="text" v-model="searchQuery" placeholder="Search..." @input="searchCategories">
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Category name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Created at</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="category in filteredCategories" :key="category.id">
          <td>{{ category.id }}</td>
          <td>{{ truncateString(category.category_name, 35) }}</td>
          <td>{{ truncateString(category.description, 35) }}</td>
          <td><img :src="category.image" width="35px" height="35px"></td>
          <td>{{ category.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteCategory(category.id)">Delete</button>
            <a :href="`http://localhost/category/${category.id}`"><button class="btn btn-success">View</button></a>
            <router-link :to="`/edit-category/${category.id}`"><button class="btn btn-primary">Edit</button></router-link>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <ul class="pagination">
      <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
        <button class="page-link" @click="prevPage">Previous</button>
      </li>
      <li class="page-item" v-for="page in totalPages" :key="page" :class="{ 'active': page === currentPage }">
        <button class="page-link" @click="goToPage(page)">{{ page }}</button>
      </li>
      <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
        <button class="page-link" @click="nextPage">Next</button>
      </li>
    </ul>
  </main>
</template>

<script>
import CategoryService from "@/services/categories/CategoryService";

export default {
  name: 'CategoriesView',
  data() {
    return {
      categories: [],
      searchQuery: '',
      currentPage: 1,
      perPage: 10,
      totalRows: 0
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalRows / this.perPage);
    },
    filteredCategories() {
      return this.categories.filter(category => {
        return category.category_name.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created() {
    await this.fetchCategories();
  },
  methods: {
    async fetchCategories() {
        const response = await CategoryService.fetchCategories(this.currentPage);
        this.categories = response.categories.data;
        this.totalRows = response.categories.total;
    },
    async deleteCategory(categoryId) {
        await CategoryService.deleteCategory(categoryId);
        this.categories = this.categories.filter(item => item.id !== categoryId);
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchCategories();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchCategories();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchCategories();
      }
    },
    truncateString(str, maxLength) {
      if (str.length <= maxLength) {
        return str;
      } else {
        return str.slice(0, maxLength) + '...';
      }
    },
    searchCategories() {

    }
  }
};
</script>

<style>

</style>
