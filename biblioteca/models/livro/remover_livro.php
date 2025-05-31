<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_livro = $_POST['id_livro'];

        // Preparar a consulta SQL para inserir o livro
        $query = $pdo->prepare("DELETE FROM livros WHERE id_livro = :id_livro");

        // Executar a consulta com os valores dos parâmetros
        $query->execute(array(':id_livro' => $id_livro));

        // Verificar se a inserção foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/livros.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao remover um livro!")</script>';
            echo '<script>window.location="../../views/livros.php"</script>';        
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao remover um livro!")</script>';
        echo '<script>window.location="../../views/livros.php"</script>'; 
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao remover um livro!")</script>';
    echo '<script>window.location="../../views/livros.php"</script>'; 
}

?>