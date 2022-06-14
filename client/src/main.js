import {createApp} from 'vue';
import Vuelidate from '@vuelidate/core';
import App from './App.vue';
import router from './router';
import store from './store';
import axios from 'axios';
import VueAxios from 'vue-axios';
import PrimeVue from 'primevue/config';

const app = createApp(App);

app.use(
    VueAxios,
    axios,
    Vuelidate,
    router,
    store,
    PrimeVue
)

app.mount('#app')
