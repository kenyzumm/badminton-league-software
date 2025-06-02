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
    <h2>Rejestracja</h2>
        <form action="register.php" method="POST">
            <div class="form-row">
                <div class="data">Login:</div>
                <div class="input"><input type="text" name="user"></div>
                <div class="data">E-mail:</div>
                <div class="input"><input type="text" name="email"></div>
                <div class="data">Password:</div>
                <div class="input"><input type="password" name="password1"></div>
                <div class="data">Verify password:</div>
                <div class="input"><input type="password" name="password2"></div>
                <div class="register"><input type="submit" value="Zarejestruj sie"></div>

            </div>
        </form>

<?php
    if(isset($_SESSION['blad'])) {
        echo "<div class=''>" . $_SESSION['blad'] . "</div>";
        unset($_SESSION['blad']);
    }
?>
            </div>
        </form>
    </div>
</body>
