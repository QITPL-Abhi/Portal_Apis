<?php
include 'db_config.php';
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$gender = $_REQUEST['gender'];
$designation = $_REQUEST['designation'];
$profile_image = $_FILES['profile_image'];
$hobbies = $_REQUEST['hobbies'];
$new_filename = "";
if(isset($_FILES)){
    $profile_image = $_FILES['profile_image'];
    if (!in_array($profile_image['type'], ['image/jpg', 'image/png', 'image/jpeg'])) {
        echo json_encode(['status' => 'error', 'message' => 'Image Only jpeg, jpg, and png accepted']);
        die;
    }

    $timestamp = date('Ymsisi');
    $file_ext = pathinfo($profile_image['name'], PATHINFO_EXTENSION);
    $new_filename = "profile_" . $timestamp . "." . $file_ext;
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $destination = $uploadDir . $new_filename;
    move_uploaded_file($profile_image['tmp_name'], $destination);
}
$sql = "INSERT INTO `users`(`name`, `email`,`password`, `gender`, `designation`,`profile_image`,`hobbies`) VALUES ('$name','$email','$password','$gender','$designation','$new_filename','$hobbies')";
if(mysqli_query($conn,$sql)){
    echo json_encode(['status' => 'success','message' => 'Data Inserted Succesfully']);
}else{
    echo json_encode(['status' => 'error','message' => 'Something Went Wrong']);
}
?>