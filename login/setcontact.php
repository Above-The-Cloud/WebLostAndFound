<?php

include '../conn.php';
require_once "../lib/Response.php";
use WebLostAndFound\lib;
//echo json_encode($_GET);
$user_id = $_GET['user_id'];
$contact_type = $_GET['contact_type'];
$contact_value = $_GET['contact_value'];
$sql = "insert into contact(user_id, type, value, submission_time) VALUES ('$user_id','$contact_type', '$contact_value', current_time());";
$res = mysqli_query( $conn, $sql );
if($res){
    lib\Response::send(0,"success",['sql'=>$sql,'res'=>json_encode($res)]);
}
mysqli_close($conn);
lib\Response::send(-1,"fail",['sql'=>$sql,'res'=>json_encode($res)]);
?>