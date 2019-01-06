import Vue from "vue";
import App from "./App";
import router from './router.js';

Vue.component('testAxios', {
    props: ['theUrl'],
    data () {
        return {
            info: ''
        }
    },
    mounted () {
        axios
            .get(this.theUrl)
            .then(response => (this.info = response.data))
    },
    template: `<article>
    <section v-for="item in info">
      <h2>{{ item.title.rendered }}</h2>
      <p v-html="item.excerpt.rendered"></p>
      <time>{{ item.date.slice(0, 10) }}</time>
    </section>
    </article>`
});



new Vue({
    el: '#app',
    router,
    render: h => h(App),
    data: function() {
        const baseUrl = location.origin;
        return {
            theUrlAlpha: `${baseUrl}/wp-json/wp/v2/posts/`,
            theUrlBravo: `${baseUrl}/wp-json/wp/v2/posts/`
        }
    }
});
