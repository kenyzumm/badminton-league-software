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
            <div class="option">Strona glowna</div>
            <div class="option">Nowy turniej</div>
            <div class="option">Przeglad turniejow</div>
        </div>
<?php
    echo "<div class='greeting'> Witaj ".$_SESSION['user']."!</div>" ;
?>
    </div>

</body>
</html>
