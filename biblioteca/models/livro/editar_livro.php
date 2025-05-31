<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_livro = $_POST['id_livro'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $editora = $_POST['editora'];
        $ano_publicacao = $_POST['ano_publicado'];
        $categoria = $_POST['categoria'];

        // Preparar a consulta SQL para inserir o livro
        $query = $pdo->prepare("UPDATE livros SET titulo = :titulo, autor = :autor, editora = :editora, ano_publicacao = :ano_publicacao, categoria = :categoria WHERE  id_livro = :id_livro");

        // Executar a consulta com os valores dos parâmetros
        $query->execute(array('id_livro' => $id_livro,':titulo' => $titulo, ':autor' => $autor, ':editora' => $editora ,':ano_publicacao' => $ano_publicacao, ':categoria' => $categoria));

        // Verificar se a inserção foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/livros.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao editar um livro!")</script>';
            echo '<script>window.location="../../views/livros.php"</script>';
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao editar um livro!")</script>';
        echo '<script>window.location="../../views/livros.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao editar um livro!")</script>';
    echo '<script>window.location="../../views/livros.php"</script>';
}
?>