<?php
    session_start();
    require_once "db_conf.php";
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    if($connection->connect_errno!=0){
        echo "Error: " . $connection->connect_errno;
    } else {
        // pobranie zmiennych z POST
        $category_name = $_POST['category_name'];
        if(!isset($_SESSION['tournament_id'])) {
            $_SESSION['blad'] = 'Brak tournament_id';
            die();
        }
        // przygotowanie zapytania sql
        $sql = "INSERT INTO category (category_id, category_name, tournament_id) VALUES (NULL, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("si", $category_name, $_SESSION['tournament_id']);//nazwa katergorii , category_name, 
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
