<template>
  <div class="product-details  m-1" v-if="product">
    <h1 class="text-3xl ms-4  mt-3 font-bold text-gray-900 mb-4">{{ product.title }}</h1>
    <div class="flex flex-row">
      <div class="carousel relative rounded-lg flex justify-center overflow-hidden" data-carousel="static">
        <div class="relative flex justify-center" data-carousel-inner>
          <div class="duration-700 flex justify-center ease-in-out" data-carousel-item>
            <img :src="slides[currentIndex]" style="object-fit: contain;" class=" h-full w-full" alt="Slide 1">
          </div>
        </div>

        <button @click="prevSlide" type="button"
                class="flex absolute top-1/2 left-3 z-40 items-center justify-center w-10 h-10 bg-gray-200/50 rounded-full hover:bg-gray-300 focus:outline-none transition"
                data-carousel-prev>
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        <button @click="nextSlide" type="button"
                class="flex absolute top-1/2 right-3 z-40 items-center justify-center w-10 h-10 bg-gray-200/50 rounded-full hover:bg-gray-300 focus:outline-none transition"
                data-carousel-next>
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
               xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
      <div>
        <p style="min-width: 300px; max-width: 600px;" class="w-full text-gray-700 text-1xl">{{ product.description }}</p>
        <p class="text-gray-900 font-semibold text-xl my-4">Price: <span class="text-green-500">{{ product.price }} $</span></p>
        <button type="submit" class="p-5 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Buy now!
        </button>
      </div>
    </div>
    <div class="flex items-center my-4">
      <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
      </svg>
      <router-link :to="'/vendor/'+product.vendor.id" class="text-blue-500 hover:underline">Vendor: {{ product.vendor.vendor_name }}</router-link>
    </div>
    <div class="flex items-center my-4">
      <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
      </svg>
      <router-link :to="'/category/'+product.category.id" class="text-blue-500 hover:underline">Cateogry: {{ product.category.category_name }}</router-link>
    </div>
    <div class="flex items-center my-4">
      <svg class="w-6 h-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
      </svg>
      <router-link :to="'/brand/'+product.brand.id" class="text-blue-500 hover:underline">Brand: {{ product.brand.brand_name }}</router-link>
    </div>
    <div class="flex flex-row gap-5">
    <div v-if="product.comments.length > 0"   style="width: 450px; min-width: 450px; max-height: 400px;" class="overflow-y-auto my-4">
      <h2 class="text-xl font-semibold mb-2">Reviews:</h2>
      <div v-for="(review, index) in product.comments" :key="index"  class="flex mt-2 items-start gap-2.5">
        <div style="width: 450px;" class="flex flex-col w-full max-w-[450px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
          <div class="flex items-center space-x-2 rtl:space-x-reverse">
            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{review.author.name}}</span>
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{formatDate(review.created_at)}}</span>
          </div>
          <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{review.text}}</p>
          <div class="flex flex-row">
            <div class="flex flex-row" v-for="star in 5" :key="star.id" >
              <svg
                  v-if="star <= review.rating"
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-7 w-7 inline"
                  viewBox="0 0 20 20"
                  fill="gold"
              >
                <path
                    fill-rule="evenodd"
                    d="M10 2.706l1.3 3.582h4.03l-3.272 2.548 1.273 3.716-3.274-2.548-3.272 2.548 1.274-3.716-3.273-2.548h4.031l1.299-3.582z"
                    clip-rule="evenodd"
                />
              </svg>
              <svg
                  v-else
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-7 w-7 inline"
                  viewBox="0 0 20 20"
                  fill="currentColor"
              >
                <path
                    fill-rule="evenodd"
                    d="M10 2.706l1.3 3.582h4.03l-3.272 2.548                  1.273 3.716-3.274-2.548-3.272 2.548 1.274-3.716-3.273-2.548h4.031l1.299-3.582z"
                    clip-rule="evenodd"
                    class="text-gray-300"
                />
              </svg>
            </div>
          </div>
        </div>
      </div>

    </div>
      <form @submit.prevent="addReview" class="my-4 w-full">
        <label for="review" class="block font-medium text-gray-700 text-2xl">Write review:</label>
        <textarea v-model="newReview.text" id="review" name="review" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        <div class="flex items-center mt-2">
          <label class="block text-2xl font-medium text-gray-700 mr-4">Stars:</label>
          <div class="mt-3" v-for="star in 5" :key="star.id">
            <button
                @click.prevent="newReview.rating = star"
                :key="star.id"
                :class="{ 'text-yellow-500': star <= newReview.rating, 'text-gray-400': star > newReview.rating }"
                class="focus:outline-none focus:ring-0"
            >
              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-10 w-10"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  :aria-label="'Rate ' + star + ' out of 5'"
              >
                <path
                    :class="{ 'text-yellow-500': star <= newReview.rating, 'text-gray-400': star > newReview.rating }"
                    fill-rule="evenodd"
                    d="M10 2.706l1.3 3.582h4.03l-3.272 2.548 1.273 3.716-3.274-2.548-3.272 2.548 1.274-3.716-3.273-2.548h4.031l1.299-3.582z"
                    clip-rule="evenodd"
                />
              </svg>
            </button>
          </div>
        </div>
        <div class="mt-4">
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Add
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import ProductService from "@/Services/Product/ProductService";

export default {
  data() {
    return {
      product: null,
      newReview: {
        text: '',
        rating: 0
      },
      currentIndex: 0,
      slides: []
    };
  },
  methods: {
    async addReview() {
      // Проверка, что текст комментария не пустой и рейтинг больше 0
      if (this.newReview.text.trim() !== "" && this.newReview.rating > 0) {
        const review = {
          text: this.newReview.text,
          rating: this.newReview.rating,
          product_id: this.$route.params.id,
          author_id: JSON.parse(localStorage.getItem('user')).id,
          // Добавление текущей даты при добавлении комментария
          created_at: new Date().toISOString()
        };
        await ProductService.addComment(review);
        console.log('Добавленный отзыв:', review);
        // Добавление комментария в список отзывов без перезагрузки страницы
        this.product.comments.push({
          text: this.newReview.text,
          rating: this.newReview.rating,
          author: { name: JSON.parse(localStorage.getItem('user')).name },
          // Присваивание текущей даты
          created_at: review.created_at
        });
        // Сброс полей формы
        this.newReview.text = '';
        this.newReview.rating = 0;
      }
    },
    nextSlide() {
      if (this.currentIndex < this.slides.length - 1) {
        this.currentIndex++;
      } else {
        this.currentIndex = 0;
      }
    },
    prevSlide() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      } else {
        this.currentIndex = this.slides.length - 1;
      }
    },
    formatDate(dateTimeString) {
      const date = new Date(dateTimeString);
      const day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
      const month = date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1;
      const year = date.getFullYear();
      const hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
      const minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
      const seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();
      return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    }
  },
  async created() {
    const productId = this.$route.params.id;
    try {
      this.product = await ProductService.getProduct(productId);
      this.product.images.forEach((item) => {
        this.slides.push(item.image);
      });
    } catch (error) {
      console.error(error);
      this.product = null;
    }
  }
};
</script>

<style>
/* Ваши стили здесь */
</style>
