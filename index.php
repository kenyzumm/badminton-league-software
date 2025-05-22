<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Tworzenie turnieju</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css"></link>
</head>
<body>

<h2>Stwórz nowy turniej</h2>

<form action="create_tournament.php" method="POST">
    <label>Nazwa turnieju:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Ilość kategorii:</label><br>
    <input type="number" id="num_categories" name="num_categories" min="1" required>
    <button type="button" onclick="generateCategoryFields()">Dalej</button><br><br>

    <div id="categoryFields"></div>

    <button type="submit" id="submitBtn" style="display:none;">Utwórz turniej z kategoriami</button>
</form>

</body>
</html>
