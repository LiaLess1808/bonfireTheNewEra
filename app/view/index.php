<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location: ./logIn.php");
    require_once "../model/functions.php";
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
                $table = "Usuario";
                $users = generalQuery($conn, $table);

                if($verify)
                {
                    setPreferences($conn);
            ?>
                    <h1>Home</h1>
                    <h3>Bem-vind<?php echo $_SESSION['genderId'] . ", " . $_SESSION['nick'] . "!"; ?></h3><br>

                    <a href="../../helpers/logOut.php">SAIR</a><br><br>
                    <a href="./index.php?id=<?php echo $_SESSION['idConta'];?>&n=<?php echo $_SESSION['nick'];?>">EXCLUIR CONTA</a>
                    <br><br>
            <?php
                }

                foreach($users as $user):
                    echo $user['idConta'];
                endforeach;
                
                if(isset($_GET['id']))
                {
                    ?>
                        <h2>Tem certeza que deseja deletar sua conta?</h2>
                        <form action="" method="post">
                            <input type="hidden" name = "idDeleter" value = <?php echo $_GET['id']?>>
                            <input type="text" placeholder="<?php echo "delete/".$_GET['id']."/".$_GET['n']?>" name="confirmaTexto"><br><br>
                            
                            <input type="submit" name="deletar" value="Excluir conta">
                        </form>
                    <?php
                }

            ?>
            <?php 
                if(isset($_POST['deletar']))
                {
                    if($_POST['confirmaTexto'] === ("delete/".$_GET['id']."/".$_GET['n']))
                    {
                        deleteAccount($conn, $table, $_POST['idDeleter']);
                    }
                    else
                    {
                        echo "Insira o texto corretamente!";
                    }
                }
            ?>
        </body>
    </html>