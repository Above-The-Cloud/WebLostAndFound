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

class User 
{
public $user_id;
public $nickName;
public $avatarUrl;
public $contact_type;
public $contact_value;
public $submission_time;
}

$sql = "SELECT * FROM user_info where user_id='$user_id';";

$res = mysqli_query( $conn, $sql );
$user =new User();
if (mysqli_num_rows($res) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($res)) {
      
      $user->user_id = $row["user_id"];
      $user->nickName = $row["nickName"];
	  $user->avatarUrl = $row["avatarUrl"];
      $user->submission_time = $row["submission_time"];
	  break;
    }
	$sql_contact = "select * from contact where user_id='$user_id';";
	$res_contact = mysqli_query( $conn, $sql_contact );
	if (mysqli_num_rows($res_contact) > 0) {
		// 输出数据
		while($row = mysqli_fetch_assoc($res_contact)) {
		$user->contact_type = $row["type"];
		$user->contact_value = $row["value"];
		break;
		}
	}
}

$json = json_encode($user);
echo $json;
mysqli_close($conn);

?>