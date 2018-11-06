create database IF NOT EXISTS informatica;

use informatica;

create table IF NOT EXISTS classi(
Anno_Classe int(1) NOT NULL,
Id_Classe varchar(2) NOT NULL,
primary key(Anno_Classe, Id_Classe)
);

create table IF NOT EXISTS alunni(
Nome varchar(30) NOT NULL,
Cognome varchar(30) NOT NULL,
Stato_Accesso	bool NOT NULL default false,
Youtube bool NOT NULL default false,
Anno_Classe int(1) NOT NULL,
Id_Classe varchar(2) NOT NULL,
primary key(Nome, Cognome),
FOREIGN KEY (Anno_Classe, Id_Classe) REFERENCES classi(Anno_Classe, Id_Classe) on delete cascade on update cascade
);

INSERT INTO alunni values ("Alessandro", "Colugnat", true, true, 4, "AC");

UPDATE alunni set Stato_Accesso = 0 where Nome = "Alessandro" && Cognome = "Gomes";

SELECT * FROM alunni where Anno_Classe = 4 AND Id_Classe = "AC" AND Stato_Accesso = 0;