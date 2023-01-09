//  import Vue from 'vue'
import { createApp } from 'vue';
import './bootstrap';
import Dashboard from './Pages/Dashboard';
// window.Vue = require('vue').default;
// Vue.component('dashboard', require('./Pages/Dashboard.vue').default);

let app = createApp(Dashboard);
app.mount('#app')
//  const App = new Vue({
//     el: '#app',
//     components:{
//         Dashboard
//     }
// });


import Alpine from 'alpinejs';


window.Alpine = Alpine;

Alpine.start();
