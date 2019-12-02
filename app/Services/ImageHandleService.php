<?php


namespace App\Services;

use Storage;
use File;
use Log;
class ImageHandleService
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    /** 移动上传的图片到特定文件夹
     * @param $file
     * @param $folder
     * @param $id
     * @return array|bool
     */


    public function save($file, $folder = null, $id = null)
    {
        if($folder&&$id){
            $folder_name = Storage::url($folder.'/'.$id) ;
            $upload_path = public_path($folder_name);
        }else{
            $folder_name = "/uploads/images/" . date("Ym", time()) . '/' . date("d", time());
            $upload_path = public_path($folder_name) ;
        }
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $file->getClientOriginalName();
//            $filename = time() . '_' . Str::random(10) . '.' . $extension;

        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        $file->move($upload_path, $filename);

        return [
            'full_path' => config('app.url') . "$folder_name/$filename",
            'path' => "$folder_name/$filename",
            'name' => $file->getClientOriginalName()
        ];
    }


    public function moveFile($images, $folder, $id)
    {
        $filesRoot = config('filesystems.disks.public.root') ;
        $dir = $folder . '/' . $id;
        if (!File::isDirectory($filesRoot.'/'.$dir)) {
            File::makeDirectory($filesRoot.'/'.$dir,0755);
        }

        $file = public_path($images);//旧图全路径
        $fileBaseName = pathinfo($file, PATHINFO_BASENAME);
        $path = $dir . '/' . $fileBaseName;//新图全路径
        $fullPath = $filesRoot . '/' . $path;//新图全路径
        if (File::exists($file)) {
            File::copy($file, $fullPath);
//            File::move($file, $fullPath);
            File::chmod($fullPath,0755);
            return Storage::url($path);
        }else{
            Log::warning('【'.$fullPath.'】图片不存在！');
        }
    }



}
