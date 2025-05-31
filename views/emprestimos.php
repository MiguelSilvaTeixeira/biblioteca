<?php
require_once("../painel/verificar.php");
require_once("../models/conexao.php");
$query = $pdo->query("SELECT emp.id_emprestimo, liv.titulo, usr.nome, emp.data_emprestimo, emp.data_devolucao FROM emprestimos emp JOIN livros liv ON emp.id_livro = liv.id_livro JOIN usuarios usr ON emp.id_usuario = usr.id_usuario ORDER BY emp.data_emprestimo DESC");
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
            <h1 id="titulo">Empréstimos</h1>
            <button class="add-button" onclick="abrirForm('add-overlay')">Adicionar</button>
            <button class="edit-button" onclick="abrirForm('edit-overlay')">Editar</button>
            <button class="devolucao-button" onclick="abrirForm('devolucao-overlay')">Devolução</button>
            <button class="remove-button" onclick="abrirForm('remove-overlay')">Remover</button>
            <div class="add-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('add-overlay')">&#10006;</button>
                    <h2>Inserir Registro</h2>
                    <form method="POST" action="../models/emprestimo/registrar_emprestimo.php">
                        <label for="id_livro">Código do Livro:</label>
                        <input type="number" id="id_livro" name="id_livro" required>
                        <br><br>

                        <label for="id_usuario">Código do Usuário:</label>
                        <input type="number" id="id_usuario" name="id_usuario" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <div class="edit-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('edit-overlay')">&#10006;</button>
                    <h2>Editar Registro</h2>
                    <form method="POST" action="../models/emprestimo/editar_emprestimo.php">
                        <label for="id_emprestimo">Código do Empréstimo:</label>
                        <input type="number" id="id_emprestimo" name="id_emprestimo" required>
                        <br><br>

                        <label for="id_livro">Código do Livro:</label>
                        <input type="text" id="id_livro" name="id_livro" required>
                        <br><br>

                        <label for="id_usuario">Código do Usuário:</label>
                        <input type="number" id="id_usuario" name="id_usuario" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <div class="devolucao-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('devolucao-overlay')">&#10006;</button>
                    <h2>Editar Registro</h2>
                    <form method="POST" action="../models/emprestimo/devolucao_emprestimo.php">
                        <label for="id_emprestimo">Código do Empréstimo:</label>
                        <input type="number" id="id_emprestimo" name="id_emprestimo" required>
                        <br><br>

                        <label for="data_devolucao">Data de Devolução:</label>
                        <input type="date" id="data_devolucao" name="data_devolucao" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <div class="remove-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('remove-overlay')">&#10006;</button>
                    <h2>Remover Registro</h2>
                    <form method="POST" action="../models/emprestimo/remover_emprestimo.php">
                        <label for="id_livro">Código:</label>
                        <input type="number" id="id_emprestimo" name="id_emprestimo" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <table id="tabela-paginacao">
                <thead>
                    <tr>
                        <th>Código de Empréstimo</th>
                        <th>Título do Livro</th>
                        <th>Nome do Usuário</th>
                        <th>Data de Empréstimo</th>
                        <th>Data de Devolução</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res as $emprestimos): ?>
                        <tr>
                            <td><?php echo $emprestimos['id_emprestimo']; ?></td>
                            <td><?php echo $emprestimos['titulo']; ?></td>
                            <td><?php echo $emprestimos['nome']; ?></td>
                            <td><?php echo $emprestimos['data_emprestimo']; ?></td>
                            <td><?php echo $emprestimos['data_devolucao']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <tbody>
            </table>
            <div id="paginacao">
                <button onclick="paginaAnterior()">Página anterior</button>
                <button onclick="proximaPagina()">Próxima página</button>
            </div>
        </div>
        <script type="text/javascript" src="../public/script.js"></script>
    </body>
</html>