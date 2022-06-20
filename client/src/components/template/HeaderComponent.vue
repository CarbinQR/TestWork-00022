<template>
  <div class="border-bottom">
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3  container">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a>
      <nav-menu-component></nav-menu-component>
      <div class="col-md-3 text-end" v-if="!getLoggedUser">
        <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#login">
          Login
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signUp">Sign-up</button>
      </div>
      <div class="col-md-3 text-end" v-else>
        <button type="button" class="btn btn-outline-primary me-2" @click="signOutUser">
          Log out
        </button>
      </div>
      <auth-component></auth-component>
      <registration-component></registration-component>
    </header>
  </div>
</template>

<script>
import RegistrationComponent from '@/components/auth/modal/RegistrationComponent';
import AuthComponent from '@/components/auth/modal/AuthComponent';
import NavMenuComponent from '@/components/template/NavMenuComponent';
import AuthService from '@/services/auth/AuthService'
import {mapActions, mapGetters} from 'vuex';
import * as authGetters from '@/store/modules/auth/types/getters';
import * as authActions from '@/store/modules/auth/types/actions';
import notificationMixin from '@/mixins/notificationMixin';


export default {
  name: 'HeaderComponent',
  data() {
    return {
      user: null
    }
  },
  components: {
    RegistrationComponent,
    AuthComponent,
    NavMenuComponent
  },
  computed: {
    ...mapGetters('AuthService', {
      getLoggedUser: authGetters.GET_LOGGED_USER
    })
  },
  methods: {
    ...mapActions('AuthService', {
      fetchLoggedUser: authActions.FETCH_LOGGED_USER,
      signOut: authActions.SIGN_OUT,
    }),
    async signOutUser() {
      try {
        await this.signOut();
      } catch (error) {
        notificationMixin(error, 'error')
      }
    },
    async checkLoggedUser() {
      if (AuthService.getToken()) {
        await this.fetchLoggedUser();
      }
    }
  },
  mounted() {
    this.checkLoggedUser()
  }
}
</script>