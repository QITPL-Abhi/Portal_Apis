<?php
include 'db_config.php';
if(!isset($_REQUEST['email']) || $_REQUEST['email'] ==""){
    echo json_encode(['status' => 'error', 'message' => 'Email Not Found']);
    die;
}
if(!isset($_REQUEST['password']) || $_REQUEST['password'] ==""){
    echo json_encode(['status' => 'error', 'message' => 'Password Not Found']);
    die;
}
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];

$sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";


if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
    $row = mysqli_fetch_assoc(mysqli_query($conn,$sql));
    echo json_encode(['status' => 'success', 'message' => 'Login Successfully','data' => $row['id']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data not Found!']);
}
