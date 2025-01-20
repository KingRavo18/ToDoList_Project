function showAddTaskPopup() {
    const popupFullPage = document.getElementById('AddTaskPopupFullPage');
    const popup = document.getElementById('AddTaskPopup');
    popupFullPage.classList.remove('hidden'); 
    popup.offsetWidth; 
    popup.classList.add('opacity-100', 'scale-100'); 
    popup.classList.remove('opacity-0', 'scale-95'); 
}

function hideAddTaskPopup() {
    const popupFullPage = document.getElementById('AddTaskPopupFullPage');
    const popup = document.getElementById('AddTaskPopup');
    popup.classList.add('opacity-0', 'scale-95'); 
    popup.classList.remove('opacity-100', 'scale-100'); 
    setTimeout(() => {
        popupFullPage.classList.add('hidden'); 
    }, 500); 
}

function showDeleteTaskPopup(taskId) {
    const popupFullPage = document.getElementById('DeleteTaskPopupFullPage');
    const popup = document.getElementById('DeleteTaskPopup');
    const deleteButton = popup.querySelector('button[data-action="delete"]');
    deleteButton.dataset.taskId = taskId;
    popupFullPage.classList.remove('hidden');
    popup.offsetWidth;
    popup.classList.add('opacity-100', 'scale-100');
    popup.classList.remove('opacity-0', 'scale-95');
}

function hideDeleteTaskPopup() {
    const popupFullPage = document.getElementById('DeleteTaskPopupFullPage');
    const popup = document.getElementById('DeleteTaskPopup');
    popup.classList.add('opacity-0', 'scale-95');
    popup.classList.remove('opacity-100', 'scale-100');
    setTimeout(() => {
        popupFullPage.classList.add('hidden');
    }, 500);
}

function deleteTask() {
    const deleteButton = document.querySelector('button[data-action="delete"]');
    const taskId = deleteButton.dataset.taskId;
    fetch(`../backend/deleteTask.php?id=${taskId}`, {
        method: 'GET',
    })
    .then(response => {
        if (response.ok) {
            const taskRow = document.querySelector(`tr[data-task-id="${taskId}"]`);
            if (taskRow) {
                taskRow.remove();
            }
            hideDeleteTaskPopup();
        } else {
            alert('Failed to delete the task. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error deleting task:', error);
        alert('An error occurred while deleting the task.');
    });
}

function showEditTaskPopup(taskId, description) {
    const popupFullPage = document.getElementById('EditTaskPopupFullPage');
    const popup = document.getElementById('EditTaskPopup');
    const editForm = document.getElementById('editTaskForm');
    document.getElementById('editTaskId').value = taskId;
    document.getElementById('editTaskDescription').value = description;
    popupFullPage.classList.remove('hidden');
    popup.offsetWidth;
    popup.classList.add('opacity-100', 'scale-100');
    popup.classList.remove('opacity-0', 'scale-95');
    editForm.onsubmit = function (e) {
        e.preventDefault();
        updateTask(taskId);
    };
}

function hideEditTaskPopup() {
    const popupFullPage = document.getElementById('EditTaskPopupFullPage');
    const popup = document.getElementById('EditTaskPopup');
    popup.classList.add('opacity-0', 'scale-95');
    popup.classList.remove('opacity-100', 'scale-100');
    setTimeout(() => {
        popupFullPage.classList.add('hidden');
    }, 500);
}

function updateTask(taskId) {
    const description = document.getElementById('editTaskDescription').value;
    fetch('../backend/editTask.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ id: taskId, description }),
    })
    .then(response => response.text())
    .then(result => {
        if (result.includes("Task updated successfully")) {
            const taskRow = document.querySelector(`tr[data-task-id="${taskId}"] td:first-child`);
            if (taskRow) {
                taskRow.textContent = description;
            }
            hideEditTaskPopup();
        } else {
            alert("Failed to update task. Please try again.");
        }
    })
    .catch(error => {
        console.error("Error updating task:", error);
        alert("An error occurred while updating the task.");
    });
}


