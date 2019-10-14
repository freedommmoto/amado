import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/pages/HomePage'
import Cart from '@/pages/Cart'
import CheckOut from '@/pages/CheckOut'
import Admin from '@/pages/Admin'
import Login from '@/pages/Login'

Vue.use(Router)

function guard(to, from, next){
  let userData = JSON.parse(sessionStorage.getItem("userData"));
  if(userData) {
    // or however you store your logged in state
    next(); // allow to enter route
  } else{
    next('/login'); // go to '/login';
  }
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
