import { createWebHistory, createRouter } from 'vue-router';

import Login from './Components/Login.vue';
import Index from './Components/Index.vue';
import Profile from "./Components/Profile.vue";
import Messenger from "./Components/Messenger.vue";

export default createRouter({
   history: createWebHistory(),
   routes: [
       {
           path: '/login',
           name: 'login',
           component: Login,
       },
       {
           path: '/',
           name: 'main',
           component: Index
       },
       {
           path: "/profile",
           name : 'profile',
           component: Profile
       },
       {
           path: '/messenger',
           name: 'messenger',
           component: Messenger
       }
   ],
});
