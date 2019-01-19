<template>
  <div>
    <nav>
      <router-link to ='/'>Pickup</router-link>
      <router-link to ='/traveler'>Traveler</router-link>
      <router-link to ='/country'>Country</router-link>
      <router-link to ='/fashion'>Fashion</router-link>
      <router-link to ='/food'>Food</router-link>
      <router-link to ='/spot'>Spot</router-link>
      <router-link to ='/all'>All</router-link>
    </nav>
    <router-view />
    {{posts}}
  </div>
</template>

<script>
  import axios from 'axios';
  export default {
    data: function() {
      return {
        posts: '',
        mainPost: ''
      };
    },
    mounted() {
      const baseUrl = location.origin;
      axios
        .get(`${baseUrl}/wp-json/wp/v2/posts?_embed;`)
        .then(response => {
          const posts = response.data;
          this.posts = posts.filter(x => x.type === 'post');
          }
        );
    },
  }
</script>

<style scoped lang="scss">
</style>


