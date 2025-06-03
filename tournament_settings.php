
<?php
session_start();
require_once "db_conf.php";

// Sprawdzenie połączenia z bazą
$connection = new mysqli($host, $db_user, $db_password, $db_name);
if ($connection->connect_errno != 0) {
    die("Błąd połączenia z bazą danych: " . $connection->connect_errno);
}

// Pobranie id turnieju z POST lub sesji
$tournament_id = filter_input(INPUT_POST, 'tournament_id', FILTER_VALIDATE_INT);
if($tournament_id != NULL) {
    $_SESSION['tournament_id'] = $tournament_id;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustawienia turnieju</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body>
<div class="container">
    <div class="options">
        <div class="option"><a href="main.php">Strona główna</a></div>
        <div class="option"><a href="add_tournament.php">Nowy turniej</a></div>
        <div class="option"><a href="tournaments.php">Przegląd turniejów</a></div>
    </div>
    <div class='tournament_settings'>
<?php
if ($_SESSION['tournament_id']) {
    // Pobranie danych o turnieju
    $stmt = $connection->prepare(
        "SELECT t.tournament_name, t.tournament_desc, u.user 
         FROM tournaments t  
         JOIN users u ON t.owner_id = u.user_id 
         WHERE t.tournament_id = ?"
    );
    $stmt->bind_param("i", $_SESSION['tournament_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='description'>";
        echo "<div class='desc'>Nazwa turnieju: " . htmlspecialchars($row['tournament_name']) . "</div>";
        echo "<div class='desc'>Opis turnieju: " . htmlspecialchars($row['tournament_desc']) . "</div>";
        echo "<div class='desc'>Właściciel: " . htmlspecialchars($row['user']) . "</div>";

        // Pobranie graczy
        $stmt_players = $connection->prepare(
            "SELECT p.name, p.surname, c.category_name 
             FROM players p 
             JOIN category c ON p.category_id = c.category_id 
             WHERE p.tournament_id = ?"
        );
        $stmt_players->bind_param("i", $_SESSION['tournament_id']);
        $stmt_players->execute();
        $players_result = $stmt_players->get_result();

        echo "<div class='players'>";
        if ($players_result->num_rows > 0) {
            $gracze = 1;
            echo "<div>Gracze:</div>";
            while ($row_players = $players_result->fetch_assoc()) {
                echo "<div class='player'>" . $gracze++ . ". " . 
                    htmlspecialchars($row_players['name']) . " " . 
                    htmlspecialchars($row_players['surname']) . " Kategoria: " . 
                    htmlspecialchars($row_players['category_name']) . "</div>";
            }
        } else {
            echo "<div>Brak dodanych graczy</div>";
        }
        echo "</div>"; // players
        echo "</div>"; // description
    } else {
        echo "<div>Nie znaleziono turnieju.</div>";
    }
} else {
    echo "<div>Nie wybrano turnieju.</div>";
}
?>
    <div class='add_category'>
        <form action='add_category.php' method='POST'>
            <h2>Dodaj kategorię</h2>
            <div>Nazwa kategorii</div>
            <div><input type='text' name='category_name' required></div>
            <input type='hidden' name='tournament_id' value='<?php echo htmlspecialchars($tournament_id); ?>'>
            <div><input type='submit' value='Dodaj kategorię'></div>
        </form>
    </div>
    <div class='add_player'>
        <form action='add_player.php' method='POST'>
            <h2>Dodaj gracza</h2>
            <div>Imię</div>
            <div><input type='text' name='name' required></div>
            <div>Nazwisko</div>
            <div><input type='text' name='surname' required></div>
            <div>Kategoria</div>
            <select name='category_id' required>
                <?php
                $category = $connection->query("SELECT * FROM category");
                while ($c = $category->fetch_assoc()):
                ?>
                <option value="<?php echo htmlspecialchars($c["category_id"]); ?>">
                    <?php echo htmlspecialchars($c["category_name"]); ?>
                </option>
                <?php endwhile; ?>
            </select>
            <input type='hidden' name='tournament_id' value='<?php echo htmlspecialchars($tournament_id); ?>'>
            <div><input type='submit' value='Dodaj gracza'></div>
        </form>
    </div>
</div> <!-- tournament_settings -->
    <div class='last'>
        <form action='delete_tournament.php' method='POST'>
            <input type='hidden' name='tournament_id' value='<?php echo htmlspecialchars($tournament_id); ?>'>
            <input type='submit' value='Usuń turniej'>
        </form>
    </div>
</div> <!-- container -->
<?php $connection->close(); ?>
</body>
</html>
