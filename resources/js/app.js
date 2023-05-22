/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { routes } from "./router/routes";
import axios from 'axios';
import Swal from 'sweetalert2';
import store from './store/index';
import Popper from "vue3-popper";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

// axios.defaults.withCredentials = true
// axios.defaults.baseURL = 'http://localhost:8020/api/'
// const token = localStorage.getItem('token')
// if (token) {
//     axios.defaults.headers.common['Authorization'] = token
// }

const router = createRouter({
    routes,
    history: createWebHistory(),
    scrollBehavior(to, from, savedPosition) {
        // Always scroll to top
        return { top: 0 }
    },
});

// middleware
router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return;
        }
        next("/login");
    }
    else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.guest)) {
        if (store.getters.isLoggedIn) {
            console.log("inner if");
            next("/movies");
            return;
        }
        next();
    }
    else {
        next();
    }
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Swal = Swal;
  window.Toast = Toast;
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

// const app = createApp({});
const app = createApp({});
app.use(router, axios, store);

app.component("Popper", Popper);
app.component("Datepicker", Datepicker);

// app.mount('#app');
window.vm = app.mount("#app");
