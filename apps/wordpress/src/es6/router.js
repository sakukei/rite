import Vue from 'vue';
import VueRouter from 'vue-router';

import from All '@/views/All.vue'
import from Country '@/views/Country.vue'
import from Fashion '@/views/Fashion.vue'
import from Food '@/views/Food.vue'
import from Pickup '@/views/Pickup.vue'
import from Spot '@/views/Spot.vue'
import from Traveller '@/views/Traveller.vue'

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', compornent: All },
    { path: '/country', compornent: Country },
    { path: '/fashion', compornent: Fashion },
    { path: '/food', compornent: Food },
    { path: '/pickup', compornent: Pickup },
    { path: '/spot', compornent: Spot },
    { path: '/traveller', compornent: Traveller },
  ]
});

export default router;a