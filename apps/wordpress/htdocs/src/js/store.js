import 'babel-polyfill';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
  state :{
    posts :[],
    pickups: [],
    baseUrl: location.origin,
    categories:[],
    featurePickups:[]
  },
  mutations: {
    getCategory(state, payload) {
      state.categories = payload;
    },
    getPickup(state, payload) {
     state.pickups = payload;
    },
    getFeaturePickup(state, payload) {
     state.featurePickups = payload;
    }
  },
  actions: {
    getPickup({dispatch}) {
      return axios.get(`${this.state.baseUrl}/wp-json/wp/v2/posts?filter[category_name]='Pickup'&per_page=14`,{});
    },
    getFeaturePickup({dispatch}) {
      return axios.get(`${this.state.baseUrl}/wp-json/wp/v2/posts?filter[category_name]='Pickup-feature'&per_page=14`,{});
    },
  },
  getters: {
    categories(state) {
      return state.categories;
    },
    pickup(state) {
      return state.pickups;
    },
    featurePickup(state) {
      return state.featurePickups;
    }
  }
});
export default store;
