<template>
  <div>
    <ul class="p-main-grid">
      <li v-for="item in food" :key="item.id">
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
      food (){
        return this.$store.state.foods
      },
    },
    mounted() {
      this.$store.dispatch('getFood').then((res)=>{
        this.$store.commit('getFood', res.data )
      });
    },
  }
</script>

<style scoped>

</style>
