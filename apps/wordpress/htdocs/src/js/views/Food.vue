<template>
  <div>
    <ul class="p-main-grid">
      <li v-for="item in food" :key="item.id">
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
      food (){
        return this.$store.state.foods
      },
    },
    mounted() {
      this.$store.dispatch('getFood').then((res)=>{
        this.$store.commit('getFood', res.data )
      });
      this.$store.dispatch('getCategory').then((res)=> {
        this.$store.commit('getCategory', res.data);
        const foodLength = this.$store.state.categories.find(function(category){
          return category.slug === 'food';
        });
        this.count = foodLength.count;
      })
    },
    watch: {
      count: function () {
        if(this.food.length < this.count) {
          this.moreView = true
        } else {
          this.moreView = false
        }
      },
      food: function () {
        if(this.food.length < this.count) {
          this.moreView = true
        } else {
          this.moreView = false
        }
      }
    },
    methods: {
      moreBtn: function () {
        this.loading = true;
        this.offSet = this.offSet + 14;
        this.$store.dispatch('getFoodMore',this.offSet).then((res)=>{
          this.$store.commit('getFoodMore', res.data );
          if(this.food.length >= this.count) {
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
