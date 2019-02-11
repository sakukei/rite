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
      <li v-for="item in pickup" :key="item.id">
        <a :href="item.link">
          <img :src="item.featured_image.src"/>
        </a>
      </li>
    </ul>
    <div v-if="loading" class="loader">Loading...</div>
    <div class="p-more">
      <button v-on:click="moreBtn" class="p-more-btn" v-if="moreView">LOAD MORE…</button>
    </div>
    </div>
</template>

<script>
  import 'swiper/dist/css/swiper.css';
  import { swiper, swiperSlide } from 'vue-awesome-swiper';
  export default {
    components: {
      swiper,
      swiperSlide
    },
    data() {
      return {
        swiperOption: {

        },
        offSet: 15,
        count:'',
        loading: false,
        moreView: false
      }
    },
    computed: {
      pickup(){
        return this.$store.state.pickups
      },
      featurePickup(){
        return this.$store.state.featurePickups
      }
    },
    mounted() {
      this.$store.dispatch('getPickup').then((res)=>{
        this.$store.commit('getPickup', res.data )
      });
      this.$store.dispatch('getFeaturePickup').then((res)=>{
        this.$store.commit('getFeaturePickup', res.data )
      });
      this.$store.dispatch('getCategory').then((res)=> {
        this.$store.commit('getCategory', res.data);
        const pickupLength = this.$store.state.categories.find(function(category){
          return category.slug === 'pickup';
        });
        this.count = pickupLength.count;
        if(this.pickup.length < this.count) {
          this.moreView = true
        }
      })
        },
    methods: {
      moreBtn: function () {
        this.loading = true;
        this.offSet = this.offSet + 14;
        this.$store.dispatch('getPickupMore',this.offSet).then((res)=>{
          this.$store.commit('getPickupMore', res.data );
          if(this.pickup.length >= this.count) {
            this.moreView = false
          }
          this.loading = false
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
    padding: 40px 0 24px;
    overflow: auto;
    margin: 24px 0 40px;

  }
  .p-feature-pickup__title {
    padding: 24px 40px 0;
    font-size: 16px;
    line-height: 28px;
  }
  .p-feature-pickup__text {
    padding-top: 4px;
    font-size: 12px;
    line-height: 16px;
  }
  .swiper-container {
    width: 100%;
    height: 100%;
  }
  .swiper-wrapper {
    /*width: 256px;*/
    /*margin: 0 auto;*/
  }
  .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100% !important;
    margin: 0 auto;
    text-align: center;
  }
  .p-feature-pickup__image {
    width: 240px;
    height: 160px;
    margin: 0 auto;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
    border-radius: 8px;
    img {
      object-fit: cover;
      height: 100%;
      width: 100%;
      border-radius: 8px;
    }
  }
  .p-more-btn {
    display: block;
    width: 100%;
    background-color: #efeee9;
    font-size: 14px;
    padding: 15px 0;
    text-align: center;
    color: #4a626f;
    border: 0;
  }

  .p-more {
    padding: 0 4px;
    margin: 15px 0 0;
  }

  .loader {
    font-size: 10px;
    margin: 15px auto;
    text-indent: -9999em;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #898989;
    background: -moz-linear-gradient(left, #898989 10%, rgba(137,137,137, 0) 42%);
    background: -webkit-linear-gradient(left, #898989 10%, rgba(137,137,137, 0) 42%);
    background: -o-linear-gradient(left, #898989 10%, rgba(137,137,137, 0) 42%);
    background: -ms-linear-gradient(left, #898989 10%, rgba(137,137,137, 0) 42%);
    background: linear-gradient(to right, #898989 10%, rgba(137,137,137, 0) 42%);
    position: relative;
    -webkit-animation: load3 1.4s infinite linear;
    animation: load3 1.4s infinite linear;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
  }
  .loader:before {
    width: 50%;
    height: 50%;
    background: #898989;
    border-radius: 100% 0 0 0;
    position: absolute;
    top: 0;
    left: 0;
    content: '';
  }
  .loader:after {
    background: #ffffff;
    width: 75%;
    height: 75%;
    border-radius: 50%;
    content: '';
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
  }
  @-webkit-keyframes load3 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  @keyframes load3 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }



</style>
