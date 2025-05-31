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
        <form action="register.php" method="POST">
            <div class="user">Login: <input type="text" name="user"></div>
            <div class="email">E-mail: <input type="text" name="email"></div>
            <div class="password">Password: <input type="password" name="password1"></div>
            <div class="password">Verify password: <input type="password" name="password2"></div>
            <div class="button"><input type="submit" value="Zarejestruj sie"></div>
            <div class="warning">
<?php
    if(isset($_SESSION['blad'])) {
        echo $_SESSION['blad'];
        unset($_SESSION['blad']);
    }
?>
            </div>
        </form>
    </div>
</body>
