<template>
  <h1>Vendors list</h1>
  <div v-for="vendor in vendors" :key="vendor.id" class="relative flex flex-col w-full border border-slate-100 rounded-xl p-8 cursor-pointer transition hover:shadow-xl hover:transform hover:-translate-y-2">
    <router-link :to="'/vendor/' + vendor.id">
      <img width="100px" height="100px" :src=vendor.image alt="Sneaker" />
    </router-link>
    <p>{{ vendor.vendor_name}}</p>
  </div>
</template>

<script>
import VendorService from "@/Services/Vendor/VendorService";

export default{
  data(){
    return{
      vendors:[]
    }
  },
  async created(){
    this.vendors = await VendorService.getVendors();
  }
}
</script>

<style>

</style>