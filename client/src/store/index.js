import Vuex from 'vuex';
import AuthService from './modules/auth';
import notification from './modules/notification';

export default new Vuex.Store({
  modules: {
    AuthService,
    notification,
  }
});
