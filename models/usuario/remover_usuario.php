<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_usuario = $_POST['id_usuario'];

        // Preparar a consulta SQL para remover o usuario
        $query = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");

        $query->bindValue(":id_usuario",$id_usuario);

        // Executar a consulta com os valores dos parâmetros
        $query->execute();

        // Verificar se a inserção foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/usuarios.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao remover o usuario!")</script>';
            echo '<script>window.location="../../views/usuarios.php"</script>';        
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao remover o usuario!")</script>';
        echo '<script>window.location="../../views/usuarios.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao remover o usuario!")</script>';
    echo '<script>window.location="../../views/usuarios.php"</script>';
}
?>