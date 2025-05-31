<?php
require_once("../painel/verificar.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../public/style.css" />
        <link rel="icon" type="imagem/x-icon" href="../public/img/icone.png" />
        <script type="text/javascript" src="../public/script.js"></script>
        <title>Library Kappa</title>
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
        <?php require_once('../models/totalHome.php');?>
        <h1 id="titulo">Home</h1>
        <div class="container">            
            <button class="button-homem" onclick="buttonRedirect('livro')">
                    <img src="../public/img/icone-livro.png" alt="livro" class="icone"></img>
                    <h2><strong><?php echo $linhasLivros  ?></strong></h2>
                    <spam>Livros</spam>
            </button>
            <button class="button-homem" onclick="buttonRedirect('emprestimo')">
                    <img src="../public/img/icone-emprestado.png" alt="Emprestado" class="icone"></img>
                    <h2><strong><?php echo $linhasEmprestados  ?></strong></h2>
                    <spam>Emprestados</spam>
            </button>
            <button class="button-homem" onclick="buttonRedirect('usuario')">
                <img src="../public/img/icone-usuario.png" alt="Usuario" class="icone"></img>
                <h2><strong><?php echo $linhasUsuarios  ?></strong></h2>
                <spam>Leitores</spam>
            </button>
        </div>
    </body>
</html>