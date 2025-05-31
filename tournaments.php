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
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);    
            if($polaczenie->connect_errno!=0){
                echo "<div class='option'>Error: ".$polaczenie->connect_errno."</div>";
            } else {
                $sql = "SELECT * FROM tournaments WHERE 1"; // dodac, aby wyswietlilo turnieje danego uzytkownika
                $wynik = $polaczenie->query($sql);

                if($wynik && $wynik->num_rows > 0) {
                    echo "<div class='tournament-list'>";
                    while($row = $wynik->fetch_assoc()) {
                        echo "<div class='tournament'>";
                            echo "<div class='tournament-id'>" . htmlspecialchars($row['tournament_id']) . "</div>";
                            echo "<div class='tournament-name'>" . htmlspecialchars($row['tournament_name']) . "</div>";
                            echo "<div class='tournament-desc'>" . htmlspecialchars($row['tournament_desc']) . "</div>";
                            echo "<div class='tournament-owner_id'>" . htmlspecialchars($row['owner_id']) . "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='option'>Brak turniejow</div>";
                }
            }
            $polaczenie->close();
        ?>
    </div>

</body>
