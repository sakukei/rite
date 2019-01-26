<template>
  <div>
    <div class="p-feature-pickup">
      <ul class="p-feature-pickup__list">
        <li v-for="item in featurePickup" :key="item.id">
          <a :href="item.link">
            <div><img :src="item.featured_image.src"/></div>
            <p class="feature-pickup__title">{{item.title.rendered}}</p>
            <p></p>
          </a>
        </li>
      </ul>
    </div>
    <ul class="p-main-grid">
      <li v-for="item in pickupOnly" :key="item.id">
        <a :href="item.link">
          <div><img :src="item.featured_image.src"/></div>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    props:['getCategory'],
    data: function() {
      return {
      };
    },
    computed: {
      posts() {
        return this.$store.state.posts
      },
      featurePickup: function () {
          return this.getCategory('Pickup-feature', this.posts);
      },
      pickup: function () {
        return this.getCategory('Pickup', this.posts);
      },
      pickupOnly: function() {
        return this.pickup.filter(function (obj) {
          return obj.category_name.every(function (item) {
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
    vertical-align: bottom;
  }

  .p-feature-pickup {
    background-color: #f6f5f3;
    padding: 50px 0;
    overflow: auto;
    margin: 50px 0;

  }
  .p-feature-pickup__list {
    display: flex;
    width: 400%;
    justify-content: flex-start;
    li {
      width: 20%;
      margin: 0 5px;
    }
    img {
      height: 200px;
      width: 100%;
      object-fit: cover;
      border-radius: 20px;
    }
  }
  .feature-pickup__title {
    margin: 10px 0;
    font-size: 18px;
  }

</style>
