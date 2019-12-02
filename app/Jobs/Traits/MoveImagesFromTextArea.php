<?php


namespace App\Jobs\Traits;


use App\Services\ImageHandleService;

trait MoveImagesFromTextArea
{
    /** 匹配图片
     * @param $content
     * @return mixed
     */

    private function matchImages($content){
        $pattern='/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.jpeg|\.png]))[\'|\"].*?[\/]?>/i';
        preg_match_all($pattern,$content,$matches);
        return $matches;
    }


    /** 移动图片并返回新路径
     * @param $image
     * @param $folder
     * @param $id
     * @return mixed
     */

    private function moveImage($image,$folder,$id){
        $uploadImageService = app(ImageHandleService::class);
        $realPath = trim(str_replace(config('app.url'),'',$image));//获取图片真实路径
        $path = $uploadImageService->moveFile($realPath,$folder,$id);
        return $path;
    }

}
