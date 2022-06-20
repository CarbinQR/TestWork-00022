import * as actions from './types/actions';
import * as mutations from './types/mutations';
import notificationMixin from "@/mixins/notificationMixin";
import AuthService from '@/services/auth/AuthService';

export default {
    [actions.SIGN_UP_USER]: async ({dispatch}, data) => {
        try {
            await AuthService.signUp(data);
            dispatch(actions.FETCH_LOGGED_USER);
        } catch (error) {
            notificationMixin(error, "error");
        }
    },
    [actions.SIGN_IN]: async ({dispatch}, loginData) => {
        try {
            await AuthService.signIn(loginData);
            dispatch(actions.FETCH_LOGGED_USER);
        } catch (error) {
            notificationMixin(error, "error");
        }
    },
    [actions.FETCH_LOGGED_USER]: async ({commit}) => {
        try {
            const fetchUserResponse = await AuthService.fetchLoggedUser();
            commit(mutations.SET_LOGGED_USER, fetchUserResponse);
        } catch (error) {
            notificationMixin("User not authorized", "error");
        }
    },
    [actions.SIGN_OUT]: async ({commit}) => {
        try {
            await AuthService.signOut();
            commit(mutations.USER_LOGOUT);
        } catch (error) {
            notificationMixin("error", "error");
        }
    }
};
