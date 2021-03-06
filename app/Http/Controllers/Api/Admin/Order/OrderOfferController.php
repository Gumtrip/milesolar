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
use App\Exports\OrderOffersExport;
use Maatwebsite\Excel\Facades\Excel;

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
            $itemsTotalAmount = $totalAmount = 0;//预计订单金额
            $items = collect($request->items);//提交的
            $exitsItems = $orderOffer->items->pluck('id');//数据库
            foreach ($items as $item) {
                $id = $item['id'];
                if ($exitsItems->contains($id)) {//更新
                    $orderItem = OrderOfferItem::find($id);
                    $orderItem->update([
                        'title' => $item['title'] ?? $orderItem->title,//留空就用回旧的
                        'amount' => $item['amount'],
                        'price' => $item['price'],
                        'remark' => $item['remark'] ?? '',
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
            $totalAmount = $itemsTotalAmount + $request->freight;//加上运费
            $orderOffer->update([
                'item_total_amount' => $itemsTotalAmount,
                'total_amount' => $totalAmount,
                'rmb_total_amount' => $totalAmount * $request->exchange_rate,
            ]);

            return $orderOffer;
        });

        return new OrderOfferResource($orderOffer);

    }

    public function destroy(OrderOffer $orderOffer)
    {
        $orderOffer->delete();
        return response(null, 204);
    }


    public function export(OrderOffer $orderOffer)
    {

        return Excel::download(new OrderOffersExport($orderOffer->id), time() . '_offer.xlsx');
    }
}
