// @ts-nocheck
const btnEdit = document.querySelectorAll('.editroles');
const btnDeleted = document.querySelectorAll('.deluser');

const closeEdit = document.getElementById('close-popup');
const closeDeleted = document.getElementById('cancel-delete');

const editDialog = document.getElementById('editpopup');
const deletedDialog = document.getElementById('deleteduser-dialog');

const form = document.getElementById('edit-role-form');
const formDel = document.getElementById('delete-user-form');

closeEdit.addEventListener('click', () => {
    editDialog.close();
});

closeDeleted.addEventListener('click', () => {
    deletedDialog.close();
});

document.addEventListener('DOMContentLoaded', () => {
    btnEdit.forEach(btn => {
        btn.addEventListener('click', (evn) => {
            const userId = btn.getAttribute('data-user-id');
            const assignedRoles = JSON.parse(btn.getAttribute('data-user-roles'));

            evn.preventDefault();
            editDialog.showModal();

            document.getElementById('user-id').value = userId;

            const roleCheckboxes = document.querySelectorAll('#editpopup input[name="roles[]"]');

            roleCheckboxes.forEach(checkbox => {
                const roleId = parseInt(checkbox.value, 10);
                checkbox.checked = assignedRoles.includes(roleId);
            });

            const formAction = urlEdit.replace('0', userId);

            form.setAttribute('action', formAction);
        });
    });

    btnDeleted.forEach(btn => {
        btn.addEventListener('click', (evn) => {
            const userId = btn.getAttribute('data-user-id');

            evn.preventDefault();
            deletedDialog.showModal();

            document.getElementById('delete-user-id').value = userId;

            const formAction = urlDeleted.replace('0', userId);

            formDel.setAttribute('action', formAction);
        });
    });
});
