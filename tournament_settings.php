<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>



</head>
<body>
    <div class="container">
        <div class="options">
            <div class="option"><a href="main.php">Strona glowna</a></div>
            <div class="option"><a href="add_tournament.php">Nowy turniej</a></div>
            <div class="option"><a href="tournaments.php">Przeglad turniejow</a></div>
        </div>
<div class='tournament_settings'>
<?php
require_once "db_conf.php";
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
if($polaczenie->connect_errno!=0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {
    $tournament_id = filter_input(INPUT_POST, 'tournament-id', FILTER_VALIDATE_INT);
    if(!$tournament_id) {
        echo "Nieprawidlowe ID turnieju";
        die();
    }
    $sql = "SELECT t.tournament_name, t.tournament_desc, u.user 
            FROM tournaments t  
            JOIN users u ON t.owner_id = u.user_id 
            WHERE t.tournament_id='$tournament_id'";

    if($result = $polaczenie->query($sql)) {
        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='description'>";

            echo "<div class='desc'>Nazwa turnieju: " . htmlspecialchars($row['tournament_name']) . "</div>";
            echo "<div class='desc'>Opis turnieju: " . htmlspecialchars($row['tournament_desc']) . "</div>"; 
            echo "<div class='desc'>Wlasciciel: " . htmlspecialchars($row['user']) . "</div>";

            $sql = "SELECT p.name, p.surname, p.category_id FROM players p WHERE p.tournament_id='" . $tournament_id . "'";
            $wynik = $polaczenie->query($sql);
                echo "<div class='players'>";
            if($wynik->num_rows > 0) {
                echo "<div class=''>Gracze:</div>";
                while($row2 = $wynik->fetch_assoc()) {
                    echo "<div class='player'>" . $row2['name'] . " " . $row2['surname'] . " Kategoria: " . $row2['category_id'] . "</div>";
                }} else {
                    echo "<div class=''>Brak dodanych graczy</div>";
                }
                echo "</div>";
                

            echo "</div>";
        }
    }

echo "
    <div class='add_player'>
        <form action='add_player.php' method='POST'>
        <h2>Dodaj gracza</h2>
        <div class=''>Imie</div>
        <div class=''><input type='text' name='name'></div>
        <div class=''>Nazwisko</div>
        <div class=''><input type='text' name='surname'></div>
        <div class=''>Kategoria</div>
        <div class=''><input type='text' name='category_id'></div>
        <input type='hidden' name='tournament_id' value='" . $tournament_id . "'>
        <div class=''><input type='submit' value='Dodaj gracza'></div>
        </form>
    </div>
</div>
";

echo "
<div class='last'>
    <form action='delete.php' method='POST'>
        <input type='hidden' value='" . $tournament_id ."'>
        <input type='submit' value='Usun turniej'';
    </form>
</div>
";
    $connection->close();
}

?>
    </div>

</body>
</html>
