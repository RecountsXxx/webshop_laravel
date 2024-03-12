<template>
  <h1>Categories list</h1>
  <div v-for="category in categories" :key="category.id" class="relative flex flex-col w-full border border-slate-100 rounded-xl p-8 cursor-pointer transition hover:shadow-xl hover:transform hover:-translate-y-2">
    <router-link :to="'/category/' + category.id">
      <img width="100px" height="100px" :src=category.image alt="Sneaker" />
    </router-link>
    <p>{{ category.category_name }}</p>
  </div>
</template>

<script>
import CategoryService from "@/Services/Category/CategoryService";

export default{
  data(){
    return{
      categories:[]
    }
  },
  async created(){
    this.categories = await CategoryService.getCategories();
  }
}
</script>

<style>

</style>