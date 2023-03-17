
import './bootstrap';
import Home from './components/home.vue'
import Posts from './components/posts.vue'
import CreatePost from './components/createPost.vue'
import PageNotFound from './components/404.vue'
import {createApp} from 'vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import { createRouter, createWebHistory } from 'vue-router';


const routes = [
    {
        path : '/',
        component: Home
    },
    {
        path : '/posts',
        component: Posts
    },
    {
        path : '/create-post',
        component: CreatePost
    },
    {
        path: '/:catchAll(.*)*',
        name: "PageNotFound",
        component: PageNotFound,
      },
];

const router = createRouter({
    history: createWebHistory(),
    routes : routes
});

const app = createApp(App);
app.use(router)
app.mount("#app")

import 'bootstrap/dist/js/bootstrap.min.js'


