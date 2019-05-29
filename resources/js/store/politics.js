import api from '../api';
export default{
    state: {
        lists: [],  // 列表
    },
    mutations: {
        // 注意，这里可以设置 state 属性，但是不能异步调用，异步操作写到 actions 中
        SETLISTS(state, lists) {
            state.lists = lists;
        }
    },
    actions: {
        getSectionList({commit}) {
            api.getSectionList().then(function(res) {
                commit('SETLISTS', res.data);
            });
        }
    }
}