import * as actions from './types/actions';
import * as mutations from './types/mutations';
import UserService from '@/services/user-service/UserService';
import * as notificationActions from '@/store/modules/notification/types/actions';

export default {
  [actions.GET_USERS]: async ({ commit, dispatch }) => {
    try {
      const users = await UserService.getAllUsers();
      commit(mutations.SET_USERS, users);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  },
  [actions.GET_USER]: async ({ commit, dispatch }, userId) => {
    try {
      const user = await UserService.getUserById(userId);
      commit(mutations.SET_USER, user);
    } catch (error) {
      dispatch(
        'notification/' + notificationActions.SET_ERROR_NOTIFICATION,
        error,
        { root: true }
      );
    }
  }
};
