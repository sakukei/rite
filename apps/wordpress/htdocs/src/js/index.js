import Vue from 'vue';
import router from './router';
import App from './App';
import store from './store';
import AsyncComputed from 'vue-async-computed';
Vue.use(AsyncComputed)

new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
});
