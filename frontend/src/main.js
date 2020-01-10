import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './plugins'

import BootstrapVue from 'bootstrap-vue'

Vue.config.productionTip = process.env.NODE_ENV === 'production'

// BootStrap
Vue.use(BootstrapVue)

global.instanceApp = new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
