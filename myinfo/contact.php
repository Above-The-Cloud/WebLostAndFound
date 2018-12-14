<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/12/13
 * Time: 22:10
 */
require_once "../lib/dep.php";
$rr = new lib\RR("contact");
$conn = new \lib\SQLHelper();
$rr->recv($_GET);
$uid = $_GET['user_id'];
$type = $_GET['type'];
$value = $_GET['value'];
$query = "INSERT INTO contact (user_id,type,value) VALUES ($uid,'$type','$value') ON DUPLICATE KEY UPDATE type=VALUES(type), value=vALUES(value);";
mysqli_query($conn->getConn(),$query);
$conn->close();
$rr->finish(0,'success',[]);
