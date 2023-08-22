<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../../includes/init.php';
$data = array();
$db = db();


$checkSql = "SELECT p.*, u.* FROM project_user_mapping p INNER JOIN m_projects u ON p.project_id = u.id;";
$checkResult = mysqli_query($db, $checkSql);

if ($checkResult) {
    if ($checkResult->num_rows > 0) {
        while ($row = $checkResult->fetch_assoc()) {
            $data[] = $row;
        }
        $res['success'] = true;
        $res['data'] = $data;
    } else {
        $res['success'] = false;
        $res['message'] = "Record not found";
    }
} else {
    $res['success'] = false;
    $res['message'] = "Query Error: " . mysqli_error($db);
}
echo json_encode($res);