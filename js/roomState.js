const stateSwitch = document.getElementById("stateSwitch");
const roomStateInput = document.querySelector('input[name="roomState"]');

let isPublic = true;

stateSwitch.addEventListener("click", function () {
	isPublic = !isPublic;
	stateSwitch.textContent = isPublic ? "Público" : "Privado";
	roomStateInput.value = isPublic ? 1 : 2;
});
