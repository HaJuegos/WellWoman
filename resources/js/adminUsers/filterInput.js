// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('filter-users');
    const tableRows = document.querySelectorAll('.manage-table tbody tr');

    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const userName = row.querySelector('.user-name').textContent.toLowerCase();
            const userEmail = row.querySelector('.email-user').textContent.toLowerCase();

            if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            };
        });
    });
});
