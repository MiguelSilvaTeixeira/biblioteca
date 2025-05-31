<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_reserva = $_POST['id_reserva']; 
        $id_livro = $_POST['id_livro'];  
        $id_usuario = $_POST['id_usuario'];
        
        // Preparar a consulta SQL para atualizar a reserva
        $query = $pdo->prepare("UPDATE reservas SET id_livro = :id_livro, id_usuario = :id_usuario WHERE id_reserva = :id_reserva");

        // Executar a consulta com os valores dos parâmetros
        $query->execute(array(':id_reserva' => $id_reserva,':id_usuario' => $id_usuario, ':id_livro' => $id_livro));

        // Verificar se a inserção foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/reservas.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao editar a reserva!")</script>';
            echo '<script>window.location="../../views/reservas.php"</script>';
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao editar a reserva!")</script>';
        echo '<script>window.location="../../views/reservas.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao editar a reserva!")</script>';
    echo '<script>window.location="../../views/reservas.php"</script>';
}

?>