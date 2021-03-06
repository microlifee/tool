import api from '../api';
export default{
    state: {
        recommend: [], // 推荐
        lists: [],  // 列表
        detail: {},  // 详情
        branch: [1, 2, 3, 4, 5, 6, 7, 8],
        sortItems: [], // 排名列表
    },
    mutations: {
        // 注意，这里可以设置 state 属性，但是不能异步调用，异步操作写到 actions 中
        SETRECOMMEND(state, lists) {
            state.recommend = lists;
        },
        SETLISTS(state, lists) {
            state.lists = lists;
            localStorage.setItem('UNIVERSITY_ITEMS_KEY', JSON.stringify(lists));
        },
        SETDETAIL(state, detail) {
            state.detail = detail;
        },
        // 修改branch
        setBranch(state, items) {
            state.branch = items;
        },
        setSortItems(state, items) {
            state.sortItems = items;
        }
    },
    actions: {
        getNewsDetail({commit}, id) {
            // 获取详情，并调用 mutations 设置 detail
            api.getNewsDetail(id).then(function(res) {
                commit('SETDETAIL', res.data);
                document.body.scrollTop = 0;
            });
        },
        getNewsLists({commit}) {
            api.getNewsLists().then(function(res) {
                commit('SETLISTS', res.data);
            });
        },
        // 院校相关排名
        getSortList({commit}, params) {
            api.getSortList(params).then(function(res) {
                commit('setSortItems', res.data);
            });
        }
    }
}