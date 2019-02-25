<?php
require_once "dep.php";
require_once "SensitiveWordDetection.php";
$log = new \lib\Log();
$rr = new \lib\RR("testSWD");
$rr->recv($_GET);
$res = \lib\SensitiveWordDetection::send($_GET['str']);
$rr->send(0,"ok",$res);