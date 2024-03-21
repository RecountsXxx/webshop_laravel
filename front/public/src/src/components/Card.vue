<template>
    <div id={{this.id}}
         class="relative flex flex-col w-full border border-slate-100 rounded-xl p-8 cursor-pointer transition hover:shadow-xl hover:transform hover:-translate-y-2"
    >
      <div @click="clickBookmark" class="absolute top-8 left-8">
        <img :src="!isLiked ? '/like-1.svg' : '/like-2.svg'" alt="Favorite" />
      </div>
      <router-link :to="'/product/' + id">
      <img :src="img" class="w-full" alt="Sneaker" />
      </router-link>
      <p>{{ title }}</p>
      <div class="flex justify-between mt-5">
        <div class="flex flex-col gap-2">
          <span class="text-slate-200">Price:</span>
          <span class="font-bold">{{ price }} $</span>
        </div>
        <img @click="clickOrder" :src="!isOrder ? '/plus-true.svg' : '/remove.svg'" alt="Favorite" />
      </div>
    </div>
</template>

<script>
import ProductService from "@/services/Product/ProductService";

export default {
  name: 'cardComponent',
  props: {
    title: String,
    price: [String, Number],
    img: String,
    id: String,
    vendor_id: String,
    isCartElement: Boolean,
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
  methods: {
    clickBookmark() {
      this.isLiked = !this.isLiked;
      if (this.isLiked) {
        ProductService.addToBookmark(this.id, this.title, this.price, this.img);
      } else {
        ProductService.deleteFromBookmark(this.id);
        this.$emit('productRemoved', this.id);
      }
    },
    clickOrder() {
      this.isOrder = !this.isOrder;
      if (this.isOrder) {
        ProductService.addToCart(this.id, this.title, this.price, this.img,this.vendor_id);
      } else {
        ProductService.deleteFromCart(this.id);
        this.$emit('productRemoved', this.id);
      }
    }
  }
};
</script>
