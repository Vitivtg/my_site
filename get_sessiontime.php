<?php
require_once "config.php";

date_default_timezone_set('Europe/Chisinau'); // Устанавливаем часовой пояс Кишинёва

if (isset($_GET['date'])) {
    $selectedDate = $_GET['date']; // Получаем выбранную дату из запроса
    $currentTime = date("H:i"); // Текущее время в формате HH:mm

    // Запрос для получения всех доступных временных слотов, которые еще свободны
    $stmt = $conn->prepare("
        SELECT timeSession FROM sessionTime 
        WHERE timeFree = 1 
        AND timeSession NOT IN (
            SELECT s.timeSession FROM record r
            JOIN sessionTime s ON r.time_id = s.id
            WHERE r.data = ?
        )
    ");
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();

    $availableTimes = [];
    while ($row = $result->fetch_assoc()) {
        $time = $row['timeSession'];

        // Если выбранная дата — сегодня, фильтруем по текущему времени
        if ($selectedDate > date("Y-m-d") || $time >= $currentTime) {
            $availableTimes[] = $time;
        }
    }

    error_log("Выбранная дата: " . $selectedDate);
error_log("Текущее время: " . $currentTime);
error_log("Доступные записи: " . print_r($availableTimes, true));

    echo json_encode($availableTimes);
}
?>
