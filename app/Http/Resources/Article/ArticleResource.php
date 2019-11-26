<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Article\ArticleCategory;
use App\Http\Resources\Article\ArticleCategoryResource;
class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
/*        return [
            'id'=>$this->id,
            'category_id'=>$this->category_id,
            'category'=>new ArticleCategoryResource($this->category),
            'thumb'=>$this->thumb,
            'image'=>$this->image,
            'intro'=>$this->intro,
            'desc'=>$this->desc,
            'seo_title'=>$this->seo_title,
            'seo_keywords'=>$this->seo_keywords,
            'seo_desc'=>$this->seo_desc,
            'order'=>$this->order,
            'created_at'=>$this->created_at->toDateTimeString(),
            'updated_at'=>$this->updated_at->toDateTimeString(),
        ];*/
        return parent::toArray($request);
    }
}
