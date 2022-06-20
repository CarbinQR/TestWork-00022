import {createApp} from 'vue';
import Vuelidate from '@vuelidate/core';
import App from './App.vue';
import router from './router';
import store from './store';
import axios from 'axios';
import VueAxios from 'vue-axios';

//import ui library
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
//end import ui library
const app = createApp(App);

app.use(
    VueAxios,
    axios,
    Vuelidate
)

app.use(router)
    .use(store)
    .use(VueSweetalert2)
    .mount('#app')
