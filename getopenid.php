<?php
	$data = $_GET;
	//echo json_encode($data);
	$appid="wxd8d5a2f6fa7f1878";
	$appsecret="001gjwq00HrkqH14SDs00PXMq00gjwq4";
	$code=$_GET['code'];
	$get_url="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appsecret."&js_code=".$code."&grant_type=authorization_code";
	$get_return = file_get_contents($get_url);
	$get_return = (array)json_decode($get_return);
	//$openid=$get_return['openid'];
	echo json_encode($get_return);
	exit();
?>