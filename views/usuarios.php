<?php
require_once("../painel/verificar.php");
require_once("../models/conexao.php");
$query = $pdo->query("SELECT * FROM usuarios");
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
        <script type="text/javascript" src="../public/script.js"></script>
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
            <h1 id="titulo">Usuários</h1>
            <button class="add-button" onclick="abrirForm('add-overlay')">Adicionar</button>
            <button class="edit-button" onclick="abrirForm('edit-overlay')">Editar</button>
            <button class="remove-button" onclick="abrirForm('remove-overlay')">Remover</button>
            <div class="add-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('add-overlay')">&#10006;</button>
                    <h2>Inserir Registro</h2>
                    <form method="POST" action="../models/usuario/registrar_usuario.php">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required>
                        <br><br>

                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email">
                        <br><br>

                        <label for="matricula">Matricula:</label>
                        <input type="number" id="matricula" name="matricula">
                        <br><br>

                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" pattern="[0-9]{10,11}" required>
                        <br><br>

                        <label for="endereco">Endereço:</label>
                        <input type="text" id="endereco" name="endereco">
                        <br><br>

                        <label for="nivel">Nível de Acesso:</label>
                        <select id="nivel" name="nivel">
                            <option value="Administrador">Administrador</option>
                            <option value="Normal">Normal</option>
                        </select>
                        <br><br>

                        <label for="senha">Senha:</label>
                        <input type="password" id="senha-add1" name="senha" oninput="verificarSenhas('add-overlay')" required>
                        <br><br>

                        <label for="senha">Confirmar:</label>
                        <input type="password" id="senha-add2" oninput="verificarSenhas('add-overlay')" required>
                        <br><br>

                        <input type="submit" disabled value="Enviar" id="enviar-add">
                    </form>
                </div>
            </div>
            <div class="edit-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('edit-overlay')">&#10006;</button>
                    <h2>Editar Registro</h2>
                    <form method="POST" action="../models/usuario/editar_usuario.php">
                        <label for="id_usuario">Código:</label>
                        <input type="number" id="id_usuario" name="id_usuario" required>
                        <br><br>

                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required>
                        <br><br>

                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email">
                        <br><br>

                        <label for="matricula">Matricula:</label>
                        <input type="number" id="matricula" name="matricula">
                        <br><br>
                        
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" pattern="[0-9]{10,11}" required>
                        <br><br>

                        <label for="endereco">Endereço:</label>
                        <input type="text" id="endereco" name="endereco">
                        <br><br>

                        <label for="nivel">Nível de Acesso:</label>
                        <select id="nivel" name="nivel">
                            <option value="Administrador">Administrador</option>
                            <option value="Normal">Normal</option>
                        </select>
                        <br><br>

                        <label for="senha">Senha:</label>
                        <input type="password" id="senha-edit1" name="senha" oninput="verificarSenhas('edit-overlay')" required>
                        <br><br>

                        <label for="senha">Confirmar:</label>
                        <input type="password" id="senha-edit2" oninput="verificarSenhas('edit-overlay')" required>
                        <br><br>

                        <input type="submit" disabled value="Enviar" id="enviar-edit">
                    </form>
                </div>
            </div>
            <div class="remove-overlay">
                <div class="form-container">
                    <button class="close-button" onclick="fecharForm('remove-overlay')">&#10006;</button>
                    <h2>Remover Registro</h2>
                    <form method="POST" action="../models/usuario/remover_usuario.php">
                        <label for="id_usuario">Código:</label>
                        <input type="number" id="id_usuario" name="id_usuario" required>
                        <br><br>

                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <table id="tabela-paginacao">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Matricula</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Nível de Acesso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res as $usuarios): ?>
                        <tr>
                            <td><?php echo $usuarios['id_usuario']; ?></td>
                            <td><?php echo $usuarios['nome']; ?></td>
                            <td><?php echo $usuarios['email']; ?></td>
                            <td><?php echo $usuarios['matricula']; ?></td>
                            <td><?php echo $usuarios['telefone']; ?></td>
                            <td><?php echo $usuarios['endereco']; ?></td>
                            <td><?php echo $usuarios['nivel']; ?></td>
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