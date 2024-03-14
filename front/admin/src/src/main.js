import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import App from './App.vue'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import {createRouter, createWebHistory} from "vue-router";
import Products from "@/views/products/Products.vue";
import AddProduct from "@/views/products/AddProduct.vue";
import EditProduct from "@/views/products/EditProduct.vue";

const routes = [
    { path: '/', component: App  },
    { path: '/products', component: Products  },
    { path: '/add-product', component: AddProduct  },
    { path: '/edit-product/:id', component: EditProduct  },
];
const router = createRouter({
    history: createWebHistory(),
    routes
});


const app = createApp(App)
app.use(createPinia())
app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true
});
app.use(router)
app.mount('#app')
