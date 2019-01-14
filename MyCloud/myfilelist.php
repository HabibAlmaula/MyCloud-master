<?php

require_once('connection.php');

$allfiles = array();
$all = mysqli_query($con, "SELECT * FROM files ORDER BY id DESC");
while($row=mysqli_fetch_assoc($all)){
  $allfiles[] = $row;
}

$response['error']=false;
$response['allfiles']=$allfiles;
echo json_encode($response);

?>
