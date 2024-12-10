// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const posts = document.querySelectorAll('.post');
    const textInteract = document.querySelector('.create-forum-link');

    posts.forEach(post => {
        const commentsBtn = post.querySelector('.commentsBtn');
        const id = post.getAttribute('data-post-id');
        const url = URLComment.replace('0', id);

        commentsBtn?.addEventListener('click', () => {
            window.location.href = url;
        });
    });

    textInteract.addEventListener('click', () => {
        const createPost = document.querySelector('.input');

        createPost.classList.add('animationScale');

        setTimeout(() => {
            createPost.classList.remove('animationScale');
        }, 500);
    });
});
