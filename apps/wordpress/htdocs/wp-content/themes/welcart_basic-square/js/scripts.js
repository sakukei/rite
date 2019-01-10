"use strict";

var _router = _interopRequireDefault(require("./router.js"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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
    axios.get("".concat(baseUrl, "/wp-json/wp/v2/top_pickups?_embed")).then(function (response) {
      return _this3.traveler = response;
    });
  },
  template: "<div>\n        <ul>\n            <li v-for=\"item in traveler.data\" :key=\"item.id\">\n                <a :href=\"item.link\">\n                <img :src=\"item._embedded['wp:featuredmedia'][0].source_url\" alt=\"\">\n                 <h4>{{item._embedded['wp:term']}}</h4>\n                </a>\n            </li>\n        </ul>\n     </div>"
});
var app = new Vue({
  router: _router.default
}).$mount('#app');