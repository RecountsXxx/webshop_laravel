<template>
  <header class="header">
    <div class="header__top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-7">
            <div class="header__top__left">
              <p>Free shipping, 30-day return or refund guarantee.</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-5">
            <div class="header__top__right">
              <div class="header__top__links">
                <router-link v-if="inAuth" to="/account"><a href="#">Account</a></router-link>
                <a v-if="inAuth" @click="loggout" href="#">Sign out</a>
                <router-link v-else to="/login"><a href="#">Sign in</a></router-link>
                <router-link to="/account"><a href="#">Become a seller</a></router-link>
                <a href="#">FAQs</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <div class="header__logo">
            <router-link to="/"><img src="../../assets/img/logo.png" alt=""></router-link>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <nav class="header__menu mobile-menu">
            <ul>
              <li><router-link to="/">Home</router-link></li>
              <li><router-link to="/shop">Shop</router-link></li>
              <li><router-link to="/blog">Blog</router-link></li>
              <li><router-link to="/contact">Contacts</router-link></li>
              <li>
                <div id="dropdownDefaultButton" class="flex flex-row" data-dropdown-toggle="dropdown">
                 <label style="font-size: 1.15rem;" class="font-medium">Pages</label>
                  <svg class="w-2.5 h-2.5 ms-2 mt-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
                </div>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-96 dark:bg-gray-700">
                  <ul class="flex justify-center py-2 p-3 text-sm text-center text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li><router-link class="text-center" to="/categories">Categories</router-link></li>
                    <li><router-link to="/vendors">Vendors</router-link></li>
                    <li><router-link to="/brands">Brands</router-link></li>
                  </ul>
                </div>
              </li>

            </ul>
          </nav>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="header__nav__option">
            <a href="#" class="search-switch"><img src="../../assets/img/icon/search.png" alt=""></a>
            <router-link to="/wishlist"><img src="../../assets/img/icon/heart.png" alt=""></router-link>
            <router-link to="/shopping-cart"><img class="mt-1" src="../../assets/img/icon/cart.png" alt=""></router-link>
          </div>
        </div>
      </div>
      <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
  </header>
</template>

<script>
import UserService from "@/services/user/UserService";
import io from 'socket.io-client';
import {useNotification} from "@kyvg/vue3-notification";
export default {
  name:'headerComponent',
  data(){
    return{
      inAuth:  UserService.getUser() != null ? true : false
    }
  },
  methods: {
   async loggout(){
      await UserService.loggout();
    }
  },
  mounted() {
   let notification = useNotification()
    this.socket = io('http://localhost');
    this.socket.on('socket.message.admin', (messageData) => {
      notification.notify({
        title: 'From site: ' + messageData,
        type:'info'
      });
    });
  },

}
</script>
