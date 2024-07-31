<template>
    <v-app-bar app>
      <v-toolbar-title>Sistema de Cadastro</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="logout" color="primary">Logout</v-btn>
    </v-app-bar>
  </template>
  
  <script>
  import axios from '../services/api';
  
  export default {
    methods: {
      async logout() {
        try {
          await axios.post('/logout');
          localStorage.removeItem('token');
          this.$router.push('/');
        } catch (error) {
          console.error('Erro ao fazer logout', error);
        }
      }
    }
  }
  </script>
  
  <style scoped>
  </style>
  