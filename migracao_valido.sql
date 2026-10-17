-- Executar uma única vez na base de dados existente, SE a coluna valido ainda não existir.
-- Confirmar previamente com SHOW COLUMNS FROM utilizador LIKE 'valido';
ALTER TABLE utilizador ADD COLUMN valido TINYINT(1) NOT NULL DEFAULT 1;
