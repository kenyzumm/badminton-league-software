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
$connection = new mysqli($host, $db_user, $db_password, $db_name);
if($connection->connect_errno!=0) {
    echo "Error: " . $connection->connect_errno;
} else {
    // pobranie zmiennych z POST
    $tournament_id = filter_input(INPUT_POST, 'tournament-id', FILTER_VALIDATE_INT);
    if(!$tournament_id) {
        echo "Nieprawidlowe ID turnieju";
        die();
    }

    // zapytanie sql do pobrania danych o turnieju
    $sql = "SELECT t.tournament_name, t.tournament_desc, u.user 
            FROM tournaments t  
            JOIN users u ON t.owner_id = u.user_id 
            WHERE t.tournament_id='$tournament_id'";

    if($result = $connection->query($sql)) {
        if($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='description'>";

            // wypisanie danych turnieju
            echo "<div class='desc'>Nazwa turnieju: " . htmlspecialchars($row['tournament_name']) . "</div>";
            echo "<div class='desc'>Opis turnieju: " . htmlspecialchars($row['tournament_desc']) . "</div>"; 
            echo "<div class='desc'>Wlasciciel: " . htmlspecialchars($row['user']) . "</div>";


            // zapytanie sql do wypisania playerow w danym turnieju
            $sql = "SELECT p.name, p.surname, p.category_id FROM players p WHERE p.tournament_id='" . $tournament_id . "'";
            $wynik = $connection->query($sql);
            
            // wypisanie graczy, o ile istnieja
            echo "<div class='players'>";

            if($wynik->num_rows > 0) {
                $gracze = 1;
                echo "<div class=''>Gracze:</div>";
                while($row_players = $wynik->fetch_assoc()) {
                    echo "<div class='player'>". $gracze++ . ". " . $row_players['name'] . " " . $row_players['surname'] . " Kategoria: " . $row_players['category_id'] . "</div>";
                }
            } else {
                    echo "<div class=''>Brak dodanych graczy</div>";
                }
                echo "</div>";
                

            echo "</div>";
        }
    }

// formularz do dodawania graczy do turnieju
echo "
    <div class='add_category'>
        <form action='add_category.php' method='POST'>
        <h2>Dodaj katergie</h2>
        <div class=''>Nazwa kategorii</div>
        <div class=''><input type='text' name='category_name'></div>
        <input type='hidden' name='tournament_id' value='" . $tournament_id . "'>
        <div class=''><input type='submit' value='Dodaj kategię'></div>
        </form>
    </div>
</div>
";

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



// przycisk do usuwania danych z turnieju
echo "
<div class='last'>
    <form action='delete_tournament.php' method='POST'>
        <input type='hidden' name='tournament_id' value='" . $tournament_id ."'>
        <input type='submit' value='Usun turniej'>
    </form>
</div>
";
    $connection->close();
}

?>
    </div>

</body>
</html>
