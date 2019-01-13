<template>
  <div>
    <nav>
      <router-link to ='/'>Pickup</router-link>
      <router-link to ='/traveler'>Traveler</router-link>
      <router-link to ='/country'>Country</router-link>
      <router-link to ='/fashion'>Fashion</router-link>
      <router-link to ='/food'>Food</router-link>
      <router-link to ='/spot'>Spot</router-link>
      <router-link to ='/all'>All</router-link>
    </nav>
    <router-view />
  </div>
</template>

<script>
  export default {
    created(){
      console.log(this.$store.state.count)
      this.$store.commit('increment')
      console.log(this.$store.state.count)
    }
  }
</script>

<style scoped lang="scss">
</style>


