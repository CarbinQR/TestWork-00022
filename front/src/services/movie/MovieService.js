import requestService from '@/services/request-service/ApiRequestService';

const MovieService = {
    async addMovie(data) {
        const response = await requestService.post('/api/movies', data);

        return response?.data?.data;
    },
    async updateMovie(movieId, data) {
        const response = await requestService.patch('/api/movies/' + movieId, data);

        return response?.data?.data;
    },
    async fetchMovie(movieId) {
        const response = await requestService.get('/api/movies/' + movieId);

        return response?.data?.data;
    },
    async fetchMoviesList() {
        const response = await requestService.get('/api/movies');

        return response?.data?.data;
    },
    async fetchMoviesListByUser(userId) {
        const response = await requestService.get('/api/movies/' + userId + '/my');

        return response?.data?.data;
    },
    async deleteMovie(movieId) {
        const response = await requestService.delete('/api/movies/' + movieId);

        return response?.data?.data;
    }
};

export default MovieService;
