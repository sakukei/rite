import 'babel-polyfill';
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    baseUrl: location.origin,
    getPosts: 14,
    posts: [],
    pickups: [],
    featurePickups: [],
    namis: [],
    ayumis:[],
    chihas:[],
    yuikas:[],
    ayas:[],
    hitomis:[],
    categories: [],
    allPosts:[],
    foods: [],
    spots: [],
    fashions : []
  },
  mutations: {
    getAllPosts(state, payload) {
      state.allPosts = payload;
    },
    getAllPostsMore(state, payload) {
      state.allPosts = payload;
    },
    getCategory(state, payload) {
      state.categories = payload;
    },
    getFashion(state, payload) {
      state.fashions = payload;
    },
    getFashionMore(state, payload) {
      state.fashions = payload;
    },
    getSpot(state, payload) {
      state.spots = payload;
    },
    getSpotMore(state, payload) {
      state.spots = payload;
    },
    getFood(state, payload) {
      state.foods = payload;
    },
    getFoodMore(state, payload) {
      state.foods = payload;
    },
    getPickup(state, payload) {
      state.pickups = payload;
    },
    getPickupMore(state, payload) {
      state.pickups = payload;
    },
    getFeaturePickup(state, payload) {
      state.featurePickups = payload;
    },
    getNami(state, payload) {
      state.namis = payload;
    },
    getAyumi(state, payload) {
      state.ayumis = payload;
    },
    getAya(state, payload) {
      state.ayas = payload;
    },
    getChiha(state, payload) {
      state.chihas = payload;
    },
    getYuika(state, payload) {
      state.yuikas = payload;
    },
    getHitomi(state, payload) {
      state.hitomis = payload;
    }
  },
  actions: {
    getAllPosts({ dispatch }) {
      return axios.get(
        `${this.state.baseUrl}/wp-json/wp/v2/posts?per_page=14`,
        {}
      );
    },
    getAllPostsMore({ dispatch },offset) {
      return axios.get(
        `${
          this.state.baseUrl
          }/wp-json/wp/v2/posts?per_page=${offset}`,
        {}
      );
    },
    getCategory({ dispatch }) {
      return axios.get(
        `${this.state.baseUrl}/wp-json/wp/v2/categories?per_page=100`,
        {}
      );
    },
    getPickup({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
        }/wp-json/wp/v2/posts?filter[category_name]='Pickup,Pickup-item'&per_page=${
          this.state.getPosts
        }`,
        {}
      );
    },
    getPickupMore({ dispatch },offset) {
      return axios.get(
        `${
          this.state.baseUrl
          }/wp-json/wp/v2/posts?filter[category_name]='Pickup,Pickup-item'&per_page=${offset}`,
        {}
      );
    },
    getFashion({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
          }/wp-json/wp/v2/posts?filter[category_name]='Fashion'&per_page=${
          this.state.getPosts
          }`,
        {}
      );
    },
    getFashionMore({ dispatch },offset) {
      return axios.get(
        `${
          this.state.baseUrl
          }/wp-json/wp/v2/posts?filter[category_name]='Fashion'&per_page=${offset}`,
        {}
      );
    },
    getFood({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
          }/wp-json/wp/v2/posts?filter[category_name]='Food'&per_page=${
          this.state.getPosts
          }`,
        {}
      );
    },
    getSpot({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
          }/wp-json/wp/v2/posts?filter[category_name]='Spot'&per_page=${
          this.state.getPosts
          }`,
        {}
      );
    },
    getSpotMore({ dispatch },offset) {
      return axios.get(
        `${
          this.state.baseUrl
          }/wp-json/wp/v2/posts?filter[category_name]='Spot'&per_page=${offset}`,
        {}
      );
    },
    getFeaturePickup({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
        }/wp-json/wp/v2/posts?filter[category_name]='Pickup-feature'&per_page=${
          this.state.getPosts
        }`,
        {}
      );
    },
    getNami({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
        }/wp-json/wp/v2/posts?filter[category_name]='nami,nami-traveler-item'&per_page=6`,
        {}
      );
    },
    getAyumi({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
        }/wp-json/wp/v2/posts?filter[category_name]='ayumi,ayumi-traveler-item'&per_page=6`,
        {}
      );
    },
    getHitomi({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
        }/wp-json/wp/v2/posts?filter[category_name]='hitomi,hitomi-traveler-item'&per_page=6`,
        {}
      );
    },
    getYuika({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
        }/wp-json/wp/v2/posts?filter[category_name]='yuika,yuika-traveler-item'&per_page=6`,
        {}
      );
    },
    getAya({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
        }/wp-json/wp/v2/posts?filter[category_name]='aya,aya-traveler-item'&per_page=6`,
        {}
      );
    },
    getChiha({ dispatch }) {
      return axios.get(
        `${
          this.state.baseUrl
        }/wp-json/wp/v2/posts?filter[category_name]='chiha,chiha-traveler-item'&per_page=6`,
        {}
      );
    }
  },
  getters: {
    categories(state) {
      return state.categories;
    },
    pickup(state) {
      return state.pickups;
    },
    fashion(state) {
      return state.fashions;
    },
    spot(state) {
      return state.spots;
    },
    food(state) {
      return state.foods;
    },
    featurePickup(state) {
      return state.featurePickups;
    },
    nami(state) {
      return state.namis;
    },
    ayumi(state) {
      return state.namis;
    },
    chiha(state) {
      return state.namis;
    },
    aya(state) {
      return state.namis;
    },
    hitomi(state) {
      return state.namis;
    },
    yuika(state) {
      return state.namis;
    },
    allPosts(state) {
      return state.namis;
    }
  }
});
export default store;
