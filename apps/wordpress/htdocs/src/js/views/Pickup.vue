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
        pickup:[]
      };
    },
    watch: {
      posts(posts) {
        console.log(posts);
        for(let i = 0; i < posts.length; i++){
          console.log(posts[i].category_name)
          for(let a = 0; a < posts[i].category_name.length; a++){
            if(posts[i].category_name[a] === 'Pickup'){
              this.pickup.push(posts[i])
            }
          }
        }
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
