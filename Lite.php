<?php
$path = "test";
$filename = $path . "/" . date("Ymd") . ".jpg";
$api = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1'); 
$api = json_decode($api,true);
$url = 'https://cn.bing.com'.$api['images'][0]['url'];
if(!file_exists($path)){mkdir($path, 0777);}
if(!file_exists($filename)){
    if(file_put_contents($filename,file_get_contents($url))){
        echo '{"Return":"200","Location":"'. $filename . '";}';
    }else {
        echo '{"Return":"Err","Reason":"Can-Not-Download";}';
    }
}else {
    echo '{"Return":"Err","Reason":"Already-Downloaded";}';
}
