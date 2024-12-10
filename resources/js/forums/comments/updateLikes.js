// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const comments = document.querySelectorAll('.comment');

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

    comments.forEach(comment => {
        const id = comment.getAttribute('data-comment-id');
        const likeCheckbox = comment.querySelector('.comment-like-checkbox');
        const likeCount = comment.querySelector('.comment-like-count');

        const form = comment.querySelector('.form-comment');
        const formURL = form.getAttribute('action');
        const tokenForm = form.querySelector('input[name="_token"]').value;

        if (likesDataComments[id]) {
            likeCheckbox.checked = true;
        };

        likeCheckbox.addEventListener('click', async () => {
            const newLikeCount = parseInt(likeCount.textContent) || 0;

            if (newLikeCount == 0) {
                likeCount.classList.remove('hidden');
            };

            likeCount.textContent = likeCheckbox.checked ? newLikeCount + 1 : Math.max(0, newLikeCount - 1);

            try {
                const response = await fetch(formURL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': tokenForm
                    },
                    body: JSON.stringify({ idForum: id, newLike: likeCheckbox.checked })
                });

                const result = await response.json();

                if (result.success) {
                    showNotification(result.message);
                };
            } catch {};
        });
    });
});
