import Vue from 'vue';
import VueRouter from 'vue-router';

import All from '@/views/All.vue';
import Country from '@/views/Country.vue';
import Fashion from '@/views/Fashion.vue';
import Food from '@/views/Food.vue';
import Pickup from '@/views/Pickup.vue';
import Spot from '@/views/Spot.vue';
import Traveller from '@/views/Traveller.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/all', compornent: All },
    { path: '/country', compornent: Country },
    { path: '/fashion', compornent: Fashion },
    { path: '/food', compornent: Food },
    { path: '/pickup', compornent: Pickup },
    { path: '/spot', compornent: Spot },
    { path: '/traveller', compornent: Traveller },
  ]
});

export default router;