<template>
  <div class="modal fade" id="movieForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">
          <h2 class="fw-bold mb-0">Add watched movie</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body p-5 pt-0">
          <form class="" @submit.prevent="submitForm">
            <div class="form-floating mb-3">
              <input
                  type="text"
                  class="form-control rounded-3"
                  id="floatingInputLogin"
                  placeholder="Movie name"
                  v-model="movieData.name"
              >
              <label for="floatingInputLogin">Movie name</label>
            </div>
            <div class="form-floating mb-3">
              <input
                  type="text"
                  class="form-control rounded-3"
                  id="floatingInputLogin"
                  placeholder="Description"
                  v-model="movieData.description"
              >
              <label for="floatingInputLogin">Description</label>
            </div>
            <div class="form-floating mb-3">
              <input
                  type="date"
                  class="form-control rounded-3"
                  id="floatingInputLogin"
                  placeholder="Date of movie release"
                  v-model="movieData.releaseDate"
              >
              <label for="floatingInputLogin">Date of movie release</label>
            </div>
            <div class="d-flex justify-content-start mb-3">
              <label class="form-check-label" for="flexCheckDefault">
                Movie is liked
              </label>
              <input
                  class="form-check-input mx-4"
                  type="checkbox"
                  id="flexCheckDefault"
                  v-model="movieData.isLiked"
              >
            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Add movie</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import * as movieActions from '@/store/modules/movie/types/actions';
import * as movieGetters from '@/store/modules/movie/types/getters';
import notificationMixin from '@/mixins/notificationMixin';
import {Modal} from 'bootstrap';

export default {
  name: 'MovieFormComponent',
  data() {
    return {
      movieData: {
        name: '',
        description: '',
        releaseDate: '',
        isLiked: false
      }
    }
  },
  methods: {
    ...mapActions('MovieService', {
      addMovie: movieActions.ADD_MOVIE
    }),
    ...mapGetters('MovieService', {
      getMoviesList: movieGetters.GET_MOVIES_LIST
    }),
    async submitForm() {
      try {
        await this.addMovie(this.movieData);
        await this.getMoviesList();
        await notificationMixin('Movie added is successful', 'success');
        await Modal.getInstance(`#movieForm`)?.hide();
      } catch (error) {
        notificationMixin(error, 'error')
      }
    }
  }
};
</script>

<style scoped></style>
