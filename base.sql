DROP DATABASE produtos;
CREATE DATABASE produtos;
USE produtos;

CREATE TABLE produto (
                         id int not null primary key auto_increment,
                         nome varchar(255),
                         sku varchar(255),
                         descricao text,
                         estoque int,
                         preco decimal(10,2),
                         situacao int default 0, -- [ 0 - ativo | 1 - inativo | 2 - excluido ]
                         cadastro datetime default current_timestamp
);

CREATE TABLE imagem (
                        id int not null primary key auto_increment,
                        caminho varchar(255),
                        situacao int default 0, -- [ 0 - ativo | 1 - inativo | 2 - excluido ]
                        id_produto int not null,

                        CONSTRAINT fk_imagem_produto
                            FOREIGN KEY (id_produto)
                                REFERENCES produto(id)
);

CREATE TABLE tipo_variacao (
                               id int not null primary key auto_increment,
                               nome varchar(50)
);

CREATE TABLE variacao (
                          id int not null primary key auto_increment,
                          descricao varchar(255),
                          situacao int default 0, -- [ 0 - ativo | 1 - inativo | 2 - excluido ]
                          id_tipo_variacao int not null,
                          id_produto int not null,

                          CONSTRAINT fk_variacao_produto
                              FOREIGN KEY (id_produto)
                                  REFERENCES produto(id),

                          CONSTRAINT fk_variacao_tipo_variacao
                              FOREIGN KEY (id_tipo_variacao)
                                  REFERENCES tipo_variacao(id)
);

INSERT INTO tipo_variacao (nome) VALUES
                                     ('Cor'),
                                     ('Tamanho');
