<template>
  <ProductsList :fetch-products-props="fetchProducts"></ProductsList>
</template>

<script>
import ProductService from "@/Services/Product/ProductService";
import ProductsList from "@/components/ProductsList.vue";

export default {
  name: 'homeComponent',
  components: {ProductsList},
  methods: {
    async fetchProducts(pageNumber) {
      return ProductService.getProducts(pageNumber);
    }
  }
}
</script>
