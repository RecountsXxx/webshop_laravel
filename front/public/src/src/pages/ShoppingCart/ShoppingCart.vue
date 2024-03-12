<script>
import ProductService from "@/Services/Product/ProductService";
import CardComponent from "@/components/Card.vue";

export default{
  name:'ShoppingCartComponent',
  components: {CardComponent},
  data(){
    return{
      products:ProductService.getAllCart()
    }
  },
  methods: {
    removeProduct(productId){
      this.products = this.products.filter(product => product.id !== productId);
    }
  }
}
</script>

<template>
  <div class="p-10">
    <div class="flex justify-between items-center mb-10">
      <h1 class="text-3xl font-bold">Shopping cart</h1>
    </div>
    <div v-if="products.length > 0" class="grid grid-cols-4 gap-10">
      <CardComponent v-for="product in products" :key="product.id"
                     :id="product.id"
                     :title="product.title"
                     :price="product.price"
                     :img="product.img"
                     :is-cart-element="true"
                     @productRemoved="removeProduct"
      ></CardComponent>
    </div>
    <div v-else class="flex justify-center items-center">
      <img src="/pusto.svg">
      <h1 class="text-2xl text-neutral-400">Empty! 😳</h1>
    </div>
  </div>

</template>

<style scoped>

</style>