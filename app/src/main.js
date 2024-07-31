import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import vuetify from './plugins/vuetify'; // Caminho do plugin Vuetify
import axios from './services/api';

const app = createApp(App);

app.config.globalProperties.$http = axios;
app.use(router);
app.use(vuetify);
app.mount('#app');
