<?php
include '../../../includes/init.php';
$path = $GLOBALS['_path'];
$db = db();
if(isset($_POST['userId'])){
    $selectedUserId=$_POST['userId'];
}
else{
    $selectedUserId="";
}
$sql = "SELECT DATE(check_in) AS DATE, SUM(duration) AS total_duration FROM work_log WHERE user_id='$selectedUserId' GROUP BY DATE(check_in)";
$result = mysqli_query($db, $sql);
$dailyDuration = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['DATE']] = $row['total_duration'] / 60;
    }
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