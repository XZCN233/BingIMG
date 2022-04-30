<?php
$path = "test";//This parameter is mandatory for setting the image cache folder.
//It is not recommended to fill in the English period directly in the root directory, because there will be a BUG, with my PHP level is not able to repair now.
//All changes based on this item must Fork the project and then make changes in the Fork repository.
//If you do not know PHP or do not understand PHP but still want to use this program, do not modify the code below or do not modify directly use.
$filename = $path . "/" . date("Ymd") . ".jpg";
//Name the new file as "Set directory/year month date.jpg".
$api = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1'); 
//Read the Bing API to get JSON data on the Bing server.
$api = json_decode($api,true);
//Decode JSON data from the Bing API.
$url = 'https://cn.bing.com'.$api['images'][0]['url'];
//Analyze the Bing API to get the URL of the Bing Chart of the Day
if(!file_exists($path)){mkdir($path, 0777);}//If the directory does not exist, create the specified directory.
if(!file_exists($filename)){//If no file exists, there is no cache today.
    //Get the file from the URL with file_get_contents() and save it with file_put_contents()
    if(file_put_contents($filename,file_get_contents($url))){
        echo '{"Return":"200","Location":"'. $filename . '";}';//Normal feedback output
    }else {
        echo '{"Return":"Err","Reason":"Can-Not-Download";}';//Unable to download error output
    }
}else {
    echo '{"Return":"Err","Reason":"Already-Downloaded";}';//Error output has been cached
}
?>
