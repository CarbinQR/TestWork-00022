import * as getters from './types/getters';

export default {
  [getters.GET_MOVIE]: state => state.movie,
  [getters.GET_MOVIES_LIST]: state => state.moviesList
};
