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
<?php
echo "<div class='greeting'> Witaj ".$_SESSION['user']."!</div>" ;
if(isset($_SESSION['blad'])) {
    echo "<div class='error'>" . $_SESSION['blad'] . "</div>"
}
?>
    </div>

</body>
</html>
