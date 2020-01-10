<template>
  <div>
    <h2>Bem vindo ao {{ systemName }}</h2>
  </div>
</template>

<script>
export default {
  name: 'Home',
  computed: {
    systemName () {
      return process.env.VUE_APP_SYSTEM_NAME
    }
  }
}
</script>
