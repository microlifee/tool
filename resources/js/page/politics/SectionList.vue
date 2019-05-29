<template>
    <div id="section-list">
        <div class="bs-docs-header" id="content" tabindex="-1">
            <h1>20考研政治</h1>
            <p>部分 -> 专题数据</p>
        </div>
        <div class="main el-main">
            <el-table :data="tableData" :row-class-name="tableRowClassName">
                <el-table-column type="expand">
                    <template slot-scope="props">
                        <!-- 通过props得到大表格的每一列数据，dataList是小表格的数据，通过props.row.dataList获取 -->
                        <el-table :data="props.row.children" stripe>
                            <el-table-column prop="prefix" label="所属部分" width="100"></el-table-column>
                            <el-table-column prop="title" label="标题"></el-table-column>
                            <el-table-column prop="updated_at" label="更新日期" width="300"></el-table-column>
                        </el-table>
                    </template>
                </el-table-column>
                <el-table-column prop="title" label="标题"></el-table-column>
                <el-table-column prop="short" label="简称" width="100"></el-table-column>
                <el-table-column prop="avg" label="平均分" width="100"></el-table-column>
                <el-table-column prop="updated_at" label="更新日期" width="300"></el-table-column>
            </el-table>
        </div>
    </div>
</template>
<script>
    import { mapState, mapActions } from 'vuex';
    export default({
        computed: mapState({
            tableData: state => state.politics.lists
        }),
        created() {
            this.getSectionList();
        },
        methods: {
            ...mapActions([
                'getSectionList'
            ]),
            tableRowClassName({row, rowIndex}) {
                if (rowIndex === 1) {
                    return 'warning-row';
                } else if (rowIndex === 3) {
                    return 'success-row';
                }
                return '';
            }
        }
    });
</script>

<style>
    .bs-docs-header {
        position: relative;
        padding: 30px 0;
        color: #cdbfe3;
        text-align: center;
        text-shadow: 0 1px 0 rgba(0,0,0,.1);
        background-color: #6f5499;
        background-image: -webkit-gradient(linear, left top, left bottom, from(#563d7c), to(#6f5499));
        background-image: -webkit-linear-gradient(top, #563d7c 0%, #6f5499 100%);
        background-image:      -o-linear-gradient(top, #563d7c 0%, #6f5499 100%);
        background-image:         linear-gradient(to bottom, #563d7c 0%, #6f5499 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#563d7c', endColorstr='#6F5499', GradientType=0);
        background-repeat: repeat-x;
    }
    .bs-docs-header h1 {
        margin-top: 0;
        color: #fff;
        font-size: 42px;
    }
    .bs-docs-header p {
        margin-bottom: 0;
        font-weight: 300;
        line-height: 1.4;
        font-size: 24px;
    }

    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
    }
</style>