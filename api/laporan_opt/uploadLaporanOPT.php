<?php
$target_dir = "img/";
$target_file_name = $target_dir.basename($_FILES["file"]["name"]);
$response = array();

// Check if image file is a actual image or fake image
if (isset($_FILES["file"])) 
{
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_name)) 
  {
     $success = "1";
  }
  else 
  {
      $success = "0";
      $message = "Error while uploading";
  }
}
else 
{
      $success = "1";
}
$response["value"] = $success;
echo json_encode($response);

?>
