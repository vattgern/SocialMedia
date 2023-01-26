import { createWebHistory, createRouter } from 'vue-router';

import Login from './Components/Login.vue';
import Index from './Components/Index.vue';
import Profile from "./Components/Profile.vue";
import Messenger from "./Components/Messenger.vue";
import Chat from './Components/Chat.vue';
import Friends from './Components/Friends.vue';
import ProfileEdit from "./Components/ProfileEdit.vue";
import User from './Components/User.vue';
import Category from './Components/Category.vue';

export default createRouter({
   history: createWebHistory(),
   routes: [
       {
           path: '/',
           name: 'login',
           component: Login,
       },
       {
           path: '/index',
           name: 'main',
           component: Index
       },
       {
           path: "/profile",
           name : 'profile',
           component: Profile
       },
       {
           path: "/messenger",
           name: "messenger",
           component: Messenger,
       },
       {
           path: "/chat/:id",
           name: "chat",
           component: Chat,
       },
       {
           path: "/friends",
           name: "friends",
           component: Friends,
       },
       {
           path: '/profile/edit',
           name: 'profileEdit',
           component: ProfileEdit
       },
       {
           path: '/profile/:id',
           name: 'anotherUser',
           component: User
       },
       {
           path: '/category',
           name: 'category',
           component: Category,
       }
   ],
});
