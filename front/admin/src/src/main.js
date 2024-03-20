import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '@fortawesome/fontawesome-free/css/all.css';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import App from './App.vue'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import {createRouter, createWebHistory} from "vue-router";
import Products from "@/views/products/Products.vue";
import AddProduct from "@/views/products/AddProduct.vue";
import EditProduct from "@/views/products/EditProduct.vue";
import Categories from "@/views/categories/Categories.vue";
import EditCategory from "@/views/categories/EditCategory.vue";
import AddCategory from "@/views/categories/AddCategory.vue";
import Brands from "@/views/brands/Brands.vue";
import AddBrand from "@/views/brands/AddBrand.vue";
import EditBrand from "@/views/brands/EditBrand.vue";
import Vendors from "@/views/vendors/Vendors.vue";
import EditVendor from "@/views/vendors/EditVendor.vue";
import AddVendor from "@/views/vendors/AddVendor.vue";
import Admins from "@/views/admins/Admins.vue";
import AddAdmin from "@/views/admins/AddAdmin.vue";
import EditAdmin from "@/views/admins/EditAdmin.vue";
import Users from "@/views/users/Users.vue";
import AddUser from "@/views/users/AddUser.vue";
import EditUser from "@/views/users/EditUser.vue";
import HomeView from "@/views/HomeView.vue";
import Orders from "@/views/orders/Orders.vue";
import JoinToVendors from "@/views/join-to-vendors/JoinToVendors.vue";
import AddVendorUser from "@/views/vendor-users/AddVendorUser.vue";
import VendorUsers from "@/views/vendor-users/VendorUsers.vue";
import EditVendorUser from "@/views/vendor-users/EditVendorUser.vue";

const routes = [
    { path: '/', component: HomeView  },
    { path: '/dashboard', component: HomeView  },
    { path: '/products', component: Products  },
    { path: '/add-product', component: AddProduct  },
    { path: '/edit-product/:id', component: EditProduct  },
    { path: '/categories', component: Categories  },
    { path: '/add-category', component: AddCategory  },
    { path: '/edit-category/:id', component: EditCategory  },
    { path: '/brands', component: Brands  },
    { path: '/add-brand', component: AddBrand  },
    { path: '/edit-brand/:id', component: EditBrand  },
    { path: '/vendors', component: Vendors  },
    { path: '/add-vendor', component: AddVendor  },
    { path: '/edit-vendor/:id', component: EditVendor  },
    { path: '/users', component: Users  },
    { path: '/add-user', component: AddUser  },
    { path: '/edit-user/:id', component: EditUser  },
    { path: '/admins', component: Admins  },
    { path: '/edit-admin/:id', component: EditAdmin  },
    { path: '/add-admin', component: AddAdmin  },
    { path: '/vendor-users', component: VendorUsers  },
    { path: '/add-vendor-user', component: AddVendorUser  },
    { path: '/edit-vendor-user/:id', component: EditVendorUser  },
    { path: '/orders', component: Orders  },
    { path: '/vendors-requests', component: JoinToVendors  },

];
const router = createRouter({
    history: createWebHistory(),
    routes
});
const app = createApp(App)
router.beforeEach((to, from, next) => {
    document.title = 'Admin panel';
    next();
});
app.use(createPinia())
app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true
});
app.use(router)
app.mount('#app')

