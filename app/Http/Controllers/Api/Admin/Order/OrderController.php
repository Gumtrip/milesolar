<?php

namespace App\Http\Controllers\Api\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Http\Requests\Admin\Order\OrderRequest;
use App\Http\Queries\Order\OrderQuery;
class OrderController extends Controller
{
    public function index(Request $request, OrderQuery $settingQuery)
    {
        $orders = $settingQuery->paginate(config('app.page_size'));
        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request, Order $order)
    {
        $order->fill($request->all());
        $order->client()->associate($request->client_id);
        $order->save();

        // 遍历用户提交的 SKU
        $items       = $request->input('items');
        foreach ($items as $data) {
            $sku  = Product::find($data['product_id']);

            // 创建一个 OrderItem 并直接与当前订单关联
            $item = $order->items()->make([
                'product_id' => $data['product_id'],
                'name' => $sku?$sku->name:$data['name'],
                'amount' => $data['amount'],
                'price'  => $sku?$sku->price:$data['price'],
            ]);
            $item->save();
        }

        return response(null,201);
    }

    public function show($id, OrderQuery $settingQuery)
    {
        $order = $settingQuery->findOrFail($id);
        return new OrderResource($order);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return new OrderResource($order);
    }

    public function destroy(Request $request, Order $order)
    {
        $order->delete();
        return response(null, 204);
    }
}
