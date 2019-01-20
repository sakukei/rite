<template>
  <div class="test">
    <h1>Pickup</h1>
    <ul>
      <!--<li v-for="item in pickup.data" :key="item.id">-->
        <!--<a :href="item.link">-->

          <!--{{item.title.rendered}}-->
          <!--<img :src="item._embedded['wp:featuredmedia'][0].source_url" alt="">-->
        <!--</a>-->
      <!--</li>-->
    </ul>
    {{posts}}
  </div>
</template>

<script>
  export default {
    props:['posts'],
    data: function() {
      return {
        pickup:''
      };
    },
    watch: {
      posts(post) {
        console.log(post);
      }
    }
  }
</script>

<style scoped>
img {
  max-width: 100%;
}
  li {
    max-width: 200px;
  }
</style>
