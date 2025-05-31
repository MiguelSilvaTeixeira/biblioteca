/*Biblioteca.sql*/
CREATE DATABASE biblioteca;

USE biblioteca;

CREATE TABLE livros (
	id_livro INT AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR(120) NOT NULL,
	autor VARCHAR(120) NOT NULL,
	editora VARCHAR(120) NOT NULL,
	ano_publicacao INT,
	categoria VARCHAR(120),
	disponivel BOOLEAN DEFAULT true
);

CREATE TABLE usuarios (
id_usuario INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(120) NOT NULL,
	email VARCHAR(120) NOT NULL,
	matricula INT(6) NOT NULL,
	telefone VARCHAR(11) CHECK (telefone REGEXP '^[0-9]{10,11}$'),
	endereco VARCHAR(120),
	nivel VARCHAR(50) NOT NULL,
	senha VARCHAR(120) NOT NULL CHECK (LENGTH(senha) >= 6)
);

CREATE TABLE emprestimos (
	id_emprestimo INT AUTO_INCREMENT PRIMARY KEY,
	id_livro INT,
	id_usuario INT,
	data_emprestimo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	data_devolucao DATE,
	FOREIGN KEY (id_livro) REFERENCES livros(id_livro) ON DELETE CASCADE,
	FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

CREATE TABLE Historico (
id_historico INT PRIMARY KEY AUTO_INCREMENT,
id_usuario INT,
id_livro INT,
data_emprestimo DATE,
data_devolucao DATE,
data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
acao VARCHAR(50),
FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
FOREIGN KEY (id_livro) REFERENCES livros(id_livro) ON DELETE CASCADE
);

CREATE TABLE RESERVAS (
	id_reserva INT AUTO_INCREMENT PRIMARY KEY,
	id_livro INT,
	id_usuario INT,	
	retirado BOOLEAN DEFAULT false,
data_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
	FOREIGN KEY (id_livro) REFERENCES livros(id_livro) ON DELETE CASCADE
);

DELIMITER $$
CREATE TRIGGER RegistrarHistorico_AfterInsert_Emprestimos
AFTER INSERT ON emprestimos
FOR EACH ROW
BEGIN
    DECLARE acao VARCHAR(50);
    DECLARE reservas_ativas INT;
    DECLARE emprestimos_ativos INT;

    SET acao = 'Inserção de Empréstimo';

    -- Inserir o registro na tabela "Historico"
    INSERT INTO Historico (id_usuario, id_livro, data_emprestimo, data_devolucao, acao)
    VALUES (NEW.id_usuario, NEW.id_livro, NEW.data_emprestimo, NEW.data_devolucao, acao);

    -- Verificar se há empréstimos ativos para o livro
    SELECT COUNT(*) INTO emprestimos_ativos FROM emprestimos WHERE id_livro = NEW.id_livro AND data_devolucao IS NULL;

    -- Verificar se há reservas ativas para o livro
    SELECT COUNT(*) INTO reservas_ativas FROM reservas WHERE id_livro = NEW.id_livro AND data_reserva > NOW();

    -- Atualizar a disponibilidade do livro com base nos empréstimos e reservas
    IF emprestimos_ativos > 0 OR reservas_ativas > 0 THEN
        UPDATE livros SET disponivel = false WHERE id_livro = NEW.id_livro; -- Indisponível
    ELSE
        UPDATE livros SET disponivel = true WHERE id_livro = NEW.id_livro; -- Disponível
    END IF;
END$$

CREATE TRIGGER RegistrarHistorico_AfterUpdate_Emprestimos
AFTER UPDATE ON emprestimos
FOR EACH ROW
BEGIN
    DECLARE acao VARCHAR(50);
    DECLARE reservas_ativas INT;
    DECLARE emprestimos_ativos INT;

    SET acao = 'Atualização de Empréstimo';

    -- Inserir o registro na tabela "Historico"
    INSERT INTO Historico (id_usuario, id_livro, data_emprestimo, data_devolucao, acao)
    VALUES (NEW.id_usuario, NEW.id_livro, NEW.data_emprestimo, NEW.data_devolucao, acao);

    -- Verificar se há empréstimos ativos para o livro
    SELECT COUNT(*) INTO emprestimos_ativos FROM emprestimos WHERE id_livro = NEW.id_livro AND data_devolucao IS NULL;

    -- Verificar se há reservas ativas para o livro
    SELECT COUNT(*) INTO reservas_ativas FROM reservas WHERE id_livro = NEW.id_livro AND data_reserva > NOW();

    -- Atualizar a disponibilidade do livro com base nos empréstimos e reservas
    IF emprestimos_ativos > 0 OR reservas_ativas > 0 THEN
        UPDATE livros SET disponivel = false WHERE id_livro = NEW.id_livro; -- Indisponível
    ELSE
        UPDATE livros SET disponivel = true WHERE id_livro = NEW.id_livro; -- Disponível
    END IF;
END$$

CREATE TRIGGER RegistrarHistorico_AfterDelete_Emprestimos
AFTER DELETE ON emprestimos
FOR EACH ROW
BEGIN
    DECLARE acao VARCHAR(50);
    DECLARE reservas_ativas INT;
    DECLARE emprestimos_ativos INT;

    SET acao = 'Exclusão de Empréstimo';

    -- Inserir o registro na tabela "Historico"
    INSERT INTO Historico (id_usuario, id_livro, data_emprestimo, data_devolucao, acao)
    VALUES (OLD.id_usuario, OLD.id_livro, OLD.data_emprestimo, OLD.data_devolucao, acao);

    -- Verificar se há empréstimos ativos para o livro
    SELECT COUNT(*) INTO emprestimos_ativos FROM emprestimos WHERE id_livro = OLD.id_livro AND data_devolucao IS NULL;

    -- Verificar se há reservas ativas para o livro
    SELECT COUNT(*) INTO reservas_ativas FROM reservas WHERE id_livro = OLD.id_livro AND data_reserva > NOW();

    -- Atualizar a disponibilidade do livro com base nos empréstimos e reservas
    IF emprestimos_ativos > 0 OR reservas_ativas > 0 THEN
        UPDATE livros SET disponivel = false WHERE id_livro = OLD.id_livro; -- Indisponível
    ELSE
        UPDATE livros SET disponivel = true WHERE id_livro = OLD.id_livro; -- Disponível
    END IF;
END$$
DELIMITER ;

-- Inserir livro 1
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("O Pequeno Príncipe", "Antoine de Saint-Exupéry", "Agir", 1943, "Literatura Infantojuvenil", true);

-- Inserir livro 2
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("Memórias Póstumas de Brás Cubas", "Machado de Assis", "Nova Aguilar", 1881, "Ficção", true);

-- Inserir livro 3
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("Dom Casmurro", "Machado de Assis", "B. L. Garnier", 1899, "Romance", true);

-- Inserir livro 4
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("O Cortiço", "Aluísio Azevedo", "B. L. Garnier", 1890, "Romance", true);

-- Inserir livro 5
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("Iracema", "José de Alencar", "Grupo Companhia das Letras", 1865, "Romance", true);

-- Inserir livro 6
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("Morte e Vida Severina", "João Cabral de Melo Neto", "TUCA", 1955, "Poesia", true);

-- Inserir livro 7
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("Manifesto Comunista", "Friedrich Engels e Karl Marx", "J.E. Burckhardt", 1848, "Filosofia Política", true);

-- Inserir livro 8
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("Harry Potter e a Pedra Filosofal", "J.K. Rowling", "Bloomsbury Publishing", 1997, "Fantasia", true);

-- Inserir livro 9
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("1984", "George Orwell", "Secker & Warburg", 1949, "Distopia", true);

-- Inserir livro 10
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("O Senhor dos Anéis", "J.R.R. Tolkien", "Allen & Unwin", 1954, "Fantasia", true);

-- Inserir livro 11
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("Orgulho e Preconceito", "Jane Austen", "T. Egerton, Whitehall", 1813, "Romance", true);

-- Inserir livro 12
INSERT INTO livros (Titulo, Autor, Editora, Ano_Publicacao, Categoria, Disponivel)
VALUES ("A Origem das Espécies", "Charles Darwin", "John Murray", 1859, "Ciências Naturais", true);

-- Inserir usuário 1
INSERT INTO usuarios (Nome, Endereco, Email, Matricula, Telefone, Nivel, Senha)
VALUES ("Miguel", "Rua X, 321", "miguel.admin@gmail.com", 8782, 1140028922, "Administrador", 'admin1');

-- Inserir usuário 2
INSERT INTO usuarios (Nome, Endereco, Email, Matricula, Telefone, Nivel, Senha)
VALUES ("Ana Silva", "Rua A, 123", "ana.silva@gmail.com", 2311, 11012345678, "Normal", '123456');

-- Inserir usuário 3
INSERT INTO usuarios (Nome, Endereco, Email, Matricula, Telefone, Nivel, Senha)
VALUES ("Pedro Santos", "Rua B, 456", "pedro.santos@gmail.com", 3472, 11987654321, "Normal", '123456');

-- Inserir empréstimo 1
INSERT INTO emprestimos (ID_Livro, ID_Usuario, Data_Emprestimo, Data_Devolucao)
VALUES (1, 2, '2023-04-16', '2023-04-23');

-- Inserir empréstimo 2
INSERT INTO emprestimos (ID_Livro, ID_Usuario, Data_Emprestimo, Data_Devolucao)
VALUES (2, 3, '2023-04-17', '2023-04-24');

INSERT INTO reservas (id_livro, id_usuario) VALUE (1, 2);