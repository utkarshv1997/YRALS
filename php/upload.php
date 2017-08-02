<?php

date_default_timezone_set('Asia/Calcutta');

if(isset($_FILES['files'])){
$file_tmp = $_FILES['files']['tmp_name'][0];
$file_name = $_FILES['files']['name'][0];

$uploadDir = '/var/www/html/test/greenscreen/upload/';
$file_size =$_FILES['files']['size'][0];
$file_ext=strtolower(end(explode('.',$_FILES['files']['name'][0])));	
$file_type=$_FILES['image']['type'][0];
$upload_name = date("m/d/Y_h:i:sa") . '_' . $file_name;

move_uploaded_file($file_tmp,$uploadDir . $upload_name);
$response = array('status' => 'success', 'filename' => $file_name, 'uploadname' => $upload_name);
echo json_encode($response);
}
?>