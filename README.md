<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Teste Milhas

Esta API é um teste proposto pela empresa [123 Milhas](https://123milhas.com/);

Basicamente oque ela faz, é tratar os dados retornados pela api disponibilizada, organizando os voos de idas e voltas de acordo com o mesmo tipo de tarifa.

## Rodar o projeto local

Este projeto esta utilizando o [Docker](https://www.docker.com/get-started) e o Docker Compose, você pode acessar a página e seguir os passos de instalação.

##### Passo 1
Após a instalar o Docker, clone o projeto na sua maquina:

```
$ git clone https://github.com/ThiagoFelipeg3/123Milhas.git
```

##### Passo 2

Dentro da raiz do projeto clone um arquivo chamado .env.example

```
cp .env.example .env
```
Adicione a seguinte variável com o link:
```
123MILHAS_API=http://prova.123milhas.net/api/flights
```

##### Passo 3
Após isso entre na pasta do projeto e execute o docker compose:
Isso pode demorar um pouco;

```
$ docker-compose up -d
```

```
$ docker-compose up -d --force-recreate app
```

##### Passo 4
Se não ouver erros, entre no container criado pelo projeto e instale o composer:

```
$  docker-compose exec app bash
```

```
$ composer install
```

## Rotas

Após tudo isso, acesse no seu navegador ou em alguma ferramenta como o Postmon as seguntes rotas;

Retornar todos os voos agrupados por tarifa preco:
```
GET http://localhost/api/flights
```

Retornar todos os voos somente de ida:
```
GET http://localhost/api/flights/outbound
```

Retornar todos os voos somente volta:
```
GET http://localhost/api/flights/inbound
```
