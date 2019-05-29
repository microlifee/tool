<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="@{{ csrf_token }}">
    <title>Laravel & Vue</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <style>
        .nav a { text-decoration:none; }
        .el-menu { width: 260px; }
    </style>
</head>
<body>
<div id="app">
    <el-container>
        <el-aside width="260px" class="nav" style="background-color: rgb(238, 241, 246); position: fixed; overflow: hidden;">
            <el-menu
                    default-active="3-2"
                    class="el-menu-vertical-demo"
                    background-color="#545c64"
                    text-color="#fff"
                    active-text-color="#ffd04b">
                <el-submenu index="1">
                    <template slot="title">
                        <i class="el-icon-location"></i>
                        <span>政治管理</span>
                    </template>
                    <el-menu-item-group>
                        <template slot="title">部分 > 专题 > 知识点</template>
                        <a href="/#/politics/section/list"><el-menu-item index="1-1">专题列表</el-menu-item></a>
                        <a href="/#/politics/points/new"><el-menu-item index="1-2">新增知识点</el-menu-item></a>
                    </el-menu-item-group>
                    <el-menu-item-group title="部分 > 专题 > 选择题">
                        <a href="/#/politics/choice/list"><el-menu-item index="2-1">所有选择题</el-menu-item></a>
                        <a href="/#/politics/choice/new"><el-menu-item index="2-2">新增选择题</el-menu-item></a>
                    </el-menu-item-group>
                    <el-menu-item-group>
                        <template slot="title">院校选择</template>
                        <a href="/#/university/sort/list"><el-menu-item index="3-1">院校和排名</el-menu-item></a>
                        <a href="/#/university/sort/new"><el-menu-item index="3-2">新增院校相关排名</el-menu-item></a>
                    </el-menu-item-group>
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
</div>
<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>