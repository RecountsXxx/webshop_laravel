<template>
  <div class="p-3">
    <h1 class="text-3xl ms-5">Categories list</h1>
    <p class="ms-5">Here you can explore the list of categories on our platform.</p>
    <input class="mb-3 ms-5 mt-2 p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
           type="text" v-model="searchQuery" placeholder="Search...">

    <br>
    <hr>
    <br>
    <div v-for="category in filteredCategories" :key="category.id" class="mt-2 relative flex flex-col w-full border border-slate-100 rounded-xl p-8 cursor-pointer transition hover:shadow-xl hover:transform hover:-translate-y-2">
      <router-link :to="'/shop/category/' + category.category_name">
        <div class="flex flex-row text-center align-middle items-center">
          <img width="100px" height="100px" :src="category.image" alt="Sneaker" />
          <h2 class="text-3xl mt-2 text-center">{{ category.category_name }}</h2>
        </div>
        <p>{{ category.description }}</p>
      </router-link>
    </div>
    <ul class="pagination flex justify-center mt-4">
      <li :class="{ 'opacity-50 pointer-events-none': currentPage === 1 }">
        <button @click="prevPage"
                class="py-2 px-4 border border-gray-300 rounded-l hover:bg-gray-200 focus:outline-none">
          Previous
        </button>
      </li>
      <li v-for="page in totalPages" :key="page"
          :class="{ 'opacity-50 pointer-events-none': page === currentPage }">
        <button @click="goToPage(page)"
                class="py-2 px-4 border-t border-b border-gray-300 hover:bg-gray-200 focus:outline-none">
          {{ page }}
        </button>
      </li>
      <li :class="{ 'opacity-50 pointer-events-none': currentPage === totalPages }">
        <button @click="nextPage"
                class="py-2 px-4 border border-gray-300 rounded-r hover:bg-gray-200 focus:outline-none">
          Next
        </button>
      </li>
    </ul>

  </div>

</template>

<script>
import CategoryService from "@/services/category/CategoryService";
export default{
  data(){
    return{
      categories:[],
      searchQuery: '',
      currentPage: 1,
      perPage: 2,
      totalRows: 0
    }
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
  async created(){
    await this.fetchCategories();
  },
  methods:{
    async fetchCategories(){
      const response = await CategoryService.getCategories(this.currentPage);
      this.categories = response.categories.data;
      this.totalRows = response.categories.total;
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
  }
}
</script>

<style>

</style>