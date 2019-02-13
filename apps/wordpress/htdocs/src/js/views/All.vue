<template>
  <div>
    <ul class="p-main-grid">
      <li v-for="item in allPosts" :key="item.id">
        <a :href="item.link">
          <img :src="item.featured_image.src"/>
          <ul class="p-tag-list">
            <li v-for="tag in item.tag_name" v-bind:class="tag" class="p-tag-lite__item">
              {{tag}}
            </li>
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
        loading: false,
        moreView: true
      }
    },
    computed: {
      allPosts(){
        return this.$store.state.allPosts
      },
    },
    mounted() {
      this.$store.dispatch('getAllPosts').then((res)=>{
        this.$store.commit('getAllPosts', res.data )
      });
    },
    methods: {
      moreBtn: function () {
        this.loading = true;
        this.offSet = this.offSet + 14;
        this.$store.dispatch('getAllPostsMore',this.offSet).then((res)=>{
          this.$store.commit('getAllPostsMore', res.data );
          this.loading = false
        })
      }
    }
  }
</script>

<style scoped>

</style>
