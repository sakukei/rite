"use strict";

var PICKUP = {
  template: "<div>\n        <h2>PICKUP</h2>\n        <top-pickup></top-pickup>\n    </div>"
};
var ALL = {
  template: "<div>\n        <h2>ALL</h2>\n        <all-posts></all-posts>\n    </div>"
};
var TRAVELER = {
  template: "\n    <div>\n        <h2>TRAVELER</h2>\n        <traveler-posts></traveler-posts>\n    </div>\n  "
};
var routes = [{
  path: '/',
  component: PICKUP,
  props: true
}, {
  path: '/traveler',
  component: TRAVELER,
  props: true
}, {
  path: '/all',
  component: ALL,
  props: true
}];
var router = new VueRouter({
  routes: routes
});
Vue.component('all-posts', {
  data: function data() {
    return {
      posts: ''
    };
  },
  mounted: function mounted() {
    var _this = this;

    var baseUrl = location.origin;
    axios.get("".concat(baseUrl, "/wp-json/wp/v2/posts/")).then(function (response) {
      return _this.posts = response;
    });
  },
  template: "<div>\n        <ul>\n        <li v-for=\"item in posts.data\" :key=\"item.id\">\n                <h4>{{item.title.rendered}}</h4>\n            </li>\n            </ul>\n     </div>"
});
Vue.component('top-pickup', {
  data: function data() {
    return {
      pickup: ''
    };
  },
  mounted: function mounted() {
    var _this2 = this;

    var baseUrl = location.origin;
    axios.get("".concat(baseUrl, "/wp-json/wp/v2/top_pickups?_embed")).then(function (response) {
      return _this2.pickup = response;
    });
  },
  template: "<div>\n        <ul>\n            <li v-for=\"item in pickup.data\" :key=\"item.id\">\n                <a :href=\"item.link\">\n                <img :src=\"item._embedded['wp:featuredmedia'][0].source_url\" alt=\"\">\n                 <h4>{{item.title.rendered}}</h4>\n                </a>\n            </li>\n        </ul>\n     </div>"
});
Vue.component('traveler-posts', {
  data: function data() {
    return {
      traveler: ''
    };
  },
  mounted: function mounted() {
    var _this3 = this;

    var baseUrl = location.origin;
    axios.get("".concat(baseUrl, "/wp-json/wp/v2/categories/37?_embed")).then(function (response) {
      return _this3.traveler = response;
    });
  },
  template: "<div>\n        <ul>\n            <li v-for=\"item in traveler.data\" :key=\"item.id\">\n                {{item}}\n            </li>\n        </ul>\n     </div>"
});
var app = new Vue({
  router: router
}).$mount('#app');