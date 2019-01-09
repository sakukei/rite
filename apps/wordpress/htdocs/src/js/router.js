import Vue from 'vue'
import VueRouter from 'vue-router'
import Pickup from './views/Pickup'
import Traveler from './views/Traveler'
import All from './views/All'
import Country from './views/Country'
import Fashion from './views/Fashion'
import Food from './views/Food'
import Spot from './views/Spot'

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Pickup
    },
    {
      path: '/traveler',
      component: Traveler
    },
    {
      path: '/country',
      component: Country
    },
    {
      path: '/fashion',
      component: Fashion
    },
    {
      path: '/food',
      component: Food
    },
    {
      path: '/spot',
      component: Spot
    },
    {
      path: '/all',
      component: All
    },
  ]
});

export default router
