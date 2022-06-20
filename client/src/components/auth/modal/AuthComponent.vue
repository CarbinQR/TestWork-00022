<template>
  <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">
          <h2 class="fw-bold mb-0">Login with email</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body p-5 pt-0">
          <form @submit.prevent="submitForm">
            <div class="form-floating mb-3">
              <input
                  type="email"
                  class="form-control rounded-3"
                  id="InputEmailLogin"
                  placeholder="name@example.com"
                  v-model="loginData.email"
              >
              <label for="InputEmailLogin">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input
                  type="password"
                  class="form-control rounded-3"
                  id="InputPasswordLogin"
                  placeholder="Password"
                  v-model="loginData.password"
              >
              <label for="InputPasswordLogin">Password</label>
            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {email, minLength, required} from '@vuelidate/validators';
import * as actions from '@/store/modules/auth/types/actions';
import { Modal } from 'bootstrap';
import {mapActions} from 'vuex';
import useVuelidate from '@vuelidate/core';
import notificationMixin from '@/mixins/notificationMixin'

export default {
  name: 'AuthComponent',
  setup: () => ({ v$: useVuelidate() }),
  data() {
    return {
      loginData: {
        email: '',
        password: '',
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
    validationLoginForm() {
      this.$v.$touch();
      return this.$v.$invalid;
    },
    async submitForm(){
      try {
        await this.signIn(this.loginData);
        notificationMixin('Success login', 'success');
        Modal.getInstance('#login')?.hide();
      } catch (error) {
        notificationMixin(error, 'error');
      }
    },
  }
};
</script>
