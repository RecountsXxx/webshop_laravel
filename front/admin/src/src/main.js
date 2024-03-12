import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import Notifications from '@kyvg/vue3-notification'
import App from './App.vue'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import {createRouter, createWebHistory} from "vue-router";
import Products from "@/views/products/Products.vue";
import AddProduct from "@/views/products/AddProduct.vue";

const routes = [
    { path: '/', component: App  },
    { path: '/products', component: Products  },
    { path: '/add-product', component: AddProduct  },
];
const router = createRouter({
    history: createWebHistory(),
    routes
});


const app = createApp(App)
app.use(Notifications);
app.use(createPinia())
app.use(router)

app.mount('#app')
