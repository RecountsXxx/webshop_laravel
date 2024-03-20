<template>
  <div class="ms-5  p-3">
    <h1 class="text-3xl font-bold mb-4 ms-5">{{ category.category_name }}</h1>
    <div class="mb-8 flex flex-row gap-5">
      <img :src="category.image" alt="{{ category.category_name }}" class="rounded-lg object-contain ms-5 mb-4" style="width: 200px; height: 200px;">

      <p class="text-gray-600"> {{ category.description }}</p>
    </div>
  </div>

  <ProductsList :fetch-products-props="fetchProducts"></ProductsList>
</template>

<script>
import CategoryService from "@/Services/Category/CategoryService";
import ProductsList from "@/components/ProductsList.vue";

export default {
  name: 'categoryComponent',
  components: { ProductsList },
  data() {
    return {
      category: '',
    }
  },
  async created() {
    this.category = await CategoryService.getCategoryPerId(this.$route.params.id);
    console.log(this.category);
  },
  methods: {
    async fetchProducts(pageNumber) {
      return CategoryService.getProductsCategory(this.$route.params.id,pageNumber);
    }
  }
}
</script>
