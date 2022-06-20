import * as mutations from './types/mutations';
import { movieMapper, moviesMapper } from '../movie/normalizer';

export default {
  [mutations.SET_MOVIES_LIST]: (state, movies) => {
    state.moviesList = moviesMapper(movies);
  },
  [mutations.SET_MOVIE]: (state, movieData) => {
    state.movie = movieMapper(movieData);
  },
  [mutations.CLEAR_MOVIES_LIST]: state => {
    state.moviesList = null;
  },
};
