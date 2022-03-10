CREATE DATABASE IF NOT EXISTS TasksManager;
-- USE TasksManager;
CREATE TABLE IF NOT EXISTS tasks(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    completed BOOL NOT NULL,
    prioridade TINYINT(3) NOT NULL,
    date_time date NOT NULL
);
CREATE TABLE IF NOT EXISTS attachments(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    task_id INTEGER NOT NULL,
    nome VARCHAR(255) NOT NULL,
    file_ext VARCHAR(255) NOT NULL
);