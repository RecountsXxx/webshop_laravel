<template>
  <div class="grid grid-cols-4 gap-10">
    <h1 v-if="brand">Brand: {{brand.brand_name}}</h1>
    <CardComponent
        v-for="product in products"
        :key="product.id"
        :id="product.id"
        :title="product.title"
        :price="product.price"
        :img="product.image"
    />

  </div>
</template>


<script>
import BrandService from "@/Services/Brand/BrandService";
import CardComponent from "@/components/Card.vue";

export default{
  name:'brandComponent',
  components: {CardComponent},
  data(){
    return{
      brand:null,
      products:null,
    }
  },
  async created(){
    this.brand = await BrandService.getBrandPerId(this.$route.params.id);
    this.products = await BrandService.getProductsBrands(this.$route.params.id);
  }
}
</script>

<style scoped>

</style>