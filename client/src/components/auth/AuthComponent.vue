<template>
  <h1>"kljljkl</h1>
</template>

<script>
import * as notificationActions from '@/store/modules/notification/types/actions';
import { required, minLength, email } from '@vuelidate/validators';
import * as actions from '@/store/modules/auth/types/actions';
import { mapActions } from 'vuex';

export default {
  name: 'AuthComponent',
  data() {
    return {
      clickedEmail: false,
      clickedPassword: false,
      loginData: {
        email: '',
        password: ''
      }
    };
  },
  validations: {
    loginData: {
      email: {
        required,
        email
      },
      password: {
        required,
        minLength: minLength(8)
      }
    }
  },
  methods: {
    ...mapActions('AuthService', {
      fetchLoggedUser: actions.FETCH_LOGGED_USER,
      signIn: actions.SIGN_IN,
      signInByProvider: actions.SIGN_IN_BY_PROVIDER
    }),
    ...mapActions('notification', {
      setErrorNotification: notificationActions.SET_ERROR_NOTIFICATION
    }),

    clickEmail() {
      this.clickedEmail = true;
    },
    clickPassword() {
      this.clickedPassword = true;
    },
    validationLoginForm() {
      this.$v.$touch();
      return this.$v.$invalid;
    },
    async login() {
      if (!this.validationLoginForm()) {
        try {
          await this.signIn(this.loginData);
          await this.fetchLoggedUser();

          await this.$router.push({ name: 'Index' });
        } catch (error) {
          this.setErrorNotification(error);
        }
      }
    },
    async socialite(provider) {
      await this.signInByProvider(provider);
    }
  }
};
</script>

<style scoped></style>
