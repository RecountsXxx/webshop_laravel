<template>
  <div>
    <section class="breadcrumb-option">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb__text">
              <h4>Shop</h4>
              <div class="breadcrumb__links">
                <router-link to="/"><span>Shop</span></router-link>
                <span>All products</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>>

    <section class="shop spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="shop__sidebar">
              <div class="shop__sidebar__accordion">
                <div class="shop__sidebar__search">
                  <form action="#">
                    <input v-model="searchQuery" type="text" placeholder="Search...">
                    <button type="submit"><span class="icon_search"></span></button>
                  </form>
                </div>
                <form class="max-w-sm mx-auto">
                  <label for="countries_disabled" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                  <select v-model="selectedCategory" id="countries_disabled" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected="selected">All categories</option>
                    <option v-for="category in categories" :key="category.category_name" :value="category.category_name">{{ category.category_name }}</option>
                  </select>
                </form>
                <form class="max-w-sm mx-auto mt-2">
                  <label for="countries_disabled" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vendor</label>
                  <select v-model="selectedVendor" id="countries_disabled" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>All vendors</option>
                    <option v-for="vendor in vendors" :key="vendor.vendor_name" :value="vendor.vendor_name">{{ vendor.vendor_name }}</option>
                  </select>
                </form>
                <form class="max-w-sm mx-auto mt-2">
                  <label for="countries_disabled" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                  <select v-model="selectedBrand" id="countries_disabled" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>All brands</option>
                    <option v-for="brand in brands" :key="brand.brand_name" :value="brand.brand_name">{{ brand.brand_name }}</option>
                  </select>
                </form>
                <form class="max-w-sm mx-auto mt-3">
                  <label for="countries_disabled" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                  <div class="flex flex-row gap-4">
                    <input type="number" v-model="minPrice" class="w-50" placeholder="From: 0">
                    |
                    <input type="number" v-model="maxPrice" class="w-50" placeholder="To: 100">
                  </div>

                </form>
                <label @click="searchProducts" class="mt-3 text-center w-100 primary-btn">Apply filters</label>
            </div>
          </div>
          </div>
          <div class="col-lg-9">
            <div class="shop__product__option">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="shop__product__option__left">
                    <p>Showing {{ Math.min((currentPage - 1) * perPage + 1, totalRows) }}–{{ Math.min(currentPage * perPage, totalRows) }} of {{ totalRows }} results</p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="shop__product__option__right">
                    <p>Sort by Price:</p>
                    <select v-model="sortOption" @change="searchProducts">
                      <option value="price">Low To High</option>
                      <option value="-price">High to Low</option>
                      <option value="title">Per product title</option>
                    </select>

                  </div>
                </div>
              </div>
            </div>
            <div v-if="loading && filteredProducts != null" class="flex justify-center items-center h-screen">
              <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-gray-900"></div>
            </div>
            <div v-if="products.length > 0" class="row">
              <div  v-for="product in products" :key="product.id" class=" col-lg-4 col-md-6 col-sm-6">
                <ProductCard :key="product.id"
                             :id="product.id"
                             :title=product.title
                             :price=product.price
                             :new_price=product.new_price
                             :count=product.count
                             :rating=product.rating
                             :vendor_id=product.vendor_id
                             :image=product.images[0].image>
                </ProductCard>
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
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import ProductService from "@/services/product/ProductService";
import ProductCard from "@/components/product/ProductCard.vue";
import axios from "axios";
export default{
  name:'productsList',
  components: {ProductCard},
  data(){
    return{
      products: [],
      categories:[],
      brands:[],
      vendors:[],
      selectedVendor:'All vendors',
      selectedCategory:'All categories',
      selectedBrand:'All brands',
      searchQuery: '',
      currentPage: 1,
      perPage: 12,
      totalRows: 0,
      minPrice: null,
      maxPrice: null,
      sortOption:'title',
      loading:true,
    }
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalRows / this.perPage);
    },
    filteredProducts() {
      return this.products.filter(product => {
        return product.title.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created(){
    this.$route.params.category != null ? this.selectedCategory = this.$route.params.category : this.selectedCategory = 'All categories';
    this.$route.params.vendor != null ? this.selectedVendor = this.$route.params.vendor : this.selectedVendor = 'All vendors';
    this.$route.params.brand != null ? this.selectedBrand = this.$route.params.brand : this.selectedBrand = 'All brands';

    await this.searchProducts();
    await this.fetchBrands();
    await this.fetchVendors();
    await this.fetchCategories();
  },
  methods:{
    async searchProducts() {
      try {
        this.loading = true;
        const formData = new FormData();

        this.addFormDataItemIfNotEmpty(formData, 'title', this.searchQuery.trim());
        this.addFormDataItemIfNotEmpty(formData, 'vendor', this.selectedVendor, 'All vendors');
        this.addFormDataItemIfNotEmpty(formData, 'category', this.selectedCategory, 'All categories');
        this.addFormDataItemIfNotEmpty(formData, 'brand', this.selectedBrand, 'All brands');
        this.addFormDataItemIfNotNull(formData, 'minPrice', this.minPrice);
        this.addFormDataItemIfNotNull(formData, 'maxPrice', this.maxPrice);

        formData.append('sort', this.sortOption);

        const response = await ProductService.getFilteredProducts(formData, this.currentPage);

        this.products = response.data;
        this.totalRows = response.total;
        this.loading = false;
      } catch (error) {
        console.error('Error fetching products:', error);
        this.loading = false;
      }
    },
    addFormDataItemIfNotEmpty(formData, key, value, emptyValue = null) {
      if (value && value !== emptyValue) {
        formData.append(key, value);
      }
    },
    addFormDataItemIfNotNull(formData, key, value) {
      if (value !== null) {
        formData.append(key, value);
      }
    },
    async fetchProducts(){
      const response = await ProductService.getProducts(this.currentPage);
      console.log(response);
      this.products = response.data;
      this.totalRows = response.total;
      this.loading = false;
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
  },
}
</script>
