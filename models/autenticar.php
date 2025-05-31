<?php
@session_start();

require_once("conexao.php");
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email and senha = :senha");
$query->bindValue(":email","$usuario");
$query->bindValue(":senha","$senha");
$query->execute();
$res = $query->fetchALL(PDO::FETCH_ASSOC);
$linhas = @count($res);

if($linhas > 0){
    $_SESSION['nome'] = $res[0]['nome'];
    $_SESSION['id_usuario'] = $res[0]['id_usuario'];
    $_SESSION['nivel'] = $res[0]['nivel'];
    
    echo '<script>window.location="../views/home.php"</script>';
} else {
    echo '<script>window.alert("Dados Incorretos!!")</script>';
    echo '<script>window.location="../views/index.php"</script>';
}
?>