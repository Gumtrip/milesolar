<?php


namespace App\Services;

use Storage;
use File;
use Image;

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
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/" . date("Ym", time()) . '/' . date("d", time()) . '/';

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;
        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file->getClientOriginalName();
//            $filename = time() . '_' . Str::random(10) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
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
            $this->generateThumbImages($path);
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
        return $path;
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
