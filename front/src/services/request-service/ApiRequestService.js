import axios from 'axios';
import AuthService from '@/services/auth/AuthService';
import router from '@/router';

const API_URL = process.env.VUE_APP_API_URL;

axios.interceptors.request.use(
    config => {
        if (AuthService.getToken()) {
            config.headers['Authorization'] = `Bearer ${AuthService.getToken()}`;
        }
        return config;
    },
    error => Promise.reject(error)
);

axios.interceptors.response.use(
    response => response,
    error => {
        const errorContext = error?.response;
        const errorCode = errorContext.status;

        if (errorCode === 404) {
            router.push({name: 'notFound'});
        }

        if (errorCode === 401) {
            AuthService.removeToken();
        }

        const nextError = new Error(error?.response?.data?.message || error);

        if (errorContext.data?.fails) {
            let validatorError = '';

            for (let errorName in errorContext.data?.fails) {
                validatorError = validatorError + errorContext.data?.fails[errorName][0] + " ";
            }

            nextError.validatorError = validatorError;
        }

        return Promise.reject(nextError.validatorError);
    }
);
const requestService = {
    get(url, params = {}, headers = {}) {
        return axios.get(API_URL + url, {
            params,
            headers
        });
    },
    post(url, body = {}, config = {}) {
        return axios.post(API_URL + url, body, config);
    },
    put(url, body = {}, config = {}) {
        return axios.put(API_URL + url, body, config);
    },
    patch(url, body = {}, config = {}) {
        return axios.patch(API_URL + url, body, config);
    },
    delete(url, config = {}) {
        return axios.delete(API_URL + url, config);
    }
};

export default requestService;
