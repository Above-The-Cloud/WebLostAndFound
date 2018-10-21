<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/10/16
 * Time: 18:23
 */

namespace WebLostAndFound\lib;


class Response
{
    public static function send($code, $msg, $data)
    {
        echo json_encode(["code" => $code, "msg" => $msg, "data" => $data]);
        exit;
    }
}