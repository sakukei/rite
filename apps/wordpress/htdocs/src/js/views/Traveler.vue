<template>
  <div class="l-inner">
    <section class="p-grid-section traveler-section" v-bind:class="{'is-hidden': display}">
      <div class="p-traveler-name -ayumi">AYUMI</div>
      <ul class="p-sub-grid">
        <li v-for="item in ayumi" :key="item.id">
          <a :href="item.link">
            <img :src="item.featured_image.src" class="c-grid-img"/>
            <ul class="p-tag-list">
              <li v-for="tag in item.tag_name" v-bind:class="tag" class="p-tag-lite__item">
                {{tag}}
              </li>
            </ul>
          </a>
        </li>
        <li>
          <a :href="ayumiLink">
            <img :src="ayumiLast" />
            <div class="p-more"><span>もっとみる</span></div>
          </a>
        </li>
      </ul>
    </section>
    <section class="p-grid-section traveler-section" v-bind:class="{'is-hidden': display}">
      <div class="p-traveler-name -hitomi">良野仁美</div>
      <ul class="p-sub-grid">
        <li v-for="item in hitomi" :key="item.id">
          <a :href="item.link">
            <img :src="item.featured_image.src" class="c-grid-img"/>
            <ul class="p-tag-list">
              <li v-for="tag in item.tag_name" v-bind:class="tag" class="p-tag-lite__item">
                {{tag}}
              </li>
            </ul>
          </a>
        </li>
        <li>
          <a :href="hitomiLink">
            <img :src="hitomiLast" />
            <div class="p-more"><span>もっとみる</span></div>
          </a>
        </li>
      </ul>
    </section>
    <section class="p-grid-section traveler-section" v-bind:class="{'is-hidden': display}">
      <div class="p-traveler-name -chiha">chiha</div>
      <ul class="p-sub-grid">
        <li v-for="item in chiha" :key="item.id">
          <a :href="item.link">
            <img :src="item.featured_image.src" class="c-grid-img"/>
            <ul class="p-tag-list">
              <li v-for="tag in item.tag_name" v-bind:class="tag" class="p-tag-lite__item">
                {{tag}}
              </li>
            </ul>
          </a>
        </li>
        <li>
          <a :href="chihaLink">
            <img :src="chihaLast" />
            <div class="p-more"><span>もっとみる</span></div>
          </a>
        </li>
      </ul>
    </section>
    <section class="p-grid-section traveler-section" v-bind:class="{'is-hidden': display}">
      <div class="p-traveler-name -yuika">yu.i.k.a</div>
      <ul class="p-sub-grid">
        <li v-for="item in yuika" :key="item.id">
          <a :href="item.link">
            <img :src="item.featured_image.src" class="c-grid-img"/>
            <ul class="p-tag-list">
              <li v-for="tag in item.tag_name" v-bind:class="tag" class="p-tag-lite__item">
                {{tag}}
              </li>
            </ul>
          </a>
        </li>
        <li>
          <a :href="yuikaLink">
            <img :src="yuikaLast" />
            <div class="p-more"><span>もっとみる</span></div>
          </a>
        </li>
      </ul>
    </section>
    <section class="p-grid-section traveler-section" v-bind:class="{'is-hidden': display}">
      <div class="p-traveler-name -aya">長谷川あや</div>
      <ul class="p-sub-grid">
        <li v-for="item in aya" :key="item.id">
          <a :href="item.link">
            <img :src="item.featured_image.src" class="c-grid-img"/>
            <ul class="p-tag-list">
              <li v-for="tag in item.tag_name" v-bind:class="tag" class="p-tag-lite__item">
                {{tag}}
              </li>
            </ul>
          </a>
        </li>
        <li>
          <a :href="ayaLink">
            <img :src="ayaLast" />
            <div class="p-more"><span>もっとみる</span></div>
          </a>
        </li>
      </ul>
    </section>
    <section class="p-grid-section traveler-section" v-bind:class="{'is-hidden': display}">
      <div class="p-traveler-name -nami">なみ</div>
      <ul class="p-sub-grid">
        <li v-for="item in nami" :key="item.id">
          <a :href="item.link">
            <img :src="item.featured_image.src" class="c-grid-img"/>
            <ul class="p-tag-list">
              <li v-for="tag in item.tag_name" v-bind:class="tag" class="p-tag-lite__item">
                {{tag}}
              </li>
            </ul>
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
        namiLink: '',
        ayaLast: '',
        ayaLink: '',
        ayumiLast: '',
        ayumiLink: '',
        hitomiLast: '',
        hitomiLink: '',
        chihaLast: '',
        chihaLink: '',
        yuikaLast: '',
        yuikaLink: '',
        display: true,
        namiPostLength: '',
        ayaPostLength: '',
        ayumiPostLength: '',
        hitomiPostLength: '',
        chihaPostLength: '',
        yuikaPostLength: ''
      }
    },
    computed: {
      nami() {
        const posts = this.$store.state.namis;
        return posts;
      },
      aya() {
        const posts = this.$store.state.ayas;
        return posts;
      },
      chiha() {
        const posts = this.$store.state.chihas;
        return posts;
      },
      ayumi() {
        const posts = this.$store.state.ayumis;
        return posts;
      },
      hitomi() {
        const posts = this.$store.state.hitomis;
        return posts;
      },
      yuika() {
        const posts = this.$store.state.yuikas;
        return posts;

      }
    },
    mounted() {
      this.$store.dispatch('getNami').then((res)=>{
        this.$store.commit('getNami', res.data );
        this.namiPostLength = this.$store.state.namis.length;
        this.namiLast = this.$store.state.namis.pop().featured_image.src;
      });
      this.$store.dispatch('getAya').then((res)=>{
        this.$store.commit('getAya', res.data );
        this.ayaPostLength = this.$store.state.ayas.length;
        this.ayaLast = this.$store.state.ayas.pop().featured_image.src;
      });
      this.$store.dispatch('getAyumi').then((res)=>{
        this.$store.commit('getAyumi', res.data );
        this.ayumiPostLength = this.$store.state.ayumis;
        this.ayumiLast = this.$store.state.ayumis.pop().featured_image.src;
      });
      this.$store.dispatch('getChiha').then((res)=>{
        this.$store.commit('getChiha', res.data );
        this.chihaPostLength = this.$store.state.chihas.length;
        this.chihaLast = this.$store.state.chihas.pop().featured_image.src;
      });
      this.$store.dispatch('getYuika').then((res)=>{
        this.$store.commit('getYuika', res.data );
        this.yuikaPostLength = this.$store.state.yuikas.length;
        this.yuikaLast = this.$store.state.yuikas.pop().featured_image.src;
      });
      this.$store.dispatch('getHitomi').then((res)=>{
        this.$store.commit('getHitomi', res.data );
        this.hitomiPostLength = this.$store.state.hitomis.length;
        this.hitomiLast = this.$store.state.hitomis.pop().featured_image.src;
      });
      this.$store.dispatch('getCategory').then((res)=>{
        this.$store.commit('getCategory', res.data );

        const nami = this.$store.state.categories.find(function(category){
          return category.slug === 'nami';
        });
        this.namiLink = nami.link;

        const aya = this.$store.state.categories.find(function(category){
          return category.slug === 'aya';
        });
        this.ayaLink = aya.link;

        const chiha= this.$store.state.categories.find(function(category){
          return category.slug === 'chiha';
        });
        this.chihaLink = chiha.link;

        const yuika = this.$store.state.categories.find(function(category){
          return category.slug === 'yuika';
        });
        this.yuikaLink = yuika.link;

        const hitomi = this.$store.state.categories.find(function(category){
          return category.slug === 'hitomi';
        });
        this.hitomiLink = hitomi.link;

        const ayumi = this.$store.state.categories.find(function(category){
          return category.slug === 'ayumi';
        });
        this.ayumiLink = ayumi.link;
        this.display = false
      })
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
    grid-template-columns: repeat(3,1fr);
    grid-template-rows: repeat(2,1fr) max-content;
    gap: 3px;
    li {
      position: relative;
      &:first-child {
        grid-column: span 2;
        grid-row: span 2;
       }
      &:last-child {
        a {
          position: relative;
          display: block;
          height: 100%;
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
