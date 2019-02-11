<template>
  <div>
    <ul class="p-main-grid">
      <li v-for="item in fashion" :key="item.id">
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
      fashion (){
        return this.$store.state.fashions
      },
    },
    mounted() {
      this.$store.dispatch('getFashion').then((res)=>{
        this.$store.commit('getFashion', res.data )
      });
    },
  }
</script>

<style scoped>

</style>
