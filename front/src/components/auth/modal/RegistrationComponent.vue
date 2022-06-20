<template>
  <div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">
          <h2 class="fw-bold mb-0">
            Sign up
          </h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body p-5 pt-0">
          <form class="" @submit.prevent="submitForm">
            <div class="form-floating mb-3">
              <input
                  type="text"
                  class="form-control rounded-3"
                  id="floatingInputLogin"
                  placeholder="example"
                  v-model="signUpData.login"
                  @blur="clickLogin"
              >
              <label for="floatingInputLogin">
                Login
              </label>
            </div>
            <div class="form-floating mb-3">
              <input
                  type="email"
                  class="form-control rounded-3"
                  id="floatingInputEmail"
                  placeholder="name@example.com"
                  v-model="signUpData.email"
              >
              <label for="floatingInputEmail">
                Email address
              </label>
            </div>
            <div class="form-floating mb-3">
              <input
                  type="password"
                  class="form-control rounded-3"
                  id="floatingPassword"
                  placeholder="Password"
                  v-model="signUpData.password"
              >
              <label for="floatingPassword">
                Password
              </label>
            </div>
            <div class="form-floating mb-3">
              <input
                  type="password"
                  class="form-control rounded-3"
                  id="floatingPasswordConfirm"
                  placeholder="Confirm password"
                  v-model="signUpData.passwordConfirmation"
              >
              <label for="floatingPasswordConfirm">
                Confirm password
              </label>
            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">
              Sign up
            </button>
            <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {email, maxLength, minLength, required, sameAs} from '@vuelidate/validators';
import {mapActions} from 'vuex';
import { Modal } from 'bootstrap';
import * as authActions from '@/store/modules/auth/types/actions';
import useVuelidate from '@vuelidate/core';
import notificationMixin from '@/mixins/notificationMixin';

export default {
  name: 'RegistrationComponent',
  setup() {
    return {
      v$: useVuelidate()
    }
  },
  data() {
    return {
      // v$: useValidate(),
      clickedLogin: false,
      clickedEmail: false,
      clickedPassword: false,
      clickedConfirmationPassword: false,
      signUpData: {
        login: '',
        email: '',
        password: '',
        passwordConfirmation: '',
      },
      email: "",
      password: {
        password: "",
        confirm: "",
      }
    };
  },
  validations() {
    return {
      signUpData: {
        login: {
          required,
          minLength: minLength(3),
          maxLength: maxLength(60)
        },
        email: {
          required,
          maxLength: maxLength(100),
          email
        },
        password: {
          required,
          minLength: minLength(8),
          maxLength: maxLength(60)
        },
        passwordConfirmation: {
          required,
          minLength: minLength(8),
          maxLength: maxLength(60),
          sameAsPassword: sameAs('signUpData.password')
        }
      }
    }
  },
  methods: {
    ...mapActions('AuthService', {
      signUp: authActions.SIGN_UP_USER
    }),
    validationRegisterForm() {
      this.$v.$touch();
      return this.$v.$invalid;
    },
    async submitForm() {
      try {
        await this.signUp(this.signUpData);
        Modal.getInstance('#signUp')?.hide();
        // await this.$router.go();
      } catch (error) {
        notificationMixin(error, 'error')
      }
      // this.v$.$validate() // checks all inputs
      // console.log(this.v$.signUpData.login);
      // if (!this.v$.$error) { // if ANY fail validation
      //
      //   try {
      //     await this.registerUser(this.signUpData);
      //
      //     // await this.$router.push({name: 'EmailVerification'});
      //   } catch (error) {
      //     alert(error);
      //   }
      // } else {
      //   console.log(this.v$);
      //   alert('Form failed validation')
      // }
    }
  }
};
</script>

