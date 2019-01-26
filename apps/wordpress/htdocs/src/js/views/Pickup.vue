<template>
  <div>
    <div class="p-feature-pickup">
      <swiper class="p-feature-pickup__list">
        <swiper-slide v-for="item in featurePickup" :key="item.id">
          <a :href="item.link">
            <div class="p-feature-pickup__image"><img :src="item.featured_image.src"/></div>
            <p class="p-feature-pickup__title">{{item.title.rendered}}</p>
            <p class="p-feature-pickup__text">{{item.excerpt.rendered.slice(0,20)}}</p>
          </a>
        </swiper-slide>
      </swiper>
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
  import 'swiper/dist/css/swiper.css';
  import { swiper, swiperSlide } from 'vue-awesome-swiper';
  export default {
    props:['getCategory'],
    components: {
      swiper,
      swiperSlide
    },
    data() {
      return {
        swiperOption: {

        }
      }
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
  .p-feature-pickup__title {
    margin: 10px 0;
    font-size: 18px;
    line-height: 1.5;
    font-weight: bold;
  }
  .swiper-container {
    width: 100%;
    height: 100%;
  }
  .swiper-slide {
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .p-feature-pickup__image {
    height: 150px;
    img {
      object-fit: cover;
      height: 100%;
      width: 100%;
      border-radius: 15px;
    }
  }

</style>
