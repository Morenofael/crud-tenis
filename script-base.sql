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
    esporte varchar(40),
    tamanho int not null,
    preco float,
    sexo varchar(1) /*M = Masc., F = Fem., U = Unisex*/
    constraint pk_tenis primary key (id)
);
ALTER TABLE tenis ADD CONSTRAINT fk_marca FOREIGN KEY (id_marcas) REFERENCES marcas (id);