<?php 
require("actions/verify.php");
require("actions/connect.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" href="images/boludo.png" type="image/x-icon">
	<title>Gatitos</title>
	<link rel="stylesheet" href="css/style.css">
	<script async src="js/ajax.js"></script>
	<script defer src="js/send.js"></script>
	<script defer src="js/modal.js"></script>
	<script defer src="js/roomState.js"></script>
	<script defer src="js/searchRoom.js"></script>
	<script defer src="js/copyLink.js"></script>
</head>

<body>
	<div class="navbar">
		<a href="./">Bate-Papo</a>
		<a href="voiceCat/">Bate-Papo Por Voz</a>
	</div>

	<img src="images/icons/share.svg" alt="Share link!" id="shareButton" title="Share link!" />

	<main class="flex">

		<!-- Lado Esquerdo -->
		<div class="left-side flex center collumn gap">
			<img id="openModal" class="image" src="images/gatito.png" alt="Gatitos" draggable="false" />

			<!-- Modal -->
			<dialog>
				<button class="button border closeButton" id="closeModal">X</button>

				<div class="search border flex row gap" id="roomSearch">
					<img src="images/icons/searchIcon.svg" alt="Pesquisar" />
					<input type="text" id="searchInput" placeholder="Pesquisar" />
				</div>

				<div class="roomsList border flex collumn" id="roomsList">
					<?php require("actions/roomList.php")	?>
				</div>

				<form class="creator border flex row gap" action="actions/createRooms.php" method="post">
					<input type="text" class="createRoom" name="roomName" placeholder="Criar Sala" />
					<button type="button" class="switch border" id="stateSwitch">Público</button>
					<!-- Input oculto para armazenar o roomState -->
					<input type="hidden" name="roomState" value="1" />
					<input type="submit" hidden />
				</form>
			</dialog>

			<!-- Verifica se há um roomId na URL, se não, define a sala padrão como 1 -->
			<?php $roomId = isset($_GET['roomId']) ? $_GET['roomId'] : 1; ?>

			<!-- Seu formulário para enviar mensagens -->
			<form class="collumn flex gap" id="comment-form" action="actions/send.php" method="post">
				<legend>Deixe um comentário</legend>

				<!-- Adiciona um campo oculto para armazenar roomId -->
				<input type="hidden" name="roomId" value="<?php echo $roomId; ?>">
				<input class="border" id="post-input" name="username" maxlength="25" placeholder="Apelido" value="<?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : ''; ?>" />
				<textarea class="border" id="post-message" name="post" placeholder="Comentário" required><?php echo isset($_GET['post-input']) ? htmlspecialchars($_GET['post-input']) : ''; ?></textarea>
				<input class="border button" type="submit" value="Postar" />
			</form>

		</div>

		<!-- Lado Direito -->
		<div class="right-side">

			<!-- Campo dos posts -->
			<div class="post-zone flex gap collumn" id="posts">
				<?php require("actions/posts.php") ?>
			</div>
		</div>
	</main>
</body>

</html>
