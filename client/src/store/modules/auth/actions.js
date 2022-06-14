import * as actions from './types/actions';
import * as mutations from './types/mutations';
import * as notificationActions from '@/store/modules/notification/types/actions';
import AuthService from '@/services/auth/AuthService';

export default {
  [actions.REGISTER_USER]: async ({ dispatch }, registerData) => {
    try {
      await AuthService.registerUser(registerData);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.SIGN_IN]: async ({ dispatch }, loginData) => {
    try {
      await AuthService.signIn(loginData);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.FETCH_LOGGED_USER]: async ({ commit, dispatch }) => {
    try {
      const fetchUserResponse = await AuthService.fetchLoggedUser();
      commit(mutations.SET_LOGGED_USER, fetchUserResponse);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.SIGN_OUT]: async ({ commit, dispatch }) => {
    try {
      await AuthService.signOut();
      commit(mutations.USER_LOGOUT);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  }
};
