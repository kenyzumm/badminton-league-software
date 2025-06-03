<?php
    session_start();
    require_once 'db_conf.php';
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    if ($connection->connect_errno!=0) {
        echo "Error: " . $polaczenie->connect_errno;
    } else {
        $tournament_id = $_POST['tournament_id'];

        // usuniecie turnieju
        $sql = "DELETE FROM tournaments WHERE tournament_id = " . $tournament_id;
        $connection->query($sql);
        // usuniecie graczy w danym turnieju
        $sql = "DELETE FROM players WHERE tournament_id = " . $tournament_id;
        $connection->query($sql);
        // usuniecie kategorii danego turnieju
        $sql = "DELETE FROM category WHERE tournament_id = " . $tournament_id;
        $connection->query($sql);

        $_SESSION['blad'] = "Usunieto turniej z bazy danych";
        $connection->close();
        header('Location: tournaments.php');
    }
?>
