-- Criação do banco de dados
CREATE DATABASE UPLOAD;

-- Acessar o banco de dados criado
\c UPLOAD;

-- Criação da tabela files
CREATE TABLE files (
  id SERIAL PRIMARY KEY,
  file_name varchar(255),
  file_size int,
  file_type varchar(100),
  uploaded_at timestamp DEFAULT current_timestamp
);

-- Inserção de dados na tabela files
INSERT INTO files (file_name, file_size, file_type, uploaded_at) VALUES
('PHP.png', 12007, 'png', '2024-03-29 16:00:00');
