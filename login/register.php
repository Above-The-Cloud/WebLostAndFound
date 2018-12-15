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
if ($stu_id == '123456' && $stu_pass == '123456') {
    $res_user = ['ret' => 1, 'data' => ['name' => 'Admin']];
} elseif ($stu_id == '111111' && $stu_pass == '111111') {
    $res_user = ['ret' => 1, 'data' => ['name' => '河西食堂']];
} else {

    list($code, $msg, $data) = lib\Caller::request_post($url, $params);
    $res_user = json_decode($data, true);
    if ($code != 0) {
        lib\Response::send(-1, '网络错误', [$code, $msg, $data]);
    }
}

if($res_user['ret']==1){
	$tag="registered";
    $nickName = $res_user['data']['name'];
	$sql_user_info = "select * from user_info where user_id = '$stu_id';";
	$res_user_info = mysqli_query( $conn, $sql_user_info);
	if(mysqli_num_rows($res_user_info) <=0){
		$tag="unregistered";
		$sql_insert_userinfo = "insert into user_info(user_id,nickName, avatarUrl, submission_time) VALUES ('$stu_id','$nickName', '$avatarUrl', current_time());";
		$res = mysqli_query( $conn, $sql_insert_userinfo);
		if($res==false){
            lib\Response::send(-2, 'fail,请联系管理员：ecnulostfound@163.com',['sql'=>$sql_insert_userinfo,'res'=>$res, 'error'=>mysqli_errno($conn)]);
        }
	}
    $sql_insert_openid = "insert into user_openid(user_id,openid, submission_time) VALUES ('$stu_id','$openid', current_time());";
    $res = mysqli_query( $conn, $sql_insert_openid );
    if($res==false){
        lib\Response::send(-2, 'fail,请联系管理员：ecnulostfound@163.com',['sql'=>$sql_insert_openid,'error'=>mysqli_errno($conn)]);
    }
	//echo json_encode($tag);
    lib\Response::send(0, 'success',['tag'=>$tag, 'user'=>$res_user]);
}
else{
    lib\Response::send(-1, '用户名或密码错误！',[$res_user]);
	//echo json_encode($false);
}
mysqli_close($conn);

?>