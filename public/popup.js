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