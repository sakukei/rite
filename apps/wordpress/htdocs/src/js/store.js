import 'babel-polyfill';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
  state :{
    posts :[],
    pickups: [],
    categories:[],
    baseUrl: location.origin
  },
  mutations: {
    getCategory(state, payload) {
      state.categories = payload;
    },
    getPickup(state, payload) {
     state.pickups = payload;
    }
  },
  actions: {
    getCategory({dispatch}) {
      return axios.get(`${this.state.baseUrl}/wp-json/wp/v2/categories?per_page=100`,{});
    },
    getPickup({dispatch}) {
      console.log(this.state.categories)
      const id = this.state.categories.find(function(category){
        return category.name === 'Pickup';
      });
      console.log(id);
      return axios.get(`${this.state.baseUrl}/wp-json/wp/v2/posts?categories=${id.id}&per_page=14`,{});
    },
  },
  getters: {
    categories(state) {
      return state.categories;
    },
    pickup(state) {
      return state.pickups;
    }
  }
});
export default store;
