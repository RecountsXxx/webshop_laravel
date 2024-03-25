<template>
  <section class="breadcrumb-option">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb__text">
            <h4>Shopping Cart</h4>
            <div class="breadcrumb__links">
              <router-link to="/"><span>Home</span></router-link>
              <router-link to="/shop"><span>Shop</span></router-link>
              <span>Shopping Cart</span>
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
            <h5 v-if="other_vendors" class="text-1xl mb-5"> Please note that you have different products from different sellers, there will be different parcels</h5>
            <table v-if="products.length > 0">
              <thead>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
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
                <td class="quantity__item">
                  <div class="quantity">
                    <div class="pro-qty-2">
                      <input type="number" v-model="product.count">
                    </div>
                  </div>
                </td>
                <td class="cart__price">$ {{parseInt(product.count) * parseInt(product.price)}}</td>
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
                <a @click="updateProducts" href="#"><i class="fa fa-spinner"></i> Update cart</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cart__total">
            <h6>Cart total</h6>
            <ul>
              <li>Total <span>$ {{this.totalPrice}}</span></li>
              <hr/>
              <form @submit.prevent="submitOrder" class="">
                <div class="mb-4">
                  <h6>Full name</h6>
                  <input v-model="formData.full_name" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="full_name" type="text" placeholder="Enter your full name" required>
                </div>
                <div class="mb-4">
                  <h6>Email</h6>
                  <input v-model="formData.email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-4">
                  <h6>Select city</h6>
                  <select v-model="selectedCity" @change="fetchWarehouses" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="" disabled>Select city</option>
                    <option v-for="city in cities" :key="city.Ref" :value="city">{{ city.Description }}</option>
                  </select>
                </div>
                <div class="mb-4">
                  <h6>Select Warehouse</h6>
                  <select v-model="selectedWarehouse" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="" disabled>Select warehouse</option>
                    <option v-for="warehouse in warehouses" :key="warehouse.Ref" :value="warehouse">{{ warehouse.Description }}</option>
                  </select>
                </div>
                <div class="mb-4">
                  <h6>Payment type</h6>
                  <select v-model="formData.type_payment" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="" disabled>Select payment type</option>
                    <option value="card">Payment by card</option>
                    <option value="cash_on_delivery">Cash on delivery</option>
                  </select>
                </div>
                <div class="flex items-center justify-between">
                  <label class="primary-btn w-100" type="submit">Proceed to checkout</label>
                </div>
              </form>
            </ul>
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
import NovaPoshtaService from "@/services/delivery/NovaPoshtaService";
import ProductService from "@/services/product/ProductService";

export default {
  name: 'ShoppingCartComponent',
  data() {
    return {
      products:[],
      formData: {
        vendor_id: '',
        product_id: '',
        type_payment: '',
        full_name: '',
        address: '',
        email: ''
      },
      other_vendors:false,
      cities: [],
      warehouses: [],
      selectedCity: '',
      selectedWarehouse: '',
      loading: true,
      totalPrice: 0,
      otherVendors:false,
    }
  },
  methods: {
    async fetchCities() {
      const response = await NovaPoshtaService.getCities();
      this.cities = response.data;
    },
    async fetchWarehouses() {
      if (this.selectedCity) {
        const response = await NovaPoshtaService.getWarehouses(this.selectedCity.Ref);
        this.warehouses = response.data;
      }
    },
    removeProduct(productId) {
      this.products = this.products.filter(product => product.id !== productId);
      ProductService.deleteFromCart(productId);
      this.check_other_vendors();
    },
    async submitOrder() {
      this.products.forEach((product) => {
        this.formData.vendor_id = product.vendor_id;
        this.formData.product_id = product.id;
        this.formData.count = product.count;
        this.formData.address = this.selectedCity.Description + ' | ' + this.selectedWarehouse.Description;
        ProductService.sumbitOrder(this.formData);
        console.log(product);
      });
    },
    check_other_vendors() {
      if (this.products.length > 0) {
        const vendor_id = this.products[0].vendor_id;
        this.other_vendors = this.products.some(product => product.vendor_id !== vendor_id);
      } else {
        this.other_vendors = true;
      }
    },
    async getProducts() {
      this.products = await ProductService.getAllCart();
      this.totalPrice = this.products.reduce((accumulator, item) => accumulator + item.price * item.count, 0);
    },
    updateProducts() {
      this.products.forEach((item)=>{
        localStorage.removeItem('product_' + item.id);
        localStorage.setItem('product_' + item.id, JSON.stringify({
          id: item.id,
          title: item.title,
          price: item.price,
          img: item.img,
          vendor_id: item.vendor_id,
          count: item.count
        }));
      });
      this.getProducts();
    },
  },
  async created(){
    await this.getProducts();
    this.loading = false;
  },
  mounted() {
    this.fetchCities();
    this.check_other_vendors();
  }
}
</script>

<style scoped>

</style>