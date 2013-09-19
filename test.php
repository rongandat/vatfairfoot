<form method="post" enctype="multipart/form-data">
    <input type="file" name="upload" value=""/>
    <input type="submit"/>
</form>
<video width="320" height="240" controls="controls" autoplay="autoplay">
    <source src="videofilename.mp4" type="video/mp4">
    <object data="" width="320" height="240">
        <embed width="320" height="240" src="videofilename.mp4">
    </object>
</video>




<?php
//thumb path should be added in the below code
//test for thumb
$dir_img = 'uploads/';
$mediapath = 'videoplayback.MP4';
$file_thumb = create_movie_thumb($dir_img . $mediapath, $mediapath);
$name_file = explode(".", $mediapath);
$imgname = "thumb_" . $name_file[0] . ".jpg";

//// where ffmpeg is located  
//$ffmpeg = '/usr/bin/ffmpeg';  
////video dir  
//$video = 'uploads/videoplayback.MP4';  
////where to save the image  
//$image = 'uploads/thumbs/image.jpg';  
////time to take screenshot at  
//$interval = 5;  
////screenshot size  
//$size = '640x480';  
////ffmpeg command  
//$cmd = "$ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";
//var_dump(cmd);
//exec($cmd);
/*
  Function to create video thumbnail using ffmpeg
 */

function create_movie_thumb($src_file, $mediapath) {
    global $CONFIG, $ERROR;
    $CONFIG['ffmpeg_path'] = 'F:\vatfairfoot\ffmpeg'; // Change the path according to your server.
    $dir_img = 'uploads/';
    $CONFIG['fullpath'] = $dir_img . "thumbs/";

    $src_file = $src_file;
    $name_file = explode(".", $mediapath);
    $imgname = "thumb_" . $name_file[0] . ".jpg";
    $dest_file = $CONFIG['fullpath'] . $imgname;


    if (preg_match("#[A-Z]:|\\\\#Ai", __FILE__)) {
        // get the basedir, remove '/include'
        $cur_dir = (dirname(__FILE__));
        $src_file = '"' . $cur_dir . '\\' . strtr($src_file, '/', '\\') . '"';
        $ff_dest_file = '"' . $cur_dir . '\\' . strtr($dest_file, '/', '\\') . '"';
    } else {
        $src_file = escapeshellarg($src_file);
        $ff_dest_file = escapeshellarg($dest_file);
    }

    $output = array();
    if (eregi("win", PHP_OS)) {
        // Command to create video thumb
        $cmd = "\"" . str_replace("\\", "/", $CONFIG['ffmpeg_path']) . "ffmpeg\" -i " . str_replace("\\", "/", $src_file) . " -an -ss 00:00:05 -r 1 -vframes 1 -y " . str_replace("\\", "/", $ff_dest_file);
        exec("\"$cmd\"", $output, $retval);
        var_dump($src_file);
        var_dump($retval);
    } else {
        // Command to create video thumb
        $cmd = "{$CONFIG['ffmpeg_path']}ffmpeg -i $src_file -an -ss 00:00:05 -r 1 -vframes 1 -y $ff_dest_file";
        exec($cmd, $output, $retval);
    }


    if ($retval) {
        $ERROR = "Error executing FFmpeg - Return value: $retval";

        @unlink($dest_file);
        return false;
    }

    $return = $dest_file;

    //@chmod($return, octdec($CONFIG['default_file_mode'])); //silence the output in case chmod is disabled
    return $return;
}