import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/pages/HomePage'
import Cart from '@/pages/Cart'
import CheckOut from '@/pages/CheckOut'
import Admin from '@/pages/Admin'
import Login from '@/pages/Login'
import store from '../store.js'

Vue.use(Router)

function guard(to, from, next){
  // let userData = JSON.parse(sessionStorage.getItem("userData"));
  //
  if (!store.state.isLogged) {
    next('/login')
  }

  next(); // allow to enter route
}

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
      path: '/admin', component: Admin , beforeEnter: guard
    },
    {
      path: '/login', component: Login
    }
  ]
})
