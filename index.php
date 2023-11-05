<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" href="images/goiaba.png" type="image/x-icon">
	<title>Gatitos</title>
	<link rel="stylesheet" href="css/style.css">
	<script defer src="js/cookie.js"></script>
	<script async src="js/ajax.js"></script>
	<script async src="js/modal.js"></script>
	<script async src="js/keyevent.js"></script>
</head>

<body>
	<main class="flex">

		<!-- Lado Esquerdo -->
		<div class="left-side flex center collumn gap">
			<img id="openModal" class="image" src="images/gatitos.png" alt="Gatitos" draggable="false" />

			<!-- Modal -->
			<dialog>
				<button class="button border" id="closeModal">X</button>
				<img src="images/placeholder.png" alt="👍" />
			</dialog>

			<!-- Formulário -->
			<form class="collumn flex gap" id="comment-form" action="actions/send.php" method="post">
				<legend>Deixe um comentário</legend>

				<input class="border" id="post-input" name="username" maxlength="25" placeholder="Apelido" />

				<textarea class="border" name="post" placeholder="Comentário" required></textarea>

				<input class="border button" type="submit" value="Postar" />
			</form>
		</div>

		<!-- Lado Direito -->
		<div class="right-side">

			<!-- Campo dos posts -->
			<div class="post-zone flex gap collumn" id="posts">
				<?php require("actions/posts.php"); ?>
			</div>
		</div>
	</main>
</body>

</html>
