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
                    while($row = $wynik->fetch_assoc()): ?>
                        <div class='tournament'>
                        <div class='tournament-id'><?php echo htmlspecialchars($row['tournament_id']) ?></div>
                        <div class='tournament-name'><?php echo htmlspecialchars($row['tournament_name']) ?></div>
                        <div class='tournament-desc'> <?php echo htmlspecialchars($row['tournament_desc']) ?></div>
                        <div class='tournament-owner_id'><?php echo htmlspecialchars($row['owner_id']) ?></div>
                            <div class='button'>
                                        <form action='tournament_settings.php' method='POST'>
                                        <input type='hidden' name='tournament_id' value="<?php echo htmlspecialchars($row['tournament_id']) ?>">
                                        <button type='submit'>
                                            Ustawienia
                                        </button>
                                        </form>
                                    </div>
                        </div>
<?php endwhile; ?>
                    </div>
<?php
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
