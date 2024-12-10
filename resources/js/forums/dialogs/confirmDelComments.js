// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const comments = document.querySelectorAll('.comment');
    const dialogDel = document.getElementById('confirmDel');

    const formDel = dialogDel.querySelector('.formDel');

    const originalActionURL = formDel.getAttribute('action');

    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');

    const post = document.querySelector('.post');
    const postId = post.getAttribute('data-post-id');

    let commentToDelete = null;

    comments.forEach(comment => {
        const delBtn = comment.querySelector('.delete-post');
        const commentId = comment.getAttribute('data-comment-id');

        delBtn.addEventListener('click', event => {
            const updatedActionURL = originalActionURL.replace('idPlaceholder', postId).replace('idCommentPlaceholder', commentId);

            event.preventDefault();
            formDel.setAttribute('action', updatedActionURL);
            comment.classList.add('shake');
            commentToDelete = comment;
            dialogDel.showModal();
        });

        cancelBtn.addEventListener('click', () => {
            comment.classList.remove('shake');
            dialogDel.close();
        });

        confirmBtn.addEventListener('click', () => {
            commentToDelete.classList.add('red-filter');
            commentToDelete.classList.remove('shake');
            dialogDel.close();
        });
    });
});
