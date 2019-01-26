<template>
  <div>
    <h1>Traveler</h1>
    <ul class="feature-pickup">
      <li v-for="item in traveler" :key="item.id">
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
      traveler: function () {
        return this.getCategory('Traveler', this.posts);
      },
    }
  }
</script>

<style scoped>

</style>
