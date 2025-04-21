<?php
$conn = mysqli_connect('localhost','root','','quick_portal_mobile_app');
if(!$conn){
echo json_encode(['status' => 'error','message' => 'Connection Error '.mysqli_connect_error($conn) ]);    
}

if(!isset($_REQUEST['apiKey']) && $_REQUEST['apiKey']==""){
    echo json_encode(['status' => 'error','message' => 'Api key is empty']);
    die;
}

if($_REQUEST['apiKey']!="ddd-otn745-jjgfd-uti-uiu"){
    echo json_encode(['status' => 'error','message' => 'Api key is Wrong']);
    die;
}
?>