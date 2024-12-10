// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const posts = document.querySelectorAll('.post');
    const likeCheckboxes = document.querySelectorAll('.like-checkbox');

    const notification = document.getElementById('notification-card');
    const notificationContainer = document.getElementById('notification-container');

    const showNotification = (message) => {
        if (notification) {
            notificationContainer.classList.remove('hidden');
            notification.style.opacity = 1;

            setTimeout(() => {
                notification.style.opacity = 0;
                setTimeout(() => {
                    notificationContainer.classList.add('hidden');
                }, 500);
            }, 6000);
        };
    };

    posts.forEach(post => {
        const id = post.getAttribute('data-post-id');
        const likeBtn = post.querySelector('.like-checkbox');
        const likeCount = post.querySelector('.like-count');

        const form = post.querySelector('.form-post');
        const formURL = form.getAttribute('action');
        const tokenForm = form.querySelector('input[name="_token"]').value;

        if (likeData[id]) {
            const likeCheckbox = post.querySelector('.like-checkbox');
            if (likeCheckbox) {
                likeCheckbox.checked = true;
            };
        };

        likeBtn.addEventListener('click', async () => {
            const newLikeCount = parseInt(likeCount.textContent) || 0;

            if (newLikeCount == 0) {
                likeCount.classList.remove('hidden');
            };

            likeCount.textContent = likeBtn.checked ? newLikeCount + 1 : Math.max(0, newLikeCount - 1);

            try {
                const response = await fetch(formURL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': tokenForm
                    },
                    body: JSON.stringify({ idForum: id, newLike: likeBtn.checked })
                });

                const result = await response.json();

                if (result.success) {
                    showNotification(result.message);
                };
            } catch {};
        });
    });
});
