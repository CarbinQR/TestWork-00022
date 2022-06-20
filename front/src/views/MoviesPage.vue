<template>
  <div class="my-4 container">
    <div class="row justify-content-end mb-4">
      <div class="col-8">
        <h2>My movies page</h2>
      </div>
      <div class="col-2">
        <div class="row">
          <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#movieForm">
            Add movie
          </button>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-5" v-if="moviesList.length !== 0">
      <div class="col" v-for="movie in moviesList" :key="movie.id">
        <div class="card h-100">
          <span
              class="badge rounded-pill bg-success position-absolute top-0 start-100 translate-middle"
              v-show="movie.isLiked"
          >
            Liked
          </span>
          <img src="@/assets/images/cinema.jpg" class="card-img-top" alt="movie-logo">
          <router-link :to="{ name: 'showMovieDetails', params: { id: movie.id }}"
                       class="card-body text-decoration-none">
            <h5 class="card-title text-decoration-none">{{ movie.name }}</h5>
            <p class="card-text text-decoration-none">{{ truncateDescriptionText(movie.description) }}</p>
          </router-link>
          <div class="card-footer">
            <small class="text-muted">Release: {{ movie.releaseDate }}</small>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-5" v-else>
      <h2>Movies not found</h2>
    </div>
    <movie-form-component></movie-form-component>
  </div>
</template>

<script>
import MovieFormComponent from "@/components/movie/modal/MovieFormComponent";
import {mapActions, mapGetters} from "vuex";
import * as movieGetters from "@/store/modules/movie/types/getters";
import * as movieActions from "@/store/modules/movie/types/actions";
import * as authActions from "@/store/modules/auth/types/actions";
import * as authGetters from "@/store/modules/auth/types/getters";

export default {
  name: 'MoviesPage',
  components: {
    MovieFormComponent
  },
  data() {
    return {
      moviesList: {},
    }
  },
  computed: {
    ...mapGetters('MovieService', {
      moviesListData: movieGetters.GET_MOVIES_LIST
    }),
    ...mapGetters('AuthService', {
      loggedUser: authGetters.GET_LOGGED_USER
    }),
  },
  methods: {
    ...mapActions('AuthService', {
      fetchLoggedUser: authActions.FETCH_LOGGED_USER
    }),
    ...mapActions('MovieService', {
      fetchMoviesListData: movieActions.FETCH_MOVIES_LIST_BY_USER,
      clearList: movieActions.CLEAR_MOVIES_LIST
    }),
    async formatMoviesListData() {
      await this.fetchLoggedUser();
      await this.fetchMoviesListData(this.loggedUser.id);
      this.moviesList = this.moviesListData.items;
    },
    truncateDescriptionText(text, length = 250, suffix = "...") {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      }
      return text;
    }
  },
  mounted() {
    this.formatMoviesListData();
  },
  unmounted() {
    this.clearList();
  }
}
</script>

<style scoped>
img {
  max-width: 300px;
  max-height: 250px;
}
</style>
