# Criando aplicação web para vários clientes em bancos separados com Laravel

Exemplo de aplicação web em Laravel utilizando o conceito de *Multi Tenancy* (ou *Multi Tenant*), que permite que cada cliente tenha um subdomínio e banco de dados especifico para a aplicação.

## Requisitos

- PHP 7.3+ (requerido pelo Laravel 8);
- Composer;
- Apache ou nginx;
- MySQL ou MariaDB.

## Instalação

Basta instalar as dependências utilizando o Composer.

```
composer update
```

Renomear o arquivo [.env.example](.env.example) para ```.env``` e substituir pelas informações da sua aplicação.

```
cp .env.example .env
```

É bom também gerar uma *key* para aplicação.

```
php artisan key:generate
```

## Mais informações

https://rafaelcouto.com.br/criando-aplicacao-web-para-varios-clientes-em-bancos-separados-com-laravel