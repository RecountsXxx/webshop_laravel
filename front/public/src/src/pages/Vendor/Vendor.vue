<template>
  <div class="grid grid-cols-4 gap-10">
    <h1 v-if="vendor">Vendor: {{vendor.vendor_name}}</h1>
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
import VendorService from "@/Services/Vendor/VendorService";
import CardComponent from "@/components/Card.vue";

export default{
  name:'vendorComponent',
  components: {CardComponent},
  data(){
    return{
      vendor:null,
      products:null,
    }
  },
  async created(){
    this.vendor = await VendorService.getVendorPerId(this.$route.params.id);
    this.products = await VendorService.getProductsVendor(this.$route.params.id);
  }
}
</script>

<style scoped>

</style>