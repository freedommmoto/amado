import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/pages/HomePage'
import Cart from '@/pages/Cart'
import CheckOut from '@/pages/CheckOut'
import Admin from '@/pages/Admin'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/', component: HomePage
    },
    {
      path: '/cart', component: Cart
    },
    {
      path: '/checkout', component: CheckOut
    },
    {
      path: '/admin', component: Admin
    }
  ]
})
