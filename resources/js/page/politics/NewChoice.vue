<template>
    <div id="new-choice">
        <div class="bs-docs-header" id="content" tabindex="-1">
            <h1>20考研政治</h1>
            <p>部分 -> 专题 -> 选择题录入</p>
        </div>
        <div class="main el-main">
            <el-row :gutter="20">
                <el-col :span="11">
                    <el-form ref="form" :model="form" label-width="120px">
                        <!-- 题目 -->
                        <el-form-item label="题目">
                            <el-input type="textarea" v-model="form.title" :autosize="{ minRows: 2, maxRows: 6}" @keyup.native="cacheTitelHandle"></el-input>
                        </el-form-item>
                        <!-- 选项 -->
                        <div class="option-group">
                            <el-form-item label="选项A">
                                <el-input v-model="form.optionOfA" @keyup.native="cacheOptionAHandle"></el-input>
                            </el-form-item>
                            <el-form-item label="选项B">
                                <el-input v-model="form.optionOfB" @keyup.native="cacheOptionBHandle"></el-input>
                            </el-form-item>
                            <el-form-item label="选项C">
                                <el-input v-model="form.optionOfC" @keyup.native="cacheOptionCHandle"></el-input>
                            </el-form-item>
                            <el-form-item label="选项D">
                                <el-input v-model="form.optionOfD" @keyup.native="cacheOptionDHandle"></el-input>
                            </el-form-item>
                        </div>
                        <!-- 答案 -->
                        <el-form-item label="答案">
                            <label for="form-result" style="color: #a94442;">(只有一个答案表示题目是单选题，否则表示是多选题~)</label>
                            <el-checkbox-group id="form-result" v-model="form.result" @change.native="cacheResultHandle">
                                <el-checkbox label="A" name="result"></el-checkbox>
                                <el-checkbox label="B" name="result"></el-checkbox>
                                <el-checkbox label="C" name="result"></el-checkbox>
                                <el-checkbox label="D" name="result"></el-checkbox>
                            </el-checkbox-group>
                        </el-form-item>
                        <!-- 解析 -->
                        <el-form-item label="解析">
                            <el-input type="textarea" v-model="form.parse" :autosize="{ minRows: 4, maxRows: 8}" @keyup.native="cacheParseHandle"></el-input>
                        </el-form-item>
                        <!-- 考察知识点 -->
                        <el-row :gutter="20">
                            <el-col :span="17">
                                <el-form-item label="考察知识点">
                                    <el-input v-model="form.pointTitle" disabled></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="7">
                                <el-input v-model="form.pointID" placeholder="请输入考察的知识点ID" @blur="findPointHandle"></el-input>
                            </el-col>
                        </el-row>
                        <!-- 补充说明 -->
<!--                        <el-form-item label="提示">-->
<!--                            <el-input type="textarea" v-model="form.tips" :autosize="{ minRows: 4, maxRows: 8}"></el-input>-->
<!--                        </el-form-item>-->
                        <!-- 题源 -->
                        <el-form-item label="题源">
                            <el-input v-model="form.source" @keyup.native="cacheSourceHandle"></el-input>
                        </el-form-item>
                    </el-form>
                </el-col>
                <!-- 题目显示 -->
                <el-col :offset="1" :span="12">
                    <!-- 题目 -->
                    <el-row v-if="form.title">
                        <p><b>（{{ form.result.length > 1 ? '多选题' : '单选题' }}）</b>{{ form.title }}</p>
                    </el-row>
                    <!-- 选项 -->
                    <div class="option-group">
                        <el-row v-if="form.optionOfA" :gutter="20" style="margin-bottom: 20px;">
                            <el-button type="primary"><b style="padding-right: 5px;">A.</b> {{ form.optionOfA }}</el-button>
                        </el-row>
                        <el-row v-if="form.optionOfB" :gutter="20" style="margin-bottom: 20px;">
                            <el-button type="primary"><b style="padding-right: 5px;">B.</b> {{ form.optionOfB }}</el-button>
                        </el-row>
                        <el-row v-if="form.optionOfC" :gutter="20" style="margin-bottom: 20px;">
                            <el-button type="primary"><b style="padding-right: 5px;">C.</b> {{ form.optionOfC }}</el-button>
                        </el-row>
                        <el-row v-if="form.optionOfD" :gutter="20" style="margin-bottom: 20px;">
                            <el-button type="primary"><b style="padding-right: 5px;">D.</b> {{ form.optionOfD }}</el-button>
                        </el-row>
                    </div>
                    <!-- 正确答案 -->
                    <el-row v-if="form.result.length">
                        <p>正确答案：<b style="color: #a94442; font-size: 20px;">{{ form.result }}</b></p>
                    </el-row>
                    <!-- 解析 -->
                    <el-row v-if="form.parse" style="margin: 20px 0;">
                        <el-alert type="success" effect="dark">【答案解析】 {{ form.parse }}</el-alert>
                    </el-row>
                    <!-- 考察知识点 -->
                    <el-row v-if="form.pointID > 0">
                        <p>考察知识点：<b style="color: #a94442; font-size: 20px;">{{ form.pointTitle }}</b></p>
                    </el-row>
                    <!-- 题源 -->
                    <el-row v-if="form.source">
                        <p>题源：<b style="color: #a94442; font-size: 20px;">{{ form.source }}</b></p>
                    </el-row>

                </el-col>
            </el-row>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NewChoice",
        data() {
            return {
                form: {
                    title: '',
                    optionOfA: '',
                    optionOfB: '',
                    optionOfC: '',
                    optionOfD: '',
                    result: [],
                    parse: '',
                    pointTitle: '',
                    pointID: null,
                    tips: '',
                    source: '', // 题源
                }
            }
        },
        created() {
            this.form.title = localStorage.getItem('LOCAL_SAVE_TITLE');
            this.form.optionOfA = localStorage.getItem('LOCAL_SAVE_OPTION_A');
            this.form.optionOfB = localStorage.getItem('LOCAL_SAVE_OPTION_B');
            this.form.optionOfC = localStorage.getItem('LOCAL_SAVE_OPTION_C');
            this.form.optionOfD = localStorage.getItem('LOCAL_SAVE_OPTION_D');
            this.form.pointID = localStorage.getItem('LOCAL_SAVE_POINT_ID') ? localStorage.getItem('LOCAL_SAVE_POINT_ID') : null;
            this.form.pointTitle = this.form.pointID && '考察的知识点是：' + this.form.pointID;
            this.form.result = localStorage.getItem('LOCAL_SAVE_RESULT') ? localStorage.getItem('LOCAL_SAVE_RESULT').split(',') : [];
            this.form.parse = localStorage.getItem('LOCAL_SAVE_PARSE');
            this.form.source = localStorage.getItem('LOCAL_SAVE_SOURCE');
        },
        methods: {
            // 保存数据
            cacheTitelHandle() {
                localStorage.setItem('LOCAL_SAVE_TITLE', this.form.title);
            },
            cacheOptionAHandle() {
                localStorage.setItem('LOCAL_SAVE_OPTION_A', this.form.optionOfA);
            },
            cacheOptionBHandle() {
                localStorage.setItem('LOCAL_SAVE_OPTION_B', this.form.optionOfB);
            },
            cacheOptionCHandle() {
                localStorage.setItem('LOCAL_SAVE_OPTION_C', this.form.optionOfC);
            },
            cacheOptionDHandle() {
                localStorage.setItem('LOCAL_SAVE_OPTION_D', this.form.optionOfD);
            },
            cacheResultHandle() {
                localStorage.setItem('LOCAL_SAVE_RESULT', this.form.result);
            },
            cacheParseHandle() {
                localStorage.setItem('LOCAL_SAVE_PARSE', this.form.parse);
            },
            cacheSourceHandle() {
                localStorage.setItem('LOCAL_SAVE_SOURCE', this.form.source);
            },
            // 查找考察的知识点
            findPointHandle() {
                this.form.pointTitle = '考察的知识点是：' + this.form.pointID;
                localStorage.setItem('LOCAL_SAVE_POINT_ID', this.form.pointID);
            }
        }
    }
</script>

<style scoped>

</style>