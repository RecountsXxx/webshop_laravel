import { createApp } from 'vue';
import './style.css';
import 'flowbite';
import App from './App.vue';
import {createRouter, createWebHistory} from "vue-router";
import Notifications from '@kyvg/vue3-notification'
import Home from "@/pages/HomePage.vue";
import ShopPage from "@/pages/ShopPage.vue";
import ProductDetails from "@/components/product/ProductDetails.vue";
import LoginPage from "@/pages/auth/LoginPage.vue";
import RegisterPage from "@/pages/auth/RegisterPage.vue";
import ContactPage from "@/pages/ContactPage.vue";
import ShoppingCartPage from "@/pages/ShoppingCartPage.vue";
import WishlistPage from "@/pages/WishlistPage.vue";
import AccountPage from "@/pages/AccountPage.vue";
import CategoryList from "@/pages/lists/CategoryList.vue";
import VendorList from "@/pages/lists/VendorList.vue";
import BrandList from "@/pages/lists/BrandList.vue";
import BlogPage from "@/pages/blog/BlogPage.vue";
import BlogDetails from "@/pages/blog/BlogDetails.vue";

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: LoginPage },
    { path: '/register', component: RegisterPage },
    { path: '/shop', component: ShopPage },
    { path: '/contact', component: ContactPage },
    { path: '/wishlist', component: WishlistPage },
    { path: '/shopping-cart', component: ShoppingCartPage },
    {path: '/product/:id', component: ProductDetails},
    {path: '/categories', component: CategoryList},
    {path: '/vendors', component: VendorList},
    {path: '/brands', component: BrandList},
    {path: '/shop/category/:category', component: ShopPage},
    {path: '/shop/vendor/:vendor', component: ShopPage},
    {path: '/shop/brand/:brand', component: ShopPage},
    {path: '/blog', component: BlogPage},
    {path: '/blog/:id', component: BlogDetails},
    { path: '/account', component: AccountPage, meta: { requiresAuth: true } },
];
const router = createRouter({
    history: createWebHistory(),
    routes
});
router.beforeEach((to, from, next) => {
    document.title = 'Male Fashion';
    next();
});
router.beforeEach((to, from, next) => {
    const user = localStorage.getItem('user');

    if (to.meta.requiresAuth && !user) {
        next('/login');
    } else {
        next();
    }
});

const app = createApp(App)
app.use(router)
app.use(Notifications)
app.mount('#app')

