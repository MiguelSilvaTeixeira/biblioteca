<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_livro = $_POST['id_livro'];
        $id_usuario = $_POST['id_usuario'];

        // Preparar a consulta SQL para inserir o emprestimo
        $query = $pdo->prepare("INSERT INTO emprestimos (id_livro, id_usuario) VALUES (:id_livro, :id_usuario)");

        // Executar a consulta com os valores dos parâmetros
        $query->execute(array(':id_livro' => $id_livro, ':id_usuario' => $id_usuario));

        // Verificar se a inserção foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/emprestimos.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao registrar o emprestimo!")</script>';
            echo '<script>window.location="../../views/emprestimos.php"</script>';
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao registrar o emprestimo!")</script>';
        echo '<script>window.location="../../views/emprestimos.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao registrar o emprestimo!")</script>';
    echo '<script>window.location="../../views/emprestimos.php"</script>';
}

?>