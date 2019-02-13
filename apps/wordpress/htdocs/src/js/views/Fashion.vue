<template>
  <div>
    <ul class="p-main-grid">
      <li v-for="item in fashion" :key="item.id">
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
      fashion (){
        return this.$store.state.fashions
      },
    },
    watch: {
      count: function () {
        if(this.fashion.length < this.count) {
          this.moreView = true
        } else {
          this.moreView = false
        }
      },
      fashion: function () {
        if(this.fashion.length < this.count) {
          this.moreView = true
        } else {
          this.moreView = false
        }
      }
    },
    mounted() {
      this.$store.dispatch('getFashion').then((res)=>{
        this.$store.commit('getFashion', res.data )
      });
      this.$store.dispatch('getCategory').then((res)=> {
        this.$store.commit('getCategory', res.data);
        const fashionLength = this.$store.state.categories.find(function(category){
          return category.slug === 'fashion';
        });
        this.count = fashionLength.count;
      })
    },
    methods: {
      moreBtn: function () {
        this.loading = true;
        this.offSet = this.offSet + 14;
        this.$store.dispatch('getFashionMore',this.offSet).then((res)=>{
          this.$store.commit('getFashionMore', res.data );
          if(this.fashion.length >= this.count) {
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
