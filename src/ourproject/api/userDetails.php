<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../../includes/init.php';
$data = array();
$db = db();

extract($_POST);
$checkSql = "SELECT p.*, u.name FROM project_user_mapping p INNER JOIN m_user u ON p.user_id = u.user_id";
$checkResult = mysqli_query($db, $checkSql);

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
    $res['message'] = "Query Error: " . mysqli_error($db);
}
echo json_encode($res);