<?php

include '../conn.php';
$true = 'true';
$false = 'false';
//echo json_encode($_GET);
$user_id = $_GET['user_id'];
$contact_type = $_GET['contact_type'];
$contact_value = $_GET['contact_value'];
$sql = "insert into contact(user_id, type, value, submission_time) VALUES ('$user_id', '$contact_type', '$contact_value', current_time());";
$res = mysqli_query( $conn, $sql );
if($res){
	echo json_encode($true);
}
mysqli_close($conn);



?>