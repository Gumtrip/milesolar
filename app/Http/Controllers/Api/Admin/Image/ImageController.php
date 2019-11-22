<?php

namespace App\Http\Controllers\Api\Admin\Image;

use App\Http\Controllers\Controller;
use App\Services\UploadImageService;
use App\Http\Requests\Admin\Image\ImageRequest;
class ImageController extends Controller
{
    public function store(ImageRequest $request,UploadImageService $uploadImageService){
        $result = $uploadImageService->save($request->images);
        return response($result);
    }
}
