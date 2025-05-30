<?php
    require_once "db_conf.php";
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);    
    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    }
    else{
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        
        $sql = "SELECT * FROM users WHERE user ='$login' AND pass = '$haslo'";
        if($result = @$polaczenie->query($sql))
        {
            $ilu_userow = $result->num_rows;
            if($ilu_userow>0){
                $wiersz =$result->fetch_assoc();
                $user=$wiersz['user'];

                $result->free_result();
                header('location: main.php');
            }else{
                echo "nie ma takiego usera";

            }
        }
        
        $polaczenie->close();


    }
?>
