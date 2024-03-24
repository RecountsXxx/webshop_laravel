<template>
  <section class="product spad mt-3">
    <div v-if="loading && products != null" class="flex justify-center items-center h-screen">
      <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-gray-900"></div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="filter__controls">
            <li class="active" data-filter="*">Best Sellers</li>
          </ul>
        </div>
      </div>
      <div class="row product__filter">
        <div :key="product.id" v-for="product in products" class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix">
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
      </div>
    </div>
  </section>
</template>
<script>
import ProductCard from "@/components/product/ProductCard.vue";
import ProductService from "@/services/product/ProductService";

export default{
  name:'TopProducts',
  components: {ProductCard},
  data(){
    return{
      products:[],
      loading: true,
    }
  },
  async created(){
   let response = await ProductService.getProducts();
    this.products = response.data;
    this.loading = false;
    console.log(this.products)
  }
}
</script>
<style scoped>

</style>