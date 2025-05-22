<?php
    require_once "db_conf.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    if($connection->connect_errno!=0){
        echo "error";
    }
    else{
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        echo $login."<br>";
        echo $haslo;
    }
    
?>

