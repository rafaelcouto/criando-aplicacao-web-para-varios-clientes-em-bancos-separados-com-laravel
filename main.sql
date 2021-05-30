create schema main collate utf8mb4_general_ci;

create table main.tenants
(
    id VARCHAR(40) not null primary key,
    name VARCHAR(80) not null,
    host VARCHAR(255) not null,
    port VARCHAR(5) not null,
    database_name VARCHAR(60) not null,
    username VARCHAR(60) not null,
    password VARCHAR(250) not null,
    created_at timestamp not null,
    updated_at timestamp
);