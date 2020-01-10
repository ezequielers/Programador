<template>
  <header class="header">
    <a v-if="!toogle" href="javascript:void(0);" class="toggle" @click.prevent="handlerMenuState">
      <i class="fas fa-2x fa-bars"></i>
    </a>
    <h1 class="title">
      <router-link to="/">{{ title }}</router-link>
    </h1>
  </header>
</template>

<script>
export default {
  name: 'Header',
  props: {
    title: {
      type: String,
      required: true
    },
    toogle: {
      type: Boolean,
      default: false
    },
    userMenu: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    async handlerMenuState () {
      await this.$store.dispatch('setStateMenu')
    }
  }
}
</script>
