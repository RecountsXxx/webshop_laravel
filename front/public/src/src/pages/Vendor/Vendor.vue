<template>
  <div class="ms-5  p-3">
    <h1 class="text-3xl font-bold mb-4 ms-5">{{ vendor.vendor_name }}</h1>
    <div class="mb-8 flex flex-row gap-5">
      <img :src="vendor.image" alt="{{ vendor.vendor_name }}" class="rounded-lg object-contain ms-5 mb-4" style="width: 200px; height: 200px;">

      <p class="text-gray-600"> {{ vendor.description }}</p>
    </div>
  </div>

  <ProductsList :fetch-products-props="fetchProducts"></ProductsList>
</template>

<script>
import VendorService from "@/Services/Vendor/VendorService";
import ProductsList from "@/components/ProductsList.vue";

export default {
  name: 'brandComponent',
  components: {ProductsList},
  data() {
    return {
      vendor: '',
    }
  },
  async created() {
    this.vendor = await VendorService.getVendorPerId(this.$route.params.id);
  },
  methods: {
    async fetchProducts(pageNumber) {
      return VendorService.getProductsVendor(this.$route.params.id,pageNumber);
    }
  }
}
</script>
