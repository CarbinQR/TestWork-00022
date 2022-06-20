<template>
  <header-component></header-component>
  <router-view></router-view>
  <footer-component></footer-component>
</template>

<script>
import HeaderComponent from "@/components/template/HeaderComponent";
import FooterComponent from "@/components/template/FooterComponent";

export default {
  name: 'App',
  components: {
    HeaderComponent,
    FooterComponent,
  }
}
</script>

<style>

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
