// @ts-nocheck
import * as reFormat from 'date-fns';
import { es } from 'date-fns/locale';

document.addEventListener('DOMContentLoaded', () => {
    const forumsContainer = document.querySelector('.post-container');
    const forums = Array.from(forumsContainer.querySelectorAll('.comments'));
    const dateElements = document.querySelectorAll('.date');

    forums.sort((a, b) => {
        const likesA = parseInt(a.querySelector('.like-count').innerText) || 0;
        const likesB = parseInt(b.querySelector('.like-count').innerText) || 0;

        return likesB - likesA;
    });

    forums.forEach(forum => {
        forumsContainer.appendChild(forum);
    });

    dateElements.forEach(element => {
        const dateString = element.textContent.trim();
        const date = new Date(dateString);
        let relativeTime = reFormat.formatDistanceToNow(date, { locale: es });

        relativeTime = relativeTime.replace(/^alrededor de /, 'Hace ');
        relativeTime = relativeTime.charAt(0).toUpperCase() + relativeTime.slice(1);
        element.textContent = relativeTime;
    });
});
