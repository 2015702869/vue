// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueResource from 'vue-resource'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import request from '../static/js/request.js'
import VueCookies from 'vue-cookies'
import XxButton from './components/meun.vue'
import Admin from './components/admin/admin.vue'
Vue.config.productionTip = false
Vue.use(VueResource)
Vue.use(ElementUI)
Vue.use(VueCookies)
Vue.prototype.request = request
Vue.component(XxButton.name, XxButton)
Vue.component(Admin.name, Admin)
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
