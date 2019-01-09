<template>
  <div>
    <nav>
      <router-link to ='/'>Pickup</router-link>
      <router-link to ='/traveler'>Traveler</router-link>
    </nav>
    <router-view />
  </div>
</template>

<script>
  export default {
    data() {
      return {
        message: 'hello'
      }
    }
  }
</script>

<style scoped>

</style>


