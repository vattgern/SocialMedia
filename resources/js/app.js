require('./bootstrap');
import { createApp } from 'vue';
import store from './store';
import router from './router';
import api from './api';
import Main from './Components/layout/Main.vue';

createApp(Main)
    .use(router)
    .use(store)
    .mount('#app');
