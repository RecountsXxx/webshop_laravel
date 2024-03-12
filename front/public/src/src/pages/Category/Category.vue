<template>
  <div class="grid grid-cols-4 gap-10">
    <h1 v-if="category">Category: {{category.category_name}}</h1>
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
import CardComponent from "@/components/Card.vue";
import CategoryService from "@/Services/Category/CategoryService";

export default{
  name:'categoryComponent',
  components: {CardComponent},
  data(){
    return{
      category:null,
      products:null,
    }
  },
  async created(){
    this.category = await CategoryService.getCategoryPerId(this.$route.params.id);
    this.products = await CategoryService.getProductsCategory(this.$route.params.id);
  }
}
</script>

<style scoped>

</style>