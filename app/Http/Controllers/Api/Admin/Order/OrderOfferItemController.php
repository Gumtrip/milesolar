<?php

namespace App\Http\Controllers\Api\Admin\Order;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\OrderOfferItemRequest;
use App\Models\Order\OrderOfferItem;
use App\Models\Product\Property;
use App\Models\Product\PropertyCategory;
use DB;

class OrderOfferItemController extends Controller
{

    public function store(OrderOfferItemRequest $request, OrderOfferItem $orderOfferItem)
    {

        $product = Product::findOrFail($request->product_id);
        DB::transaction(function () use ($request, $product) {
            $orderOfferItem = new OrderOfferItem();
            $attrData = $attrGroupData = [];

            //整理属性存入数据库的格式
            $attrs = Property::whereIn('id', $request->pids)->get();
            $attrCates = PropertyCategory::whereIn('id', $attrs->pluck('property_category_id'))->get();
            $attrGroups = $attrs->groupBy('property_category_id');
            foreach ($attrGroups as $cateId => $group) {
                foreach ($group as $attr) {
                    $attrGroupData[$cateId][] = [
                        'id' => $attr->id,
                        'title' => $attr->title,
                    ];
                }
            }
            foreach ($attrCates as $cate) {
                $attrData[] = [
                    'id' => $cate->id,
                    'title' => $cate->title,
                    'children' => $attrGroupData[$cate->id],
                ];
            }
            //整理属性存入数据库的格式
            $orderOfferItem->fill([
                'title' => $product->short_title ? $product->short_title : $product->title,
                'amount' => 1,
                'price' => 0,
                'img' => $product->sm_img,
                'attrs' => $attrData,
                'remark' => '',
            ]);
            $orderOfferItem->product()->associate($product->id);
            $orderOfferItem->order_offer()->associate($request->order_offer_id);
            $orderOfferItem->save();
        });
        return response(null, 201);
    }

    public function destroy(Request $request, OrderOfferItem $orderOfferItem)
    {
        $orderOfferItem->delete();
        return response(null, 204);
    }
}
