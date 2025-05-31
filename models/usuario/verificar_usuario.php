<?php
try {
    // Preparar a consulta SQL para verificar o usuario
    $query = $pdo->prepare("SELECT * FROM usuarios WHERE (email = :email OR telefone = :telefone) AND id_usuario != :id_usuario");

    $query->bindValue(":email","$email");
    $query->bindValue(":telefone","$telefone");
    $query->bindValue(":id_usuario","$id_usuario");
    // Executar a consulta com os valores dos parâmetros
    $query->execute();
    $res = $query->fetchALL(PDO::FETCH_ASSOC);
    $linhas = @count($res);

    // Verificar se a inserção foi bem-sucedida
    if ($linhas == 0) {
        return true;
    } else {
        return false;
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao verificar o usuario!")</script>';
    echo '<script>window.location="../../views/usuarios.php"</script>';
}
?>