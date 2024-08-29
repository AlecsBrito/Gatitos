document.addEventListener("DOMContentLoaded", function() {
	const searchInput = document.getElementById("searchInput");
	const roomsList = document.getElementById("roomsList");

	searchInput.addEventListener("input", function() {
		const searchTerm = searchInput.value.toLowerCase();
		const rooms = roomsList.querySelectorAll(".room");

		rooms.forEach(function(room) {
			const roomName = room.textContent.toLowerCase();
			const isVisible = roomName.includes(searchTerm);
			room.style.display = isVisible ? "block" : "none";
		});
	});
});
