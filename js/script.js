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