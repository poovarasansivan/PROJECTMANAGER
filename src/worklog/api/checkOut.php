<?php
// session_start();
header("Access-Control-Allow-Origin: *");
include '../../../includes/init.php';
$data = array();
$db = db();
extract($_POST);

$conn = "SELECT * FROM work_log WHERE id=$id";
$result = mysqli_query($db, $conn);

$row = $result->fetch_assoc();
$time_1 = $row['check_in'];
$timezone = new DateTimeZone('Asia/Kolkata');
$time_2 = new DateTime('now', $timezone);
$start = new DateTime($time_1, $timezone);
$diff = $start->diff($time_2);

$total = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;

$db = db();
$stmt = $db->prepare("UPDATE work_log SET check_out=CURRENT_TIMESTAMP, project_id=?, duration=?, status='0', checkout_description=? WHERE id=?");
$stmt->bind_param('issi', $project_id, $total, $description, $id);
$stmt->execute();

$res = array(); 

if ($stmt->error) {
    $res['success'] = false;
    $res['message'] = "Error: " . $stmt->error;
} else {
    if ($stmt->affected_rows > 0) {
        $res['success'] = true;
        $res['message'] = "Record updated successfully";
    } else {
        $res['success'] = false;
        $res['message'] = "Record not found or no changes made";
    }
}

echo json_encode($res);
?>
