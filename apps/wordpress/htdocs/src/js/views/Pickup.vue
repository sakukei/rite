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
  </div>
</template>

<script>
  // import axios from 'axios'
  // export default {
  //   data: function() {
  //     return {
  //       pickup: ''
  //     };
  //   },
  //   mounted() {
  //     const baseUrl = location.origin;
  //     axios
  //       .get(`${baseUrl}/wp-json/wp/v2/`)
  //       .then(response => (this.pickup = response));
  //   },
  // }
</script>

<style scoped>
img {
  max-width: 100%;
}
  li {
    max-width: 200px;
  }
</style>
