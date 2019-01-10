import router from './router.js'
Vue.component('all-posts', {
  data: function() {
    return {
      posts: ''
    };
  },
  mounted() {
    const baseUrl = location.origin;
    axios
      .get(`${baseUrl}/wp-json/wp/v2/posts/`)
      .then(response => (this.posts = response));
  },
  template: `<div>
        <ul>
        <li v-for="item in posts.data" :key="item.id">
                <h4>{{item.title.rendered}}</h4>
            </li>
            </ul>
     </div>`
});

Vue.component('top-pickup', {
  data: function() {
    return {
      pickup: ''
    };
  },
  mounted() {
    const baseUrl = location.origin;
    axios
      .get(`${baseUrl}/wp-json/wp/v2/top_pickups?_embed`)
      .then(response => (this.pickup = response));
  },
  template: `<div>
        <ul>
            <li v-for="item in pickup.data" :key="item.id">
                <a :href="item.link">
                <img :src="item._embedded['wp:featuredmedia'][0].source_url" alt="">
                 <h4>{{item.title.rendered}}</h4>
                </a>
            </li>
        </ul>
     </div>`
});

Vue.component('traveler-posts', {
  data: function() {
    return {
      traveler: ''
    };
  },
  mounted() {
    const baseUrl = location.origin;
    axios
      .get(`${baseUrl}/wp-json/wp/v2/top_pickups?_embed`)
      .then(response => (this.traveler = response));
  },
  template: `<div>
        <ul>
            <li v-for="item in traveler.data" :key="item.id">
                <a :href="item.link">
                <img :src="item._embedded['wp:featuredmedia'][0].source_url" alt="">
                 <h4>{{item._embedded['wp:term']}}</h4>
                </a>
            </li>
        </ul>
     </div>`
});

const app = new Vue({
  router
}).$mount('#app');


