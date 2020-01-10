<template>
  <b-nav vertical class="w-100 p-3">
    <b-nav-item :to="{ name: 'Home' }"><i class="fas fa-home"></i> Home</b-nav-item>
    <b-nav-item :to="{ name: 'ProjectIndex' }"><i class="fas fa-project-diagram"></i> Projetos</b-nav-item>
    <b-nav-item :to="{ name: 'EmployeeIndex' }"><i class="fas fa-user-friends"></i> Funcionários</b-nav-item>
  </b-nav>
</template>

<script>

export default {
  name: 'Menu'
}
</script>

<style>
</style>
