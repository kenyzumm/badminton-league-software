<?php
session_start();
require_once "db_conf.php";


$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);    
if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
} else {
    $tournament_name = $_POST['tournament_name'];
    $tournament_desc = $_POST['tournament_desc'];
    $sqlid = "SELECT user_id FROM users WHERE user='".$_SESSION['user']."'";
    $wynik= $polaczenie->query($sqlid);
    if($wynik && $wynik->num_rows > 0) {
        $row = $wynik->fetch_assoc();
        $owner_id = $row['user_id'];
    } else {
        $owner_id = -1;
    }
    $sql = "INSERT INTO tournaments (tournament_id, tournament_name, tournament_desc, owner_id) VALUES (NULL, ?, ?, ?)";
    $stmt = $polaczenie->prepare($sql);
    $stmt->bind_param("ssi", $tournament_name, $tournament_desc, $owner_id);
    
    if($stmt->execute()) {
        echo "Dodano rekord";
    } else {
        echo "Blad dodania rekordu: ";
    }

    $stmt->close();
    $polaczenie->close();
    header('Location: tournaments.php');
}

?>
