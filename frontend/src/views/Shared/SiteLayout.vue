<template>
  <div class="app" :class="{'hide-menu': !hideMenu}">
    <Header title="Gerenciamento Básico de Projetos"></Header>
    <Menu v-if="hideMenu" />
    <div class="content">
      <transition name="fade" mode="out-in">
        <router-render />
      </transition>
    </div>
    <Footer />
  </div>
</template>

<script>
import RouterRender from './RouterRender.vue'
import Menu from './Menu'
import Header from './Header.vue'
import Footer from './Footer.vue'

// CSS
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import '@/assets/css/default.css'
import '@fortawesome/fontawesome-free/css/all.min.css'

export default {
  name: 'SiteLayout',
  components: {
    RouterRender,
    Header,
    Menu,
    Footer
  },
  computed: {
    hideMenu () {
      return this.$store.getters.getStateMenu
    }
  }
}
</script>

<style>
  .fade-enter-active,
  .fade-leave-active {
    transition-duration: 0.3s;
    transition-property: opacity;
    transition-timing-function: ease;
  }

  .fade-enter,
  .fade-leave-active {
    opacity: 0
  }
</style>
