<?php
    session_start();
    require_once "db_conf.php";
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['passowrd2'];
    if($password1 != $password2) {
        // error dla takiego nieidentycznych hasel
    }
    // sprawdzenie czy dany user juz istnieje
    $sql = "SELECT * FROM users WHERE user='".$user;."'";
    if($result = $polaczenie->query($sql)) {
		$ilu_userow = $result->num_rows;
        if($ilu_userow != 0) {
            // error dla juz istniejacego usera
        }
    }
    $sql = "SELECT * FROM users where email='" . $email . "'";
    if($result = $polaczenie->query($sql)) {
        $ilu_userow = $result->num_rows;
        if(ilu_userow != 0) {
            // error dla juz uzywanego maila
        }
    }
    $sql = "INSERT INTO users (user_id, user, email, password) VALUES (NULL, ?, ?, ?)";
    $stmt = $polaczenie->prepare($sql);
    $stmt->bind_param("sss", $user, $email, $password1);
    if($stmt->execute()) {
        echo "Dodano usera";
    } else {
        echo "Blad dodania rekordu";
    }
    $stmt->close();
    $polaczenie->close();
    header('Location: index.php');
    
?>
