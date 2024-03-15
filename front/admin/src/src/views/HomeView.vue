<template>
  <main class="mt-2 ms-2 d-flex flex-column gap-3">
    <div class="d-flex flex-wrap gap-5">
      <div class="card d-flex flex-row justify-content-center align-items-center" style="width: 27rem; height: 200px; background: #2ca02c;">
        <img src="https://img.icons8.com/ios/150/message-squared.png" width="150px" height="150px" alt="...">
        <div class="card-body">
          <h5 class="card-title">Products count: {{products_count}}</h5>
          <p class="card-text">You can see products, delete products and edit products</p>
          <router-link to="/products" class="btn btn-primary stretched-link w-100">Show products</router-link>
        </div>
      </div>

      <div class="card d-flex flex-row justify-content-center align-items-center" style="width: 27rem; height: 200px; background: #3951d0;">
        <img src="https://img.icons8.com/ios-glyphs/240/group.png" width="150px" height="150px" alt="...">
        <div class="card-body">
          <h5 class="card-title">Users count: {{users_count}}</h5>
          <p class="card-text">You can see users, delete users and edit users</p>
          <router-link to="/users" class="btn btn-primary stretched-link w-100">Show users</router-link>
        </div>
      </div>

      <div class="card d-flex flex-row justify-content-center align-items-center" style="width: 27rem; height: 200px; background: #ae76e8;">
        <img src="https://img.icons8.com/ios-glyphs/240/categorize.png" width="150px" height="150px" alt="...">
        <div class="card-body">
          <h5 class="card-title">Categories count: {{category_count}}</h5>
          <p class="card-text">You can see categories,delete categories and edit categories</p>
          <router-link to="/categories" class="btn btn-primary stretched-link w-100">Show categories</router-link>
        </div>
      </div>

      <div class="card d-flex flex-row justify-content-center align-items-center" style="width: 27rem; height: 200px; background: #c54575;">
        <img src="https://img.icons8.com/ios/250/administrator-male--v1.png" width="150px" height="150px" alt="...">
        <div class="card-body">
          <h5 class="card-title">Admins count: {{admins_count}}</h5>
          <p class="card-text">You can see admins, delete admins and edit admins</p>
          <router-link to="/admins" class="btn btn-primary stretched-link w-100">Show admins</router-link>
        </div>
      </div>

      <div class="card d-flex flex-row justify-content-center align-items-center" style="width: 27rem; height: 200px; background: #bb9924;">
        <img src="https://img.icons8.com/ios/250/post-office.png" width="150px" height="150px" alt="...">
        <div class="card-body">
          <h5 class="card-title">Vendors count: {{vendors_count}}</h5>
          <p class="card-text">You can see vendors, delete vendors and edit vendors</p>
          <router-link to="/vendors" class="btn btn-primary stretched-link w-100">Show vendors</router-link>
        </div>
      </div>

      <div class="card d-flex flex-row justify-content-center align-items-center" style="width: 27rem; height: 200px; background: #10d4da;">
        <img src="https://img.icons8.com/ios/250/comments--v1.png" width="150px" height="150px" alt="...">
        <div class="card-body">
          <h5 class="card-title">Brands count: {{brands_count}}</h5>
          <p class="card-text">You can see brands, delete brands and edit brands</p>
          <router-link to="/brands" class="btn btn-primary stretched-link w-100">Show brands</router-link>
        </div>
      </div>

      <div class="card d-flex flex-row justify-content-center align-items-center" style="width: 27rem; height: 200px; background: #a5afaf;">
        <img src="https://img.icons8.com/ios/250/comments--v1.png" width="150px" height="150px" alt="...">
        <div class="card-body">
          <h5 class="card-title">Orders count: {{orders_count}}</h5>
          <p class="card-text">You can see orders, delete orders</p>
          <router-link to="/brands" class="btn btn-primary stretched-link w-100">Show orders</router-link>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from "axios";
import {useToast} from "vue-toastification";

export default {
  name: 'homeView',
  data() {
    return {
      products_count:'1',
      users_count:'1',
      admins_count:'1',
      category_count:'1',
      vendors_count:'1',
      brands_count:'1',
      orders_count:'1',
    };
  },
  created() {
    this.fetchDashboard();
  },
  methods: {
    async fetchDashboard() {
      let toast = useToast();
      try {
        const response = await axios.get('http://localhost/api/admin/dashboard');
        console.log(response.data.data[0]);
        this.products_count = response.data.data[0].products;
        this.users_count = response.data.data[0].users;
        this.admins_count = response.data.data[0].admins;
        this.category_count = response.data.data[0].categories;
        this.vendors_count = response.data.data[0].vendors;
        this.brands_count = response.data.data[0].brands;
        this.orders_count = response.data.data[0].orders;
      } catch (error) {
        console.error('Error:', error.response);
        toast.info('Error!');
      }
    },
  }
}
</script>

<style scoped>

</style>