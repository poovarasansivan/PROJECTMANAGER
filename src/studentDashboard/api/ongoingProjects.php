<?php


include '../../../includes/init.php'; 
$db = db(); 

if (isset($_POST['userId'])) {
    $selectedUserId = $_POST['userId'];

    $query = "SELECT COUNT(project_id) AS ongoingCount FROM project_user_mapping WHERE user_id='$selectedUserId' AND status='1'";
    $result = mysqli_query($db, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $counts = array('ongoingCount' => $row['ongoingCount']);
        echo json_encode($counts);
    } else {
        echo json_encode(array('ongoingCount' => 0));
    }
}
?>
