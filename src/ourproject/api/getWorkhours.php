<?php
include '../../../includes/init.php';
$path = $GLOBALS['_path'];
$db = db();

extract($_POST);

$stmt = $db->prepare("SELECT DATE(check_in) AS DATE, SUM(duration) AS total_duration FROM work_log WHERE project_id = ? GROUP BY DATE(check_in)");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result(); 

$dailyDuration = array();

while ($row = $result->fetch_assoc()) {
    $data[$row['DATE']] = $row['total_duration'] / 60;
}

$currentYear = date('Y');
$currentMonth = date('m');

for ($day = 1; $day <= cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); $day++) {
    $currentDate = "$currentYear-$currentMonth-" . str_pad($day, 2, '0', STR_PAD_LEFT);
    $totalDuration = isset($data[$currentDate]) ? $data[$currentDate] : 0;
    $dailyDuration[] = intval($totalDuration);
}

echo json_encode($dailyDuration);
?>