<template>
  <div>
    <ul class="p-main-grid">
      <li v-for="item in spot" :key="item.id">
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
      spot (){
        return this.$store.state.spots
      },
    },
    mounted() {
      this.$store.dispatch('getSpot').then((res)=>{
        this.$store.commit('getSpot', res.data )
      });
    },
  }
</script>

<style scoped>

</style>
