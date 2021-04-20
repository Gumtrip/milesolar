<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductInfo;
use App\Http\Resources\Product\ProductResource;
use App\Http\Queries\Product\ProductQuery;
use App\Services\ImageHandleService;
use File;
use DB;

class ProductController extends Controller
{
    CONST FOLDER = 'product';
    CONST CONTENT_NAME = ['info_0_m', 'info_1_m', 'info_2_m'];

    public function index(Request $request, ProductQuery $productQuery)
    {
        $products = $productQuery->paginate(config('app.page_size'));
        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->save();
        $imageHandleService = app(ImageHandleService::class);//移动图片
        if ($images = $request->images) {
            foreach ($images as $key => $image) {
                $img = $image['path'];
                if (File::exists(public_path($img))) {
                    $path = $imageHandleService->moveFile($img, self::FOLDER, $product->id);
                    $proImage = new ProductImage(['path' => $path, 'order' => $key]);
                    $proImage->product()->associate($product);
                    $proImage->save();
                }
            }
        }
        //添加内容
        foreach (self::CONTENT_NAME as $tab) {
            $content = $request->$tab ?? '';//没有内容也需要占位
            $matches = $imageHandleService->matchImages($content);
            if (isset($matches[1]) && $matches[1]) {
                $content = $imageHandleService->textAreaHandle($content, $matches, self::FOLDER, $product->id);
            }
            $info = new ProductInfo(['title' => $tab, 'content' => $content]);
            $info->product()->associate($product);
            $info->save();
        }
        //添加属性
        $properties = $request->properties;
        if ($properties) {
            $propertyIds = $properties->pluck('id');
            $product->properties()->sync($propertyIds);
        }

        return new ProductResource($product);
    }

    public function show($productId, ProductQuery $productQuery)
    {
        $product = $productQuery->findOrFail($productId);
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product = DB::transaction(function () use ($product, $request) {

            $oldImages = $product->images;
            $oldImageCol = $oldImages->pluck('path');
            $imageCol = collect($request->images)->pluck('path');

//图片处理
//todo 待优化  根据id 进行判断：是否插入或者更新
            $imageCol->intersect($oldImageCol)->each(function ($img, $key) use ($oldImages, $product) {//交集，更新 key
                $oldImages->firstWhere('path', $img)->update(['order' => $key]);
            });


            $oldImageCol->diff($imageCol)->each(function ($img) use ($oldImages) {//旧集和新集的差集，删除
                $oldImages->firstWhere('path', $img)->delete();
            });
//todo 待优化  本次提交的数据没有id 的则是需要新插入的
            $imageCol->diff($oldImageCol)->each(function ($img, $key) use ($oldImages, $product) {//新集和旧集差集,插入新值
                $proImage = new ProductImage(['path' => $img, 'order' => $key]);
                $proImage->product()->associate($product);
                $proImage->save();
            });

//富文本处理
            $proInfo = $product->infos;
            foreach ($proInfo as $info) {
                $title = $info->title;
                if ($content = $request->$title) {
                    $info->update(['content' => $content]);
                }
            }
            $product->update($request->all());
//添加属性
            $properties = collect($request->properties);
            if ($properties) {
                $propertyIds = $properties->pluck('id');
                $product->properties()->sync($propertyIds);
            }
            return $product;
        });


        return new ProductResource($product);
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        return response(null, 204);
    }
}
