import 'babel-polyfill';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
  state :{
    baseUrl: location.origin,
    getPosts: 14,
    posts :[],
    pickups: [],
    featurePickups:[],
    namis: [],
    categories:[]
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
    },
    getNami(state, payload) {
      state.namis= payload;
    }
  },
  actions: {
    getCategory({dispatch}) {
      return axios.get(`${this.state.baseUrl}/wp-json/wp/v2/categories?per_page=100`,{});
    },
    getPickup({dispatch}) {
      return axios.get(`${this.state.baseUrl}/wp-json/wp/v2/posts?filter[category_name]='Pickup'&per_page=${this.state.getPosts}`,{});
    },
    getFeaturePickup({dispatch}) {
      return axios.get(`${this.state.baseUrl}/wp-json/wp/v2/posts?filter[category_name]='Pickup-feature'&per_page=${this.state.getPosts}`,{});
    },
    getNami({dispatch}) {
      return axios.get(`${this.state.baseUrl}/wp-json/wp/v2/posts?filter[category_name]='nami'&per_page=6`,{});
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
    },
    nami(state) {
      return state.namis;
    }
  }
});
export default store;
