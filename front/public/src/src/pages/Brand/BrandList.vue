<template>
  <h1>Brands list</h1>
  <div v-for="brand in brands" :key="brand.id" class="relative flex flex-col w-full border border-slate-100 rounded-xl p-8 cursor-pointer transition hover:shadow-xl hover:transform hover:-translate-y-2">
    <router-link :to="'/brand/' + brand.id">
      <img width="100px" height="100px" :src=brand.image alt="Sneaker" />
    </router-link>
    <p>{{ brand.brand_name }}</p>
  </div>
</template>

<script>
import BrandService from "@/Services/Brand/BrandService";

export default{
  data(){
    return{
      brands:[]
    }
  },
  async created(){
    this.brands = await BrandService.getBrands();
  }
}
</script>

<style>

</style>