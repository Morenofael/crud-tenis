CREATE TABLE marcas(
    id int AUTO_INCREMENT NOT NULL,
    nome varchar(40) NOT NULL,
    nacionalidade varchar(2), /*BR = Braileira, AR = Argentina*/
    constraint pk_marcas primary key(id)
);

INSERT INTO marcas (nome, nacionalidade) values ("Nike", "US");
INSERT INTO marcas (nome, nacionalidade) values ("Adidas", "DE");
INSERT INTO marcas (nome, nacionalidade) values ("Under Armour", "US");
INSERT INTO marcas (nome, nacionalidade) values ("Nike", "JP");

CREATE TABLE tenis(
    id int AUTO_INCREMENT NOT NULL,
    nome varchar(200) NOT NULL,
    preco float,
    id_marca INT NOT NULL,
    sexo varchar(1) /*M = Masc., F = Fem., U = Unisex*/
    constraint pk_tenis primary key (id),
    id_esporte varchar(40)
);

CREATE TABLE esportes(
    id int AUTO_INCREMENT NOT NULL,
    nome varchar(200) NOT NULL,
    constraint pk_esporte primary key (id)
);

INSERT INTO esportes (nome) VALUES ("Basquete");
INSERT INTO esportes (nome) VALUES ("Futebol");
INSERT INTO esportes (nome) VALUES ("Corrida");

ALTER TABLE tenis ADD CONSTRAINT fk_marca FOREIGN KEY (id_marca) REFERENCES marcas (id);
ALTER TABLE tenis ADD CONSTRAINT fk_esporte FOREIGN KEY (id_esporte) REFERENCES esportes (id);

/* TABELA times */
CREATE TABLE clubes ( 
  id int AUTO_INCREMENT NOT NULL, 
  nome varchar(70) NOT NULL,
  CONSTRAINT pk_clubes PRIMARY KEY (id) 
);
ALTER TABLE clubes ADD CONSTRAINT fk_esporte2 FOREIGN KEY (id_esporte) REFERENCES esportes (id);

INSERT INTO clubes (nome, id_esporte) VALUES ('Bulls', 1);
INSERT INTO clubes (nome, id_esporte) VALUES ('Sao Paulo', 2);
INSERT INTO clubes (nome, id_esporte) VALUES ('Vasco', 2);

/*TODO implementar resto da base de dados*/