<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body>
    <div class="container">
        <h2>Zaloguj sie do konta</h2>
        <form action="login.php" method="POST">
            Login: <br> <input type="text" name="login"><br> <!-- Pozamieniac na divy -->
            Haslo: <br> <input type="password" name="haslo">
            <input type="submit" value="Zaloguj sie">
        </form>
        <div class="register"><a href="register_page.php">Zarejestruj sie</a></div>
        <?php
            if(isset($_SESSION['blad'])){
                echo $_SESSION['blad'];
                unset($_SESSION['blad']);
            }
        ?>
    </div>

</body>
</html>
