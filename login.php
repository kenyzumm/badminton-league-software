<?php
    session_start();
    require_once "db_conf.php";
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);    
    if($connection->connect_errno!=0){
        echo "Error: ".$connection->connect_errno;
    }
    else{
        // pobranie zmiennych z POST
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        // zapytanie sql
        $sql = "SELECT * FROM users WHERE user ='$login' AND pass = '$haslo'";
        if($result = @$connection->query($sql))
        {
            $ilu_userow = $result->num_rows;
            if($ilu_userow>0){
                $wiersz =$result->fetch_assoc();
                $_SESSION['user']=$wiersz['user'];
                $result->free_result();
                header('Location: main.php');
            }else{
                $_SESSION['blad']= "Blad logowania";
                header('Location: index.php');
            }
        }
        
        connection->close();
    }
?>
