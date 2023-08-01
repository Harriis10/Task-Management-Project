const inputField = document.getElementById('input-field');
const addButton = document.getElementById('add-button');
const listContainer = document.getElementById('list-container');

addButton.onclick = function() {
    const task = inputField.value.trim();
    
    if (!task) return;
    
    const listItem = document.createElement('li');
    listItem.textContent = task + ' ';

    const buttonGroup = document.createElement('div');
    buttonGroup.classList.add('list-item-buttons');
    
    const saveButton = document.createElement('button');
    saveButton.textContent = 'Save';
    saveButton.classList.add('list-item-button', 'save-button');
    saveButton.onclick = function() {
        saveTask(task);
        location.reload();
    };
    buttonGroup.appendChild(saveButton);

    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('list-item-button', 'delete-button');
    deleteButton.onclick = function() {
        listContainer.removeChild(listItem);
    };
    buttonGroup.appendChild(deleteButton);

    listItem.appendChild(buttonGroup);

    listContainer.appendChild(listItem);
    inputField.value = '';
};

function saveTask(task) {
    const formData = new FormData();
    formData.append('task', task);

    fetch('save_task.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
    })
    .catch(error => {
        console.error('Error saving task:', error);
    });
}
