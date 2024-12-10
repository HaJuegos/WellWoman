// @ts-nocheck
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.checkbox-btn input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                checkboxes.forEach(otherCheckbox => {
                    if (otherCheckbox != this) {
                        otherCheckbox.checked = false;
                    };
                });
            };
        });
    });
});
