<template>
    <div id="new-points">
        <div class="bs-docs-header" id="content" tabindex="-1">
            <h1>20考研政治</h1>
            <p>部分 -> 专题 -> 知识点录入</p>
        </div>
        <div class="main el-main">
            <el-row :gutter="20">
                <el-col :span="12">
                    <el-row>
                        <el-form ref="form" :model="form" label-width="80px">
                            <!-- 所属部分 -->
                            <el-form-item label="所属部分">
                                <el-select v-model="form.book_id"
                                           value-key="id"
                                           @change="changeBookHandle"
                                           style="width: 420px;"
                                           placeholder="请选择所属部分">
                                    <el-option
                                            v-for="item in lists"
                                            :label="item.title"
                                            :value="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <!-- 所属专题 -->
                            <el-form-item v-if="form.book_id" label="所属专题">
                                <el-select v-model="form.section_id"
                                           filterable
                                           @change="changeSectionHandle"
                                           style="width: 420px;"
                                           placeholder="请选择所属专题">
                                    <el-option
                                            v-for="item in sectionItems"
                                            :key="item.id"
                                            :label="item.title"
                                            :value="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <!-- 知识点 -->
                            <el-form-item label="知识点">
                                <el-input
                                        type="textarea"
                                        :autosize="{ minRows: 8, maxRows: 20}"
                                        placeholder="请输入知识点，每行限一个知识点"
                                        @keyup.native="splitPointHandle"
                                        v-model="pointItems">
                                </el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button v-if="form.book_id && form.section_id && pointItems" type="primary">开始生成表格</el-button>
                                <el-button v-else disabled>未完整写入数据！</el-button>
                            </el-form-item>
                        </el-form>

                    </el-row>
                </el-col>
                <el-col :span="12">
                    <div v-if="form.book_id && form.section_id && pointItems" class="generate-template">
                        <el-table :data="pointList" stripe style="width: 100%">
                            <el-table-column prop="id" label="#" width="50"></el-table-column>
                            <el-table-column prop="title" label="知识点标题"></el-table-column>
                            <el-table-column prop="updated_at" label="更新日期" width="180"></el-table-column>
                        </el-table>
                        <el-row style="margin-top: 30px;">
                            <el-form>
                                <el-form-item>
                                    <el-button type="primary" @click="submitHandle">数据确认无误，提交~</el-button>
                                </el-form-item>
                            </el-form>
                        </el-row>
                    </div>
                </el-col>
            </el-row>
        </div>
    </div>
</template>
<script>
    import { mapState, mapActions } from 'vuex';
    export default({
        data() {
            return {
                form: {
                    book_id: null,
                    section_id: null
                },
                pointItems: '',
                sectionItems: [], // 专题列表
                pointList: [],
            }
        },
        computed: mapState({
            lists: state => state.politics.lists,
        }),
        created() {
            this.getSectionList();
            this.pointItems = localStorage.getItem('LOCAL_SAVE_POINTS') ? localStorage.getItem('LOCAL_SAVE_POINTS') : '';
            this.form.book_id = localStorage.getItem('LOCAL_SAVE_BOOK_ID') ? parseInt(localStorage.getItem('LOCAL_SAVE_BOOK_ID')) : null;
            this.sectionItems = localStorage.getItem('LOCAL_SAVE_SECTION_ITEMS') ? $.parseJSON(localStorage.getItem('LOCAL_SAVE_SECTION_ITEMS')) : null;
            this.form.section_id = localStorage.getItem('LOCAL_SAVE_SECTION_ID') ? parseInt(localStorage.getItem('LOCAL_SAVE_SECTION_ID')) : null;
            if (this.pointItems) {
                let pointArr = this.pointItems.split(/[(\r\n)\r\n]+/);
                let resultArr = [];
                pointArr.forEach((item, index) => {
                    resultArr.push({
                        id: index + 1,
                        title: item,
                        book_id: this.book_id,
                        section_id: this.section_id,
                        updated_at: this.$moment().format('YYYY-MM-DD hh:mm:ss')
                    });
                })
                this.pointList = resultArr;
            }
        },
        methods: {
            ...mapActions([
                'getSectionList'
            ]),
            changeBookHandle(bookID) {
                if (bookID > 0) {
                    const allSection = this.lists;
                    let singleSection = allSection.find(item => {
                       return item.id == bookID;
                    });
                    localStorage.setItem('LOCAL_SAVE_BOOK_ID', bookID);
                    localStorage.setItem('LOCAL_SAVE_SECTION_ITEMS', JSON.stringify(singleSection.children));
                    this.sectionItems = singleSection.children;
                }
            },
            // 选择专题
            changeSectionHandle(sectionID) {
              if (sectionID > 0) {
                  localStorage.setItem('LOCAL_SAVE_SECTION_ID', sectionID);
              }
            },
            splitPointHandle() {
                let areatext = this.pointItems.trim();
                localStorage.setItem('LOCAL_SAVE_POINTS', areatext);
                let pointArr = areatext.split(/[(\r\n)\r\n]+/);
                let resultArr = [];
                pointArr.forEach((item, index) => {
                    resultArr.push({
                        id: index + 1,
                        title: item,
                        updated_at: this.$moment().format('YYYY-MM-DD hh:mm:ss')
                    });
                })
                this.pointList = resultArr;
            },
            // 提交数据
            submitHandle() {
                console.log(this.sectionItems);
            }
        }
    })
</script>
