import Vue from 'vue';
import Vuex from 'vuex';
import news from './news';
import politics from './politics';
import choice from './choice';

Vue.use(Vuex);
export default new Vuex.Store({
    // 可以设置多个模块
    modules: {
        news,
        politics,
        choice,
        render: h => h(App)
    }
});