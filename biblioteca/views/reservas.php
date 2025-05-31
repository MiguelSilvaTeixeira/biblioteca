<?php
require_once("../painel/verificar.php");
require_once("../models/conexao.php");
$query = $pdo->query("SELECT res.id_reserva, liv.titulo, usr.nome, res.data_reserva, IF(res.retirado, 'Sim', 'Não') AS retirado FROM reservas res JOIN livros liv ON res.id_livro = liv.id_livro JOIN usuarios usr ON res.id_usuario = usr.id_usuario ORDER BY res.data_reserva DESC");
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
            <h1 id="titulo">Reservas</h1>
            <button class="add-button" onclick="abrirForm('add-overlay')">Adicionar</button>
            <button class="edit-button" onclick="abrirForm('edit-overlay')">Editar</button>
            <button class="retirado-button" onclick="abrirForm('retirado-overlay')">Retirado</button>
            <button class="remove-button" onclick="abrirForm('remove-overlay')">Remover</button>
            <div class="add-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('add-overlay')">&#10006;</button>
                    <h2>Inserir Registro</h2>
                    <form method="POST" action="../models/reserva/registrar_reserva.php">
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
                    <form method="POST" action="../models/reserva/editar_reserva.php">
                        <label for="id_reserva">Código da Reserva:</label>
                        <input type="number" id="id_reserva" name="id_reserva" required>
                        <br><br>

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
            <div class="retirado-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('retirado-overlay')">&#10006;</button>
                    <h2>Retirado</h2>
                    <form method="POST" action="../models/reserva/retirado_reserva.php">
                        <label for="id_reserva">Código de Reserva:</label>
                        <input type="number" id="id_reserva" name="id_reserva" required>
                        <br><br>

                        <label for="retirado">Retirado:</label>
                        <input type="checkbox" id="retirado" name="retirado" value="1" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <div class="remove-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('remove-overlay')">&#10006;</button>
                    <h2>Remover Registro</h2>
                    <form method="POST" action="../models/reserva/remover_reserva.php">
                        <label for="id_reserva">Código:</label>
                        <input type="number" id="id_reserva" name="id_reserva" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <table id="tabela-paginacao">
                <thead>
                    <tr>
                        <th>Código de Reserva</th>
                        <th>Título do Livro</th>
                        <th>Nome do Usuário</th>
                        <th>Data e Hora da Reserva</th>
                        <th>Retirado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res as $reservas): ?>
                        <tr>
                            <td><?php echo $reservas['id_reserva']; ?></td>
                            <td><?php echo $reservas['titulo']; ?></td>
                            <td><?php echo $reservas['nome']; ?></td>
                            <td><?php echo $reservas['data_reserva']; ?></td>
                            <td><?php echo $reservas['retirado']; ?></td>
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