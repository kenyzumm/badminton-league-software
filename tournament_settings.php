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
require_once "db_config.php";
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
if($polaczenie->connect_errno!=0) {
    echo "Error: " . $polaczenie->connect_errno . "</div>";
} else {
    $tournament_id = $_POST['tournament-id'];
    $sql = "SELECT * FROM tournaments WHERE tournaments_id='$tournament_id'";

    if($result = $polaczenie->query($sql)) {
        
    }
}

?>
    </div>

</body>
</html>
