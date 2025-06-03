<?php
    session_start();
?>
<!DOCTYPE HTML>
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
        <?php
            require_once "db_conf.php";
            $connection = new mysqli($host, $db_user, $db_password, $db_name);    
            if($connection->connect_errno!=0){
                echo "<div class='option'>Error: ".$connection->connect_errno."</div>";
            } else {

                // zapytanie sql do wyswietlania wszystkich turniejow
                $sql = "SELECT * FROM tournaments WHERE 1"; // dodac, aby wyswietlilo turnieje danego uzytkownika
                $wynik = $connection->query($sql);

                // wypisanie turniejow
                if($wynik && $wynik->num_rows > 0) {
                    echo "<div class='tournament-list'>";
                    while($row = $wynik->fetch_assoc()) {
                        echo "<div class='tournament'>";
                            echo "<div class='tournament-id'>" . htmlspecialchars($row['tournament_id']) . "</div>";
                            echo "<div class='tournament-name'>" . htmlspecialchars($row['tournament_name']) . "</div>";
                            echo "<div class='tournament-desc'>" . htmlspecialchars($row['tournament_desc']) . "</div>";
                            echo "<div class='tournament-owner_id'>" . htmlspecialchars($row['owner_id']) . "</div>";
                            echo "  <div class='button'>
                                        <form action='tournament_settings.php' method='POST'>
                                        <input type='hidden' name='tournament_id' value='" . htmlspecialchars($row['tournament_id']) . "'>
                                        <button type='submit'>
                                            Ustawienia
                                        </button>
                                        </form>
                                    </div>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='tournament'>Brak turniejow</div>";
                }
            }
            $connection->close();
?>
<?php
    if(isset($_SESSION['blad'])) {
        echo "<div class='error'>" . $_SESSION['blad'] . "</div>";
        unset($_SESSION['blad']);
    }    
?>
    </div>

</body>
