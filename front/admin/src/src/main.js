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
import Orders from "@/views/products/orders/Orders.vue";
import JoinToVendors from "@/views/vendors/join-to-vendors/JoinToVendors.vue";
import AddVendorUser from "@/views/vendors/vendor-users/AddVendorUser.vue";
import VendorUsers from "@/views/vendors/vendor-users/VendorUsers.vue";
import EditVendorUser from "@/views/vendors/vendor-users/EditVendorUser.vue";
import Posts from "@/views/posts/Posts.vue";
import AddPost from "@/views/posts/AddPost.vue";
import EditPost from "@/views/posts/EditPost.vue";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const routes = [
    { path: '/admin/', component: HomeView  },
    { path: '/admin/dashboard', component: HomeView  },
    { path: '/admin/products', component: Products  },
    { path: '/admin/add-product', component: AddProduct  },
    { path: '/admin/edit-product/:id', component: EditProduct  },
    { path: '/admin/categories', component: Categories  },
    { path: '/admin/add-category', component: AddCategory  },
    { path: '/admin/edit-category/:id', component: EditCategory  },
    { path: '/admin/brands', component: Brands  },
    { path: '/admin/add-brand', component: AddBrand  },
    { path: '/admin/edit-brand/:id', component: EditBrand  },
    { path: '/admin/vendors', component: Vendors  },
    { path: '/admin/add-vendor', component: AddVendor  },
    { path: '/admin/edit-vendor/:id', component: EditVendor  },
    { path: '/admin/users', component: Users  },
    { path: '/admin/add-user', component: AddUser  },
    { path: '/admin/edit-user/:id', component: EditUser  },
    { path: '/admin/admins', component: Admins  },
    { path: '/admin/edit-admin/:id', component: EditAdmin  },
    { path: '/admin/add-admin', component: AddAdmin  },
    { path: '/admin/vendor-users', component: VendorUsers  },
    { path: '/admin/add-vendor-user', component: AddVendorUser  },
    { path: '/admin/edit-vendor-user/:id', component: EditVendorUser  },
    { path: '/admin/orders', component: Orders  },
    { path: '/admin/vendors-requests', component: JoinToVendors  },
    { path: '/admin/posts', component: Posts  },
    { path: '/admin/add-post', component: AddPost  },
    { path: '/admin/edit-post/:id', component: EditPost  },

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
app.component('QuillEditor', QuillEditor)
app.use(router)
app.mount('#app')

