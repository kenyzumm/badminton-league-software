<?php
session_start();
require_once "db_conf.php";


$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);    
if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
} else {
    $tournament_name = $_POST['tournament_name'];
    $tournament_desc = $_POST['tournament_desc'];
    $sql = ""; // dodac kod do sql zeby wprowadzic turniej
    if($result = @$polaczenie->query($sql)) {
        echo "Dodano turniej";
        // zrobic strone po tym, jak dodano info dotyczace turnieju, np. dodawanie zawodnikow itp. i zrobic tu przekierowanie
    }
    $polaczenie->close();
}

?>
