import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import {createRouter, createWebHistory} from "vue-router";
import Notifications from '@kyvg/vue3-notification'
import Home from "@/pages/HomePage.vue";
import ShopPage from "@/pages/ShopPage.vue";
import ProductDetails from "@/components/ProductComponents/ProductDetails.vue";
import LoginPage from "@/pages/auth/LoginPage.vue";
import RegisterPage from "@/pages/auth/RegisterPage.vue";

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: LoginPage },
    { path: '/register', component: RegisterPage },
    { path: '/shop', component: ShopPage },
    {path: '/product/:id', component: ProductDetails},
];
const router = createRouter({
    history: createWebHistory(),
    routes
});


const app = createApp(App)

app.use(router)
app.use(Notifications)
app.mount('#app')

