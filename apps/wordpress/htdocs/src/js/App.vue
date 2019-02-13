<template>
  <div>
    <nav class="p-category-nav">
      <ul class="p-category-list">
        <li><router-link class="-spot" to ='/spot'><span class="p-category-list-name">spot</span></router-link></li>
        <li><router-link class="-food" to ='/food'><span class="p-category-list-name">food</span></router-link></li>
        <li><router-link class="-fashion" to ='/fashion'><span class="p-category-list-name">fashion</span></router-link></li>
        <li><router-link class="-pickup" to ='/'><span class="p-category-list-name">pickup</span></router-link></li>
        <!--<li><router-link class="-country" to ='/country'><span class="p-category-list-name">Country</span></router-link></li>-->
        <li><router-link class="-traveler" to ='/traveler'><span class="p-category-list-name">traveler</span></router-link></li>
        <li><router-link class="-all" to ='/all'><span class="p-category-list-name">all</span></router-link></li>
      </ul>
    </nav>
    <router-view />
  </div>
</template>
<script>

  export default {
    data () {
      return {
      }
    },
  }
</script>

<style lang="scss">
.p-main-grid {
  display: grid;
  grid-template-columns: repeat(2,1fr);
  gap: 4px;
  padding: 0 4px;
  li {
    position: relative;
    &:nth-child(5n){
      grid-column: span 2;
      grid-row: span 2;
    }
  }
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    vertical-align: bottom;
    border-radius: 5px;
  }
}
</style>


