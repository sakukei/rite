"use strict";

var _router = _interopRequireDefault(require("./router.js"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

Vue.component('testAxios', {
  props: ['theUrl'],
  data: function data() {
    return {
      info: ''
    };
  },
  mounted: function mounted() {
    var _this = this;

    axios.get(this.theUrl).then(function (response) {
      return _this.info = response.data;
    });
  },
  template: "<article>\n    <section v-for=\"item in info\">\n      <h2>{{ item.title.rendered }}</h2>\n      <p v-html=\"item.excerpt.rendered\"></p>\n      <time>{{ item.date.slice(0, 10) }}</time>\n    </section>\n    </article>"
});
new Vue({
  el: '#app',
  router: router,
  render: function render(h) {
    return h(App);
  },
  data: function data() {
    var baseUrl = location.origin;
    return {
      theUrlAlpha: "".concat(baseUrl, "/wp-json/wp/v2/posts/"),
      theUrlBravo: "".concat(baseUrl, "/wp-json/wp/v2/posts/")
    };
  }
});