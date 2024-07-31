<template>
    <v-container>
  
      <!-- Seção de Pesquisa -->
      <PesquisaPessoa @update-people="updatePeople" />
  
      <!-- Botão para cadastrar nova pessoa -->
      <v-btn @click="showPersonForm">Cadastrar Nova Pessoa</v-btn>
  
      <!-- Tabela de Pessoas Cadastradas -->
      <v-data-table
        :headers="peopleHeaders"
        :items="people.data"
        :items-per-page="itemsPerPage"
        :page.sync="page"
        :server-items-length="totalItems"
        :loading="loading"
        item-key="id"
        @update:page="fetchPeople"
        @update:items-per-page="itemsPerPageChanged"
      >
      </v-data-table>
  
      <!-- Formulário de Cadastro de Pessoa -->
      <v-dialog v-model="showPersonDialog" persistent max-width="600px">
        <v-card>
          <v-card-title>
            <span class="headline">Cadastrar Pessoa</span>
          </v-card-title>
          <v-card-text>
            <v-form @submit.prevent="registerPerson">
              <v-text-field v-model="nome" label="Nome" required />
              <v-text-field v-model="nome_social" label="Nome Social" />
              <v-text-field v-model="cpf" label="CPF" required />
              <v-text-field v-model="nome_pai" label="Nome do Pai" />
              <v-text-field v-model="nome_mae" label="Nome da Mãe" />
              <v-text-field v-model="telefone" label="Telefone" />
              <v-text-field v-model="email" label="Email" type="email" />
              <v-btn type="submit">Cadastrar Pessoa</v-btn>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="showPersonDialog = false">Fechar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
  
      <!-- Formulário de Cadastro de Endereço -->
      <v-dialog v-model="showAddressDialog" persistent max-width="600px">
        <v-card>
          <v-card-title>
            <span class="headline">Cadastrar Endereço</span>
          </v-card-title>
          <v-card-text>
            <FormularioEndereco :person="selectedPerson" @address-registered="handleAddressRegistered" />
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="showAddressDialog = false">Fechar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </template>
  
  <script>
  import PesquisaPessoa from './PesquisaPessoa.vue';
  import FormularioEndereco from './FormularioEndereco.vue';
  import axios from '../services/api';
  
  export default {
    components: {
      PesquisaPessoa,
      FormularioEndereco,
    },
    data() {
      return {
        people: { data: [], meta: {} }, // Ajuste para suportar meta-informações de paginação
        page: 1,
        itemsPerPage: 5,
        totalItems: 0,
        nome: '',
        nome_social: '',
        cpf: '',
        nome_pai: '',
        nome_mae: '',
        telefone: '',
        email: '',
        selectedPerson: null,
        showPersonDialog: false,
        showAddressDialog: false,
        peopleHeaders: [
          { text: 'Nome', value: 'nome' },
          { text: 'CPF', value: 'cpf' },
          { text: 'Ações', value: 'actions', sortable: false },
        ],
        loading: false,
      };
    },
    methods: {
      async fetchPeople() {
        try {
          this.loading = true;
          const response = await axios.get('/pessoas', {
            params: {
              page: this.page,
              per_page: this.itemsPerPage,
            },
          });
          this.people = response.data;
          this.totalItems = response.data.meta.total;
          this.loading = false;
        } catch (error) {
          console.error('Erro ao buscar pessoas', error);
          this.loading = false;
        }
      },
      async searchPeople() {
        this.page = 1; // Resetar para a primeira página na busca
        await this.fetchPeople();
      },
      itemsPerPageChanged(itemsPerPage) {
        this.itemsPerPage = itemsPerPage;
        this.fetchPeople();
      },
      updatePeople(people) {
        console.log('Pessoas atualizadas:', people); // Adicione este log
        this.people = people;
      },
      handlePersonSelected(person) {
        this.selectedPerson = person;
      },
      async registerPerson() {
        try {
          const response = await axios.post('/pessoas', {
            nome: this.nome,
            nome_social: this.nome_social,
            cpf: this.cpf,
            nome_pai: this.nome_pai,
            nome_mae: this.nome_mae,
            telefone: this.telefone,
            email: this.email,
          });
          this.selectedPerson = response.data;
          this.showPersonDialog = false;
          this.showAddressDialog = true;
        } catch (error) {
          console.error('Erro ao cadastrar pessoa', error);
        }
      },
      async logout() {
        try {
          await axios.post('/logout');
          localStorage.removeItem('token');
          this.$router.push('/');
        } catch (error) {
          console.error('Erro ao fazer logout', error);
        }
      },
      handleAddressRegistered() {
        this.selectedPerson = null;
        this.showAddressDialog = false;
        this.searchPeople(); // Atualiza a lista de pessoas após cadastro de endereço
      },
    },
    mounted() {
      this.searchPeople(); // Carrega as pessoas ao montar
    },
  };
  </script>
  
  
  
  