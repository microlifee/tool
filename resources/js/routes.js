export default[
    { path: '', redirect: '/index' },
    // { path: '/index', components: require('./App.vue') },
    { path: '/politics/section/list', components: require('./page/politics/SectionList.vue') },
    { path: '/politics/points/new', components: require('./page/politics/NewPoints.vue') },
    { path: '/politics/choice/list', components: require('./page/politics/ChoiceList.vue') },
    { path: '/politics/choice/new', components: require('./page/politics/NewChoice.vue') },
    { path: '/university/sort/list', components: require('./page/university/List.vue') },
    { path: '/university/sort/new', components: require('./page/university/newSort.vue')},
    { path: '/detail/:id', components: require('./page/Detail.vue') }
];