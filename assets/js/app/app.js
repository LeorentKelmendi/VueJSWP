import Vue from 'vue';
import axios from 'axios'
import welcome from './components/welcome.vue';

window.Vue = Vue;
window.axios = require('axios');
Vue.component('welcome', welcome);

const app = new Vue({
    el: '#app',
});


