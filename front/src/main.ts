import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import './assets/tailwind.css';
import axios from 'axios';

axios.defaults.baseURL = 'http://192.168.199.1/api/v1';
axios.defaults.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;

createApp(App).use(store).use(router).mount('#app')
