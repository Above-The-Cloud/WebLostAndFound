<?php

include '../conn.php';
//echo json_encode($_GET);
$user_id = $_GET['user_id'];
$data='success';
$sql = "delete from user_openid where use_id = '$user_id'";
$res = mysqli_query( $conn, $sql );
if (mysqli_num_rows($res) > 0) {
     echo json_encode($data);   
}
else {
	$data='failure';
	echo json_encode($data);   
}
mysqli_close($conn);

?>