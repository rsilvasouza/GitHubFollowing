# Projeto GitHub Following

Este projeto é uma aplicação full-stack que utiliza Vue 3 no frontend, Laravel 11 no backend e PostgreSQL como banco de dados. Ele consome a API do GitHub para exibir informações e a lista de usuários que a conta informada segue. Para utilizar a aplicação, basta inserir o nome de usuário do GitHub diretamente na URL do navegador. Certifique-se de ter o Docker instalado em seu sistema.

## Instalação

### Clonando o Repositório

Clone o projeto com o comando:

`git clone https://github.com/unisuam.git`

### Configuração do Backend

Acesse o diretório `backend` localizado dentro da pasta raiz do projeto:

Faça uma cópia do arquivo `.env.example` e renomeie-o para `.env`. O arquivo `.env` já vem pré-configurado com as informações básicas necessárias para executar o projeto.

> **Observação**: A API do GitHub tem um limite de 60 requisições por hora para usuários não autenticados. Se precisar de mais requisições, você pode gerar um **Token de Acesso Pessoal** (PAT), o que eleva o limite para 5.000 requisições por hora para usuários autenticados. Para criar o token, siga o passo a passo [neste link](https://docs.github.com/pt/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token).

Execute os seguintes comandos para configurar e iniciar o ambiente:

`docker compose up --build -d`

Acesse o container do PHP:

`docker exec -it gFollowing_php /bin/sh`

**Observação:** O nome do container `_php` é prefixado com o valor da variável de ambiente `APP_NAME`. Certifique-se de usar o prefixo correto.

Dentro do container, instale as dependências do Composer:

`composer install --no-dev --optimize-autoloader`

Defina permissões adequadas para o diretório `storage`:

`chmod -R 777 storage`

Gere a chave de aplicação do Laravel:

`php artisan key:generate`

Execute as migrações do banco de dados:

`php artisan migrate`

### Acessando a Aplicação

Após concluir a configuração, acesse a aplicação em [http://localhost:8080/](http://localhost:8080/). Para utilizar a aplicação, informe o nome de usuário do GitHub na URL, como por exemplo:

`http://localhost:8080/#/NOME_DE_USUARIO`


