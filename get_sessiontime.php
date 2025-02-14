<?php
require_once 'config.php';

// Получаем выбранную дату
$date = $_GET['date'] ?? '';

if ($date) {
    // Запрос на выбор данных с учетом даты и фильтрации timeFree = 1
    $stmt = $conn->prepare("SELECT timeSession FROM sessiontime WHERE date = ? AND timeFree = 1");
    $stmt->bind_param("s", $date); // Привязываем выбранную дату как строку
    $stmt->execute();
    $result = $stmt->get_result();

    // Формируем массив сессий
    $sessions = [];
    while ($row = $result->fetch_assoc()) {
        $sessions[] = $row['timeSession'];
    }

    // Возвращаем данные в формате JSON
    header('Content-Type: application/json');
    echo json_encode($sessions);
} else {
    // Если дата не указана, возвращаем пустой массив
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>
