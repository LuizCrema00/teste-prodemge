import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/login.vue';
import CadastroPessoa from '../components/CadastroPessoa.vue';

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login,
  },
  {
    path: '/cadastro',
    name: 'CadastroPessoa',
    component: CadastroPessoa,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  if (to.name !== 'Login' && !token) {
    next({ name: 'Login' });
  } else {
    next();
  }
});

export default router;
