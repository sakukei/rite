<template>
  <div>
    <h1>Traveler</h1>
    {{posts}}
  </div>
</template>

<script>
  export default {
    props:['posts','getCategory'],
    mounted () {
      console.log(this.posts)
    }
  }
</script>

<style scoped>

</style>
