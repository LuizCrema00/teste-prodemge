# CRUD Sistema de cadastro

Sistema desenvolvido como avaliacao técnica

O sistema primeiramente possui Autenticação, para acesso do sistema o usuário precisa estar logado.
![image](https://github.com/user-attachments/assets/1514eed2-ad05-48a0-8f56-322b67047737)

Para conseguir um usuario autenticado siga as instruções de configuração do projeto que estarão abaixo.

Após autenticado é exibida uma interface no modelo de CRUD Sistema de Cadastro.
![image](https://github.com/user-attachments/assets/d5085688-c9bd-4cb0-a0ea-d4178ba8bd13)

Ao ir para cadastrar nova pessoa é exibida a seguinte modal
![image](https://github.com/user-attachments/assets/4fb5a1c6-70a1-40dd-b006-7943d06740e5)

Cadastrando o usuário o usuário é encaminhado para a modal de cadastrar um endereço
![image](https://github.com/user-attachments/assets/1f12d258-5c36-4a28-bcdd-bc81ffa3933f)

Após cadastrada uma nova pessoa ela é exibido em uma tabela contendo nome e seu cpf
![image](https://github.com/user-attachments/assets/90415e37-83c7-4dca-a570-93d7c8b1b1b2)




### Build do Sistema

Siga os passos abaixo para configurar e executar o projeto localmente:

1. **Clonar o Repositório:**

   git clone https://github.com/LuizCrema00/teste-prodemge.git

2. ### Navegar entre pastas
   para a backend: cd api
   
   para o frontend: cd app

# BACKEND

1. ### Requisitos

- PHP 8.1 ou superior
- Composer 2.2 ou superior
- O projeto está no Laravel na versao 10.48.12

2. ### Instalação de Dependências

   composer install
   
   npm install
   
3. ### Configuração do Ambiente
    cp .env.example .env

   Copie o arquivo .env.example para .env e configure as variáveis de ambiente, como conexão com banco de dados.


4. ### Migrations e seeders

   php artisan migrate

   Executa as migrations de tabelas para o banco de dados

   php artisan db:seed

   Roda as seeders e popula as tabelas Users tipo_enderecos
   Para a tabela Users, criará um usuário autenticado na aplicação.
   
   Nome: admin
   
   Email: admin@admin.com
   
   senha: admin

6. ### Execução do projeto
   php artisan serve

# FRONTEND

1. ### Requisitos

- NPM 7 ou superior
- Node 18 ou superior
- O projeto esta utilizando vite na versão 5.2 com template vue na versão 3.4

2. ### Instalação de Dependências
   
   npm install

3. ### Execução do projeto

   npm run dev

   o projeto estará disponível em http://localhost:5173
