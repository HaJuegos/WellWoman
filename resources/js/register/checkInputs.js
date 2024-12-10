// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formregister');

    const inputEmail = document.getElementById('emailinput');
    const inputVerifyEmail = document.getElementById('emailinputrepeat');
    const inputPass = document.getElementById('passinputregister1');
    const inputVerifyPass = document.getElementById('passinputregister2');

    const emailError = document.getElementById('error-email');
    const passwordError = document.getElementById('error-pass');
    const passwordRepeatError = document.getElementById('error-pass-repeat');

    const offSetButtonsEmail = document.querySelectorAll('.iconmail1, .iconmail2');
    const offSetButtonsPass = document.querySelectorAll('.iconspass1, .iconspass2');

    form.addEventListener('submit', (e) => {
        let isValid = true;

        if (inputEmail.value != inputVerifyEmail.value) {
            emailError.classList.remove('hidden');
            offSetButtonsEmail.forEach(button => button.classList.add('fixed'));
            isValid = false;
        } else {
            emailError.classList.add('hidden');
            offSetButtonsEmail.forEach(button => button.classList.remove('fixed'));
        };

        if (inputPass.value.length < 8) {
            passwordError.classList.remove('hidden');
            passwordError.querySelector('span').textContent = "La contraseña debe tener al menos 8 caracteres.";
            offSetButtonsPass.forEach(button => button.classList.add('fixed'));
            isValid = false;
        } else {
            passwordError.classList.add('hidden');
            offSetButtonsPass.forEach(button => button.classList.remove('fixed'));
        };

        if (inputPass.value != inputVerifyPass.value) {
            passwordRepeatError.classList.remove('hidden');
            offSetButtonsPass.forEach(button => button.classList.add('fixed'));
            isValid = false;
        } else {
            passwordRepeatError.classList.add('hidden');
            offSetButtonsPass.forEach(button => button.classList.remove('fixed'));
        };

        if (!isValid) {
            e.preventDefault();
        };
    });
});
