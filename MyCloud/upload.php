<?php

require_once('connection.php');

$filename = $_POST['filename'];
$extension = $_POST['extension'];
$file = $_FILES['file'];

$getFilename = null;
$old = $filename.'.'.$extension;
$getfilename = mysqli_query($con,"SELECT file FROM files WHERE file='$old'");
while($row = mysqli_fetch_array($getfilename)){
  $getFilename = $row['file'];
}

if(!$filename || !$extension ||!$file){

  $response['error'] = true;
  $response['message'] = 'Required field is empty';
  echo json_encode($response);

}else if($filename.'.'.$extension == $getFilename){
  $response['error'] = true;
  $response['message'] = 'File already exist, use different name';
  echo json_encode($response);
}else{

  $path = $_SERVER['DOCUMENT_ROOT'] . '/anows/mycloud/files/';
  move_uploaded_file($file['tmp_name'], $path . $filename .'.'.$extension);
  $newfilename = $filename.'.'.$extension;

  $upload = mysqli_query($con,"INSERT INTO files VALUES('','$filename','$extension','$newfilename')");

  if($upload){
    $response['error'] = false;
    $response['message'] = 'Data uploaded successfull';
    echo json_encode($response);
  }else{
    $response['error'] = true;
    $response['message'] = 'Data upload failed';
    echo json_encode($response);
  }

}

?>
