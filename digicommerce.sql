DROP DATABASE digi;
CREATE DATABASE digi;

\c digi;

DROP TABLE cliente;

CREATE TABLE cliente (
	cliente_id SERIAL PRIMARY KEY,
  	cliente_nome VARCHAR (100) NOT NULL,
    cliente_cpf VARCHAR(20) UNIQUE NOT NULL,
    cliente_email VARCHAR(50) NOT NULL,
    cliente_telefone VARCHAR(20),
    cliente_senha VARCHAR(255),
	created_by VARCHAR (100),
	created_at TIMESTAMP,
	updated_by VARCHAR (100),
	updated_at TIMESTAMP,
	active BOOL default TRUE
);

DROP TABLE endereco;

CREATE TABLE endereco(
	cliente_fk SERIAL PRIMARY KEY REFERENCES cliente,
  	endereco_cep VARCHAR (10) NOT NULL,
    endereco_logradouro VARCHAR(500) NOT NULL,
    endereco_numero VARCHAR(20) NOT NULL,
    endereco_cidade VARCHAR(50) NOT NULL,
    endereco_estado VARCHAR(50) NOT NULL,
	created_by VARCHAR (100),
	created_at TIMESTAMP,
	updated_by VARCHAR (100),
	updated_at TIMESTAMP,
	active BOOL default TRUE
);

DROP TABLE categoria;

CREATE TABLE categoia(
	categoria_id SERIAL PRIMARY KEY,
  	categoria_nome VARCHAR (100) UNIQUE NOT NULL,
	created_by VARCHAR (100),
	created_at TIMESTAMP,
	updated_by VARCHAR (100),
	updated_at TIMESTAMP,
	active BOOL default TRUE
);

DROP TABLE marca;

CREATE TABLE marca(
	marca_id SERIAL PRIMARY KEY,
  	marca_nome VARCHAR (100) UNIQUE NOT NULL,
	created_by VARCHAR (100),
	created_at TIMESTAMP,
	updated_by VARCHAR (100),
	updated_at TIMESTAMP,
	active BOOL default TRUE
);

DROP TABLE produto;

CREATE TABLE produto(
	produto_id SERIAL PRIMARY KEY,
  	produto_nome VARCHAR (100) UNIQUE NOT NULL,
	produto_descricao TEXT,
	produto_preco NUMERIC,
    produto_estoque INTEGER,
    catgoria_fk SERIAL REFERENCES categoria,
    marca_fk SERIAL REFERENCES marca,
    created_by VARCHAR (100),
	created_at TIMESTAMP,
	updated_by VARCHAR (100),
	updated_at TIMESTAMP,
	active BOOL default TRUE
);

DROP TABLE produto_foto;

CREATE TABLE produto_foto (
    produto_foto_id SERIAL PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(512) NOT NULL,
    file_size BIGINT,
    mime_type VARCHAR(100),
    produto_fk INTEGER NOT NULL REFERENCES produto(produto_id) ON DELETE CASCADE,
    is_primary BOOLEAN DEFAULT FALSE,
    created_by VARCHAR(100),
    created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    updated_by VARCHAR(100),
    updated_at TIMESTAMP WITH TIME ZONE,
    active BOOLEAN DEFAULT TRUE,
    CONSTRAINT unique_file_per_product UNIQUE (produto_fk, file_name)
);
DROP TABLE estado;

CREATE TABLE estado(
	estado_id SERIAL PRIMARY KEY,
    estado_nome VARCHAR (100),
  	created_by VARCHAR (100),
	created_at TIMESTAMP,
	updated_by VARCHAR (100),
	updated_at TIMESTAMP,
	active BOOL default TRUE
);

DROP TABLE pedido;

CREATE TABLE pedido(
	pedido_id SERIAL PRIMARY KEY,
    cliente_fk INTEGER REFERENCES cliente,
	total NUMERIC,
  	created_by VARCHAR (100),
	created_at TIMESTAMP,
	updated_by VARCHAR (100),
	updated_at TIMESTAMP,
	active BOOL default TRUE
);

DROP TABLE pedido_item;

CREATE TABLE pedido_item(
	produto_fk INTEGER REFERENCES produto,
	pedido_fk INTEGER REFERENCES pedido ON DELETE CASCADE,
    pedido_item_quantidade INTEGER,
    PRIMARY KEY (produto_fk, pedido_fk),
  	created_by VARCHAR (100),
	created_at TIMESTAMP,
	updated_by VARCHAR (100),
	updated_at TIMESTAMP,
	active BOOL default TRUE
);
