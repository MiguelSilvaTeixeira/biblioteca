<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_emprestimo = $_POST['id_emprestimo'];
        $data_devolucao = $_POST['data_devolucao'];

        // Preparar a consulta SQL para inserir a data de devolução
        $query = $pdo->prepare("UPDATE emprestimos SET data_devolucao = :data_devolucao WHERE id_emprestimo = :id_emprestimo");

        // Executar a consulta com os valores dos parâmetros
        $query->execute(array(':id_emprestimo' => $id_emprestimo, ':data_devolucao' => $data_devolucao));

        // Verificar se a inserção foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/emprestimos.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao inserir a data de devolução!")</script>';
            echo '<script>window.location="../../views/emprestimos.php"</script>';
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao inserir a data de devolução!")</script>';
        echo '<script>window.location="../../views/emprestimos.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao inserir a data de devolução!")</script>';
    echo '<script>window.location="../../views/emprestimos.php"</script>';
}

?>