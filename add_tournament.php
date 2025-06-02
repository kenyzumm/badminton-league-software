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
    <h2>Dodaj turniej</h2>
    <form action="add_tour.php" method="POST">
        <div class="input-name">Nazwa turnieju</div>
        <div class="input"><input type="text" name="tournament_name"></div>
        <div class="input-name">Opis turnieju</div>
        <div class="input"><input type="text" name="tournament_desc"></div>
        <div class="button"><input type="submit" value="Dodaj turniej"></div>
    </form>

    </div>

</body>

