"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;

var _vue = _interopRequireDefault(require("vue"));

var _vueRouter = _interopRequireDefault(require("vue-router"));

var _All = _interopRequireDefault(require("@/views/All.vue"));

var _Country = _interopRequireDefault(require("@/views/Country.vue"));

var _Fashion = _interopRequireDefault(require("@/views/Fashion.vue"));

var _Food = _interopRequireDefault(require("@/views/Food.vue"));

var _Pickup = _interopRequireDefault(require("@/views/Pickup.vue"));

var _Spot = _interopRequireDefault(require("@/views/Spot.vue"));

var _Traveller = _interopRequireDefault(require("@/views/Traveller.vue"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

_vue.default.use(_vueRouter.default);

var router = new _vueRouter.default({
  mode: 'history',
  routes: [{
    path: '/all',
    compornent: _All.default
  }, {
    path: '/country',
    compornent: _Country.default
  }, {
    path: '/fashion',
    compornent: _Fashion.default
  }, {
    path: '/food',
    compornent: _Food.default
  }, {
    path: '/pickup',
    compornent: _Pickup.default
  }, {
    path: '/spot',
    compornent: _Spot.default
  }, {
    path: '/traveller',
    compornent: _Traveller.default
  }]
});
var _default = router;
exports.default = _default;