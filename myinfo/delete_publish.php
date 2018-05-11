<?php

include '../conn.php';
//echo json_encode($_GET);
$publish_id = $_GET['publish_id'];
$sql = "delete from publish where publish_id='$publish_id';";
$res = mysqli_query( $conn, $sql );
if ($res) {
	$ture='true';
     echo json_encode($ture);
    
}
//$sql = "delete from image where publish_id='$publish_id';";
mysqli_close($conn);



?>