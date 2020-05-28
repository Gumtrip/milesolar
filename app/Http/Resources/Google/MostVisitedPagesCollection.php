<?php

namespace App\Http\Resources\Google;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MostVisitedPagesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
