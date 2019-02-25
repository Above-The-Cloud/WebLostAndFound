<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/11/26
 * Time: 20:25
 */

namespace lib;

require_once "dep.php";

class SensitiveWordDetection
{

    private $log;
    /**
     * SensitiveWordDetection constructor.
     */
    public function __construct()
    {
        $this->log = new \lib\Log();
    }

    public static function sendSwc($querys){
        $host = "http://apistore.tongchengyue.com";
        $path = "/swc/doFilter";
        $method = "POST";
        $appcode = "f560138f1b514ca98e7cf8ca12a23d85";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        //根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
//        $querys = "";
        $bodys = "src=".$querys;
        $url = $host . $path;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        $response = curl_exec($curl);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200') {
            list($resHeader, $resBody) = explode("\r\n\r\n", $response, 2);
        }
        $resBody = json_decode($resBody,true);
        return $resBody;
    }

    public static function send($querys){
        $host = "http://apistore.tongchengyue.com";
        $path = "/sw/isContains";
//        $path = "/swc/doFilter";
        $method = "POST";
        $appcode = "f560138f1b514ca98e7cf8ca12a23d85";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        //根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
//        $querys = "";
        $bodys = "src=".$querys;
        $url = $host . $path;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
        $response = curl_exec($curl);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200') {
            list($resHeader, $resBody) = explode("\r\n\r\n", $response, 2);
        }
        $resBody = json_decode($resBody,true);
        return $resBody;
    }
}