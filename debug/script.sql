create database if not exists banco;
use banco;

create table if not exists usuario (
    id int(11) not null auto_increment,
    name varchar(255),
    primary key (id)
);