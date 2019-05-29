require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);
import store from './store/'; // vuex 数据存储所需对象
import routes from './routes';    // 路由配置文件
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import moment from 'moment';

Vue.prototype.$moment = moment;

Vue.use(ElementUI);

// 实例化路由
const router = new VueRouter({
    routes
})

var vm = new Vue({
    store,
    router
}).$mount('#app');