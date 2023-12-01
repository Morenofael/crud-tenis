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
    sexo varchar(1), /*M = Masc., F = Fem., U = Unisex*/
    constraint pk_tenis primary key (id),
    id_esporte INT NOT NULL
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


CREATE TABLE clubes ( 
  id int AUTO_INCREMENT NOT NULL,
  id_esporte int not null,
  abrev varchar(3),
  nome varchar(70) NOT NULL,
  CONSTRAINT pk_clubes PRIMARY KEY (id)
);
ALTER TABLE clubes ADD CONSTRAINT fk_esporte2 FOREIGN KEY (id_esporte) REFERENCES esportes (id);

INSERT INTO clubes (abrev, nome, id_esporte) VALUES ('BUL', 'Bulls', 1);
INSERT INTO clubes (abrev, nome, id_esporte) VALUES ('BOS', 'Boston', 1);
INSERT INTO clubes (abrev, nome, id_esporte) VALUES ('SAO', 'Sao Paulo', 2);
INSERT INTO clubes (abrev, nome, id_esporte) VALUES ('VAS', 'Vasco', 2);
INSERT INTO clubes (abrev, nome, id_esporte) VALUES ('COR', 'Corinthians', 2);
INSERT INTO clubes (abrev, nome, id_esporte) VALUES ('IBI', 'Ibis', 2);
INSERT INTO clubes (abrev, nome, id_esporte) VALUES ('PAY', 'Paysandu', 2);
INSERT INTO clubes (abrev, nome, id_esporte) VALUES ('COR', 'Coxa', 2);

CREATE TABLE jogadores ( 
  id int AUTO_INCREMENT NOT NULL,
  id_clube int not null,
  nome varchar(70) NOT NULL,
  img_foto varchar(100),
  CONSTRAINT pk_jogadores PRIMARY KEY (id)
);

ALTER TABLE jogadores ADD CONSTRAINT fk_clube FOREIGN KEY (id_clube) REFERENCES clubes (id);