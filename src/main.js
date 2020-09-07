// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import store from './store.js'
import router from './router'
import VueMasonry from 'vue-masonry-css'

Vue.use(VueMasonry);
Vue.config.productionTip = false

import {config} from '../env.json' //const products = db.products

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    components: {App},
    template: '<App/>',
    store,
    data: {
        config,
        apiPart: config.apiPart,
        imgPart: config.imgPart,
        pusherKey: config.pusherKey,
        loginKey: '',
        numOrder: 0,
    }
})
