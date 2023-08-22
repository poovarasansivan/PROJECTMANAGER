<?php
include '../../../includes/init.php';
$path = $GLOBALS['_path'];
$db = db();
if (isset($_POST['userId'])) {
    $selectedUserId = $_POST['userId'];
} else {
    $selectedUserId = ''; 
}

$sql = "SELECT MONTH(check_in) AS MONTH, SUM(duration) AS total_duration FROM work_log WHERE user_id = '$selectedUserId' GROUP BY MONTH(check_in)";
$result = mysqli_query($db, $sql);
$monthlyDuration = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['MONTH']] = $row['total_duration'] / 60;
    }
}

$duration = array();
for ($month = 1; $month <= 12; $month++) {
    $totalDuration = isset($data[$month]) ? $data[$month] : 0;
    $duration[] = intval($totalDuration);
}
echo json_encode($duration);
?>
