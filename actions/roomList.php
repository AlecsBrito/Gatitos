<?php
require("connect.php");

function getRoomListHTML($pdo, $searchTerm = '')
{
    $stmt = $pdo->prepare("SELECT * FROM room WHERE roomName LIKE :searchTerm AND roomState != 2 ORDER BY roomId DESC");
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();

    $html = '';

    while ($room = $stmt->fetch(PDO::FETCH_OBJ)) {
        $html .= "<div class='room border'>";
        $html .= "<a href='?roomId={$room->roomId}'>" . ($room->roomName ?? 'Sem nome') . "</a>";
        $html .= "</div>";
    }

    return $html;
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
    echo getRoomListHTML($pdo, $searchTerm);
    exit();
} else {
    // Se não for uma solicitação AJAX, gerar a lista diretamente no HTML
    echo getRoomListHTML($pdo);
}
?>
