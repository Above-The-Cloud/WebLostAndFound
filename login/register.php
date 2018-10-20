<?php

include '../conn.php';
require_once "../lib/Caller.php";
require_once "../lib/Response.php";
use WebLostAndFound\lib;

$true = 'true';
$false = 'false';
//echo json_encode($_GET);
$stu_id = $_GET['user_id'];
$stu_pass = $_GET['user_password'];

$openid = $_GET['openid'];
//$nickName = $_GET['nickName'];
$avatarUrl = $_GET['avatarUrl'];
$tag=0;
$url = 'http://202.120.82.2:8081/ClientWeb/pro/ajax/login.aspx';
$params = [
    "id"=>$stu_id,
    "pwd"=>$stu_pass,
    "act"=>'login'
    ];
//$sql = "select * from student where stu_id = '$stu_id' and stu_pass='$stu_pass';";
//$res = mysqli_query( $conn, $sql );
//if (mysqli_num_rows($res) > 0) {
list($code, $msg, $data)=lib\Caller::request_post($url, $params);
$res=json_decode($data, true);
//echo json_encode($res);
if($code!=0){
    lib\Response::send(-1, '网络错误',[$code, $msg, $data]);
}
if($res['ret']==1){
	$tag="registered";
    $nickName = $res['ret']['name'];
	$sql_user_info = "select * from user_info where user_id = '$stu_id';";
	$res_user_info = mysqli_query( $conn, $sql_user_info);
	if(mysqli_num_rows($res_user_info) <=0){
		$tag="unregistered";
		$sql_insert_userinfo = "insert into user_info(user_id,nickName, avatarUrl, submission_time) VALUES ('$stu_id','$nickName', '$avatarUrl', current_time());";
		$res = mysqli_query( $conn, $sql_insert_userinfo);
		if($res==false){
            lib\Response::send(-2, 'fail',['sql'=>$sql_insert_userinfo,'res'=>$res, 'error'=>mysqli_errno($conn)]);
        }
	}
    $sql_insert_openid = "insert into user_openid(user_id,openid, submission_time) VALUES ('$stu_id','$openid', current_time());";
    $res = mysqli_query( $conn, $sql_insert_openid );
    if($res==false){
        lib\Response::send(-2, 'fail',['sql'=>$sql_insert_openid,'error'=>mysqli_errno($conn)]);
    }
	//echo json_encode($tag);
    lib\Response::send(0, 'success',['tag'=>$tag]);
}
else{
    lib\Response::send(-1, '用户名或密码错误！',[$res]);
	//echo json_encode($false);
}
mysqli_close($conn);

?>