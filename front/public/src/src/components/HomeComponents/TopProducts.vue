<template>
  <section class="product spad mt-3">
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
                       :image=product.images[0].image>
          </ProductCard>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import ProductCard from "@/components/ProductComponents/ProductCard.vue";
import ProductService from "@/services/Product/ProductService";

export default{
  name:'TopProducts',
  components: {ProductCard},
  data(){
    return{
      products:[],
    }
  },
  async created(){
   let response = await ProductService.getProducts();
    this.products = response.data;
    console.log(this.products)
  }
}
</script>
<style scoped>

</style>