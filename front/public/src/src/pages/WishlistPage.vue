<template>
  <section class="breadcrumb-option">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb__text">
            <h4>Wishlist</h4>
            <div class="breadcrumb__links">
              <router-link to="/"><span>Home</span></router-link>
              <router-link to="/shop"><span>Shop</span></router-link>
              <span>Wishlist</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section v-if="products.length > 0" class="shopping-cart spad">
    <div class="container">
      <div v-if="loading && products != null" class="flex justify-center items-center h-screen">
        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-gray-900"></div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="shopping__cart__table">
            <table v-if="products.length > 0">
              <thead>
              <tr>
                <th>Product</th>
                <th>Total</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="product in products" :key="product.id">
                <td class="product__cart__item">
                  <div class="product__cart__item__pic">
                    <router-link :to="'product/' + product.id"><img width="100px" height="100px" :src="product.img" alt=""></router-link>
                  </div>
                  <div class="product__cart__item__text">
                    <h6>{{product.title}}</h6>
                    <h5>${{product.price}}</h5>
                  </div>
                </td>
                <td class="cart__close"><i @click="removeProduct(product.id)" class="fa fa-close"></i></td>


              </tr>

              </tbody>
            </table>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="continue__btn">
                <router-link to="/shop">Continue Shopping</router-link>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="continue__btn update__btn">
                <router-link to="/shopping-cart"><i class="fa fa-spinner"></i> Go to cart</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div v-else class="p-10 py-10 flex justify-center items-center shopping-cart spad">
    <h1 class="text-9xl p-8 py-10 text-neutral-400">Empty! 😳</h1>
  </div>
</template>

<script>
import ProductService from "@/services/product/ProductService";

export default {
  name: 'WishlistPage',
  data() {
    return {
      products:[],
      loading: true,
    }
  },
  methods: {
    async getProducts(){
      this.products = await ProductService.getAllBookmark();
    },
    async removeProduct(id){
      this.products = this.products.filter((item) => item.id !== id)
      await ProductService.deleteFromBookmark(id);
    }
  },
  async created(){
    await this.getProducts();
    this.loading = false;
  },
}
</script>

<style scoped>

</style>