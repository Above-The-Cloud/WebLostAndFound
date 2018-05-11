<?php
/**
*    从数据库抓取数据到index主页
*
*
*/
header("Content-type: text/html; charset=utf-8");
include '../conn.php';
$data = array();
$user_id = $_GET["user_id"];
class Publish 
{
public $publish_id;
public $user_id;
public $nickName;
public $avatarUrl;
public $type;
public $category;
public $title;
public $image_exist;
public $submission_time;
public $image_url = array();
}

	$sql = "SELECT * FROM publish where user_id='$user_id' order by publish_id desc;";

$res = mysqli_query( $conn, $sql );
if (mysqli_num_rows($res) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($res)) {
      $publish =new Publish();
      $publish->publish_id = $row["publish_id"];
      $tmp_id =  $row["publish_id"];
      $publish->user_id = $row["user_id"];
      $publish->type = $row["type"];
	  $publish->category = $row["category"];
      $publish->title = $row["title"];
      $publish->msg = $row["msg"];
      $publish->image_exist = $row["image_exist"];
      $publish->submission_time = $row["submission_time"];
	  
	  $sql_info = "select * from user_info where user_id = '$publish->user_id';";
	  $res_info = mysqli_query( $conn, $sql_info );
	  if (mysqli_num_rows($res) > 0) {
		while($row = mysqli_fetch_assoc($res_info)){
			$publish->nickName = $row["nickName"];
			$publish->avatarUrl = $row["avatarUrl"];	
		}
	  }	
      $sql_image = "SELECT * FROM image WHERE publish_id= '$tmp_id';";
      $res_image = mysqli_query( $conn, $sql_image );
      if (mysqli_num_rows($res_image) > 0) {
        while($row_image = mysqli_fetch_assoc($res_image)) {
          $publish->image_url[] = $row_image["image_url"];
        }
      }
      $data[]=$publish;

    }
}
$json = json_encode($data);
echo $json;
mysqli_close($conn);
?>
