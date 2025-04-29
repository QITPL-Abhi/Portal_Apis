<?php
include 'db_config.php';

$id = $_REQUEST['loginId'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$gender = $_REQUEST['gender'];
$designation = $_REQUEST['designation'];
$hobbies = $_REQUEST['hobbies'];
$new_filename = "";

// Check if a new file is uploaded
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
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

// Build SQL update query
$sql = "UPDATE `users` SET 
            `name` = '$name',
            `email` = '$email',
            `password` = '$password',
            `gender` = '$gender',
            `designation` = '$designation',
            `hobbies` = '$hobbies'";

if ($new_filename !== "") {
    $sql .= ", `profile_image` = '$new_filename'";
}

$sql .= " WHERE `id` = '$id'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['status' => 'success', 'message' => 'User Updated Successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Update Failed']);
}
?>
