import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api', // endereço do seu Laravel
});

export default api;