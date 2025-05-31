<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $matricula = $_POST['matricula'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $nivel = $_POST['nivel'];
        $senha = $_POST['senha'];    
        
        if(require_once("verificar_usuario.php")) {
            // Preparar a consulta SQL para inserir o usuario
            $query = $pdo->prepare("INSERT INTO usuarios (nome, email, matricula, telefone, endereco, nivel, senha) VALUES (:nome, :email, :matricula, :telefone, :endereco, :nivel, :senha)");

            // Executar a consulta com os valores dos parâmetros
            $query->execute(array(':nome' => $nome, ':email' => $email, ':telefone' => $telefone, ':matricula' => $matricula,':endereco' => $endereco, ':nivel' => $nivel, ':senha' => $senha));

            // Verificar se a inserção foi bem-sucedida
            if ($query->rowCount() > 0) {
                echo '<script>window.location="../../views/usuarios.php"</script>';
            } else {
                echo '<script>window.alert("Ocorreu um erro ao redistrar o usuario!")</script>';
                echo '<script>window.location="../../views/usuarios.php"</script>';
            }
        } else {
            header("Location: ../../views/usuarios.php");        
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao redistrar o usuario!")</script>';
        echo '<script>window.location="../../views/usuarios.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao redistrar o usuario!")</script>';
    echo '<script>window.location="../../views/usuarios.php"</script>';
}
?>