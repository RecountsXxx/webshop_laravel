import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import Notifications from '@kyvg/vue3-notification'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'


const routes = [
    { path: '/', component: App  },
];
const router = createRouter({
    history: createWebHistory(),
    routes
});


import {createRouter, createWebHistory} from "vue-router";
const app = createApp(App)
app.use(Notifications);
app.use(createPinia())
app.use(router)

app.mount('#app')
