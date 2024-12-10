// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const posts = document.querySelectorAll('.post');
    const dialogDel = document.getElementById('confirmDel');
    const formDel = dialogDel.querySelector('.formDel');
    const originalActionURL = formDel.getAttribute('action');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');
	
	let postToDelete = null;

    posts.forEach(post => {
        const delBtn = post.querySelector('.delete-post');
        const postId = post.getAttribute('data-post-id');

        delBtn.addEventListener('click', event => {			
            event.preventDefault();
            formDel.setAttribute('action', originalActionURL.replace('0', postId));
			post.classList.add('shake');
			postToDelete = post;
            dialogDel.showModal();
        });
		
		cancelBtn.addEventListener('click', () => {
			post.classList.remove('shake');
			dialogDel.close();
		});
		
		confirmBtn.addEventListener('click', () => {
            postToDelete.classList.add('red-filter');
            postToDelete.classList.remove('shake');
            dialogDel.close();
		});
    });
});
