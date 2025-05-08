function openEditModal(userId) {
    // Set the form's action dynamically if needed
    const editModal = new bootstrap.Modal(document.getElementById('updateITModal'));
    document.querySelector('#updateITModal input[name="id"]').value = userId;
    editModal.show();
}

function openEditModal2(userId) {
    // Set the form's action dynamically if needed
    const editModal = new bootstrap.Modal(document.getElementById('updateLICModal'));
    document.querySelector('#updateLICModal input[name="id"]').value = userId;
    editModal.show();
}

function openDeleteModal(userId) {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    document.getElementById('deleteUserId').value = userId;
    deleteModal.show();
}

