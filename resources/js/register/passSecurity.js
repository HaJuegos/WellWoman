// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const inputPass = document.getElementById('passinputregister1');

    const panelSecurity = document.getElementById('securitycheck');
    const img1 = document.getElementById('secuimg1');
    const img2 = document.getElementById('secuimg2');
    const img3 = document.getElementById('secuimg3');

    panelSecurity.classList.add('hidden');
    img1.classList.add('hidden');
    img2.classList.add('hidden');
    img3.classList.add('hidden');

    inputPass?.addEventListener('input', () => {
        const value = inputPass.value;

        if (value.length > 0) {
            panelSecurity.classList.remove('hidden');

            if (/^[a-zA-Z]+$/.test(value) || /^[0-9]+$/.test(value) && value.length < 9) {
                img1.classList.remove('hidden');
                img2.classList.add('hidden');
                img3.classList.add('hidden');
            } else if (/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/.test(value) && value.length >= 9) {
                img1.classList.add('hidden');
                img2.classList.remove('hidden');
                img3.classList.add('hidden');
            } else if (/(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9])/.test(value) && value.length >= 9) {
                img1.classList.add('hidden');
                img2.classList.add('hidden');
                img3.classList.remove('hidden');
            };
        } else {
            panelSecurity.classList.add('hidden');
            img1.classList.add('hidden');
            img2.classList.add('hidden');
            img3.classList.add('hidden');
        };
    });
});
