import Vue from 'vue'
import VueRouter from 'vue-router'
import Pickup from './views/Pickup'
import Traveler from './views/Traveler'

Vue.use(VueRouter);

const router = new VueRouter({
  routes:[
    {
      path:'/',
      component: Pickup
    },
    {
      path:'/traveler',
      component: Traveler
    }
  ]
});

export default router
