import { createWebHistory, createRouter } from "vue-router";

import Login from "./Components/Login.vue";
import Index from "./Components/Index.vue";
import Profile from "./Components/Profile.vue";
import Messenger from "./Components/Messenger.vue";
import Chat from "./Components/Chat.vue";
import Friends from "./Components/Friends.vue";
import ProfileEdit from "./Components/ProfileEdit.vue";

export default createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            name: "login",
            component: Login,
        },
        {
            path: "/index",
            name: "main",
            component: Index,
        },
        {
            path: "/profile",
            name: "profile",
            component: Profile,
        },
        {
            path: "/messenger",
            name: "messenger",
            component: Messenger,
        },
        {
            path: "/chat",
            name: "chat",
            component: Chat,
        },
        {
            path: "/friends",
            name: "friends",
            component: Friends,
        },
        {
            path: "/profileedit",
            name: "profileedit",
            component: ProfileEdit,
        },
    ],
});
