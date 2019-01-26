<template>
  <div>
  <h1>Food</h1>
  <ul class="feature-pickup">
    <li v-for="item in food" :key="item.id">
      <a :href="item.link">
        <div><img :src="item.featured_image.src"/></div>
        <p>{{item.title.rendered}}</p>
      </a>
    </li>
  </ul>
  </div>
</template>

<script>
  export default {
    props: ['getCategory'],
    computed: {
      posts() {
        return this.$store.state.posts
      },
      food: function () {
        return this.getCategory('Food', this.posts);
      },
    }
  }
</script>

<style scoped>

</style>
