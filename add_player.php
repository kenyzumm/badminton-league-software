<?php
    session_start();
    require_once "db_conf.php";
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    if($connection->connect_errno!=0){
        echo "Error: " . $connection->connect_errno;
    } else {
        // pobranie zmiennych z POST
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $category_id = $_POST['category_id']; 
        if(!isset($_SESSION['tournament_id'])) {
            $_SESSION['blad'] = "Brak tournament_id";
            die();
        }

        // przygotowanie zapytania sql
        $sql = "INSERT INTO players (player_id, name, surname, tournament_id, category_id) VALUES (NULL, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssii", $name, $surname, $_SESSION['tournament_id'], $category_id);//nazwa katergorii , category_name, 
        if($stmt->execute()) {
            $_SESSION['blad'] = "Dodano pomyslnie";
        } else {
            $_SESSION['blad'] = "Blad dodania rekordu";
        }

        $stmt->close();
        $connection->close();
        header('Location: tournament_settings.php');
    }
?>
