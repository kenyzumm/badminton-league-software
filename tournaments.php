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
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);    
            if($polaczenie->connect_errno!=0){
                echo "Error: ".$polaczenie->connect_errno;
            } else {
                $sql = ""; // dodac, aby wyswietlilo turnieje danego uzytkownika
                $wynik = $polaczenie->query($sql));

                if($wynik->nums_row > 0) {
                    while($row = wynik->fetch_assoc()) {
                        echo "Nazwa turnieju : " . $row['tournament_name'] . " Opis turnieju: " . $row['tournament_desc'] . "<br>";
                    }
                } else {
                    echo "Brak turniejow";
                }
            }
            $polaczenie->close();
?>
    </div>

</body>
