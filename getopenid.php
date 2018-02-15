<?php
	$data = $_GET;
	//echo json_encode($data);
	$appid="wxd4a02c9d70b821e8";
	$appsecret="5c67cffb86a2e9d07f75d13b79218200";
	$code=$_GET['code'];
	$get_url="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appsecret."&js_code=".$code."&grant_type=authorization_code";
	$get_return = file_get_contents($get_url);
	$get_return = (array)json_decode($get_return);
	//$openid=$get_return['openid'];
	echo json_encode($get_return);
	exit();
?>