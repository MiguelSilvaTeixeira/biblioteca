<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_usuario = $_POST['id_usuario'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $nivel = $_POST['nivel'];
        $senha = $_POST['senha'];    
        
        if(require_once("verificar_usuario.php")) {
            // Preparar a consulta SQL para atualizar o usuario
            $query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, nivel = :nivel, senha = :senha WHERE id_usuario = :id_usuario");

            // Executar a consulta com os valores dos parâmetros
            $query->execute(array('id_usuario' => $id_usuario,':nome' => $nome, ':email' => $email, ':telefone' => $telefone ,':endereco' => $endereco, ':nivel' => $nivel, ':senha' => $senha));

            // Verificar se a inserção foi bem-sucedida
            if ($query->rowCount() > 0) {
                echo '<script>window.location="../../views/usuarios.php"</script>';
            } else {
                echo '<script>window.alert("Ocorreu um erro ao atualizar o usuario!")</script>';
                echo '<script>window.location="../../views/usuarios.php"</script>';
            }
        } else {
            header("Location: ../../views/usuarios.php");
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao atualizar o usuario!")</script>';
        echo '<script>window.location="../../views/usuarios.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao atualizar o usuario!")</script>';
    echo '<script>window.location="../../views/usuarios.php"</script>';
}

?>