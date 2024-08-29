// Atualizar a vizualização dos posts a cada 0.01 segundos
setInterval(function () {
	const urlParams = new URLSearchParams(window.location.search);
	const roomId = urlParams.get('roomId');

	if (roomId !== null) {
		getPosts(roomId);
	}
}, 100);

function updatePosts(roomId, postData) {
	// Atualiza a visualização das mensagens
	const postsElement = document.getElementById("posts");

	const newPost = document.createElement("div");
	newPost.className = "post";
	newPost.innerHTML = `<strong>${postData.username}:</strong> ${postData.post} <span class="timestamp">${postData.timestamp}</span>`;

	postsElement.appendChild(newPost);
}

function getPosts(roomId) {
	fetch(`./actions/posts.php?roomId=${roomId}`)
		.then(response => response.text())
		.then(data => {
			document.getElementById("posts").innerHTML = data;
		})
		.catch(error => console.log(error));
}
