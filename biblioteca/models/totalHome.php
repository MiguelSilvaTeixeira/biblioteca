<?php
require_once("conexao.php");
try {
    $queryLivros = $pdo->prepare("SELECT * FROM livros");
    $queryLivros->execute();
    $resLivros = $queryLivros->fetchAll(PDO::FETCH_ASSOC);
    $linhasLivros = @count($resLivros);

    $queryEmprestados = $pdo->prepare("SELECT * FROM emprestimos");
    $queryEmprestados->execute();
    $resEmprestados = $queryEmprestados->fetchAll(PDO::FETCH_ASSOC);
    $linhasEmprestados = @count($resEmprestados);

    $queryUsuarios = $pdo->prepare("SELECT * FROM usuarios");
    $queryUsuarios->execute();
    $resUsuarios = $queryUsuarios->fetchAll(PDO::FETCH_ASSOC);
    $linhasUsuarios = @count($resUsuarios);

    

} catch(PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
  }

?>