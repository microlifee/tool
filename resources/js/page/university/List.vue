<template>
    <div id="university-list">
        <div class="bs-docs-header" id="content" tabindex="-1">
            <h1>普通高校研究生培养单位（共573所）</h1>
            <p>1.学科门类； 2.一级学科排名； 3.优势专业（5★+ | 5★ | 5★- | 4★）</p>
        </div>
        <div class="main el-main">
            <el-row >
                <el-col :span="11">
                    <el-table v-if="universityList.length > 0"  :data="universityList">
                        <el-table-column prop="id" label="#" width="100"></el-table-column>
                        <el-table-column prop="title" label="大学" ></el-table-column>
                        <el-table-column
                                label="操作"
                                width="200">
                            <template slot-scope="scope">
                                <el-button @click="handleClick(scope.row, 1)" type="text" size="small">门类</el-button>
                                <el-button @click="handleClick(scope.row, 2)" type="text" size="small">一级学科</el-button>
                                <el-button @click="handleClick(scope.row, 3)" type="text" size="small">专业</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                    <el-table v-else :data="tableData">
                        <el-table-column prop="id" label="#" width="100"></el-table-column>
                        <el-table-column prop="title" label="大学" ></el-table-column>
                        <el-table-column
                                label="操作"
                                width="200">
                            <template slot-scope="scope">
                                <el-button @click="handleClick(scope.row, 1)" type="text" size="small">门类</el-button>
                                <el-button @click="handleClick(scope.row, 2)" type="text" size="small">一级学科</el-button>
                                <el-button @click="handleClick(scope.row, 3)" type="text" size="small">专业</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                    <!-- 分页 -->
                    <div style="margin-top: 20px;">
                        <el-pagination
                                background
                                layout="prev, pager, next"
                                @current-change="onChangePageHandle"
                                :total="total">
                        </el-pagination>
                    </div>
                </el-col>
                <el-col :span="12" :offset="1">
                    <el-table
                            :data="sortItems"
                            style="width: 100%">
                        <el-table-column
                                prop="id"
                                label="#"
                                width="120">
                        </el-table-column>
                        <el-table-column
                                prop="name"
                                label="一级学科"
                                >
                        </el-table-column>
                        <el-table-column
                                prop="sort"
                                label="排名"
                                width="120">
                        </el-table-column>
                    </el-table>
                </el-col>
            </el-row>


        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';
    export default {
        name: "UniversityList",
        data() {
            return {
                universityList: [],
                tableLabel: '门类'
            }
        },
        computed: {
            tableData() {
                return this.$store.state.news.lists.slice(0, 10);
            },
            total() {
                return this.$store.state.news.lists.length;
            },
            ...mapState({
                 sortItems: state => state.news.sortItems,
            }),
        },
        created() {
            this.getNewsLists();

            console.log('------', this.$store.state.news.branch);
        },
        methods: {
            ...mapActions([
                'getNewsLists',
                'getSortList'
            ]),
            // 切换分页
            onChangePageHandle(currentPage) {
                const PAGE_SIZE = 10;
                const UNIVERSITY_ITEMS = $.parseJSON(localStorage.getItem('UNIVERSITY_ITEMS_KEY'));
                const CURRENT_UNIVERSITY_ITEMS = UNIVERSITY_ITEMS.slice((currentPage - 1) * PAGE_SIZE, currentPage * PAGE_SIZE);
                this.universityList = CURRENT_UNIVERSITY_ITEMS;
            },
            // 查看排名数据
            handleClick(uEntity, type) {
                const UNIVERSITY_ID = uEntity.id;
                this.getSortList({ universityID: UNIVERSITY_ID, sortType: type });

            }
        }
    }
</script>

<style scoped>

</style>