import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import {Notifications} from "@kyvg/vue3-notification";
import {createRouter, createWebHistory} from "vue-router";

import Login from "@/pages/Login.vue";
import Home from "@/pages/Home.vue";
import Register from "@/pages/Register.vue";
import Account from "@/pages/Account.vue";
import Bookmarks from "@/pages/Bookmarks.vue";
import ShoppingCart from "@/pages/ShoppingCart.vue";

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

app.use(Notifications);
app.use(router)

app.mount('#app')

