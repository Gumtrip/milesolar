<?php


namespace App\Services;

use Storage;
use File;
use Image;
use App\Jobs\CompressImages;
class UploadImageService
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];
    CONST DISKS = 'public';

    /** 移动上传的图片到特定文件夹
     * @param $file
     * @param $folder
     * @param $id
     * @return array|bool
     */


    public function save($file, $folder = null, $id = null)
    {
        $folder_name = "uploads/images/" . date("Ym", time()) . '/' . date("d", time()) . '/';

        $upload_path = public_path() . '/' . $folder_name;
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $file->getClientOriginalName();
//            $filename = time() . '_' . Str::random(10) . '.' . $extension;

        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        $file->move($upload_path, $filename);

        return [
            'full_path' => config('app.url') . "/$folder_name/$filename",
            'path' => "/$folder_name/$filename",
            'name' => $file->getClientOriginalName()
        ];
    }

    /** 移动并裁剪
     * @param $images
     * @param $folder
     * @param $id
     * @return array
     */

    public function moveAndCrop($images, $folder, $id)
    {
        if (!is_array($images)) {
            $imagesGroup[] = $images;
        } else {
            $imagesGroup = $images;
        }
        $paths = [];
        foreach ($imagesGroup as $image) {
            $paths[] = $this->moveFiles($image, $folder, $id);
        }
        foreach ($paths as $path) {
            CompressImages::dispatch($path);
        }
        return $paths;
    }

    private function moveFiles($images, $folder, $id)
    {
        $disk = Storage::disk(self::DISKS);
        $dir = $folder . '/' . $id;
        if (!$disk->exists($dir)) {
            $disk->makeDirectory($dir);
        }

        $file = public_path($images);//旧图全路径
        $fileBaseName = pathinfo($file, PATHINFO_BASENAME);
        $path = $dir . '/' . $fileBaseName;//新图全路径
        $fullPath = config('filesystems.disks.public.root') . '/' . $path;//新图全路径
        if (File::exists($file)) {
            File::move($file, $fullPath);
        }
        return Storage::url($path);
    }

    private function generateThumbImages($file, $maxWidth = 480)
    {
        $thumbName = getThumbName($file);
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make(Storage::disk(self::DISKS)->get($file));
        // 进行大小调整的操作
        $image->resize($maxWidth, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save(config('filesystems.disks.public.root') . '/'.$thumbName);
    }
}
