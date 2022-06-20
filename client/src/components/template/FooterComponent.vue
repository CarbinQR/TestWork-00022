<template>
  <div class="border-top footer">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 container ">
      <p class="col-md-4 mb-0 text-muted">© 2022 Company, Inc</p>

      <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      </a>

      <nav-menu-component></nav-menu-component>
    </footer>
  </div>

</template>

<script>
import NavMenuComponent from "@/components/template/NavMenuComponent";

export default {
  name: 'FooterComponent',
  components: {
    NavMenuComponent
  }
}
</script>