<?php
$path = "test";//必填项，设置图片缓存文件夹
//不建议填英文句点直接存在根目录，因为会出BUG，以我的PHP水平暂时没有能力修复
//所有基于本项目的更改必须先Fork本项目，随后在Fork出的储存库中进行更改操作
//如果不会PHP或看不懂PHP但仍想使用本程序，建议不要修改下方代码或不修改直接使用
$filename = $path . "/" . date("Ymd") . ".jpg";
//用“设置的目录/年月日.jpg”的格式命名新的文件
$api = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1'); 
//读取必应API，获得必应服务器上的JSON数据
$api = json_decode($api,true);
//解码必应API的JSON数据
$url = 'https://cn.bing.com'.$api['images'][0]['url'];
//分析必应API，获取今日必应图的URL
if(!file_exists($path)){mkdir($path, 0777);}//如果目录不存在，创建指定目录
if(!file_exists($filename)){//如果不文件存在，说明今天还没有缓存
    //使用file_get_contents()从url获取文件，后用file_put_contents()保存
    if(file_put_contents($filename,file_get_contents($url))){
        echo '{"Return":"200","Location":"'. $filename . '";}';//正常反馈输出
    }else {
        echo '{"Return":"Err","Reason":"Can-Not-Download";}';//无法下载报错输出
    }
}else {
    echo '{"Return":"Err","Reason":"Already-Downloaded";}';//已缓存报错输出
}
?>
