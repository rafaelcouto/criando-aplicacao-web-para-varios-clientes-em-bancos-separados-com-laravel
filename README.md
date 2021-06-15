# Criando aplicação web para vários clientes em bancos separados com Laravel

Exemplo de aplicação web em Laravel utilizando o conceito de *Multi Tenancy* (ou *Multi Tenant*), que permite que cada cliente (inquilino) tenha um subdomínio e banco de dados especifico na aplicação.

## Requisitos

- PHP 7.3+ (requerido pelo Laravel 8);
- Composer;
- Apache ou nginx;
- MySQL ou MariaDB.

## Instalação

Criar o banco de dados principal rodando o *script* em [main.sql](main.sql);

Instalar as dependências utilizando o Composer;
```
composer install
```

Renomear o arquivo [.env.example](.env.example) para ```.env``` e substituir pelas informações da sua aplicação;

```
cp .env.example .env
```

Gerar uma *key* para aplicação.

```
php artisan key:generate
```

## Criação de inquilino

Estrutura do comando:
```
create-tenant {name} {--host=127.0.0.1} {--port=3306} {--username=root}
```
Exemplos de uso:

```
php artisan create-tenant "Tenant 1"
php artisan create-tenant "Tenant 2" --host=167.71.253.102 --username=rafael
```

## Alteração de estrutura do banco de dados (*Migrations*)

Estrutura do comando:

```
migrate-tenant {--rollback} {--tenant=}
```

Exemplos de uso:

```
php artisan migrate-tenant
php artisan migrate-tenant --tenant=tenant1
php artisan migrate-tenant --rollback
```


## Mais informações

https://rafaelcouto.com.br/criando-aplicacao-web-para-varios-clientes-em-bancos-separados-com-laravel
