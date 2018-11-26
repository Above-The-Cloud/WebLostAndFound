<?php

/**
*   edit界面后台数据处理；
*   by: wcy；
*   错误处理缺失，图片处理缺失；
*/
include '../conn.php';
require_once "../lib/SensitiveWordDetection.php";
require_once "../lib/RR.php";
require_once "../lib/Log.php";

$rr = new \lib\RR("edit@edit");
$rr->recv($_GET);

$user_id = $_GET['user_id'];
$type = $_GET['type_t'];
$category = $_GET['category'];
$title = $_GET['title'];
$msg = $_GET['msg'];
$ie = $_GET['image_exist'];

$res = \lib\SensitiveWordDetection::send($title.$msg);

if($res['status']='00000'){
    if($res['result']==true){
        $rr->send(-2,"您所发的内容包含敏感词汇！",$res);
    }
}else{
    $rr->send(-1,"网络错误，请稍后重试！",$res);
}

$sql = "INSERT INTO publish ".
        "(user_id, type, category, title, msg, image_exist, submission_time) ".
        "VALUES ".
        "('$user_id','$type', '$category', '$title','$msg', '$ie', current_time);";
$res = mysqli_query( $conn, $sql );


//尝试返回给发布的id
$id = mysqli_insert_id($conn);
//echo json_encode($id);
mysqli_close($conn);
$rr->send(0,"success",["publish_id"=>$id]);

?>