<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Http\Resources\Product\ProductResource;
use App\Http\Queries\Product\ProductQuery;
use App\Services\ImageHandleService;

class ProductController extends Controller
{
    CONST FOLDER='product';
    public function index(Request $request,ProductQuery $productQuery){
        $products = $productQuery->paginate();
        return ProductResource::collection($products);
    }
    public function store(ProductRequest $request,Product $product){
        $product->fill($request->all());
        $product->save();
        if($images = $request->images){
            $uploadImageService = app (ImageHandleService::class);//移动图片
            foreach($images as $key=>$image){
                $path = $uploadImageService->moveFile($image,self::FOLDER,$product->id);
                $proImage = new ProductImage(['path'=>$path,'order'=>$key]);
                $proImage->product()->associate($product);
                $proImage->save();
            }
        }
        return response(null,201);
    }
    public function show($productId,ProductQuery $productQuery){
        $product = $productQuery->findOrFail($productId);
        return new ProductResource($product);
    }
    public function update(ProductRequest $request,Product $product){
        $oldImages = $product->images;
        $oldImageCol = $oldImages->pluck('path');
        $imageCol = collect($request->images);


        $imageCol->intersect ($oldImageCol)->each(function($img,$key) use($oldImages,$product){//交集，更新
            $oldImages->firstWhere('path',$img)->update(['order'=>$key]);
        });
        $oldImageCol->diff ($imageCol)->each(function($img,$key)use($oldImages){//旧集和新集的差集
            $oldImages->firstWhere('path',$img)->delete();
        });
        $imageCol->diff ($oldImageCol)->each(function($img,$key)use($oldImages,$product){//新集和旧集差集
            $proImage = new ProductImage(['path'=>$img,'order'=>$key]);
            $proImage->product()->associate($product);
            $proImage->save();
        });

        $product->update($request->all());


        return new ProductResource($product);
    }
    public function destroy(Request $request,Product $product){
        $product->delete();
        return response(null,204);
    }
}
