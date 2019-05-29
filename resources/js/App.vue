<template>

        <el-container>
            <el-aside width="260px" style="background-color: rgb(238, 241, 246); position: fixed; overflow: hidden;">
                <el-menu
                        default-active="2"
                        class="el-menu-vertical-demo"
                        background-color="#545c64"
                        text-color="#fff"
                        @open="handleOpen"
                        @close="handleClose"
                        active-text-color="#ffd04b">
                    <el-submenu index="1">
                        <template slot="title">
                            <i class="el-icon-location"></i>
                            <span>政治管理</span>
                        </template>
                        <el-menu-item-group>
                            <el-menu-item index="1-1">选项1</el-menu-item>
                            <el-menu-item index="1-2">选项2</el-menu-item>
                        </el-menu-item-group>
                        <el-menu-item-group title="分组2">
                            <el-menu-item index="1-3">选项3</el-menu-item>
                        </el-menu-item-group>
                        <el-submenu index="1-4">
                            <template slot="title">选项4</template>
                            <el-menu-item index="1-4-1">选项1</el-menu-item>
                        </el-submenu>
                    </el-submenu>
                    <el-menu-item index="2">
                        <i class="el-icon-menu"></i>
                        <span slot="title">导航二</span>
                    </el-menu-item>
                    <el-menu-item index="3" disabled>
                        <i class="el-icon-document"></i>
                        <span slot="title">导航三</span>
                    </el-menu-item>
                    <el-menu-item index="4">
                        <i class="el-icon-setting"></i>
                        <span slot="title">导航四</span>
                    </el-menu-item>
                </el-menu>
            </el-aside>

            <el-container>
                <div  style="width: 100%; margin-left: 260px;">
                    <router-view />
                </div>
            </el-container>
        </el-container>
</template>
<script>
    import { mapState, mapActions } from 'vuex/types';
    export default({
        // 映射 vuex 上面的属性
        computed: mapState({
            recommend: state => state.news.recommend
        }),
        created() {
            // 获取推荐列表
            this.getNewsRecommend();
        },
        methods: {
            // 映射 vuex 对象上的方法
            ...mapActions([
                'getNewsRecommend'
            ])
        }
    });
</script>