<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../../includes/init.php';
$data = array();
$db = db();


$checkSql = "SELECT user_id, name FROM m_user WHERE STATUS='1'";
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