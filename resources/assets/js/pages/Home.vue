<template>

  <div class="Layout-container">

    <nav-bar></nav-bar>
    <router-view></router-view>

  </div>
</template>
<script>

  import NavBar from '../components/NavBar.vue';

  function hasParentClass(e, class_name) {

    if (e === document) {
      return false
    }

    if (e.classList.contains(class_name)) {
      return true;
    }

    return e.parentNode && hasParentClass(e.parentNode, class_name);

  }

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