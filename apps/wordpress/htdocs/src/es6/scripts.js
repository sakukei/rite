
const PICKUP = {
  template:
    `<div>
        <h2>PICKUP</h2>
        <top-pickup></top-pickup>
    </div>`
};
const ALL = {
  template:
    `<div>
        <h2>ALL</h2>
        <all-posts></all-posts>
    </div>`
};


const routes = [
  {
    path: '/',
    component: PICKUP,
    props:true
  },
  {
    path: '/all',
    component: ALL,
    props:true
  }
];
const router = new VueRouter({
  routes
});

Vue.component('all-posts', {
  data: function() {
    return {
      posts: ''
    }
  },
  mounted () {
    const baseUrl = location.origin;
    axios
      .get(`${baseUrl}/wp-json/wp/v2/posts/`)
      .then(response => (this.posts = response))
  },
  template:
    `<div>
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
    }
  },
  mounted () {
    const baseUrl = location.origin;
    axios
      .get(`${baseUrl}/wp-json/wp/v2/top_pickups?_embed`)
      .then(response => (this.pickup = response))
  },
  template:
    `<div>
        <ul>
            <li v-for="item in pickup.data" :key="item.id">
                <h4>{{item.title.rendered}}</h4>
                <div v-html="item.content.rendered"></div>
                <img :src="item._embedded['wp:featuredmedia'][0].source_url" alt="">
                <p>{{item._links.self}}</p>
            </li>
        </ul>
     </div>`
});

const app = new Vue({
  router
}).$mount('#app')
