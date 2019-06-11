import api from '../api';
export default{
    state: {
        lists: [],  // 列表,
        newTitleResult: null
    },
    mutations: {
        // 注意，这里可以设置 state 属性，但是不能异步调用，异步操作写到 actions 中
        SETLISTS(state, lists) {
            state.lists = lists;
        },
        // 设置题目
        setPolitcsTitle(state, item) {
            state.newTitleResult = item;
        }
    },
    actions: {
        getSectionList({commit}) {
            api.getSectionList().then(function(res) {
                commit('SETLISTS', res.data);
            });
        },
        savePolitcsHandle({commit}, params) {
            let promise = new Promise(function(resolve, reject) {
                api.savePolitcsHandle(params).then(res => {
                    commit('setPolitcsTitle', res);
                    resolve(res);
                }).catch(error => {
                    reject(error);
                });
            });
            return promise;
        }
    }
}