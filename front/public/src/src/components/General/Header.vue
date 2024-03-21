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
                <router-link to="/login"><label href="#">Sign in</label></router-link>

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
              <li class="active"><router-link to="/">Home</router-link></li>
              <li><router-link to="/shop">Shop</router-link></li>
              <li><a href="#">Pages</a>
                <ul class="dropdown">
                  <li><router-link to="/about">About Us</router-link></li>
                  <li><router-link to="/shop-details">Shop Details</router-link></li>
                  <li><router-link to="/shopping-cart">Shopping Cart</router-link></li>
                  <li><router-link to="/checkout">Check Out</router-link></li>
                  <li><router-link to="/blog-details">Blog Details</router-link></li>
                </ul>
              </li>
              <li><router-link to="/blog">Blog</router-link></li>
              <li><router-link to="/contact">Contacts</router-link></li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="header__nav__option">
            <a href="#" class="search-switch"><img src="../../assets/img/icon/search.png" alt=""></a>
            <a href="#"><img src="../../assets/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="../../assets/img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
          </div>
        </div>
      </div>
      <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
  </header>
</template>

<script>
export default {
  name:'headerComponent'
}
</script>

<style scoped>
/* Стили компонента (если необходимо) */
</style>
