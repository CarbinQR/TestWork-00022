import { createStore } from 'vuex'
import AuthService from './modules/auth';
import MovieService from './modules/movie';

export default new createStore({
  modules: {
    AuthService,
    MovieService
  }
});
