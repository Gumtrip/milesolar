<?php

namespace App\Http\Controllers\Api\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\Product;
use App\Http\Requests\Admin\Order\OrderRequest;
use App\Http\Queries\Order\OrderQuery;
use DB;

class OrderController extends Controller
{
    public function index(Request $request, OrderQuery $orderQuery)
    {
        $orders = $orderQuery->paginate(config('app.page_size'));
        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request, Order $order)
    {
        $order = DB::transaction(function () use ($order, $request) {
            $order->fill($request->all());
            $order->client()->associate($request->client_id);
            $order->save();
            $totalAmount = $request->total_amount;
            // 遍历用户提交的 SKU
            $items = $request->order_items;
            $itemsTotalAmount = 0;
            foreach ($items as $item) {
                $id = $item['id'];
                $sku = Product::findOrFail($id);
                // 创建一个 OrderItem 并直接与当前订单关联
                $orderItem = $order->orderItems()->make([
                    'name' => $sku ? $sku->title : $item['name'],
                    'amount' => $item['amount'],
                    'price' => $item['price'],
                ]);
                $orderItem->product()->associate($id);
                $orderItem->save();

                $itemsTotalAmount += $item['price'] * $item['amount'];//总计
            }
            $order->update([
                'total_amount'=>$totalAmount,
                'rmb_total_amount'=>$totalAmount * $request->exchange_rate,
            ]);
            return $order;
        });

        return new OrderResource($order);
    }

    public function show($id, OrderQuery $orderQuery)
    {

        $order = $orderQuery->findOrFail($id);
        return new OrderResource($order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order = DB::transaction(function () use ($order, $request) {
            $order->update($request->all());
            $itemsTotalAmount = 0;
            $items = collect($request->order_items);//提交的
            $exitsItems = $order->orderItems->pluck('id');//数据库
            foreach ($items as $item) {
                $id = $item['id'];
                if (!$exitsItems->contains($id)) {//数据库当中没有的，意味着是新的，需要插入
                    $sku = Product::findOrFail($id);
                    $orderItem = $order->orderItems()->make([
                        'name' => $sku ? $sku->title : $item['name'],
                        'amount' => $item['amount'],
                        'price' => $item['price'],
                    ]);
                    $orderItem->product()->associate($id);
                    $orderItem->save();
                } else {// 数据库和提交的交集
                    $orderItem = OrderItem::find($id);
                    $orderItem->update([
                        'amount' => $item['amount'],
                        'price' => $item['price'],
                    ]);
                }
                $exitsItems->diff($items->pluck('id'))->each(function ($id) use ($order) {
// 删掉差值
                    $orderItem = OrderItem::find($id);
                    if ($orderItem) {
                        $orderItem->delete();
                    }
                });
                $itemsTotalAmount += $item['price'] * $item['amount'];//总计
            }


            return $order;
        });
        return new OrderResource($order);
    }

    public function destroy(Request $request, Order $order)
    {
        $order->delete();
        return response(null, 204);
    }
}
