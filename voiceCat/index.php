<!DOCTYPE html>
<html>

<head>
	<title>Gatitos</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="../css/style.css">
	<script src="script/script.js" type="module" async></script>
</head>

<body>
	<div class="navbar">
		<a href="../">Bate-Papo</a>
		<a href="#">Bate-Papo Por Voz</a>
	</div>

	<audio id="localAudio" autoplay></audio>
	<audio id="remoteAudio" autoplay></audio>

	<div class="usersList">
		<div class="roomSpace">5/5 salas</div>
		<div class="usersStatus op1">
			<p>Carpincho</p>
		</div>
		<div class="usersStatus">
			<p>Carpincho</p>
		</div>
		<div class="usersStatus">
			<p>Carpincho</p>
		</div>
		<div class="usersStatus">
			<p>Carpincho</p>
		</div>
		<div class="usersStatus">
			<p>Carpincho</p>
		</div>
	</div>

	<div class="status">
		<div id="mic"></div>
	</div>

	<select class="micSelect" id="mic-select">
		<option value="" hidden>Default Mic</option>
	</select>

	<button class="mic" id="toggleMicrophoneButton">
		<img id="microphoneIcon" src="../images/icons/micOff.svg" alt="Microfone Desativado">
	</button>
</body>

</html>
