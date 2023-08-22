<?php
include '../../../includes/init.php'; 
$db = db(); 
if (isset($_POST['userId'])) {
    $selectedUserId = $_POST['userId'];
    $query = "SELECT COUNT(project_id) AS projectCount FROM project_user_mapping WHERE user_id='$selectedUserId'";
    $result = mysqli_query($db, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $counts = array('projectCount' => $row['projectCount']);
        echo json_encode($counts);
    } else {
        echo json_encode(array('projectCount' => 0)); 
    }
}
?>
