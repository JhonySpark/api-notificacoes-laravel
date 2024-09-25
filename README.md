# Projeto Laravel

Este é o projeto para o teste para Yup Chat em Laravel que utiliza Docker para gerenciar o banco de dados Postgres.
Abaixo estão as instruções para configurar e rodar o projeto.

O arquivo para o Postman/Insomnia está na raiz do projeto, para que as requisições possam ser
testadas e validadas.

O projeto foi criado utilizando ORM Eloquent e Doctrine para conexão com o postegres, Jwt,
foi criado um middleware básico para tratamento de exceções,também configurei resources para
fazer o mapeamento json das respostas e requisições.

## Requisitos

- PHP 8.2
- Composer
- Docker ( para o banco de dados)

## Configuração do Projeto

### 1. Clonar o Repositório

Primeiro, clone o repositório do projeto:

```sh
git clone https://github.com/JhonySpark/api-notificacoes-laravel.git
cd api-notificacoes-laravel
```

### 2. Instalar Dependências

Instale as dependências do PHP usando o Composer:

``` sh
composer install
```

### 3. Configurar o Ambiente

Copie o arquivo .env.example para .env e configure as variáveis de ambiente:

``` sh
cp .env.example .env
```

### 4. Gerar a Chave da Aplicação

Gere a chave da aplicação Laravel:

``` sh
php artisan key:generate
```

## Configuração do Banco de Dados com Docker

### 1. Subir o Banco de Dados

Utilize o docker-compose para subir o banco de dados:

``` sh
docker-compose up -d
```

### 2. Migrar o Banco de Dados

Execute as migrações para criar as tabelas no banco de dados:

``` sh
php artisan migrate
```

## Rodando o Projeto

Para rodar o servidor de desenvolvimento, utilize o comando:

``` sh
php artisan serve
```

O projeto estará disponível em <http://localhost:8000>.
