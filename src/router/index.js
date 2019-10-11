import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/components/HomePage'
import Cart from '@/components/Cart'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'HomePage',
      component: HomePage
    },
    {
      path: '/cart',
      name: 'Cart',
      component: Cart
    }
  ]
})
