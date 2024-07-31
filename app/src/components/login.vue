<template>
    <v-container>
      <v-form @submit.prevent="login">
        <v-text-field
          v-model="email"
          label="Email"
          type="email"
          required
        />
        <v-text-field
          v-model="password"
          label="Senha"
          type="password"
          required
        />
        <v-btn type="submit">Login</v-btn>
      </v-form>
    </v-container>
  </template>
  
  <script>
  import axios from '../services/api';
  
  export default {
    data() {
      return {
        email: '',
        password: '',
      };
    },
    methods: {
      async login() {
        try {
          const response = await axios.post('/login', {
            email: this.email,
            password: this.password,
          });
  
          const token = response.data;
  
          if (token) {
            localStorage.setItem('token', token);
            console.log('Token armazenado:', localStorage.getItem('token'));
            this.$router.push('/cadastro');
          } else {
            console.error('Token não encontrado na resposta');
          }
        } catch (error) {
          console.error('Erro ao fazer login', error);
        }
      },
    },
  };
  </script>
  
  
  
  