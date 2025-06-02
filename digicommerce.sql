DROP DATABASE digi;
CREATE DATABASE digi;

\c digi;

DROP TABLE cliente;

CREATE TABLE cliente (
	cliente_id SERIAL PRIMARY KEY                           ,
  	cliente_nome VARCHAR (100) NOT NULL                     ,
    cliente_cpf VARCHAR(20) UNIQUE NOT NULL                 ,
    cliente_email VARCHAR(50) NOT NULL                      ,
    cliente_telefone VARCHAR(20)                            ,
	created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);

DROP TABLE endereco;

CREATE TABLE endereco(
	cliente_fk SERIAL PRIMARY KEY REFERENCES cliente        ,
  	endereco_cep VARCHAR (10) NOT NULL                      ,
    endereco_logradouro VARCHAR(500) NOT NULL               ,
    endereco_numero VARCHAR(20) NOT NULL                    ,
    endereco_cidade VARCHAR(50) NOT NULL                    ,
    endereco_estado VARCHAR(50) NOT NULL                    ,
	created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);

DROP TABLE categoria;

CREATE TABLE categoia(
	categoria_id SERIAL PRIMARY KEY                            ,
  	categoria_nome VARCHAR (100) UNIQUE NOT NULL               ,
	created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);

DROP TABLE marca;

CREATE TABLE marca(
	marca_id SERIAL PRIMARY KEY                             ,
  	marca_nome VARCHAR (100) UNIQUE NOT NULL                ,
	created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);

DROP TABLE produto;

CREATE TABLE produto(
	produto_id SERIAL PRIMARY KEY                           ,
  	produto_nome VARCHAR (100) UNIQUE NOT NULL              ,
	produto_descricao TEXT                                  ,
    produto_estoque INTEGER                                 ,
    modelo_fk SERIAL REFERENCES modelo                      ,
    marca_fk SERIAL REFERENCES marca                        ,
    created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);

DROP TABLE produto_foto;

CREATE TABLE produto_foto(
	produto_foto_id SERIAL PRIMARY KEY                      ,
  	file_name VARCHAR (500) UNIQUE NOT NULL                 ,
    file_content BYTEA NOT NULL                             ,
    produto_fk SERIAL REFERENCES produto ON DELETE CASCADE  ,
	created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);

DROP TABLE estado;

CREATE TABLE estado(
	estado_id SERIAL PRIMARY KEY                            ,
    estado_nome VARCHAR (100)                               ,
  	created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);

DROP TABLE pedido;

CREATE TABLE pedido(
	pedido_id SERIAL PRIMARY KEY                            ,
    cliente_fk SERIAL REFERENCES cliente                    ,
  	created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);

DROP TABLE pedido_item;

CREATE TABLE pedido_item(
	produto_fk SERIAL REFERENCES produto                    ,
	pedido_fk SERIAL REFERENCES pedido ON DELETE CASCADE    ,
    pedido_item_quantidade INTEGER                          ,
    PRIMARY KEY (produto_fk, pedido_fk)                     ,
  	created_by VARCHAR (100)                                ,
	created_at TIMESTAMP                                    ,
	updated_by VARCHAR (100)                                ,
	updated_at TIMESTAMP                                    ,
	active BOOL default TRUE
);
