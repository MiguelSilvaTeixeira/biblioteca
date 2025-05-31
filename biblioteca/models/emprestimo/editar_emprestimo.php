<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_livro = $_POST['id_livro'];
        $id_usuario = $_POST['id_usuario'];

        // Preparar a consulta SQL para atualizar o empréstimo
        $query = $pdo->prepare("UPDATE emprestimos SET id_livro = :id_livro, id_usuario = :id_usuario WHERE id_emprestimo = :id_emprestimo");

        // Executar a consulta com os valores dos parâmetros
        $query->execute(array(':id_livro' => $id_livro, ':id_usuario' => $id_usuario, ':id_emprestimo' => $_POST['id_emprestimo']));

        // Verificar se a atualização foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/emprestimos.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao editar o emprestimo!")</script>';
            echo '<script>window.location="../../views/emprestimos.php"</script>';
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao editar o emprestimo!")</script>';
        echo '<script>window.location="../../views/emprestimos.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao editar o emprestimo!")</script>';
    echo '<script>window.location="../../views/emprestimos.php"</script>';
}
?>
