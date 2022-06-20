import requestService from '@/services/request-service/ApiRequestService';

const AuthService = {
    async signUp(data) {
        const response = await requestService.post('/api/auth/sign-up', data);
        this.saveToken(response?.data?.data.accessToken);

        return response?.data?.data;
    },
    async signIn(userLoginData) {
        const response = await requestService.post('/api/auth/login', userLoginData);
        this.saveToken(response?.data?.data.accessToken);

        return response?.data?.data;
    },
    async signOut() {
        const response = await requestService.post('/api/auth/logout');
        this.removeToken();
        return response?.data?.data;
    },
    async fetchLoggedUser() {
        const response = await requestService.get('/api/auth/me');
        return response?.data?.data;
    },
    saveToken(token) {
        localStorage.setItem('auth.accessToken', token);
    },
    removeToken() {
        localStorage.setItem('auth.accessToken', '');
    },
    getToken() {
        return localStorage.getItem('auth.accessToken');
    },
    hasToken() {
        return !!localStorage.getItem('auth.accessToken');
    }
};

export default AuthService;
