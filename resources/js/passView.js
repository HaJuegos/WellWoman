// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.querySelector('.viewPassLogin');
    const registerButton1 = document.getElementById('viewPassRegister1');
    const registerButton2 = document.getElementById('viewPassRegister2');

    const passLoginInput = document.getElementById('passinput');
    const passRegister1Input = document.getElementById('passinputregister1');
    const passRegister2Input = document.getElementById('passinputregister2');

    if (loginButton && passLoginInput) {
        loginButton.addEventListener('click', () => {
            const inputType = passLoginInput.type == 'password';

            passLoginInput.type = inputType ? 'text' : 'password';

            const iconText = inputType ? 'visibility' : 'lock';
            loginButton.textContent = iconText;
        });
    };

    if (registerButton1 && passRegister1Input) {
        registerButton1.addEventListener('click', () => {
            const inputType = passRegister1Input.type == 'password';

            passRegister1Input.type = inputType ? 'text' : 'password';

            const iconText = inputType ? 'visibility' : 'lock';
            registerButton1.textContent = iconText;
        });
    };

    if (registerButton2 && passRegister2Input) {
        registerButton2.addEventListener('click', () => {
            const inputType = passRegister2Input.type == 'password';

            passRegister2Input.type = inputType ? 'text' : 'password';

            const iconText = inputType ? 'visibility' : 'lock';
            registerButton2.textContent = iconText;
        });
    };
});
