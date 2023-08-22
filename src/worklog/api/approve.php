<?php
header("Access-Control-Allow-Origin: *");
include '../../../includes/init.php';
$data = array();
$db = db();
extract($_POST);
$stmt = $db->prepare("UPDATE work_log SET STATUS =? WHERE id=?");
$stmt->bind_param('si', $status, $id);
$stmt->execute();
if ($stmt->error) {
    $res['success'] = false;
    $res['message'] = "error";
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