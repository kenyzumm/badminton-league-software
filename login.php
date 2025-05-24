<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Login validation</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body>
    <div class="container">
        <h2>Dane logowania:</h2>
<?php
    require_once "db_conf.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    if($connection->connect_errno!=0){
        echo "error";
    }
    else{
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        echo '<div class="dane">Login: '.$login.'</div>';
        echo '<div class="dane">Haslo: '.$haslo.'</div>';
    }
?>

    </div>
</body>
