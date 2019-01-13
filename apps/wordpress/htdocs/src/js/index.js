import Vue from 'vue';
import router from './router';
import App from './App';
import store from './store';

new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
});
