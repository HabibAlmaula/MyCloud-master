<?php

require_once('connection.php');

$id = $_GET['id'];

if(!$id){
  $response['error']=true;
  $response['message']='Required field is empty';
  echo json_encode($response);
}else{

  $getfile = null;
  $get = mysqli_query($con, "SELECT file FROM files WHERE id='$id'");
  while($row = mysqli_fetch_array($get)){
    $getfile = $row['file'];
  }

  $delete = mysqli_query($con,"DELETE FROM files WHERE id='$id'");

  if($delete){
    unlink($_SERVER['DOCUMENT_ROOT'].'/anows/mycloud/files/'.$getfile);
    $response['error']=false;
    $response['message']='File deleted successfull';
    echo json_encode($response);
  }else{
    $response['error']=true;
    $response['message']='File delete failed';
    echo json_encode($response);
  }

}

?>
