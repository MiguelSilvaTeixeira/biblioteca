<?php
require_once("../painel/verificar.php");
require_once("../models/conexao.php");
$query = $pdo->query("SELECT his.acao, his.data_registro, liv.titulo, usr.nome, his.data_emprestimo, his.data_devolucao FROM historico his JOIN livros liv ON his.id_livro = liv.id_livro JOIN usuarios usr ON his.id_usuario = usr.id_usuario ORDER BY his.data_registro DESC");
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
            <h1 id="titulo-historico">Histórico</h1>
            <table id="tabela-paginacao">
                <thead>
                    <tr>
                        <th>Ação</th>
                        <th>Data e Hora Registrada</th>
                        <th>Título do Livro</th>
                        <th>Usuário</th>
                        <th>Data de Emprestimo</th>
                        <th>Data de Devolução</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res as $historico): ?>
                        <tr>
                            <td><?php echo $historico['acao']; ?></td>
                            <td><?php echo $historico['data_registro']; ?></td>
                            <td><?php echo $historico['titulo']; ?></td>
                            <td><?php echo $historico['nome']; ?></td>
                            <td><?php echo $historico['data_emprestimo']; ?></td>
                            <td><?php echo $historico['data_devolucao']; ?></td>
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