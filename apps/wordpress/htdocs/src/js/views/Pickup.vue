<template>
  <div class="test">
    <h1>Pickup</h1>
    <h2>FeaturePickup</h2>
    <ul class="feature-pickup">
      <li v-for="item in featurePickup" :key="item.id">
        <a :href="item.link">
          <div><img :src="item.featured_image.src"/></div>
          <p>{{item.title.rendered}}</p>
        </a>
      </li>
    </ul>
    <h2>Pickup</h2>
    <ul class="feature-pickup">
      <li v-for="item in pickupOnly" :key="item.id">
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
    props:['posts','getCategory'],
    data: function() {
      return {
        featurePickup: [],
        pickup: [],
        pickupOnly:[]
      };
    },
    watch: {
      posts(posts) {
        this.featurePickup = this.getCategory('Pickup-feature',posts);
        this.pickup = this.getCategory('Pickup',posts);
        this.pickupOnly = this.pickup.filter(function(obj){
          return obj.category_name.every(function(item){
            return item.indexOf('Pickup-feature') === -1;
          })
        })
      }
    }
  }
</script>

<style lang="scss">
  img {
    max-width: 100%;
  }

  .feature-pickup {
    li {
     width: 200px;
      margin: 0 0 20px;
    }
  }
</style>
