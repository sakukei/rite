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
    <router-view :getCategory="getCategory"/>
    <!--<div>{{posts}}</div>-->
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    methods: {
      getCategory: function(filterBy,objList) {
        return objList.filter(function (obj) {
          return obj.category_name.some(function (item) {
            return item.indexOf(filterBy) >= 0;
          })
        })
      }
    },
    data () {
      return {
        posts: ''
      }
    },
    beforeMount () {
      this.$store.dispatch('getPosts').then((res)=>{
        this.$store.commit('setPosts', res.data )
        this.posts = this.$store.state.posts
        return;
      })
    },
    // computed :{
    //   message() {
    //     return this.$store.state.posts
    //   }
    // }
  }
</script>

<style scoped lang="scss">
</style>


