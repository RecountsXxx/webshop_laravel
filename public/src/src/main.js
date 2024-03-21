import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import {createRouter, createWebHistory} from "vue-router";
import Notifications from '@kyvg/vue3-notification'

import Login from "@/pages/Auth/Login.vue";
import Register from "@/pages/Auth/Register.vue";
import Account from "@/pages/Account/Account.vue";
import Bookmarks from "@/pages/Bookmark/Bookmarks.vue";
import ShoppingCart from "@/pages/ShoppingCart/ShoppingCart.vue";
import ProductDetails from "@/components/ProductDetails.vue";
import Category from "@/pages/Category/Category.vue";
import Vendor from "@/pages/Vendor/Vendor.vue";
import Brand from "@/pages/Brand/Brand.vue";
import BrandList from "@/pages/Brand/BrandList.vue";
import CategoryList from "@/pages/Category/CategoryList.vue";
import VendorList from "@/pages/Vendor/VendorList.vue";
import Home from "@/pages/Home/Home.vue";

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/bookmarks', component: Bookmarks },
    { path: '/shopping-cart', component: ShoppingCart },
    {path: '/product/:id', component: ProductDetails},
    {path: '/category/:id', component: Category},
    {path: '/vendor/:id', component: Vendor},
    {path: '/brand/:id', component: Brand},
    {path: '/brands-list', component: BrandList},
    {path: '/categories-list', component: CategoryList},
    {path: '/vendors-list', component: VendorList},
    { path: '/account', component: Account, meta: { requiresAuth: true } },
];
const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !localStorage.getItem('user')) {
        next('/login');
    } else {
        next();
    }
});

const app = createApp(App)

app.use(router)
app.use(Notifications)
app.mount('#app')

