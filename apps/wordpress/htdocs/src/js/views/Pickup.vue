<template>
  <div class="test">
    <h1>Pickup</h1>
    <ul class="feature-pickup">
      <li v-for="item in featurePickup" :key="item.id">
        <a :href="item.link">
          <img :src="item.featured_image.src"/>
          {{item.title.rendered}}
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    props:['posts'],
    data: function() {
      return {
        featurePickup: []
      };
    },
    watch: {
      posts(posts) {
        for (let i = 0; i < posts.length; i++) {
          for (let a = 0; a < posts[i].category_name.length; a++) {
            if (posts[i].category_name[a] === 'Pickup-feature') {
              this.featurePickup.push(posts[i]);
              break;
            }
          }
        }
      }
    }
  }
</script>

<style lang="scss">
  img {
    max-width: 100%;
  }

  li {
    max-width: 100px;
  }

  .feature-pickup {
    display: flex;
    img {
      border-radius: 10px;
    }
  }
</style>
