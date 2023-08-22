<?php
include '../../../includes/init.php';
$path = $GLOBALS['_path'];
$db = db();
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}
$fileName = "work-log" . date('Y-m-d') . ".xls";

$fields = array('ID', 'USER ID', 'NAME', 'CHECK IN', 'CHECK OUT', 'STATUS');
$excelData = implode("\t", array_values($fields)) . "\n";
$query = $db->query("SELECT w.id, w.user_id, u.name,w.check_in,w.check_out,w.status FROM work_log w INNER JOIN m_user u ON w.user_id = u.user_id ORDER BY id ASC");
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $status = ($row['status'] == 0) ? 'Pending' : 'Approved';
        $lineData = array($row['id'], $row['user_id'], $row['name'], $row['check_in'], $row['check_out'], $status);
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
} else {
    $excelData .= 'No records found...' . "\n";
}
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");
echo $excelData;

exit;