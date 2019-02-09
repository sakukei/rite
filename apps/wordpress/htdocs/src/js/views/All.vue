<template>
  <div>
    <ul class="p-main-grid">
      <li v-for="item in allPosts" :key="item.id">
        <a :href="item.link">
          <img :src="item.featured_image.src"/>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    computed: {
      allPosts(){
        return this.$store.state.allPosts
      },
    },
    mounted() {
      this.$store.dispatch('getAllPosts').then((res)=>{
        this.$store.commit('getAllPosts', res.data )
      });
    },
  }
</script>

<style scoped>

</style>
