<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_reserva = $_POST['id_reserva'];
        
        // Preparar a consulta SQL para atualizar a reserva
        $query = $pdo->prepare("DELETE FROM reservas WHERE id_reserva = :id_reserva;");

        // Executar a consulta com os valores dos parâmetros
        $query->bindValue("id_reserva","$id_reserva");
        $query->execute();

        // Verificar se a inserção foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/reservas.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao remover a reserva!")</script>';
            echo '<script>window.location="../../views/reservas.php"</script>';
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao remover a reserva!")</script>';
        echo '<script>window.location="../../views/reservas.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao remover a reserva!")</script>';
    echo '<script>window.location="../../views/reservas.php"</script>';
}

?>