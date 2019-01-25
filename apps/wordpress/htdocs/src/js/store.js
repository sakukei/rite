import 'babel-polyfill';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
  state :{
    posts :'初期化'
  },
  mutations: {
    setPosts(state, payload) {
      state.posts = payload;
    }
  },
  actions: {
    getPosts({dispatch}) {
      return axios.get('http://localhost:3002/wp-json/wp/v2/posts?_embed;',{});
    },
  },
  getters: {
    posts(state) { return state.posts}
  }
});
export default store;
