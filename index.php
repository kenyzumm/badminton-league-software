<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Tworzenie turnieju</title>
    <script>
        function generateCategoryFields() {
            const num = document.getElementById('num_categories').value;
            const container = document.getElementById('categoryFields');
            container.innerHTML = '';

            for (let i = 1; i <= num; i++) {
                const label = document.createElement('label');
                label.textContent = 'Nazwa kategorii ' + i + ':';
                
                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'category_names[]';
                input.required = true;

                container.appendChild(label);
                container.appendChild(input);
                container.appendChild(document.createElement('br'));
            }

            document.getElementById('submitBtn').style.display = 'inline-block';
        }
    </script>
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
