<?php

include '../conn.php';
$true = 'true';
$false = 'false';
//echo json_encode($_GET);
$stu_id = $_GET['user_id'];
$stu_pass = $_GET['user_password'];

$openid = $_GET['openid'];
$nickName = $_GET['nickName'];
$avatarUrl = $_GET['avatarUrl'];

$sql = "select * from student where stu_id = '$stu_id' and stu_pass='$stu_pass';";
$res = mysqli_query( $conn, $sql );
if (mysqli_num_rows($res) > 0) {
    $sql = "insert into user_info(user_id,openid,nickName, avatarUrl, submission_time) VALUES ('$stu_id', '$openid', '$nickName', '$avatarUrl', current_time());";
	$res = mysqli_query( $conn, $sql );
	if($res){
		echo json_encode($true);
	}
}
else{
	echo json_encode($false);
}
mysqli_close($conn);



?>