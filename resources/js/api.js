import axios from 'axios'
export default {
    // 获取大学列表
    getNewsLists: function () {
        return axios.get('api/choice/university')
    },
    // 获取专题列表
    getSectionList: function () {
        return axios.get('api/politics/section')
    },

    // 详情接口
    getNewsDetail: function (id) {
        return axios.get('api/news/' + id)
    },

    getCollegeList:function () {
        return axios.get('api/choice/university')
    },
    getProfessList:function(){
        return axios.get('api/choice/profession')
    },
    getBranchList:function(){
        return axios.get('api/choice/branch')
    },
    // 院校相关排名
    getSortList: function(params) {
        return axios.get(`api/university/sort/${params.universityID}/${params.sortType}`)
    },

    // 保存数据
    saveCateHandle: function (params) {
        return axios.post('api/university/sort', params)
    },

    // 政治相关
    savePolitcsHandle: function (params) {
        return axios.post('api/politics/title', params);
    }
}