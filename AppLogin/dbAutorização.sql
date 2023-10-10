drop database dbAutorizacao;

create database dbAutorizacao;
use dbAutorizacao;

create table tbUsuario(
	UsuarioID int primary key auto_increment,
    UsuNome varchar(50) not null unique,
    Login varchar(50) not null unique,
    Senha varchar(100) not null
);

-- Método InsertUsuario
delimiter $$
create procedure spInsertUsuario(vUsuNome varchar(50), vLogin varchar(50), vSenha varchar(100))
begin
	insert into tbUsuario(UsuNome, Login,Senha) values (vUsuNome, vLogin, vSenha);
end $$

-- Método SelectLogin
delimiter $$
create procedure spSelectLogin(vLogin varchar(50))
begin
	select Login from tbUsuario where Login = vLogin;
end $$

-- Método SelectUsuario
delimiter $$
create procedure spSelectUsuario(vLogin varchar(50))
begin
	select * from tbUsuario where Login = vLogin;
end $$

-- Método UpdateSenha
delimiter $$
create procedure spUpdateSenha(vLogin varchar(50), vSenha varchar(100))
begin
	update tbUsuario set Senha = vSenha where Login = vLogin;
end $$

select * from tbUsuario;

/* truncate tbUsuario;
select * from tbUsuario; */