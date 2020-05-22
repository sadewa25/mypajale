<?php
$target_dir = "img/";
$target_file_name = $target_dir.basename($_FILES["file"]["name"]);
// print_r($target_file_name);
$response = array();

function multiUpload()
{
  // print_r($_FILES["file"]);
  for ($i=0; $i < sizeof($_FILES["file"]); $i++) {
    $target_file_name = 'img/'.basename($_FILES["file"]["name"][$i]);
    print_r($target_file_name);
    move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file_name);
  }
  return true;
}

// Check if image file is a actual image or fake image
if (isset($_FILES["file"]))
{
  // if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_name))
  // {
  //    $success = "1";
  // }
  // else
  // {
  //     $success = "0";
  //     $message = "Error while uploading";
  // }
  $multi = multiUpload();
  if ($multi)
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
