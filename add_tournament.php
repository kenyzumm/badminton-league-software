<?php

    require_once "db.php";

    $polaczenie = @new mysqli($host,$db_user,$db_password, $db_name);
    
    $ilosc_kat = $_POST['num_categories'];
    $category_names = $_POST['category_names'] ?? [];

    if(isset($_POST['name']) && isset($_POST['category_names']))
    {
        
    }
?>