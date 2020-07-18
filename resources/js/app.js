import router from "./router";
import App from './components/App'
import store from './store/index'


require('./bootstrap');
window.Vue = require('vue');




const app = new Vue({
    el: '#app',
    router,
    store,

    components:{
        App,
    }


});
