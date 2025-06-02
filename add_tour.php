<?php
session_start();
require_once "db_conf.php";


$connection = @new mysqli($host, $db_user, $db_password, $db_name);    
if($connection->connect_errno!=0){
    echo "Error: ".$connection->connect_errno;
} else {
    // pobranie zmiennych z POST
    $tournament_name = $_POST['tournament_name'];
    $tournament_desc = $_POST['tournament_desc'];

    //przygotowanie zapytania sql, aby pobrac id uzytkownika
    $sqlid = "SELECT user_id FROM users WHERE user='".$_SESSION['user']."'";
    
    $wynik= $connection->query($sqlid);
    if($wynik && $wynik->num_rows > 0) {
        $row = $wynik->fetch_assoc();
        $owner_id = $row['user_id'];
    } else {
        $owner_id = -1;
    }

    // zapytanie sql do wprowadzenia turnieju do BD
    $sql = "INSERT INTO tournaments (tournament_id, tournament_name, tournament_desc, owner_id) VALUES (NULL, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $tournament_name, $tournament_desc, $owner_id);
    
    if($stmt->execute()) {
        $_SESSION['blad'] = "Dodano turniej";
    } else {
        $_SESSION['blad'] = "Blad dodania rekordu";
    }

    $stmt->close();
    $connection->close();

    // przekierowanie do spisu turniejow
    header('Location: tournaments.php');
}

?>
