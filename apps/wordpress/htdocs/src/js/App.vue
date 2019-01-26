<template>
  <div>
    <nav class="p-category-nav">
      <ul class="p-category-list">
        <li><router-link class="-pickup" to ='/'><span class="p-category-list-name">Pickup</span></router-link></li>
        <li><router-link class="-traveler" to ='/traveler'><span class="p-category-list-name">Traveler</span></router-link></li>
        <li><router-link class="-country" to ='/country'><span class="p-category-list-name">Country</span></router-link></li>
        <li><router-link class="-fashion" to ='/fashion'><span class="p-category-list-name">Fashion</span></router-link></li>
        <li><router-link class="-food" to ='/food'><span class="p-category-list-name">Food</span></router-link></li>
        <li><router-link class="-spot" to ='/spot'><span class="p-category-list-name">Spot</span></router-link></li>
        <li><router-link class="-all" to ='/all'><span class="p-category-list-name">All</span></router-link></li>
      </ul>
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


