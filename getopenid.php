<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wechatuser;
include_once   app_path('/Http/Controllers/Admin/PHP/wxBizDataCrypt.php');


  // 获取微信用户信息
   public function getWxLogin(Request $request)
   {
      // require_once ROOTPATH . "./PHP/wxBizDataCrypt.php";

        $code   =   $request->get('code');
        $encryptedData   =   $request->get('encryptedData');
        $iv   =   $request->get('iv');
        $appid  =  "wxd4a02c9d70b821e8" ;
        $secret =   "5c67cffb86a2e9d07f75d13b79218200";

        $URL = "https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$code&grant_type=authorization_code";

        $apiData=file_get_contents($URL);
        // var_dump($code,'wwwwwwww',$apiData['errscode']);
        //     $ch = curl_init();
        // 　　curl_setopt($ch, CURLOPT_URL, $URL);
        // 　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 　　curl_setopt($ch, CURLOPT_HEADER, 0);
        // 　　$output = curl_exec($ch);
        // 　　curl_close($ch)

        if(!isset($apiData['errcode'])){
            $sessionKey = json_decode($apiData)->session_key;
            $userifo = new \WXBizDataCrypt($appid, $sessionKey);

            $errCode = $userifo->decryptData($encryptedData, $iv, $data );

            if ($errCode == 0) {
                return ($data . "\n");
            } else {
                return false;
            }
        }
   }
   
?>