<?php 
    require_once "../model/functions.php";
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login - Bonfire</title>
        </head>

        <body>
            <form action="" method="post">
                <fieldset>
                    <legend>Login - Bonfire</legend>
                    <br>
                    <input type="email" name="email" placeholder="Email" required><br><br>
                    <input type="password" name="senha" placeholder="Senha" required><br><br><br>
                    <input type="submit" name="acessar" value="Entrar">
                </fieldset>
            </form>
            <?php
                if(isset($_POST['acessar']))
                {
                    logIn($conn);
                }
            ?>
            <br>
            <br>
            <br>

            
            <form action="" method="post">
                <fieldset>
                    <legend>Cadastrar - Bonfire</legend>
                    <br>
                    
                    <input type="text" name="nickCadastro" placeholder="Apelido" required><br><br>
                    <input type="email" name="emailCadastro" placeholder="Email" required><br><br>
                    <input type="password" name="senhaCadastro" placeholder="Senha" required><br><br>
                    <input type="password" name="senhaCadastroConfirma" placeholder="Confirmar senha" required><br><br><br>
                    <input type="submit" name="cadastrar" value="Cadastrar">
                </fieldset>
            </form>
            <?php signUp($conn);?>

            
        </body>
    </html>