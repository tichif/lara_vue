/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import VueRouter from "vue-router";
Vue.use(VueRouter);

Vue.component("pagination", require("laravel-vue-pagination"));

// import the Vue Component
import Home from "./components/HomeComponent";
import Task from "./components/TaskComponent";

// Define routes
const routes = [
    {
        path: "/",
        component: Home
    },
    {
        path: "/tasks",
        component: Task
    }
];

// Instantiate the routes
const router = new VueRouter({ routes });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router: router
});
