<?php

    $hostname = '162.240.17.101';
    $username = 'projetos_nlessa';
    $password = 'Gc&sgY74PK$}';
    $database = 'projetos_INF2023_G10';

    // Create a database connection
    $conn = mysqli_connect($hostname, $username, $password, $database);

    // LOG IN AND OUT FUNCTIONS
    function logIn($conn)
    {
        if(isset($_POST['acessar']) AND !empty($_POST['email']) AND !empty($_POST['senha']))
        {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $senha = md5($_POST['senha']);

            $query = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha' ";

            $execute = mysqli_query($conn,$query);

            $return = mysqli_fetch_assoc($execute);

            if(!empty($return['email']))
            {
                session_start();

                $_SESSION['nome'] = $return['nome'];
                $_SESSION['nick'] = $return['nick'];
                $_SESSION['idConta'] = $return['idConta'];
                $_SESSION['email'] = $return['email'];
                $_SESSION['genero'] = $return['genero'];

                $_SESSION['active'] = true;

                header('Location: ../view/index.php');
            }
            else
            {
                echo "Usuário ou senha não encontrados!";
            }
        }
    }

    function setPreferences($conn)
    {
        if($_SESSION['genero'] === "Feminino")
        {
            $_SESSION['genderId'] = "a";
        }
        else if($_SESSION['genero'] === "Masculino")
        {
            $_SESSION['genderId'] = "o";
        }
        else
        {
            $_SESSION['genderId'] = "o/a";
        }
    }

    function logOut()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: ../app/view/logIn.php");
    }

    // QUERY FUNCTIONS
    function unitQuery($conn, $table, $id)
    {
        $sUQuery = "SELECT * FROM $table WHERE idConta =" . (int) $id;

        $sUExec = mysqli_query($conn, $sUQuery);
        $sUReturn = mysqli_fetch_assoc($sUExec);

        return $sUReturn;
    }

    function generalQuery($conn, $table, $where = 1, $order = "")
    {
        if(!empty($order))
        {
            $order = "ORDER BY $order";
        }

        $gQuery = "SELECT * FROM $table WHERE $where $order ";

        $gExec = mysqli_query($conn,$gQuery);
        $gReturn = mysqli_fetch_all($gExec, MYSQLI_ASSOC);

        return $gReturn;
    }

    // LOG CRUD FUNCTIONS
    function signUp($conn)
    {
        if(isset($_POST['cadastrar']) AND !empty($_POST['emailCadastro']) AND !empty($_POST['senhaCadastro']))
        {
            $err = array();

            $emailCadastro = filter_input(INPUT_POST, "emailCadastro", FILTER_VALIDATE_EMAIL);
            $nickCadastro = mysqli_real_escape_string($conn,$_POST['nickCadastro']);
            $senhaCadastro = md5($_POST['senhaCadastro']);   

                
                if($_POST['senhaCadastro'] != $_POST['senhaCadastroConfirma'])
                {
                    $err[] = "Senhas não conferem!";
                }

                    $queryEmail = "SELECT email FROM Usuario WHERE email = '$emailCadastro' ";
                    $searchEmail = mysqli_query($conn,$queryEmail);
                    $verifyRowNum = mysqli_num_rows($searchEmail);

                if(!empty($verifyRowNum))
                {
                    $err[] = "Email já cadastrado!";
                }

                if(empty($err))
                {
                    $insertNewUser = "INSERT INTO Usuario (nick, email, senha) VALUES ('$nickCadastro','$emailCadastro','$senhaCadastro')";
                    $executeSignUp = mysqli_query($conn, $insertNewUser);

                    if($executeSignUp)
                    {
                        echo "Usuário cadastrado com sucesso!";
                    }
                    else
                    {
                        echo "Erro ao cadastrar usuário". mysqli_error($conn)."!";
                    }
                }
                else
                {
                    foreach($err as $e)
                    {
                        echo "<p> $e <p>";
                    }
                }

                
        }
    }

    function deleteAccount($conn, $table, $id)
    {
        if(!empty($id))
        {         
            $dQuery = "DELETE FROM $table WHERE idConta = ". (int) $id;

            $dExec = mysqli_query($conn, $dQuery);

            if($dExec)
            {
                session_start();
                session_unset();
                session_destroy();
                
                header("Location: ../../app/view/logIn.php");
            }
            else
            {
                echo "Não foi possível deletar a conta!";
            }
        }    
    }

    function selectUpdateAccount($conn)
    {
        $editId = $_GET['id'];

        if(isset($id))
        {
            
        }

    }
    function updateAccount($conn)
    {
        
    }