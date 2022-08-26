<?php
/*
 * @Author: Histion
 * @Date: 2022-03-18 16:24:42
 * @LastEditors: Histion
 * @LastEditTime: 2022-03-18 16:37:50
 * @Description: 喵都她真的好香，总是会让我忍不住接近她，她的柔弱的声音，那可爱的小脸，她生闷气的时候很可爱，笑的时候很可爱，她的一举一动已经刻在我的脑海里了，她的一个笑容美得能让所罗门王的宝藏黯然失色，她那美丽的外貌会让众神嫉妒，如果一定要将美丽可爱拟成人名，我想那名字一定是-----九条都
 * 
 * Copyright (c) 2022 by histion, All Rights Reserved. 
 */
//读取文本
$str = explode("\n", file_get_contents('vscode.txt'));
$k = rand(0,count($str));
$sina_img = str_re($str[$k]);

$size_arr = array('kf', 'mw1024', 'mw690', 'bmiddle', 'small', 'thumb180', 'thumbnail', 'square');
$size = !empty($_GET['size']) ? $_GET['size'] : 'kf' ;
if(!in_array($size, $size_arr)){
	$size = 'large';
}
$url = ''.$sina_img.'';
//解析结果
$result=array("code"=>"200","acgurl"=>"$url");
//Type Choose参数代码
$type=$_GET['return'];
switch ($type)
{   
   
//格式解析        
case 'json':
$path = "$url";
$pathinfo = pathinfo($path);
$imageInfo = getimagesize($url);  
$result['width']="$imageInfo[0]";  
$result['height']="$imageInfo[1]";
$result['size']="$pathinfo[extension]";    
header('Content-type:text/json');
echo json_encode($result);
break;
//格式解析                             
case 'img':
$img = file_get_contents($url,true);
//使用图片头输出浏览器
header("Content-Type: image/jpeg;");
echo $img;
break;
//IMG
default:
header("Location:".$result['acgurl']);
break;
}
function str_re($str){
  $str = str_replace(' ', "", $str);
  $str = str_replace("\n", "", $str);
  $str = str_replace("\t", "", $str);
  $str = str_replace("\r", "", $str);
  return $str;
}
?>