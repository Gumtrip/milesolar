<?php
if(!function_exists('getThumbName')){
    function getThumbName($file,$thumbName=null){
        if(!$thumbName)$thumbName = config('app.thumb_img.mid.name');
        $fileName = pathinfo($file,PATHINFO_FILENAME);
        $ext = pathinfo($file,PATHINFO_EXTENSION);
        $newFileName = $fileName.'-'.$thumbName.'.'.$ext;
        $dir = pathinfo($file,PATHINFO_DIRNAME);
        $fullName = $dir.'/'.$newFileName;
        return $fullName;
    }
}
function handle_ckeditor_img($upload_dir,$id,$content){
    if(($content))
    {
        //正则表达式匹配查找图片路径
        $pattern='/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.jpeg|\.png]))[\'|\"].*?[\/]?>/i';
        preg_match_all($pattern,$content,$res);
        $num=count($res[1]);
        for($i=0;$i<$num;$i++)
        {
            $ckeditor_img=$res[1][$i];
            $tmp_arr=explode('/',$ckeditor_img);
            $img_name = $tmp_arr[5];//这里注意，要跟开始的时候上传文件的层数保持一致，位置在FilesUpload.php的ck_upload方法的$save_dir
            $new_dir = $upload_dir.$id.'/ckeditor/';
            if(!\Storage::disk(trim(config('app.upload_name'),'/'))->exists($upload_dir.$id.'/ckeditor/')){
                \Storage::disk(trim(config('app.upload_name'),'/'))->makeDirectory($new_dir);
            }
            $new_img=config('app.upload_name').$new_dir.$img_name;
            //转移图片
            if(is_file(public_path($ckeditor_img))&&rename(public_path($ckeditor_img), public_path($new_img))){//原文件存在且成功移动
                $content=str_replace($ckeditor_img,$new_img,$content);
            }
        }
    }
    return $content;
}
function matchImages($content){

}
