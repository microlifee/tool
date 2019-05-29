<template>
    <div id="new-sort">
        <div class="bs-docs-header" id="content">
            <h1>普通高校研究生培养单位（共573所）</h1>
            <p>1.学科门类； 2.一级学科排名； 3.优势专业（5★+ | 5★ | 5★- | 4★）</p>
        </div>
        <div class="main el-main">
            <el-row>
                <el-col :span="24">
                    <el-col :span="11">
                        <el-select class="el-select" v-model="value" filterable placeholder="请选择" @change="pickerHandle">
                             <el-option
                            v-for="item in collegelists"
                            :key="item.id"
                            :label="item.title"
                            :value="item.id">
                            </el-option>
                        </el-select>
                    <div class="radio-group">
                        <el-radio-group v-model="radio">
                            <el-radio :label="1">学科门类</el-radio>
                            <el-radio :label="2">一级学科排名</el-radio>
                            <el-radio :label="3">5★+专业</el-radio>
                            <el-radio :label="4">5★专业</el-radio>
                            <el-radio :label="5">5★-专业</el-radio>
                            <el-radio :label="6">4★专业</el-radio>
                        </el-radio-group>
                    </div>
                    <div class="input-text">
                        <el-input
                            type="textarea"
                            :autosize="{ minRows: 10}"
                            placeholder="请输入内容"
                            @keyup.native="splitPointHandle"
                            v-model="textarea">
                        </el-input>
                    </div>
                    <div class="button">
                        <el-button v-if="title && radio && textarea" type="success" @click="action">开始转换</el-button>
                        <el-button v-else type="success" disabled>院校或转换数据为空</el-button>
                    </div>
                    </el-col>
                <el-col :span="2"></el-col>

                <el-col :span="11">
                    <div class="right" :style="{'display':display}">
                        <div class="table">
                            <el-table :data="tableData" style="width: 100%" :row-class-name="tableRowClassName">// :row-class-name="tableRowClassName"
                                <el-table-column prop="course" label="学科" width="180"></el-table-column>
                                <el-table-column prop="rank" label="排名" width="180"></el-table-column>
                                <el-table-column prop="number" label="开设院校数"></el-table-column>
                                <el-table-column prop="check" label="数据校对"></el-table-column>
                            </el-table>
                        </div>
                        <div class="button-sub">
                            <el-button type="success" @click="sublimt">数据校验无误，现在提交~</el-button>
                        </div>
                    </div>
                </el-col>
            </el-col>
            </el-row>

            <el-dialog
                title="提示"
                :visible.sync="dialogVisible"
                width="30%"
                :before-close="handleClose">
                <p>选择院校：<b>{{ univercityTitle }}</b></p>
                <p>共转换成 <b>{{ tableData.length }}</b> 条数据~</p>
                <p>数据类型： <b>{{ pickedText }}</b></p>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisible = false">取 消</el-button>
                    <el-button type="primary" @click="confirm">确 定</el-button>
                </span>
            </el-dialog>

            <el-dialog
                title="成功添加的数据"
                :visible.sync="dialogVisibleSuccess"
                width="30%"
                :before-close="handleClose">
                <div>
                    <el-table :data="tableData" stripe style="width: 100%">
                        <el-table-column prop="id" label="#" width="100"></el-table-column>
                        <el-table-column prop="course" label="学科" width="180"></el-table-column>
                        <el-table-column prop="rank" label="排名" width="150"></el-table-column>
                        <el-table-column prop="number" label="开设院校数" width="100"></el-table-column>
                    </el-table>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisibleSuccess = false">取 消</el-button>
                    <el-button type="primary" @click="dialogVisibleSuccess = false">确 定</el-button>
                </span>
            </el-dialog>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
    export default {
        name: "newSort",
        data() {
            return {
            isIn:[],
            display:'none',
            title: 5 ,
            value:'',
            radio: 0,
            Items: [],
            radiotext: [],
            dialogVisible: false,
            dialogVisibleSuccess:false,
            pickedText: '',
            univercityTitle:'',
            universityID: '',
            isShow:'false',
            textarea: '哲学7/154、理论经济学14/115、应用经济学9/244、法学3/188、政治学5/104、社会学5/88、马克思主义理论3/328、教育学13/140、心理学16/97',
            tableData: [],
            all:[],
            subject:[{id :1, name:'哲学'},
            {id :2, name:'经济学'},
            {id :3, name:'法学'},
            {id :4, name:'教育学'},
            {id :5, name:'文学'},
            {id :6, name:'历史学'},
            {id :7, name:'理学'},
            {id :8, name:'工学'},
            {id :9, name:'农学'},
            {id :10, name:'医学'},
            {id :11, name:'军事学'},
            {id :12, name:'管理学'},
            {id :13, name:'艺术学'}]
        }
        },
        computed: mapState({
            collegelists: state => state.choice.choicelists,
            professionlists: state => state.choice.professionlists,
            branchlists: state => state.choice.branchlists,
        }),
        created() {
            this.getCollegeList();
            this.getProfessList();
            this.getBranchList();
            this.textarea = localStorage.getItem('LOCAL_SAVE_POINTS') ? localStorage.getItem('LOCAL_SAVE_POINTS') : '';
            this.value = localStorage.getItem('LOCAL_SAVE_TITLE') ? localStorage.getItem('LOCAL_SAVE_TITLE') : '';
            this.univercityTitle = localStorage.getItem('LOCAL_SAVE_TITLE') ? localStorage.getItem('LOCAL_SAVE_TITLE') : '';
            if (this.textarea) {
                let arr = this.textarea.split("、");
                var regex = /[\u2E80-\u2EFF\u2F00-\u2FDF\u3000-\u303F\u31C0-\u31EF\u3200-\u32FF\u3300-\u33FF\u3400-\u4DBF\u4DC0-\u4DFF\u4E00-\u9FBF\uF900-\uFAFF\uFE30-\uFE4F\uFF00-\uFFEF]+/g;
                var universityItems = [];
                arr.forEach((item, index) => {
                    let match_branch = item.match(regex)//学科
                    let branch_name = match_branch[0]
                     // 匹配排名和开设该学科的院校数量
                    length = branch_name.length
                    let sort_total_text = item.substring(length, item.length)
                    let sort_total = sort_total_text.split("/");
                    let sort = sort_total[0]//排名
                    let total = sort_total[1]//数量
                    universityItems.push({
                        id: index + 1,
                        course: branch_name,//学科
                        rank: sort,//排名
                        number:total,//院校数
                        check:item//数据校对
                    });
                })
                this.tableData = universityItems;
            }
        },
        watch: {
            radio(newValue, oldValue) {
                let radiotext=[];
                let tempCatalog = this.Items['radiotext'];
                let pickedText = '';
                if (newValue != oldValue) {
                    switch (newValue) {
                        case 1: tempCatalog = this.Items['radiotext']; pickedText = '学科门类 '; break;
                        case 2: tempCatalog = this.Items['branch']; pickedText = '一级学科排名'; break;
                        case 3: tempCatalog = this.Items['profession']; pickedText = '5★+专业'; break;
                        case 4: tempCatalog = this.Items['profession']; pickedText = '5★专业'; break;
                        case 5: tempCatalog = this.Items['profession']; pickedText = '5★-专业'; break;
                        case 6: tempCatalog = this.Items['profession']; pickedText = '4★专业'; break;
                    }
                    this.radiotext = tempCatalog;
                    this.pickedText = pickedText;
                }
            }
        },
        methods: {
            ...mapActions([
                'getCollegeList',
                'getProfessList',
                'getBranchList'
            ]),

            pickerHandle(universityID){
                const currentUniversity = this.collegelists.find(item => {
                    return item.id == universityID;
                })
                console.log('---sss', currentUniversity);
                this.univercityTitle = currentUniversity.title;
                this.universityID = currentUniversity.id;
                localStorage.setItem('LOCAL_SAVE_TITLE', this.univercityTitle);
            },
            handleClose(done) {
                this.$confirm('确认关闭？')
                .then(_ => {
                    done();
                })
                .catch(_ => {});
            },
            splitPointHandle() {
                let areatext = this.textarea;
                localStorage.setItem('LOCAL_SAVE_POINTS', areatext);
                this.handle();
            },
            action(){
                let radiotext=this.pickedText;
                this.handle();
                this.dialogVisible=true;
            },
            confirm(){
                this.dialogVisible = false;
                this.display='block';
            },

            handle(){
                let areatext = this.textarea;
                let arr = areatext.split("、");
                var regex = /[\u2E80-\u2EFF\u2F00-\u2FDF\u3000-\u303F\u31C0-\u31EF\u3200-\u32FF\u3300-\u33FF\u3400-\u4DBF\u4DC0-\u4DFF\u4E00-\u9FBF\uF900-\uFAFF\uFE30-\uFE4F\uFF00-\uFFEF]+/g;
                var universityItems = [];
                arr.forEach((item, index) => {
                    let match_branch = item.match(regex)//学科
                    let branch_name = match_branch[0]
                     // 匹配排名和开设该学科的院校数量
                    length = branch_name.length
                    let sort_total_text = item.substring(length, item.length)
                    let sort_total = sort_total_text.split("/");
                    let sort = sort_total[0]//排名
                    let total = sort_total[1]//数量
                    this.pan=arr.indexOf(branch_name.trim());//判断格式是否规范
                    if(this.pan != -1){
                        if(this.isIn.indexOf(index) == -1){
                            this.isIn.push(index);
                        }
                    }
                    universityItems.push({
                        id: index + 1,
                        course: branch_name,//学科
                        rank: sort,//排名
                        number:total,//院校数
                        check:item,//数据校对
                    });
                })
                this.tableData = universityItems;
                let tabledata=this.tableData;
                let profession=this.professionlists;
                let branch=this.branchlists;
                let subject=this.subject;
                if(this.radio == 1){
                    let subject_items = [];
                    subject.forEach(item => {
                        subject_items.push(item.name.trim());
                    })
                    // 判断数据是否正确
                    let newData = [];
                    tabledata.forEach((item, index) => {
                        if ($.inArray(item.course.trim(), subject_items) >= 0 
                        && parseInt(item.number) > 0 
                        && parseInt(item.rank) > 0 ) {
                            item = { ...item, is_right: true };
                        }
                        newData.push(item);
                    });
                    this.tableData = newData;
                }
                else if (this.radio == 2) {
                    let branch_items = [];
                    branch.forEach(item => {
                        branch_items.push(item.name.trim());
                    })
                    // 判断数据是否正确
                    let newData = [];
                    tabledata.forEach((item, index) => {
                        if ($.inArray(item.course.trim(), branch_items) >= 0 
                        && parseInt(item.number) > 0 
                        && parseInt(item.rank) > 0 ) {
                            item = { ...item, is_right: true };
                        }
                        newData.push(item);
                    });
                    this.tableData = newData;
                }
                else{
                    let profession_items = [];
                    profession.forEach(item => {
                        profession_items.push(item.name.trim());
                    })
                    // 判断数据是否正确
                    let newData = [];
                    tabledata.forEach((item, index) => {
                        if ($.inArray(item.course.trim(), profession_items) >= 0 
                        && parseInt(item.number) > 0 
                        && parseInt(item.rank) > 0 ) {
                            item = { ...item, is_right: true };
                        }
                        newData.push(item);
                    });
                    this.tableData = newData;
                }
            },
             tableRowClassName({row, rowIndex}) {
                if(!row.is_right){
                   return 'danger' ;
                }
            },
            sublimt(){
                this.dialogVisibleSuccess = true;
                const params = {
                    univercityID: this.universityID,
                    type: this.radio,
                    items: this.tableData
                };
                this.$store.commit('SUBMIT_CATE_HANDLE', params);
            }
        }
    }
</script>

<style>
    .el-select{
        width: 100%;
    }
    .radio-group,.button{
        margin-top: 30px;
    }
    .right{padding-left: 40px;}
    .none{padding-left: 40px;display: none;}
    .el-table .danger{color: brown !important;} 
</style>