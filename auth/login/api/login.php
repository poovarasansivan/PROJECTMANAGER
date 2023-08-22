<?php
session_start();
header("Access-Control-Allow-Origin: *");
include '../../../includes/init.php';
$path = $GLOBALS['_path'];
$path = $path . '/src/';

$db = db();

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $checkSql = "SELECT * FROM user_login u INNER JOIN user_role r  ON u.role=r.id INNER JOIN m_resource m ON u.role=m.id INNER JOIN m_user us ON u.user_id=us.user_id  WHERE username='$username' AND u.status='1' and us.status ='1'";
    $checkResult = mysqli_query($db, $checkSql);

    if ($checkResult) {
        if ($checkResult->num_rows > 0) {
            $row = $checkResult->fetch_assoc();

            if ($row["password"] == md5(md5(md5($password)))) {
                $res['success'] = true;
                $res['starting'] = $path . $row['link'];
                $_SESSION['launching'] = $row['link'];
                $_SESSION['userData'] = $row;
            } else {
                $res['success'] = false;
                $res['message'] = "Incorrect Password";
            }
        } else {
            $res['success'] = false;
            $res['message'] = "Username not found";
        }
    } else {
        $res['success'] = false;
        $res['message'] = "Query Error: " . mysqli_error($db);
    }
} else {
    $res['success'] = false;
    $res['message'] = "Missing Params";
}

echo json_encode($res);