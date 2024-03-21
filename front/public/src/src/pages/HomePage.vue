<template>
  <div>
    <banner-carousel></banner-carousel>
    <top-products></top-products>
  </div>
</template>

<script>
import BannerCarousel from "@/components/HomeComponents/BannerCarousel.vue";
import TopProducts from "@/components/HomeComponents/TopProducts.vue";

export default {
  name:'homePage',
  components: {TopProducts, BannerCarousel}
}
</script>
