<template>

  <div class="Layout-container">

    <cart-preview></cart-preview>
    <router-view></router-view>

  </div>
</template>
<script>

  import CartPreview from '../components/CartPreview.vue';

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
    components: {
      'cart-preview': CartPreview
    }
  }
</script>