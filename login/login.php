<?php

include '../conn.php';
//echo json_encode($_GET);
$openid = $_GET['openid'];
$sql = "select user_id from user_info where openid = '$openid'";
$res = mysqli_query( $conn, $sql );
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
     echo json_encode($row);
    }
}
mysqli_close($conn);



?>