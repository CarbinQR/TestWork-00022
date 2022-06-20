<template>
  <div class="my-4 container">
    <div class="row justify-content-between mb-4">
      <div class="col-8 text-start position-relative">
        <h2>{{ movieData.name }}</h2>
        <span
            class="badge rounded-pill bg-success position-absolute start-0 top-0 translate-middle"
            v-show="movieData.isLiked"
        >
            Liked
          </span>
      </div>
      <div class="col-4 d-flex justify-content-end">
        <div class="mx-2">
          <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                  data-bs-target="#movieEditForm">
            Edit
          </button>
        </div>
        <div>
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal">
            Delete
          </button>
        </div>
      </div>
    </div>
    <div>
      <img src="@/assets/images/cinema.jpg" class="card-img-top" alt="movie-logo">
      <div class="card-body text-decoration-none">
        <p class="card-text text-decoration-none text-start">{{ movieData.description }}</p>
      </div>
      <div class="card-footer d-flex justify-content-between">
        <div>
          <small class="text-muted">Release: {{ movieData.releaseDate }}</small>
        </div>
        <div v-if="movieData.author">
          <small class="text-muted">Author: {{ movieData.author.login }}</small>
        </div>
      </div>
    </div>
    <movie-edit-form-component :movie-data="movieData" :user-id="$route.params.id"></movie-edit-form-component>
  </div>
</template>

<script>
import MovieEditFormComponent from "@/components/movie/modal/MovieEditFormComponent";
import {mapActions, mapGetters} from "vuex";
import * as movieGetters from "@/store/modules/movie/types/getters";
import * as movieActions from "@/store/modules/movie/types/actions";
import * as authActions from "@/store/modules/auth/types/actions";
import * as authGetters from "@/store/modules/auth/types/getters";

export default {
  name: 'MovieDetailPage',
  components: {
    MovieEditFormComponent
  },
  data() {
    return {
      movieData: {},
    }
  },
  computed: {
    ...mapGetters('MovieService', {
      getMovieData: movieGetters.GET_MOVIE
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
      fetchMovie: movieActions.FETCH_MOVIE
    }),
    async formatMovieData() {
      await this.fetchMovie(this.$route.params.id);
      this.movieData = this.getMovieData;
    }
  },
  mounted() {
    this.formatMovieData();
  }
}
</script>

<style scoped>
img {
  max-width: 300px;
  max-height: 250px;
}
</style>
