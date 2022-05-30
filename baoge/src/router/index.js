import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/admin/Index'
import Login from '@/components/admin/Login'
import VueCookies from 'vue-cookies'
Vue.use(Router)

let router = new Router({
  routes: [
    {
      path: '/index',
      name: 'index',
      component: Index
    },
    {
      path: '/',
      name: 'login',
      component: Login
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    }
  ],
  mode: 'history'
})

// 导航守卫
// 使用 router.beforeEach 注册一个全局前置守卫，判断用户是否登陆
router.beforeEach((to, from, next) => {
  if (to.path === '/Login') {
    next()
  } else {
    var accion = VueCookies.get('accion')
    if (accion === null || accion === '' || accion === 'undefined') {
      next('/Login')
    } else {
      next()
    }
  }
})

export default router
