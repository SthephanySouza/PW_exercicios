-- criando o banco de dados e colocando-o em uso
create database dbMusica;
use dbMusica;

-- criando tabelas
create table tbProdutor(
	IdProd int primary key auto_increment,
    NomeProd varchar(200)
);

create table tbGravadora(
	IdGrav int primary key auto_increment,
    NomeGrav varchar(200)
);

create table tbCompositor(
	IdCompos int primary key auto_increment,
    NomeCompos varchar(200)
);

create table tbCantor(
	IdCantor int primary key auto_increment,
	IdProd int not null,
    NomeCantor varchar(200) not null,
    constraint fk_IdProd foreign key(IdProd) references tbProdutor(IdProd)
);

create table tbMusica(
	IdMusica int primary key auto_increment,
    IdCantor int not null,
	IdCompos int not null,
    IdGrav int not null,
    NomeMusica varchar(200) not null,
    Genero varchar(100) not null,
    Album varchar(150) not null,
    AnoLanc varchar(70) not null,
    Capa varchar(200) not null,
    DispoEstoque char(1) not null,
    QtdEstoque int not null,
    Preco decimal(6,2),
    constraint fk_IdCompos foreign key(IdCompos) references tbCompositor(IdCompos),
    constraint fk_IdCantor foreign key(IdCantor) references tbCantor(IdCantor),
    constraint fk_IdGrav foreign key(IdGrav) references tbGravadora(IdGrav)
);

-- inserindo dados em todas as tabelas
insert into tbProdutor values (default, 'Bruce Fairbairn'),
							  (default, 'Rick Chertoff'),
							  (default, 'Jim Steinman'),
							  (default, 'Michael Lloyd'),
							  (default, 'Guti'),
							  (default, 'Tim maia'),
							  (default, 'Vinyl'),
							  (default, 'Nico Rezende e Ezequiel Neves');

insert into tbGravadora values (default, 'Mercory Records'),
							   (default, 'Epic Records'),
                               (default, 'Columbia Records'),
                               (default, 'RCA Records'),
                               (default, 'RCA'),
                               (default, 'PolyGram'),
                               (default, 'Universal Music');

insert into tbCompositor values (default, 'Jon Bon Jovi, Richie Sambora e Desmond Child'),
								(default, 'Robert Hazard'),
                                (default, 'Jim Steinman'),
                                (default, 'Franke Previte, John DeNicola, e Donald Markowitz'),
                                (default, 'Sá e Guarabyra'),
                                (default, 'Michel e Gilson Mendonça'),
                                (default, 'Ritchie e Bernardo Vilhena'),
                                (default, 'Cazuza, Ezequiel Neves e Leoni');

insert into tbCantor values (default, 1, 'Bon Jovi'),
							(default, 2, 'Cyndi Lauper'),
                            (default, 3, 'Bonnie Tyler'),
                            (default, 4, 'Bill Medley e Jennifer Warnes'),
                            (default, 5, 'Ropa Nova'),
                            (default, 6, 'Tim Maia'),
                            (default, 7, 'Ritchie'),
                            (default, 8, 'Cazuza');

insert into tbMusica values (default, 1, 1, 1, 'Livin on a Prayer', 'Arena rock', 'Slippery When Wet', '31 de outubro de 1986', 'BonJovi', 'S', 30, 25.00),
							(default, 2, 2, 2, 'Girls Just Want To Have Fun', 'New wave', 'She So Unusual', '6 de Setembro de 1983', 'Cyndi', 'S', 55, 25.00),
                            (default, 3, 3, 3, 'Total Eclipse of the Heart', 'Pop rock', 'Faster Than the Speed of Night', '5 de março de 1983', 'Bonnie', 'N', 0, 79.90),
                            (default, 4, 4, 4, '(I ve Had) The Time of My Life', 'Pop rock', 'Dirty Dancing', '10 de julho de 1987', 'BilleJannifer', 'N', 0, 50.00),
                            (default, 5, 5, 5, 'Dona', 'MPB', 'Roupa Nova', '1985', 'RoupaNova', 'N', 0, 50.00),
                            (default, 6, 6, 6, 'O Descobridor dos Sete Mares', 'Soul', 'O Descobridor dos Sete Mares', '1983', 'TimMaia', 'N', 0, 79.90),
                            (default, 7, 7, 2, 'Menina veneno', 'New wave', 'Voo de Coração', 'Fevereiro de 1983', 'Ritchie', 'S', 39, 55.00),
                            (default, 8, 8, 7, 'Exagerado', 'Rock', 'Exagerado', '1985', 'Cazuza', 'N', 0, 59.00);

-- exibindo todos os campos de todas as tabelas
select * from tbProdutor;
select * from tbGravadora;
select * from tbCompositor;
select * from tbCantor;
select * from tbMusica;

-- mustrando campos da tbMusica e suas expecificações
describe tbMusica;

-- criando uma view e utilizando o inner join para vincular informações de outras tabelas
create view vwMusica
	as select tbMusica.IdMusica, tbCantor.NomeCantor, tbCompositor.NomeCompos, tbGravadora.NomeGrav,
			tbMusica.NomeMusica, tbMusica.Genero, tbMusica.Album, tbMusica.AnoLanc,
			tbMusica.Capa, tbMusica.DispoEstoque, tbMusica.QtdEstoque, tbMusica.Preco
	from tbMusica inner join tbCantor
		on tbMusica.IdCantor = tbCantor.IdCantor
	inner join tbCompositor
		on tbMusica.IdCompos = tbCompositor.IdCompos
	inner join tbGravadora
		on tbMusica.IdGrav = tbGravadora.IdGrav;

-- exibindo os campos da view
select * from vwMusica;

-- exibindo campos por disposição no estoque
select NomeMusica, Preco, Capa from vwMusica where DispoEstoque = 'S';

-- criando tabela para usuários
create table tbUsuario(
	CodUsu int primary key auto_increment,
    NomeUsu varchar(80) not null,
    Email varchar(80) not null,
    Senha varchar(10) not null,
    DsStatus boolean not null,
    Endereco varchar(80) not null,
    Cidade varchar(30) not null,
    CEP char(9) not null
);

-- inserindo dados dos usuários na tabela
insert into tbUsuario values (default, 'Mariana da Silva', 'marisil@gmail.com', 'Marisilva', 1, 'Av. Paulista 23', 'São Paulo', 05252-020),
							 (default, 'Rodrigo Rodrigues', 'Roro@gmail.com', 'Rodrigo', 0, 'Rua Adamastor 748', 'Santos', 34975-060),
                             (default, 'Anderson Camargo', 'Anderson@gmail.com', 'AndreCarma', 0, 'Av. João XII 69', 'São Paulo', 67980-022);

-- exibindo dados da tabela
select * from tbUsuario;

-- selecionando campos das tabelas com comando like
select * from vwMusica where NomeMusica like '%o';