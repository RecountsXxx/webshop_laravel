<template>
  <div class="ms-5  p-3">
    <h1 class="text-3xl font-bold mb-4 ms-5">{{ brand.brand_name }}</h1>
    <div class="mb-8 flex flex-row gap-5">
      <img :src="brand.image" alt="{{ brand.brand_name }}" class="rounded-lg object-contain ms-5 mb-4" style="width: 200px; height: 200px;">

      <p class="text-gray-600"> {{ brand.description }}</p>
    </div>
  </div>

  <ProductsList :fetch-products-props="fetchProducts"></ProductsList>
</template>

<script>
import BrandService from "@/Services/Brand/BrandService";
import ProductsList from "@/components/ProductsList.vue";

export default {
  name: 'brandComponent',
  components: {ProductsList},
  data() {
    return {
      brand: '',
    }
  },
  async created() {
    this.brand = await BrandService.getBrandPerId(this.$route.params.id);
  },
  methods: {
    async fetchProducts(pageNumber) {
      return BrandService.getProductsBrands(this.$route.params.id,pageNumber);
    }
  }
}
</script>
