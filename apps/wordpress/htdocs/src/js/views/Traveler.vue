<template>
  <div class="l-inner">
    <section class="p-grid-section traveler-section" v-bind:class="{'is-hidden': display}">
      <div class="p-traveler-name -nami">なみ</div>
      <ul class="p-sub-grid">
        <li v-for="item in nami" :key="item.id">
          <a :href="item.link">
            <img :src="item.featured_image.src" class="c-grid-img"/>
          </a>
        </li>
        <li>
          <a :href="namiLink">
            <img :src="namiLast" />
            <div class="p-more"><span>もっとみる</span></div>
          </a>
        </li>
      </ul>
    </section>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        namiLast: '',
        namiLink: 'default',
        display: true
      }
    },
    computed: {
      nami() {
        const posts = this.$store.state.namis;
        return posts;
      },
    },
    mounted() {
        this.$store.dispatch('getCategory').then((res)=>{
        this.$store.commit('getCategory', res.data )
        const nami = this.$store.state.categories.find(function(category){
          return category.name === 'なみ';
        });
        this.namiLink = nami.link
      })
      this.$store.dispatch('getNami').then((res)=>{
        this.$store.commit('getNami', res.data )
        this.namiLast = this.$store.state.namis.pop().featured_image.src;
        this.display = false;
      });
    },
  }
</script>

<style scoped lang="scss">
  .traveler-section {
    &.is-hidden {
    display: none
    }

  }
  .p-sub-grid {
    display: grid;
    grid-template: repeat(3,1fr) / repeat(3,1fr);
    gap: 3px;
    li {
      &:first-child {
        grid-column: span 2;
        grid-row: span 2;
       }
      &:last-child {
        a {
          position: relative;
          display: block;
          &::before {
            position: absolute;
            width: 100%;
            height: 100%;
            content: '';
            background-color: rgba(0,0,0,0.6);
          }
        }
      }
    }
  }
  .c-grid-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    vertical-align: bottom;
  }
  .l-inner {
    padding: 0 4px;
  }
  .p-more {
    color: #fff;
    position: absolute;
    z-index: 2;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    margin: auto;
    font-size: 13px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>
