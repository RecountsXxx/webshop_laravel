<template>
  <hr>
  <section class="shop-details">
    <div v-if="loading && product != null" class="flex justify-center items-center h-screen">
      <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-gray-900"></div>
    </div>


    <div v-else >
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="product__details__breadcrumb">
              <a href="./index.html">Home</a>
              <a href="./shop.html">Shop</a>
              <span>Product Details</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <!-- Фотография здесь -->
            <div class="carousel relative rounded-lg flex justify-center overflow-hidden">
              <div class="relative flex justify-center">
                <div class="duration-700 flex justify-center ease-in-out">
                  <img :src="slides[currentIndex]" style="object-fit: contain; width: 600px; "  class=" h-full w-full" alt="Slide 1">
                </div>
              </div>

              <!-- Кнопки навигации -->
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
          </div>
          <div class="col-lg-6">
            <div class="product__details__text">
              <h4>{{product.title}}</h4>
              <div class="rating">
                  <i v-for="index in 5" :key="index" :class="{ 'fa fa-star m-1 text-warning': index <= product.rating, 'fa fa-star-o m-1 text-warning': index > product.rating }"></i>
                <span> - {{product.count_rating}} Reviews</span>
              </div>
              <h3>{{product.price}}$  <span v-if="product.new_price > 0">{{product.new_price}}$</span></h3>
              <p>{{product.description}}</p>
              <div class="product__details__cart__option">
                <div class="quantity">
                  <div class="pro-qty">
                    <input type="text" value="1">
                  </div>
                </div>
                <label @click="clickOrder" class="primary-btn">Add to cart</label>
              </div>
              <div class="product__details__last__option flex justify-center flex-col ">
                <h5>Guaranteed Safe Checkout</h5>
                <img src="../../assets/img/shop-details/details-payment.png" alt="">
                <ul>
                  <li><span>Vendor:</span>{{product.vendor.vendor_name}} </li>
                  <li><span>Categories:</span>{{product.category.category_name}}</li>
                  <li><span>Brand:</span>{{product.brand.brand_name}}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="product__details__content">
        <div class="container">
          <div id="reviews" class="review-section">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h4 class="m-0">{{ product.count_rating }} Reviews</h4>
              <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 188px;">
                <span class="selection">
                    <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-qd66-container">
                        <span class="select2-selection__rendered" id="select2-qd66-container" role="textbox" aria-readonly="true" title="Most Relevant">Reviews</span>
                        <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                    </span>
                </span>
                <span class="dropdown-wrapper" aria-hidden="true"></span>
            </span>
            </div>
            <div class="row">
              <div class="col-md-6">
                <table class="stars-counters">
                  <tbody>
                  <tr  v-for="(star, index) in 5" :key="index">
                    <td>
                      <span><button class="p-1 text-black  fit-button-size-medium stars-filter">{{ star }} Stars</button></span>
                    </td>
                    <td class="progress-bar-container">
                      <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                        <div class="fit-progressbar-background">
                          <span class="progress-fill " :style="{ width: calculateProgressBarWidth(product, star) }"></span>
                        </div>
                      </div>
                    </td>
                    <td class="text-black">({{ calculateCommentsCount(product.comments, star) }})</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6">
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
                  <div class="product__details__cart__option">
                    <label @click="addReview" class="primary-btn">Send review</label>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>

          <div class="review-list">
            <ul>
              <li class="gap-3">
                <div style="border-bottom: 1px solid lightgray" :key="review.id" v-for="review in product.comments"  class="mt-3 d-flex">
                  <div class="left">
                        <span>
                            <img src="https://img.icons8.com/ios-filled/50/name.png" class="profile-pict-img img-fluid" alt="" />
                        </span>
                  </div>
                  <div class="right">
                    <h4>
                      {{ review.author.name }}
                      <span class="gig-rating text-body-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                    <path
                                        fill="currentColor"
                                        d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
                                    ></path>
                                </svg>
                                {{review.rating}}.0
                            </span>
                      <span class="publish ms-3 mt-0.5 d-inline-block">{{formatDate(review.created_at)}}</span>
                    </h4>
                    <div class="">
                      <p>
                        {{review.text}}
                      </p>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>


      </div>
    </div>
  </section>
</template>
<script>
import ProductService from "@/services/Product/ProductService";

export default{
  name:'productDetails',
  data() {
    return {
      isLiked: false,
      isOrder: false,
      product: '',
      newReview: {
        text: '',
        rating: 0
      },
      loading:true,
      currentIndex: 0,
      slides: []
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
        ProductService.addToBookmark(this.id, this.title, this.price, this.image);
      } else {
        ProductService.deleteFromBookmark(this.id);
        this.$emit('productRemoved', this.id);
      }
    },
    clickOrder() {
      this.isOrder = !this.isOrder;
      if (this.isOrder) {
        ProductService.addToCart(this.id, this.title, this.price, this.image,this.vendor_id);
      } else {
        ProductService.deleteFromCart(this.id);
        this.$emit('productRemoved', this.id);
      }
    },
    async addReview() {
      if (this.newReview.text.trim() !== "" && this.newReview.rating > 0) {
        const review = {
          text: this.newReview.text,
          rating: this.newReview.rating,
          product_id: this.$route.params.id,
          author_id: 1,
          created_at: new Date().toISOString()
        };
        await ProductService.addComment(review);
        console.log('Добавленный отзыв:', review);
        this.product.comments.push({
          text: this.newReview.text,
          rating: this.newReview.rating,
          author: 'asd',
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
    },
    calculateProgressBarWidth(product, star) {
      const totalComments = product.comments.length;
      const starComments = product.comments.filter(comment => comment.rating === star).length;
      return `${(starComments / totalComments) * 100}%`;
    },
    calculateCommentsCount(comments, star) {
      return comments.filter(comment => comment.rating === star).length;
    }
  },
  async created() {
    try {
      const productId = this.$route.params.id;
      this.product = await ProductService.getProduct(productId);
      this.product.images.forEach((item) => {
        this.slides.push(item.image);
      });
      this.loading = false;
    } catch (error) {
      console.error('Ошибка загрузки продукта:', error);
    }
  }
}
</script>
<style scoped>
.review-list ul li .left span {
  width: 32px;
  height: 32px;
  display: inline-block;
}
.review-list ul li .left {
  flex: none;
  max-width: none;
  margin: 0 10px 0 0;
}
.review-list ul li .left span img {
  border-radius: 50%;
}
.review-list ul li .right h4 {
  font-size: 16px;
  margin: 0;
  display: flex;
}
.review-list ul li .right h4 .gig-rating {
  display: flex;
  align-items: center;
  margin-left: 10px;
  color: #ffbf00;
}
.review-list ul li .right h4 .gig-rating svg {
  margin: 0 4px 0 0px;
}
.country .country-flag {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
  margin: 0 7px 0 0px;
  border: 1px solid #fff;
  border-radius: 50px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}
.country .country-name {
  color: #95979d;
  font-size: 13px;
  font-weight: 600;
}
.review-list ul li {
  padding: 0 0 30px;
  margin: 0 0 30px;
}
.review-list ul li .right {
  flex: auto;
}
.review-list ul li .review-description {
  margin: 20px 0 0;
}
.review-list ul li .review-description p {
  font-size: 14px;
  margin: 0;
}
.review-list ul li .publish {
  font-size: 13px;
  color: #95979d;
}

.review-section h4 {
  font-size: 20px;
  color: #222325;
  font-weight: 700;
}
.review-section .stars-counters tr .stars-filter.fit-button {
  padding: 6px;
  border: none;
  color: #4a73e8;
  text-align: left;
}
.review-section .fit-progressbar-bar .fit-progressbar-background {
  position: relative;
  height: 8px;
  background: #efeff0;
  -webkit-box-flex: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  background-color: #ffffff;
;
  border-radius: 999px;
}
.review-section .stars-counters tr .star-progress-bar .progress-fill {
  background-color: #ffb33e;
}
.review-section .fit-progressbar-bar .progress-fill {
  background: #2cdd9b;
  background-color: rgb(29, 191, 115);
  height: 100%;
  position: absolute;
  left: 0;
  z-index: 1;
  border-radius: 999px;
}
.review-section .fit-progressbar-bar {
  display: flex;
  align-items: center;
}
.review-section .stars-counters td {
  white-space: nowrap;
}
.review-section .stars-counters tr .progress-bar-container {
  width: 100%;
  padding: 0 10px 0 6px;
  margin: auto;
}
.ranking h6 {
  font-weight: 600;
  padding-bottom: 16px;
}
.ranking li {
  display: flex;
  justify-content: space-between;
  color: #95979d;
  padding-bottom: 8px;
}
.review-section .stars-counters td.star-num {
  color: #4a73e8;
}
.ranking li>span {
  color: #62646a;
  white-space: nowrap;
  margin-left: 12px;
}
.review-section {
  border-bottom: 1px solid #dadbdd;
  padding-bottom: 24px;
  margin-bottom: 34px;
  padding-top: 64px;
}
.review-section select, .review-section .select2-container {
  width: 188px !important;
  border-radius: 3px;
}
ul, ul li {
  list-style: none;
  margin: 0px;
}
.helpful-thumbs, .helpful-thumb {
  display: flex;
  align-items: center;
  font-weight: 700;
}
</style>