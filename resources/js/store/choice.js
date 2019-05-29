import api from '../api';
export default{
    state: {
        choicelists: [],  // 学校列表
        professionlists:[],//专业列表
        branchlists:[],//一级学科列表
        saveCateMsg: '',
    },
    mutations: {
        // 注意，这里可以设置 state 属性，但是不能异步调用，异步操作写到 actions 中
        SETCHOICELISTS(state, lists) {
            state.choicelists = lists;
        },
        SETPROFESSLISTS(state, lists) {
            state.professionlists = lists;
        },
        SETBRANCHLISTS(state, lists) {
            state.branchlists = lists;
        },
        // 提交门类数据
        SUBMIT_CATE_HANDLE(state, params) {
            api.saveCateHandle(params).then(function (res) {

            })
        }


    },
    actions: {
        getCollegeList({commit}) {
            api.getCollegeList().then(function(res) {
                commit('SETCHOICELISTS', res.data);
            });
        },
        getProfessList({commit}) {
            api.getProfessList().then(function(res) {
                commit('SETPROFESSLISTS', res.data);
            });
        },
        getBranchList({commit}) {
            api.getBranchList().then(function(res) {
                commit('SETBRANCHLISTS', res.data);
            });
        },
        // 保存门类数据
        saveCateHandle({commit}) {
            api.saveCateHandle({ id: 1, pp: 'bb' }).then(function (res) {
                commit('SUBMIT_CATE_HANDLE', res.data);
            })
        }
    }
}