<?php
	$data = $_GET;
	//echo json_encode($data);
	$appid="wxf6a3fba14703a990";
	$appsecret="6df255640af2d914b26f2e75f405d9a7";
	$code=$_GET['code'];
	$get_url="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appsecret."&js_code=".$code."&grant_type=authorization_code";
	$get_return = file_get_contents($get_url);
	$get_return = (array)json_decode($get_return);
	//$openid=$get_return['openid'];
	echo json_encode($get_return);
	exit();
?>