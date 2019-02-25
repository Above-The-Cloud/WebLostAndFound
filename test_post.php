<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/10/13
 * Time: 10:52
 */
require_once "lib/Caller.php";
require_once "lib/Response.php";
use WebLostAndFound\lib;
$id = $_POST['id'];
$pwd = $_POST['pwd'];
$act = $_POST['act'];

$url = 'http://202.120.82.2:8081/ClientWeb/pro/ajax/login.aspx';
$params = [
    "id"=>$id,
    "pwd"=>$pwd,
    "act"=>$act];

list($code, $msg, $data) = lib\Caller::request_post($url, $params);
//$res = lib\Caller::request_post($url, $params);
//lib\Response::send($code, $msg, json_decode($data));
$res=json_decode($data, true);
lib\Response::send($res['ret'], $res['msg'], $res['data']);