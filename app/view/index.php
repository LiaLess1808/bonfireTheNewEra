<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location: ./logIn.php");
    require_once "../model/functions.php";
    require_once "../control/User.php";
    
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonfire</title>

    </head>
        <body>
            <?php

                $usuarioPadrao = new User(67,'userP','e7d80ffeefa212b7c5c55700e4f7193e', 'userP@usuariopadrao.com', 'Indefinido');

                $table = "Usuario";
                $users = generalQuery($conn, $table);

                if($verify)
                {
                    setPreferences($conn);
            ?>  
                    <h1>Home</h1>
                    <h3>Bem-vind<?php echo $_SESSION['genderId'] . ", " . $_SESSION['nick'] . "!"; ?></h3><br>
                    
                    <h4>Seguindo: <?php echo $usuarioPadrao->getNick() ?></h4>
                    <a href="../../helpers/logOut.php">SAIR</a><br><br>
                    <a href="./index.php?editId=<?php echo $_SESSION['idConta']?>">EDITAR PERFIL</a>
                    <a href="./index.php?id=<?php echo $_SESSION['idConta'];?>&n=<?php echo $_SESSION['nick'];?>">EXCLUIR CONTA</a>
                    <br><br>
            <?php
                }

                foreach($users as $user):
                    ?>
                    <div style=" display:inline-block;">
                        <div style="display:none;">
                                <?php
                                    echo $user['idConta'];
                                ?>
                        </div>
                    </div>
                        
                    <?php
                endforeach;
                
                //Abre Formulário de deleção para a conta
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

                //Abre Formulário para edição dos dados do perfil
                if(isset($_GET['editId']))
                {
                    ?>
                        <h2>Editar Perfil</h2>
                        <form action="" method="post">
                            <input type="hidden" name = "editId" value = <?php echo $_GET['editId']?>>
                            <a href="index.php"><button>CANCELAR</button></a>
                        </form>
                    <?php
                }

            ?>
            <?php
                if(isset($_POST['editar']))
                {
                    if($_POST['editId'] === ($_GET['editId']))
                    {
                        updateAccount($conn,$table);
                    }
                    else
                    {
                        echo "Algo deu errado!";
                        ?>
                            <a href="./index.php"><button> CANCELAR </button></a>
                        <?php
                    }
                }
                //Deleta efetivamente a conta 
                if(isset($_POST['deletar']))
                {
                    if($_POST['confirmaTexto'] === ("delete/".$_GET['id']."/".$_GET['n']))
                    {
                        deleteAccount($conn, $table, $_POST['idDeleter']);
                    }
                    else
                    {
                        echo "Insira o texto corretamente!";
                        ?>
                            <a href="./index.php"><button>CANCELAR</button></a>
                        <?php
                    }
                }

            ?>
        </body>
    </html>