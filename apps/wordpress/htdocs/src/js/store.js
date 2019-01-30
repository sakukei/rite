import 'babel-polyfill';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
  state :{
    posts :[],
    pickups: [],
    categories:[]
  },
  mutations: {
    getCategory(state, payload) {
      state.categories = payload;
    }
  },
  actions: {
    getCategory({dispatch}) {
      const baseUrl = location.origin ;
      return axios.get(`${baseUrl}/wp-json/wp/v2/categories?per_page=100`,{});

    },
  },
  getters: {
    posts(state) { return state.categories}
  }
});
export default store;
