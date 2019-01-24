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
    <router-view :posts="posts" :getCategory="getCategory"/>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    data: function () {
      return {
        posts: ''
      };
    },
    mounted() {
      const baseUrl = location.origin;
      axios
        .get(`${baseUrl}/wp-json/wp/v2/posts?_embed;`)
        .then(response => {
            this.posts = response.data;
          }
        );
    },
    methods: {
      getCategory: function(filterBy,objList) {
        return objList.filter(function (obj) {
          return obj.category_name.some(function (item) {
            return item.indexOf(filterBy) >= 0;
          })
        })
      }
    },
    computed: {

    }
  }
</script>

<style scoped lang="scss">
</style>


