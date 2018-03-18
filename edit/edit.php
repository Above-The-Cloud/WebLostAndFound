<?php

/**
*   edit界面后台数据处理；
*   by: wcy；
*   错误处理缺失，图片处理缺失；
*/
include '../conn.php';

$user_id = $_GET['user_id'];
$type = $_GET['type_t'];
$category = $_GET['category'];
$title = $_GET['title'];
$msg = $_GET['msg'];
$ie = $_GET['image_exist'];
$sql = "INSERT INTO publish ".
        "(user_id, type, category, title, msg, image_exist, submission_time) ".
        "VALUES ".
        "('$user_id','$type', '$category', '$title','$msg', '$ie', current_time);";
$res = mysqli_query( $conn, $sql );
//echo $user_id, $type, $title, $msg, $ie, $sql;
//echo json_encode($res);

//尝试返回给发布的id
$id = mysqli_insert_id($conn);
echo json_encode($id);
mysqli_close($conn);

?>