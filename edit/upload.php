<?php
include '../conn.php';
$extension = "";
echo json_encode($_FILES);
echo json_encode($_POST);  
$newname = " ";
$publish_id = $_POST['publish_id'];
$APPURL = 'https://yiwangchunyu.wang/';

//echo json_encode($res);
if ($_FILES["file"]["error"] > 0)
 {
    echo json_encode($_FILES["file"]["error"]);
 }
else
{
  $sql = "UPDATE publish SET image_exist=1 WHERE publish_id='$publish_id';";
  $res = mysqli_query( $conn, $sql );
  $temp = explode(".", $_FILES["file"]["name"]);
  $extension = end($temp); 

  move_uploaded_file($_FILES["file"]["tmp_name"], "../images/publish/". $_FILES["file"]["name"]);
  $dir="../images/publish/";
  $domain="https://lostandfound.yiwangchunyu.wang/images/publish/";
  $newname =date("Y").date("m").date("d").date("H").date("i").date("s").rand(100, 999).".".$extension;
  rename("../images/publish/" . $_FILES["file"]["name"], $dir.$newname);
  $img_url=$domain.$newname;
  $sql = "INSERT INTO image(publish_id, type, image_url, submission_time) ".
      "VALUES ".
      "('$publish_id', '$extension', '$img_url', current_time);";

  $res = mysqli_query( $conn, $sql );
  echo json_encode($res);
}
mysqli_close($conn);
?>