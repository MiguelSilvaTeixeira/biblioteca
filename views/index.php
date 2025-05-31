<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="../public/style.css" />
        <link rel="icon" type="imagem/x-icon" href="../public/img/icone.png" />
        <title>Document</title>
    </head>
    <body>
        <div class="login">            
            <div class="form">
                <img src="../public/img/logo.png" alt="Logo" class="imagem" />
                <form method="post" action="../models/autenticar.php">
                    <input type="email" name="usuario" placeholder="Seu E-mail" required/>
                    <input type="password" name="senha" placeholder="Senha" required/>
                    <button>Login</button>
                </form>
            </div>
        </div>
    </body>
</html>