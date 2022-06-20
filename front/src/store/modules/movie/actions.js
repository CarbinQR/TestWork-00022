import * as actions from './types/actions';
import * as mutations from './types/mutations';
import notificationMixin from "@/mixins/notificationMixin";
import MovieService from "@/services/movie/MovieService";
import {CLEAR_MOVIES_LIST} from "./types/actions";

export default {
    [actions.ADD_MOVIE]: async ({dispatch}, data) => {
        try {
            await MovieService.addMovie(data);
            dispatch(actions.FETCH_MOVIES_LIST);
        } catch (error) {
            notificationMixin(error, "error");
        }
    },
    [actions.FETCH_MOVIE]: async ({commit}, movieId) => {
        try {
            let response = await MovieService.fetchMovie(movieId);
            commit(mutations.SET_MOVIE, response);
        } catch (error) {
            notificationMixin(error, "error");
        }
    },
    [actions.FETCH_MOVIES_LIST]: async ({commit}) => {
        try {
            let response =  await MovieService.fetchMoviesList();
            commit(mutations.SET_MOVIES_LIST, response);
        } catch (error) {
            notificationMixin(error, "error");
        }
    },
    [actions.FETCH_MOVIES_LIST_BY_USER]: async ({commit}, userId = null) => {
        try {
            let response = await MovieService.fetchMoviesListByUser(userId);
            commit(mutations.SET_MOVIES_LIST, response);
        } catch (error) {
            notificationMixin(error, "error");
        }
    },
    [actions.UPDATE_MOVIE]: async ({dispatch}, movieId = null) => {
        try {
            let response = await MovieService.updateMovie(movieId);
            dispatch(actions.FETCH_MOVIE, response.id);
        } catch (error) {
            notificationMixin("error", "error");
        }
    },
    [actions.DELETE_MOVIE]: async ({dispatch}, movieId) => {
        try {
            await MovieService.deleteMovie(movieId);
            dispatch(actions.FETCH_MOVIES_LIST);
        } catch (error) {
            notificationMixin(error, "error");
        }
    },
    [actions.CLEAR_MOVIES_LIST]: async ({commit}) => {
        try {
            commit(mutations.CLEAR_MOVIES_LIST);
        } catch (error) {
            notificationMixin(error, "error");
        }
    },
};
