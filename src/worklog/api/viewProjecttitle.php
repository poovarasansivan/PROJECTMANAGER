<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../../includes/init.php';
$data = array();
$db = db();

extract($_POST);
$checkSql = "SELECT w.*,p.* FROM work_log w INNER JOIN m_projects p ON w.project_id=p.id";
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