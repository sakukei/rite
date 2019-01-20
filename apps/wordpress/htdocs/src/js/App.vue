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
    <router-view :posts="mainPost"/>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    data: function () {
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
            this.posts = response.data;
            console.log(this.posts)
            // const category = posts.category_name;
            // this.mainPost = category.filter(function(post){
            //   console.log(post)
            // })
          // console.log(this.posts.category_name)

          //一応できてるけど最初のだけ
           this.mainPost = this.posts.filter(function(post){
             return post.category_name[0] !== '商品';
           })
          }
        );
    },
  }
</script>

<style scoped lang="scss">
</style>


