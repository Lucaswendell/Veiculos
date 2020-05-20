create database if not exists veiculo;

use veiculo;

create table if not exists Veiculos(
    id integer not null primary key auto_increment,
    placa varchar(9) not null,
    modelo varchar(20) not null,
    marca varchar(20) not null,
    dataCadastro datetime default NOW()
);
