<template>
  <div>
    <ul class="p-main-grid">
      <li v-for="item in spot" :key="item.id">
        <a :href="item.link">
          <img :src="item.featured_image.src"/>
          <ul class="p-tag-list">
            <li v-for="tag in item.tag_name" v-bind:class="tag" class="p-tag-lite__item">{{tag}}</li>
          </ul>
          <p class="p-tag__price">{{item.tag_price}}</p>
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
  export default {
    data() {
      return {
        offSet: 15,
        count: '',
        loading: false,
        moreView: false
      }
    },
    computed: {
      spot (){
        return this.$store.state.spots
      }
    },
    watch: {
      count: function () {
        if(this.spot.length < this.count) {
          this.moreView = true
        } else {
          this.moreView = false
        }
      },
      spot: function () {
        if(this.spot.length < this.count) {
          this.moreView = true
        } else {
          this.moreView = false
        }
      }
    },
    mounted() {
      this.$store.dispatch('getSpot').then((res)=>{
        this.$store.commit('getSpot', res.data )
      });
      this.$store.dispatch('getCategory').then((res)=> {
        this.$store.commit('getCategory', res.data);
        const spotCategory = this.$store.state.categories.filter(function(category){
          return category.slug === 'spot' || category.slug === 'spot-item';
        });
        const spotLength = spotCategory.reduce(function(previous,category){
          return previous + category.count;
        },0);
        this.count = spotLength;
      })
    },
    methods: {
      moreBtn: function () {
        this.loading = true;
        this.offSet = this.offSet + 14;
        this.$store.dispatch('getSpotMore',this.offSet).then((res)=>{
          this.$store.commit('getSpotMore', res.data );
          if(this.spot.length >= this.count) {
            this.moreView = false
          }
          this.loading = false
        })
      },
    },
  }
</script>

<style scoped>

</style>
