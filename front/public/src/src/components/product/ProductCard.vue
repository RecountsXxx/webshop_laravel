<template>
  <div>
          <div class="product__item sale">
            <div class="product__item__pic set-bg" :style="{ background: 'url(' + image + ')' }">
              <span v-if="rating > 0" class="label">Sale</span>
              <ul class="product__hover">
                <li @click="clickBookmark">
                  <img src="../../assets/img/icon/heart.png" alt="">
                </li>
                <li>
                  <router-link :to="'/product/' + id">
                  <img src="../../assets/img/icon/search.png" alt="">
                  </router-link>
                </li>
              </ul>
              <div class="bottom-0 absolute w-100 w-full">
                <router-link :to="'/product/' + id">
                  <button class="btn btn-block bg-black">View</button>
                </router-link>
              </div>
            </div>
            <div class="product__item__text">
              <label>{{title}}</label>
              <br>
              <label @click="clickOrder"  class="add-cart">+ Add To Cart</label>

              <div class="rating flex flex-row justify-between">
                <div>
                  <i v-for="index in 5" :key="index" :class="{ 'fa fa-star m-1 text-warning': index <= rating, 'fa fa-star-o m-1 text-warning': index > rating }"></i>
                </div>
                <div class="ms-5">
                  <h5 v-if="count > 0" class="text-secondary text-sm font-sans">In stock</h5>
                  <h5 v-else class="text-secondary text-sm font-sans">Ended</h5>
                </div>
              </div>
              <div class="flex flex-row gap-5">
                <h5 v-if="new_price !== null">
                  <span class="text-red-500 line-through">${{ price }}</span>
                  <span class="text-green-500 ms-2">${{ new_price }}</span>
                </h5>
                <h5 v-else>$ {{ price }}</h5>
              </div>
            </div>
          </div>
        </div>
</template>
<script>
import ProductService from "@/services/product/ProductService";

export default{
  name:'productCard',
  props:{
    id:String,
    title:String,
    price:String,
    new_price:String,
    rating:String,
    count:String,
    image:String,
    vendor_id:String,
  },
  data() {
    return {
      isLiked: false,
      isOrder: false,
    };
  },
  mounted() {
    this.isLiked = ProductService.getBookmarkProductStatus(this.id);
    this.isOrder = ProductService.getCartProductStatus(this.id);
  },
  methods:{
    clickBookmark() {
      this.isLiked = !this.isLiked;
      if (this.isLiked) {
        ProductService.addToBookmark(this.id, this.title, this.new_price ? this.new_price : this.price, this.image);
      } else {
        ProductService.deleteFromBookmark(this.id);
        this.$emit('productRemoved', this.id);
      }
    },
    clickOrder() {
      if (this.count > 0) {
      ProductService.addToCart(this.id, this.title, this.new_price ? this.new_price : this.price, this.image, this.vendor_id);
    }
    else{
        this.$notify({
          title: "Products his not instock 🎉",
          type: 'error'
        });
      }
    }
  }
}
</script>
<style scoped>

</style>