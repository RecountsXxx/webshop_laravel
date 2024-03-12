<template>
  <div class="product-details max-w-4xl mx-auto p-4" v-if="product">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ product.title }}</h1>
    <img :src="product.image" alt="Product Image" class=" object-cover rounded-lg shadow-lg mb-4">
    <p class="text-gray-700 text-lg mb-4">{{ product.description }}</p>
    <router-link :to="'/vendor/'+product.vendor.id" class="text-gray-700 text-lg mb-4">Vendor: {{ product.vendor.vendor_name }}</router-link>
    <br>
    <router-link :to="'/category/'+product.category.id" class="text-gray-700 text-lg mb-4">Category: {{ product.category.category_name }}</router-link>
    <br>
    <router-link :to="'/brand/'+product.brand.id" class="text-gray-700 text-lg mb-4">Brand: {{ product.brand.brand_name }}</router-link>
    <p class="text-gray-700 text-lg mb-4">{{ product.description }}</p>
    <p class="text-gray-900 font-semibold text-xl mb-4">Price: <span class="text-green-500">{{ product.price }} $</span></p>
    <button @click="addToCart" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
      Добавить в корзину
    </button>
  </div>
</template>

<script>
import ProductService from "@/Services/Product/ProductService";

export default {
  data() {
    return {
      product: null,
    };
  },
  methods: {
    addToCart() {
        ProductService.addToCart(this.product.id, this.product.title, this.product.price, this.product.image);
    }
  },
  async created() {
    const productId = this.$route.params.id;
    try {
      this.product = await ProductService.getProduct(productId);
    } catch (error) {
      console.error(error);
      this.product = null;
    }
  },
};
</script>

<style scoped>
.product-details {

}
</style>
