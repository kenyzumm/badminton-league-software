<?php
    session_start();
    require_once "db_conf.php";
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if($password1 != $password2) {
        $_SESSION['blad'] = "Hasla sie nie zgadzaja";
        header("Location: register_page.php");
        die();
    }
    // sprawdzenie czy dany user juz istnieje
    $sql = "SELECT * FROM users WHERE user='" . $user . "'";
    if($result = $polaczenie->query($sql)) {
		$ilu_userow = $result->num_rows;
        if($ilu_userow != 0) {
            $_SESSION['blad'] = "User o podanym loginie juz istnieje";
            header("Location: register_page.php");
            die();
        }
    }
    $sql = "SELECT * FROM users where email='" . $email . "'";
    if($result = $polaczenie->query($sql)) {
        $ilu_userow = $result->num_rows;
        if($ilu_userow != 0) {
            $_SESSION['blad'] = "Podany mail juz jest wykorzystywany";
            header("Location: register_page.php");
            die();
        }
    }
    $sql = "INSERT INTO users (user_id, user, pass, email) VALUES (NULL, ?, ?, ?)";
    $stmt = $polaczenie->prepare($sql);
    $stmt->bind_param("sss", $user, $password1, $email);
    if($stmt->execute()) {
        $_SESSION['blad'] = "Zarejestrowano pomyslnie";
    } else {
        $_SESSION['blad'] = "Blad dodania rekordu";
    }
    $stmt->close();
    $polaczenie->close();
    header('Location: index.php');
    
?>
