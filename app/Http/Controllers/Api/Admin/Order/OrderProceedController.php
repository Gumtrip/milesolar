<?php

namespace App\Http\Controllers\Api\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order\OrderProceed;
use App\Models\Order\Order;
use App\Http\Requests\Admin\Order\OrderProceedRequest;
use App\Http\Resources\Order\OrderProceedResource;
use DB;


class OrderProceedController extends Controller
{
    //订单收款进度
    public function store(OrderProceedRequest $request, OrderProceed $orderProceed)
    {
        $orderProceed = DB::transaction(function () use ($request, $orderProceed) {
            $order = Order::findOrFail($request->order_id);
            $orderProceed->rmb_total_amount = bcmul($request->exchange_rate, $request->total_amount, 2);
            $orderProceed->fill($request->all());
            $orderProceed->order()->associate($order);
            $orderProceed->save();
            return $orderProceed;
        });

        return new OrderProceedResource($orderProceed);
    }

    public function update(OrderProceedRequest $request, OrderProceed $orderProceed)
    {
        $orderProceed = DB::transaction(function () use ($request, $orderProceed) {
            $orderProceed->update(array_merge($request->all(), [
                'rmb_total_amount' => bcmul($request->exchange_rate, $request->total_amount, 2)
            ]));
            return $orderProceed;
        });
        return new OrderProceedResource($orderProceed);
    }

    public function show(Request $request, OrderProceed $orderProceed)
    {
        return new OrderProceedResource($orderProceed);
    }

    public function destroy(Request $request, OrderProceed $orderProceed)
    {
        $orderProceed->delete();
        return response(null, 204);
    }
}
