<?php

namespace App\Http\Controllers\Api\Admin\Order;

use App\Http\Resources\Order\OrderResource;
use App\Models\Order\OrderOfferItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\OrderOfferRequest;
use App\Http\Queries\Order\OrderOfferQuery;
use App\Http\Resources\Order\OrderOfferResource;
use App\Models\Order\OrderOffer;
use App\Models\Product\Product;
use DB;
use Carbon\Carbon;
class OrderOfferController extends Controller
{
    public function index(Request $request, OrderOfferQuery $offerQuery)
    {
        $orders = $offerQuery->paginate(config('app.page_size'));
        return OrderOfferResource::collection($orders);
    }

    public function show($id, OrderOfferQuery $offerQuery)
    {

        $orderOffer = $offerQuery->findOrFail($id);
        return new OrderOfferResource($orderOffer);
    }

    public function store(OrderOfferRequest $request, OrderOffer $orderOffer)
    {
        $orderOffer = DB::transaction(function () use ($orderOffer, $request) {
            $data = $request->all();
            list($data['offer_start'], $data['offer_end']) = [
                Carbon::parse($request['offer_range'][0])->toDateTimeString(),
                Carbon::parse($request['offer_range'][1])->toDateTimeString()
            ];
            $orderOffer->fill($data);
            $orderOffer->client()->associate($request->client_id);
            $orderOffer->save();
            $items = $request->items;
            $itemsTotalAmount = 0;//预计订单金额
            foreach ($items as $item) {
                $id = $item['id'];
                $sku = Product::findOrFail($id);
                // 创建一个 OrderItem 并直接与当前订单关联
                $orderItem = $orderOffer->items()->make([
                    'title' => $sku->title,
                    'amount' => $item['amount'],
                    'price' => $item['price'],
                    'img' => $item['img'],
                    'desc' => $item['desc'],
                ]);

                $orderItem->product()->associate($id);
                $orderItem->save();
                $itemsTotalAmount += $item['price'] * $item['amount'];//总计
            }
            $orderOffer->update([
                'total_amount' => $itemsTotalAmount,
                'rmb_total_amount' => $itemsTotalAmount * $request->exchange_rate,
            ]);
            return $orderOffer;
        });
        return new OrderOfferResource($orderOffer);
    }

    public function update(OrderOfferRequest $request, OrderOffer $orderOffer)
    {
        $orderOffer = DB::transaction(function () use ($orderOffer, $request) {
            $data = $request->all();
            list($data['offer_start'], $data['offer_end']) = [
                Carbon::parse($request['offer_range'][0])->toDateTimeString(),
                Carbon::parse($request['offer_range'][1])->toDateTimeString()
            ];
            $orderOffer->update($data);
            $itemsTotalAmount = 0;//预计订单金额
            $items = collect($request->items);//提交的
            $exitsItems = $orderOffer->items->pluck('id');//数据库
            foreach ($items as $item) {
                $id = $item['id'];
                if (!$exitsItems->contains($id)) {//数据库当中没有的，意味着是新的，需要插入
                    $sku = Product::findOrFail($id);
                    $orderItem = $orderOffer->items()->make([
                        'title' => $sku->title,
                        'amount' => $item['amount'],
                        'price' => $item['price'],
                        'img' => $item['img'],
                        'desc' => $item['desc'],
                    ]);
                    $orderItem->product()->associate($id);
                    $orderItem->save();
                } else {// 数据库和提交的交集
                    $orderItem = OrderOfferItem::find($id);
                    $orderItem->update([
                        'amount' => $item['amount'],
                        'price' => $item['price'],
                        'desc' => $item['desc'],
                    ]);
                }
                $exitsItems->diff($items->pluck('id'))->each(function ($id) use ($orderOffer) {
// 删掉差值
                    $orderItem = OrderOfferItem::find($id);
                    if ($orderItem) {
                        $orderItem->delete();
                    }
                });
                $itemsTotalAmount += $item['price'] * $item['amount'];//总计
            }


            return $orderOffer;
        });

        return new OrderOfferResource($orderOffer);

    }

    public function destroy(OrderOffer $orderOffer)
    {
        $orderOffer->delete();
        return response(null, 204);
    }
}
