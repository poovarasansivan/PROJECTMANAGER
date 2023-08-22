<?php

include '../../../includes/init.php'; 
$db = db(); 
if (isset($_POST['userId'])) {
    $selectedUserId = $_POST['userId'];

    $query = "SELECT SUM(duration)/60 AS duration,project_id,p.title FROM work_log w INNER JOIN m_projects p ON p.id = w.`project_id` WHERE user_id ='$selectedUserId' GROUP BY project_id";
    $result = mysqli_query($db, $query);
    $tableData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tableData[] = $row;
    }
    echo json_encode($tableData);
}
?>
