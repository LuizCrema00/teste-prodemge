<template>
  <v-container>
    <v-form @submit.prevent="submitAddress">
      <v-select
        v-model="addressType"
        :items="addressTypes"
        label="Tipo de Endereço"
        required
      />
      <v-text-field v-model="cep" label="CEP" required />
      <v-text-field v-model="logradouro" label="Logradouro" required />
      <v-text-field v-model="numero" label="Número" required />
      <v-text-field v-model="complemento" label="Complemento" />
      <v-text-field v-model="bairro" label="Bairro" required />
      <v-text-field v-model="estado" label="Estado" required />
      <v-text-field v-model="cidade" label="Cidade" required />
      <v-btn type="submit">Cadastrar Endereço</v-btn>
    </v-form>
  </v-container>
</template>

<script>
import axios from '../services/api';

export default {
  props: ['person'],
  data() {
    return {
      addressType: '',
      addressTypes: ['Residencial', 'Comercial'],
      cep: '',
      logradouro: '',
      numero: '',
      complemento: '',
      bairro: '',
      estado: '',
      cidade: '',
    };
  },
  methods: {
    async submitAddress() {
      try {
        await axios.post('/enderecos', {
          pessoa_id: this.person.id,
          tipo_id: this.addressTypes.indexOf(this.addressType) + 1,
          cep: this.cep,
          logradouro: this.logradouro,
          numero: this.numero,
          complemento: this.complemento,
          bairro: this.bairro,
          estado: this.estado,
          cidade: this.cidade,
        });
        console.log('Endereço cadastrado com sucesso');
        this.$emit('address-registered');
      } catch (error) {
        console.error('Erro ao cadastrar endereço', error);
      }
    },
  },
};
</script>


  