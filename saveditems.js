document.addEventListener('DOMContentLoaded', function() {
    fetch('load_saved_items.php')
    .then(response => response.json())
    .then(items => {
        const list = document.getElementById('saved-items-list');
        items.forEach(item => {
            const listItem = document.createElement('li');
            listItem.textContent = item.task + ' ';

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add('list-item-button', 'delete-button');
            deleteButton.onclick = function() {
                deleteSavedItem(item.id);
                list.removeChild(listItem);
            };
            listItem.appendChild(deleteButton);

            list.appendChild(listItem);
        });
    })
    .catch(error => {
        console.error('Error loading saved items:', error);
    });
});

function deleteSavedItem(itemId) {
    const formData = new FormData();
    formData.append('id', itemId);

    fetch('delete_saved_item.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
    })
    .catch(error => {
        console.error('Error deleting saved item:', error);
    });
}
