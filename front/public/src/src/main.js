import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import {createRouter, createWebHistory} from "vue-router";
import Notifications from '@kyvg/vue3-notification'

import Login from "@/pages/Auth/Login.vue";
import Home from "@/pages/Home/Home.vue";
import Register from "@/pages/Auth/Register.vue";
import Account from "@/pages/Account/Account.vue";
import Bookmarks from "@/pages/Bookmark/Bookmarks.vue";
import ShoppingCart from "@/pages/ShoppingCart/ShoppingCart.vue";

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/bookmarks', component: Bookmarks },
    { path: '/shopping-cart', component: ShoppingCart },
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

