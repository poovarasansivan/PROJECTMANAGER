<?php

include '../../../includes/init.php';
checkSession();

$db = db();
if ($db) {
    try {

        $createdBy = $_SESSION['userData']['user_id'];

        extract($_POST);
        $stmt = $db->prepare("INSERT INTO work_log (user_id) VALUES (?)");
        $stmt->bind_param('s', $createdBy);
        $stmt->execute();

        if ($stmt->error) {
            $res['success'] = false;
            $res['error'] = 'Error: ' . $stmt->error;
            echo json_encode($res);
            exit();
        } else {
            $res['success'] = true;
            $res['msg'] = 'Submitted successfully';
        }

        $stmt->close();
    } catch (Exception $ex) {
        $res['success'] = false;
        $res['error'] = $ex->__toString();
    }
} else {
    die('Database error');
}
echo json_encode($res);