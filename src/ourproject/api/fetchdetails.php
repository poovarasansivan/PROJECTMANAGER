<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../../includes/init.php';
$data = array();
$db = db();
extract($_POST);

$stmt = $db->prepare("SELECT p.*, u.* FROM m_projects p INNER JOIN m_user u ON p.incharge = u.user_id where p.id=?;");
$stmt->bind_param('i', $id);
$stmt->execute();

$checkResult = $stmt->get_result();
if ($checkResult) {
    if ($checkResult->num_rows > 0) {
        $row = $checkResult->fetch_assoc();

        $res['success'] = true;
        $res['data'] = $row;
    } else {
        $res['success'] = false;
        $res['message'] = "Record not found";
    }
} else {
    $res['success'] = false;
    $res['message'] = "Query Error: " . $stmt->error;
}

echo json_encode($res);
?>