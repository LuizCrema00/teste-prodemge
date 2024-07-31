import axios from 'axios';

// Cria uma instância do Axios com configurações padrão
const api = axios.create({
    baseURL: 'http://localhost:8000/api', // URL base da sua API Laravel
});

// Adiciona um interceptor para adicionar o token de autenticação a todas as requisições
api.interceptors.request.use(
    config => {
        const token = localStorage.getItem('token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    error => Promise.reject(error)
);

export default api;
