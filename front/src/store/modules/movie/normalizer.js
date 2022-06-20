import {userMapper} from "@/store/modules/user/normalizer";

export const moviesMapper = function (movies) {
    let result = [];
    result['items'] = {
        ...result,
        ...movies.items.reduce(
            (prev, movie) => ({
                ...prev,
                [movie.id]: movieMapper(movie)
            }),
            {}
        )
    };
    result['currentPage'] = movies.currentPage;
    result['lastPage'] = movies.lastPage;
    result['nextPageUrl'] = movies.nextPageUrl;
    result['perPage'] = movies.perPage;
    result['previousPageUrl'] = movies.previousPageUrl;
    result['total'] = movies.total;

    return result;
};
export const movieMapper = movie => ({
    id:movie.id,
    name: movie.name,
    description: movie.description,
    releaseDate: movie.releaseDate,
    isLiked: movie.isLiked,
    author: movie.author ? userMapper(movie.author) : []
});
