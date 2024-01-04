<template>
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" v-if="showBadge">
    {{ count }}
    <span class="visually-hidden">przedmiotów w koszyku</span>
  </span>
</template>

<script>
export default {
  name: "CartIndicator",
  props: {
    cartCount: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      count: 0,
    }
  },
  mounted() {
    this.count = this.cartCount;

    this.$root.$on('cart-updated', (value) => {
      this.count = +value;
    });
  },
  computed: {
    showBadge() {
      return this.count > 0;
    },
  },
}
</script>


<style scoped>

</style>