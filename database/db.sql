-- 1. Cria o banco de dados (se ele não existir)
CREATE DATABASE IF NOT EXISTS sistema_prato
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_0900_ai_ci;

-- 2. Avisa o MySQL para usar este banco de dados
USE sistema_prato;

-- 3. Cria primeiro a tabela que NÃO depende de ninguém (Pai)
CREATE TABLE usuario (   
  id_usuario int NOT NULL AUTO_INCREMENT,   
  nome varchar(50) DEFAULT NULL,   
  email varchar(100) DEFAULT NULL,   
  PRIMARY KEY (id_usuario) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 4. Cria por último a tabela que possui a Foreign Key (Filho)
CREATE TABLE prato (   
  id_prato int NOT NULL AUTO_INCREMENT,   
  id_usuario int DEFAULT NULL,   
  nome varchar(50) DEFAULT NULL,   
  descricao varchar(500) DEFAULT NULL,   
  preco decimal(10,2) DEFAULT NULL,   
  categoria varchar(50) DEFAULT NULL,   
  PRIMARY KEY (id_prato),   
  KEY fk_prato_usuario (id_usuario),   
  CONSTRAINT fk_prato_usuario FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;