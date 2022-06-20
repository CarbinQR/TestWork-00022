<template>
  <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 nav-pills">
    <li v-for="(navItem, index) in navItems" :key=index>
      <router-link
          :to="{ name: navItem.routerName }"
          class="nav-link px-2"
          :class="[ navItem.routerName === this.$route.name ? 'active' : '']"
      >
        {{ navItem.label }}
      </router-link>
    </li>
  </ul>
</template>

<script>

export default {
  name: 'NavMenuComponent',
  data() {
    return {
      navItems: {
        1: {
          label: 'Home',
          routerName: 'index',
        },
        2: {
          label: 'My movies',
          routerName: 'movies',
        },
      },
    }
  },
}
</script>