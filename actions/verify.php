<?php
require("connect.php");

function redirectToDefaultRoom() {
    header("Location: ?roomId=1");
    exit();
}

// Verifica se não há roomId definido ou se o valor é inválido
$roomId = isset($_GET['roomId']) ? $_GET['roomId'] : null;

// Se o roomId não for válido, redireciona para a sala padrão (roomId = 1)
if ($roomId === null || !is_numeric($roomId)) {
    redirectToDefaultRoom();
}

// Verifica se a sala padrão existe no banco de dados
$stmtCheckDefaultRoom = $pdo->prepare("SELECT COUNT(*) FROM room WHERE roomId = 1");
$stmtCheckDefaultRoom->execute();
$defaultRoomExists = $stmtCheckDefaultRoom->fetchColumn();

// Se a sala padrão não existir, cria automaticamente
if (!$defaultRoomExists) {
    $stmtCreateDefaultRoom = $pdo->prepare("INSERT INTO room (roomId, roomName, roomState) VALUES (1, 'Público', 2)");
    $stmtCreateDefaultRoom->execute();
}

// Se o roomId não for 1 e a sala atual não existir, redireciona para a sala padrão (roomId = 1)
if ($roomId != 1) {
    $stmtCheckCurrentRoom = $pdo->prepare("SELECT COUNT(*) FROM room WHERE roomId = :roomId");
    $stmtCheckCurrentRoom->bindParam(':roomId', $roomId, PDO::PARAM_INT);
    $stmtCheckCurrentRoom->execute();
    $currentRoomExists = $stmtCheckCurrentRoom->fetchColumn();

    if (!$currentRoomExists) {
        redirectToDefaultRoom();
    }
}
?>
