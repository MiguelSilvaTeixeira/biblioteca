<?php
require_once("../painel/verificar.php");
require_once("../models/conexao.php");
$query = $pdo->query("SELECT id_livro, titulo, autor, editora, ano_publicacao, categoria, IF(disponivel, 'Sim', 'Não') as disponivel FROM livros");
$res = $query->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../public/style.css" />
        <link rel="stylesheet" type="text/css" href="../public/tabela.css" />
        <link rel="stylesheet" type="text/css" href="../public/popup.css" />        
        <link rel="icon" type="imagem/x-icon" href="../public/img/icone.png" />
        <title>Library Kappa</title>
    </style>
    </head>
    <body>
        <nav>
            <div class="logo">
                <h1>LIBRARY</h1>
                <p>KAPPA</p>
            </div>
            <ul class="navbar">
                <li><a href="home.php">Home</a></li>
                <li><a href="livros.php">Livros</a></li>
                <li><a href="emprestimos.php">Empréstimos</a></li>
                <li><a href="reservas.php">Reservas</a></li>
                <li><a href="usuarios.php">Usuários</a></li>
                <li><a href="historico.php">Historico</a></li>
            </ul>
            <div class="user-info">
                <p><?php echo $_SESSION['nome'].' | '.$_SESSION['nivel'];?></p>
                <button onclick="sair()">Sair</a></button>
            </div>
        </nav>        
        <div class="table-container">
            <h1 id="titulo">Livros</h1>
            <button class="add-button" onclick="abrirForm('add-overlay')">Adicionar</button>
            <button class="edit-button" onclick="abrirForm('edit-overlay')">Editar</button>
            <button class="remove-button" onclick="abrirForm('remove-overlay')">Remover</button>
            <div class="add-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('add-overlay')">&#10006;</button>
                    <h2>Inserir Registro</h2>
                    <form method="POST" action="../models/livro/registrar_livro.php">
                        <label for="titulo">Titulo:</label>
                        <input type="text" id="titulo" name="titulo" required>
                        <br><br>

                        <label for="autor">Autor:</label>
                        <input type="text" id="autor" name="autor" required>
                        <br><br>

                        <label for="editora">Editora:</label>
                        <input type="text" id="editora" name="editora" required>
                        <br><br>

                        <label for="ano_publicacao">Ano Publicado:</label>
                        <input type="number" id="ano_publicacao" name="ano_publicacao" required>
                        <br><br>

                        <label for="categoria">Categoria:</label>
                        <input type="text" id="categoria" name="categoria" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <div class="edit-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('edit-overlay')">&#10006;</button>
                    <h2>Editar Registro</h2>
                    <form method="POST" action="../models/livro/editar_livro.php">
                        <label for="id_livro">Código:</label>
                        <input type="number" id="id_livro" name="id_livro" required>
                        <br><br>

                        <label for="titulo">Titulo:</label>
                        <input type="text" id="titulo" name="titulo" required>
                        <br><br>

                        <label for="autor">Autor:</label>
                        <input type="text" id="autor" name="autor" required>
                        <br><br>

                        <label for="editora">Editora:</label>
                        <input type="text" id="editora" name="editora" required>
                        <br><br>

                        <label for="ano_publicacao">Ano Publicado:</label>
                        <input type="number" id="ano_publicacao" name="ano_publicacao" required>
                        <br><br>

                        <label for="categoria">Categoria:</label>
                        <input type="text" id="categoria" name="categoria" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <div class="remove-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('remove-overlay')">&#10006;</button>
                    <h2>Remover Registro</h2>
                    <form method="POST" action="../models/livro/remover_livro.php">
                        <label for="id_livro">Código:</label>
                        <input type="number" id="id_livro" name="id_livro" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <table id="tabela-paginacao">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>Ano de Publicação</th>
                        <th>Categoria</th>
                        <th>Disponível</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res as $livros): ?>
                        <tr>
                            <td><?php echo $livros['id_livro']; ?></td>
                            <td><?php echo $livros['titulo']; ?></td>
                            <td><?php echo $livros['autor']; ?></td>
                            <td><?php echo $livros['editora']; ?></td>
                            <td><?php echo $livros['ano_publicacao']; ?></td>
                            <td><?php echo $livros['categoria']; ?></td>
                            <td><?php echo $livros['disponivel']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="paginacao">
                <button onclick="paginaAnterior()">Página anterior</button>
                <button onclick="proximaPagina()">Próxima página</button>
            </div>
        </div>
        <script type="text/javascript" src="../public/script.js"></script>
    </body>
</html>