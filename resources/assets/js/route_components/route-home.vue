<template>
  <div class="Layout-container">

    <nav-bar></nav-bar>
    <router-view></router-view>

  </div>
</template>
<script>

  import NavBar from '../components/NavBar.vue';

  export default {
    created () {
      document.body.classList.add('main');
    },
    beforeDestroy () {
      document.body.classList.remove('main');
    },
    components: {
      'nav-bar': NavBar
    }
  }
</script>