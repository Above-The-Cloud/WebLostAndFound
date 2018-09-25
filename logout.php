<?php

include '/conn.php';
//echo json_encode($_GET);
$openid = $_GET['openid'];
$data='success';
$sql = "delete from user_openid where openid = '$openid'";
$res = mysqli_query( $conn, $sql );
echo($res);
mysqli_close($conn);

?>