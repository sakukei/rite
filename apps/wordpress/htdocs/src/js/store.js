import 'babel-polyfill';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    count: 0,
    pickup: ''
  },
  mutations: {
  },
  actions: {
  }
});
export default store;
