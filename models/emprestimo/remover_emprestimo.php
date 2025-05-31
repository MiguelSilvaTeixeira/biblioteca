<?php
require_once("../conexao.php");

try {
    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $id_emprestimo = $_POST['id_emprestimo'];

        // Preparar a consulta SQL para remover o emprestimo
        $query = $pdo->prepare("DELETE FROM emprestimos WHERE id_emprestimo = :id_emprestimo");

        $query->bindValue(":id_emprestimo",$id_emprestimo);

        // Executar a consulta com os valores dos parâmetros
        $query->execute();

        // Verificar se a inserção foi bem-sucedida
        if ($query->rowCount() > 0) {
            echo '<script>window.location="../../views/emprestimos.php"</script>';
        } else {
            echo '<script>window.alert("Ocorreu um erro ao remover o emprestimo!")</script>';
            echo '<script>window.location="../../views/emprestimos.php"</script>';
        }
    } else {
        echo '<script>window.alert("Ocorreu um erro ao remover o emprestimo!")</script>';
        echo '<script>window.location="../../views/emprestimos.php"</script>';
    }
} catch(PDOException $e) {
    echo '<script>window.alert("Ocorreu um erro ao remover o emprestimo!")</script>';
    echo '<script>window.location="../../views/emprestimos.php"</script>';
}

?>