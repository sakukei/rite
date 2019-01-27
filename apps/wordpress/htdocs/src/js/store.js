import 'babel-polyfill';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
  state :{
    posts :[]
  },
  mutations: {
    setPosts(state, payload) {
      state.posts = payload;
    }
  },
  actions: {
    getPosts({dispatch}) {
      const baseUrl = location.origin ;
      return axios.get(`${baseUrl}/wp-json/wp/v2/posts?per_page=100`,{});
    },
  },
  getters: {
    posts(state) { return state.posts}
  }
});
export default store;
