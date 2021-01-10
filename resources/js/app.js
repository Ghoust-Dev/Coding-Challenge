
require('./bootstrap');

window.Vue = require('vue');

import router from './routes';
import App from "./App.vue"

const app = new Vue({
    el: '#app',
    components:{
        App
    },
    router
});
