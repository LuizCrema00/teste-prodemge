<template>
  <v-container>
    <v-form @submit.prevent="searchPeople">
      <v-text-field v-model="searchName" label="Pesquisar por Nome" />
      <v-text-field v-model="searchCpf" label="Pesquisar por CPF" />
      <v-btn @click="searchPeople">Pesquisar</v-btn>
    </v-form>

    <v-data-table
      :headers="peopleHeaders"
      :items="people"
      item-key="id"
      @click:row="selectPerson"
    >
      <template v-slot:item.actions="{ item }">
        <v-btn @click="selectPerson(item)">Selecionar</v-btn>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
import axios from '../services/api';

export default {
  data() {
    return {
      searchName: '',
      searchCpf: '',
      people: [],
      peopleHeaders: [
        { text: 'Nome', value: 'nome' },
        { text: 'CPF', value: 'cpf' },
        { text: 'Ações', value: 'actions', sortable: false },
      ],
    };
  },
  methods: {
    async searchPeople() {
      try {
        const response = await axios.get('/pessoas', {
          params: {
            nome: this.searchName,
            cpf: this.searchCpf,
          },
        });
        this.people = response.data.data;
      } catch (error) {
        console.error('Erro ao buscar pessoas', error);
      }
    },
    selectPerson(person) {
      this.$emit('select-person', person);
    },
  },
};
</script>
