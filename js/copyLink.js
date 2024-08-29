document.getElementById("shareButton").addEventListener("click", function () {
	// Obtém o link da página atual
	var pageLink = window.location.href;

	// Cria um elemento de input temporário e o adiciona ao DOM
	var tempInput = document.body.appendChild(document.createElement("input"));

	// Define o valor e seleciona o conteúdo do input
	tempInput.value = pageLink;
	tempInput.select();

	// Copia o conteúdo do input para a área de transferência
	document.execCommand("copy");

	// Remove o elemento de input temporário do DOM
	document.body.removeChild(tempInput);

	// Alerta o usuário que o link foi copiado
	alert("Link copiado: " + pageLink);
});
