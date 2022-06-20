<template>
  <div class="modal fade" id="movieEditForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">
          <h2 class="fw-bold mb-0">Edit movie</h2>
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
                  v-model="movieUpdateData.name"
              >
              <label for="floatingInputLogin">Movie name</label>
            </div>
            <div class="form-floating mb-3">
              <input
                  type="text"
                  class="form-control rounded-3"
                  id="floatingInputLogin"
                  placeholder="Description"
                  v-model="movieUpdateData.description"
              >
              <label for="floatingInputLogin">Description</label>
            </div>
            <div class="form-floating mb-3">
              <input
                  type="date"
                  class="form-control rounded-3"
                  id="floatingInputLogin"
                  placeholder="Date of movie release"
                  v-model="movieUpdateData.releaseDate"
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
                  v-model="movieUpdateData.isLiked"
              >
            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Update</button>
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
  name: 'MovieEditFormComponent',
  props: {
    movieData: {
      name: String,
      description: String,
      releaseDate: Date,
      isLiked: Boolean
    },
    userId: String
  },
  data() {
    return {
      movieUpdateData: {
        name: '',
        description: '',
        releaseDate: '',
        isLiked: ''
      }
    }
  },
  computed: {

  },
  methods: {
    ...mapActions('MovieService', {
      updateMovie: movieActions.UPDATE_MOVIE
    }),
    ...mapGetters('MovieService', {
      getMovie: movieGetters.GET_MOVIE
    }),
    async submitForm() {
      try {
        await this.updateMovie(this.movieUpdateData);
        await this.getMovie(this.userId);
        await notificationMixin('Movie updated is successful', 'success');
        await Modal.getInstance(`#movieEditForm`)?.hide();
      } catch (error) {
        notificationMixin(error, 'error')
      }
    },
    initData(){
      this.movieUpdateData.name = this.movieData.name;
      this.movieUpdateData.description = this.movieData.description;
      this.movieUpdateData.releaseDate = this.movieData.releaseDate;
      this.movieUpdateData.isLiked = this.movieData.isLiked;
    }
  },
  watch: {
    movieData:['initData']
  },
};
</script>

<style scoped></style>
