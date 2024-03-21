<template>
  <div>
    <section class="breadcrumb-option">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb__text">
              <h4>Shop</h4>
              <div class="breadcrumb__links">
                <a href="./index.html">Home</a>
                <span>Shop</span>
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
              <div class="shop__sidebar__search">
                <form action="#">
                  <input v-model="searchQuery" type="text" placeholder="Search...">
                  <button type="submit"><span class="icon_search"></span></button>
                </form>
              </div>
              <div class="shop__sidebar__accordion">
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-heading">
                      <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="shop__sidebar__categories">
                          <ul class="nice-scroll">
                            <li><a href="#">Men (20)</a></li>
                            <li><a href="#">Women (20)</a></li>
                            <li><a href="#">Bags (20)</a></li>
                            <li><a href="#">Clothing (20)</a></li>
                            <li><a href="#">Shoes (20)</a></li>
                            <li><a href="#">Accessories (20)</a></li>
                            <li><a href="#">Kids (20)</a></li>
                            <li><a href="#">Kids (20)</a></li>
                            <li><a href="#">Kids (20)</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-heading">
                      <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="shop__sidebar__brand">
                          <ul>
                            <li><a href="#">Louis Vuitton</a></li>
                            <li><a href="#">Chanel</a></li>
                            <li><a href="#">Hermes</a></li>
                            <li><a href="#">Gucci</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-heading">
                      <a data-toggle="collapse" data-target="#collapseTwo">Vendors</a>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="shop__sidebar__brand">
                          <ul>
                            <li><a href="#">Louis Vuitton</a></li>
                            <li><a href="#">Chanel</a></li>
                            <li><a href="#">Hermes</a></li>
                            <li><a href="#">Gucci</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-heading">
                      <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                    </div>
                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="shop__sidebar__price">
                          <ul>
                            <li><a href="#">$0.00 - $50.00</a></li>
                            <li><a href="#">$50.00 - $100.00</a></li>
                            <li><a href="#">$100.00 - $150.00</a></li>
                            <li><a href="#">$150.00 - $200.00</a></li>
                            <li><a href="#">$200.00 - $250.00</a></li>
                            <li><a href="#">250.00+</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
                    <select>
                      <option value="">Low To High</option>
                      <option value="">$0 - $55</option>
                      <option value="">$55 - $100</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div  v-for="product in filteredProducts" :key="product.id" class=" col-lg-4 col-md-6 col-sm-6">
                <ProductCard :key="product.id"
                             :id="product.id"
                             :title=product.title
                             :price=product.price
                             :new_price=product.new_price
                             :count=product.count
                             :rating=product.rating
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
import ProductService from "@/services/Product/ProductService";
import ProductCard from "@/components/ProductComponents/ProductCard.vue";
export default{
  name:'productsList',
  components: {ProductCard},
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
      return this.products.filter(product => {
        return product.title.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  async created(){
    await this.fetchProducts();
  },
  methods:{
    async fetchProducts(){
      const response = await ProductService.getProducts(this.currentPage);
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
