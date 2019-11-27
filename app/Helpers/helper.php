<?php
if(!function_exists('getThumbName')){
    function getThumbName($file){
        $fileName = pathinfo($file,PATHINFO_FILENAME);
        $ext = pathinfo($file,PATHINFO_EXTENSION);
        $newFileName = $fileName.'-'.config('app.thumb_suffix').'.'.$ext;
        $dir = pathinfo($file,PATHINFO_DIRNAME);
        $fullName = $dir.'/'.$newFileName;
        return $fullName;
    }
}
