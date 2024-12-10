// @ts-nocheck
import * as reFomart from "date-fns";
import { es } from "date-fns/locale";

document.addEventListener('DOMContentLoaded', () => {
    const dataElements = document.querySelectorAll('.date');

    dataElements.forEach(element => {
        const text = element.textContent.trim();
        const date = new Date(text);
        let newTime = reFomart.formatDistanceToNow(date, { locale: es });

        newTime = newTime.replace(/^alrededor de /, 'Hace ');
        newTime = newTime.charAt(0).toUpperCase() + newTime.slice(1);

        element.textContent = newTime;
    });
});
