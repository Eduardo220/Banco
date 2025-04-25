-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS loja;
USE loja;

-- Criar tabela produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT DEFAULT 0
);

-- Inserir dados
INSERT INTO produtos (nome, preco, estoque) VALUES 
    ('Mouse Gamer', 120.50, 30),
    ('Teclado Mecânico', 250.00, 15),
    ('Monitor 24"', 899.90, 10),
    ('Cadeira Gamer', 1299.00, 5);

-- Mostrar os dados
SELECT * FROM produtos;

-- Atualizar produto
UPDATE produtos
SET preco = 199.90
WHERE nome = 'Mouse Gamer';

-- Deletar um produto
DELETE FROM produtos
WHERE nome = 'Cadeira Gamer';

-- Mostrar estrutura da tabela
DESCRIBE produtos;

-- (Opcional) Excluir tudo
-- DROP TABLE produtos;
-- DROP DATABASE loja;
