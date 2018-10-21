<?php
/**
 * Created by PhpStorm.
 * User: SpringRain
 * Date: 2018/10/21
 * Time: 14:19
 */

include '../conn.php';
require_once "../lib/Response.php";
use WebLostAndFound\lib;

$type = isset($_GET['type'])?$_GET['type']:0;
$category = isset($_GET['category'])?$_GET['category']:0;

$where = ' ';
if($type!=0&&$category!=0){
    $where = " where type='$type' and category='$category'";
}else{
    if($type!=0){
        $where = " where type='$type'";
    }
    if($category!=0){
        $where = " where category='$category'";
    }
}
$sql = "SELECT * FROM publish ".$where." order by publish_id desc;";
$res = mysqli_query( $conn, $sql );
$data = [];
if (mysqli_num_rows($res) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($res)) {
        $data_row = $row;
        $data_row['image_url']=[];
        $tmp_id =  $row["publish_id"];

        $sql_info = "select * from user_info where user_id = ".$row['user_id'].";";
        $res_info = mysqli_query( $conn, $sql_info );
        if (mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res_info)){
                $data_row['nickName'] = $row["nickName"];
                $data_row['avatarUrl'] = $row["avatarUrl"];
            }
        }

        $sql_image = "SELECT * FROM image WHERE publish_id= '$tmp_id';";
        $res_image = mysqli_query( $conn, $sql_image );
        if (mysqli_num_rows($res_image) > 0) {
            while($row_image = mysqli_fetch_assoc($res_image)) {
                $data_row['image_url'][] = $row_image["image_url"];
            }
        }
        $data[]=$data_row;
    }
}else{
    lib\Response::send(-1,'fail',['sql'=>$sql, 'error'=>mysqli_errno($conn)]);
}

mysqli_close($conn);
lib\Response::send(0,'success:'.$sql,$data);