// Envia a mensagem ao servidor
document.getElementById("comment-form").addEventListener("submit", function (event) {
	event.preventDefault();

	const formData = new FormData(event.target);
	document.getElementById("post-message").value = "";

	fetch('./actions/send.php', {
		method: 'POST',
		body: formData
	})
		.then(response => response.json())
		.then(data => {
			updatePosts(data.roomId, data);
		})
		.catch(error => console.log(error));
});
