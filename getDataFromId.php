<?php
include 'db_config.php';
if (!isset($_REQUEST['id']) || $_REQUEST['id'] == "") {
    echo json_encode(['status' => 'error', 'message' => 'id Not Found']);
    die;
}
$userId = $_REQUEST['id'];
$sql = "SELECT * FROM `users` WHERE `id` = '$userId'";
if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    echo json_encode(['status' => 'success', 'message' => 'Data Retrieved Successfully', 'data' => $row]);
}else{
    echo json_encode(['status' => 'error', 'message' => 'Data Not Found']);
}
