<template>
    <div class="p-10">
      <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-bold">All products</h1>
        <div class="flex items-center gap-4">
          <select
            class="py-2 px-3 border border-gray-200 focus:border-gray-400 rounded-md focus:outline-none"     v-model="sortBy"
          >
            <option value="name">Per name</option>
            <option value="price_asc">Per price (low)</option>
            <option value="price_desc">Per price (most)</option>
          </select>
          <div class="relative">
            <input
              type="text"
              class="border border-gray-200 rounded-md py-2 pl-10 pr-4 focus:outline-none focus:border-gray-400"
              placeholder="Поиск..." v-model="searchQuery"
            />


            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <img src="/search.svg" />
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-4 gap-10">
        <CardComponent
            v-for="product in filteredProducts"
            :key="product.id"
            :id="product.id"
            :title="product.title"
            :price="product.price"
            :vendor_id="product.vendor_id"
            :img="product.images[0].image"
        />

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
import CardComponent from "@/components/Card.vue";
export default{
  name:'productsList',
  components: {CardComponent},
  props:{
    productsProps:Array,
    fetchProductsProps: {
      type: Function,
      required: true
    }
  },
  data(){
    return{
      products: [],
      searchQuery: '',
      currentPage: 1,
      perPage: 12,
      totalRows: 0,
      sortBy: 'name',
      minPrice: null,
      maxPrice: null
    }
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalRows / this.perPage);
    },
    filteredProducts() {
      let filteredProducts = this.products.filter(product => {
        return product.title.toLowerCase().includes(this.searchQuery.toLowerCase());
      });

      if (this.minPrice !== null) {
        filteredProducts = filteredProducts.filter(product => product.price >= this.minPrice);
      }
      if (this.maxPrice !== null) {
        filteredProducts = filteredProducts.filter(product => product.price <= this.maxPrice);
      }

      if (this.sortBy === 'price_asc') {
        filteredProducts.sort((a, b) => a.price - b.price);
      } else if (this.sortBy === 'price_desc') {
        filteredProducts.sort((a, b) => b.price - a.price);
      }

      return filteredProducts;
    }
  },
  async created(){
    await this.fetchProducts();
  },
  methods:{
    async fetchProducts(){
      const response = await this.fetchProductsProps(this.currentPage);
      console.log(response);
      this.products = response.data;
      this.totalRows = response.total;
    },
    goToPage(page) {
      if (page !== this.currentPage) {
        this.currentPage = page;
        this.fetchProducts();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchProducts();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchProducts();
      }
    },
  }
}
</script>

<style>

</style>
