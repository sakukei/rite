
const COUNTRY = {
  template:
    `<div>
    <h2>ここはホームです、一覧表示させます</h2>
  </div>`
};
const TRAVELER = {
  template:
    `<div>
        <p>aaaaa</p>
    </div>`
};
const routes = [
  {
    path: '/country',
    component: COUNTRY,
    props:true
  },
  {
    path: '/traveler',
    component: TRAVELER,
    props:true
  }
];
const router = new VueRouter({
  routes
});
const app = new Vue({
  router,
  data: function() {
    return {
      posts: '',
      pickup: '',
    }
  },
  mounted () {
    const baseUrl = location.origin;
    axios
      .get(`${baseUrl}/wp-json/wp/v2/posts/`)
      .then(response => (this.posts = response))
    axios
      .get(`${baseUrl}/wp-json/wp/v2/top_pickups`)
      .then(response => (this.pickup = response))
  }
}).$mount('#app')
