<?php 
    require_once "../model/functions.php";
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location: ./logIn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bonfire </title>
</head>
<body>
    <?php
        if($verify)
        {
            setPreferences($conn);
    ?>
            <h1>Home</h1>
            <h3>Bem-vind<?php echo $_SESSION['genderId'] . ", " . $_SESSION['nick'] . "!"; ?></h3><br>

            <a href="../../helpers/logOut.php">SAIR</a>
            <a href="./index.php?id="<?php echo $_SESSION['idConta'];?>>EXCLUIR CONTA</a>
    <?php
        }
    ?>
</body>
</html>