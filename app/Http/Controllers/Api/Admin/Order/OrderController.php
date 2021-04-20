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
